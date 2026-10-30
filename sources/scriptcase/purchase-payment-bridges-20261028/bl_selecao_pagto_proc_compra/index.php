<?php
   include_once('bl_selecao_pagto_proc_compra_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_log_imp_mysql']         = "log_imp_mysql";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems2ima']         = "ems2ima";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems2med']         = "ems2med";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ticontrole2']         = "ticontrole2";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_dinamico']         = "dinamico";
    //check publication with the prod
    $NM_dir_atual = getcwd();
    if (empty($NM_dir_atual))
    {
        $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
        $str_path_sys          = str_replace("\\", '/', $str_path_sys);
    }
    else
    {
        $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
        $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
    }
    $str_path_apl_url = $_SERVER['PHP_SELF'];
    $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
    $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class bl_selecao_pagto_proc_compra_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $nm_app_version;
   var $cor_link_dados;
   var $root;
   var $server;
   var $java_protocol;
   var $server_pdf;
   var $Arr_result;
   var $sc_protocolo;
   var $path_prod;
   var $path_link;
   var $path_aplicacao;
   var $path_embutida;
   var $path_botoes;
   var $path_img_global;
   var $path_img_modelo;
   var $path_icones;
   var $path_imagens;
   var $path_imag_cab;
   var $path_imag_temp;
   var $path_libs;
   var $path_doc;
   var $str_lang;
   var $str_conf_reg;
   var $str_schema_all;
   var $Str_btn_grid;
   var $str_google_fonts;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_help;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $Qtd_reg_ajax_grid;
   var $nm_falta_var;
   var $nm_falta_var_db;
   var $nm_tpbanco;
   var $nm_servidor;
   var $nm_usuario;
   var $nm_senha;
   var $nm_database_encoding;
   var $nm_arr_db_extra_args = array();
   var $nm_con_db2 = array();
   var $nm_con_persistente;
   var $nm_con_use_schema;
   var $nm_tabela;
   var $nm_ger_css_emb;
   var $sc_tem_trans_banco;
   var $nm_bases_all;
   var $nm_bases_access;
   var $nm_bases_db2;
   var $nm_bases_ibase;
   var $nm_bases_informix;
   var $nm_bases_mssql;
   var $nm_bases_mysql;
   var $nm_bases_postgres;
   var $nm_bases_oracle;
   var $nm_bases_sqlite;
   var $nm_bases_sybase;
   var $nm_bases_vfp;
   var $nm_bases_odbc;
   var $nm_bases_progress;
   var $nm_db_log_imp_mysql;
   var $nm_con_log_imp_mysql = array();
   var $nm_db_especw;
   var $nm_con_especw = array();
   var $nm_db_ems5;
   var $nm_con_ems5 = array();
   var $nm_db_ems2ima;
   var $nm_con_ems2ima = array();
   var $nm_db_ems2med;
   var $nm_con_ems2med = array();
   var $nm_db_comum;
   var $nm_con_comum = array();
   var $nm_db_multi;
   var $nm_con_multi = array();
   var $nm_db_cfsc;
   var $nm_con_cfsc = array();
   var $nm_db_log_db;
   var $nm_con_log_db = array();
   var $nm_db_ticontrole2;
   var $nm_con_ticontrole2 = array();
   var $nm_db_ima;
   var $nm_con_ima = array();
   var $nm_db_med;
   var $nm_con_med = array();
   var $nm_db_geral;
   var $nm_con_geral = array();
   var $nm_db_dinamico;
   var $nm_con_dinamico = array();
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_export_ajax = false;
   var $sc_export_ajax_img = false;
   var $force_db_utf8 = true;
//
   function init($Tp_init = "")
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init, $nmgp_opcao;

      if (!function_exists("sc_check_mobile"))
      {
          include_once("../_lib/lib/php/nm_check_mobile.php");
      }
          include_once("../_lib/lib/php/fix.php");
      $_SESSION['scriptcase']['proc_mobile'] = sc_check_mobile();
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            $_SESSION['scriptcase']['proc_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_cnt_sql']  = 0;
      $this->sc_charset['UTF-8'] = 'utf-8';
      $this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
      $this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
      $this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
      $this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
      $this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
      $this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
      $this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
      $this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
      $this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
      $this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
      $this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
      $this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
      $this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
      $this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
      $this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
      $this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
      $this->sc_charset['WINDOWS-1250'] = 'windows-1250';
      $this->sc_charset['WINDOWS-1251'] = 'windows-1251';
      $this->sc_charset['WINDOWS-1252'] = 'windows-1252';
      $this->sc_charset['TIS-620'] = 'tis-620';
      $this->sc_charset['WINDOWS-1253'] = 'windows-1253';
      $this->sc_charset['WINDOWS-1254'] = 'windows-1254';
      $this->sc_charset['WINDOWS-1255'] = 'windows-1255';
      $this->sc_charset['WINDOWS-1256'] = 'windows-1256';
      $this->sc_charset['WINDOWS-1257'] = 'windows-1257';
      $this->sc_charset['KOI8-R'] = 'koi8-r';
      $this->sc_charset['BIG-5'] = 'big5';
      $this->sc_charset['EUC-CN'] = 'EUC-CN';
      $this->sc_charset['GB18030'] = 'GB18030';
      $this->sc_charset['GB2312'] = 'gb2312';
      $this->sc_charset['EUC-JP'] = 'euc-jp';
      $this->sc_charset['SJIS'] = 'shift-jis';
      $this->sc_charset['EUC-KR'] = 'euc-kr';
      $_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
      $_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
      $_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
      $_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
      $_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
      $_SESSION['scriptcase']['trial_version'] = 'N';
      $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "bl_selecao_pagto_proc_compra"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "Importacao"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20160610"; 
      $this->nm_hr_criacao   = "091209"; 
      $this->nm_autor_alt    = "tadeu"; 
      $this->nm_dt_ult_alt   = "20250429"; 
      $this->nm_hr_ult_alt   = "084718"; 
      $this->Apl_paginacao   = "PARCIAL"; 
      $temp_bug_list         = explode(" ", microtime()); 
      list($NM_usec, $NM_sec) = $temp_bug_list; 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0";
// 
// 
      $NM_dir_atual = getcwd();
      if (empty($NM_dir_atual))
      {
          $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
          $str_path_sys          = str_replace("\\", '/', $str_path_sys);
      }
      else
      {
          $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
          $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
      }
      $this->sc_site_ssl     = $this->appIsSsl();
      $this->sc_protocolo    = $this->sc_site_ssl ? 'https://' : 'http://';
      $this->sc_protocolo    = "";
      $this->path_prod       = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_doc'];
      if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
      {
          $_SESSION['scriptcase']['str_lang'] = "pt_br";
      }
      if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
      {
          $_SESSION['scriptcase']['str_conf_reg'] = "pt_br";
      }
      $this->str_lang        = $_SESSION['scriptcase']['str_lang'];
      $this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
      if (!isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['sub_cons_schema_filter'];
      } 
      $_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
      $_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
      $this->server          = (!isset($_SERVER['HTTP_HOST'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->java_protocol   = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->server_pdf      = $this->java_protocol . $this->server;
      $this->server          = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/bl_selecao_pagto_proc_compra';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_font       = $this->root . $this->path_link . "_lib/font/";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php";
      $this->path_lib_js     = $this->root . $this->path_link . "_lib/lib/js";
      $pos_path = strrpos($this->path_prod, "/");
      $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_chart_theme = $this->root . $this->path_link . "_lib/chart/";
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_secure     = $this->root . $this->path_prod . "/secure";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";
      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      $this->Cmp_Sql_Time     = array();

      include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      $temp_Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      include($this->path_btn . $temp_Str_btn_grid);
      $this->css_help_tooltip_faicon = isset($css_help_tooltip_faicon) && '' != trim($css_help_tooltip_faicon) ? trim($css_help_tooltip_faicon) : "fa fa-question-circle";
      $this->css_schema_info_tooltiptheme = isset($css_schema_info_tooltiptheme) && '' != trim($css_schema_info_tooltiptheme)  ? trim($css_schema_info_tooltiptheme) : "";
      $this->tippy_themes = [];
      $this->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }

      if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['actual_lang']) || $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_Importacao',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
      }
      $_SESSION['scriptcase']['fusioncharts_new'] = true;
      if (!isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs');
      }
      if (isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $aTmpOS = $this->getRunningOS();
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs/' . $aTmpOS['os']);
      }
      if (!class_exists('Services_JSON'))
      {
          include_once("bl_selecao_pagto_proc_compra_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
    copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
    echo $orig_img . '_@@NM@@_';
    if(file_exists($out1_img_cache)){
        echo $out1_img_cache;
        exit;
    }

         include_once("../_lib/lib/php/nm_trata_img.php");
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_save_ancor")
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['ancor_save'] = $_POST['ancor_save'];
          $oJson = new Services_JSON();
          if ($_SESSION['scriptcase']['sem_session']) {
              unset($_SESSION['sc_session']);
          }
          exit;
      }
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/";
                  }
                  if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_event" || $_POST['nmgp_opcao'] == "ajax_navigate"))
                  {
                      $this->Arr_result = array();
                      $this->Arr_result['redirInfo']['action']              = $nm_apl_dest;
                      $this->Arr_result['redirInfo']['target']              = $parms['T'];
                      $this->Arr_result['redirInfo']['metodo']              = "post";
                      $this->Arr_result['redirInfo']['script_case_init']    = $this->sc_page;
                      $oJson = new Services_JSON();
                      echo $oJson->encode($this->Arr_result);
                      exit;
                  }
?>
                  <html>
                  <body>
                  <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
                  </form>
                  <script>
                   document.FRedirect.submit();
                  </script>
                  </body>
                  </html>
<?php
                  exit;
              }
          }
      }
      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $remove_margin, $remove_border, $remove_background;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_selecao_pagto_proc_compra"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_selecao_pagto_proc_compra"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_remove_margin, $link_remove_border, $link_remove_background, $link_margin_top;
        if (isset($link_compact_mode) || isset($link_remove_margin) || isset($link_remove_border) || isset($link_remove_background) || isset($link_margin_top)) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['link_info']['margin_top'] = $link_margin_top;
        }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      asort($this->Nm_lang_conf_region);
      $_SESSION['scriptcase']['charset']  = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_lang as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
         {
             $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
             $this->Nm_lang[$ind] = $dados;
         }
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
         $this->Nm_lang[$ind] = str_replace('"', '&quot;',  $this->Nm_lang[$ind]);
      }
      $_SESSION['sc_session']['SC_download_violation'] = $this->Nm_lang['lang_errm_fnfd'];
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<html>";
          echo "<body>";
          echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
          echo "<tr>";
          echo "   <td align=\"center\">";
          echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          echo "</body>";
          echo "</html>";
          exit;
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      } 
      if (file_exists($this->path_libs . "/ver.dat"))
      {
          $SC_ver = file($this->path_libs . "/ver.dat"); 
          $SC_ver = str_replace(".", "", $SC_ver[0]); 
          if (substr($SC_ver, 0, 5) < 40015)
          {
              echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_incp'] . "</font></div>";exit;
          } 
      } 
      $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!is_dir($this->root . $this->path_prod))
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_cmlb_nfndtitle'], $str_message);
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_cmlb_nfnd'], $str_message);
          $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
         echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              else 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      $this->nm_ger_css_emb = true;
      $this->path_atual     = getcwd();
      $opsys = strtolower(php_uname());

// 
      include_once($this->path_aplicacao . "bl_selecao_pagto_proc_compra_erro.class.php"); 
      $this->Erro = new bl_selecao_pagto_proc_compra_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('bl_selecao_pagto_proc_compra'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("pt_br");
      if (is_file("../_lib/css/" . $this->str_schema_all . "_grid.php")) {
          include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      } else {
          $str_tree_col = "";
          $str_tree_exp = "";
          $str_button   = "";
      }
      $this->Color_bg_ajax = (!isset($str_ajax_bg)       || "" == trim($str_ajax_bg))       ? "#000" : $str_ajax_bg;
      $this->Border_c_ajax = (!isset($str_ajax_border_c) || "" == trim($str_ajax_border_c)) ? ""     : $str_ajax_border_c;
      $this->Border_s_ajax = (!isset($str_ajax_border_s) || "" == trim($str_ajax_border_s)) ? ""     : $str_ajax_border_s;
      $this->Border_w_ajax = (!isset($str_ajax_border_w) || "" == trim($str_ajax_border_w)) ? ""     : $str_ajax_border_w;
      $this->Tree_img_col    = trim($str_tree_col);
      $this->Tree_img_exp    = trim($str_tree_exp);
      $this->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1;
      } 
      $this->str_google_fonts= isset($str_google_fonts)?$str_google_fonts:'';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE html>';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scGridPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scGridBorder\">\r\n";
              $SS_cod_html .= "    <table class=\"scGridTabela\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scGridFieldOdd\"><td class=\"scGridFieldOddFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir'] . "');\r\n";
          }
          $SS_cod_html .= "      function sc_session_redir(url_redir)\r\n";
          $SS_cod_html .= "      {\r\n";
          $SS_cod_html .= "         if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "            window.parent.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "         else\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "             if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.close();\r\n";
          $SS_cod_html .= "                 window.opener.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "             else\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.location = url_redir;\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "      }\r\n";
          $SS_cod_html .= "    </script>\r\n";
          $SS_cod_html .= " </body>\r\n";
          $SS_cod_html .= "</HTML>\r\n";
          unset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && ((isset($_POST['nmgp_opcao']) && substr($_POST['nmgp_opcao'], 0, 5) == "ajax_") || (isset($_GET['nmgp_opcao']) && substr($_GET['nmgp_opcao'], 0, 5) == "ajax_")))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      $this->nm_bases_access     = array("access", "ado_access", "ace_access");
      $this->nm_bases_db2        = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
      $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
      $this->nm_bases_informix   = array("informix", "informix72", "pdo_informix");
      $this->nm_bases_mssql      = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
      $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
      $this->nm_bases_oracle     = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
      $this->sqlite_version      = "old";
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_sybase     = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
      $this->nm_bases_vfp        = array("vfp");
      $this->nm_bases_odbc       = array("odbc");
      $this->nm_bases_progress     = array("pdo_progress_odbc", "progress");
      $this->nm_bases_all        = array_merge($this->nm_bases_access, $this->nm_bases_db2, $this->nm_bases_ibase, $this->nm_bases_informix, $this->nm_bases_mssql, $this->nm_bases_mysql, $this->nm_bases_postgres, $this->nm_bases_oracle, $this->nm_bases_sqlite, $this->nm_bases_sybase, $this->nm_bases_vfp, $this->nm_bases_odbc, $this->nm_bases_progress);
      $this->nm_font_ttf = array("ar", "ja", "pl", "ru", "sk", "thai", "zh_cn", "zh_hk", "cz", "el", "ko", "mk");
      $this->nm_ttf_arab = array("ar");
      $this->nm_ttf_jap  = array("ja");
      $this->nm_ttf_rus  = array("pl", "ru", "sk", "cz", "el", "mk");
      $this->nm_ttf_thai = array("thai");
      $this->nm_ttf_chi  = array("zh_cn", "zh_hk", "ko");
      $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1DcXOZSX7HIrwHuBiDMvsVcFKDWFYDoFGHQNwH9B/HIveZMBODMvCDkB/DuFaZuXGD9XsH9FUHArYHuFaHuNOZSrCH5FqDoXGHQJmZ1BiHABYHuBOHgBYVkJ3DWr/HMFGHQFYDQFaHIBeHuXGDMrwV9BUDWF/HMFaHQXGZSBqDSvmZMBqHgvCHArCDWr/HMBiHQXsDuBqD1veHQBODMrwVcB/DWXCHMJwHQNwZkBiHIBeHuJwDMrYZSXeDuFYVoXGDcJeZ9rqD1BeHQXGDMvsVIBsH5XCHIFUHQXOH9BOHIveHQBqHgvCHArsHEFqDoJsHQNwH9FUHAveHQrqDMrwV9FeDuX7HMB/DcNmZ1FGDSBOZMXGHgvCHArCH5F/HIFGHQXODuBqD1BeHurqHgNKDkBODuFqDoFGDcBqVIJwD1NaV5JwHgN7DkFeHEB3DoNUHQNwDQX7HAvCV5BiHuNOVcFCDWFYDoJeD9BiZ1F7DSrYD5BqDEBOHEFiH5FGDoNUHQNwDuFaD1veV5BqHgNKVcFKDWFaVoX7DcJUZkFUHArKD5JeDEBeHEFiV5FaZuBqD9XsZ9JeHIBOV5BiHuBOVcBOV5X7VEraDcBwZ1F7D1rwD5NUDEBODkFeDWF/ZuB/D9NwZSX7D1vOV5BiHgrKVcBOHEFYVENUD9JmZ1F7HArYD5XGDMrYHEFiV5FaVoBODcJUDQJwD1veD5BOHgrKVcBOV5X/VoFaDcJUZSB/Z1BeD5XGDMrYHEFiDuFYVoXGDcJeZSX7HABYD5NUHuzGDkBOHEFYDoJsDcJUVIJwZ1vmD5rqDEBOHEFiHEFqDoF7DcJUZSBiDSzGVWFaDMzGVcBUH5XKVEX7HQXGZ1BOHAvsV5X7DMvCZSJqH5FGDoJeHQBiH9BiHIvsD5F7DMvmVIBsHEX7HMJsHQXOH9BqD1vsV5X7HgrKZSJ3HEXCHIXGHQNwZ9XGHIvsV5FGHuNOVcFKHEFYVoBqDcBwH9BqDSvOZMJwDMveVkJqH5FYHMBqHQNmDQFaHIvsD5F7DMBOVcBUH5FqHMraHQBsZSBqD1NaV5X7HgNOVkJ3DuFYHIFUHQBiZ9XGHAvmD5F7DMBOVIBsDWJeHIJsDcFYZSBOHAvsD5rqDEBOHEFiHEFqDoF7DcJUZSBiHIBOVWFaDMvOVIBsDur/HMBODcNmZkFGZ1vOV5X7DMvCVkJ3DWrGZuJeHQNwZSBiHAvOD5F7DMzGVcFeDWFaHIraHQBsH9BOHAvsV5X7HgBODkB/DuFaHMFGHQJeDQB/D1BOV5FGHuNOVcFKHEFYVoBqDcBwH9FaD1rwD5rqDMNKZSJGDWF/DoraD9NmDQJsHIrKV5raDMrwDkFCDWF/VoB/D9XOVIraZ1BeZMBODEvsZSJGDuXKDoB/DcJeZSX7HIBeD5BqHgrKVcBOV5F/VENUD9XOVIJwZ1BeD5rqDEBOHEFiHEFqVoB/D9XsH9FGD1NKV5XGDMrwDkFCDuX7DoraDcBqVINUHIBOD5FaDEvsZSXeDWFqDorqHQXGZSFGD1BeV5FGDMvsV9BUDurGVoraDcBwH9B/HIrwV5JeDMBYDkBsH5FYDoXGDcJeZSFUZ1rwD5BOHuNODkFCH5FqVENUDcNwH9B/HArYV5X7DMBYHEXeHEFqVoX7HQJKDQJsZ1vCV5FGHuNOV9FeDWXCVoF7D9XOZ1B/DSBeV5B/HgNKDkXKDWFqDorqHQFYDQX7HIrKD5rqDMBYVcFCDWF/HMBiD9BsVIraD1rwV5X7HgBeHEFKV5FaDorqD9XsDQB/Z1rwV5BqHgrKVcBODuFqDoraDcBqH9B/HABYD5FaDMNKZSJGDWF/DoraDcBwZSFGD1veV5JwHgrYDkFCDWXCVoX7D9BsH9B/D1rwD5BiDMBYZSXeV5FaVoFGD9NwDQJwHANOV5FUDMrwVIFCDWXCDoX7D9XOZ1FGHArKV5FUDMrYZSXeV5FqHIJsHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHIJeD9XGZkFGZ1NOV5JsHgNOZSJqHEFqVoBiHQXGDuBqHIrKHQJwDMrYVcFCH5FqVEF7D9XGZ1FGHArKV5FUDMrYZSXeV5FqHIJsD9NwZSX7HANOV5raHgvsVIFCDWJeVoraD9BsZSFaDSNOV5FaHgBeHEFiV5B3DoF7D9XsDuFaHANKV5BODMvOVcBUDWrmVEraHQNmZ1BiD1vsD5XGHgBYHArCDWF/VoBiDcJUZSX7Z1BYHuFaDMNODkB/DWF/HIrqHQNmH9FaHArYHuFaDEBeDkXKDurmDoBOD9XsDQX7HABYHQJeHuzGVcB/Dur/HMBiD9BsVIraD1rwV5X7HgBeHErCV5FqVoB/DcBwDQJwD1veD5JwHuBOVcrsH5XCDoFGD9BsZ1FUHArKHQrqDEBOHEJGDWF/DoB/D9NwH9FGD1veV5FUDurKVkXKH5FqVoraDcBwZ1F7D1zGD5raHgBOHEJGDuJeDoBOD9XsZSFGHANOVWJsHgvsZSFeDuFaVoBqD9BsVIJwHArKHuBqDEvsHEFiH5F/DoraHQJKDQJsZ1vCV5FGHuNOV9FeDWB3VEFGHQFYVINUHAvsZMNU";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['initialize'])  
      { 
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['Gera_log_access'] = true;
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['initialize']      = false;
      } 
      $this->conectDB();
      $this->conectExtra();
      if (!in_array(strtolower($this->nm_tpbanco), $this->nm_bases_all))
      {
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nspt'] . "</font>";
          echo "  " . $perfil_trab;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_SoftCloud_sm_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_SoftCloud_sm_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
              } 
          } 
          exit ;
      } 
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = ""; 
      }
      $this->Nm_accent_access    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_db2       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_ibase     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_informix  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mssql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mysql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_postgres  = array('cmp_i'=>"unaccent(",'cmp_f'=>")",'cmp_apos'=>"",'arg_i'=>"' || unaccent('",'arg_f'=>"') || '",'arg_apos'=>"");
      $this->Nm_accent_oracle    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sqlite    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sybase    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_vfp       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_odbc      = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_progress  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");

      $this->Nm_accent_no = array('cmp_i'=>'','cmp_f'=>'','cmp_apos'=>'','arg_i'=>'','arg_f'=>'','arg_apos'=>'');
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access)) {
          $this->Nm_accent_yes = $this->Nm_accent_access;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2)) {
          $this->Nm_accent_yes = $this->Nm_accent_db2;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase)) {
          $this->Nm_accent_yes = $this->Nm_accent_ibase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_informix)) {
          $this->Nm_accent_yes = $this->Nm_accent_informix;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mssql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mysql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres)) {
          $this->Nm_accent_yes = $this->Nm_accent_postgres;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle)) {
          $this->Nm_accent_yes = $this->Nm_accent_oracle;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
          $this->Nm_accent_yes = $this->Nm_accent_sqlite;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase)) {
          $this->Nm_accent_yes = $this->Nm_accent_sybase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_vfp)) {
          $this->Nm_accent_yes = $this->Nm_accent_vfp;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_odbc)) {
          $this->Nm_accent_yes = $this->Nm_accent_odbc;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress)) {
          $this->Nm_accent_yes = $this->Nm_accent_progress;
      }
      else {
          $this->Nm_accent_yes = $this->Nm_accent_no;
      }
   }

   function getRunningOS()
   {
       $aOSInfo = array();

       if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
       {
           $aOSInfo['os'] = 'win';
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
       {
           $aOSInfo['os'] = 'linux-i386';
           if(strpos(strtolower(php_uname()), 'x86_64') !== FALSE) 
            {
               $aOSInfo['os'] = 'linux-amd64';
            }
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
       {
           $aOSInfo['os'] = 'macos';
       }

       return $aOSInfo;
   }

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

   function prep_conect()
   {
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']) && $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil']) && $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']))
      {
          if (!isset($_GET['nmgp_opcao']) || ('pdf' != $_GET['nmgp_opcao'] && 'pdf_res' != $_GET['nmgp_opcao'])) {
              ob_start();
          } else {
              @ini_set('zlib.output_compression',0);
              $bufferSize = @ini_get('output_buffering');
              if ('' != $bufferSize) {
                  $bufferSize = min($bufferSize * 10, 65536);
                  echo str_repeat('&nbsp;', $bufferSize);
              }
              
          }
          db_conect_devel($con_devel, $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
          $NM_SV_Parms = array();
          $NM_SV_Parms['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $NM_SV_Parms['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $NM_SV_Parms['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $NM_SV_Parms['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $NM_SV_Parms['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $NM_SV_Parms['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $NM_SV_Parms['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $NM_SV_Parms['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $NM_SV_Parms['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          db_conect_devel('log_imp_mysql', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_log_imp_mysql['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_imp_mysql['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_imp_mysql['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_imp_mysql['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_imp_mysql['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_imp_mysql['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_imp_mysql['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_log_imp_mysql['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_imp_mysql['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_log_imp_mysql['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_log_imp_mysql['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('especw', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_especw['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_especw['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_especw['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_especw['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_especw['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_especw['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_especw['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_especw['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_especw['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_especw['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_especw['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ems5', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ems5['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ems5['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ems5['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ems5['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ems2ima', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ems2ima['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2ima['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2ima['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2ima['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2ima['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2ima['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2ima['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ems2ima['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2ima['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ems2ima['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ems2ima['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ems2med', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ems2med['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2med['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2med['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2med['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2med['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2med['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2med['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ems2med['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2med['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ems2med['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ems2med['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('comum', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_comum['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comum['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comum['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comum['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comum['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comum['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comum['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_comum['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comum['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_comum['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_comum['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('multi', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_multi['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_multi['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_multi['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_multi['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_multi['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_multi['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_multi['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_multi['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_multi['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_multi['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_multi['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('cfsc', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_cfsc['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_cfsc['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_cfsc['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_cfsc['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_cfsc['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_cfsc['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_cfsc['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_cfsc['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_cfsc['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_cfsc['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_cfsc['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('log_db', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_log_db['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_db['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_db['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_db['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_db['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_db['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_db['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_log_db['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_db['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_log_db['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_log_db['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ticontrole2', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ticontrole2['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ticontrole2['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ticontrole2['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ticontrole2['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ticontrole2['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ticontrole2['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole2['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ticontrole2['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ticontrole2['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ticontrole2['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ticontrole2['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ima', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ima['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ima['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ima['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ima['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ima['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ima['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ima['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ima['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ima['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ima['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ima['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('med', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_med['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_med['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_med['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_med['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_med['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_med['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_med['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_med['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_med['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_med['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_med['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('geral', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_geral['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_geral['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_geral['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_geral['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_geral['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_geral['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_geral['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_geral['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_geral['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_geral['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_geral['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('dinamico', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_dinamico['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_dinamico['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_dinamico['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_dinamico['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_dinamico['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_dinamico['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_dinamico['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_dinamico['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_dinamico['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_dinamico['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_dinamico['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          $_SESSION['scriptcase']['glo_servidor']          = $NM_SV_Parms['servidor'];
          $_SESSION['scriptcase']['glo_usuario']           = $NM_SV_Parms['usuario'];
          $_SESSION['scriptcase']['glo_banco']             = $NM_SV_Parms['banco'];
          $_SESSION['scriptcase']['glo_senha']             = $NM_SV_Parms['senha'];
          $_SESSION['scriptcase']['glo_tpbanco']           = $NM_SV_Parms['tpbanco'];
          $_SESSION['scriptcase']['glo_decimal_db']        = $NM_SV_Parms['decimal'];
          $_SESSION['scriptcase']['glo_date_separator']    = $NM_SV_Parms['SC_sep_date'];
          $_SESSION['scriptcase']['glo_senha_protect']     = $NM_SV_Parms['protect'];
          $_SESSION['scriptcase']['glo_database_encoding'] = $NM_SV_Parms['glo_database_encoding'];
      }
      if (isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_log_imp_mysql'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_log_imp_mysql['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_imp_mysql['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_imp_mysql['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_imp_mysql['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_imp_mysql['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_imp_mysql['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_imp_mysql['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_imp_mysql['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_imp_mysql['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_especw['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_especw['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_especw['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_especw['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_especw['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_especw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_especw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_especw['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_especw['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems5['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems2ima'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems2ima['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2ima['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2ima['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2ima['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2ima['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2ima['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2ima['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ems2med'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems2med['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2med['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2med['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2med['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2med['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2med['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2med['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_comum['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comum['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comum['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comum['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comum['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comum['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comum['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comum['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comum['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_multi['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_multi['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_multi['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_multi['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_multi['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_multi['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_multi['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_multi['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_multi['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_cfsc['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_cfsc['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_cfsc['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_cfsc['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_cfsc['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_cfsc['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_cfsc['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_cfsc['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_cfsc['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_log_db['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_db['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_db['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_db['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_db['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_db['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_db['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_db['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_db['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ticontrole2'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ticontrole2['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ticontrole2['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ticontrole2['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ticontrole2['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ticontrole2['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ticontrole2['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole2['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole2['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ticontrole2['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ima['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ima['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ima['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ima['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ima['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ima['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ima['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_med['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_med['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_med['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_med['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_med['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_med['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_med['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_geral['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_geral['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_geral['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_geral['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_geral['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_geral['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_geral['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_geral['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_geral['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_dinamico['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_dinamico['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_dinamico['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_dinamico['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_dinamico['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_dinamico['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_dinamico['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_dinamico['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_dinamico['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($perfil_trab, $this->path_libs, "S", $this->path_conf);
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida_init']) 
      {
          if (!isset($_SESSION['acao_pagto_proc_compra'])) 
          {
              $this->nm_falta_var .= "acao_pagto_proc_compra; ";
          }
          if (!isset($_SESSION['proc_compra_id_corrente'])) 
          {
              $this->nm_falta_var .= "proc_compra_id_corrente; ";
          }
          if (!isset($_SESSION['escopo_pagto'])) 
          {
              $this->nm_falta_var .= "escopo_pagto; ";
          }
      }
// 
      if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_tpbanco; ";
          }
      }
      else
      {
          $this->nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_servidor']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_servidor; ";
          }
      }
      else
      {
          $this->nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_banco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_banco; ";
          }
      }
      else
      {
          $this->nm_banco = $_SESSION['scriptcase']['glo_banco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_usuario']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_usuario; ";
          }
      }
      else
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_senha']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_senha; ";
          }
      }
      else
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_senha']; 
      }
      if (isset($_SESSION['scriptcase']['glo_database_encoding']))
      {
          $this->nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
      }
      $this->nm_arr_db_extra_args = array(); 
      if (isset($_SESSION['scriptcase']['glo_use_ssl']))
      {
          $this->nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslmode']))
      {
          $this->nm_arr_db_extra_args['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslkey']))
      {
          $this->nm_arr_db_extra_args['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_encrypt']))
      {
          $this->nm_arr_db_extra_args['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststore']))
      {
          $this->nm_arr_db_extra_args['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
      {
          $this->nm_arr_db_extra_args['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
      {
          $this->nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
      {
          $this->nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
      {
          $this->nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
      {
          $this->nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
      {
          $this->nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
      }
      if (isset($_SESSION['scriptcase']['oracle_type']))
      {
          $this->nm_arr_db_extra_args['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_charset']))
      {
          $this->nm_arr_db_extra_args['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_rolename']))
      {
          $this->nm_arr_db_extra_args['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_dialect']))
      {
          $this->nm_arr_db_extra_args['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
      }
      if (isset($_SESSION['scriptcase']['security']))
      {
          $this->nm_arr_db_extra_args['security'] = $_SESSION['scriptcase']['security']; 
      }
      if (isset($_SESSION['scriptcase']['sslservercertificate']))
      {
          $this->nm_arr_db_extra_args['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
      {
          $this->nm_arr_db_extra_args['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientkeystash']))
      {
          $this->nm_arr_db_extra_args['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
      }
      if (isset($_SESSION['scriptcase']['authentication']))
      {
          $this->nm_arr_db_extra_args['authentication'] = $_SESSION['scriptcase']['authentication']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientlabel']))
      {
          $this->nm_arr_db_extra_args['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
      }
      if (isset($_SESSION['scriptcase']['use_ssh']))
      {
          $this->nm_arr_db_extra_args['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_server']))
      {
          $this->nm_arr_db_extra_args['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_user']))
      {
          $this->nm_arr_db_extra_args['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_port']))
      {
          $this->nm_arr_db_extra_args['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_privatecert']))
      {
          $this->nm_arr_db_extra_args['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localserver']))
      {
          $this->nm_arr_db_extra_args['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localport']))
      {
          $this->nm_arr_db_extra_args['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
      {
          $this->nm_arr_db_extra_args['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
      }
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->date_delim  = "";
          $this->date_delim1 = "";
      }
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access))
      {
          $this->date_delim  = "#";
          $this->date_delim1 = "#";
      }
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date1'];
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_dbcn_create'], $str_message);
          if (empty($this->nm_falta_var_db))
          {
              if (!empty($this->nm_falta_var))
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'] . $this->nm_falta_var, $str_message);
                  $str_message = str_replace('{var_str_message_conn}','', $str_message);
              }
              elseif ($nm_crit_perfil)
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_nfnd'], $str_message);
                  $str_message = str_replace('{var_str_message_conn}', $this->Nm_lang['lang_errm_dbcn_conn_nfnd'] . ' ' . $perfil_trab, $str_message);
                  $str_message = str_replace('{v_str_btn_inside}', "<button class='ui button primary' style='font-size: 16px !important;'><a href='" . $this->path_prod . "' style='color: white;text-decoration:none'><i class='icon database' style='float: left;padding-right: .5rem;'></i>". $this->Nm_lang['lang_errm_dbcn_create'] ."</a></button>", $str_message);
              }
          }
          else
          {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
          }
         $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
      }
   }
   function conectDB()
   {
      global $glo_senha_protect;
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_conexao'], $this->root . $this->path_prod, 'Importacao', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
          $this->Ibase_version = "old";
          if ($ibase_version = $this->Db->Execute("SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \"Version\" FROM RDB\$DATABASE"))
          {
              if (isset($ibase_version->fields[0]) && substr($ibase_version->fields[0], 0, 1) > 2) {$this->Ibase_version = "new";}
          }
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->Db->fetchMode = ADODB_FETCH_BOTH;
          $this->Db->Execute("set dateformat ymd");
          $this->Db->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2))
      {
          $this->Db->fetchMode = ADODB_FETCH_NUM;
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql))
      {
          $this->Db->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle))
      {
          $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
          $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_log_imp_mysql['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_log_imp_mysql['nm_arr_db_extra_args'])?$this->nm_con_log_imp_mysql['nm_arr_db_extra_args']:array();
      $this->nm_db_log_imp_mysql = db_conect($this->nm_con_log_imp_mysql['tpbanco'], $this->nm_con_log_imp_mysql['servidor'], $this->nm_con_log_imp_mysql['usuario'], $this->nm_con_log_imp_mysql['senha'], $this->nm_con_log_imp_mysql['banco'], $this->nm_con_log_imp_mysql['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_log_imp_mysql['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_log_imp_mysql['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_log_imp_mysql->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_log_imp_mysql->Execute("set dateformat ymd");
          $this->nm_db_log_imp_mysql->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_log_imp_mysql['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_log_imp_mysql->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_log_imp_mysql['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_log_imp_mysql->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_log_imp_mysql->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_log_imp_mysql['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_especw['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_especw['nm_arr_db_extra_args'])?$this->nm_con_especw['nm_arr_db_extra_args']:array();
      $this->nm_db_especw = db_conect($this->nm_con_especw['tpbanco'], $this->nm_con_especw['servidor'], $this->nm_con_especw['usuario'], $this->nm_con_especw['senha'], $this->nm_con_especw['banco'], $this->nm_con_especw['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_especw['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_especw['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_especw->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_especw->Execute("set dateformat ymd");
          $this->nm_db_especw->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_especw['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_especw->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_especw['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_especw->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_especw->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_especw['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ems5['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ems5['nm_arr_db_extra_args'])?$this->nm_con_ems5['nm_arr_db_extra_args']:array();
      $this->nm_db_ems5 = db_conect($this->nm_con_ems5['tpbanco'], $this->nm_con_ems5['servidor'], $this->nm_con_ems5['usuario'], $this->nm_con_ems5['senha'], $this->nm_con_ems5['banco'], $this->nm_con_ems5['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ems5['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ems5['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ems5->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ems5->Execute("set dateformat ymd");
          $this->nm_db_ems5->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ems5['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ems5->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ems5['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ems5->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ems5->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ems5['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ems2ima['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ems2ima['nm_arr_db_extra_args'])?$this->nm_con_ems2ima['nm_arr_db_extra_args']:array();
      $this->nm_db_ems2ima = db_conect($this->nm_con_ems2ima['tpbanco'], $this->nm_con_ems2ima['servidor'], $this->nm_con_ems2ima['usuario'], $this->nm_con_ems2ima['senha'], $this->nm_con_ems2ima['banco'], $this->nm_con_ems2ima['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ems2ima['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ems2ima['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ems2ima->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ems2ima->Execute("set dateformat ymd");
          $this->nm_db_ems2ima->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ems2ima['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ems2ima->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ems2ima['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ems2ima->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ems2ima->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ems2ima['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ems2med['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ems2med['nm_arr_db_extra_args'])?$this->nm_con_ems2med['nm_arr_db_extra_args']:array();
      $this->nm_db_ems2med = db_conect($this->nm_con_ems2med['tpbanco'], $this->nm_con_ems2med['servidor'], $this->nm_con_ems2med['usuario'], $this->nm_con_ems2med['senha'], $this->nm_con_ems2med['banco'], $this->nm_con_ems2med['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ems2med['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ems2med['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ems2med->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ems2med->Execute("set dateformat ymd");
          $this->nm_db_ems2med->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ems2med['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ems2med->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ems2med['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ems2med->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ems2med->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ems2med['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_comum['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_comum['nm_arr_db_extra_args'])?$this->nm_con_comum['nm_arr_db_extra_args']:array();
      $this->nm_db_comum = db_conect($this->nm_con_comum['tpbanco'], $this->nm_con_comum['servidor'], $this->nm_con_comum['usuario'], $this->nm_con_comum['senha'], $this->nm_con_comum['banco'], $this->nm_con_comum['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_comum['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_comum['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_comum->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_comum->Execute("set dateformat ymd");
          $this->nm_db_comum->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_comum['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_comum->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_comum['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_comum->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_comum->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_comum['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_multi['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_multi['nm_arr_db_extra_args'])?$this->nm_con_multi['nm_arr_db_extra_args']:array();
      $this->nm_db_multi = db_conect($this->nm_con_multi['tpbanco'], $this->nm_con_multi['servidor'], $this->nm_con_multi['usuario'], $this->nm_con_multi['senha'], $this->nm_con_multi['banco'], $this->nm_con_multi['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_multi['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_multi['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_multi->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_multi->Execute("set dateformat ymd");
          $this->nm_db_multi->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_multi['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_multi->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_multi['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_multi->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_multi->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_multi['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_cfsc['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_cfsc['nm_arr_db_extra_args'])?$this->nm_con_cfsc['nm_arr_db_extra_args']:array();
      $this->nm_db_cfsc = db_conect($this->nm_con_cfsc['tpbanco'], $this->nm_con_cfsc['servidor'], $this->nm_con_cfsc['usuario'], $this->nm_con_cfsc['senha'], $this->nm_con_cfsc['banco'], $this->nm_con_cfsc['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_cfsc['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_cfsc['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_cfsc->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_cfsc->Execute("set dateformat ymd");
          $this->nm_db_cfsc->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_cfsc['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_cfsc->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_cfsc['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_cfsc->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_cfsc->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_cfsc['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_log_db['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_log_db['nm_arr_db_extra_args'])?$this->nm_con_log_db['nm_arr_db_extra_args']:array();
      $this->nm_db_log_db = db_conect($this->nm_con_log_db['tpbanco'], $this->nm_con_log_db['servidor'], $this->nm_con_log_db['usuario'], $this->nm_con_log_db['senha'], $this->nm_con_log_db['banco'], $this->nm_con_log_db['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_log_db['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_log_db['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_log_db->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_log_db->Execute("set dateformat ymd");
          $this->nm_db_log_db->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_log_db['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_log_db->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_log_db['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_log_db->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_log_db->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_log_db['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ticontrole2['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ticontrole2['nm_arr_db_extra_args'])?$this->nm_con_ticontrole2['nm_arr_db_extra_args']:array();
      $this->nm_db_ticontrole2 = db_conect($this->nm_con_ticontrole2['tpbanco'], $this->nm_con_ticontrole2['servidor'], $this->nm_con_ticontrole2['usuario'], $this->nm_con_ticontrole2['senha'], $this->nm_con_ticontrole2['banco'], $this->nm_con_ticontrole2['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ticontrole2->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ticontrole2->Execute("set dateformat ymd");
          $this->nm_db_ticontrole2->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ticontrole2->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ticontrole2->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ticontrole2->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ticontrole2['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ima['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ima['nm_arr_db_extra_args'])?$this->nm_con_ima['nm_arr_db_extra_args']:array();
      $this->nm_db_ima = db_conect($this->nm_con_ima['tpbanco'], $this->nm_con_ima['servidor'], $this->nm_con_ima['usuario'], $this->nm_con_ima['senha'], $this->nm_con_ima['banco'], $this->nm_con_ima['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ima['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ima['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ima->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ima->Execute("set dateformat ymd");
          $this->nm_db_ima->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ima['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ima->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ima['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ima->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ima->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ima['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_med['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_med['nm_arr_db_extra_args'])?$this->nm_con_med['nm_arr_db_extra_args']:array();
      $this->nm_db_med = db_conect($this->nm_con_med['tpbanco'], $this->nm_con_med['servidor'], $this->nm_con_med['usuario'], $this->nm_con_med['senha'], $this->nm_con_med['banco'], $this->nm_con_med['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_med['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_med['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_med->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_med->Execute("set dateformat ymd");
          $this->nm_db_med->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_med['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_med->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_med['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_med->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_med->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_med['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_geral['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_geral['nm_arr_db_extra_args'])?$this->nm_con_geral['nm_arr_db_extra_args']:array();
      $this->nm_db_geral = db_conect($this->nm_con_geral['tpbanco'], $this->nm_con_geral['servidor'], $this->nm_con_geral['usuario'], $this->nm_con_geral['senha'], $this->nm_con_geral['banco'], $this->nm_con_geral['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_geral['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_geral['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_geral->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_geral->Execute("set dateformat ymd");
          $this->nm_db_geral->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_geral['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_geral->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_geral['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_geral->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_geral->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_geral['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_dinamico['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_dinamico['nm_arr_db_extra_args'])?$this->nm_con_dinamico['nm_arr_db_extra_args']:array();
      $this->nm_db_dinamico = db_conect($this->nm_con_dinamico['tpbanco'], $this->nm_con_dinamico['servidor'], $this->nm_con_dinamico['usuario'], $this->nm_con_dinamico['senha'], $this->nm_con_dinamico['banco'], $this->nm_con_dinamico['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_dinamico['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_dinamico['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_dinamico->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_dinamico->Execute("set dateformat ymd");
          $this->nm_db_dinamico->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_dinamico['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_dinamico->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_dinamico['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_dinamico->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_dinamico->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_dinamico['decimal'] = "."; 
      } 
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "R$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }
// 
   function sc_Include($path, $tp, $name)
   {
       if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
       {
           include_once($path);
       }
   } // sc_Include
   function sc_Sql_Protect($var, $tp, $conex="")
   {
       if (empty($conex) || $conex == "espec")
       {
           $TP_banco = $_SESSION['scriptcase']['glo_tpbanco'];
       }
       else
       {
           eval ("\$TP_banco = \$this->nm_con_" . $conex . "['tpbanco'];");
       }
       if ($tp == "date")
       {
           $delim  = "'";
           $delim1 = "'";
           if (in_array(strtolower($TP_banco), $this->nm_bases_access))
           {
               $delim  = "#";
               $delim1 = "#";
           }
           if (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
   function sc_Date_Protect($val_dt)
   {
       $dd = substr($val_dt, 8, 2);
       $mm = substr($val_dt, 5, 2);
       $yy = substr($val_dt, 0, 4);
       $hh = (strlen($val_dt) > 10) ? substr($val_dt, 10) : "";
       if ($mm > 12) {
           $mm = 12;
       }
       $dd_max = 31;
       if ($mm == '04' || $mm == '06' || $mm == '09' || $mm == 11) {
           $dd_max = 30;
       }
       if ($mm == '02') {
           $dd_max = ($yy % 4 == 0) ? 29 : 28;
       }
       if ($dd > $dd_max) {
           $dd = $dd_max;
       }
       return $yy . "-" . $mm . "-" . $dd . $hh;
   }
//
   function NM_gera_log_insert($orig="Scriptcase", $evento="", $texto="")
   {
       $delim  = "'";
       $delim1 = "'";
       if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_access))
       {
           $delim  = "#";
           $delim1 = "#";
       }
       if (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_sep_date1'];
       }
       $dt  = $delim . date('Y-m-d H:i:s') . $delim1;
       $usr = isset($_SESSION['usr_login']) ? $_SESSION['usr_login'] : "";
       if (strtolower($this->nm_con_ticontrole2['tpbanco']) == 'pdo_sqlsrv' || strtolower($this->nm_con_ticontrole2['tpbanco']) == 'pdo_dblib')
       { 
           $dt  = $delim . date('Ymd H:i:s') . $delim1;
       } 
       if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_access))
       { 
           $dt  = $delim . date('Y-m-d H:i:s') . $delim1;
       } 
       if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_informix))
       { 
           $dt  = "EXTEND(" . $dt . ", YEAR TO FRACTION)";
       } 
       if (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_access))
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_selecao_pagto_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_selecao_pagto_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_selecao_pagto_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
       $rlog = $this->nm_db_ticontrole2->Execute($comando); 
       if ($rlog === false)  
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Nm_lang['lang_errm_inst'], $this->nm_db_ticontrole2->ErrorMsg()); 
       }
   }
        function appIsSsl() {
                if (isset($_SERVER['HTTPS'])) {
                        if ('on' == strtolower($_SERVER['HTTPS'])) {
                                return true;
                        }
                        if ('1' == $_SERVER['HTTPS']) {
                                return true;
                        }
                }

                if (isset($_SERVER['REQUEST_SCHEME'])) {
                        if ('https' == $_SERVER['REQUEST_SCHEME']) {
                                return true;
                        }
                }

                if (isset($_SERVER['SERVER_PORT'])) {
                        if ('443' == $_SERVER['SERVER_PORT']) {
                                return true;
                        }
                }

                return false;
        }
   function Get_Gb_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_selecao_pagto_proc_compra']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
   }

   function GB_date_format($val, $format, $prefix="", $conf_region="S", $mask="")
   {
           return $val;
   }
   function Get_arg_groupby($val, $format)
   {
       return $val; 
   }
   function Get_format_dimension($ind_ini, $ind_qb, $campo, $rs, $conf_region="S", $mask="")
   {
       $retorno    = array();
       $format     = $this->Get_Gb_date_format($ind_qb, $campo);
       $Prefix_dat = $this->Get_Gb_prefix_date_format($ind_qb, $campo);
       if (empty($format) || $rs->fields[$ind_ini] == "")
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHIISS')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3,4");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3] . ":" . $rs->fields[$ind_ini + 4];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDD2')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMM')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MMDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $temp            = "0000-" . $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'BIMONTHLY' || $format == 'QUARTER' || $format == 'FOURMONTHS' || $format == 'SEMIANNUAL' || $format == 'WEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini], 0, 1) == 0) ? substr($rs->fields[$ind_ini], 1) : $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $Prefix_dat . $temp;
           return $retorno;
       }
       if ($format == 'DAYNAME'|| $format == 'YYYYDAYNAME')
       {
           if ($format == 'DAYNAME')
           {
               $retorno['orig'] = $rs->fields[$ind_ini];
               $ano             = "";
               $daynum          = $rs->fields[$ind_ini];
           }
           else
           {
               $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
               $ano             = " " . $rs->fields[$ind_ini];
               $daynum          = $rs->fields[$ind_ini + 1];
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress))
           {
               $daynum--;
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               $daynum = ($daynum == 6) ? 0 : $daynum + 1;
           }
           if ($daynum == 0) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_sund'] . $ano;
           }
           if ($daynum == 1) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_mond'] . $ano;
           }
           if ($daynum == 2) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_tued'] . $ano;
           }
           if ($daynum == 3) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_wend'] . $ano;
           }
           if ($daynum == 4) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_thud'] . $ano;
           }
           if ($daynum == 5) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_frid'] . $ano;
           }
           if ($daynum == 6) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_satd'] . $ano;
           }
           return $retorno;
       }
       if ($format == 'HH')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-00 " . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'DD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MM')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $temp            = $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-00 " . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'YYYYWEEK' || $format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYHH' || $format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $rs->fields[$ind_ini] . $_SESSION['scriptcase']['reg_conf']['date_sep'] . $rs->fields[$ind_ini + 1];
           return $retorno;
       }
       elseif ($format == 'HHIISS')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1,2");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1] . ":" . $rs->fields[$ind_ini + 2];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'HHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       else
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
   }
   function Ajust_fields($ind_ini, &$rs, $parts)
   {
       $prep = explode(",", $parts);
       foreach ($prep as $ind)
       {
           $ind_ok = $ind_ini + $ind;
           $rs->fields[$ind_ok] = (int) $rs->fields[$ind_ok];
           if (strlen($rs->fields[$ind_ok]) == 1)
           {
               $rs->fields[$ind_ok] = "0" . $rs->fields[$ind_ok];
           }
       }
   }
   function Get_date_order_groupby($sql_def, $order, $format="", $order_old="")
   {
       $order      = " " . trim($order);
       $order_old .= (!empty($order_old)) ? ", " : "";
       return $order_old . $sql_def . $order;
   }
}
//===============================================================================
//
class bl_selecao_pagto_proc_compra_apl
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Lookup;
   var $nm_location;
//
//----- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini = $this->Ini;
      $this->$modulo->Db = $this->Db;
      $this->$modulo->Erro = $this->Erro;
   }
//
//----- 
   function controle()
   {
      global $nm_saida, $nm_url_saida, $script_case_init, $glo_senha_protect;

      $this->Ini = new bl_selecao_pagto_proc_compra_ini(); 
      $this->Ini->init();
      $this->Change_Menu = false;
      if (isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_selecao_pagto_proc_compra']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_selecao_pagto_proc_compra'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_selecao_pagto_proc_compra']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_selecao_pagto_proc_compra']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('bl_selecao_pagto_proc_compra') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_selecao_pagto_proc_compra']['label'] = "" . $this->Ini->Nm_lang['lang_othr_blank_title'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "bl_selecao_pagto_proc_compra")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['Gera_log_access'])
      {
          $this->Ini->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['Gera_log_access'] = false;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['bl_selecao_pagto_proc_compra']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['bl_selecao_pagto_proc_compra']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['bl_selecao_pagto_proc_compra']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      $this->nm_data = new nm_data("pt_br");
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
      $this->Db = $this->Ini->Db; 
      include_once($this->Ini->path_aplicacao . "bl_selecao_pagto_proc_compra_erro.class.php"); 
      $this->Erro      = new bl_selecao_pagto_proc_compra_erro();
      $this->Erro->Ini = $this->Ini;
//
      header("X-XSS-Protection: 1; mode=block");
      header("X-Frame-Options: SAMEORIGIN");
      $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['proc_compra_id_corrente'])) {$_SESSION['proc_compra_id_corrente'] = "";}
if (!isset($this->sc_temp_proc_compra_id_corrente)) {$this->sc_temp_proc_compra_id_corrente = (isset($_SESSION['proc_compra_id_corrente'])) ? $_SESSION['proc_compra_id_corrente'] : "";}
if (!isset($_SESSION['acao_pagto_proc_compra'])) {$_SESSION['acao_pagto_proc_compra'] = "";}
if (!isset($this->sc_temp_acao_pagto_proc_compra)) {$this->sc_temp_acao_pagto_proc_compra = (isset($_SESSION['acao_pagto_proc_compra'])) ? $_SESSION['acao_pagto_proc_compra'] : "";}
if (!isset($_SESSION['condicao_cons_tit_ap'])) {$_SESSION['condicao_cons_tit_ap'] = "";}
if (!isset($this->sc_temp_condicao_cons_tit_ap)) {$this->sc_temp_condicao_cons_tit_ap = (isset($_SESSION['condicao_cons_tit_ap'])) ? $_SESSION['condicao_cons_tit_ap'] : "";}
if (!isset($_SESSION['escopo_pagto'])) {$_SESSION['escopo_pagto'] = "";}
if (!isset($this->sc_temp_escopo_pagto)) {$this->sc_temp_escopo_pagto = (isset($_SESSION['escopo_pagto'])) ? $_SESSION['escopo_pagto'] : "";}
  $this->sc_temp_acao_pagto_proc_compra = '';
 unset($_SESSION['condicao_cons_tit_ap']);
 unset($this->sc_temp_condicao_cons_tit_ap);
 unset($_SESSION['escopo_pagto']);
 unset($this->sc_temp_escopo_pagto);
;
$listaIdTitulos = $this->buscarTitAssociadosProcCompra($this->sc_temp_proc_compra_id_corrente);
if($listaIdTitulos == ''){
   $listaIdTitulos = 0;	
}
$escopo_pagto = "proc_compra";
 if (isset($escopo_pagto)) {$this->sc_temp_escopo_pagto = $escopo_pagto;}
;

$condicao_cons_tit_ap = " num_id_tit_ap not in ($listaIdTitulos) ";
$condicao_cons_tit_ap = $this->preencherCondPgtoProcCompra($condicao_cons_tit_ap);


 if (isset($condicao_cons_tit_ap)) {$this->sc_temp_condicao_cons_tit_ap = $condicao_cons_tit_ap;}
;


 if (isset($this->sc_temp_escopo_pagto)) {$_SESSION['escopo_pagto'] = $this->sc_temp_escopo_pagto;}
 if (isset($this->sc_temp_condicao_cons_tit_ap)) {$_SESSION['condicao_cons_tit_ap'] = $this->sc_temp_condicao_cons_tit_ap;}
 if (isset($this->sc_temp_acao_pagto_proc_compra)) {$_SESSION['acao_pagto_proc_compra'] = $this->sc_temp_acao_pagto_proc_compra;}
 if (isset($this->sc_temp_proc_compra_id_corrente)) {$_SESSION['proc_compra_id_corrente'] = $this->sc_temp_proc_compra_id_corrente;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('cons_tit_ap') . "/", $this->nm_location, "","_self", 440, 630, "ret_self");
 };
if (isset($this->sc_temp_escopo_pagto)) {$_SESSION['escopo_pagto'] = $this->sc_temp_escopo_pagto;}
if (isset($this->sc_temp_condicao_cons_tit_ap)) {$_SESSION['condicao_cons_tit_ap'] = $this->sc_temp_condicao_cons_tit_ap;}
if (isset($this->sc_temp_acao_pagto_proc_compra)) {$_SESSION['acao_pagto_proc_compra'] = $this->sc_temp_acao_pagto_proc_compra;}
if (isset($this->sc_temp_proc_compra_id_corrente)) {$_SESSION['proc_compra_id_corrente'] = $this->sc_temp_proc_compra_id_corrente;}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off'; 
//--- 
       $this->Db->Close(); 
       $this->Ini->nm_db_log_imp_mysql->Close(); 
       $this->Ini->nm_db_especw->Close(); 
       $this->Ini->nm_db_ems5->Close(); 
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
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
?>
        <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery/js/jquery.js"></script>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
        </script>
                <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
                <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
                <script type="text/javascript"><?php echo $this->redir_modal ?></script>
<?php
       } 
       exit;
   } 
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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
      if ($dadoslog = $this->Ini->nm_db_log_imp_mysql->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dadoslog = false;
          $dadoslog_erro = $this->Ini->nm_db_log_imp_mysql->ErrorMsg();
      } 

    if ($dadoslog  === false){
    echo "Erro acesso na busca do log=". $dadoslog_erro ;
    }
    else{
    while (!$dadoslog->EOF)
    {
        $idReg = $dadoslog->fields[0];
        $desc = $dadoslog->fields[1];
        $data = $dadoslog->fields[2];
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
             exit;
         }
         $rf->Close();
      
            }else{
                echo "<h1>id não numerico: $idChave <br> id: $idReg <br> descrição: $desc <br> $data </h1>";
            }
        }


        $dadoslog->MoveNext();
    }
    $dadoslog->Close();
}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['link_log'])) {$_SESSION['link_log'] = "";}
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
if (isset($this->sc_temp_link_log)) {$_SESSION['link_log'] = $this->sc_temp_link_log;}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function buscarTitAssociadosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function buscarVlTotPagtoProcCompra($procCompraId)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompraId);
    $codEstab     = buscarEmpERPProcCompra($procCompraId,'ems5');
    $codEstab     += 1 ;
    $valor = buscarTotPagoLista($codEstab,$listaTitulos,'dolar');
    return $valor;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function buscarVlPgtoAssocContainer($procCompra,$container)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $valor = 0;
    $listaTitulosASomar = '';
    $listaTitulosAssocProcCompra = $this->buscarTitAssociadosProcCompra($procCompra);
    $aTitulosProcCompra = explode(",",$listaTitulosAssocProcCompra);
    $listaTitulosAssocContainer = buscarTitAssociadosContainer($container);
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
    $codEmpresa = buscarEmpERPProcCompra($procCompra,'ems5');
    $codEstab = $codEmpresa + 1;
    $valor = buscarTotPagoLista($codEstab,$listaTitulosASomar,'dolar');
    return $valor;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function preencherCondPgtoProcCompra($condicaoTitAP)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['dt_reg_proc_compra_corrente'])) {$_SESSION['dt_reg_proc_compra_corrente'] = "";}
if (!isset($this->sc_temp_dt_reg_proc_compra_corrente)) {$this->sc_temp_dt_reg_proc_compra_corrente = (isset($_SESSION['dt_reg_proc_compra_corrente'])) ? $_SESSION['dt_reg_proc_compra_corrente'] : "";}
if (!isset($_SESSION['empresa_proc_compra_corrente_ems5'])) {$_SESSION['empresa_proc_compra_corrente_ems5'] = "";}
if (!isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) {$this->sc_temp_empresa_proc_compra_corrente_ems5 = (isset($_SESSION['empresa_proc_compra_corrente_ems5'])) ? $_SESSION['empresa_proc_compra_corrente_ems5'] : "";}
if (!isset($_SESSION['fornecedor_proc_compra_corrente'])) {$_SESSION['fornecedor_proc_compra_corrente'] = "";}
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

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
if (isset($this->sc_temp_empresa_proc_compra_corrente_ems5)) {$_SESSION['empresa_proc_compra_corrente_ems5'] = $this->sc_temp_empresa_proc_compra_corrente_ems5;}
if (isset($this->sc_temp_dt_reg_proc_compra_corrente)) {$_SESSION['dt_reg_proc_compra_corrente'] = $this->sc_temp_dt_reg_proc_compra_corrente;}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function existTitProcCompra($numIdTitAp,$procCompraId=0)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function verificarNecesAtualizPgtoPedido($numIdTitAp)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $logAtualizar = true;
    $container = getcontainerPagto($numIdTitAp);
    if($container <> 0){
        $logExisteItens = existItensContainer($container);
        if($logExisteItens == true){
            $logAtualizar = false;
        }
    }
    return $logAtualizar;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getProcCompraPgto($numIdTitAp)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function desassociarTituloPedido($numIdTitAp,$procCompraId)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_proc_compra where num_id_tit_ap = $numIdTitAp 
            and  proc_compra_id = $procCompraId ";
    
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
      
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function associarTituloPedido($numIdTitAp,$proCompraId)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_proc_compra(num_id_tit_ap,proc_compra_id) 
            values($numIdTitAp, $proCompraId ) ";
    
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
      
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getTitAssocSoPedido($fornecedor,$tipoReg)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getListaTitAssocPedido()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['fornecedor_proc_compra_corrente'])) {$_SESSION['fornecedor_proc_compra_corrente'] = "";}
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

if (isset($this->sc_temp_fornecedor_proc_compra_corrente)) {$_SESSION['fornecedor_proc_compra_corrente'] = $this->sc_temp_fornecedor_proc_compra_corrente;}
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['inicio']);
}

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
}
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0, $opc="")
   {
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
                  $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra'][substr($val, 1, -1)];
              }
              else
              {
                  $tmp_parms .= $val;
              }
              $tmp_parms .= "?@?";
          }
          $nm_apl_parms = $tmp_parms;
      }
      $target = (empty($nm_target)) ? "_self" : $nm_target;
      if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
      {
          echo "<SCRIPT language=\"javascript\">";
          if (strtolower($target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
          }
          echo "</SCRIPT>";
          exit;
      }
      $dir = explode("/", $nm_apl_dest);
      if (count($dir) == 1)
      {
          $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
          $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
      }
      if ($nm_target == "modal")
      {
          if (!empty($nm_apl_parms))
          {
              $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
              $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
              $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
          }
          $par_modal = "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
          $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
          return;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['iframe_print']) && $_SESSION['sc_session'][$this->Ini->sc_page]['bl_selecao_pagto_proc_compra']['iframe_print'] )
      {
          $target = "_parent";
      }
   ?>
<!DOCTYPE html>
      <HTML>
      <HEAD>
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
      <BODY>
   <form name="Fredir" method="post" 
                     target="_self"> 
     <input type="hidden" name="nmgp_parms" value="<?php echo NM_encode_input($nm_apl_parms) ?>"/>
<?php
   if ($target == "_blank")
   {
?>
       <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
     <input type="hidden" name="nmgp_url_saida" value="<?php echo NM_encode_input($nm_apl_retorno) ?>">
     <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>"/> 
<?php
   }
?>
   </form> 
      <SCRIPT language="javascript">
          window.onload = function(){
             submit_Fredir();
          };
          function submit_Fredir()
          {
              document.Fredir.target = "<?php echo $target ?>"; 
              document.Fredir.action = "<?php echo $nm_apl_dest ?>";
              document.Fredir.submit();
          }
      </SCRIPT>
      </BODY>
      </HTML>
   <?php
      if ($target != "_blank")
      {
          exit;
      }
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
} 
// 
//======= =========================
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   if (!function_exists("SC_dir_app_ini"))
   {
       include_once("../_lib/lib/php/nm_ctrl_app_name.php");
   }
   SC_dir_app_ini('Importacao');
   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['contr_erro'] = 'off';
   $Sc_lig_md5 = false;
   $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
   $_SESSION['scriptcase']['sem_session'] = false;
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
            nm_limpa_str_bl_selecao_pagto_proc_compra($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            $$nmgp_var = $nmgp_val;
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
            nm_limpa_str_bl_selecao_pagto_proc_compra($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!isset($_SERVER['HTTP_REFERER']) || (!isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start) ))
   {
       $Sem_Session = false;
   }
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual)) {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   $str_path_web    = $_SERVER['PHP_SELF'];
   $str_path_web    = str_replace("\\", '/', $str_path_web);
   $str_path_web    = str_replace('//', '/', $str_path_web);
   $path_aplicacao  = substr($str_path_web, 0, strrpos($str_path_web, '/'));
   $path_aplicacao  = substr($path_aplicacao, 0, strrpos($path_aplicacao, '/'));
   $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
   if ($Sem_Session && (!isset($nmgp_start) || $nmgp_start != "SC")) {
       if (isset($_COOKIE['sc_apl_default_Importacao'])) {
           $apl_def = explode(",", $_COOKIE['sc_apl_default_Importacao']);
       }
       elseif (is_file($root . $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "bl_selecao_pagto_proc_compra") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_Importacao'])) {
               $_SESSION['scriptcase']['bl_selecao_pagto_proc_compra']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Importacao'];
           }
       }
   }
   if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
   {
       $_SESSION['sc_session']['SC_parm_violation'] = true;
   }
   if (isset($_POST["acao_pagto_proc_compra"])) 
   {
       $_SESSION["acao_pagto_proc_compra"] = $_POST["acao_pagto_proc_compra"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["acao_pagto_proc_compra"]);
   }
   if (isset($_GET["acao_pagto_proc_compra"])) 
   {
       $_SESSION["acao_pagto_proc_compra"] = $_GET["acao_pagto_proc_compra"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["acao_pagto_proc_compra"]);
   }
   if (!isset($_SESSION["acao_pagto_proc_compra"])) 
   {
       $_SESSION["acao_pagto_proc_compra"] = "";
   }
   if (isset($_POST["proc_compra_id_corrente"])) 
   {
       $_SESSION["proc_compra_id_corrente"] = $_POST["proc_compra_id_corrente"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["proc_compra_id_corrente"]);
   }
   if (isset($_GET["proc_compra_id_corrente"])) 
   {
       $_SESSION["proc_compra_id_corrente"] = $_GET["proc_compra_id_corrente"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["proc_compra_id_corrente"]);
   }
   if (!isset($_SESSION["proc_compra_id_corrente"])) 
   {
       $_SESSION["proc_compra_id_corrente"] = "";
   }
   if (isset($_POST["escopo_pagto"])) 
   {
       $_SESSION["escopo_pagto"] = $_POST["escopo_pagto"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["escopo_pagto"]);
   }
   if (isset($_GET["escopo_pagto"])) 
   {
       $_SESSION["escopo_pagto"] = $_GET["escopo_pagto"];
       nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["escopo_pagto"]);
   }
   if (!isset($_SESSION["escopo_pagto"])) 
   {
       $_SESSION["escopo_pagto"] = "";
   }
   if (!empty($glo_perfil))  
   { 
      $_SESSION['scriptcase']['glo_perfil'] = $glo_perfil;
   }   
   if (isset($glo_servidor)) 
   {
       $_SESSION['scriptcase']['glo_servidor'] = $glo_servidor;
   }
   if (isset($glo_banco)) 
   {
       $_SESSION['scriptcase']['glo_banco'] = $glo_banco;
   }
   if (isset($glo_tpbanco)) 
   {
       $_SESSION['scriptcase']['glo_tpbanco'] = $glo_tpbanco;
   }
   if (isset($glo_usuario)) 
   {
       $_SESSION['scriptcase']['glo_usuario'] = $glo_usuario;
   }
   if (isset($glo_senha)) 
   {
       $_SESSION['scriptcase']['glo_senha'] = $glo_senha;
   }
   if (isset($glo_senha_protect)) 
   {
       $_SESSION['scriptcase']['glo_senha_protect'] = $glo_senha_protect;
   }
   if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
   {
       $script_case_init = "";
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_iframe = false;
   if (isset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu']);
   }
   if (isset($nm_run_menu) && $nm_run_menu == 1)
   {
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && isset($_SESSION['scriptcase']['sc_apl_menu_atual']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if ($aba == $_SESSION['scriptcase']['sc_apl_menu_atual'])
                {
                    unset($_SESSION['scriptcase']['sc_aba_iframe'][$aba]);
                    break;
                }
            }
        }
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "bl_selecao_pagto_proc_compra";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'bl_selecao_pagto_proc_compra' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                    if (!empty($_SESSION['sc_session'][$script_case_init][$nome_apl]))
                    {
                        $achou = true;
                    }
                }
            }
            if (!$achou && isset($nm_apl_menu))
            {
                foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
                {
                    if ($nome_apl == $nm_apl_menu || $achou)
                    {
                        $achou = true;
                        if ($nome_apl != $nm_apl_menu)
                        {
                            unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                        }
                    }
                }
            }
        }
        $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['iframe_menu'] = $salva_iframe;
   }

   if (!isset($_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '.php'))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize'] = true;
   }
   else
   {
       $sReferer = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '.php'));
       $sReferer = substr($sReferer, strrpos($sReferer, '/') + 1);
       if ('bl_selecao_pagto_proc_compra' == $sReferer || 'bl_selecao_pagto_proc_compra_' == substr($sReferer, 0, 29))
       {
           $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize'] = false;
       }
       else
       {
           $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['initialize'] = true;
       }
   }

   $_POST['script_case_init'] = $script_case_init;
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'bl_selecao_pagto_proc_compra')
   {
       $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['bl_selecao_pagto_proc_compra']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/bl_selecao_pagto_proc_compra_erro.php");
   }
   if (!empty($nmgp_parms)) 
   { 
       $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
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
                nm_limpa_str_bl_selecao_pagto_proc_compra($cadapar[1]);
                if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                $Tmp_par   = $cadapar[0];;
                $$Tmp_par = $cadapar[1];
            }
            $ix++;
       }
       if (isset($acao_pagto_proc_compra)) 
       {
           $_SESSION['acao_pagto_proc_compra'] = $acao_pagto_proc_compra;
           nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["acao_pagto_proc_compra"]);
       }
       if (isset($proc_compra_id_corrente)) 
       {
           $_SESSION['proc_compra_id_corrente'] = $proc_compra_id_corrente;
           nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["proc_compra_id_corrente"]);
       }
       if (isset($escopo_pagto)) 
       {
           $_SESSION['escopo_pagto'] = $escopo_pagto;
           nm_limpa_str_bl_selecao_pagto_proc_compra($_SESSION["escopo_pagto"]);
       }
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0;  
   $contr_bl_selecao_pagto_proc_compra = new bl_selecao_pagto_proc_compra_apl();
   $contr_bl_selecao_pagto_proc_compra->controle();
//
   function nm_limpa_str_bl_selecao_pagto_proc_compra(&$str)
   {
   }
?>
