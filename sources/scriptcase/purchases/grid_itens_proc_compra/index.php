<?php
   include_once('grid_itens_proc_compra_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems2ima']         = "ems2ima";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems2med']         = "ems2med";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ticontrole2']         = "ticontrole2";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_dinamico']         = "dinamico";
   $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_log_imp_mysql']         = "log_imp_mysql";
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
    if(empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class grid_itens_proc_compra_ini
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
   var $link_form_itens_proc_compra;
   var $link_form_itens_proc_compra_amostra_edit;
   var $link_grid_anexos_proc_compra_item_cons;
   var $link_cons_itens_compra_alocado_cons;
   var $link_grid_anexos_proc_compra_item_amostra_cons_emb;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
   var $nm_limite_lin_res;
   var $nm_limite_lin_res_prt;
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
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_blocos  = array();
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
   var $nm_db_log_imp_mysql;
   var $nm_con_log_imp_mysql = array();
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "grid_itens_proc_compra"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "Importacao"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20160502"; 
      $this->nm_hr_criacao   = "172018"; 
      $this->nm_autor_alt    = "tadeu"; 
      $this->nm_dt_ult_alt   = "20260723"; 
      $this->nm_hr_ult_alt   = "160644"; 
      $this->Apl_paginacao   = "PARCIAL"; 
      $temp_bug_list         = explode(" ", microtime()); 
      list($NM_usec, $NM_sec) = $temp_bug_list; 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0";
      $this->nm_tp_variance  = "P";
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
      $this->path_prod       = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_doc'];
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
      if (!isset($_SESSION['scriptcase']['grid_itens_proc_compra']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['grid_itens_proc_compra']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['grid_itens_proc_compra']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['sub_cons_schema_filter'];
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
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/grid_itens_proc_compra';
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_chart_theme = $this->root . $this->path_link . "_lib/chart/";
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
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

      if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['grid_itens_proc_compra']['actual_lang']) || $_SESSION['scriptcase']['grid_itens_proc_compra']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['grid_itens_proc_compra']['actual_lang'] = $this->str_lang;
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
          include_once("grid_itens_proc_compra_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['ancor_save'] = $_POST['ancor_save'];
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      $Tmp_apl_lig = "form_itens_proc_compra";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/form_itens_proc_compra_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/form_itens_proc_compra_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["form_itens_proc_compra"] = 'S';
          }
      }
      $this->sc_lig_target["A_@scinf_"] = '_self';
      $this->sc_lig_target["A_@scinf__@scinf_form_itens_proc_compra"] = '_self';
      $Tmp_apl_lig = "cons_itens_compra_alocado";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/cons_itens_compra_alocado_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/cons_itens_compra_alocado_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["cons_itens_compra_alocado"] = 'S';
          }
      }
      $this->sc_lig_target["C_@scinf_qt_alocada"] = '_blank';
      $this->sc_lig_target["C_@scinf_qt_alocada_@scinf_cons_itens_compra_alocado"] = '_blank';
      $Tmp_apl_lig = "grid_anexos_proc_compra_item";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/grid_anexos_proc_compra_item_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/grid_anexos_proc_compra_item_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["grid_anexos_proc_compra_item"] = 'S';
          }
      }
      $this->sc_lig_target["C_@scinf_cp_anexo"] = '_blank';
      $this->sc_lig_target["C_@scinf_cp_anexo_@scinf_grid_anexos_proc_compra_item"] = '_blank';
      $Tmp_apl_lig = "grid_anexos_proc_compra_item_amostra";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/grid_anexos_proc_compra_item_amostra_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/grid_anexos_proc_compra_item_amostra_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["grid_anexos_proc_compra_item_amostra"] = 'S';
          }
      }
      $this->sc_lig_target["C_@scinf_sb_doctos"] = '_self';
      $this->sc_lig_target["C_@scinf_sb_doctos_@scinf_grid_anexos_proc_compra_item_amostra"] = '_self';
      $Tmp_apl_lig = "form_itens_proc_compra_amostra";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/form_itens_proc_compra_amostra_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/form_itens_proc_compra_amostra_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["form_itens_proc_compra_amostra"] = 'S';
          }
      }
      $this->sc_lig_target["C_@scinf_img_amostra_formato"] = 'modal';
      $this->sc_lig_target["C_@scinf_img_amostra_formato_@scinf_form_itens_proc_compra_amostra"] = 'modal';
      if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_itens_proc_compra"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_itens_proc_compra"] as $sTmpTargetLink => $sTmpTargetWidget)
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
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['link_info']['margin_top'] = $link_margin_top;
        }
      $this->link_form_itens_proc_compra =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('form_itens_proc_compra') . "/" ; 
      $this->link_form_itens_proc_compra_amostra_edit =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('form_itens_proc_compra_amostra') . "/" ; 
      $this->link_grid_anexos_proc_compra_item_cons =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('grid_anexos_proc_compra_item') . "/" ; 
      $this->link_cons_itens_compra_alocado_cons =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('cons_itens_compra_alocado') . "/" ; 
      $this->link_grid_anexos_proc_compra_item_amostra_cons_emb =  $this->root . $this->path_link  . "" . SC_dir_app_name('grid_anexos_proc_compra_item_amostra') . "/index.php" ; 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']);
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
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir']))
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['path_doc'] = $this->path_doc; 
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
          if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'])) 
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
      $this->Control_Css    = "coo";
      $this->path_atual     = getcwd();
      $opsys = strtolower(php_uname());

      $this->nm_cont_lin           = 0;
      $this->nm_limite_lin         = 0;
      $this->nm_limite_lin_prt     = 0;
      $this->nm_limite_lin_res     = 0;
      $this->nm_limite_lin_res_prt = 0;
// 
      include_once($this->path_aplicacao . "grid_itens_proc_compra_erro.class.php"); 
      $this->Erro = new grid_itens_proc_compra_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('grid_itens_proc_compra'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'])) 
      { 
          $bol_api_prod = false; 
      } 
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
      $this->Tree_img_type   = "kie";
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
      $this->arr_buttons_usr = array();

      $this->arr_buttons_usr['bt_log']['hint']             = "";
      $this->arr_buttons_usr['bt_log']['type']             = "button";
      $this->arr_buttons_usr['bt_log']['value']            = "Log's";
      $this->arr_buttons_usr['bt_log']['display']          = "only_text";
      $this->arr_buttons_usr['bt_log']['display_position'] = "text_right";
      $this->arr_buttons_usr['bt_log']['style']            = "default";
      $this->arr_buttons_usr['bt_log']['image']            = "";
      $this->str_google_fonts= isset($str_google_fonts)?$str_google_fonts:'';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'])) {
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
          if ($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir_tp'] == "R") {
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
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']);
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1DcXOZ9F7D1vOVWJwDMrYVcXKDWFYHMF7DcNmZSBOHArYZMJeDEBOVkJ3DWF/VoBiDcJUZSX7Z1BYHuFaDMvOV9FeV5X/VEBiHQJmZSBOD1rwHuJwHgvsHENiDuXKVoFGHQXOH9BiHAN7HQrqDMzGZSNiDWBmDoXGHQJmZSBOD1rKHQBiHgNKHErCV5B3VoFGHQFYDQFaD1vOVWJwDMrYDkB/DWB3VoBqD9BsZ1F7DSrYD5rqDMrYZSJ3V5B7ZuJsHQXOZ9XGD1BeHQrqDMNODkB/DWXKDoXGHQNwH9BqHABYHuJsHgNKHArCDuX/VoFGHQBiZ9XGD1NKVWJeDMrYVIBsDWXKDoXGHQBqZkFGHIrwD5JwHgNKHArsH5FGDoF7D9XsDQJsDSBYV5FGHgNKZSJ3HEBmDoBiHQNGVIraHArKHQrqDMzGDkFeDWF/VoFGD9NmDQX7HIBeVWJsHuvmVcFCDWXCDoJeDcJUZkFUHArKHQrqHgBOHEBUH5X/DoNUDcJeDQFGHANOD5JwHgNKVcrsH5FqDoX7D9BsH9FaHIBeV5FUHgvCHEFKDWF/ZuXGD9XsZSFGD1vOV5BiHgvsDkBODWFaDoJsDcBwZ1rqHArYD5JeDMzGHAFKDWF/VoB/D9JKDQFGD1veD5BOHgrKVcFCDWrmVoFaD9BsH9B/HAvmD5raDEvsHEFiDuJeVoB/D9XsDuBOHAveD5JeHuNODkFCDWrmVoFaD9BsZ1F7DSrYD5rqDMzGHEXeV5XCDoXGD9JKDQX7Z1N7D5XGDMrwZSrCH5FqDoJeD9JmZ1B/D1NaD5rqHgrKHArsHEXCHIrqHQXODuBqHIrKHQB/DMBOVcFiV5FYHMF7DcFYZkBiHAvCD5XGHgrKHEFKV5FqHIX7HQNwZSBiD1veHQJwDMNOVcFiV5FYHIraHQXOZSBODSrYHuB/HgBYHEFKH5FYVoX7D9JKDQX7D1BOV5FGDMzGV9BUHEF/VoBiHQXGH9BqZ1rYHuBqHgrKHEFKV5FqHMJsHQBiZSFUHABYHuBiDMvmZSJ3V5FYHIJeHQBiZ1FGD1zGD5XGHgveDkFeV5FqHMX7HQJKH9FUD1veHuJeDMBOVcFiH5FqDoJeD9JmZ1B/D1NaD5rqHgvsHErsHEXCHIJwHQJKDuFaHAN7HQBODMBYZSrCV5FYHMJsHQBiZ1X7D1zGZMBqHgBeDkBsV5FqHMFGDcXGH9BiD1veHQB/DMBYV9FiV5FYHINUHQBqZkFGHAN7HuXGHgBYHAFKH5FYVoX7D9JKDQX7D1BOV5FGHuzGDkBOH5FqVoJwD9XOZ1F7HABYZMB/DEBeHENiV5XKDoB/D9NmH9X7HArYV5BODMrwDkFCDuX7VEF7D9BiVIJwZ1BeD5rqDEBOHEFiHEFqVoB/D9XsH9FGD1veV5BqDMrwDkBOH5FqDoJeD9JmZ1B/HArYV5FUDEvsHErsDWFGDoB/D9NmZSX7HABYV5X7DMrYZSJ3V5X7VEF7DcJUZ1B/HAvCD5FaDErKZSXeH5X/ZuXGHQJeDQBOZ1NaV5FGHuNOVcFKHEFYVoBqDcBwH9FaD1rwD5rqDMNKZSXeDuJeDoB/D9NwZSFGD1veV5raHgrKVcBOV5FYVoB/D9JmZ1B/HIrwHQJwDEBODkFeH5FYVoFGHQJKDQFaHIrKV5BqHgrwVcFKH5FqHIFGD9XGZ1B/D1rKV5JwDMzGHErsH5FYHMJsD9XsDuBOZ1zGVWJsDMvOVIBsDWXCDoJsDcBwH9B/Z1rYHQJwHgvCZSXeDuFaDoJeD9JKDQX7D1veV5raHuvmVcFCH5XCDoraD9BsZSFaD1rwD5BiDErKHEBUDWr/DoB/DcJeZSFUZ1rwV5FGHuNODkBOV5FYVorqD9XOZSB/HAzGV5FUDErKHEFiDuJeDoBOHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHMBiD9BsVIraD1rwV5X7HgBeHErCH5F/DoJeHQNwH9X7HIBeV5BOHuNOVcFeHEF/DoX7D9JmZ1FaHANOHQrqDMzGVkJGDWF/HMBqHQXsZSFGHANOHuFaHuNOZSrCH5FqDoXGHQJmZ1rqD1rwD5F7DMNKZSXeDWr/DoJeD9XsZSX7Z1N7VWFaHgrKV9FeDWXCDoJsDcBwH9B/Z1rYHQJwHgveDkXKDWBmDoJeHQXOZ9XGHANKVWXGDMvOZSNiH5FqHMBiD9BsVIraD1rwV5X7HgBeHErCDWrGDoBOHQBiH9FUDSzGV5JeDMNOVcXKDWF/VorqHQXOZkFUZ1rYHuJwHgNKZSJqDWXCVoJsHQNmDuBqHAN7HuFaHuNOZSrCH5FqDoXGHQJmZ1FGZ1rYV5FaDMzGHEBUH5F/VoB/D9FYDQJwD1veD5BqHuNOVcFiDWXCHMBqD9BsZ1FaHArKD5FaDErKVkJGH5F/DoraVQBwVIB/D1BeV5JwHgNKVcFKH5XKVoFaHQBsZ1FaHIveD5BqDEBOZSJGDWr/ZuFaDcJeZ9FaHIrYV5FGHuNOZSJ3DWXCHIrqD9BiZ1F7D1rKD5NUHgBeHEFiV5B3DoF7D9XsDuFaHANKVWBqDMrwZSNiDWB3VEB/";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['initialize'])  
      { 
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['Gera_log_access'] = true;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['initialize']      = false;
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
          if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'])) 
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
          $this->nm_tabela = "pub.itens_proc_compra"; 
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
      $_SESSION['sc_session'][$script_case_init]['grid_anexos_proc_compra_item_amostra']['ind_tree'] = 0;
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
              if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']) && $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil']) && $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']))
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
          $this->nm_con_especw['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_especw['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_especw['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_especw['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_especw['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_ems5['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ems5['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ems5['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ems5['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ems5['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_ems2ima['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ems2ima['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ems2ima['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ems2ima['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ems2ima['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_ems2med['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ems2med['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ems2med['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ems2med['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ems2med['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_comum['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_comum['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_comum['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_comum['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_comum['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_multi['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_multi['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_multi['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_multi['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_multi['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_cfsc['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_cfsc['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_cfsc['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_cfsc['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_cfsc['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_log_db['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_log_db['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_log_db['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_log_db['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_log_db['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_ticontrole2['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ticontrole2['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ticontrole2['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ticontrole2['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ticontrole2['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_ima['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ima['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ima['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ima['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ima['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_med['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_med['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_med['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_med['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_med['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_geral['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_geral['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_geral['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_geral['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_geral['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_dinamico['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_dinamico['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_dinamico['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_dinamico['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_dinamico['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
          $this->nm_con_log_imp_mysql['nm_con_db2'] = array(); 
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
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_log_imp_mysql['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_log_imp_mysql['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_log_imp_mysql['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_log_imp_mysql['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
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
      if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems2ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ems2med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ticontrole2'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_con_log_imp_mysql'], $this->path_libs, "S", $this->path_conf);
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida_init']) 
      {
          if (!isset($_SESSION['proc_compra_corrente'])) 
          {
              $this->nm_falta_var .= "proc_compra_corrente; ";
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date1'];
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
          $trab_path             = explode("/", $_SERVER['PHP_SELF']);
          $trab_count_path       = count($trab_path);
          $path_retorno_aplicacao  = "";
          for ($ix = 0; $ix + 2 < $trab_count_path; $ix++)
          {
               $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
          }
          $path_retorno_aplicacao .=  "" . SC_dir_app_name('bl_timeout') . "/";
          $nm_redirect = $path_retorno_aplicacao . "?nmgp_url_saida=" . $_SERVER['PHP_SELF'] . "&nmgp_redir=redir&script_case_init=" . NM_encode_input($this->sc_page);
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['volta_redirect_apl'] = $_SESSION['scriptcase']['sc_url_saida'][$this->sc_page]; 
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['volta_redirect_tp']  = $nm_apl_dependente; 
?> 
 <SCRIPT>
   document.location = "<?php echo $nm_redirect; ?>";
 </SCRIPT>
<?php
          exit;
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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_conexao'], $this->root . $this->path_prod, 'Importacao', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida'])
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_especw['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_especw['nm_arr_db_extra_args'])?$this->nm_con_especw['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_especw['nm_con_db2'])?$this->nm_con_especw['nm_con_db2']:array();
      $this->nm_db_especw = db_conect($this->nm_con_especw['tpbanco'], $this->nm_con_especw['servidor'], $this->nm_con_especw['usuario'], $this->nm_con_especw['senha'], $this->nm_con_especw['banco'], $this->nm_con_especw['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_ems5['nm_con_db2'])?$this->nm_con_ems5['nm_con_db2']:array();
      $this->nm_db_ems5 = db_conect($this->nm_con_ems5['tpbanco'], $this->nm_con_ems5['servidor'], $this->nm_con_ems5['usuario'], $this->nm_con_ems5['senha'], $this->nm_con_ems5['banco'], $this->nm_con_ems5['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_ems2ima['nm_con_db2'])?$this->nm_con_ems2ima['nm_con_db2']:array();
      $this->nm_db_ems2ima = db_conect($this->nm_con_ems2ima['tpbanco'], $this->nm_con_ems2ima['servidor'], $this->nm_con_ems2ima['usuario'], $this->nm_con_ems2ima['senha'], $this->nm_con_ems2ima['banco'], $this->nm_con_ems2ima['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_ems2med['nm_con_db2'])?$this->nm_con_ems2med['nm_con_db2']:array();
      $this->nm_db_ems2med = db_conect($this->nm_con_ems2med['tpbanco'], $this->nm_con_ems2med['servidor'], $this->nm_con_ems2med['usuario'], $this->nm_con_ems2med['senha'], $this->nm_con_ems2med['banco'], $this->nm_con_ems2med['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_comum['nm_con_db2'])?$this->nm_con_comum['nm_con_db2']:array();
      $this->nm_db_comum = db_conect($this->nm_con_comum['tpbanco'], $this->nm_con_comum['servidor'], $this->nm_con_comum['usuario'], $this->nm_con_comum['senha'], $this->nm_con_comum['banco'], $this->nm_con_comum['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_multi['nm_con_db2'])?$this->nm_con_multi['nm_con_db2']:array();
      $this->nm_db_multi = db_conect($this->nm_con_multi['tpbanco'], $this->nm_con_multi['servidor'], $this->nm_con_multi['usuario'], $this->nm_con_multi['senha'], $this->nm_con_multi['banco'], $this->nm_con_multi['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_cfsc['nm_con_db2'])?$this->nm_con_cfsc['nm_con_db2']:array();
      $this->nm_db_cfsc = db_conect($this->nm_con_cfsc['tpbanco'], $this->nm_con_cfsc['servidor'], $this->nm_con_cfsc['usuario'], $this->nm_con_cfsc['senha'], $this->nm_con_cfsc['banco'], $this->nm_con_cfsc['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_log_db['nm_con_db2'])?$this->nm_con_log_db['nm_con_db2']:array();
      $this->nm_db_log_db = db_conect($this->nm_con_log_db['tpbanco'], $this->nm_con_log_db['servidor'], $this->nm_con_log_db['usuario'], $this->nm_con_log_db['senha'], $this->nm_con_log_db['banco'], $this->nm_con_log_db['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_ticontrole2['nm_con_db2'])?$this->nm_con_ticontrole2['nm_con_db2']:array();
      $this->nm_db_ticontrole2 = db_conect($this->nm_con_ticontrole2['tpbanco'], $this->nm_con_ticontrole2['servidor'], $this->nm_con_ticontrole2['usuario'], $this->nm_con_ticontrole2['senha'], $this->nm_con_ticontrole2['banco'], $this->nm_con_ticontrole2['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_ima['nm_con_db2'])?$this->nm_con_ima['nm_con_db2']:array();
      $this->nm_db_ima = db_conect($this->nm_con_ima['tpbanco'], $this->nm_con_ima['servidor'], $this->nm_con_ima['usuario'], $this->nm_con_ima['senha'], $this->nm_con_ima['banco'], $this->nm_con_ima['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_med['nm_con_db2'])?$this->nm_con_med['nm_con_db2']:array();
      $this->nm_db_med = db_conect($this->nm_con_med['tpbanco'], $this->nm_con_med['servidor'], $this->nm_con_med['usuario'], $this->nm_con_med['senha'], $this->nm_con_med['banco'], $this->nm_con_med['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_geral['nm_con_db2'])?$this->nm_con_geral['nm_con_db2']:array();
      $this->nm_db_geral = db_conect($this->nm_con_geral['tpbanco'], $this->nm_con_geral['servidor'], $this->nm_con_geral['usuario'], $this->nm_con_geral['senha'], $this->nm_con_geral['banco'], $this->nm_con_geral['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $nm_con_db2 = isset($this->nm_con_dinamico['nm_con_db2'])?$this->nm_con_dinamico['nm_con_db2']:array();
      $this->nm_db_dinamico = db_conect($this->nm_con_dinamico['tpbanco'], $this->nm_con_dinamico['servidor'], $this->nm_con_dinamico['usuario'], $this->nm_con_dinamico['senha'], $this->nm_con_dinamico['banco'], $this->nm_con_dinamico['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_log_imp_mysql['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_log_imp_mysql['nm_arr_db_extra_args'])?$this->nm_con_log_imp_mysql['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_log_imp_mysql['nm_con_db2'])?$this->nm_con_log_imp_mysql['nm_con_db2']:array();
      $this->nm_db_log_imp_mysql = db_conect($this->nm_con_log_imp_mysql['tpbanco'], $this->nm_con_log_imp_mysql['servidor'], $this->nm_con_log_imp_mysql['usuario'], $this->nm_con_log_imp_mysql['senha'], $this->nm_con_log_imp_mysql['banco'], $this->nm_con_log_imp_mysql['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
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
      if (!$_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['embutida'])
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
       eval ('set'.$this->Control_Css.$this->Tree_img_type.'("'.$this->nm_script_type.'SESSID_",base64_encode("'.$this->nm_script_by.'?".substr(md5(mt_rand()),8,16)),time()+86400,\'/\', \'\', ini_get(\'session.cookie_secure\'), ini_get(\'session.cookie_httponly\'));');
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date1'];
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
       if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_proc_compra', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
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
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_proc_compra']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
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
       elseif ($format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       elseif ($format == 'YYYYWEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = (strlen($rs->fields[$ind_ini + 1]) == 1) ? $rs->fields[$ind_ini] . "0" . $rs->fields[$ind_ini + 1] : $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
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
class grid_itens_proc_compra_sub_css
{
   function __construct()
   {
      global $script_case_init;
      if (!$this->Ini) 
      { 
          $this->Ini = new grid_itens_proc_compra_ini(); 
          $this->Ini->init("Path_sub");
      } 
      $_SESSION['sc_session'][$script_case_init]['grid_anexos_proc_compra_item_amostra']['SC_herda_css'] = "S"; 
      $_SESSION['sc_session'][$script_case_init]['grid_anexos_proc_compra_item_amostra']['embutida'] = true;
      include_once ($this->Ini->link_grid_anexos_proc_compra_item_amostra_cons_emb);
      $this->grid_anexos_proc_compra_item_amostra = new grid_anexos_proc_compra_item_amostra_sub_css ;
      $_SESSION['sc_session'][$script_case_init]['grid_anexos_proc_compra_item_amostra']['embutida'] = false;
      $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if ($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['SC_herda_css'] == "N")
      {
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css']['grid_itens_proc_compra']    = $str_schema_all . "_grid.css";
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css_bw']['grid_itens_proc_compra'] = $str_schema_all . "_grid_bw.css";
      }
   }
}
//
class grid_itens_proc_compra_apl
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Lookup;
   var $nm_location;
   var $NM_ajax_flag  = false;
   var $NM_ajax_opcao = '';
   var $grid;
   var $Res;
   var $Graf;
   var $pdf;
   var $xls;
   var $xml;
   var $json;
   var $csv;
   var $rtf;
//
//----- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini = $this->Ini;
      $this->$modulo->Db = $this->Db;
      $this->$modulo->Erro = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
      $this->$modulo->arr_buttons = $this->arr_buttons;
   }
//

function getPaddingFromCss($cssRule)
{
    $paddingInfo = [
        'top' => '',
        'bottom' => '',
        'left' => '',
        'right' => '',
    ];

    $cssRuleParts = explode(' ', trim($cssRule));
    $partsCount = count($cssRuleParts);

    if (4 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[2];
        $paddingInfo['left'] = $cssRuleParts[3];
    } elseif (3 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[2];
        $paddingInfo['left'] = $cssRuleParts[1];
    } elseif (2 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[0];
        $paddingInfo['left'] = $cssRuleParts[1];
    } else {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[0];
        $paddingInfo['bottom'] = $cssRuleParts[0];
        $paddingInfo['left'] = $cssRuleParts[0];
    }

    return $paddingInfo;
}

//----- 
   function controle($linhas = 0)
   {
      global $nm_saida, $nm_url_saida, $script_case_init, $nmgp_parms_pdf, $nmgp_graf_pdf, $nm_apl_dependente, $nmgp_navegator_print, $nmgp_tipo_print, $nmgp_cor_print, $nmgp_cor_word, $Det_use_pass_pdf, $Det_pdf_zip, $NMSC_conf_apl, $NM_contr_var_session, $NM_run_iframe, $SC_module_export, $nmgp_password,
             $glo_senha_protect, $nmgp_opcao, $nm_call_php, $rec, $nmgp_quant_linhas, $nmgp_fast_search, $nmgp_cond_fast_search, $nmgp_arg_fast_search, $nmgp_ordem;

      $Parms_form_pdf = false;
      if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_proc_compra']))
      { 
          $GLOBALS['nmgp_parms'] = $_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_proc_compra'];
          $Parms_form_pdf = true;
      } 
      if ($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'] || $Parms_form_pdf)
      { 
          if (!empty($GLOBALS['nmgp_parms'])) 
          { 
              $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
              $todo  = explode("?@?", $todox);
              foreach ($todo as $param)
              {
                   $cadapar = explode("?#?", $param);
                   if (1 < sizeof($cadapar))
                   {
                       if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                       {
                           $cadapar[0] = substr($cadapar[0], 11);
                           $cadapar[1] = $_SESSION[$cadapar[1]];
                       }
                       if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                       {
                           $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                       }
                       elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                       {
                           $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                       }
                       nm_limpa_str_grid_itens_proc_compra($cadapar[1]);
                       nm_protect_num_grid_itens_proc_compra($cadapar[0], $cadapar[1]);
                       if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                       $Tmp_par   = $cadapar[0];
                       $$Tmp_par = $cadapar[1];
                       if ($Tmp_par == "nmgp_opcao")
                       {
                           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = $cadapar[1];
                       }
                   }
              }
          } 
          if (isset($proc_compra_corrente)) 
          {
              $_SESSION['proc_compra_corrente'] = $proc_compra_corrente;
              nm_limpa_str_grid_itens_proc_compra($_SESSION["proc_compra_corrente"]);
          }
      } 
      if ($Parms_form_pdf)
      { 
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_pdf'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_full'] = false;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_pai'] = "";
      } 
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      if (!$this->Ini || isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_ibase'])) 
      { 
          $this->Ini = new grid_itens_proc_compra_ini(); 
          $this->Ini->init();
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_ibase'] = true;
      }
      $this->Ini->Proc_print      = false;
      $this->Ini->Export_det_zip  = false;
      $this->Ini->Export_html_zip = false;
      $this->Ini->Export_zip      = false;
      $this->Ini->Export_img_zip  = false;
      $this->Ini->Img_export_zip  = array();
      $this->Ini->Embutida_iframe = (strpos($this->Ini->sc_page, "-") !== false) ? true : false;
      $this->Ini->Init_apl_lig = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['emb_lig_aba'] = array();
      $this->Change_Menu = false;
      if (!isset($nmgp_opcao)) {
         $nmgp_opcao = "";
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'])) {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "";
      }
      if ($nmgp_opcao != "ajax_navigate" && $nmgp_opcao != "ajax_detalhe" && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['sc_outra_jan'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['sc_modal']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_itens_proc_compra']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_itens_proc_compra'];
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'] && $this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_proc_compra']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_proc_compra']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('grid_itens_proc_compra') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_proc_compra']['label'] = "Itens do Pedido de Importação(grid_itens_proc_compra)";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "grid_itens_proc_compra")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          $this->Change_Menu = false;
      }
      $this->Db = $this->Ini->Db; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['nm_tpbanco'] = $this->Ini->nm_tpbanco;
      $this->nm_data = new nm_data("pt_br");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      { 
          include_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_erro.class.php"); 
      } 
      else 
      { 
          include_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_erro.class.php"); 
      } 
      $this->Erro      = new grid_itens_proc_compra_erro();
      $this->Erro->Ini = $this->Ini;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      { 
          require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_lookup.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_lookup.class.php"); 
      } 
      $this->Lookup       = new grid_itens_proc_compra_lookup();
      $this->Lookup->Db   = $this->Db;
      $this->Lookup->Ini  = $this->Ini;
      $this->Lookup->Erro = $this->Erro;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          $this->Ini->sc_Include($this->Ini->path_libs . "/nm_trata_saida.php", "C", "nm_trata_saida") ; 
          $nm_saida = new nm_trata_saida();
          $ajax_opc_print = false;
          if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_export")
          {
              $this->Ini->sc_export_ajax = true;
              $this->Ini->Arr_result     = array();
              $nmgp_opcao                = $_POST['export_opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = $nmgp_opcao;
              if ($nmgp_opcao == "print" || $nmgp_opcao == "res_print" || $nmgp_opcao == "det_print")
              {
                  $ajax_opc_print   = true;
                  $nm_arquivo_print = "/sc_grid_itens_proc_compra_" . session_id();
                  $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
                  $this->Ini->sc_export_ajax_img = true;
              }
              ob_start();
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          $_SESSION['scriptcase']['saida_var'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['ajax_nav'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['scroll_navigate'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['scroll_navigate_reload'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['scroll_navigate_app'] = false;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['scroll_navigate_header_row']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['scroll_navigate_header_row'] = 1;
          }
          if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_navigate" || $_POST['nmgp_opcao'] == "ajax_detalhe"))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['ajax_nav'] = true;
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $this->Ini->Arr_result = array();
              $nmgp_opcao = $_POST['opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = $nmgp_opcao;
              if (isset($_POST['parm']) && $_POST['parm'] == "save_grid")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['save_grid'] = true;
              }
              if ($nmgp_opcao == "edit" && isset($_POST['parm']) && $_POST['parm'] == "fim")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "rec" || $nmgp_opcao == "muda_rec_linhas")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "muda_qt_linhas")
              {
                  $nmgp_quant_linhas  = strtolower($_POST['parm']);
              }
              if (($_POST['opc'] == "igual" || $_POST['opc'] == "resumo") && isset($_POST['parm']) && ($_POST['parm'] == "reload" || $_POST['parm'] == "breload"))
              {
                  $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['contr_total_geral'] = "NAO";
                  $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['contr_array_resumo'] = "NAO";
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['tot_geral']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['arr_total']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['using_summary_cache']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_group_by']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_x_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_y_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_fill']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_order']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_order_col']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_order_level']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_order_sort']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['pivot_tabular']);
              }
              if ($nmgp_opcao == "fast_search")
              {
                  $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
                  $temp = explode("_SCQS_", $_POST['parm']);
                  $nmgp_fast_search      = (isset($temp[0])) ? $temp[0] : "";
                  $nmgp_cond_fast_search = (isset($temp[1])) ? $temp[1] : "";
                  $nmgp_arg_fast_search  = (isset($temp[2])) ? $temp[2] : "";
              }
              if ($nmgp_opcao == "ordem")
              {
                  $nmgp_ordem = $_POST['parm'];
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Gb_date_format'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Gb_date_format'] = array();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_All_Groupby'] = array('sc_free_total' => 'grid');
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Groupby_hide'])) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Groupby_hide'] = array();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'])) 
      { 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_All_Groupby'] as $Ind => $Tp)
          {
              if (!in_array($Ind, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Groupby_hide'])) 
              { 
                  break;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'] = $Ind;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['Labels_GB'] = array();
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'] == "sc_free_total")
      {
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['all']['SC_Ind_Groupby'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['all']['SC_Ind_Groupby'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Gb_Free_cmp']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Gb_Free_cmp'];
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_display'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_order']   = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_control'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['pivot_x_axys']               = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_display']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_display'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_display'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_order']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_order'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_control']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['summarizing_fields_control'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['summarizing_fields_control'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pivot_x_axys']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dados_orig_gb']['res']['pivot_x_axys'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pivot_x_axys'];
          }
      }
      $this->Ini->Apl_resumo  = "grid_itens_proc_compra_resumo_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'] . ".class.php"; 
      $this->Ini->Apl_grafico = "grid_itens_proc_compra_grafico_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_Ind_Groupby'] . ".class.php"; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['Gera_log_access'])
      {
          $this->Ini->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['Gera_log_access'] = false;
      }
      $_SESSION['sc_session']['path_third'] = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['real_path_third'] = $this->Ini->path_third;
      $_SESSION['sc_session']['path_prod']  = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['path_img']   = $this->Ini->path_img_global;
      $_SESSION['sc_session']['path_libs']  = $this->Ini->path_libs;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['xls_return']  = ($nmgp_opcao == "xls")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['csv_return']  = ($nmgp_opcao == "csv")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['xml_return']  = ($nmgp_opcao == "xml")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['json_return'] = ($nmgp_opcao == "json") ? "volta_grid" : "resumo"; 
      $this->Ini->SC_module_export = (isset($SC_module_export) && !empty($SC_module_export)) ? $SC_module_export : "grid"; 
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'print')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf_res')
      { 
          $this->Ini->SC_module_export = "";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'res_print')
      { 
          $this->Ini->SC_module_export = "";
      }
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls_res')
      { 
          $this->Ini->SC_module_export = "";
      }
      if ($nmgp_opcao == 'print' || $nmgp_opcao == 'res_print') {
          $this->Ini->Proc_print = true;
          if (!empty($nmgp_password)) {
              $this->Ini->Export_html_zip = true;
          }
          $_SESSION['scriptcase']['proc_mobile'] = false;
          if ($nmgp_opcao == 'print') {
              $this->ret_print = "volta_grid";
          }
          else {
              $this->ret_print = "resumo";
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_return'] = $this->ret_print;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
          if ($this->Ini->Export_html_zip)
          {
              $this->Ini->Export_img_zip = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['html_name']))
              {
                  $nm_arquivo_html = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['html_name'];
              }
              elseif ($nmgp_opcao == 'print' && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
              {
                  $nm_arquivo_html = "/sc_grid_itens_proc_compra_" . session_id() . ".html";
              }
              else
              {
                  $nm_arquivo_html = "/sc_grid_itens_proc_compra_res_" . session_id() . ".html";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html);
          }
      }
      if ($nmgp_opcao == "doc_word") {  
          $this->ret_word = "volta_grid";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res") {  
          $this->ret_word = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "doc_word"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "doc_word"; 
      }
      elseif ($nmgp_opcao == "doc_word" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "doc_word_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "doc_word_res"; 
      }
      if ($nmgp_opcao == "xls_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xls"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "xls"; 
      }
      elseif ($nmgp_opcao == "xls" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xls_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "xls_res"; 
      }
      if ($nmgp_opcao == "csv_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "csv"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "csv"; 
      }
      elseif ($nmgp_opcao == "csv" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "csv_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "csv_res"; 
      }
      if ($nmgp_opcao == "xml_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xml"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "xml"; 
      }
      elseif ($nmgp_opcao == "xml" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xml_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "xml_res"; 
      }
      if ($nmgp_opcao == "json_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "json"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "json"; 
      }
      elseif ($nmgp_opcao == "json" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "json_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "json_res"; 
      }
      $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_charts'] = (strpos(" " . $this->Ini->SC_module_export, "chart") !== false) ? false : true;
      $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_summary'] = false;
      if ('chart' == $this->Ini->SC_module_export) {
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_summary'] = true;
          $this->Ini->SC_module_export = 'resume,chart';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_det'] = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['conf_chart_level'] = "S";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida']      = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_grid']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_grid'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_init']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_init'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_label']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_label'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['cab_embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['cab_embutida'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_pdf']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_pdf'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_treeview']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_treeview'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_opcao']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida_opcao'] = "";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['proc_pdf'] = (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'] && ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "pdf_res")) ? true : false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['proc_pdf']) {
          $_SESSION['scriptcase']['proc_mobile'] = false;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['proc_pdf_vert'] = false;
      include("../_lib/css/" . $this->Ini->str_schema_all . "_grid.php");
      $this->Ini->Tree_img_col    = trim($str_tree_col);
      $this->Ini->Tree_img_exp    = trim($str_tree_exp);
      $this->Ini->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->Ini->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Ini->str_chart_theme = (isset($str_chart_theme)?$str_chart_theme:'');
      $this->Ini->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Ini->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_2']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_settings'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_settings'] . "",
          'type'             => "button",
          'display'          => "text_img",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__gear.png",
          'fontawesomeicon'  => "",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      { 
      $this->Ini->Img_sep_grid             = "/" . trim($str_toolbar_separator);
      $this->Ini->grid_table_width         = (!isset($str_grid_table_width) || "" == trim($str_grid_table_width)) ? "" : $str_grid_table_width;
      $this->Ini->Label_sort_pos           = trim($str_label_sort_pos);
      $this->Ini->Label_sort               = trim($str_label_sort);
      $this->Ini->Label_sort_asc           = trim($str_label_sort_asc);
      $this->Ini->Label_sort_desc          = trim($str_label_sort_desc);
      $this->Ini->Label_summary_sort_pos   = trim($str_resume_label_sort_pos);
      $this->Ini->Label_summary_sort       = trim($str_resume_label_sort);
      $this->Ini->Label_summary_sort_asc   = trim($str_resume_label_sort_asc);
      $this->Ini->Label_summary_sort_desc  = trim($str_resume_label_sort_desc);
      $this->Ini->Sum_ico_line             = trim($sum_ico_line);
      $this->Ini->Sum_ico_column           = trim($sum_ico_column);
      $this->Ini->ajax_div_icon            = trim($ajax_div_icon);
      $this->Ini->Str_toolbarnav_separator = '/' . trim($str_toolbarnav_separator);
      $this->Ini->Img_qs_search            = '' != trim($img_qs_search)        ? trim($img_qs_search)        : 'scriptcase__NM__qs_lupa.png';
      $this->Ini->Img_qs_clean             = '' != trim($img_qs_clean)         ? trim($img_qs_clean)         : 'scriptcase__NM__qs_close.png';
      $this->Ini->Str_qs_image_padding     = '' != trim($str_qs_image_padding) ? trim($str_qs_image_padding) : '0';
      $this->Ini->App_div_tree_img_col     = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp     = trim($app_div_str_tree_exp);
      $this->Ini->Bubble_tail              = trim($str_bubble_tail);
      $this->Ini->refinedsearch_hide       = trim($refinedsearch_hide);
      $this->Ini->refinedsearch_show       = trim($refinedsearch_show);
      $this->Ini->refinedsearch_close      = trim($refinedsearch_close);
      $this->Ini->refinedsearch_values_separator          = trim($refinedsearch_values_separator);
      $this->Ini->refinedsearch_campo_close_icon          = trim($refinedsearch_campo_close_icon);
      $this->Ini->grid_moldura_padding = $this->getPaddingFromCss($grid_moldura_padding);
      $this->Ini->grid_table_margin = $this->getPaddingFromCss($grid_table_margin);
      $this->Ini->grid_link_margin_top = '';
      if ('' != $this->Ini->grid_table_margin['top']) {
          $this->Ini->grid_link_margin_top = $this->Ini->grid_table_margin['top'];
      } elseif ('' != $this->Ini->grid_moldura_padding['top']) {
          $this->Ini->grid_link_margin_top = $this->Ini->grid_moldura_padding['top'];
      }
          $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput") ; 
          $_SESSION['scriptcase']['css_popup']                 = $this->Ini->str_schema_all . "_grid.css";
          $_SESSION['scriptcase']['css_popup_dir']             = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_btn_popup']             = $this->Ini->Str_btn_css;
          $_SESSION['scriptcase']['str_google_fonts']          = $this->Ini->str_google_fonts;
          $_SESSION['scriptcase']['css_popup_tab']             = $this->Ini->str_schema_all . "_tab.css";
          $_SESSION['scriptcase']['css_popup_tab_dir']         = $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_popup_div']             = $this->Ini->str_schema_all . "_appdiv.css";
          $_SESSION['scriptcase']['css_popup_div_dir']         = $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['bg_btn_popup']['bok']       = nmButtonOutput($this->arr_buttons, "bok_appdiv", "processa();", "processa();", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['bsair']     = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "window.close()", "window.close()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove()", "self.parent.tb_remove()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "img_amostra_formato";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "cp_anexo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "item_proc_compra_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "descricao";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "codigo_erp";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "qt_dias_producao";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "unid_medida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "vl_custo_dolar";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "vl_negociado";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "qt_comprada";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "tot_custo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "tot_custo_negoc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "qt_alocada";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "qt_saldo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "dt_item_certificacao";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'][] = "sb_doctos";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'];
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['usr_cmp_sel']))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['usr_cmp_sel'] = array();
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['usr_cmp_sel_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['usr_cmp_sel'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_itens_proc_compra']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_proc_compra']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_proc_compra']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_page_process'] = $this->Ini->sc_page;
      } 
      $_SESSION['scriptcase']['sc_idioma_pivot']['pt_br'] = array(
          'smry_ppup_titl'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_titl'],
          'smry_ppup_fild'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_fild'],
          'smry_ppup_posi'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi'],
          'smry_ppup_sort'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort'],
          'smry_ppup_posi_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_labl'],
          'smry_ppup_posi_data' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_data'],
          'smry_ppup_sort_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_labl'],
          'smry_ppup_sort_vlue' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_vlue'],
          'smry_ppup_chek_tabu' => $this->Ini->Nm_lang['lang_othr_smry_ppup_chek_tabu'],
      );
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
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      { 
          $this->pdf_zip = (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_pdf']['pdf_zip'])) ? $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_pdf']['pdf_zip'] : "N";
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['use_pass_pdf'] = "";
          $_SESSION['scriptcase']['sc_tp_pdf'] = "wkhtmltopdf";
          $_SESSION['scriptcase']['sc_idioma_pdf'] = array();
          $_SESSION['scriptcase']['sc_idioma_pdf']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_pdff_titl'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'tp_imp' => $this->Ini->Nm_lang['lang_pdff_type'], 'color' => $this->Ini->Nm_lang['lang_pdff_colr'], 'econm' => $this->Ini->Nm_lang['lang_pdff_bndw'], 'tp_pap' => $this->Ini->Nm_lang['lang_pdff_pper'], 'carta' => $this->Ini->Nm_lang['lang_pdff_letr'], 'oficio' => $this->Ini->Nm_lang['lang_pdff_legl'], 'customiz' => $this->Ini->Nm_lang['lang_pdff_cstm'], 'alt_papel' => $this->Ini->Nm_lang['lang_pdff_pper_hgth'], 'larg_papel' => $this->Ini->Nm_lang['lang_pdff_pper_wdth'], 'orient' => $this->Ini->Nm_lang['lang_pdff_pper_orie'], 'retrato' => $this->Ini->Nm_lang['lang_pdff_prtr'], 'paisag' => $this->Ini->Nm_lang['lang_pdff_lnds'], 'book' => $this->Ini->Nm_lang['lang_pdff_bkmk'], 'grafico' => $this->Ini->Nm_lang['lang_pdff_chrt'], 'largura' => $this->Ini->Nm_lang['lang_pdff_wdth'], 'fonte' => $this->Ini->Nm_lang['lang_pdff_font'], 'create' => $this->Ini->Nm_lang['lang_pdff_create'], 'sim' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'nao' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'group_chart' => $this->Ini->Nm_lang['lang_pdff_group_chart'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd'], 'page_break' => $this->Ini->Nm_lang['lang_groupby_break_page_pdf'], 'other_options' => $this->Ini->Nm_lang['lang_app_other_options'], 'label_group' => $this->Ini->Nm_lang['lang_pdf_below_groupby'], 'page_label' => $this->Ini->Nm_lang['lang_pdf_all_pages_title'], 'page_header' => $this->Ini->Nm_lang['lang_pdf_all_pages_header'], 'format_zip' => $this->Ini->Nm_lang['lang_export_pdf_zip'], 'cancela' => $this->Ini->Nm_lang['lang_pdff_cncl']);
      } 
      $_SESSION['scriptcase']['sc_idioma_graf_flash'] = array();
      $_SESSION['scriptcase']['sc_idioma_graf_flash']['pt_br'] = array(
          'titulo' => $this->Ini->Nm_lang['lang_chrt_titl'],
          'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'],
          'tipo_g' => $this->Ini->Nm_lang['lang_chrt_type'],
          'tp_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars'],
          'tp_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie'],
          'tp_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line'],
          'tp_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area'],
          'tp_marcador' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks'],
          'tp_gauge' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug'],
          'tp_radar' => $this->Ini->Nm_lang['lang_flsh_chrt_radr'],
          'tp_polar' => $this->Ini->Nm_lang['lang_flsh_chrt_polr'],
          'tp_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_funl'],
          'tp_pyramid' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm'],
          'largura' => $this->Ini->Nm_lang['lang_chrt_wdth'],
          'altura' => $this->Ini->Nm_lang['lang_chrt_hgth'],
          'modo_gera' => $this->Ini->Nm_lang['lang_chrt_gtmd'],
          'sintetico' => $this->Ini->Nm_lang['lang_chrt_smzd'],
          'analitico' => $this->Ini->Nm_lang['lang_chrt_anlt'],
          'order' => $this->Ini->Nm_lang['lang_chrt_ordr'],
          'order_none' => $this->Ini->Nm_lang['lang_chrt_ordr_none'],
          'order_asc' => $this->Ini->Nm_lang['lang_chrt_ordr_asc'],
          'order_desc' => $this->Ini->Nm_lang['lang_chrt_ordr_desc'],
          'limit_chart_items' => $this->Ini->Nm_lang['lang_limit_chart_items'],
          'barra_orien' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_layo'],
          'barra_orien_horiz' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_horz'],
          'barra_orien_verti' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_vrtc'],
          'barra_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_shpe'],
          'barra_forma_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_bars'],
          'barra_forma_cilin' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cyld'],
          'barra_forma_cone' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cone'],
          'barra_forma_piram' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_pyrm'],
          'barra_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_dmns'],
          'barra_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_2ddm'],
          'barra_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ddm'],
          'barra_sobre' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ovr'],
          'barra_sobre_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_sobre_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'barra_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stck'],
          'barra_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stan'],
          'barra_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stay'],
          'barra_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stap'],
          'barra_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invr'],
          'barra_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invn'],
          'barra_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invi'],
          'barra_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srgr'],
          'barra_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srst'],
          'barra_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srbs'],
          'barra_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_funl'],
          'barra_funil_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_funil_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'pizza_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_shpe'],
          'pizza_forma_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fpie'],
          'pizza_forma_donut' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dnts'],
          'pizza_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dmns'],
          'pizza_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_2ddm'],
          'pizza_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_3ddm'],
          'pizza_orden' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_srtn'],
          'pizza_orden_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_nsrt'],
          'pizza_orden_ascen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_asrt'],
          'pizza_orden_desce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dsrt'],
          'pizza_explo' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_expl'],
          'pizza_explo_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dxpl'],
          'pizza_explo_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_axpl'],
          'pizza_explo_click' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_cxpl'],
          'pizza_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fval'],
          'pizza_valor_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlv'],
          'pizza_valor_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlp'],
          'linha_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_shpe'],
          'linha_forma_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line_line'],
          'linha_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_line_spln'],
          'linha_forma_degra' => $this->Ini->Nm_lang['lang_flsh_chrt_line_step'],
          'linha_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invr'],
          'linha_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invn'],
          'linha_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invi'],
          'linha_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srgr'],
          'linha_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srst'],
          'linha_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srbs'],
          'area_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_shpe'],
          'area_forma_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area_area'],
          'area_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_area_spln'],
          'area_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stak'],
          'area_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stan'],
          'area_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stay'],
          'area_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stap'],
          'area_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invr'],
          'area_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invn'],
          'area_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invi'],
          'area_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srgr'],
          'area_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srst'],
          'area_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srbs'],
          'marca_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invr'],
          'marca_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invn'],
          'marca_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invi'],
          'marca_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srgr'],
          'marca_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srst'],
          'marca_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srbs'],
          'gauge_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_shpe'],
          'gauge_forma_circular' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_circ'],
          'gauge_forma_semi' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_semi'],
          'pyram_slice' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_slic'],
          'pyram_slice_s' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcs'],
          'pyram_slice_n' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcn'],
          'chart_enable_scroll' => $this->Ini->Nm_lang['lang_chart_enable_scroll'],
      );
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_prt'] = array();
          $_SESSION['scriptcase']['sc_idioma_prt']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_btns_prtn_titl_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modoimp' => $this->Ini->Nm_lang['lang_btns_mode_prnt_hint'], 'curr' => $this->Ini->Nm_lang['lang_othr_curr_page'], 'total' => $this->Ini->Nm_lang['lang_othr_full'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_word'] = array();
          $_SESSION['scriptcase']['sc_idioma_word']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_xls'] = array();
          $_SESSION['scriptcase']['sc_idioma_xls']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_app_xls_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'tp_xls' => $this->Ini->Nm_lang['lang_app_xls_ext'], 'tot_xls' => $this->Ini->Nm_lang['lang_othr_export_excel_total'], 'xls_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'xls_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      $this->Ini->Gd_missing  = true;
      if (function_exists("getProdVersion"))
      {
          $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
      }
      if (function_exists("gd_info"))
      {
          $this->Ini->Gd_missing = false;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "inicio";//=)
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_itens_proc_compra']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_proc_compra']['start'] == 'filter')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "grid")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "busca";
          }   
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opc_liga'] = array();  
          if (isset($NMSC_conf_apl) && !empty($NMSC_conf_apl))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opc_liga'] = $NMSC_conf_apl;  
          }   
      }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opc_liga']['paginacao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opc_liga']['paginacao']))
          { 
              $this->Ini->Apl_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opc_liga']['paginacao'];
          } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "busca")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "grid" ;  
      }   
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao_print']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao_print']))  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao_print'] = "inicio" ;  
      }   
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_all'] = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "print")  
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "res_print";
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "res_print")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']     = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_all'] = true;
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "print";
              $nmgp_tipo_print = "RC";
          }
      } 
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'], 0, 7) == "grafico")  
      { 
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "pdf")
      { 
          $this->Ini->path_img_modelo = $this->Ini->path_img_modelo;
      } 

      if (isset($_POST['nmgp_opcao']) && 'resumo' == $_POST['nmgp_opcao']
          &&
          isset($_POST['reload_summary_data']) && 'Y' == $_POST['reload_summary_data']
      ) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_array_resumo'] = 'NAO';
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_total_geral'] = 'NAO';
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['using_summary_cache']);
      }

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "fast_search")  
      { 
          $this->SC_fast_search($GLOBALS["nmgp_fast_search"], $GLOBALS["nmgp_cond_fast_search"], $GLOBALS["nmgp_arg_fast_search"]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'])
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = 'igual';
          } 
          else 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_array_resumo'] = "NAO";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_total_geral']  = "NAO";
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['tot_geral']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['using_summary_cache']);
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = 'pesq';
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['orig_pesq'] = 'grid';
          } 
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == 'pesq' && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['orig_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['orig_pesq']))  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['orig_pesq'] == "res")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = 'resumo';
          } 
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['orig_pesq'] == "grid") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = 'inicio';
          } 
      } 
      if ('gantt' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] && ('inicio' == $_GET['nmgp_opcao'] || 'inicio' == $_POST['nmgp_opcao'])) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = 'inicio';
      }
//
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['prim_cons'] = false;  
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))  
      { 
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf']);
       if (!$GLOBALS['nm_restore_grid_save']) { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['prim_cons'] = true;  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'] = " where (proc_compra_id = " . $_SESSION['proc_compra_corrente'] . ")";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['cond_pesq']         = ""; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_grid']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_lookup'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['campos_busca']      = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['grid_pesq']         = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['Grid_search']       = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_fast']   = "";
       }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_total_geral'] = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['sc_total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['tot_geral']);
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_ant'];  
      if ($nmgp_opcao == "formphp")
      { 
          if ($nm_call_php == "bt_log")
          { 
              $this->bt_log();
          } 
          $this->Db->Close(); 
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
          $this->Ini->nm_db_log_imp_mysql->Close(); 
          exit;
      } 
      $nm_flag_pdf   = true;
      $nm_vendo_pdf  = ("pdf" == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['graf_pdf'] = "S";
      if (isset($nmgp_graf_pdf) && !empty($nmgp_graf_pdf))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['graf_pdf'] = $nmgp_graf_pdf;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            $nm_arquivo_htm_temp = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_itens_proc_compra_html_" . session_id() . "_2.html";
            $nm_arquivo_pdf_base = "/sc_pdf_" . md5(date("Ymd") . "_" . session_id()) . "_grid_itens_proc_compra.pdf";
            $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . $nm_arquivo_pdf_base;
            $nm_arquivo_pdf_serv = $this->Ini->root . $nm_arquivo_pdf_url;
            $nm_arquivo_de_saida = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_itens_proc_compra_html_" . session_id() . ".html";
            $nm_url_de_saida = $this->Ini->server_pdf . $this->Ini->path_imag_temp . "/sc_grid_itens_proc_compra_html_" . session_id() . ".html";
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida, $_SESSION['scriptcase']['charset']);
            }
            else
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida);
            }
         }
      }
//----------------------------------->
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "doc_word_res")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_navigator'] = "Microsoft Internet Explorer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_all'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['doc_word']  = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']     = "resumo";
          $_SESSION['scriptcase']['saida_word'] = true;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name']))
          {
              $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'], ".");
              if ($Pos === false) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'] .= ".doc";
              }
              $nm_arquivo_doc_word = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'];
          }
          else
          {
              $nm_arquivo_doc_word = "/sc_grid_itens_proc_compra_res_" . session_id() . ".doc";
          }
          $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->Ini->nm_limite_lin_res_prt = 0;
          $GLOBALS['nmgp_cor_print'] = $nmgp_cor_word;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "xls")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_xls.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_xls.class.php"); 
          } 
          $this->xls  = new grid_itens_proc_compra_xls();
          $this->prep_modulos("xls");
          $this->xls->monta_xls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "xml")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_xml.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_xml.class.php"); 
          } 
          $this->xml  = new grid_itens_proc_compra_xml();
          $this->prep_modulos("xml");
          $this->xml->monta_xml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "json")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_json.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_json.class.php"); 
          } 
          $this->json  = new grid_itens_proc_compra_json();
          $this->prep_modulos("json");
          $this->json->monta_json();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "csv")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_csv.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_csv.class.php"); 
          } 
          $this->csv  = new grid_itens_proc_compra_csv();
          $this->prep_modulos("csv");
          $this->csv->monta_csv();
      }
      else   
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "rtf")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_rtf.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_rtf.class.php"); 
          } 
          $this->rtf  = new grid_itens_proc_compra_rtf();
          $this->prep_modulos("rtf");
          $this->rtf->monta_rtf();
      }
      else
    if (isset($_POST['chartapp_action']) && 'Y' == $_POST['chartapp_action']) {
        if (isset($_POST['chartapp_chart_type']) && 'Y' == $_POST['chartapp_chart_type'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_info'][$_POST['chart_md5']])) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_itens_proc_compra" . $this->Ini->Apl_resumo);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_app_change_type'] = true;
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_app_md5'] = $_POST['chart_md5'];
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_app_type'] = $_POST['chart_type'];
            $this->Res = new grid_itens_proc_compra_resumo("out");
            $this->prep_modulos("Res");
            $this->Res->monta_resumo();
        } else {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_itens_proc_compra" . $this->Ini->Apl_grafico);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico);
            }
            $this->Graf = new grid_itens_proc_compra_grafico();
            $this->prep_modulos("Graf");
            $this->Graf->display_chartApp_type($_POST['chart_md5'], $_POST['chart_type']);
        }
    }
    else
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'], 0, 7) == "grafico")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . " . grid_itens_proc_compra . /" . $this->Ini->Apl_grafico); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          } 
          $this->Graf  = new grid_itens_proc_compra_grafico();
          $this->prep_modulos("Graf");
          if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'], 7, 1) == "_")  
          { 
              $this->Graf->grafico_col(substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'], 8));
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "grid";
          }
          else
          { 
              if (isset($_POST['summary_chart_data']) && 'Y' == $_POST['summary_chart_data'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_data($_POST['chart_md5']);
              }
              elseif (isset($_POST['summary_chart']) && 'Y' == $_POST['summary_chart'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_newPage($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_create']) && 'Y' == $_POST['chart_inline_create'] && isset($_POST['chart_md5'])) {
                  $this->Graf->display_summaryChart_inline_initialAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_update']) && 'Y' == $_POST['chart_inline_update'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_inline_updateAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dashboard_refresh_after_chart'])) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dashboard_refresh_after_chart'];
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['dashboard_refresh_after_chart']);
              }
              else {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] = "grid";
              }
              $this->Graf->monta_grafico();
          }
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "busca")  
      { 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_mobile_pesq.class.php"); 
          } 
          $this->pesq  = new grid_itens_proc_compra_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_flag    = $this->NM_ajax_flag;
          $this->pesq->NM_ajax_opcao   = $this->NM_ajax_opcao;
          $this->pesq->monta_busca();
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "resumo")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/" . $this->Ini->Apl_resumo); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          } 
          $this->Res = new grid_itens_proc_compra_resumo("out");
          $this->prep_modulos("Res");
          $this->Res->monta_resumo();
      }
      else 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "print" && $nmgp_tipo_print == "RC")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_navigator'] = $nmgp_navegator_print;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']     = "pdf";
              $GLOBALS['nmgp_tipo_pdf'] = strtolower($nmgp_cor_print);
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] == "doc_word")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_navigator'] = "Microsoft Internet Explorer";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['doc_word']  = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao']     = "pdf";
              $_SESSION['scriptcase']['saida_word'] = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name']))
              {
                  $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'], ".");
                  if ($Pos === false) {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'] .= ".doc";
                  }
                  $nm_arquivo_doc_word =  "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_name'];
              }
              else
              {
                  $nm_arquivo_doc_word = "/sc_grid_itens_proc_compra_" . session_id() . ".doc";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
              $this->Ini->nm_limite_lin_prt = 0;
              $GLOBALS['nmgp_tipo_pdf'] = $nmgp_cor_word;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_proc_compra/grid_itens_proc_compra_grid.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_proc_compra_grid.class.php"); 
          } 
          $this->grid  = new grid_itens_proc_compra_grid();
          $this->prep_modulos("grid");
          $this->grid->monta_grid($linhas);
      }   
//--- 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
      {
           $this->Db->Close(); 
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
           $this->Ini->nm_db_log_imp_mysql->Close(); 
      }
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['embutida'])
      {
         $nm_saida->finaliza();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['ajax_nav'])
         {
             $Temp = ob_get_clean();
             if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['opcao'] != "ajax_detalhe")  
             {
                 $this->Ini->Arr_result['setVar'][] = array('var' => 'scQtReg', 'value' => $this->Ini->Qtd_reg_ajax_grid);
             }
             $_SESSION['scriptcase']['saida_var'] = false;
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Ini->Arr_result);
             exit;
         }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['field_order']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['field_order'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['field_order']);
            }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['usr_cmp_sel']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['usr_cmp_sel'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['export_sel_columns']['usr_cmp_sel']);
            }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['doc_word'])
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'] = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
             $this->html_doc_word($nm_arquivo_doc_word, $nmgp_password);
         }
         if ($this->Ini->Export_html_zip)
         {
             $this->html_export_print($nm_arquivo_html, $nmgp_password);
         }
         if ($ajax_opc_print)
         {
             $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
             $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_print);
             $Temp = ob_get_clean();
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Arr_result);
             exit;
        }
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            if (isset($nmgp_parms_pdf) && !empty($nmgp_parms_pdf))
            {
                $str_pd4ml = " ";
                $Tps_pap   = array('Letter','Legal','Ledger','A0','A1','A2','A3','A4','A5','A6','B5','Tabloid','A7','A8','A9','B0','B1','B2','B3','B4','Executive','B6','B7','B8','B9','B10','C5E','Comm10E','DLE','Folio');
                $Tmp = explode ("__SC__", $nmgp_parms_pdf);
                foreach ($Tmp as $cada_p) {
                    if (substr($cada_p, 0, 1) == "p" && in_array(substr($cada_p, 1), $Tps_pap)) {
                        $str_pd4ml .= " --page-size " . substr($cada_p, 1);
                    }
                    if ($cada_p == "op") {
                        $str_pd4ml .= " --orientation Portrait";
                    }
                    if ($cada_p == "ol") {
                        $str_pd4ml .= " --orientation Landscape";
                    }
                    if ($cada_p == "bn") {
                        $str_pd4ml .= " --outline-depth 0";
                    }
                }
            }
            else
            {
                $str_pd4ml    = " --page-size Letter --orientation Portrait";
            }
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_res'])
            { 
                $str_pd4ml .= " --outline-depth 0";
            }
            if (!$this->Ini->sc_export_ajax && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
                    if (!NM_is_utf8($lang_protect))
                    {
                        $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                    }
                    grid_itens_proc_compra_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . $this->grid->progress_tot . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                    fwrite($this->grid->progress_fp, ($this->grid->progress_tot) . "_#NM#_" . $lang_protect . "...\n");
                    fclose($this->grid->progress_fp);
                }
            }
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name']))
            {
                $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'], ".");
                if ($Pos === false) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'] .= ".pdf";
                }
                if ('/' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'], 0, 1)) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'] = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'], 1);
                }
                $nm_arquivo_pdf_serv = $this->Ini->root .  $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'];
                $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'];
                $nm_arquivo_pdf_base = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_name']);
            }
            $arq_pdf_out  = (FALSE !== strpos($nm_arquivo_pdf_serv, ' ')) ? " \"" . $nm_arquivo_pdf_serv . "\"" :  $nm_arquivo_pdf_serv;
            $arq_pdf_in   = (FALSE !== strpos($nm_url_de_saida, ' '))     ? " \"" . $nm_url_de_saida . "\""     :  $nm_url_de_saida;
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                $dir_qpdf = "/qpdf/win/bin";
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    $dir_qpdf = "/qpdf/linux-i386";
                }
                else
                {
                    $dir_qpdf = "/qpdf/linux-amd64";
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                $dir_qpdf = "/qpdf/osx";
            }
            if ($this->pdf_zip == "S")
            {
                $arq_pdf_final = str_replace(".pdf", ".zip", $arq_pdf_out);
            }
            elseif (is_dir($this->Ini->path_third . $dir_qpdf) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf']))
            {
                $arq_pdf_final = $arq_pdf_out;
                $arq_pdf_out   = str_replace(".pdf", "_wk.pdf", $arq_pdf_out);
            }
            $Win_autentication = "";
            if (isset($_SESSION['sc_pdf_usr']) && !empty($_SESSION['sc_pdf_usr']))
            {
                $_SESSION['sc_iis_usr'] = $_SESSION['sc_pdf_usr'];
            }
            if (isset($_SESSION['sc_iis_usr']) && !empty($_SESSION['sc_iis_usr']))
            {
                $Win_autentication .= " --username " . $_SESSION['sc_iis_usr'];
            }
            if (isset($_SESSION['sc_pdf_pw']) && !empty($_SESSION['sc_pdf_pw']))
            {
                $_SESSION['sc_iis_pw'] = $_SESSION['sc_pdf_pw'];
            }
            if (isset($_SESSION['sc_iis_pw']) && !empty($_SESSION['sc_iis_pw']))
            {
                $Win_autentication .= " --password " . $_SESSION['sc_iis_pw'];
            }
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/win");
                $str_execcmd2 = 'wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (isset($_SERVER['NM_SC_SYS_CONFIG']) && $_SERVER['NM_SC_SYS_CONFIG'] == 1) 
                {
                    chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-i386");
                    }
                    $str_execcmd2 = './wkhtmltopdf-i386 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                else
                {
                    if (FALSE !== strpos(strtolower(php_uname()), 'debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 5.10') ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/bullseye");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 6.1') ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/bookworm");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el8.') || preg_match('/.el8_\d+./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos8");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el9.') || preg_match('/.el9_\d+./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos9");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    }
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/osx/Contents/MacOS");
                $str_execcmd2 = './wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }

            if (!isset($_SESSION['scriptcase']['phantomjs_charts']) || !$_SESSION['scriptcase']['phantomjs_charts'])
            {
                $str_execcmd2 .= ' --javascript-delay ' . 2000;
            }

            $str_execcmd2 .= ' --disable-local-file-access ' . $arq_pdf_in . ' ' . $arq_pdf_out;

            $arr_execcmd = array();
            $str_execcmd = $str_execcmd2;
            exec($str_execcmd2);
            $str_cmd_qpdf = "";
            $str_zip      = "";
            if ($this->pdf_zip == "S")
            {
                $pdf_pass = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf'] : "";
                $opt_pass = (!empty($pdf_pass)) ? " -p" : "";
                if (is_file($arq_pdf_final)) {
                    unlink($arq_pdf_final);
                }
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    chdir($this->Ini->path_third . "/zip/windows");
                    $str_zip = "zip.exe" . strtoupper($opt_pass) . " -j " . $pdf_pass . " " . $arq_pdf_final . " " . $arq_pdf_out;
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
                      $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    chdir($this->Ini->path_third . "/zip/mac/bin");
                    $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                if (!empty($str_zip)) {
                    exec($str_zip);
                }
                if (is_file($arq_pdf_final)) 
                {
                    unlink($arq_pdf_out);
                }
            }
            elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf']))
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    $dir_qpdf = "/qpdf/win/bin";
                    $str_cmd_qpdf = "qpdf.exe ";
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                {
                    if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                    {
                        $dir_qpdf = "/qpdf/linux-i386";
                        $str_cmd_qpdf = "./qpdf-linux-x86 ";
                    }
                    else
                    {
                        $dir_qpdf = "/qpdf/linux-amd64";
                        $str_cmd_qpdf = "./qpdf-linux-amd64 ";
                    }
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    $dir_qpdf = "/qpdf/osx";
                    $str_cmd_qpdf = "./qpdf-darwin-x86 ";
                }
                if (is_dir($this->Ini->path_third . $dir_qpdf)) 
                {
                    chdir($this->Ini->path_third . $dir_qpdf);
                    $pdf_pass  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['use_pass_pdf'];
                    $str_cmd_qpdf .= "--encrypt " . $pdf_pass . " " . $pdf_pass . " 256 -- " . $arq_pdf_out . " " . $arq_pdf_final;
                    exec($str_cmd_qpdf);
                    if (is_file($arq_pdf_final)) 
                    {
                        unlink($arq_pdf_out);
                    }
                }
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_array_resumo'] = '';
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['contr_total_geral']  = '';
            // ----- PDF log
            $fp = @fopen($this->Ini->root . $this->Ini->path_imag_temp . str_replace(array(".pdf",".zip"), array("",""), $nm_arquivo_pdf_base) . '.log', 'w');
            if ($fp)
            {
                @fwrite($fp, $str_execcmd . "\r\n\r\n");
                @fwrite($fp, implode("\r\n", $arr_execcmd));
                @fwrite($fp, $str_cmd_qpdf . "\r\n\r\n");
                @fwrite($fp, $str_zip . "\r\n\r\n");
                @fclose($fp);
            }
            if ($this->Ini->sc_export_ajax)
            {
                $this->Arr_result['file_export']  = NM_charset_to_utf8($nm_arquivo_pdf_serv);
                $this->Arr_result['title_export'] = NM_charset_to_utf8(substr($nm_arquivo_pdf_base, 1));
                $Temp = ob_get_clean();
                $oJson = new Services_JSON();
                echo $oJson->encode($this->Arr_result);
                exit;
            }
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
               $_SESSION['scriptcase']['charset_html'] = (isset($this->Ini->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->Ini->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
            }
            if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $this->grid->progress_fp = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', 'a');
                    if ($this->grid->progress_fp)
                    {
                         $lang_protect = $this->Ini->Nm_lang['lang_pdff_fnsh'];
                         if (!NM_is_utf8($lang_protect))
                         {
                             $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                          }
                        grid_itens_proc_compra_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                        grid_itens_proc_compra_pdf_progress_call("off\n", $this->Ini->Nm_lang);
                        fwrite($this->grid->progress_fp, ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n");
                        fwrite($this->grid->progress_fp, "off\n");
                        fclose($this->grid->progress_fp);
                    }
                }
            }
unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_file']);
if (is_file($nm_arquivo_pdf_serv))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['pdf_file'] = $nm_arquivo_pdf_serv;
}
$NM_volta  = "volta_grid";
$NM_target = "_parent";
$downloadFileName = "grid_itens_proc_compra.pdf";
if ($this->pdf_zip == 'S') {
    $nm_arquivo_pdf_serv = str_replace('.pdf', '.zip', $nm_arquivo_pdf_serv);
    $nm_arquivo_pdf_url = str_replace('.pdf', '.zip', $nm_arquivo_pdf_url);
    $downloadFileName = str_replace('.pdf', '.zip', $downloadFileName);
}
if (!is_file($nm_arquivo_pdf_serv))
{
?>
  <br><b><?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?></b></td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.displayErrorPdf === "function") {
    window.parent.displayErrorPdf("<?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?>");
}
</script>
<?php
}
else
{
?>
<?php echo $this->Ini->Nm_lang['lang_pdff_file_loct']; ?>
<BR>
<A href="<?php echo $nm_arquivo_pdf_url; ?>" target="_blank" class="scGridPageLink"><B><?php echo $nm_arquivo_pdf_url; ?></B></A>.
<BR>
<?php echo $this->Ini->Nm_lang['lang_pdff_clck_mesg']; ?>
</td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateGeneratedPdfFile === "function") {
    window.parent.updateGeneratedPdfFile("<?php echo $nm_arquivo_pdf_url; ?>");
}
</script>
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][md5("newpdf_" . $downloadFileName)][0] = $nm_arquivo_pdf_url;
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][md5("newpdf_" . $downloadFileName)][1] = $downloadFileName;
}
   echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "sc_b_sai", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<FORM name="F0" method=post action="./" target="<?php echo $NM_target; ?>"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($NM_volta); ?>"> 
</FORM>
</td></tr></table>
</BODY>
</HTML>
<?php
         }
      }
   } 
   function bt_log() 
   {
      global 
      $nm_apl_dependente;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'];
      $nm_f_saida = "./";
?>
     <!DOCTYPE html>
      <html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
      <head>
       <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
        <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
        <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
        <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
        <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
      </head>
      <body class="scGridPage">
      <table class="scGridTabela" align="center"><tr><td>
<?php
      
/*----- Scriptcase Locale: Button bt_log ------*/
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  $aplCorrente = $this->Ini->nm_cod_apl;
header("Location:..\ctrl_tipo_log\ctrl_tipo_log.php?apl_corrente=$aplCorrente&id_chave=0");
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button bt_log ------*/
 
?>
      </td></tr><tr><td align="center">
      <form name="F4" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value="volta_grid"/>
      <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page);?>"/>
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

/*----- Scriptcase Locale: PHP Method: usuario.php => function getGruposUsuario ------*/

function getGruposUsuario($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getGruposUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuario ------*/

function getTipoUsuario($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $tipo = 0;
    $aReg = $this->getDadosUserWeb($login,'"tp-usuario"');
    
    if(is_array($aReg)){
        $tipo = $aReg[0]['"tp-usuario"'];
    }
    return $tipo;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuarioCorrente ------*/

function getTipoUsuarioCorrente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTipoUsuario());

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuarioCorrente ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getLinkCarrinho ------*/

function getLinkCarrinho()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
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

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getLinkCarrinho ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getRegUsuario ------*/

function getRegUsuario($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
	$aReg = $this->getReg('espec','user-web', 'login',
        "'$login'", $campos,$filtroCompl);
	return $aReg;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getRegUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verificGrupoLogin ------*/

function verificGrupoLogin($codGrupo)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());

    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verificGrupoLogin ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verificarPermissaoAlocacao ------*/

function verificarPermissaoAlocacao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verificarPermissaoAlocacao ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getDadosUserWeb ------*/

function getDadosUserWeb($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $aReg = $this->getReg('espec','user-web',
        'login',"'$login'",$campos,
        $filtroCompl,'');

    return $aReg;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getDadosUserWeb ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getUsuarioERP ------*/

function getUsuarioERP($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $usuario = '';
    $aRet = $this->getDadosUserWeb($login,'usuario');
   if(is_array($aRet)){
       $usuario = $aRet[0]['usuario'];
   }
   return $usuario;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getUsuarioERP ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermPagtoViaCaixa ------*/

function getPermPagtoViaCaixa($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logCaixa = $aReg[0]['log_caixa'];
    }else{
        $logCaixa = 0;
    }
    return $logCaixa == 1;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermPagtoViaCaixa ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermissoesPedWeb ------*/

function getPermissoesPedWeb($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermissoesPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verifVendLoja ------*/

function verifVendLoja()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getParamVendLoja());

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verifVendLoja ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getParamVendLoja ------*/

function getParamVendLoja()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return 'vend_loja';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getParamVendLoja ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermPrioridade ------*/

function getPermPrioridade($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logPrioridade = $aReg[0]['log_prioridade'];
    }else{
        $logPrioridade = 0;
    }
    return $logPrioridade == 1;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermPrioridade ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getGruposRepresGeral ------*/

function getGruposRepresGeral()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return "2,3";

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getGruposRepresGeral ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getCpsEsconderPedido ------*/

function getCpsEsconderPedido($tipo)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $listaCps = '';
    switch($tipo){
        case '2':
            $listaCps = 'dt-useralt,user-alte,user-canc';
            break;
    }
    return $listaCps;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getCpsEsconderPedido ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function trocarPerfil ------*/

function trocarPerfil($logVoltar,$novoPerfil='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    if($logVoltar){
        $novoPerfil = $this->getVarSessao('perfil_pai');
    }else{
        setVarSessao('perfil_pai',$this->getLoginCorrente()) ;
    }
    $this->limparLogin();
    $aUsuario = $this->getDadosUserWeb($novoPerfil,$this->getCamposUsuario());
    $this->setarVarsLogin($aUsuario);
    

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function trocarPerfil ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getFoto ------*/

function getFoto()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getFoto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function atualizarFoto ------*/

function atualizarFoto($login,$foto)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $cmd = "update pub.\"user-web\" set foto ='$foto'
            where login = '$login' ";
    
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
      
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function atualizarFoto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verGrpAvalAdm ------*/

function verGrpAvalAdm()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log = $this->verificGrupoLogin($this->getParamGrupoAvalAdm());
    return $log;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verGrpAvalAdm ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getListaRepresGer ------*/

function getListaRepresGer($indiceRep='nome'){
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getListaRepresGer ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNomeVarTipoUsuario ------*/

function getNomeVarTipoUsuario()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return 'glo_tipoUsuario';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNomeVarTipoUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioRepres ------*/

function getNumTpUsuarioRepres()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return '2';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioRepres ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioPreposto ------*/

function getNumTpUsuarioPreposto()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return '5';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioPreposto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdmVendas ------*/

function getNumTpUsuarioAdmVendas()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return '3';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdmVendas ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdm ------*/

function getNumTpUsuarioAdm()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return '4';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdm ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verifPermisAprovGerencial ------*/

function verifPermisAprovGerencial($codGrupo,$usuario)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario("$usuario");
    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verifPermisAprovGerencial ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNomeGerPorUsuarErp ------*/

function getNomeGerPorUsuarErp($usuarioErp){
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNomeGerPorUsuarErp ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlItemProcCompra ------*/

function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarFornecItemProcCompra ------*/

function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarFornecItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCustoItens ------*/

function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCustoItens ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlTribItens ------*/

function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $this->proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlTribItens ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocItemProc ------*/

function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtSaldoItemProc ------*/

function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtSaldoItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtCompradaItemProc ------*/

function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtCompradaItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItemAlocado ------*/

function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItemAlocado ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarPonderacaoItensProcCompra ------*/

function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarPonderacaoItensProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlProcCompraAtu ------*/

function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlProcCompraAtu ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarProcCompraItem ------*/

function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarProcCompraItem ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCodItemERP ------*/

function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCodItemERP ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarDescItemProcCompra ------*/

function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $this->descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $this->descricao = $aRetorno[0][$campo];
    }
    return $this->descricao;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarDescItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarContainersItemProcCompra ------*/

function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarContainersItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocadaItemProcCompra ------*/

function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocadaItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevRecbtoSoLd ------*/

function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevRecbtoSoLd ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtMaximaProducao ------*/

function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtMaximaProducao ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevEmbarque ------*/

function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = $this->buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevEmbarque ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function retornarCampoItemProcCompra ------*/

function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function retornarCampoItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function getIDItensProcCompra ------*/

function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function getIDItensProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function validarItemMesmoCodigoPrecoDif ------*/

function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function validarItemMesmoCodigoPrecoDif ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function updateDtCertificacaoItem ------*/

function updateDtCertificacaoItem($idItemProcCompra,$data){
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  


	$dateTime = new \DateTime($data);
    $dateTime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));

    $dataFormatada = $dateTime->format('Y-m-d H:i:s');
	
	

	$cmd = "update pub.itens_proc_compra set dt_item_certificacao = '$dataFormatada' 
            where item_proc_compra_id = $idItemProcCompra ";
    
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
      
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function updateDtCertificacaoItem ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTb ------*/

function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTb ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getTipoConexao ------*/

function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getTipoConexao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getReg ------*/

function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getReg ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getDados ------*/

function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getDados ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornoSimplesTb01 ------*/

function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornoSimplesTb01 ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function inserirLogSQL ------*/

function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function inserirLogSQL ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTbSessao ------*/

function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function setCpsTbSessao ------*/

function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function setCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornoMultReg ------*/

function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornoMultReg ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getUltIdTabela ------*/

function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getUltIdTabela ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function execAcaoPDO ------*/

function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function execAcaoPDO ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getODBCDireto ------*/

function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getODBCDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function conectarBase ------*/

function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function conectarBase ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornarChaveEstr ------*/

function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornarChaveEstr ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertArrayEmUpdate ------*/

function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertArrayEmUpdate ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertDadosSqlParaAPI ------*/

function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertDadosSqlParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTbSQLSERVER ------*/

function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTbSQLSERVER ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getRegsSqlLivre ------*/

function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getRegsSqlLivre ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertArrayEmInsert ------*/

function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertArrayEmInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function updateDireto ------*/

function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function updateDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function setCondWhere ------*/

function setCondWhere($cond)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['inicio']);
}

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function setCondWhere ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function conectarBaseMysql ------*/

function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function conectarBaseMysql ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getUsuarioLock ------*/

function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getUsuarioLock ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function acertarAspasSimplesInsert ------*/

function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function acertarAspasSimplesInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertCpParaAPI ------*/

function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertCpParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: usuarios.php => function verificaPermVlUnitCusto ------*/

function verificaPermVlUnitCusto($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log_achou = false;
    $listaGrupos = $this->buscarGruposUsuarios($login);
    $parametro = $this->buscarParametroIma('grupo_diretoria');
    $log_achou = strstr($listaGrupos,$parametro);
    return $log_achou;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuarios.php => function verificaPermVlUnitCusto ------*/


/*----- Scriptcase Locale: PHP Method: usuarios.php => function getUsuarioCorrenteEms ------*/

function getUsuarioCorrenteEms()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return 'super';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuarios.php => function getUsuarioCorrenteEms ------*/


/*----- Scriptcase Locale: PHP Method: usuarios.php => function verifGrupoAmostra ------*/

function verifGrupoAmostra()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $grupos = $this->buscarGruposUsuarios($this->getLoginCorrente());
    

    return strstr($grupos,strval($this->getGrupoUsuarioAmostra()));

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuarios.php => function verifGrupoAmostra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarDespesaProcCompra ------*/

function criarDespesaProcCompra($proc_compra_id, $despesa_id, $valor, $calc_id = 0 )
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.despesas_proc_compra(despesa_proc_compra_id,proc_compra_id, despesa_id,vl_prev,calc_imp_proc_compra_id) 
	        values(pub.seq_despesas_proc_compra.NEXTVAL, 
			       $this->proc_compra_id,
			       $despesa_id,
				   $valor,
				   $calc_id)";
    
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
      
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarDespesaProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarDespesasProcCompra ------*/

function criarDespesasProcCompra($proc_compra_id)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $empresa  = buscarEmpProcCompra($this->proc_compra_id);
    $aRetorno = buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId = $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao = $aRetorno[$i]['emp_desp.vl_padrao'];
            $this->criarDespesaProcCompra($this->proc_compra_id, $despesaId, $valorPadrao);
        }
    }

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarDespesasProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function calcularImpostosProcCompra ------*/

function calcularImpostosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $novoCalculo = $this->criarCalculoImpProcCompra();

    $empresa     = buscarEmpProcCompra($procCompraIdParam);
    $aImpostos    = buscarImpostosEmpresa($empresa);
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function calcularImpostosProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function calcularImposto ------*/

function calcularImposto($proc_compra_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = buscarEmpProcCompra($this->proc_compra_id);
    }

    $vlTribItens = $this->buscarVlTribItens($this->proc_compra_id);
    $aDespesas   =  buscarDespesasImposto($imposto,$empresa);
    if(is_array($aDespesas)){
        for($i=0;$i < count($aDespesas);$i++){
            $despesaImp = $aDespesas[$i]['despesa_id'];
            $aValor = $this->retornoSimplesTb01(" pub.despesas_proc_compra ", " sum(vl_prev) as tot_vl_prev",
                                         " proc_compra_id = $this->proc_compra_id and despesa_id = ".$despesaImp,"espec");
            if(is_array($aValor)){
                $valor = $aValor[$i]['tot_vl_prev'];
                if($valor == ''){
                    $valor = 0;
                }

            }
            else{
                $valor = 0;
            }
            $aLogImposto = buscarDespesaLogImpostoOuCalc($despesaImp);
            $logImposto = $aLogImposto['log_imposto'];

            if($logImposto == 1){
                $logCalcImposto = $this->verificarCalcImpProcCompra($this->proc_compra_id,$novoCalculo,$despesaImp);
                if($logCalcImposto != 1){
                    $lSemCalcImposto = true;
                    $perc  = buscarImpostoPerc($despesaImp,$empresa);
                    $vlImp = $this->calcularImposto($this->proc_compra_id,$despesaImp,$perc,$novoCalculo,$empresa);
                    $this->atualizarCalculoImposto($novoCalculo,$this->proc_compra_id,$imposto,$vlImp);
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function calcularImposto ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarCalculoImpProcCompra ------*/

function criarCalculoImpProcCompra($usuario_id = 0 )
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['cod_usuario_corrente'])) {$_SESSION['cod_usuario_corrente'] = "";}
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_proc_compra ", " max(calc_imp_proc_compra_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) {$_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function criarCalculoImpProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function verificarCalcImpProcCompra ------*/

function verificarCalcImpProcCompra($proc_compra_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra','despesa_proc_compra_id',
                                   " proc_compra_id = $this->proc_compra_id and despesa_id = $despesa and
								     calc_imp_proc_compra_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;



$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function verificarCalcImpProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function atualizarCalculoImposto ------*/

function atualizarCalculoImposto($novoCalculo,$proc_compra_id,	$imposto,$vlImposto)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    
    $condicao = "proc_compra_id = $this->proc_compra_id and despesa_id = $imposto";
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    }
    else{
        $this->criarDespesaProcCompra($this->proc_compra_id,$imposto, $vlImposto, $novoCalculo );
    }
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function atualizarCalculoImposto ------*/


/*----- Scriptcase Locale: PHP Method: despesas_proc_compra.php => function buscarTotDespesasProcCompra ------*/

function buscarTotDespesasProcCompra($procCompraID)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $vlTot = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra', 'sum(vl_prev) as tot'," proc_compra_id = $procCompraID ","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: despesas_proc_compra.php => function buscarTotDespesasProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: grupos_usuarios.php => function buscarGruposUsuarios ------*/

function buscarGruposUsuarios($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $listaGrupos = '';
    $aRetorno = $this->retornoMultReg('s_users_groups',
                               'group_id',
                               " login = '$login'",
                               "ticontrole");
    if(is_array($aRetorno)){
        $tam = count($aRetorno);
        for($i=0;$i < $tam; $i++){
            $grupo = $aRetorno[$i]['group_id'];
            if($listaGrupos =='' ){
                $listaGrupos = $grupo;
            }
            else{
                $listaGrupos .= ",".$grupo;
            }
        }
    }
    return $listaGrupos;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: grupos_usuarios.php => function buscarGruposUsuarios ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function util_incr_valor ------*/

function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function util_incr_valor ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function dataAtual ------*/

function dataAtual()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function dataAtual ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function intervaloData ------*/

function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function intervaloData ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function buscarVlSequenciaEspec ------*/

function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.CURRVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function buscarVlSequenciaEspec ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function incrementarVlSequenciaEspec ------*/

function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $valor = 0;
    $sql =" SELECT pub.$sequencia.NEXTVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->seq = array();
      if ($SCrx = $this->Ini->nm_db_especw->Execute($nm_select)) 
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
          $this->seq_erro = $this->Ini->nm_db_especw->ErrorMsg();
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function incrementarVlSequenciaEspec ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarAcento ------*/

function retirarAcento($palavra)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarAcento ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function verificarDifValorListas ------*/

function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function verificarDifValorListas ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function formatarNumero ------*/

function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function formatarNumero ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convLogEmString ------*/

function convLogEmString($valor)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convLogEmString ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayToString ------*/

function convArrayToString($array)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayToString ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function tratarAspasSimples ------*/

function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function tratarAspasSimples ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarAcentoSimples ------*/

function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarAcentoSimples ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function tratarNumero ------*/

function tratarNumero($num)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function tratarNumero ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function execOperMat ------*/

function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function execOperMat ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function exibirMsgErro ------*/

function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function exibirMsgErro ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function limparVar ------*/

function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function limparVar ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayParaLista ------*/

function convArrayParaLista($array,$logEntreAspas=false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayParaLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayMultParaLista ------*/

function convArrayMultParaLista($array,$indice,$logEntreAspas=false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayMultParaLista ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function preencherIDLog ------*/

function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function preencherIDLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function setIdLogAPlCorrente ------*/

function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function setIdLogAPlCorrente ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function gerarLinkLog ------*/

function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function gerarLinkLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function iniciarTransLog ------*/

function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function iniciarTransLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function setArqTransLog ------*/

function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function setArqTransLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function getArqTransLog ------*/

function getArqTransLog($programa)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function getArqTransLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function setProgramaCorrenteLog ------*/

function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function setProgramaCorrenteLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function getProgramaCorrenteLog ------*/

function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function getProgramaCorrenteLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function inserirLog ------*/

function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function inserirLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function linkLogAtual ------*/

function linkLogAtual()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function linkLogAtual ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function criarArqLog ------*/

function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function criarArqLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function getDirCompletoArqsLog ------*/

function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function getDirCompletoArqsLog ------*/


/*----- Scriptcase Locale: PHP Method: logs.php => function getDirArqsLog ------*/

function getDirArqsLog()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: logs.php => function getDirArqsLog ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function buscarParametroIma ------*/

function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function buscarParametroIma ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPe ------*/

function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPi ------*/

function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getHabilitarBonusRepres ------*/

function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getHabilitarBonusRepres ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getBase ------*/

function getBase()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getBase ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMudancaMoeda ------*/

function getMudancaMoeda()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMudancaMoeda ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamPrecoTbERP ------*/

function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamPrecoTbERP ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getPrecoTbLiquidaIma ------*/

function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getPrecoTbLiquidaIma ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamGrupoAvalAdm ------*/

function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamGrupoAvalAdm ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getPercRedTbRubi ------*/

function getPercRedTbRubi()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getPercRedTbRubi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getIdTbRubi ------*/

function getIdTbRubi()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getIdTbRubi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAutLogDb ------*/

function getAutLogDb()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAutLogDb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUserLogDb ------*/

function getUserLogDb()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUserLogDb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function credBdConsultas ------*/

function credBdConsultas()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function credBdConsultas ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArqOutlet ------*/

function getDirArqOutlet()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArqOutlet ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getCaminhoArqCampanha ------*/

function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getCaminhoArqCampanha ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIFSudeste ------*/

function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIFSudeste ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIF ------*/

function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIF ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirTmpBook ------*/

function getDirTmpBook()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirTmpBook ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlServico ------*/

function getUrlServico()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlServico ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUserApiTotvs ------*/

function getUserApiTotvs()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUserApiTotvs ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaApiTotvs ------*/

function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaApiTotvs ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVersaoApiHomolog ------*/

function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVersaoApiHomolog ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getApiHistAvalPedVenda ------*/

function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getApiHistAvalPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPe ------*/

function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPi ------*/

function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWeb ------*/

function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParametros ------*/

function getParametros()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParametros ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function atualizarParametros ------*/

function atualizarParametros()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function atualizarParametros ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function setParamsSessao ------*/

function setParamsSessao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function setParamsSessao ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getNomeVarParams ------*/

function getNomeVarParams()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getNomeVarParams ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getConsiderarDepositoFechado ------*/

function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getConsiderarDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getEstabDepositoFechado ------*/

function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getEstabDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getCodDeposDepositoFechado ------*/

function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getCodDeposDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getTiposVersaoValidNFMae ------*/

function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getTiposVersaoValidNFMae ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamDistrCusto ------*/

function getParamDistrCusto()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamDistrCusto ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getQtDiasCalcPrevChegadaPedImp ------*/

function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60");

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getQtDiasCalcPrevChegadaPedImp ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getListaNatOperNotaMae ------*/

function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getListaNatOperNotaMae ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getListaNatOperNotaCompl ------*/

function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getListaNatOperNotaCompl ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getGrupoUsuarioAmostra ------*/

function getGrupoUsuarioAmostra()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('grupo_usuario_amostra','67');

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getGrupoUsuarioAmostra ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarLoginSessao ------*/

function getNomeVarLoginSessao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return "login_portal_acesso";

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarLoginSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarPercParComis ------*/

function getNomeVarPercParComis()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return "perc_participacao_comis";

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarPercParComis ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarTodosCliente ------*/

function getNomeVarTodosCliente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return "log_todos_cliente";

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarTodosCliente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getCamposUsuario ------*/

function getCamposUsuario()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return  'priv_admin,ativo,nome,email,"tp-usuario" as tp_usuario,usuario,
		"nome-ab-cli" as nome_ab_cli,login,usuario,log_pedido_on_line,
                 log_aprovador,id,perc_participacao_comis,log_todos_clientes';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getCamposUsuario ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function validarLogin ------*/

function validarLogin($login,$pswd)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $login = $this->retirarAcentoSimples($login);
    $erro = '';
    $slogin = $this->Db->qstr($login);
    $spswd  = $this->Db->qstr($pswd);
    $logSetarVariaveis = false;
    $campos = $this->getCamposUsuario();
    $slogin = str_replace("'","",$slogin);
    $spswd  = str_replace("'","",$spswd);

    $aUsuario = $this->getDadosUserWeb($slogin,$campos," senha = '__OMITIDO_NA_COPIA_DE_ANALISE__' ");
    $vendLoja = 0;
    if(! is_array($aUsuario)){
        $this->Ini->NM_gera_log_insert("User", 'login Falhou', "Falhou a tentativa de logar com o login:$login");
        $erro = 'Informe um usuário e uma senha válida ';
    }else{
        $reg = $aUsuario[0];
        $ativo              = $reg['ativo'];
        if($ativo <> 1){
            $erro = "Usuário Inativo";
        }
    }
    return array('array'=>$aUsuario,'erro'=>$erro);
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function validarLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getVarSessao ------*/

function getVarSessao($varParam,$logEscopoApl=false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = getNomeVarSessaoComApl($varParam);
    }

    if(isset($_SESSION[$varParam])){
        $retParam =  $_SESSION[$varParam];
    }else{
        $retParam = '';
    }
    return $retParam;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getVarSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function setarVarsLogin ------*/

function setarVarsLogin($aUsuario)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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




$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function setarVarsLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function logar ------*/

function logar($login,$pswd)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLogin($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
      $this->setarVarsLogin($aUsuario);
      $this->atualizarParametros();
    }

	return $erro;


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function logar ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeRepresSessao ------*/

function getNomeRepresSessao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $nomeRepresIni = $this->getVarSessao('glo_nomeRepresIni');
    if($nomeRepresIni == ''){
        $nomeRepresFim = 'zzzzzzzzzzzzzzzz';
    }else{
        $nomeRepresFim = $nomeRepresIni;
    }
    $aRetorno = array('nome_repres_ini' => $nomeRepresIni, 'nome_repres_fim' => $nomeRepresFim);
    return  $aRetorno;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeRepresSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function aplicarPermissoesSC ------*/

function aplicarPermissoesSC($login)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  



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
        $this->Ini->NM_gera_log_insert("User", 'login', "Login OK");
    }
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function aplicarPermissoesSC ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function has_priv ------*/

function has_priv($param)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return ($param == 'Y' ? 'on' : 'off');


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function has_priv ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function limparLogin ------*/

function limparLogin($logLimparPerfilPai=false)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
if (!isset($_SESSION['inicio_sessao'])) {$_SESSION['inicio_sessao'] = "";}
if (!isset($this->sc_temp_inicio_sessao)) {$this->sc_temp_inicio_sessao = (isset($_SESSION['inicio_sessao'])) ? $_SESSION['inicio_sessao'] : "";}
if (!isset($_SESSION['aplicacaoPrincipal'])) {$_SESSION['aplicacaoPrincipal'] = "";}
if (!isset($this->sc_temp_aplicacaoPrincipal)) {$this->sc_temp_aplicacaoPrincipal = (isset($_SESSION['aplicacaoPrincipal'])) ? $_SESSION['aplicacaoPrincipal'] : "";}
if (!isset($_SESSION['tipoUsuario'])) {$_SESSION['tipoUsuario'] = "";}
if (!isset($this->sc_temp_tipoUsuario)) {$this->sc_temp_tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";}
if (!isset($_SESSION['prepostoFim'])) {$_SESSION['prepostoFim'] = "";}
if (!isset($this->sc_temp_prepostoFim)) {$this->sc_temp_prepostoFim = (isset($_SESSION['prepostoFim'])) ? $_SESSION['prepostoFim'] : "";}
if (!isset($_SESSION['prepostoIni'])) {$_SESSION['prepostoIni'] = "";}
if (!isset($this->sc_temp_prepostoIni)) {$this->sc_temp_prepostoIni = (isset($_SESSION['prepostoIni'])) ? $_SESSION['prepostoIni'] : "";}
if (!isset($_SESSION['codRepFim'])) {$_SESSION['codRepFim'] = "";}
if (!isset($this->sc_temp_codRepFim)) {$this->sc_temp_codRepFim = (isset($_SESSION['codRepFim'])) ? $_SESSION['codRepFim'] : "";}
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
if (!isset($_SESSION['nomeRepresFim'])) {$_SESSION['nomeRepresFim'] = "";}
if (!isset($this->sc_temp_nomeRepresFim)) {$this->sc_temp_nomeRepresFim = (isset($_SESSION['nomeRepresFim'])) ? $_SESSION['nomeRepresFim'] : "";}
if (!isset($_SESSION['nomeRepresIni'])) {$_SESSION['nomeRepresIni'] = "";}
if (!isset($this->sc_temp_nomeRepresIni)) {$this->sc_temp_nomeRepresIni = (isset($_SESSION['nomeRepresIni'])) ? $_SESSION['nomeRepresIni'] : "";}
if (!isset($_SESSION['nomeClienteFim'])) {$_SESSION['nomeClienteFim'] = "";}
if (!isset($this->sc_temp_nomeClienteFim)) {$this->sc_temp_nomeClienteFim = (isset($_SESSION['nomeClienteFim'])) ? $_SESSION['nomeClienteFim'] : "";}
if (!isset($_SESSION['nomeClienteIni'])) {$_SESSION['nomeClienteIni'] = "";}
if (!isset($this->sc_temp_nomeClienteIni)) {$this->sc_temp_nomeClienteIni = (isset($_SESSION['nomeClienteIni'])) ? $_SESSION['nomeClienteIni'] : "";}
if (!isset($_SESSION['usr_name'])) {$_SESSION['usr_name'] = "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($_SESSION['usr_priv_admin'])) {$_SESSION['usr_priv_admin'] = "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($_SESSION['usr_email'])) {$_SESSION['usr_email'] = "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
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
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_email)) {$_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_usr_priv_admin)) {$_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) {$_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_nomeClienteIni)) {$_SESSION['nomeClienteIni'] = $this->sc_temp_nomeClienteIni;}
if (isset($this->sc_temp_nomeClienteFim)) {$_SESSION['nomeClienteFim'] = $this->sc_temp_nomeClienteFim;}
if (isset($this->sc_temp_nomeRepresIni)) {$_SESSION['nomeRepresIni'] = $this->sc_temp_nomeRepresIni;}
if (isset($this->sc_temp_nomeRepresFim)) {$_SESSION['nomeRepresFim'] = $this->sc_temp_nomeRepresFim;}
if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
if (isset($this->sc_temp_codRepFim)) {$_SESSION['codRepFim'] = $this->sc_temp_codRepFim;}
if (isset($this->sc_temp_prepostoIni)) {$_SESSION['prepostoIni'] = $this->sc_temp_prepostoIni;}
if (isset($this->sc_temp_prepostoFim)) {$_SESSION['prepostoFim'] = $this->sc_temp_prepostoFim;}
if (isset($this->sc_temp_tipoUsuario)) {$_SESSION['tipoUsuario'] = $this->sc_temp_tipoUsuario;}
if (isset($this->sc_temp_aplicacaoPrincipal)) {$_SESSION['aplicacaoPrincipal'] = $this->sc_temp_aplicacaoPrincipal;}
if (isset($this->sc_temp_inicio_sessao)) {$_SESSION['inicio_sessao'] = $this->sc_temp_inicio_sessao;}
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function limparLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function inicioAplicacao ------*/

function inicioAplicacao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function inicioAplicacao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getLoginCorrente ------*/

function getLoginCorrente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  

    return $this->getVarSessao($this->getNomeVarLoginSessao());


$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getLoginCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getPercPartComisCorrente ------*/

function getPercPartComisCorrente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarPercParComis());

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getPercPartComisCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getTodosClienteCorrente ------*/

function getTodosClienteCorrente()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTodosCliente());

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getTodosClienteCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function limparListaCpsSessao ------*/

function limparListaCpsSessao()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $aLista =$this->getVarSessao('lista_cps_definida');
    if(is_array($aLista)){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $variavel = $aLista[$i];
            unset($_SESSION[$variavel]);
        }
    }

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function limparListaCpsSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function verifUsuarioCorrenteAdmin ------*/

function verifUsuarioCorrenteAdmin()
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $log= 0;

    $tipo = $this->getTipoUsuarioCorrente();
    if($tipo <> 2 and $tipo <> 5){
        $log = 1;
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function verifUsuarioCorrenteAdmin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function logarLDAP ------*/

function logarLDAP($usuario,$senha,$servidor='__OMITIDO_NA_COPIA_DE_ANALISE__',$dominio='IMA',$porta=389)
{
$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'on';
  
    $ldapconn = ldap_connect("ldap://{$servidor}:{$porta}") ;

    if ($ldapconn) {
        $ldapbind = ldap_bind($ldapconn, "{$dominio}\\{$usuario}", $senha);
        if ($ldapbind) {
            return 'logado';
        }
        ldap_close($ldapconn);

    }
    return '';

$_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function logarLDAP ------*/

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
  function close_emb()
  {
      if ($this->Db)
      {
          $this->Db->Close(); 
      }
      if(isset($this->Ini->nm_db_especw)){ 
        $this->Ini->nm_db_especw->Close(); 
      }
      if(isset($this->Ini->nm_db_ems5)){ 
        $this->Ini->nm_db_ems5->Close(); 
      }
      if(isset($this->Ini->nm_db_ems2ima)){ 
        $this->Ini->nm_db_ems2ima->Close(); 
      }
      if(isset($this->Ini->nm_db_ems2med)){ 
        $this->Ini->nm_db_ems2med->Close(); 
      }
      if(isset($this->Ini->nm_db_comum)){ 
        $this->Ini->nm_db_comum->Close(); 
      }
      if(isset($this->Ini->nm_db_multi)){ 
        $this->Ini->nm_db_multi->Close(); 
      }
      if(isset($this->Ini->nm_db_cfsc)){ 
        $this->Ini->nm_db_cfsc->Close(); 
      }
      if(isset($this->Ini->nm_db_log_db)){ 
        $this->Ini->nm_db_log_db->Close(); 
      }
      if(isset($this->Ini->nm_db_ticontrole2)){ 
        $this->Ini->nm_db_ticontrole2->Close(); 
      }
      if(isset($this->Ini->nm_db_ima)){ 
        $this->Ini->nm_db_ima->Close(); 
      }
      if(isset($this->Ini->nm_db_med)){ 
        $this->Ini->nm_db_med->Close(); 
      }
      if(isset($this->Ini->nm_db_geral)){ 
        $this->Ini->nm_db_geral->Close(); 
      }
      if(isset($this->Ini->nm_db_dinamico)){ 
        $this->Ini->nm_db_dinamico->Close(); 
      }
      if(isset($this->Ini->nm_db_log_imp_mysql)){ 
        $this->Ini->nm_db_log_imp_mysql->Close(); 
      }
  }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode("_VLS_", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
          $tmp_cmd = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_fast'] = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'])) 
          {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig']; 
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'] . ")"; 
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'] = $tmp_cmd;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['fast_search']);
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "descricao") 
          {
              $this->SC_monta_condicao($comando, "descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "codigo_erp") 
          {
              $this->SC_monta_condicao($comando, "codigo_erp", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "qt_dias_producao") 
          {
              $this->SC_monta_condicao($comando, "qt_dias_producao", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "unid_medida") 
          {
              $this->SC_monta_condicao($comando, "unid_medida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "vl_custo_dolar") 
          {
              $this->SC_monta_condicao($comando, "vl_custo_dolar", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "vl_base_tributacao") 
          {
              $this->SC_monta_condicao($comando, "vl_base_tributacao", $arg_search, str_replace(",", ".", $data_search));
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
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_fast'] = $comando;
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq_filtro'] . ")"; 
          }
      }
      if (!empty($tmp_cmd)) 
      {
          $comando = $tmp_cmd . " and (" . $comando . ")"; 
      }
      else
      {
          $comando = " where (" . $comando . ")"; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['where_pesq'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['fast_search'][0] = $in_fields;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['fast_search'][2] = $sv_data;
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
      $nm_numeric[] = "item_proc_compra_id";$nm_numeric[] = "qt_dias_producao";$nm_numeric[] = "vl_custo_dolar";$nm_numeric[] = "vl_negociado";$nm_numeric[] = "vl_base_tributacao";$nm_numeric[] = "proc_compra_id";$nm_numeric[] = "qt_comprada";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['decimal_db'] == ".")
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
      $Nm_datas['dt_item_certificacao'] = 'date';
      if (isset($Nm_datas[$nome]))
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
      if (isset($Nm_datas[$campo_join]) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
         $nm_aspas  = "#";
         $nm_aspas1 = "#";
      }
      if (isset($Nm_datas[$campo_join]) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_sep_date']))
      {
          $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_sep_date'];
          $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['SC_sep_date1'];
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
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
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
  function html_doc_word($nm_arquivo_doc_word, $nmgp_password)
  {
      global $nm_url_saida;
      $Word_password = '__OMITIDO_NA_COPIA_DE_ANALISE__';
      if ($this->Ini->Export_zip || $Word_password != '__OMITIDO_NA_COPIA_DE_ANALISE__')
      { 
          $Parm_pass  = ($Word_password != '__OMITIDO_NA_COPIA_DE_ANALISE__') ? " -p" : "";
          $Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'], ".");
          if ($Pos !== false) {
              $Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'], 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_doc = $nm_arquivo_doc_word;
          $Pos = strrpos($nm_arquivo_doc_word, ".");
          if ($Pos !== false) {
              $Arq_doc = substr($nm_arquivo_doc_word, 0, $Pos);
          }
          $Arq_doc  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'], ' ')) ? " \"" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'] . "\"" :  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'];
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Word_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Word_password . " " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
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
               unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file']);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file'] = $Arq_zip;
               $nm_arquivo_doc_word = $Arq_doc;
          } 
      } 
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra']['word_file']);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_doc_word);
          $Temp = ob_get_clean();
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false || strpos(" " . $this->Ini->SC_module_export, "resume") !== false)
      {
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_word);
          $this->pb->completed();
          return;
      }
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Itens do Pedido de Importação(grid_itens_proc_compra) :: Doc</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
   <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" /> 
<?php
}
$path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">WORD</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . $nm_arquivo_doc_word ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_itens_proc_compra_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_itens_proc_compra"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($this->ret_word) ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
  }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      global $nm_url_saida;
      $Html_password = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != '__OMITIDO_NA_COPIA_DE_ANALISE__') ? " -p" : "";
          $Arq_zip   = $Arq_base;
          $Pos = strrpos($Arq_base, ".");
          if ($Pos !== false) {
              $Arq_zip = substr($Arq_base, 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_htm  = $nm_arquivo_html;
          $Pos = strrpos($nm_arquivo_html, ".");
          if ($Pos !== false) {
              $Arq_htm = substr($nm_arquivo_html, 0, $Pos);
          }
          $Arq_htm  .= ".zip";
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
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_asc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_asc;
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
               $nm_arquivo_html = $Arq_htm;
           } 
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_html);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_html;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_proc_compra'][$path_doc_md5][1] = substr($nm_arquivo_html, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_html);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_print);
          $this->pb->completed();
          return;
  }
} 
// 
//======= =========================
   if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['sc_process_barr'])) {
       return;
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   if (!function_exists("SC_dir_app_ini"))
   {
       include_once("../_lib/lib/php/nm_ctrl_app_name.php");
   }
   SC_dir_app_ini('Importacao');
   $_SESSION['scriptcase']['grid_itens_proc_compra']['contr_erro'] = 'off';
   $sc_conv_var = array();
   $Sc_lig_md5 = false;
   $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
   $_SESSION['scriptcase']['sem_session'] = false;
   if (!empty($_POST))
   {
       if (isset($_POST['parm']))
       {
           $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
       }
       foreach ($_POST as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_grid_itens_proc_compra($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_itens_proc_compra($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!empty($_GET))
   {
       if (isset($_GET['parm']))
       {
           $_GET['parm'] = str_replace("__NM_PLUS__", "+", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_AMP__", "&", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_PRC__", "%", $_GET['parm']);
       }
       foreach ($_GET as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_grid_itens_proc_compra($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_itens_proc_compra($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!isset($_SERVER['HTTP_REFERER']) && !isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start))
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
       elseif (is_file($root . $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['grid_itens_proc_compra']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "grid_itens_proc_compra") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_Importacao'])) {
               $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Importacao'];
           }
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
   if (isset($proc_compra_corrente)) 
   {
       $_SESSION['proc_compra_corrente'] = $proc_compra_corrente;
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
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_pai']))
   {
       $apl_pai = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_pai'];
       if (isset($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho']))
       {
           foreach ($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho'] as $init_filho)
           {
               if (isset($_SESSION['sc_session'][$init_filho]['grid_itens_proc_compra']['master_pai']) && $_SESSION['sc_session'][$init_filho]['grid_itens_proc_compra']['master_pai'] == $script_case_init)
               {
                   $script_case_init = $init_filho;
                   break;
               }
           }
       }
   }
   $nm_embutida_form = false;
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form'] && !isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['master_pai']))
   {
       $SC_init_ant = $script_case_init;
       if (isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_pai']))
       {
           $_SESSION['sc_session'][$SC_init_ant][$_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_pai']]['embutida_filho'][] = $script_case_init;
       }
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['master_pai'] = $SC_init_ant;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['master_pai']))
   {
       $SC_init_ant = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['master_pai'];
       if (!isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_parms']))
       {
           $_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_parms'] = "";
       }
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms'] = $_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_parms'];
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form'] = true;
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_full'] = (isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_full'])) ? $_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_full'] : false;
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['reg_start'] = "";
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = "inicio";
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form']);
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_proc_compra']['embutida_form_parms']);
       $nm_apl_dependente = 1;
       $nm_embutida_form  = true;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms'])) 
   {
       if (!empty($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms'])) 
       {
           $nmgp_parms = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms'];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms'] = "";
       }
   }
   elseif (isset($script_case_init))
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_full']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_parms']);
   }
   if (!isset($nmgp_opcao) || !isset($script_case_init) || ((!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']) && $nmgp_opcao != "formphp"))
   { 
       if (!empty($nmgp_parms)) 
       { 
           $nmgp_parms = NM_decode_input($nmgp_parms);
           $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
           $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
           $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
           $todo  = explode("?@?", $todox);
           foreach ($todo as $param)
           {
                $cadapar = explode("?#?", $param);
                if (1 < sizeof($cadapar))
                {
                    if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                    {
                        $cadapar[0] = substr($cadapar[0], 11);
                        $cadapar[1] = $_SESSION[$cadapar[1]];
                    }
                    if (isset($sc_conv_var[$cadapar[0]]))
                    {
                        $cadapar[0] = $sc_conv_var[$cadapar[0]];
                    }
                    elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
                    {
                        $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
                    }
                    nm_limpa_str_grid_itens_proc_compra($cadapar[1]);
                    nm_protect_num_grid_itens_proc_compra($cadapar[0], $cadapar[1]);
                    if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                    $Tmp_par   = $cadapar[0];
                    $$Tmp_par = $cadapar[1];
                }
           }
           if (isset($proc_compra_corrente)) 
           {
               $_SESSION['proc_compra_corrente'] = $proc_compra_corrente;
               nm_limpa_str_grid_itens_proc_compra($_SESSION["proc_compra_corrente"]);
           }
           $NMSC_conf_apl = array();
           if (isset($NMSC_inicial))
           {
               $NMSC_conf_apl['inicial'] = $NMSC_inicial;
           }
           if (isset($NMSC_rows))
           {
               $NMSC_conf_apl['rows'] = $NMSC_rows;
           }
           if (isset($NMSC_cols))
           {
               $NMSC_conf_apl['cols'] = $NMSC_cols;
           }
           if (isset($NMSC_paginacao))
           {
               $NMSC_conf_apl['paginacao'] = $NMSC_paginacao;
           }
           if (isset($NMSC_cab))
           {
               $NMSC_conf_apl['cab'] = $NMSC_cab;
           }
           if (isset($NMSC_nav))
           {
               $NMSC_conf_apl['nav'] = $NMSC_nav;
           }
           if (isset($NMSC_fix_bar_top))
           {
               $NMSC_conf_apl['fix_top'] = $NMSC_fix_bar_top;
           }
           if (isset($NMSC_fix_bar_bot))
           {
               $NMSC_conf_apl['fix_bot'] = $NMSC_fix_bar_bot;
           }
           if (isset($NM_run_iframe) && $NM_run_iframe == 1) 
           { 
               unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']);
               $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['b_sair'] = false;
           }   
       } 
   } 
   if (!isset($nmgp_opcao)) {
      $nmgp_opcao = "";
   }
   $ini_embutida = "";
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'])
   {
       $nmgp_outra_jan = "";
   }
   if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
   {
       $script_case_init = "";
   }
   if (isset($GLOBALS["script_case_init"]) && !empty($GLOBALS["script_case_init"]))
   {
       $ini_embutida = $GLOBALS["script_case_init"];
        if (!isset($_SESSION['sc_session'][$ini_embutida]['grid_itens_proc_compra']['embutida']))
        { 
           $_SESSION['sc_session'][$ini_embutida]['grid_itens_proc_compra']['embutida'] = false;
        }
        if (!$_SESSION['sc_session'][$ini_embutida]['grid_itens_proc_compra']['embutida'])
        { 
           $script_case_init = $ini_embutida;
        }
   }
   if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['protect_modal']) && !empty($_SESSION['scriptcase']['grid_itens_proc_compra']['protect_modal']))
   {
       $script_case_init = $_SESSION['scriptcase']['grid_itens_proc_compra']['protect_modal'];
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_emb    = false;
   $salva_iframe = false;
   if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu']);
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']))
   {
       $salva_emb = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']);
   }
   if (isset($nm_run_menu) && $nm_run_menu == 1 && !$salva_emb)
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "grid_itens_proc_compra";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'grid_itens_proc_compra' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
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
        $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu'] = $salva_iframe;
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['doc_word'] = false;
   $_SESSION['scriptcase']['saida_word'] = false;
   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_charts'] = false;
   }
   if (isset($_REQUEST['sc_create_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['skip_charts'] = 'N' == $_REQUEST['sc_create_charts'];
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'] = $salva_emb;

   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '/grid_itens_proc_compra/'))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize'] = false;
   }
   if ($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['initialize'])
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['tot_geral']);
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['contr_total_geral'] = "NAO";
   }

   $_POST['script_case_init'] = $script_case_init;
   if (!isset($nmgp_opcao) || empty($nmgp_opcao) || $nmgp_opcao == "grid" && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['b_sair'])))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['b_sair'] = true;
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
   if (isset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['lang'])) {
       $STR_lang = $_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['lang'];
   }
   $STR_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       $Lixo = file($NM_arq_lang);
       foreach ($Lixo as $Cada_lin) 
       {
           if (strpos($Cada_lin, "array()") === false && (trim($Cada_lin) != "<?php")  && (trim($Cada_lin) != "?" . ">"))
           {
               eval (str_replace("\$this->", "\$", $Cada_lin));
           }
       }
   }
   $_SESSION['scriptcase']['charset'] = "UTF-8";
   ini_set('default_charset', $_SESSION['scriptcase']['charset']);
   foreach ($Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'grid_itens_proc_compra')
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/grid_itens_proc_compra_erro.php");
   }
   $salva_tp_saida  = (isset($_SESSION['scriptcase']['sc_tp_saida']))  ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
   $salva_url_saida  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
   if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_proc_compra']))
   { 
       return;
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'] && $nmgp_opcao != "formphp")
   { 
       if ($nmgp_opcao == "change_lang" || $nmgp_opcao == "change_lang_res" || $nmgp_opcao == "change_lang_fil" || $nmgp_opcao == "force_lang")  
       { 
           if ($nmgp_opcao == "change_lang_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_lang_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_change_lang'] = true;
           unset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['tot_geral']);
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['contr_total_geral'] = "NAO";
           $Temp_lang = explode(";" , $nmgp_idioma);  
           if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
           { 
               $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
           } 
           if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
           { 
               $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
           } 
       } 
       if ($nmgp_opcao == "change_schema" || $nmgp_opcao == "change_schema_fil" || $nmgp_opcao == "change_schema_res")  
       { 
           if ($nmgp_opcao == "change_schema_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_schema_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $nmgp_schema = $nmgp_schema . "/" . $nmgp_schema;  
           $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['num_css'] = rand(0, 1000);
       } 
       if ($nmgp_opcao == "volta_grid")  
       { 
           $nmgp_opcao = "igual";  
       }   
       if (!empty($nmgp_opcao))  
       { 
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = $nmgp_opcao ;  
       }   
       if (isset($proc_compra_corrente) && isset($NM_contr_var_session) && $NM_contr_var_session == "Yes") 
       {
           nm_limpa_str_grid_itens_proc_compra($proc_compra_corrente);
           $_SESSION['proc_compra_corrente'] = $proc_compra_corrente;
       }
       if (isset($_POST["proc_compra_corrente"])) 
       {
           $_SESSION["proc_compra_corrente"] = $_POST["proc_compra_corrente"];
           nm_limpa_str_grid_itens_proc_compra($_SESSION["proc_compra_corrente"]);
       }
       if (isset($_GET["proc_compra_corrente"])) 
       {
           $_SESSION["proc_compra_corrente"] = $_GET["proc_compra_corrente"];
           nm_limpa_str_grid_itens_proc_compra($_SESSION["proc_compra_corrente"]);
       }
       if (!isset($_SESSION["proc_compra_corrente"])) 
       {
           $_SESSION["proc_compra_corrente"] = "";
       }
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['mostra_edit'])) 
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['mostra_edit'] = "S";
       }
       if (isset($nmgp_lig_edit_lapis)) 
       {
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['mostra_edit'] = $nmgp_lig_edit_lapis;
           unset($GLOBALS["nmgp_lig_edit_lapis"]) ;  
           if (isset($_SESSION['nmgp_lig_edit_lapis'])) 
           {
               unset($_SESSION['nmgp_lig_edit_lapis']);
           }
       }
       if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'] = true;
       }
       $nm_saida = "";
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_modal']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_modal'] = false;
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_apl']) && !empty($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_apl']))
       {
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_apl']; 
           $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_tp']; 
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_apl'] = "";
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['volta_redirect_tp'] = "";
           $nm_url_saida = "grid_itens_proc_compra_fim.php"; 
       
       }
       elseif (substr($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] != "pdf" ) 
       {
           if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'])
           {
               if ($nmgp_url_saida == "modal")
               {
                   $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_modal'] = true;
               }
               $nm_url_saida = "grid_itens_proc_compra_fim.php"; 
           }
           elseif (!$nm_embutida_form)
           {
               $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
               $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida);
               if (!empty($nmgp_url_saida)) 
               { 
                   $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['retorno_cons'] = $nmgp_url_saida ; 
               } 
               if (!empty($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['retorno_cons'])) 
               { 
                   $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['retorno_cons']  . "?script_case_init=" . NM_encode_input($script_case_init);  
                   $nm_apl_dependente = 1 ; 
               } 
               if (!empty($nm_url_saida)) 
               { 
                   $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida ; 
               } 
               $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
               $nm_url_saida = "grid_itens_proc_compra_fim.php"; 
               $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
               if ($nm_apl_dependente == 1) 
               { 
                   $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
               } 
           } 
       }
// 
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && substr($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] != "pdf" ) 
       { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
            $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['menu_desenv'] = true;   
       } 
       if (isset($nmgp_parms_ret)) 
       {
           $todo = explode(",", $nmgp_parms_ret);
           if (isset($sc_conv_var[$todo[2]]))
           {
               $todo[2] = $sc_conv_var[$todo[2]];
           }
           elseif (isset($sc_conv_var[strtolower($todo[2])]))
           {
               $todo[2] = $sc_conv_var[strtolower($todo[2])];
           }
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['form_psq_ret']  = $todo[0];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['campo_psq_ret'] = $todo[1];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['dado_psq_ret']  = $todo[2];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['js_apos_busca'] = $nm_evt_ret_busca;
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_psq'] = true;   
           if (isset($nmgp_iframe_ret)) {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_ret_cap'] = $nmgp_iframe_ret;
           }
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['psq_edit'] = 'N';   
           if (isset($nmgp_perm_edit)) {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['psq_edit'] = $nmgp_perm_edit;
           }
       } 
       elseif (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_psq']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_psq']  = false;   
           $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['psq_edit'] = 'N';   
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form'])
       {
           if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_full']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form_full'])
           {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['mostra_edit'] = "N";   
           } 
           $_SESSION['scriptcase']['sc_tp_saida']  = $salva_tp_saida;
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $salva_url_saida;
       } 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_proc_compra'] = "on";
       } 
       if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_proc_compra'] = "on";
       } 
       if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opc_psq'] && !isset($_SESSION['scriptcase']['grid_itens_proc_compra']['session_timeout']['redir'])) 
       { 
          if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_itens_proc_compra']) || $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_proc_compra'] != "on")
          { 
              $NM_Mens_Erro = $Nm_lang['lang_errm_unth_user'];
              $nm_botao_ok = ($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['iframe_menu']) ? false : true;
              if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
              {
                  foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
                  {
                      if (in_array("grid_itens_proc_compra", $apls_aba))
                      {
                          $nm_botao_ok = false;
                           break;
                      }
                  }
              }
              if ((isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida']) || (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida_form']))
              {
                   $nm_botao_ok = false;
              }
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
?>
             <!DOCTYPE html>
              <HTML>
               <HEAD>
                <TITLE>=)</TITLE>
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
 <META http-equiv="Pragma" content="no-cache" />
                <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>                <META http-equiv="Pragma" content="no-cache"/>
                <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
                <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $STR_schema_all ?>_grid.css" /> 
                <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $STR_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
               </HEAD>
               <body class="scGridPage">
                <table align="center"><tr><td style="padding: 0"><div class="scGridBorder">
                <table class="scGridTabela" width='100%' cellspacing=0 cellpadding=0><tr class="scGridFieldOdd"><td class="scGridFieldOddFont" style="padding: 15px 30px; text-align: center">
                 <?php echo $NM_Mens_Erro; ?>
<?php
              if ($nm_botao_ok)
              {
?>
                <br />
                <form name="Fseg" method="post" 
                                    action="<?php echo $nm_url_saida; ?>" 
                                    target="_self"> 
                 <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($script_case_init) ?>"/> 
                 <input type="submit" name="sc_sai_seg" value="OK"> 
                </form> 
<?php
              }
?>
                </td></tr></table>
                </div></td></tr></table>
<?php
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
              {
?>
<br /><br /><br />
<table align="center" style="width: 450px"><tr><td style="padding: 0"><div class="scGridBorder">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</div></td></tr></table>
<?php
              }
?>
               </body>
              </HTML>
<?php
              exit;
          } 
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['sc_outra_jan'])
       {
           $nm_apl_dependente = 0;
       }
       $contr_grid_itens_proc_compra = new grid_itens_proc_compra_apl();

      if ('ajax_autocomp' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = "busca";
          $contr_grid_itens_proc_compra->NM_ajax_flag = true;
          $contr_grid_itens_proc_compra->NM_ajax_opcao = $NM_ajax_opcao;
      }
      if ('ajax_filter_save' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = "busca";
          $contr_grid_itens_proc_compra->NM_ajax_flag = true;
          $contr_grid_itens_proc_compra->NM_ajax_opcao = "ajax_filter_save";
      }
      if ('ajax_filter_delete' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = "busca";
          $contr_grid_itens_proc_compra->NM_ajax_flag = true;
          $contr_grid_itens_proc_compra->NM_ajax_opcao = "ajax_filter_delete";
      }
      if ('ajax_filter_select' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] = "busca";
          $contr_grid_itens_proc_compra->NM_ajax_flag = true;
          $contr_grid_itens_proc_compra->NM_ajax_opcao = "ajax_filter_select";
      }
      if ('ajax_fixed_columns_grid_save' == $nmgp_opcao) {
          _df68fbe5a7063efd9dc0d6a311886d4d_saveFixedColumnsGrid($_POST['fixed_index'], $_POST['fixed_action'], $_POST['script_case_init']);
      }
      if ('ajax_fixed_columns_grid_load' == $nmgp_opcao) {
          _df68fbe5a7063efd9dc0d6a311886d4d_loadFixedColumnsGrid($_POST['script_case_init']);
      }
       $contr_grid_itens_proc_compra->controle();
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['embutida'] && $nmgp_opcao == "formphp")
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       $contr_grid_itens_proc_compra = new grid_itens_proc_compra_apl();
       $contr_grid_itens_proc_compra->controle();
   } 
//
   function nm_limpa_str_grid_itens_proc_compra(&$str)
   {
   }
   function nm_protect_num_grid_itens_proc_compra($name, &$val)
   {
       if (empty($val))
       {
          return;
       }
       $Nm_numeric = array();
       $Nm_numeric[] = "item_proc_compra_id";
       $Nm_numeric[] = "qt_dias_producao";
       $Nm_numeric[] = "vl_custo_dolar";
       $Nm_numeric[] = "vl_negociado";
       $Nm_numeric[] = "vl_base_tributacao";
       $Nm_numeric[] = "proc_compra_id";
       $Nm_numeric[] = "qt_comprada";
       $Nm_numeric[] = "";
       $simb_grp = (isset($_SESSION['scriptcase']['reg_conf']['grup_num'])) ? $_SESSION['scriptcase']['reg_conf']['grup_num'] : ".";
       $simb_dec = (isset($_SESSION['scriptcase']['reg_conf']['dec_num']))  ? $_SESSION['scriptcase']['reg_conf']['dec_num']  : ",";
       $simb_neg = (isset($_SESSION['scriptcase']['reg_conf']['simb_neg'])) ? $_SESSION['scriptcase']['reg_conf']['simb_neg'] : "-";
       if (in_array($name, $Nm_numeric))
       {
           if (is_array($val))
           {
               foreach ($val as $cada_val)
               {
                  $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
                  if ($tmp_pos !== false)
                   {
                      $cada_val = substr($cada_val, 0, $tmp_pos);
                  }
                  for ($x = 0; $x < strlen($cada_val); $x++)
                  {
                      if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
                      {
                          $val = array();
                          return;
                      }
                   }
               }
               return;
           }
           $cada_val = $val;
           $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
           if ($tmp_pos !== false)
            {
               $cada_val = substr($cada_val, 0, $tmp_pos);
           }
           for ($x = 0; $x < strlen($cada_val); $x++)
           {
               if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
               {
                   $val = 0;
                   return;
               }
           }
       }
   }
   function grid_itens_proc_compra_pack_protect_string($sString)
   {
      $sString = (string) $sString;
      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
             return sc_htmlentities($sString);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   }

    function grid_itens_proc_compra_pdf_progress_call($message, $Nm_lang, $flushBuffer = false) {
        $message = trim($message);
        if ('off' == $message)
        {
            $bol_end = TRUE;
        }
        elseif (false !== strpos($message, 'HDOC_#NM#_'))
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (4 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $str_msg  = ('F' == $arr_partes[2]) ? $Nm_lang['lang_pdff_frmt_page']  : $Nm_lang['lang_pdff_wrtg'];
                $str_msg .= $arr_partes[2];
                $int_step = ('F' == $arr_partes[2]) ? floor($int_size * 0.9) : floor($int_size * 0.95);
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        else
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (3 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $int_step = $arr_partes[1];
                $str_msg  = $arr_partes[2];
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        $return_message = $int_size . '!#!' . $int_step . '!#!' . ($bol_end ? '1' : '0') . '!#!' . ($bol_end ? $Nm_lang['lang_pdff_fnsh'] : $str_msg);
?>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateProgressBar === "function") {
    window.parent.updateProgressBar("<?php echo trim($return_message); ?>");
}
</script>
<?php
        global $script_case_init;
        if ($flushBuffer && $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['opcao'] != 'print') {
            $bufferSize = @ini_get('output_buffering');
            if ('' != $bufferSize) {
                echo str_repeat('&nbsp;', $bufferSize * 5);
            }
        }
        flush();
    }

    function _df68fbe5a7063efd9dc0d6a311886d4d_initializeFixedColumnsGrid($script_case_init)
    {
        if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid'])) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid'] = '';
        }
    }

    function _df68fbe5a7063efd9dc0d6a311886d4d_saveFixedColumnsGrid($index, $action, $script_case_init)
    {
        _df68fbe5a7063efd9dc0d6a311886d4d_initializeFixedColumnsGrid($script_case_init);

        if ('on' == $action) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid'] = $index;
        } elseif (0 < $index) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid'] = $index - 1;
        } else {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid'] = '';
        }

        echo json_encode(
            array(
                'status' => 'ok'
            )
        );
        exit;
    }

    function _df68fbe5a7063efd9dc0d6a311886d4d_loadFixedColumnsGrid($script_case_init)
    {
        _df68fbe5a7063efd9dc0d6a311886d4d_initializeFixedColumnsGrid($script_case_init);

        echo json_encode(
            array(
                'status' => 'ok',
                'last_index' =>$_SESSION['sc_session'][$script_case_init]['grid_itens_proc_compra']['fixed_columns_grid']
            )
        );
        exit;
    }

?>
