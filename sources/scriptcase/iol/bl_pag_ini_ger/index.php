<?php
   include_once('bl_pag_ini_ger_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_medw']         = "medw";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_integracoes']         = "integracoes";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_dinamico']         = "dinamico";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ticontrole']         = "ticontrole";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_wdfe']         = "wdfe";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_tss']         = "tss";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_correio']         = "correio";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_pendencias']         = "pendencias";
   $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_fnd']         = "fnd";
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
    if(empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class bl_pag_ini_ger_ini
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
   var $nm_db_especw;
   var $nm_con_especw = array();
   var $nm_db_log_db;
   var $nm_con_log_db = array();
   var $nm_db_ima;
   var $nm_con_ima = array();
   var $nm_db_med;
   var $nm_con_med = array();
   var $nm_db_medw;
   var $nm_con_medw = array();
   var $nm_db_ems5;
   var $nm_con_ems5 = array();
   var $nm_db_comum;
   var $nm_con_comum = array();
   var $nm_db_multi;
   var $nm_con_multi = array();
   var $nm_db_cfsc;
   var $nm_con_cfsc = array();
   var $nm_db_integracoes;
   var $nm_con_integracoes = array();
   var $nm_db_geral;
   var $nm_con_geral = array();
   var $nm_db_dinamico;
   var $nm_con_dinamico = array();
   var $nm_db_ticontrole;
   var $nm_con_ticontrole = array();
   var $nm_db_wdfe;
   var $nm_con_wdfe = array();
   var $nm_db_tss;
   var $nm_con_tss = array();
   var $nm_db_correio;
   var $nm_con_correio = array();
   var $nm_db_pendencias;
   var $nm_con_pendencias = array();
   var $nm_db_fnd;
   var $nm_con_fnd = array();
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_export_ajax = false;
   var $sc_export_ajax_img = false;
   var $force_db_utf8 = false;
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
      $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "bl_pag_ini_ger"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "ImaOnLine"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "thiago"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20251203"; 
      $this->nm_hr_criacao   = "095826"; 
      $this->nm_autor_alt    = "thiago"; 
      $this->nm_dt_ult_alt   = "20261002"; 
      $this->nm_hr_ult_alt   = "111551"; 
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
      $this->path_prod       = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_doc'];
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
      if (!isset($_SESSION['scriptcase']['bl_pag_ini_ger']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['bl_pag_ini_ger']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['bl_pag_ini_ger']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_BlueBerry/Sc9_BlueBerry";
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['sub_cons_schema_filter'];
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
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/bl_pag_ini_ger';
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
      $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
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

      if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['bl_pag_ini_ger']['actual_lang']) || $_SESSION['scriptcase']['bl_pag_ini_ger']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['bl_pag_ini_ger']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_ImaOnLine',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
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
          include_once("bl_pag_ini_ger_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
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
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['ancor_save'] = $_POST['ancor_save'];
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_pag_ini_ger"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_pag_ini_ger"] as $sTmpTargetLink => $sTmpTargetWidget)
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
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['link_info']['margin_top'] = $link_margin_top;
        }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      asort($this->Nm_lang_conf_region);
      $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "UTF-8";
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
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir']))
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
      if (isset($_POST['nm_grid_submit']) && $_POST['nm_grid_submit'] == 1 && isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['csrf_token'] ) && !isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida']) && !isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida_form'])) {
          if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['csrf_token']) {
              echo "<html>";
              echo "<body>";
              echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
              echo "<tr>";
              echo "   <td align=\"center\">";
              echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_csrf'] . "</font>";
              echo "   </b></td>";
              echo " </tr>";
              echo "</table>";
              echo "</body>";
              echo "</html>";
              exit;
          }
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
      $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['path_doc'] = $this->path_doc; 
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan'])) 
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
      include_once($this->path_aplicacao . "bl_pag_ini_ger_erro.class.php"); 
      $this->Erro = new bl_pag_ini_ger_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('bl_pag_ini_ger'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'])) 
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
      if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir'])) {
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
          if ($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir_tp'] == "R") {
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
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']);
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
      $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQJKH9BiHAvCD5F7DMNOVcBODuX7VoFGDcFYH9BOHAvCD5JeHgvsHEJGDWXCHIJsD9XsZ9JeD1BeD5F7DMvmVcBUDWJeHMBiD9BsVIraD1rwV5X7HgBeHErsDWr/VoBiD9JKZ9XGHIrKHuBqHgrwVcB/DuX7DoXGD9BsZSB/HABYHQBqHgrKVkJqDWFGZuBqHQNwDQJsHArYHuFaHuNOZSrCH5FqDoXGHQJmZ1rqD1rwD5F7DMNKZSXeDWr/DoJeD9XsZSX7Z1N7VWFaHgrKV9FeDWXCDoJsDcBwH9B/Z1rYHQJwHgvCZSXeDWr/VoX7DcXOZSFGHAveV5FUHgrKDkB/V5X7DoFGD9BsZSB/DSrYD5BiDMzGZSXeDWFqDoJeHQXGH9FGHAveD5BOHuzGVcFeDWXCDoJsDcBwH9B/Z1rYHQJwHgNKHEJqDWX7VoBiD9XsH9BiZ1rwV5BOHgrYDkB/V5X7HMB/D9XGZ1FGHArKV5FUDMrYZSXeV5FqHIJsHQNmDuBqDSN7HurqDMBODkB/DWXCHIrqDcFYVIJwZ1vOZMBqHgBOVkJqDWr/HMFaHQXOZ9JeZ1BYHurqHgrwVcFeH5XKVENUHQBiVIraZ1rYHuJwHgBOHArsH5FGZuBqHQFYDQBOD1BeD5rqHuvmVcBOH5B7VoBqHQBiZkBiDSvmZMBqHgveZSJqDWr/HIraHQFYDuBOZ1zGVWXGDMvmVcB/DWXKVEraHQBiZ1FUZ1vOD5XGHgNKHErsDWB3ZuBOHQJKDuBOZ1zGVWBqDMBYVcXKHEBmVEraHQNwZkFUD1rwV5FGDEBeHEXeH5X/DoF7HQJwZ9JeDSvCD5FaHgNKVcFeHEFYDorqDcBwZ1F7Z1rYZMFaDEBOHEBUH5F/VoXGD9NwDQJsHIBeD5JwHgNKVcFeHEFYHMJsD9XOVIJwHArKD5NUDErKVkXeH5FGDoNUD9NwZSX7HIrKV5JwHuBYDkBOV5BmDoJeDcBwZ1rqDSrYD5FaDEvsHAFKDWF/DoF7DcJeDQX7Z1vCV5BiHuBYVcFCH5FqDoraDcBwZ1F7HArYV5JeDEvsHEFiDuJeVoB/D9NwZ9JeHAveV5JwHgrKZSrCDWXCVENUD9JmZ1F7HArYV5X7DMrYHEFiDWXCDoB/D9NwZ9JeHAveD5rqHuvmVcBOH5FqDoraD9BsZSFaD1rwV5JeDEBOVkXeDuXKVoBiDcJUZSX7HIBeD5BqHgvsZSJ3H5FqHMBqHQBqZSBqHINKZMFaHgBYHENiDWX7HMJsHQXGDQFUHIrwHuJwDMvOZSNiDWJeHMBOHQFYZkFGHAN7HuFaHgBOHErCHEFaHIBiHQXGDuFaDSrwHQJsHgvOV9FeHEBmVEX7DcBwH9B/HIrwV5JeDMBYDkBsH5FYHIF7HQJeH9FUDSN7HQF7DMBYV9FeDuFqHMBOHQFYZ1BOHAvsD5JeDMvCHArCDWXCHIFGHQXGDQFUHANOHQJeDMNOV9BUDWrmVoX7HQFYZ1BOHAN7HQFGDMvCHENiDWXCHMJsDcJUZSX7HIBeD5BqHgvsZSJ3H5FqHIrqHQBqZSBqHABYHQJsHgBOVkJ3V5XCHMJeHQXGDuFaD1veHQJeHgrwV9BUDWF/HMXGHQFYZ1BOD1rwHQBqHgBOHENiDWX7HMBqHQXGDuFaDSvCVWBqDMvmVIBsV5BmVEFGDcBwH9B/HIrwV5JeDMBYDkBsH5FYDoXGDcJeZSFUZ1rwV5JeHgvsVcFCH5XCDoX7DcNwVIJwZ1BeZMBqDMBYHEJGDWrGDoB/D9NmZSFGHIrwVWXGDMrwDkBOH5FqDoJeD9JmZ1B/HArYV5FUDEvsHEBUH5X/DoB/DcJeZSX7HIBeD5BqHgrKVcBOV5F/VENUHQNmZkFUZ1BeZMBODMzGHEXeDWrGZuBqHQXGZSFGHIrwD5JwHgvsZSrCV5X7VoFGDcBqVIJsDSvOZMXGHgvCDkBsH5FYVoX7D9JKDQX7D1BOV5FGHuzGDkBOH5FqVoJwD9JmZ1F7Z1BeD5JeDEvsHENiV5FaVoB/D9XsDQX7HArYD5BqHuNOVcFeDWXCDoJsDcBwH9B/Z1rYHQJwHgveDkXKDWBmDoJeHQXOZ9XGHAvOV5JeDMvOVcBUDWJeHMBiD9BsVIraD1rwV5X7HgBeHErCDuFaZuBOHQXOZSFGHAveV5JwDMvmZSJqH5FqVoBiHQBqZ1FGDSvOV5X7HgBeHEFiV5B3DoF7D9XsDuFaHAveHQXGHgrKVcBOH5XCVENUDcJUZ1FaHIveZMB/DEBeHEXeDuX/DoNUHQNwDQX7Z1BYV5JeHuNODkFCDWJeVENUDcBqVIFGHIBYD5rqDEBODkBsDWF/VoB/DcJUDQFaHABYVWBOHuzGVcFKV5X7VoX7D9BiZ1F7HAveV5BOVgBYZSXeV5XKDoNUHQNmDQJwD1veD5JsHgvsV9FeDWXCDoJsDcBwH9B/Z1rYHQJwHgBYHAFKV5B3DoBO";
      $this->prep_conect();
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_BlueBerry_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_BlueBerry_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
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
              if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']) && $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil']) && $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']))
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
          db_conect_devel($con_devel, $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('especw', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('log_db', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('ima', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('med', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('medw', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_medw['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_medw['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_medw['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_medw['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_medw['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_medw['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_medw['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_medw['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_medw['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_medw['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_medw['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_medw['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_medw['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_medw['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_medw['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_medw['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('ems5', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('comum', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('multi', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('cfsc', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('integracoes', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_integracoes['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_integracoes['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_integracoes['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_integracoes['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_integracoes['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_integracoes['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_integracoes['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_integracoes['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_integracoes['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_integracoes['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_integracoes['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_integracoes['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_integracoes['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_integracoes['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_integracoes['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_integracoes['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('geral', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('dinamico', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
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
          db_conect_devel('ticontrole', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_ticontrole['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ticontrole['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ticontrole['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ticontrole['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ticontrole['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ticontrole['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ticontrole['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ticontrole['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ticontrole['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_ticontrole['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_ticontrole['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_ticontrole['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_ticontrole['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_ticontrole['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ticontrole['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('wdfe', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_wdfe['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_wdfe['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_wdfe['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_wdfe['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_wdfe['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_wdfe['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_wdfe['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_wdfe['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_wdfe['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_wdfe['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_wdfe['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_wdfe['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_wdfe['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_wdfe['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_wdfe['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_wdfe['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('tss', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_tss['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_tss['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_tss['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_tss['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_tss['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_tss['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_tss['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_tss['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_tss['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_tss['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_tss['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_tss['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_tss['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_tss['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_tss['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_tss['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('correio', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_correio['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_correio['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_correio['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_correio['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_correio['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_correio['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_correio['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_correio['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_correio['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_correio['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_correio['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_correio['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_correio['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_correio['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_correio['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_correio['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('pendencias', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_pendencias['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_pendencias['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_pendencias['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_pendencias['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_pendencias['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_pendencias['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_pendencias['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_pendencias['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_pendencias['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_pendencias['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_pendencias['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_pendencias['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_pendencias['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_pendencias['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_pendencias['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_pendencias['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('fnd', $this->root . $this->path_prod, 'ImaOnLine', 2, $this->force_db_utf8); 
          $this->nm_con_fnd['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_fnd['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_fnd['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_fnd['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_fnd['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_fnd['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_fnd['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_fnd['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_fnd['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_fnd['nm_arr_db_extra_args'] = array(); 
          $this->nm_con_fnd['nm_con_db2'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_autocommit']) && !empty($_SESSION['scriptcase']['glo_db2_autocommit']))
          {
              $this->nm_con_fnd['nm_con_db2']['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']) && !empty($_SESSION['scriptcase']['glo_db2_i5_lib']))
          {
              $this->nm_con_fnd['nm_con_db2']['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']) && !empty($_SESSION['scriptcase']['glo_db2_i5_naming']))
          {
              $this->nm_con_fnd['nm_con_db2']['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
          }
          if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']) && !empty($_SESSION['scriptcase']['glo_db2_i5_commit']))
          {
              $this->nm_con_fnd['nm_con_db2']['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_fnd['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
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
      if (isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_especw['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_especw['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_especw['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_especw['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_especw['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_especw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_especw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_especw['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_especw['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_log_db['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_db['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_db['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_db['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_db['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_db['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_db['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_db['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_db['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ima['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ima['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ima['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ima['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ima['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ima['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ima['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_med['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_med['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_med['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_med['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_med['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_med['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_med['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_medw'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_medw['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_medw['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_medw['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_medw['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_medw['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_medw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_medw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_medw['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_medw['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems5['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_comum['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comum['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comum['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comum['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comum['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comum['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comum['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comum['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comum['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_multi['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_multi['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_multi['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_multi['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_multi['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_multi['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_multi['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_multi['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_multi['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_cfsc['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_cfsc['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_cfsc['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_cfsc['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_cfsc['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_cfsc['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_cfsc['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_cfsc['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_cfsc['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_integracoes'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_integracoes['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_integracoes['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_integracoes['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_integracoes['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_integracoes['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_integracoes['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_integracoes['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_integracoes['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_integracoes['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_geral['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_geral['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_geral['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_geral['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_geral['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_geral['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_geral['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_geral['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_geral['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_dinamico['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_dinamico['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_dinamico['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_dinamico['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_dinamico['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_dinamico['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_dinamico['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_dinamico['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_dinamico['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_ticontrole'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ticontrole['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ticontrole['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ticontrole['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ticontrole['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ticontrole['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ticontrole['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ticontrole['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_wdfe'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_wdfe['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_wdfe['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_wdfe['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_wdfe['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_wdfe['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_wdfe['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_wdfe['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_wdfe['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_wdfe['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_tss'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_tss['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_tss['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_tss['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_tss['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_tss['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_tss['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_tss['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_tss['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_tss['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_correio'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_correio['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_correio['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_correio['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_correio['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_correio['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_correio['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_correio['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_correio['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_correio['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_pendencias'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_pendencias['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_pendencias['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_pendencias['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_pendencias['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_pendencias['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_pendencias['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_pendencias['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_pendencias['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_pendencias['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_con_fnd'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_fnd['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_fnd['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_fnd['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_fnd['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_fnd['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_fnd['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_fnd['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_fnd['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_fnd['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida_init']) 
      {
          if (!isset($_SESSION['usr_login'])) 
          {
              $this->nm_falta_var .= "usr_login; ";
          }
          if (!isset($_SESSION['lista_reps_ger'])) 
          {
              $this->nm_falta_var .= "lista_reps_ger; ";
          }
          if (!isset($_SESSION['tipoUsuario'])) 
          {
              $this->nm_falta_var .= "tipoUsuario; ";
          }
          if (!isset($_SESSION['nomeRepresIni'])) 
          {
              $this->nm_falta_var .= "nomeRepresIni; ";
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
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date1'];
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan'])) 
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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_conexao'], $this->root . $this->path_prod, 'ImaOnLine', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida'])
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
          $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida'])
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
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_medw['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_medw['nm_arr_db_extra_args'])?$this->nm_con_medw['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_medw['nm_con_db2'])?$this->nm_con_medw['nm_con_db2']:array();
      $this->nm_db_medw = db_conect($this->nm_con_medw['tpbanco'], $this->nm_con_medw['servidor'], $this->nm_con_medw['usuario'], $this->nm_con_medw['senha'], $this->nm_con_medw['banco'], $this->nm_con_medw['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_medw['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_medw['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_medw->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_medw->Execute("set dateformat ymd");
          $this->nm_db_medw->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_medw['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_medw->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_medw['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_medw->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_medw->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_medw['decimal'] = "."; 
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
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_integracoes['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_integracoes['nm_arr_db_extra_args'])?$this->nm_con_integracoes['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_integracoes['nm_con_db2'])?$this->nm_con_integracoes['nm_con_db2']:array();
      $this->nm_db_integracoes = db_conect($this->nm_con_integracoes['tpbanco'], $this->nm_con_integracoes['servidor'], $this->nm_con_integracoes['usuario'], $this->nm_con_integracoes['senha'], $this->nm_con_integracoes['banco'], $this->nm_con_integracoes['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_integracoes['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_integracoes['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_integracoes->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_integracoes->Execute("set dateformat ymd");
          $this->nm_db_integracoes->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_integracoes['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_integracoes->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_integracoes['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_integracoes->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_integracoes->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_integracoes['decimal'] = "."; 
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
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ticontrole['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ticontrole['nm_arr_db_extra_args'])?$this->nm_con_ticontrole['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_ticontrole['nm_con_db2'])?$this->nm_con_ticontrole['nm_con_db2']:array();
      $this->nm_db_ticontrole = db_conect($this->nm_con_ticontrole['tpbanco'], $this->nm_con_ticontrole['servidor'], $this->nm_con_ticontrole['usuario'], $this->nm_con_ticontrole['senha'], $this->nm_con_ticontrole['banco'], $this->nm_con_ticontrole['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ticontrole['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ticontrole['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ticontrole->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ticontrole->Execute("set dateformat ymd");
          $this->nm_db_ticontrole->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ticontrole['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ticontrole->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ticontrole['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ticontrole->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ticontrole->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ticontrole['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_wdfe['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_wdfe['nm_arr_db_extra_args'])?$this->nm_con_wdfe['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_wdfe['nm_con_db2'])?$this->nm_con_wdfe['nm_con_db2']:array();
      $this->nm_db_wdfe = db_conect($this->nm_con_wdfe['tpbanco'], $this->nm_con_wdfe['servidor'], $this->nm_con_wdfe['usuario'], $this->nm_con_wdfe['senha'], $this->nm_con_wdfe['banco'], $this->nm_con_wdfe['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_wdfe['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_wdfe['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_wdfe->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_wdfe->Execute("set dateformat ymd");
          $this->nm_db_wdfe->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_wdfe['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_wdfe->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_wdfe['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_wdfe->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_wdfe->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_wdfe['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_tss['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_tss['nm_arr_db_extra_args'])?$this->nm_con_tss['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_tss['nm_con_db2'])?$this->nm_con_tss['nm_con_db2']:array();
      $this->nm_db_tss = db_conect($this->nm_con_tss['tpbanco'], $this->nm_con_tss['servidor'], $this->nm_con_tss['usuario'], $this->nm_con_tss['senha'], $this->nm_con_tss['banco'], $this->nm_con_tss['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_tss['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_tss['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_tss->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_tss->Execute("set dateformat ymd");
          $this->nm_db_tss->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_tss['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_tss->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_tss['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_tss->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_tss->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_tss['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_correio['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_correio['nm_arr_db_extra_args'])?$this->nm_con_correio['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_correio['nm_con_db2'])?$this->nm_con_correio['nm_con_db2']:array();
      $this->nm_db_correio = db_conect($this->nm_con_correio['tpbanco'], $this->nm_con_correio['servidor'], $this->nm_con_correio['usuario'], $this->nm_con_correio['senha'], $this->nm_con_correio['banco'], $this->nm_con_correio['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_correio['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_correio['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_correio->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_correio->Execute("set dateformat ymd");
          $this->nm_db_correio->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_correio['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_correio->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_correio['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_correio->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_correio->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_correio['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_pendencias['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_pendencias['nm_arr_db_extra_args'])?$this->nm_con_pendencias['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_pendencias['nm_con_db2'])?$this->nm_con_pendencias['nm_con_db2']:array();
      $this->nm_db_pendencias = db_conect($this->nm_con_pendencias['tpbanco'], $this->nm_con_pendencias['servidor'], $this->nm_con_pendencias['usuario'], $this->nm_con_pendencias['senha'], $this->nm_con_pendencias['banco'], $this->nm_con_pendencias['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_pendencias['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_pendencias['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_pendencias->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_pendencias->Execute("set dateformat ymd");
          $this->nm_db_pendencias->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_pendencias['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_pendencias->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_pendencias['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_pendencias->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_pendencias->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_pendencias['decimal'] = "."; 
      } 
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_fnd['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_fnd['nm_arr_db_extra_args'])?$this->nm_con_fnd['nm_arr_db_extra_args']:array();
      $nm_con_db2 = isset($this->nm_con_fnd['nm_con_db2'])?$this->nm_con_fnd['nm_con_db2']:array();
      $this->nm_db_fnd = db_conect($this->nm_con_fnd['tpbanco'], $this->nm_con_fnd['servidor'], $this->nm_con_fnd['usuario'], $this->nm_con_fnd['senha'], $this->nm_con_fnd['banco'], $this->nm_con_fnd['protect'], 'S', 'N', $nm_con_db2, $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_fnd['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_fnd['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_fnd->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_fnd->Execute("set dateformat ymd");
          $this->nm_db_fnd->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_fnd['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_fnd->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_fnd['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_fnd->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_fnd->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_fnd['decimal'] = "."; 
      } 
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['embutida'])
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

   function scCsrfGetToken()
   {
       if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['csrf_token']))
       {
           $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['csrf_token'] = $this->scCsrfGenerateToken();
       }

       return $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['csrf_token'];
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_sep_date1'];
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
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_pag_ini_ger']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
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
class bl_pag_ini_ger_apl
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

      $this->Ini = new bl_pag_ini_ger_ini(); 
      $this->Ini->init();
      $this->Change_Menu = false;
      if (isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_pag_ini_ger']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_pag_ini_ger'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_pag_ini_ger']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_pag_ini_ger']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('bl_pag_ini_ger') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_pag_ini_ger']['label'] = "" . $this->Ini->Nm_lang['lang_othr_blank_title'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "bl_pag_ini_ger")
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
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['bl_pag_ini_ger']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['bl_pag_ini_ger']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['bl_pag_ini_ger']['exit'];
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
      include_once($this->Ini->path_aplicacao . "bl_pag_ini_ger_erro.class.php"); 
      $this->Erro      = new bl_pag_ini_ger_erro();
      $this->Erro->Ini = $this->Ini;
//
      header("X-XSS-Protection: 1; mode=block");
      header("X-Frame-Options: SAMEORIGIN");
      
/*----- Scriptcase Locale: Event onExecute ------*/
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['nomeRepresIni'])) {$_SESSION['nomeRepresIni'] = "";}
if (!isset($this->sc_temp_nomeRepresIni)) {$this->sc_temp_nomeRepresIni = (isset($_SESSION['nomeRepresIni'])) ? $_SESSION['nomeRepresIni'] : "";}
if (!isset($_SESSION['tipoUsuario'])) {$_SESSION['tipoUsuario'] = "";}
if (!isset($this->sc_temp_tipoUsuario)) {$this->sc_temp_tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";}
if (!isset($_SESSION['lista_reps_ger'])) {$_SESSION['lista_reps_ger'] = "";}
if (!isset($this->sc_temp_lista_reps_ger)) {$this->sc_temp_lista_reps_ger = (isset($_SESSION['lista_reps_ger'])) ? $_SESSION['lista_reps_ger'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  $meta = 0;
$codRepLogin = $this->buscarCodRep($this->sc_temp_usr_login);
$mesCor      = date('m');
$anoCor      = date('Y');
$diaCor      = date('d');
$listRep = $this->sc_temp_lista_reps_ger;
$logVendedor = $this->verifVendedor();
if($this->sc_temp_tipoUsuario == 3 or $this->sc_temp_tipoUsuario == 4 ){
	
	$faturGer  = $this->getDadosFatsRepres('mes_corrente','vl_faturamento',00000,99999,$listRep,$mesCor);
	$devGer    = $this->getDadosFatsRepres('mes_corrente','vl_devolucoes',00000,99999,$listRep,$mesCor);
	$fatTotLiq = $faturGer - $devGer; 
}
if($this->sc_temp_tipoUsuario == 2 and $logVendedor){	
	$faturRep    = $this->getDadosFatsRepres('mes_corrente','vl_faturamento',$codRepLogin,$codRepLogin,'',$mesCor);
	$devolRep    = $this->getDadosFatsRepres('mes_corrente','vl_devolucoes',$codRepLogin,$codRepLogin,'',$mesCor);
	$fatTotLiq   = $faturRep - $devolRep; 
	$metaQuinz   = $this->getMetaQuinzenalCor($codRepLogin);
	$aMeta       = $this->getMetaCorrentePorListaRepres($codRepLogin);
	if($aMeta){
		$meta        = $aMeta['vl_meta_corrente'];
	}
}
$fatTotLiqFormatado = $this->formatarPreco('real', $fatTotLiq);
$codRepGer = $this->buscarCodRep($this->sc_temp_usr_login);
$tpGer = $this->getTpHierarquiaGer($codRepGer);
if($this->sc_temp_tipoUsuario == 4 or $this->sc_temp_tipoUsuario == 3){
	if($listRep <> '' or $tpGer == 3){		
	if($tpGer == 3){
		$meta = $this->getMetasGerentes($codRepGer,$mesCor,$anoCor);
		$metaQuinz     = 0;
	}else{
		$aMetaHierarq  = $this->getMetaCorrentePorListaRepres($listRep,$mesCor);
		$metaQuinz     = $aMetaHierarq['vl_quinz_total'];
		$meta          = $aMetaHierarq['vl_total'];
	}		
	}else{
		$meta          = $this->getMetaGeral($mesCor,$anoCor);
		$metaQuinz     = $this->getMetaMesCorrente($mesCor,'quinzenal');
	}
}

$metaQuinzFormatada = $this->formatarPreco('real',$metaQuinz);
$metaFormatada = $this->formatarPreco('real',$meta);
if($meta <> 0 and $fatTotLiq <> 0){
    $perc = round(($fatTotLiq / $meta * 100),2);
}else{
    $perc = 0;
}
$perc_progress = $perc."%";
$perc_progress = str_replace(',','.',$perc_progress);

if($this->sc_temp_tipoUsuario == 3 or $this->sc_temp_tipoUsuario == 4){
	if($listRep <> ''){
		$qtPedsAberto = $this->getQtPedsAberto(0,0,'ger',$listRep);
		$qtPedsGerenciais = $this->getQtPedsGerecial($this->sc_temp_tipoUsuario,$this->sc_temp_usr_login,$listRep);
	}else{
		$qtPedsAberto = $this->getQtPedsAberto("aaaaaa","zzzzzz");
		$qtPedsGerenciais = $this->getQtPedsGerecial($this->sc_temp_tipoUsuario,$this->sc_temp_usr_login);
	}	
}else{ 
	$qtPedsAberto = $this->getQtPedsAberto("$this->sc_temp_nomeRepresIni","$this->sc_temp_nomeRepresIni");
	$qtPedsGerenciais = $this->getQtPedsGerecial($this->sc_temp_tipoUsuario,$this->sc_temp_usr_login,$codRepLogin);
}



$aDiasUteis = $this->diasUteisMes();

$qtDiasMes = $aDiasUteis['qt_dias_uteis'];
$qtDias    = $aDiasUteis['qt_dias_passados'];
$qtDiasRestantes = $aDiasUteis['qt_dias_restantes'];


$aVendedores = $this->getVendedores();
$listaVend = $aVendedores['lista_completa'];
	
$aMeta = $this->getMetaCorrentePorListaRepres($listaVend);
		
$aVenda = $this->getTotVendNfMes('med'," and nf.\"cod-rep\" in ($listaVend)",false);
$venda  = $aVenda['total'];
    
$aDev = $this->getTotDevNfMes('med'," and venda.\"cod-rep\" in ($listaVend)",false);
    	
if(isset($aDev['total'])){
	$devolucao = $aDev['total'];
}	

$metaVendedores = $this->getMetasGerentes(11130,$mesCor,$anoCor); 
$metaVendedores = $metaVendedores / 2;

$vendaVendedores = $aVenda['total'];

if(isset($aDev['total'])){
	$devVendedores = $aDev['total'];
}

$metaIdeal = $metaVendedores / $qtDiasMes * $qtDias;
if($metaVendedores <> 0) {
    $percMetaIdeal = round($metaIdeal / $metaVendedores * 100, 0);
}else{
    $percMetaIdeal = 0;
}
$percMetaIdealFormat = number_format($percMetaIdeal,0,',','.');
$percMetaIdealFormat .= "%";
$percMetaIdealFormat = str_replace(',','.',$percMetaIdealFormat);
if($metaVendedores <> 0){
    $percVendVendedores = round($vendaVendedores / $metaVendedores * 100 , 0);
}else{
    $percVendVendedores = 0;
}
$percVendVendedoresFormat = number_format($percVendVendedores,0,',','.');
$percVendVendedoresFormat .= "%";
$percVendVendedoresFormat = str_replace(',','.',$percVendVendedoresFormat);


$aListaVend = explode(',',$listaVend);
    $aDadosVend = array();
    if(is_array($aListaVend)){
        $tam = count($aListaVend);
        for($i=0;$i < $tam;$i++){
            $codRep = $aListaVend[$i];
            if(isset($aMeta['meta_vend'][$codRep])){
                $metaVend =  $aMeta['meta_vend'][$codRep];
            }else{
                $metaVend = 0;
            }
            if(isset($aVenda['nf'][$codRep])){
                $vendaVend =  $aVenda['nf'][$codRep];
            }else{
                $vendaVend = 0;
            }
            if(isset($aVenda['desc'][$codRep])){
                $descVendaVend =  $aVenda['desc'][$codRep];
            }else{
                $descVendaVend = 0;
            }
            if(isset($aDev['dev'][$codRep])){
                $devVend =  $aDev['dev'][$codRep];
            }else{
                $devVend = 0;
            }
            if(isset($aDev['desc'][$codRep])){
                $descDevVend =  $aDev['desc'][$codRep];
            }else{
                $descDevVend = 0;
            }
			$vendaVend 		= $this->tratarNumero($vendaVend);
			$descVendaVend  = $this->tratarNumero($descVendaVend);
			$devVend		= $this->tratarNumero($devVend);
			$descDevVend    = $this->tratarNumero($descDevVend);
			$metaVend       = $this->tratarNumero($metaVend);
			
            if($metaVend > 0 and $vendaVend + $descVendaVend - $devVend - $descDevVend <> 0 ){
                $percVend = round(($vendaVend + $descVendaVend - $devVend - $descDevVend) / $metaVend * 100,0);

            }else{
                $percVend = 0;
            }
            $percVendFormat = number_format($percVend,0,',','.');
            $percVendFormat .= "%";
            $percVendFormat  = str_replace(',','.',$percVendFormat);
            $aRepres = $this->buscarDadosRepres($codRep,'nom_abrev');
            if(is_array($aRepres)){
                $nomeAbrev = $aRepres[0]['nom_abrev'];
            }else{
                $nomeAbrev = '';
            }

            $aDadosVend[] = array('nome_abrev' => $nomeAbrev,'perc_vend' => $percVend,
                'perc_vend_format' => $percVendFormat);
        }
        if(is_array($aDadosVend)){
            foreach ($aDadosVend as $key => $row) {
                $aPercVend[$key]  = $row['perc_vend'];
            }
            if( is_array($aPercVend)){
                array_multisort($aPercVend, SORT_DESC,SORT_NUMERIC, $aDadosVend);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestão</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 20px 0;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo i {
            font-size: 2.2rem;
            color: #3498db;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }
        
        .logo h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-info i {
            font-size: 1.5rem;
        }
        
        .cards-container {
            display: grid;
			grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			gap: 25px;
			align-items: stretch; 
        }
        
        .card {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: none;
			height: 100%;
			display: flex;
			flex-direction: column;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .metric-card .card-icon {
            background: linear-gradient(135deg, #bd282f 0%, #bd282f 100%);
        }
        
        .action-card .card-icon {
            background: linear-gradient(135deg, #bd282f 0%, #bd282f 100%);
        }
        
        .info-card .card-icon {
            background: linear-gradient(135deg, #bd282f 0%, #bd282f 100%);
        }
        
        .empty-card .card-icon {
            background: linear-gradient(135deg, #bd282f 0%, #bd282f 100%);
        }
        
        .metric-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
			text-align: center;
        }
        
        .metric-label {
            color: #7f8c8d;
            font-size: 0.95rem;
			text-align: center;
        }
        
        .progress-container {
            margin-top: 20px;
			
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .progress-bar {
            height: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3498db 0%, #2ecc71 100%);
            border-radius: 5px;
			transition: none !important;
        }
        
        .action-list {
            list-style: none;
        }
        
        .action-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .action-list li:last-child {
            border-bottom: none;
        }
        
        .action-list i {
            color: #3498db;
            font-size: 1.2rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 30px 0;
            color: #95a5a6;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        .badge {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            font-size: 0.8rem;
            padding: 3px 10px;
            border-radius: 20px;
            margin-left: 10px;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
        }
        
        
        .meta-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .meta-card {
            grid-column: 1 / -1;
            background-color: white;
            border-radius: 15px;
            padding: 20px; 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: none;
        }
        
        .meta-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        
       .meta-goals-container {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
			margin-top: 15px;
		}
		
        .meta-goal {
            background-color: #f9f9f9;
            padding: 15px; 
            border-radius: 10px;
            border-left: 4px solid #bd282f;
        }
        
        .meta-goal-title {
            font-size: 1rem; 
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px; 
            display: flex;
            align-items: center;
            gap: 8px; 
        }
        
        .meta-goal-title i {
            color: #bd282f;
            font-size: 1rem; 
        }
        
        .meta-goal-value {
            font-size: 1.5rem; 
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .meta-goal-progress {
            margin-top: 12px; 
        }
        
        .meta-total {
            text-align: center;
            margin-top: 20px; 
            padding-top: 15px; 
            border-top: 1px solid #eee;
        }
        
        .meta-total-value {
            font-size: 2rem; 
            font-weight: 800;
            color: #bd282f;
            margin-bottom: 5px;
        }
        
        .meta-total-label {
            color: #7f8c8d;
            font-size: 0.9rem; 
        }
        
        
        .meta-card .card-header {
            margin-bottom: 15px; 
            padding-bottom: 12px; 
        }
        
        .meta-card .card-title {
            font-size: 1.2rem; 
        }
        
        .meta-card .card-icon {
            width: 45px; 
            height: 45px; 
            font-size: 1.3rem; 
        }
        
        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
            
            .meta-goals-container {
                grid-template-columns: 1fr;
                gap: 15px; 
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .logo h1 {
                font-size: 1.5rem;
            }
            
            .meta-card {
                padding: 15px; 
            }
        }
		
.card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.card-link .card {
    cursor: pointer;
}

.card-link:hover .card {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}
		
		
.metas-loja {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 10px;
    border-left: 4px solid #bd282f;
}


.meta-resumo {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 10px;
}

.meta-col {
    text-align: center;
}

.meta-label {
    font-size: 0.85rem;
    color: #7f8c8d;
}

.meta-value {
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 4px;
}


.meta-info {
    font-size: 0.85rem;
    color: #555;
    margin: 10px 0;
}

.meta-info i {
    color: #bd282f;
    margin-right: 5px;
}


.meta-vendedores {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.vendedor {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
    gap: 6px;
}

.vendedor .nome {
    font-size: 0.85rem;
    font-weight: 600;
}

.vendedor .percent {
    font-size: 0.75rem;
    background-color: #3498db;
    color: #fff;
    padding: 2px 6px;
    border-radius: 6px;
}


.progress-bar.small {
    grid-column: 1 / -1;
    height: 8px;
    background-color: #e0e0e0;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #3498db 0%, #2ecc71 100%);
    border-radius: 4px;
}
		
.double-card {
    display: flex;
    flex-direction: column;
    gap: 25px;
    height: 100%;
}


.double-card .card {
    flex: 1;
    min-height: 0;
    justify-content: center;
    padding: 18px;
}




.double-card .card-icon {
    width: 40px;
    height: 40px;
    font-size: 1.1rem;
}



        
        .meta-card .meta-goals-container { display: none; }
        .meta-card.dados-visiveis .meta-goals-container { display: grid; }
        .btn-visibilidade {
            border: 1px solid #e1e5e9; background: #fff; color: #bd282f;
            border-radius: 9px; width: 45px; height: 45px; cursor: pointer;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .btn-visibilidade:focus-visible { outline: 3px solid #3498db; outline-offset: 2px; }
        .meta-header-acoes { display: flex; align-items: center; gap: 10px; }
    </style>
</head>
<body>
    
            
    <main class="container">
        <!-- Card de Meta de Faturamento em linha única -->
        <div class="meta-container">
            <div class="meta-card">
                <div class="card-header">
                    <h2 class="card-title">Meta de Faturamento</h2>
                    <div class="meta-header-acoes">
                        <button type="button" id="btnVisibilidadeMetas" class="btn-visibilidade"
                                aria-label="Mostrar indicadores de faturamento e metas"
                                aria-controls="indicadoresMetas" aria-expanded="false"
                                title="Mostrar indicadores">
                            <i class="fas fa-eye-slash" aria-hidden="true"></i>
                        </button>
                        <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
                    </div>
                </div>
                
                <div class="meta-goals-container" id="indicadoresMetas">
                    <!-- Meta Mensal -->
                    <div class="meta-goal">
                        <div class="meta-goal-title">
                            <i class="fas fa-calendar-alt"></i>
                            META MENSAL
                        </div>
                        <div class="meta-goal-value"><?php echo $metaFormatada; ?> </div>
                        <div class="meta-goal-progress">
                            <div class="progress-label">
                                <span>Progresso:</span>
                                <span><?php echo $perc_progress; ?></span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo $perc_progress; ?>"></div>
                            </div>
                        </div>
						 
						
					<?php if($logVendedor and $diaCor <= 15){?>
						    </br>
							<div class="meta-goal-title">
								<i class="fas fa-calendar-week"></i>
								META QUINZENAL
							</div>
							<div class="meta-goal-value"><?php echo $metaQuinzFormatada;?></div>
							
			        <?php } ?>
						
						
						<div class="meta-total">
							<div class="meta-total-value"><?php echo $fatTotLiqFormatado;?></div>
							<div class="meta-total-label">Faturado até o momento</div>
						</div>
                    </div>
                    
                  
					<!-- Meta Quinzenal -->
                    <div class="meta-goal metas-loja">

						<!-- TÍTULO -->
						<div class="meta-goal-title">
							<i class="fa fa-flag"></i>
							Metas Loja
						</div>

						<!-- RESUMO % -->
						<div class="meta-resumo">
							<div class="meta-col">
								<span class="meta-label">% Vendido</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: <?php echo $percVendVendedoresFormat?>"></div>
								</div>
								<span class="meta-value"><?php echo $percVendVendedores;?>%</span>
							</div>

							<div class="meta-col">
								<span class="meta-label">% Ideal</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 0%"></div>
								</div>
								<span class="meta-value">0%</span>
							</div>
						</div>

						<!-- INFO -->
						<div class="meta-info">
							<i class="fa fa-calendar"></i>
							Faltam <strong><?php echo $qtDiasRestantes ?> dias úteis</strong>
						</div>

						<hr>
						 <?php
                        $tam = count($aDadosVend);
                        for($i=0;$i<$tam;$i++)
                        {
							$nomeAbrev  = ucwords( strtolower($aDadosVend[$i]['nome_abrev']));
                            $perc       = $aDadosVend[$i]['perc_vend'];
                            $percFormat = $aDadosVend[$i]['perc_vend_format'];
                            if($perc >= 100){
                                $metaOk = "progress-bar-success";
                            }else{
                                $metaOk = "";
                            }
						
						?>
						<!-- VENDEDORES -->
						<div class="meta-vendedores">

							<div class="vendedor">
								<span class="nome"><?php echo $nomeAbrev;?></span>
								<span class="percent"><?php echo $perc;?>%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: <?php echo $percFormat;?>"></div>
								</div>
							</div>

							<!--<div class="vendedor">
								<span class="nome">Mario</span>
								<span class="percent">15%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 15%"></div>
								</div>
							</div>

							<div class="vendedor">
								<span class="nome">Admilson</span>
								<span class="percent">6%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 6%"></div>
								</div>
							</div>

							<div class="vendedor">
								<span class="nome">Roberto Bisp</span>
								<span class="percent">6%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 6%"></div>
								</div>
							</div>

							<div class="vendedor">
								<span class="nome">Hermano</span>
								<span class="percent">3%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 3%"></div>
								</div>
							</div>

							<div class="vendedor">
								<span class="nome">Aline Souza</span>
								<span class="percent">0%</span>
								<div class="progress-bar small">
									<div class="progress-fill" style="width: 0%"></div>
								</div>
							</div>-->

						</div>
						<?php }	?>
					</div>
               
                <!--<div class="meta-total">
                    <div class="meta-total-value"><?php echo $fatTotLiqFormatado;?></div>
                    <div class="meta-total-label">Faturado até o momento</div>
                </div>-->
            </div>
			
        </div>
        
        <!-- Cards restantes abaixo -->
        <div class="cards-container">
    
	<?php 
        if($qtPedsAberto == 0){
			$descAvalGer = 'Nenhum pedido pendente de avaliação ';
		}else if($qtPedsAberto == 1){
			$descAvalGer = 'Pedido pendente de avaliação ';
		}else{
			$descAvalGer = 'Pedidos pendentes de avaliação ';
		}			
    ?>		
    <!-- Card de Pedidos Pendentes -->
	<!--<a href="../cons_ped_aprov_gerencial" class="card-link">
    <div class="card empty-card">
        <div class="card-header">
            <h2 class="card-title">Avaliação Gerencial</h2>
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="empty-state">
            <p class="metric-value"><?php echo $qtPedsGerenciais; ?></p>
            <p class="metric-label"><?php echo $descAvalGer; ?></p> 
        </div>
    </div>
    </a>-->

	 <a href="../cons_ped_aprov_gerencial" class="card-link">
	 <div class="card metric-card">
        <div class="card-header">
            <h2 class="card-title">Avaliação Gerencial</h2>
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <p class="metric-value" text-align="center"><?php echo $qtPedsGerenciais; ?></p>
        <p class="metric-label"><?php echo $descAvalGer; ?></p>
    </div>
	</a>
			
	  <!-- Card de Tabela de Preços -->
    <div class="card info-card">
        <div class="card-header">
            <h2 class="card-title">Tabelas de Preços</h2>
            <div class="card-icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
        <ul class="action-list">
            <li>
                <span class="fas fa-usd" style="color:#bd282f"></span> 
                <a href="../cons_tb_preco_estoque" target="_blank" style="color:#000; text-decoration:none;">Tabela de Preços - Estoque</a>
            </li>
            <li>
                <span class="fas fa-usd" style="color:#bd282f"></span> 
                <a href="../cons_tb_preco_prog_container" target="_blank" style="color:#000; text-decoration:none;">Tabela de Preços - Programado</a>
            </li>
        </ul>
    </div>		
			

    <!-- Card de Pedidos Em Aberto -->
    <a href="../bl_painel_inicial_repres_ped_wp" class="card-link">
	 <div class="card metric-card">
        <div class="card-header">
            <h2 class="card-title">Pedidos Em Aberto</h2>
            <div class="card-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
        </div>
        <p class="metric-value"><?php echo $qtPedsAberto ?></p>
        <p class="metric-label">Pedidos aguardando processamento</p>
    </div>
	</a>	

    <!-- Card de Rastreamento de Pedidos (Clicável) -->
	<a href="../rastreamento_pedidos_venda" class="card-link">
	 <div class="card metric-card">
        <div class="card-header">
            <h2 class="card-title">Rastreamento de Pedidos</h2>
            <div class="card-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
        </div>
		 <p class="metric-value"></p>
        <p class="metric-label">Acompanhe o andamento dos seus pedidos</p>
		 <p class="metric-label">Avaliações pendentes e separação</p>
    </div>
	</a>		
    <!--<a href="../rastreamento_pedidos_venda" class="card-link">
        <div class="card action-card">
            <div class="card-header">
                <h2 class="card-title">Rastreamento de Pedidos</h2>
                <div class="card-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
            </div>
            <p class="metric-label">Acompanhe o status de envio dos seus pedidos</p>
        </div>
    </a>-->

  <!-- Card de Novidades e Promoções -->
    <div class="card info-card">
        <div class="card-header">
            <h2 class="card-title">Novidades e Promoções</h2>
            <div class="card-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
        <ul class="action-list">
			<li>
                <span class="fas fa-gift" style="color:#bd282f"></span> 
                <a href="../bl_noticias_ativas" target="_blank" style="color:#000; text-decoration:none;">Promoções e informações ativas</a>
            </li>
            <li>
                <span class="fas fa-file" style="color:#bd282f"></span> 
                <a href="https://imaonline.imatextil.com.br/iol/_lib/file/docnoticias/PAC_.rtf" target="_blank" style="color:#000; text-decoration:none;">Abertura de crédito de cliente</a>
            </li>
            <li>
                <span class="fas fa-clipboard" style="color:#bd282f"></span> 
                <a href="https://imaonline.imatextil.com.br/iol/_lib/file/docnoticias/RNC.rtf" target="_blank" style="color:#000; text-decoration:none;">Solicitação de não conformidade</a>
            </li>
        </ul>
    </div>

			
	<!--<a href="../bl_arquivos_estilo/bl_arquivos_estilo.php" class="card-link" target="_blank">
        <div class="card action-card">
            <div class="card-header">
                <h2 class="card-title">Materiais de Apoio</h2>
                <div class="card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
            <p class="metric-label">Documentação, manuais e materiais de treinamento</p>
        </div>
    </a>-->
			<div class="double-card">

    <!-- CARD 1 -->
    <a href="../bl_arquivos_estilo/bl_arquivos_estilo.php"
       class="card-link"
       target="_blank">

        <div class="card action-card">
            <div class="card-header">
                <h2 class="card-title">Materiais de Apoio</h2>

                <div class="card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>

            <p class="metric-label">
                Documentação, manuais e treinamentos
            </p>
        </div>
    </a>

    <!-- CARD 2 -->
    <a href="../cons_item_certificacao"
       class="card-link"
       target="_blank">

        <div class="card action-card">
            <div class="card-header">
				<h2 class="card-title">Item Certificação</h2>

                <div class="card-icon">
                    <i class="fas fa-certificate"></i>
                </div>
            </div>
				
            <p class="metric-label">
               Listagem de itens com certificação.
            </p>
        </div>
    </a>

</div>

</div>

			 </a>
    </main>
    
    

    <script>
        (function () {
            var botao = document.getElementById('btnVisibilidadeMetas');
            var card = document.querySelector('.meta-card');
            if (!botao || !card) return;
            botao.addEventListener('click', function () {
                var visivel = card.classList.toggle('dados-visiveis');
                botao.setAttribute('aria-expanded', String(visivel));
                botao.setAttribute('aria-label', visivel ? 'Ocultar indicadores de faturamento e metas' : 'Mostrar indicadores de faturamento e metas');
                botao.title = visivel ? 'Ocultar indicadores' : 'Mostrar indicadores';
                botao.querySelector('i').className = visivel ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
        }());

        
    </script>
</body>
</html>
<?php
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_lista_reps_ger)) {$_SESSION['lista_reps_ger'] = $this->sc_temp_lista_reps_ger;}
if (isset($this->sc_temp_tipoUsuario)) {$_SESSION['tipoUsuario'] = $this->sc_temp_tipoUsuario;}
if (isset($this->sc_temp_nomeRepresIni)) {$_SESSION['nomeRepresIni'] = $this->sc_temp_nomeRepresIni;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onExecute ------*/
 
//--- 
       $this->Db->Close(); 
       $this->Ini->nm_db_especw->Close(); 
       $this->Ini->nm_db_log_db->Close(); 
       $this->Ini->nm_db_ima->Close(); 
       $this->Ini->nm_db_med->Close(); 
       $this->Ini->nm_db_medw->Close(); 
       $this->Ini->nm_db_ems5->Close(); 
       $this->Ini->nm_db_comum->Close(); 
       $this->Ini->nm_db_multi->Close(); 
       $this->Ini->nm_db_cfsc->Close(); 
       $this->Ini->nm_db_integracoes->Close(); 
       $this->Ini->nm_db_geral->Close(); 
       $this->Ini->nm_db_dinamico->Close(); 
       $this->Ini->nm_db_ticontrole->Close(); 
       $this->Ini->nm_db_wdfe->Close(); 
       $this->Ini->nm_db_tss->Close(); 
       $this->Ini->nm_db_correio->Close(); 
       $this->Ini->nm_db_pendencias->Close(); 
       $this->Ini->nm_db_fnd->Close(); 
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

/*----- Scriptcase Locale: PHP Method: tipousuario.php => function aplicarFiltroTipoUsuarioPV ------*/

function aplicarFiltroTipoUsuarioPV($tabela,$apelido='',$listaReps='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
if (!isset($_SESSION['prepostoIni'])) {$_SESSION['prepostoIni'] = "";}
if (!isset($this->sc_temp_prepostoIni)) {$this->sc_temp_prepostoIni = (isset($_SESSION['prepostoIni'])) ? $_SESSION['prepostoIni'] : "";}
if (!isset($_SESSION['nomeRepresFim'])) {$_SESSION['nomeRepresFim'] = "";}
if (!isset($this->sc_temp_nomeRepresFim)) {$this->sc_temp_nomeRepresFim = (isset($_SESSION['nomeRepresFim'])) ? $_SESSION['nomeRepresFim'] : "";}
if (!isset($_SESSION['nomeRepresIni'])) {$_SESSION['nomeRepresIni'] = "";}
if (!isset($this->sc_temp_nomeRepresIni)) {$this->sc_temp_nomeRepresIni = (isset($_SESSION['nomeRepresIni'])) ? $_SESSION['nomeRepresIni'] : "";}
if (!isset($_SESSION['tipoUsuario'])) {$_SESSION['tipoUsuario'] = "";}
if (!isset($this->sc_temp_tipoUsuario)) {$this->sc_temp_tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $filtroTipoUsuario = '';
    $restrPermisAtivo   = $this->getTpRestrUsuar($this->sc_temp_usr_login,'ativo');
    switch($tabela)
    {
        case "ped-venda":
            switch($this->sc_temp_tipoUsuario)
            {
                case '2':
                case '5':
                    $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" >= '$this->sc_temp_nomeRepresIni'
                        and ped_rep.\"nome-ab-rep\" <= '$this->sc_temp_nomeRepresFim'";

                    break;
                case '3':
                    $codRep = $this->buscarCodRep($this->sc_temp_usr_login);
                    $hierarq = $this->getTpHierarquiaGer($codRep);
                    $lDir = $this->verificGrupoLogin(6);
                    if($listaReps <> ''){
                        $listaReps = $this->retornaListaNomeRepsRestrUsuar($listaReps);
                        $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaReps)";
                    }else{
                        if($lDir and $hierarq <> 3){
                            $hierarq = 1;
                        }
                        if($restrPermisAtivo == 1){
                            $hierarq = 1;
                        }
                        if($hierarq == 1 or $hierarq == 4){
                            $lExcecao = $this->verificGrupoLogin(16); 
                            if ($lExcecao) {
                                $listaRepres = $this->getListaRepresGer('nome','sp');
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaRepres)";
                            }else{
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" >= '$this->sc_temp_nomeRepresIni'
                            and ped_rep.\"nome-ab-rep\" <= '$this->sc_temp_nomeRepresFim'";
                            }
                        }else{
                            $lGerente = $this->verificGrupoLogin(5); 
                            if ($lGerente) {
                                $listaRepres = $this->getListaRepresGer();
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaRepres)";
                            }
                        }
                    }

                    break;
                case '4':
                    if($listaReps <> ''){
                        $listaReps = $this->retornaListaNomeRepsRestrUsuar($listaReps);
                        $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaReps)";
                    }
                    break;
            }
            break;
        case "ped-venda-ext":
            switch($this->sc_temp_tipoUsuario)
            {
                case '5':
                    $filtroTipoUsuario = " preposto = '$this->sc_temp_prepostoIni'";
                    break;
            }
            break;
        case "nota-fiscal":
            if($apelido == ''){
                $apelido = "PUB.\"nota-fiscal\"";
            }
            switch($this->sc_temp_tipoUsuario)
            {

                case '2':
                case '5':
                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" >= '$this->sc_temp_nomeRepresIni'
                        and ped_rep.\"nome-ab-rep\" <= '$this->sc_temp_nomeRepresFim'";
                break;

                case '3':
                    $codRep = $this->buscarCodRep($this->sc_temp_usr_login);
                    $hierarq = $this->getTpHierarquiaGer($codRep);
                    $lDir = $this->verificGrupoLogin(6);
                    if($listaReps <> ''){
                        $listaReps = $this->retornaListaNomeRepsRestrUsuar($listaReps);
                        $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaReps)";
                    }else{
                        if($lDir and $hierarq <> 3){
                            $hierarq = 1;
                        }
                        if($restrPermisAtivo == 1){
                            $hierarq = 1;
                        }
                        if($hierarq == 1 or $hierarq == 4){
                            $lExcecao = $this->verificGrupoLogin(16); 
                            if ($lExcecao) {
                                $listaRepres = $this->getListaRepresGer('nome','sp');
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaRepres)";
                            }else{
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" >= '$this->sc_temp_nomeRepresIni'
                            and ped_rep.\"nome-ab-rep\" <= '$this->sc_temp_nomeRepresFim'";
                            }
                        }else{
                            $lGerente = $this->verificGrupoLogin(5); 
                            if ($lGerente) {
                                $listaRepres = $this->getListaRepresGer();
                                $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaRepres)";
                            }
                        }
                    }

                    break;

                case '4':
                    if($listaReps <> ''){
                        $listaReps = $this->retornaListaNomeRepsRestrUsuar($listaReps);
                        $filtroTipoUsuario = "and ped_rep.\"nome-ab-rep\" in ($listaReps)";
                    }
                    break;
            }
        break;
        case "devol-cli":
            if($apelido == ''){
                $apelido = "PUB.\"devol-cli\"";
            }
            switch($this->sc_temp_tipoUsuario)
            {
                case '2':
                    $filtroTipoUsuario = " and $apelido.\"cod-rep\" = '$this->sc_temp_codRepIni'";
                    break;


                case '5':
                    $filtroTipoUsuario = " and $apelido.\"cod-rep\" = '$this->sc_temp_codRepIni'";
                    break;
            }
        break;

    }
    return $filtroTipoUsuario;


if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_tipoUsuario)) {$_SESSION['tipoUsuario'] = $this->sc_temp_tipoUsuario;}
if (isset($this->sc_temp_nomeRepresIni)) {$_SESSION['nomeRepresIni'] = $this->sc_temp_nomeRepresIni;}
if (isset($this->sc_temp_nomeRepresFim)) {$_SESSION['nomeRepresFim'] = $this->sc_temp_nomeRepresFim;}
if (isset($this->sc_temp_prepostoIni)) {$_SESSION['prepostoIni'] = $this->sc_temp_prepostoIni;}
if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: tipousuario.php => function aplicarFiltroTipoUsuarioPV ------*/


/*----- Scriptcase Locale: PHP Method: tipousuario.php => function getVendedores ------*/

function getVendedores()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $tabela   = " pub.\"usuarios_grupos\" as usuario_grupo , pub.\"user-web\" as usuario";
    $campos   = " usuario_grupo.login_usuario as login_usuario ";
    $condicao = "  usuario_grupo.cod_grupo = 2 and ativo = 1 
                    and usuario.login = usuario_grupo.login_usuario "; 
    $listaCodRep = '';
    $codRepCorrente = '';
    $listaCompleta = '';
    $aRet = $this->retornoMultReg($tabela,$campos,$condicao,"espec");
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $nomeAbrev = $aRet[$i]['login_usuario'];
            $codRep = $this->buscarCodRep($nomeAbrev);
            if($codRep <> 0){
                if($this->sc_temp_usr_login == $nomeAbrev){
                    $codRepCorrente = $codRep;
                }else{
                    $listaCodRep = $this->util_incr_valor($listaCodRep,$codRep);
                }
            }
        }
        if($codRepCorrente <> ''){
            $listaCompleta = "$codRepCorrente,$listaCodRep";
        }else{
            $listaCompleta = $listaCodRep;
        }
    }
    $retorno = array('cod_rep_corrente' => $codRepCorrente,'lista_cod_rep' => $listaCodRep,
        'lista_completa' => $listaCompleta);
    return $retorno;

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: tipousuario.php => function getVendedores ------*/


/*----- Scriptcase Locale: PHP Method: tipousuario.php => function verifVendedor ------*/

function verifVendedor()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $logVendedor = false;
    $tabela   = " pub.\"usuarios_grupos\" ";
    $campos   = " login_usuario ";
    $condicao = "  cod_grupo = 2 and login_usuario = '$this->sc_temp_usr_login' ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aRet)) {
         $logVendedor = True;
    }
    return $logVendedor;

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: tipousuario.php => function verifVendedor ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function getApiTotvsOld ------*/

function getApiTotvsOld($api,$metodo,$aQueryParam,$aBody='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $url = $this->getUrlServico();
    $url = $this->util_incr_valor($url,$api,'');

    $autoLoad = sc_url_library("prj", "guzzle", "autoload.php");
    include_once $autoLoad;

    $client = new GuzzleHttp\Client();
    $usuario = $this->getUserApiTotvs();
    $senha  = $this->getSenhaApiTotvs();
    $res = $client->request($metodo,
        $url, [
            'auth' => [$usuario, $senha],
            'query'=> $aQueryParam,
            'body' => $aBody
        ]);

    $j = json_decode($res->getBody());
    return $j;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function getApiTotvsOld ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function trocarVersaoApi ------*/

function trocarVersaoApi($api,$novaVersao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $novaApi = '';
    $aApi = explode('/',$api);
    if(is_array($aApi)){
       $tam = count($aApi);
       for($i=0;$i<$tam;$i++){
           if($i == $tam){
               $separador ="";
           } else{
               $separador ="/";
           }
           if($i == 1){ 
               $novaApi = $this->util_incr_valor($novaApi,$novaVersao,$separador);
           }else{
              $novaApi = $this->util_incr_valor($novaApi,$aApi[$i],$separador);
           }
       }
    }
    return $novaApi;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function trocarVersaoApi ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function consumirApiPhpGetParams ------*/

function consumirApiPhpGetParams($url,$aParams)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $curl = curl_init();
    $queryString = $this->convArrayToQueryStringUrl($aParams);
    $url = $this->util_incr_valor($url,$queryString,'?') ;
    $this->retH('1',$url);
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function consumirApiPhpGetParams ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function consumirApiPhpPostParams ------*/

function consumirApiPhpPostParams($url,$aParams,$aHeader='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POST=>true,
        CURLOPT_POSTFIELDS => $aParams,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "autorizathion:Basic YXBpdG90dnM6YXBp",
            'Content-Type:application/json'
        ),

    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function consumirApiPhpPostParams ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function consumirApi ------*/

function consumirApi($api,$metodo,$params,$aQuery='',$usuario='',$senha='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    

    $url = $api;
    include_once sc_url_library("prj", "guzzle", "autoload.php");
    $client = new \GuzzleHttp\Client();
    switch($metodo){
        case 'GET':
            $chave= 'query';
            break;
        case 'POST':
            $chave= 'json';
            break;
    }
    if($metodo == "POST" and $aQuery  <> ''){
        $res = $client->request($metodo,
            $url, [
                'auth' => [$usuario, $senha],
                'query'=> $aQuery,
                'json' => $params
            ]);
    }else{
        $res = $client->request($metodo,
            $url, [
                'auth' => [$usuario, $senha],
                $chave => $params
            ]);
    }
    
    
    $corpo = $res->getBody();
    if($corpo <> '' or  !is_null($corpo)){
        $j = json_decode($res->getBody());
    }
    if($j == '' ){
        $j = $res->getStatusCode();
    }

    return $j;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function consumirApi ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function getApiTotvs ------*/

function getApiTotvs($api,$metodo,$params,$aQuery='',$usuario='',$senha='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $lHomolog = false;
    $uri = $_SERVER["REQUEST_URI"];
    if(strpos($uri,'homolog') <> false){
        $lHomolog =true;
    }
    if($lHomolog){
        $api = $this->trocarVersaoApi($api,$this->getVersaoApiHomolog());
    }

    $url = $this->getUrlServico();
    $url = $this->util_incr_valor($url,$api,'');
    include_once sc_url_library("prj", "guzzle", "autoload.php");
    $client = new \GuzzleHttp\Client();
    if(!$usuario){
        $usuario = $this->getUserApiTotvs();
    }
    if(!$senha){
        $senha  = $this->getSenhaApiTotvs();
    }

    switch($metodo){
        case 'GET':
            $chave= 'query';
            break;
        case 'POST':
            $chave= 'json';
            break;
    }
    if($metodo == "POST" and $aQuery  <> ''){
        $res = $client->request($metodo,
            $url, [
                'auth' => [$usuario, $senha],
                'query'=> $aQuery,
                'json' => $params
            ]);
    }else{
        $res = $client->request($metodo,
            $url, [
                'auth' => [$usuario, $senha],
                $chave => $params
            ]);
    }



   
    $j = json_decode($res->getBody());
    if($j == '' ){
        $j = $res->getStatusCode();
    }
    return $j;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function getApiTotvs ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function getDadosApis ------*/

function getDadosApis($caminho,$metodo,$aParams,$campos=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aRet = $this->getApiTotvs($caminho,$metodo,$aParams);
    $aDadosLogs = $this->getValsArrayMultiDin($aRet,$campos);
    return $aDadosLogs;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function getDadosApis ------*/


/*----- Scriptcase Locale: PHP Method: api.php => function convArrayToQueryStringUrl ------*/

function convArrayToQueryStringUrl($aParam)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = '';
    $iCont = 0;
    if(is_array($aParam)){
        foreach($aParam as $chave => $valor){
            $iCont++;
            if($iCont == 1){
                $operador="?";
            }else{
                $operador="&";
            }
            $incr = "$chave=$valor";
            $retorno = $this->util_incr_valor($retorno,$incr,$operador);
        }
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: api.php => function convArrayToQueryStringUrl ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function buscarCodRep ------*/

function buscarCodRep($nomeAbrevParam)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $codRep = 0;
    $aRet = $this->getDadosRepresEms2($nomeAbrevParam,'"cod-rep" as cod_rep',$campoChave='"nome-abrev"');
    if(is_array($aRet)){
        $codRep = $aRet[0]['cod_rep'];
    }
    return $codRep;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function buscarCodRep ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getNomeAbrevRepres ------*/

function getNomeAbrevRepres($codRep)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $nomeAbrev = 0;
    $aRet = $this->getDadosRepresEms2($codRep,'"nome-abrev" as nome_abrev');
    if(is_array($aRet)){
        $nomeAbrev = $aRet[0]['nome_abrev'];
    }
    return $nomeAbrev;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getNomeAbrevRepres ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function buscarDadosRepres ------*/

function buscarDadosRepres($codRepres,$campos='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('ems5','representante');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.representante ";
    $condicao = "  cdn_repres = $codRepres ";
    $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao,'ems5');
    return $aResult;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function buscarDadosRepres ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getDadosRepresEms2 ------*/

function getDadosRepresEms2($cpChave,$campos='',$campoChave='"cod-rep"')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('ems2cad','repres');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.repres ";
    $condicao = "  $campoChave = '$cpChave' ";
    $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao,'comum');
    return $aResult;
	



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getDadosRepresEms2 ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getDadosRepresFinanc ------*/

function getDadosRepresFinanc($empresa,$repres,$campos='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('ems5','repres_financ','cod_empresa,cdn_repres',
        "'$empresa',$repres", $campos);
    return $aReg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getDadosRepresFinanc ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getPercComisRepres ------*/

function getPercComisRepres($estab,$repres)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $perc = 0;
    $aReg = $this->getDadosRepresFinanc($estab,$repres,'val_perc_comis_repres');
    if(is_array($aReg)){
        $perc = $aReg[0]['val_perc_comis_repres'];
    }
    return $perc;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getPercComisRepres ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getPercAumentComis ------*/

function getPercAumentComis()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return 25 / 100;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getPercAumentComis ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getClasseVendedor ------*/

function getClasseVendedor($codigo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $classe = 0;
    $aReg = $this->getReg('espec','cm-ext-repres','"cod-rep"',
    $codigo,'classe');
    if(is_array($aReg)){
        $classe = $aReg[0]['classe'];
    }
    return $classe;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getClasseVendedor ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getClasseVendExterno ------*/

function getClasseVendExterno()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '3,5';


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getClasseVendExterno ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getListaRepres ------*/

function getListaRepres()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $classe = $this->getClasseVendExterno();
    $lista = "";
    $aRet = $this->getDados('multi','pub."cm-ext-repres"','"cod-rep" as cod_rep',
        "classe in($classe)","espec");
    foreach($aRet as $reg){
       $lista = $this->util_incr_valor($lista,$reg['cod_rep'],',');
    }
    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getListaRepres ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getTipoVendedor ------*/

function getTipoVendedor($loginParam='') 
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($loginParam == ''){
        $loginParam = $this->getVarSessao($this->getNomeVarLoginSessao());
    }
   $codRep = $this->buscarCodRep($loginParam);
   $classe = $this->getClasseVendedor($codRep);
    $classesVendInterno = $this->getClasseVendInterno();
    if(strstr($classesVendInterno, $classe) <> false) {
        $tipoVend = 'interno';
    }else{
        $tipoVend = 'externo';
    }

    return $tipoVend;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getTipoVendedor ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getClasseVendInterno ------*/

function getClasseVendInterno()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '4';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getClasseVendInterno ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getClasseGerente ------*/

function getClasseGerente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '1,2';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getClasseGerente ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getTpHierarquiaGer ------*/

function getTpHierarquiaGer($codRep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $hierarq = '';
    $aDados = $this->getDados('multi','pub."cm-ext-repres" cm_rep','cm_rep."tp-aplic-comis" as tp_hierarq',
        "cm_rep.\"cod-rep\" = $codRep",'espec');
    if(is_array($aDados )){
        $hierarq = $aDados[0]['tp_hierarq'];
    }


    return $hierarq;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getTpHierarquiaGer ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getCodRepsAtivos ------*/

function getCodRepsAtivos(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = '"ind-situacao" = 1 and "cod-rep" not in(1,99999,3,10108,11130,14378,10103,99999,10107,2)';
    $aDados = $this->getDados('multi','PUB.repres',"\"cod-rep\"",$condicao ,'comum');

    return $aDados;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getCodRepsAtivos ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getLoginRepTel ------*/

function getLoginRepTel($numTel){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $usuarLogin = '';
    $numTel = str_replace('+','',$numTel);
    $numTel = trim($numTel);
    $numUsuarAtu = substr($numTel,4,9);
    $numUsuarIni = substr($numTel,0,4);
    $tamNum      = strlen($numUsuarAtu);
    if($tamNum == 8){
        $numTel = $numUsuarIni."9".$numUsuarAtu;
    }
    $filtroCompl = "ativo = 0";
    $aReg = $this->getReg('espec','telefone_usuario','telefone',"'$numTel'",'',$filtroCompl);
    if($aReg){
        $usuarLogin = $aReg[0]['login'];
        $sitUsuar = $this->verificaRepAtivo($usuarLogin);
        if($sitUsuar <> 1){
            $usuarLogin = '';
        }
    }
    return $usuarLogin;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getLoginRepTel ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function getTelsUsuar ------*/

function getTelsUsuar($login){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = 'login ='."'$login'";
    $aDados = $this->getDados('multi','PUB.telefone_usuario','telefone,ativo',$condicao,'espec');
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function getTelsUsuar ------*/


/*----- Scriptcase Locale: PHP Method: repres.php => function verificaRepAtivo ------*/

function verificaRepAtivo($loginRep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $sitRep ='';
    $aReg = $this->getReg('espec','user-web','login',"'$loginRep'",'ativo');
    if($aReg){
        $sitRep = $aReg[0]['ativo'];
    }
    return $sitRep;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: repres.php => function verificaRepAtivo ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getGruposUsuario ------*/

function getGruposUsuario($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getGruposUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuario ------*/

function getTipoUsuario($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tipo = 0;
    $aReg = $this->getDadosUserWeb($login,'"tp-usuario"');
    
    if(is_array($aReg)){
        $tipo = $aReg[0]['"tp-usuario"'];
    }
    return $tipo;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuarioCorrente ------*/

function getTipoUsuarioCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTipoUsuario());

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getTipoUsuarioCorrente ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getLinkCarrinho ------*/

function getLinkCarrinho()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getLinkCarrinho ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getRegUsuario ------*/

function getRegUsuario($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
	$aReg = $this->getReg('espec','user-web', 'login',
        "'$login'", $campos,$filtroCompl);
	return $aReg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getRegUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verificGrupoLogin ------*/

function verificGrupoLogin($codGrupo,$usuar='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());
    if($usuar <> ''){
        $listaGrupos = $this->getGruposUsuario($usuar);
    }

    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verificGrupoLogin ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verificarPermissaoAlocacao ------*/

function verificarPermissaoAlocacao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verificarPermissaoAlocacao ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getDadosUserWeb ------*/

function getDadosUserWeb($login,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aReg = $this->getReg('espec','user-web',
        'login',"'$login'",$campos,
        $filtroCompl,'');

    return $aReg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getDadosUserWeb ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getUsuarioERP ------*/

function getUsuarioERP($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $usuario = '';
    $aRet = $this->getDadosUserWeb($login,'usuario');
   if(is_array($aRet)){
       $usuario = $aRet[0]['usuario'];
   }
   return $usuario;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getUsuarioERP ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermPagtoViaCaixa ------*/

function getPermPagtoViaCaixa($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logCaixa = $aReg[0]['log_caixa'];
    }else{
        $logCaixa = 0;
    }
    return $logCaixa == 1;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermPagtoViaCaixa ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermissoesPedWeb ------*/

function getPermissoesPedWeb($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermissoesPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verifVendLoja ------*/

function verifVendLoja()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getParamVendLoja());

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verifVendLoja ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getParamVendLoja ------*/

function getParamVendLoja()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return 'vend_loja';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getParamVendLoja ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getPermPrioridade ------*/

function getPermPrioridade($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosUserWeb($login);
    if(is_array($aReg)){
        $logPrioridade = $aReg[0]['log_prioridade'];
    }else{
        $logPrioridade = 0;
    }
    return $logPrioridade == 1;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getPermPrioridade ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getGruposRepresGeral ------*/

function getGruposRepresGeral()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return "2,3";

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getGruposRepresGeral ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getCpsEsconderPedido ------*/

function getCpsEsconderPedido($tipo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaCps = '';
    switch($tipo){
        case '2':
            $listaCps = 'dt-useralt,user-alte,user-canc';
            break;
    }
    return $listaCps;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getCpsEsconderPedido ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function trocarPerfil ------*/

function trocarPerfil($logVoltar,$novoPerfil='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($logVoltar){
        $novoPerfil = $this->getVarSessao('perfil_pai');
    }else{
        $this->setVarSessao('perfil_pai',$this->getLoginCorrente()) ;
    }
    $this->limparLogin();
    $aUsuario = $this->getDadosUserWeb($novoPerfil,$this->getCamposUsuario());
    $this->setarVarsLogin($aUsuario);
    

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function trocarPerfil ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getFoto ------*/

function getFoto()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getFoto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function atualizarFoto ------*/

function atualizarFoto($login,$foto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function atualizarFoto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verGrpAvalAdm ------*/

function verGrpAvalAdm()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $log = $this->verificGrupoLogin($this->getParamGrupoAvalAdm());
    return $log;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verGrpAvalAdm ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getListaRepresGer ------*/

function getListaRepresGer($indiceRep='nome',$usuar=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($usuar <> ''){
        $loginGer = $usuar;
    }else{
        $loginGer = $this->getLoginCorrente();
    }

    if($indiceRep == 'nome'){
        $varSessao = 'lista_nom_repres_ger';
    }else{
        $varSessao = 'lista_cod_repres_ger';
    }
    $lista = '';
    $listaSessao = $this->getVarSessao($varSessao);
    if($listaSessao == ''){
        $aDados = $this->getDados('multi','comum.pub.repres repres','hierarq."cod-depend" as rep',
            " \"nome-abrev\" = '".$loginGer."'",'multi',
            " inner join pub.\"cm-hierarquia\" hierarq on hierarq.\"cod-rep\" = repres.\"cod-rep\" ");
        if(is_array($aDados)){
            foreach($aDados as $reg){
                if($indiceRep == "nome"){
                    $aRepres = $this->getDadosRepresEms2($reg['rep'],'"nome-abrev" as nome');
                    if(is_array($aRepres)){
                        $nomeRepres = $aRepres[0]['nome'];
                    }else{
                        $nomeRepres = '';
                    }
                }else{
                    $aRepres = $this->getDadosRepresEms2($reg['rep'],'"cod-rep" as cod_rep');
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
        $this->setVarSessao($varSessao,$lista);
    }else{
        $lista = $listaSessao;
    }
    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getListaRepresGer ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNomeVarTipoUsuario ------*/

function getNomeVarTipoUsuario()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return 'glo_tipoUsuario';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNomeVarTipoUsuario ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioRepres ------*/

function getNumTpUsuarioRepres()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '2';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioRepres ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioPreposto ------*/

function getNumTpUsuarioPreposto()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '5';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioPreposto ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdmVendas ------*/

function getNumTpUsuarioAdmVendas()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '3';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdmVendas ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdm ------*/

function getNumTpUsuarioAdm()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '4';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAdm ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAcessoGeral ------*/

function getNumTpUsuarioAcessoGeral()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = '';
    $retorno = $this->util_incr_valor($retorno,$this->getNumTpUsuarioAdm());
    $retorno = $this->util_incr_valor($retorno,$this->getNumTpUsuarioAdmVendas());

    return  $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNumTpUsuarioAcessoGeral ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verifPermisAprovGerencial ------*/

function verifPermisAprovGerencial($codGrupo,$usuario)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $log = false;
    $listaGrupos = $this->getGruposUsuario("$usuario");
    if($listaGrupos <> ''){
        if(strstr($listaGrupos,(string) $codGrupo) <> false){
            $log = true;
        }
    }
    return $log;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verifPermisAprovGerencial ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getNomeGerPorUsuarErp ------*/

function getNomeGerPorUsuarErp($usuarioErp){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getNomeGerPorUsuarErp ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getDadosUsuarTiControle ------*/

function getDadosUsuarTiControle($usuarImaonline){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = "usuar_portal = '$usuarImaonline'";
    $aDados = $this->getDados('multi','DBO.s_users','',$condicao,'ticontrole');

    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getDadosUsuarTiControle ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getDadosUsuarErp ------*/

function getDadosUsuarErp($usuarTiControle){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = "login = '$usuarTiControle'";
    $aDados = $this->getDados('multi','DBO.s_users','',$condicao,'ticontrole');

    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getDadosUsuarErp ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getUsuarTiControle ------*/

function getUsuarTiControle($usuarImaonline){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $loginTiControle ='';
    $condicao = "usuar_portal = '$usuarImaonline'";
    $aDados = $this->getDados('multi','DBO.s_users','login',$condicao,'ticontrole');
    if($aDados){
        $loginTiControle = $aDados[0]['login'];
    }
    return $loginTiControle;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getUsuarTiControle ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getHashAuticApiImp ------*/

function getHashAuticApiImp($impPadrao){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $reg = '';
    $aReg = $this->getReg('ticontrole','dbo.impressoras','id',"'$impPadrao'",'autorizacao');
    if($aReg){
        $reg = $aReg[0]["autorizacao"];
    }
    return $reg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getHashAuticApiImp ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function verificaGrpUsuar ------*/

function verificaGrpUsuar($codGrupo,$usuario)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $log = 0;
    $listaGrupos = $this->getGruposUsuario("$usuario");
    $aGrupos = explode(',',$listaGrupos);
    if($aGrupos){
        foreach($aGrupos as $grupos){
            if($grupos == $codGrupo){
                $log = 1;
            }
        }
    }
    return $log;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function verificaGrpUsuar ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function getLoginsUsuariosVendaPedImp ------*/

function getLoginsUsuariosVendaPedImp()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $campo = 'login';
    $aReg = $this->getDados('multi','pub."user-web"',$campo,'log_venda_ped_imp = 1');
    return $this->convArrayMultParaLista($aReg,$campo,false);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function getLoginsUsuariosVendaPedImp ------*/


/*----- Scriptcase Locale: PHP Method: usuario.php => function sincrLoginsUsuariosVendaPedImp ------*/

function sincrLoginsUsuariosVendaPedImp($lista)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($lista == ''){
        $lista ="'#'";
    }
    $lista = $this->inserirAspasEmLista($lista);
    $update01 = "update pub.\"user-web\" set log_venda_ped_imp = 0 where login not in ($lista)";
    
     $nm_select = $update01; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    $update01 = "update pub.\"user-web\" set log_venda_ped_imp = 1 where login  in ($lista)";
    
     $nm_select = $update01; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: usuario.php => function sincrLoginsUsuariosVendaPedImp ------*/


/*----- Scriptcase Locale: PHP Method: load.php => function load ------*/

function load(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="e-loadholder">
  <div class="m-loader">
    <span class="e-text">Pesquisando...</span>
  </div>
</div>
<div id="particleCanvas-Blue"></div>
<div id="particleCanvas-White"></div>

<style>
@-webkit-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
@-moz-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
@-o-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
@keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
@-webkit-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}
@-moz-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}
@-o-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}
@keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}
@-webkit-keyframes textColour {
  0% {
    color: #f7f7f7;
  }
  100% {
    color: #000;
  }
}
@-moz-keyframes textColour {
  0% {
    color: #f7f7f7;
  }
  100% {
    color: #3BB2D0;
  }
}
@-o-keyframes textColour {
  0% {
    color: #f7f7f7;
  }
  100% {
    color: #3BB2D0;
  }
}
@keyframes textColour {
  0% {
    color: #f7f7f7;
  }
  100% {
  	font-weight: bold;
    color: #000;
  }
}
html {
  font-size: 62.5%;
}

body {
  margin: 0;
  padding: 0;
  font-family: "Open Sans", sans-serif;
  width: 100vw;
  height: 100vh;
  background: #f7f7f7;
}

.e-loadholder {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 240px;
  height: 240px;
  border: 5px solid #1B5F70;
  border-radius: 120px;
  box-sizing: border-box;
}
.e-loadholder:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #f7f7f7;
  transform-origin: center;
  z-index: 0;
}
.e-loadholder:after {
  width: 100px;
  height: 200%;
  -webkit-animation: outerRotate2 30s infinite linear;
  -moz-animation: outerRotate2 30s infinite linear;
  -o-animation: outerRotate2 30s infinite linear;
  animation: outerRotate2 30s infinite linear;
}
.e-loadholder .m-loader {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 200px;
  height: 200px;
  color: #888;
  text-align: center;
  border: 5px solid #2a93ae;
  border-radius: 100px;
  box-sizing: border-box;
  z-index: 20;
  text-transform: uppercase;
}
.e-loadholder .m-loader:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #f7f7f7;
  transform-origin: center;
  z-index: -1;
}
.e-loadholder .m-loader:after {
  width: 100px;
  height: 106%;
  -webkit-animation: outerRotate1 15s infinite linear;
  -moz-animation: outerRotate1 15s infinite linear;
  -o-animation: outerRotate1 15s infinite linear;
  animation: outerRotate1 15s infinite linear;
}
.e-loadholder .m-loader .e-text {
  font-size: 14px;
  font-size: 1.4rem;
  line-height: 130px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  -webkit-animation: textColour 1s alternate linear infinite;
  -moz-animation: textColour 1s alternate linear infinite;
  -o-animation: textColour 1s alternate linear infinite;
  animation: textColour 1s alternate linear infinite;
  display: block;
  width: 140px;
  height: 140px;
  text-align: center;
  border: 5px solid #3bb2d0;
  border-radius: 70px;
  box-sizing: border-box;
  z-index: 20;
}
.e-loadholder .m-loader .e-text:before, .e-loadholder .m-loader .e-text:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #f7f7f7;
  transform-origin: center;
  z-index: -1;
}
.e-loadholder .m-loader .e-text:before {
  width: 110%;
  height: 40px;
  -webkit-animation: outerRotate2 3.5s infinite linear;
  -moz-animation: outerRotate2 3.5s infinite linear;
  -o-animation: outerRotate2 3.5s infinite linear;
  animation: outerRotate2 3.5s infinite linear;
}
.e-loadholder .m-loader .e-text:after {
  width: 40px;
  height: 110%;
  -webkit-animation: outerRotate1 8s infinite linear;
  -moz-animation: outerRotate1 8s infinite linear;
  -o-animation: outerRotate1 8s infinite linear;
  animation: outerRotate1 8s infinite linear;
}

#particleCanvas-White {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 100%;
  height: 50%;
  opacity: 0.1;
}

#particleCanvas-Blue {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 300px;
  height: 300px;
}

</style>
<script>
particlesJS("particleCanvas-Blue", {
	particles: {
		number: {
			value: 100,
			density: {
				enable: true,
				value_area: 800
			}
		},
		color: {
			value: "#1B5F70"
		},
		shape: {
			type: "circle",
			stroke: {
				width: 0,
				color: "#d3d3d3"
			},
			polygon: {
				nb_sides: 3
			},
			image: {
				src: "img/github.svg",
				width: 100,
				height: 100
			}
		},
		opacity: {
			value: 0.5,
			random: false,
			anim: {
				enable: true,
				speed: 1,
				opacity_min: 0.1,
				sync: false
			}
		},
		size: {
			value: 10,
			random: true,
			anim: {
				enable: false,
				speed: 10,
				size_min: 0.1,
				sync: false
			}
		},
		line_linked: {
			enable: false,
			distance: 150,
			color: "#ffffff",
			opacity: 0.4,
			width: 1
		},
		move: {
			enable: true,
			speed: 0.5,
			direction: "none",
			random: true,
			straight: false,
			out_mode: "bounce",
			bounce: false,
			attract: {
				enable: false,
				rotateX: 394.57382081613633,
				rotateY: 157.82952832645452
			}
		}
	},
	interactivity: {
		detect_on: "canvas",
		events: {
			onhover: {
				enable: true,
				mode: "grab"
			},
			onclick: {
				enable: false,
				mode: "push"
			},
			resize: true
		},
		modes: {
			grab: {
				distance: 200,
				line_linked: {
					opacity: 0.2
				}
			},
			bubble: {
				distance: 1500,
				size: 40,
				duration: 7.272727272727273,
				opacity: 0.3676323676323676,
				speed: 3
			},
			repulse: {
				distance: 50,
				duration: 0.4
			},
			push: {
				particles_nb: 4
			},
			remove: {
				particles_nb: 2
			}
		}
	},
	retina_detect: true
});

particlesJS("particleCanvas-White", {
	particles: {
		number: {
			value: 250,
			density: {
				enable: true,
				value_area: 800
			}
		},
		color: {
			value: "#ffffff"
		},
		shape: {
			type: "circle",
			stroke: {
				width: 0,
				color: "#d3d3d3"
			},
			polygon: {
				nb_sides: 3
			},
			image: {
				src: "img/github.svg",
				width: 100,
				height: 100
			}
		},
		opacity: {
			value: 0.5,
			random: true,
			anim: {
				enable: false,
				speed: 0.2,
				opacity_min: 0,
				sync: false
			}
		},
		size: {
			value: 15,
			random: true,
			anim: {
				enable: true,
				speed: 10,
				size_min: 0.1,
				sync: false
			}
		},
		line_linked: {
			enable: false,
			distance: 150,
			color: "#ffffff",
			opacity: 0.4,
			width: 1
		},
		move: {
			enable: true,
			speed: 0.5,
			direction: "none",
			random: true,
			straight: false,
			out_mode: "bounce",
			bounce: false,
			attract: {
				enable: true,
				rotateX: 3945.7382081613637,
				rotateY: 157.82952832645452
			}
		}
	},
	interactivity: {
		detect_on: "canvas",
		events: {
			onhover: {
				enable: false,
				mode: "grab"
			},
			onclick: {
				enable: false,
				mode: "push"
			},
			resize: true
		},
		modes: {
			grab: {
				distance: 200,
				line_linked: {
					opacity: 0.2
				}
			},
			bubble: {
				distance: 1500,
				size: 40,
				duration: 7.272727272727273,
				opacity: 0.3676323676323676,
				speed: 3
			},
			repulse: {
				distance: 50,
				duration: 0.4
			},
			push: {
				particles_nb: 4
			},
			remove: {
				particles_nb: 2
			}
		}
	},
	retina_detect: true
});
	
	</script> 


<?php

 

 $head_loading ='<div id="particleCanvas-Blue"></div>
<div id="particleCanvas-White"></div>';
echo  $head_loading;

	usleep(50000);
	echo $head_loading;
	usleep(50000);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: load.php => function load ------*/


/*----- Scriptcase Locale: PHP Method: load.php => function loadBranco ------*/

function loadBranco(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    ?>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="e-loadholder">
        <div class="m-loader">
            <span class="e-text">Pesquisando...</span>
        </div>
    </div>
    <div id="particleCanvas-Blue"></div>
    <div id="particleCanvas-White"></div>

    <style>
        @-webkit-keyframes outerRotate1 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
        @-moz-keyframes outerRotate1 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
        @-o-keyframes outerRotate1 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
        @keyframes outerRotate1 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
        @-webkit-keyframes outerRotate2 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }
        @-moz-keyframes outerRotate2 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }
        @-o-keyframes outerRotate2 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }
        @keyframes outerRotate2 {
            0% {
                transform: translate(-50%, -50%) rotate(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }
        @-webkit-keyframes textColour {
            0% {
                color: #fff;
            }
            100% {
                color: #000;
            }
        }
        @-moz-keyframes textColour {
            0% {
                color: #fff;
            }
            100% {
                color: #3BB2D0;
            }
        }
        @-o-keyframes textColour {
            0% {
                color: #f7f7f7;
            }
            100% {
                color: #3BB2D0;
            }
        }
        @keyframes textColour {
            0% {
                color: #fff;
            }
            100% {
                font-weight: bold;
                color: #000;
            }
        }
        html {
            font-size: 62.5%;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Open Sans", sans-serif;
            width: 100vw;
            height: 100vh;
            background: #fff;
        }

        .e-loadholder {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            width: 240px;
            height: 240px;
            border: 5px solid #1B5F70;
            border-radius: 120px;
            box-sizing: border-box;
        }
        .e-loadholder:after {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            content: " ";
            display: block;
            background: #fff;
            transform-origin: center;
            z-index: 0;
        }
        .e-loadholder:after {
            width: 100px;
            height: 200%;
            -webkit-animation: outerRotate2 30s infinite linear;
            -moz-animation: outerRotate2 30s infinite linear;
            -o-animation: outerRotate2 30s infinite linear;
            animation: outerRotate2 30s infinite linear;
        }
        .e-loadholder .m-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            width: 200px;
            height: 200px;
            color: #888;
            text-align: center;
            border: 5px solid #2a93ae;
            border-radius: 100px;
            box-sizing: border-box;
            z-index: 20;
            text-transform: uppercase;
        }
        .e-loadholder .m-loader:after {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            content: " ";
            display: block;
            background: #fff;
            transform-origin: center;
            z-index: -1;
        }
        .e-loadholder .m-loader:after {
            width: 100px;
            height: 106%;
            -webkit-animation: outerRotate1 15s infinite linear;
            -moz-animation: outerRotate1 15s infinite linear;
            -o-animation: outerRotate1 15s infinite linear;
            animation: outerRotate1 15s infinite linear;
        }
        .e-loadholder .m-loader .e-text {
            font-size: 14px;
            font-size: 1.4rem;
            line-height: 130px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            -webkit-animation: textColour 1s alternate linear infinite;
            -moz-animation: textColour 1s alternate linear infinite;
            -o-animation: textColour 1s alternate linear infinite;
            animation: textColour 1s alternate linear infinite;
            display: block;
            width: 140px;
            height: 140px;
            text-align: center;
            border: 5px solid #3bb2d0;
            border-radius: 70px;
            box-sizing: border-box;
            z-index: 20;
        }
        .e-loadholder .m-loader .e-text:before, .e-loadholder .m-loader .e-text:after {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            content: " ";
            display: block;
            background: #fff;
            transform-origin: center;
            z-index: -1;
        }
        .e-loadholder .m-loader .e-text:before {
            width: 110%;
            height: 40px;
            -webkit-animation: outerRotate2 3.5s infinite linear;
            -moz-animation: outerRotate2 3.5s infinite linear;
            -o-animation: outerRotate2 3.5s infinite linear;
            animation: outerRotate2 3.5s infinite linear;
        }
        .e-loadholder .m-loader .e-text:after {
            width: 40px;
            height: 110%;
            -webkit-animation: outerRotate1 8s infinite linear;
            -moz-animation: outerRotate1 8s infinite linear;
            -o-animation: outerRotate1 8s infinite linear;
            animation: outerRotate1 8s infinite linear;
        }

        #particleCanvas-White {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            width: 100%;
            height: 50%;
            opacity: 0.1;
        }

        #particleCanvas-Blue {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-51%, -50%);
            -moz-transform: translate(-51%, -50%);
            -ms-transform: translate(-51%, -50%);
            -o-transform: translate(-51%, -50%);
            transform: translate(-51%, -50%);
            width: 300px;
            height: 300px;
        }

    </style>
    <script>
        particlesJS("particleCanvas-Blue", {
            particles: {
                number: {
                    value: 100,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#1B5F70"
                },
                shape: {
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#d3d3d3"
                    },
                    polygon: {
                        nb_sides: 3
                    },
                    image: {
                        src: "img/github.svg",
                        width: 100,
                        height: 100
                    }
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: true,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 10,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 10,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: false,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 0.5,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "bounce",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 394.57382081613633,
                        rotateY: 157.82952832645452
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "grab"
                    },
                    onclick: {
                        enable: false,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 200,
                        line_linked: {
                            opacity: 0.2
                        }
                    },
                    bubble: {
                        distance: 1500,
                        size: 40,
                        duration: 7.272727272727273,
                        opacity: 0.3676323676323676,
                        speed: 3
                    },
                    repulse: {
                        distance: 50,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 4
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });

        particlesJS("particleCanvas-White", {
            particles: {
                number: {
                    value: 250,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle",
                    stroke: {
                        width: 0,
                        color: "#d3d3d3"
                    },
                    polygon: {
                        nb_sides: 3
                    },
                    image: {
                        src: "img/github.svg",
                        width: 100,
                        height: 100
                    }
                },
                opacity: {
                    value: 0.5,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 0.2,
                        opacity_min: 0,
                        sync: false
                    }
                },
                size: {
                    value: 15,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 10,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: false,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 0.5,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "bounce",
                    bounce: false,
                    attract: {
                        enable: true,
                        rotateX: 3945.7382081613637,
                        rotateY: 157.82952832645452
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: false,
                        mode: "grab"
                    },
                    onclick: {
                        enable: false,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 200,
                        line_linked: {
                            opacity: 0.2
                        }
                    },
                    bubble: {
                        distance: 1500,
                        size: 40,
                        duration: 7.272727272727273,
                        opacity: 0.3676323676323676,
                        speed: 3
                    },
                    repulse: {
                        distance: 50,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 4
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });

    </script>


<?php



$head_loading ='<div id="particleCanvas-Blue"></div>
<div id="particleCanvas-White"></div>';
echo  $head_loading;

usleep(50000);
echo $head_loading;
usleep(50000);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: load.php => function loadBranco ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function dataCorrenteProgress ------*/

function dataCorrenteProgress()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $dt = getdate();
    $data_hora = $dt['mon']."/".$dt['mday']."/".$dt['year']." ".$dt['hours'].":".$dt['minutes'].":".$dt['seconds'];
    return $data_hora;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function dataCorrenteProgress ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function retonarDatasMesCorrente ------*/

function retonarDatasMesCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRetorno = array();
    $dt =getDate();
    $proximoAno = 0;
    $dtIni = $dt['mon']."/01/".$dt['year'];
    $proximoMes = $dt['mon'] + 1;
    if($proximoMes == 13){
        $proximoMes = 01;
        $proximoAno = $dt['year'] + 1;
    }else{
        $proximoAno = $dt['year'];
    }
    if($proximoMes < 10){
        $proximoMes = '0'.$proximoMes;
    }

    $diaProximoMes = $proximoMes.'/01/'.$proximoAno;
    $dtFim = 
         $this->nm_data->CalculaData($diaProximoMes, "mm/dd/aaaa", "-", 1, 0, 0, "aaaa-mm-dd",  "mm/dd/aaaa"); 
      ;
    $aRetorno[] = array("dtIni" => $dtIni, "dtFim" => $dtFim);
    return $aRetorno;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function retonarDatasMesCorrente ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function getParteDtCorrente ------*/

function getParteDtCorrente($parte)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = "";
    switch ($parte){
        case 'dia':
            $retorno = 'mday';
            break;
        case 'mes':
            $retorno = 'mon';
            break;
        case 'ano':
            $retorno = 'year';
            break;
        case 'hora':
            $retorno = 'hours';
            break;
        case 'minuto':
            $retorno = 'minutes';
            break;
        case 'segundo':
            $retorno = 'seconds';
            break;

    }
    $hoje = getdate();
    return $hoje[$retorno];

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function getParteDtCorrente ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function diasUteisMes ------*/

function diasUteisMes($aDataParam = '')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
      
    $qtDiasPassados = 0;
    $qtDiasRestantes = 0;
    if($aDataParam == ''){
        $aDataParam = array();
        $aDataParam['dia'] = $this->getParteDtCorrente('dia');
        $aDataParam['mes'] = $this->getParteDtCorrente('mes');
        $aDataParam['ano'] = $this->getParteDtCorrente('ano');
    }
    $dia = $aDataParam['dia'];
    $mes = $aDataParam['mes'];
    $ano = $aDataParam['ano'];
    $qtDiasMes = cal_days_in_month ( CAL_GREGORIAN , $mes , $ano );
    for($i=0;$i < $qtDiasMes;$i++){
        $j = $i + 1;
        $diaSemana = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, $j, $ano) , 0);
        if($j < 10){
            $diaCorrente = "0{$j}";
        }else{
            $diaCorrente = $j;
        }
        $diaUtilCalend = $this->getUtilizDiaCalend("{$ano}-{$mes}-{$diaCorrente}");

        if($diaSemana > 0 and $diaSemana < 6 and $diaUtilCalend == 1){ 
            if($j <= $dia){
                $qtDiasPassados++;
            }else{
                $qtDiasRestantes++;
            }
        }
    }
    $qtDiasUteis = $qtDiasPassados + $qtDiasRestantes;
    $retorno = array('qt_dias_uteis' => $qtDiasUteis,
        'qt_dias_passados' => $qtDiasPassados,
        'qt_dias_restantes' => $qtDiasRestantes);
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function diasUteisMes ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function getQuinzenaMesAnoData ------*/

function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($data == '' or $data == null){
        return '';
    }
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function getQuinzenaMesAnoData ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function convMes ------*/

function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retAbrev = '';
    $retCompl = '';
    $diasNoMes  = '';
    $retorno  = '';
    $ano = date('Y');
    if($ano % 4 == 0 and $ano % 100 <> 0 ){
        $lAnobisexto = true;
    }else{
        $lAnobisexto = false;
    }
    switch ($mes){
        case '01':
            $retAbrev = "Jan";
            $retCompl = "Janeiro";
            $diasNoMes  = '31';
            break;
        case '02':
            $retAbrev = "Fev";
            $retCompl = "Fevereiro";
            $lAnobisexto ? $diasNoMes  = '29' : $diasNoMes  = '28';
            break;
        case '03':
            $retAbrev = "Mar";
            $retCompl = "Março";
            $diasNoMes  = '31';
            break;
        case '04':
            $retAbrev = "Abr";
            $retCompl = "Abril";
            $diasNoMes  = '30';
            break;
        case '05':
            $retAbrev = "Mai";
            $retCompl = "Maio";
            $diasNoMes  = '31';
            break;
        case '06':
            $retAbrev = "Jun";
            $retCompl = "Junho";
            $diasNoMes  = '30';
            break;
        case '07':
            $retAbrev = "Jul";
            $retCompl = "Julho";
            $diasNoMes  = '31';
            break;
        case '08':
            $retAbrev = "Ago";
            $retCompl = "Agosto";
            $diasNoMes  = '31';
            break;
        case '09':
            $retAbrev = "Set";
            $retCompl = "Setembro";
            $diasNoMes  = '30';
            break;
        case '10':
            $retAbrev = "Out";
            $retCompl = "Outubro";
            $diasNoMes  = '31';
            break;
        case '11':
            $retAbrev = "Nov";
            $retCompl = "Novembro";
            $diasNoMes  = '30';
            break;
        case '12':
            $retAbrev = "Dez";
            $retCompl = "Dezembro";
            $diasNoMes  = '31';
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
        case 'dias_mes':
            $retorno = $diasNoMes;
            break;

    }

    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function convMes ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function getAgora ------*/

function getAgora($formato="en")
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $agora = '';
    switch ($formato){
        case 'en':
            $agora = date('Y-m-d H:i:s');
            break;
        case 'br':
            $agora = date('d/m/Y H:i:s');
            break;
        default:
            $agora =date($formato);

    }
    return $agora;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function getAgora ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function compararDtHoraForm ------*/

function compararDtHoraForm($dtHrForm,$dtHrPhp)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dtHrForm = str_replace(':000','',$dtHrForm);
    $dtHrPhp = str_replace('-','',$dtHrPhp);
    return $dtHrForm == $dtHrPhp;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function compararDtHoraForm ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function convDtForUTC ------*/

function convDtForUTC($dateTime,$timeZoneOrigem='UTC',$timeZoneDestino='America/Sao_Paulo')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $dt = new DateTime($dateTime, new DateTimeZone($timeZoneOrigem));
    $dt->setTimezone(new DateTimeZone($timeZoneDestino));

    return array('objeto'=>$dt, 'dt_hr_en' =>  $dt->format('Y-m-d H:i:s'));

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function convDtForUTC ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function convDtForUTCFormatEn ------*/

function convDtForUTCFormatEn($dateTime,$timeZoneOrigem='UTC',$timeZoneDestino='America/Sao_Paulo')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $a = $this->convDtForUTC($dateTime,$timeZoneOrigem,$timeZoneDestino);
    return $a['dt_hr_en'];

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function convDtForUTCFormatEn ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function verificarDataFutura ------*/

function verificarDataFutura($data){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $lDtFut = false;
    $hoje = date('d-m-Y');
    $dtFut =  date('d-m-Y', strtotime("+5 days",strtotime($hoje)));
    if(strtotime($data) > strtotime($dtFut)){
        $lDtFut = true;
    }
    return $lDtFut;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function verificarDataFutura ------*/


/*----- Scriptcase Locale: PHP Method: data.php => function convDataEnFormatoEspec ------*/

function convDataEnFormatoEspec($data,$formato='d/m/Y')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $data = date_create($data);
    return $data->format($formato);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: data.php => function convDataEnFormatoEspec ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function iniciarLogDb ------*/

function iniciarLogDb($apl,$usuarioLogId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $usuario = $this->getUsuarioCorrente();
    $cmd = "insert into logs(aplicacao,login,dt_hr_inicio,usuario_log_id)
            values('$apl','$usuario',current_timestamp, '$usuarioLogId' ) ";
    $conBase = $this->conectarBase('log_db',$this->getUserLogDb(),$this->getAutLogDb());
    $aRet = $this->execAcaoPDO($cmd,$conBase,'cmd');
    if(isset($aRet['erro'])){
        if($aRet['erro'] <> ''){
            echo "<h1>{$aRet['erro']}</h1>";
        }
    }
    $id = $this->getUltIdTabela('logs');
    $this->setIdCorrenteLogDb($id);
    return $id;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function iniciarLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getUsuarioCorrente ------*/

function getUsuarioCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
        return $this->getLoginCorrente();

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getUsuarioCorrente ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function setIdCorrenteLogDb ------*/

function setIdCorrenteLogDb($id)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $_SESSION['log_db']['id_corrente'] = $id;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function setIdCorrenteLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getIdCorrenteLogDb ------*/

function getIdCorrenteLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['id_corrente'])){
        $retorno = $_SESSION['log_db']['id_corrente'];
    }else{
        $retorno = -1;
    }
     return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getIdCorrenteLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function habilitarLogSql ------*/

function habilitarLogSql($log)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $this->setVarSessao('log_db_sql',$log);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function habilitarLogSql ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getLogSql ------*/

function getLogSql()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao('log_db_sql');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getLogSql ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function inserirLogDb ------*/

function inserirLogDb($titulo,$descricaoParam='',$funcao='',$id=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
        $aConBase = $this->conectarBase('log_db',$this->getUserLogDb(),$this->getAutLogDb());
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function inserirLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getGerarLogUsuarioCorrente ------*/

function getGerarLogUsuarioCorrente($apl='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $usuario = strtolower($this->getLoginCorrente()) ;
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getGerarLogUsuarioCorrente ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function incrNivelCorrenteLogDb ------*/

function incrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] += 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function incrNivelCorrenteLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function decrNivelCorrenteLogDb ------*/

function decrNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $_SESSION['log_db']['nivel_corrente'] -= 1 ;
    }else{
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    if($_SESSION['log_db']['nivel_corrente'] < 1){
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $_SESSION['log_db']['nivel_corrente'];

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function decrNivelCorrenteLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getNivelCorrenteLogDb ------*/

function getNivelCorrenteLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(isset($_SESSION['log_db']['nivel_corrente'])){
        $nivel = $_SESSION['log_db']['nivel_corrente'];
    }else{
        $nivel = 1;
        $_SESSION['log_db']['nivel_corrente'] = 1;
    }
    return $nivel;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getNivelCorrenteLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function zerarLogDb ------*/

function zerarLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->setIdCorrenteLogDb(-1);
    $idUsuarioLog = $this->getGerarLogUsuarioCorrente($aplCorrente);
    if($idUsuarioLog >= 1){
        $this->iniciarLogDb($aplCorrente,$idUsuarioLog);
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function zerarLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function excluirLogDb ------*/

function excluirLogDb($idLog = 0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function excluirLogDb ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function validarAltUsuarioLog ------*/

function validarAltUsuarioLog($usuarioLog,$dtHrIni,$dtHrFim)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
    $agora = $this->getAgora('Ymd H:i:su');
    if($qtLogs > 0){
        if(substr($agora,0,17) > substr($dtHrFim,0,17) and
            ! $this->compararDtHoraForm($dtHrFim ,$dtHrFimAtual) ){
            $msg = "<h3>A data/hora final não pode ser menor que o horário atual</h3>";
        }


        if(! $this->compararDtHoraForm($dtHrIni,$dtHrIniAtual)){
            $msg .= "<h3>A data/hora inicial não pode ser alterada, pois existem registros de log associados</h3>";
        }
    }
    return $msg;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function validarAltUsuarioLog ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getQtItensLog ------*/

function getQtItensLog($log)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
                   'itens_log',
    'log_id',$log,
    'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getQtItensLog ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getQtLogsUsuarioLg ------*/

function getQtLogsUsuarioLg($usuarioLog)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'logs',
        'usuario_log_id',$usuarioLog,
        'count(id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getQtLogsUsuarioLg ------*/


/*----- Scriptcase Locale: PHP Method: log_db.php => function getRegUsuarioLog ------*/

function getRegUsuarioLog($log)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qt= 0;
    $aReg = $this->getReg('log_db',
        'usuario_log',
        'id',$log,
        'id,dt_hr_inicial,dt_hr_final');
    return $aReg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log_db.php => function getRegUsuarioLog ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getDadosNf ------*/

function getDadosNf($codEstabel,$nrPedido,$nomeAbrev){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    if (strpos($nomeAbrev, "'") !== false) {
        $nomeAbrev = str_replace("'", "''", $nomeAbrev);
    }
    $nrNf     = 0;
    $tipo     = "unico";
    $tabela   = " pub.\"nota-fiscal\" as nf ";
    $campos   = "nf.\"nr-nota-fis\" as nr_nf,nf.estado as estado,nf.cidade as cidade, nf.\"peso-bru-tot\" as peso_bruto, nf.\"dt-emis-nota\" as dt_emis_nf";
    $condicao = "  nf.\"nome-ab-cli\" = '$nomeAbrev' and nf.\"cod-estabel\" = $codEstabel and nf.\"nr-pedcli\" = $nrPedido and nf.\"dt-cancela\" is null";
    $conexao  = "med";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getDadosNf ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getCondEntreEmpresas ------*/

function getCondEntreEmpresas($origem,$tipo,$valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $entreEmpresas = '';
    switch ($origem){
        case 'venda':
            $condMed = " AND nf.\"cod-emitente\" <> 1 
                    and nf.\"cod-estabel\" in ('5','505')";
            $condIma  = " AND nf.\"cod-emitente\" <> 10535 
                    and nf.\"cod-estabel\" = '1'";
            break;
        case 'devolucao':
            $condMed = " AND dev.\"cod-emitente\" <> 1 ";
            $condIma  = " AND nf.\"cod-emitente\" <> 10535 ";
            break;
    }

    switch ($tipo)
    {
        case 'base':
            switch($valor){
                case 'med':
                    $entreEmpresas = $condMed ;
                    break;
                case 'ima':
                    $entreEmpresas = $condIma ;
                    break;
            }
            break;
        case 'empresa':
        case 'MED':
            $entreEmpresas = $condMed;
            break;
        case 'IMA':
            $entreEmpresas = $condIma;
            break;
            break;

    }
    return $entreEmpresas;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getCondEntreEmpresas ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNfMes ------*/

function getTotVendNfMes($base="med",$filtroMes='',$logFiltroTipoUsuario=true, $logPorRepres=1)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aDatasMes = $this->retonarDatasMesCorrente();
    $dtIni     = $aDatasMes[0]['dtIni'];
    $dtFim     = $aDatasMes[0]['dtFim'];
    $filtro = " and nf.\"dt-emis-nota\" >= '$dtIni' and nf.\"dt-emis-nota\" <= '$dtFim' ";
    if($filtroMes <> ''){
        $filtro .= $filtroMes;
    }
    if($logPorRepres == 1){
        $retorno = $this->getTotVendNfRepres($base,$filtro,$logFiltroTipoUsuario);
    }else{
        $retorno = $this->getTotVendNf($base,$filtro,$logFiltroTipoUsuario);
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNfMes ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNfRepres ------*/

function getTotDevNfRepres($base='med',$filtro='',$logFiltroTipoUsuario=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dev         = array();
    $desc        = array();
    $vlDevTot    = 0;
    $vlDescTot   = 0;
    $total       = 0;
    $condLista = '';
    $tabela   = "  pub.\"devol-cli\" relacto_venda ,PUB.\"docum-est\" dev,pub.\"nota-fiscal\" venda,
    pub.\"ped-venda\" ped,PUB.\"natur-oper\" nat, pub.\"ped-repre\" ped_rep   ";
    $campos   = " sum(relacto_venda.\"vl-devol\") as totdev, 
round(sum(relacto_venda.\"vl-devol\" * (((100/(1 - ped.\"val-pct-desconto-total\"/100)) -100) /100))|2) as totdesc,
  ped_rep.\"nome-ab-rep\" as nome_abrev";
    $condicao = ' relacto_venda."nat-operacao"  = nat."nat-operacao"
            and nat."tipo-compra"               = 3 and nat."tp-rec-desp" = 1
            and relacto_venda."serie-docto"     = dev."serie-docto"
            and relacto_venda."nro-docto"       = dev."nro-docto"
            and relacto_venda."cod-emitente"    = dev."cod-emitente"
            and relacto_venda."nat-operacao"    = dev."nat-operacao"
            and venda."cod-estabel"             = relacto_venda."cod-estabel"
            and venda."nr-nota-fis"             = relacto_venda."nr-nota-fis"
            and venda."serie"                   = relacto_venda."serie"
            and ped."nr-pedido"                 = venda."nr-pedcli" 
            and ped_rep."nr-pedido"             = ped."nr-pedido"';

    if($logFiltroTipoUsuario == true) {
        $condicaoTpUsuario = $this->aplicarFiltroTipoUsuarioPV('devol-cli','venda' );
        $listaNfs = $this->getListaDevNfFiltroPedRepre($condicao.$filtro.$condicaoTpUsuario);
        if($listaNfs == ''){
            $listaNfs = "''";
            $condLista = " and \"nr-nota-fis\" in ($listaNfs)";
        }
    }
    $condicao .=  $filtro. $condLista;
    $entreEmpresas = $this->getCondEntreEmpresas('devolucao','base',$base);
    $condicao .= $entreEmpresas;
    $condicao .= " and substring(venda.\"cod-estabel\",1,1) = '5' group by nome_abrev";

    $aRet = $this->retornoMultReg($tabela,$campos,$condicao,$base);

    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $nomeRep = $aRet[$i]['nome_abrev'];
            $vlDev   = $aRet[$i]['totdev'];
            $vlDesc  = $aRet[$i]['totdesc'];
            $codRep = $this->buscarCodRep($nomeRep);
            $dev[$codRep]  = $vlDev ;
            $desc[$codRep] = $vlDesc ;
            $vlDevTot += $vlDev;
            $vlDescTot += $vlDesc;
        }
        $total = $vlDevTot + $vlDescTot;
    }
    $retorno = array('dev' => $dev, 'desc' => $desc ,
        'total' => $total,'total_dev'=> $vlDevTot,
        'total_desc' => $vlDescTot) ;
    return $retorno;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNfRepres ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNf ------*/

function getTotDevNf($base='med',$filtro='',$logFiltroTipoUsuario=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dev         = array();
    $desc        = array();
    $vlDevTot    = 0;
    $vlDescTot   = 0;
    $total       = 0;
    $condLista = '';
    $tabela   = "  pub.\"devol-cli\" relacto_venda ,PUB.\"docum-est\" dev,pub.\"nota-fiscal\" venda,pub.\"ped-venda\" ped,PUB.\"natur-oper\"  nat  ";
    $campos   = " sum(relacto_venda.\"vl-devol\") as totdev, 
        round(sum(relacto_venda.\"vl-devol\" * (((100/(1 - ped.\"val-pct-desconto-total\"/100)) -100) /100))|2) as totdesc,
          venda.\"cod-rep\" as cod_rep";
    $condicao = "  relacto_venda.\"nat-operacao\" = nat.\"nat-operacao\"
        and nat.\"tipo-compra\" = 3 and nat.\"tp-rec-desp\" = 1
        and relacto_venda.\"serie-docto\" = dev.\"serie-docto\"
        and relacto_venda.\"nro-docto\"  = dev.\"nro-docto\"
        and relacto_venda.\"cod-emitente\" = dev.\"cod-emitente\"
        and relacto_venda.\"nat-operacao\" = dev.\"nat-operacao\"
        and venda.\"cod-estabel\" = relacto_venda.\"cod-estabel\"
        and venda.\"nr-nota-fis\" = relacto_venda.\"nr-nota-fis\"
        and venda.\"serie\"       = relacto_venda.\"serie\"
        and  ped.\"nr-pedido\" = venda.\"nr-pedcli\"    ";


    if($logFiltroTipoUsuario == true) {
        $condicaoTpUsuario = $this->aplicarFiltroTipoUsuarioPV('devol-cli','venda' );
        $listaNfs = $this->getListaDevNfFiltroPedRepre($condicao.$filtro.$condicaoTpUsuario);
        if($listaNfs == ''){
            $listaNfs = "''";
            $condLista = " and dev.\"nro-docto\" in ($listaNfs)";
        }

    }
    $condicao .=  $filtro.$condLista;
    $entreEmpresas = $this->getCondEntreEmpresas('devolucao','base',$base);
    $condicao .= $entreEmpresas;
    $condicao .= "group by venda.\"cod-rep\"";

    $aRet = $this->retornoMultReg($tabela,$campos,$condicao,$base);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $codRep = $aRet[$i]['cod_rep'];
            $vlDev   = $aRet[$i]['totdev'];
            $vlDesc = $aRet[$i]['totdesc'];
            $dev[$codRep]  = $vlDev ;
            $desc[$codRep] = $vlDesc ;
            $vlDevTot += $vlDev;
            $vlDescTot += $vlDesc;
        }
        $total = $vlDevTot + $vlDescTot;
    }
    $retorno = array('dev' => $dev, 'desc' => $desc ,
        'total' => $total,'total_dev'=> $vlDevTot,
        'total_desc' => $vlDescTot) ;
    return $retorno;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNf ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNf ------*/

function getTotVendNf($base="med",$filtro='',$logFiltroTipoUsuario=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $nf         = array();
    $desc       = array();
    $vlNfTot    = 0;
    $vlDescTot  = 0;
    $vlTotal      = 0;
    $condLista  = '';
    $tabela     = " pub.\"nota-fiscal\" nf , PUB.\"natur-oper\" nat ,
                  pub.\"ped-venda\" pedido ";
    $campos   = " sum(nf.\"vl-tot-nota\") as tot, 
                     sum(nf.\"vl-tot-nota\" * (((100/(1 - pedido.\"val-pct-desconto-total\"/100)) -100) /100)) as totdesc,
                     nf.\"cod-rep\" as cod_rep";
    $condicao = " nf.\"dt-cancela\" is null 
                 and nf.\"nat-operacao\" = nat.\"nat-operacao\" 
                 and nat.\"tp-rec-desp\" = 1 and nat.\"tipo-compra\" <> 3                 
                 and nf.\"nr-pedcli\"   = pedido.\"nr-pedido\"                
                  " ;



    if($logFiltroTipoUsuario == true){
        $condicaoTpUsuario= $this->aplicarFiltroTipoUsuarioPV('nota-fiscal','nf');
        $listaNfs = $this->getListaNfFiltroPedRepre($condicao.$filtro.$condicaoTpUsuario);

        if($listaNfs == ''){
            $listaNfs = "''";
        }
        $condLista = " and \"nr-nota-fis\" in ($listaNfs)";
    }
    $condicao .=  $filtro. $condLista;

    $entreEmpresas = $this->getCondEntreEmpresas('venda','base',$base);
    $condicao .= $entreEmpresas;
    $condicao .= "group by nf.\"cod-rep\"";

    $aRet = $this->retornoMultReg($tabela,$campos,$condicao,$base);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $codRep = $aRet[$i]['cod_rep'];
            $vlNf   = $aRet[$i]['tot'];
            $vlDesc = $aRet[$i]['totdesc'];
            if($vlNf > 0){
                $nf[$codRep]  = $vlNf ;
            }
            if($vlDesc > 0){
                $desc[$codRep] = $vlDesc ;
            }
            $vlNfTot += $vlNf;
            $vlDescTot += $vlDesc;
        }
    }
    $vlTotal = $vlNfTot + $vlDescTot;
    $retorno = array('nf' => $nf, 'desc' => $desc ,
        'total' => $vlTotal,'total_nf'=> $vlNfTot,
        'total_desc' => $vlDescTot) ;
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNf ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNfRepres ------*/

function getTotVendNfRepres($base="med",$filtro='',$logFiltroTipoUsuario=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $this->inserirLogDb('Inicio Func','sim',__FUNCTION__);
    $nf         = array();
    $desc       = array();
    $vlNfTot    = 0;
    $vlDescTot  = 0;
    $total      = 0;
    $condLista  = '';
    $tabela     = " pub.\"nota-fiscal\" nf , PUB.\"natur-oper\" nat ,
                  pub.\"ped-venda\" pedido , pub.\"ped-repre\" ped_rep ";
    $campos   = " sum(nf.\"vl-tot-nota\") as tot, 
                     sum(nf.\"vl-tot-nota\" * (((100/(1 - pedido.\"val-pct-desconto-total\"/100)) -100) /100)) as totdesc,
                     ped_rep.\"nome-ab-rep\" as nome_abrev";
    $condicao = " nf.\"dt-cancela\" is null 
                 and nf.\"nat-operacao\" = nat.\"nat-operacao\" 
                 and nat.\"tp-rec-desp\" = 1 and nat.\"tipo-compra\" <> 3                 
                 and nf.\"nr-pedcli\"   = pedido.\"nr-pedido\"
                 and ped_rep.\"nr-pedido\" = pedido.\"nr-pedido\"
                 and ped_rep.\"nome-ab-rep\" <> 'fulano'                
                  " ;


    if($logFiltroTipoUsuario == true){
        $this->inserirLogDb('filtroPorUsuario','sim',__FUNCTION__);
        $condicaoTpUsuario= $this->aplicarFiltroTipoUsuarioPV('nota-fiscal','nf');
        $listaNfs = $this->getListaNfFiltroPedRepre($condicao.$filtro.$condicaoTpUsuario);
        if($listaNfs == ''){
            $listaNfs = "''";
            $condLista = " and \"nr-nota-fis\" in ($listaNfs)";
            $this->inserirLogDb('lista preenchida?','nao',__FUNCTION__);
        }else {
            $this->inserirLogDb('lista preenchida?',"sim - $listaNfs",__FUNCTION__);
        }
    }else{
        $this->inserirLogDb('filtroPorUsuario','nao',__FUNCTION__);
    }
    $condicao .=  $filtro. $condLista;
    $entreEmpresas = $this->getCondEntreEmpresas('venda','base',$base);
    $condicao .= $entreEmpresas;
    $condicao .= "group by nome_abrev";
    $aRet = $this->retornoMultReg($tabela,$campos,$condicao,$base);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $nomeRep = $aRet[$i]['nome_abrev'];
            $vlNf    = $aRet[$i]['tot'];
            $vlDesc  = $aRet[$i]['totdesc'];
            $this->inserirLogDb('i - nomerep - vlnf - vldesc',"$i - $nomeRep - $vlNf - $vlDesc",__FUNCTION__);
            $codRep = $this->buscarCodRep($nomeRep);
            if($vlNf > 0){
                $nf[$codRep]  = $vlNf ;
            }
            if($vlDesc > 0){
                $desc[$codRep] = $vlDesc ;
            }
            $vlNfTot += $vlNf;
            $vlDescTot += $vlDesc;
            $this->inserirLogDb('total parcial vlnftot - vldesctot',"$vlNfTot - $vlDescTot",__FUNCTION__);
        }
    }
    $total = $vlNfTot + $vlDescTot;
    $retorno = array('nf' => $nf, 'desc' => $desc ,
        'total' => $total,'total_nf'=> $vlNfTot,
        'total_desc' => $vlDescTot) ;
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotVendNfRepres ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNfMes ------*/

function getTotDevNfMes($base='med',$filtroMes='',$logFiltroTipoUsuario=true,$logPorRepres=1)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aDatasMes = $this->retonarDatasMesCorrente();
    $dtIni     = $aDatasMes[0]['dtIni'];
    $dtFim     = $aDatasMes[0]['dtFim'];
    $filtro = " and relacto_venda.\"dt-devol\" >= '$dtIni' and relacto_venda.\"dt-devol\" <= '$dtFim' ";
    if($filtroMes <> ''){
        $filtro .= $filtroMes;
    }
    if($logPorRepres == 1){
        $retorno = $this->getTotDevNfRepres($base,$filtro,$logFiltroTipoUsuario);
    }else{
        $retorno = $this->getTotDevNf($base,$filtro,$logFiltroTipoUsuario);
    }

    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getTotDevNfMes ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarNF ------*/

function buscarNF($empresa,$filtro,$filtroEsp,$filtroUsuario='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $aNF = array();
    $lAchou = false;
    $prepostoNF = "";
    $aDadosPedExt = "";
    $entreEmpresas = "";
    $sql = "
	        select \"nr-nota-fis\" , 
			       \"serie\", 				   
				   \"cod-emitente\",
				   \"no-ab-reppri\",
				   \"cod-rep\",
                   \"nr-pedcli\",
				   \"vl-tot-nota\",
				   \"val-desconto-total\",
				   \"esp-docto\",
				   \"cod-estabel\",
				   cidade,
				   estado,
                   \"dt-emis-nota\"
			       from PUB.\"nota-fiscal\" nf inner join PUB.\"natur-oper\" nat on nf.\"nat-operacao\" = nat.\"nat-operacao\"
				where nf.\"idi-sit-nf-eletro\" not in (4) and nf.\"dt-cancela\" is null and \"tp-rec-desp\" = 1 and \"tipo-compra\" <> 3"  ;

    $sql .= $filtro;
    $lista = $this->getListaNfFiltroPedRepre($filtro.$filtroUsuario);
    
    $sql.=" and nf.\"nr-nota-fis\" in ($lista)";

    $entreEmpresas = $this->getCondEntreEmpresas('venda','empresa',$empresa);
    switch($empresa){
        case "IMA":
            $sql .= $entreEmpresas;
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nf = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nf = false;
          $nf_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case "MED":
            $sql .= $entreEmpresas;
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nf = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nf = false;
          $nf_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($nf  === false){ echo "Erro de acesso ou Sintaxe - função buscarNF";}
     else
     {
         while (!$nf->EOF)
         {
             $aDadosPedExt = $this->retornarDadosPedVendaExt($nf->fields[9],$nf->fields[5],$filtroEsp);
             if($aDadosPedExt != ""){
                 @$prepostoNF       = $aDadosPedExt[0]["preposto"];

             }
             else{
                 @$prepostoNF      = '';
             }
             if($aDadosPedExt != "" || $filtroEsp == '')	{
                 $serie = $nf->fields[1];
                 $descontoTotal = $this->calcularDescontoNF($nf->fields[9],$serie,$nf->fields[0]);
             }
             $aNF[]  = array(
                 "nr-nota-fis"         	=> $nf->fields[0] 	,
                 "serie" 			   	=> $nf->fields[1] 	,
                 "cod-emitente"			=> $nf->fields[2]	,
                 "no-ab-reppri"			=> $nf->fields[3]	,
                 "cod-rep"				=> $nf->fields[4]	,
                 "nr-pedcli"			=> $nf->fields[5]	,
                 "vl-tot-nota"			=> $nf->fields[6]	,
                 "val-desconto-total"	=> $descontoTotal	,
                 "esp-docto"			=> $nf->fields[8]	,
                 "cod-estabel"			=> $nf->fields[9]	,
                 "cidade"				=> $nf->fields[10]	,
                 "estado"				=> $nf->fields[11]	,
                 "dt-implant"			=> $this->nm_conv_data_db($nf->fields[12],
                     "aaaa-mm-dd","mm/dd/aaaa"),
                 "preposto"				=> @$prepostoNF,
                 "desc_devol"			=> ''
             );
             $lAchou = true;
             $nf->MoveNext();
         }
         $nf->Close();
     }
     if($lAchou == false){
         $aNF = '';
     }
     return $aNF;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarNF ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarDevolucoes ------*/

function buscarDevolucoes($empresa,$filtro,$filtroEsp,$filtroNfOri,$filtroUsuario='',$codEstabel='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    

    $aNF = array();
    $lAchou = false;
    $aNFVendaDevol = "";
    $prepostoNF = "";
    if($codEstabel == '5,505'){
        $codEstabel = "'5','505'";
    }

    $sql = "
	        select \"nro-docto\" , 
			       \"serie-docto\", 				   
				   \"cod-emitente\",                  
				   \"tot-valor\",				  
				   \"esp-docto\",
				   \"cod-estabel\",
				   cidade,
				   uf,
                   \"dt-trans\",
				   PUB.\"docum-est\".\"nat-operacao\"
			       from PUB.\"docum-est\" docum, PUB.\"natur-oper\" nat
	       "  ;
    $joinNaturOper = " and  docum.\"nat-operacao\" = nat.\"nat-operacao\"
                       and \"tipo-compra\" = 3 and \"tp-rec-desp\" = 1
                     ";
    $sql .= $filtro.$joinNaturOper;

    switch($empresa)
    {
        case "IMA":
            $entreEmpresas = " AND \"cod-emitente\" <> 10535 and \"cod-estabel\" = '1'";
            $sql .= $entreEmpresas;
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nf = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nf = false;
          $nf_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case "MED":
            $entreEmpresas = " AND \"cod-emitente\" <> 1 and \"cod-estabel\" in ($codEstabel)";
            $sql .= $entreEmpresas;
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nf = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nf = false;
          $nf_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($nf  === false)
     {
         echo "Erro de acesso ou sintaxe - função buscarDevolucoes!";
     }
     else
     {
         while (!$nf->EOF)
         {
             $descDevol = $this->buscarMotivosDevolucao($nf->fields[5],$nf->fields[1],$nf->fields[0],$nf->fields[2]);
             $aNFVendaDevol = $this->buscarNFVendaDevol($nf->fields[5], $nf->fields[2],$nf->fields[0],$nf->fields[1],
                 $nf->fields[9],$filtroEsp,$filtroNfOri,$filtroUsuario);

             if($aNFVendaDevol != "")
             {
                 $noAbReppri 	= $aNFVendaDevol[0]["noAbReppri"];
                 $codRep			= $aNFVendaDevol[0]["codRep"];
                 $nrPedcli		= $aNFVendaDevol[0]["nrPedcli"];
                 $prepostoNF      = $aNFVendaDevol[0]["preposto"];
                 $codPriori      = $aNFVendaDevol[0]["codPriori"];
                 $desconto       = $nf->fields[3] * -1 /(1 - (20 - $codPriori) % 10 / 10 )  *  ((20 - $codPriori) % 10) /10;
                 $aNF[]  = array(
                     "nr-nota-fis"         	=> $nf->fields[0] 	,
                     "serie" 			   	=> $nf->fields[1] 	,
                     "cod-emitente"			=> $nf->fields[2]	,
                     "no-ab-reppri"			=> $noAbReppri,
                     "cod-rep"				=> $codRep,
                     "nr-pedcli"			=> $nrPedcli	,
                     "vl-tot-nota"			=> $nf->fields[3]	* -1,
                     "val-desconto-total"	=> $desconto	,
                     "esp-docto"			=> $nf->fields[4]	,
                     "cod-estabel"			=> $nf->fields[5]	,
                     "cidade"				=> $nf->fields[6]	,
                     "estado"				=> $nf->fields[7]	,
                     "dt-implant"			=> $this->nm_conv_data_db($nf->fields[8],"aaaa-mm-dd","mm/dd/aaaa"),
                     "preposto"				=> $prepostoNF,
                     "desc_devol"			=> $descDevol
                 );
                 $lAchou = true;
             }
             $nf->MoveNext();
         }
         $nf->Close();
     }
     if($lAchou == false){
         $aNF = '';
     }
     return $aNF;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarDevolucoes ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarNFVendaDevol ------*/

function buscarNFVendaDevol($codEstabel, $codEmitente,$nroDocto,$serieDocto,$natOperacao,$filtroEsp,$filtroNfOri,$filtroUsuario='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    


    $aDadosPedExt = '';
    $aRetorno = array();
    $lAchou = false;
    $prepostoDevol = '';
    $sql = " select top 1 nf.\"nr-pedcli\", nf.\"cod-rep\" ,             
          nf.\"no-ab-reppri\", ped.\"cod-priori\", nf.\"vl-tot-nota\"		    
            from PUB.\"devol-cli\" devol 
            inner join PUB.\"nota-fiscal\" nf
            on nf.\"nr-nota-fis\"           = devol.\"nr-nota-fis\"
			and nf.\"serie\"                = devol.\"serie\"
			and nf.\"cod-emitente\"         = devol.\"cod-emitente\"
            inner join  PUB.\"ped-venda\" ped      
            on nf.\"nr-pedcli\"             = ped.\"nr-pedcli\"
            and nf.\"nome-ab-cli\"          = ped.\"nome-abrev\"     
            inner join pub.\"ped-repre\" ped_rep
            on ped.\"nr-pedido\" = ped_rep.\"nr-pedido\"
            where devol.\"cod-estabel\"     = '$codEstabel' 
            and devol.\"cod-emitente\"      = $codEmitente 
            and devol.\"nro-docto\"         = '$nroDocto'	  
            and devol.\"serie-docto\"       = '$serieDocto'
            and devol.\"nat-operacao\"      = '$natOperacao'			
		";
    $sql .= $filtroNfOri.$filtroUsuario;
    switch($codEstabel)
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $devolCli = array();
      $devolcli = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $devolCli[$SCy] [$SCx] = $SCrx->fields[$SCx];
                        $devolcli[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $devolCli = false;
          $devolCli_erro = $this->Ini->nm_db_ima->ErrorMsg();
          $devolcli = false;
          $devolcli_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
        case '505':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $devolCli = array();
      $devolcli = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $devolCli[$SCy] [$SCx] = $SCrx->fields[$SCx];
                        $devolcli[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $devolCli = false;
          $devolCli_erro = $this->Ini->nm_db_med->ErrorMsg();
          $devolcli = false;
          $devolcli_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($devolcli  != false)
	{
        $nrPedcli     = $devolcli[0][0];
		$codRep       = $devolcli[0][1];
		$noAbReppri   = $devolcli[0][2];
		$codPriori    = $devolcli[0][3];
		$vlTotNotaOri = $devolcli[0][4];
		if($nrPedcli == '')
            $nrPedcli = 0;
		$aDadosPedExt = $this->retornarDadosPedVendaExt($codEstabel,$nrPedcli,$filtroEsp);

		if(isset($aDadosPedExt[0]["preposto"]))
            $prepostoDevol = $aDadosPedExt[0]["preposto"];
        else
            $prepostoDevol = '';

		if(!empty($aDadosPedExt) || strstr($filtroEsp,'preposto') == false)
        {
            $aRetorno[]   = array("nrPedcli"  		=> $nrPedcli,
                "codRep"     		=> $codRep,
                "noAbReppri" 		=> $noAbReppri,
                "preposto"   		=> $prepostoDevol,
                "codPriori"  		=> $codPriori,
                "vlTotNotaOri" 	=> $vlTotNotaOri
            );
            $lAchou = true;
        }
	}
	else
	{

    }
	if($lAchou == false){
        $aRetorno = '';
    }
	return $aRetorno;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarNFVendaDevol ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarDevolItemNF ------*/

function buscarDevolItemNF($codEstabel,$serie,$nrNotaFis,$item,$referencia)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRetorno = array();
    $lAchou = false;
    $sql = "select sum(\"qt-devolvida\"), sum(\"vl-devol\")  from PUB.\"devol-cli\"
			where  \"cod-estabel\" = '$codEstabel'
            and     serie = '$serie'
            and     \"nr-nota-fis\" = '$nrNotaFis'
            and     \"it-codigo\"   = '$item'
            and     \"cod-refer\"  = '$referencia'";

    switch($codEstabel)
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $devolitem = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $devolitem[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $devolitem = false;
          $devolitem_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $devolitem = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $devolitem[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $devolitem = false;
          $devolitem_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($devolitem  != false)
   {
       $aRetorno[] = array("qt-devolucao" => $devolitem[0][0],"vl-devol" => $devolitem[0][1]);
       $lAchou = true;
   }
    if($lAchou == false){
        $aRetorno = '';
    }
    return $aRetorno;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarDevolItemNF ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function calcularDescontoNF ------*/

function calcularDescontoNF($codEstabel,$serie,$nrNotaFis)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $totalDesconto = 0;
    $descNota = 0;
    $sql = " select substring(PUB.\"it-nota-fisc\".\"char-2\",1500,10)
            from PUB.\"it-nota-fisc\"
			where \"nr-nota-fis\" = '$nrNotaFis'
			and \"serie\" = '$serie'
			and \"cod-estabel\" = '$codEstabel' ";
    switch(substr($codEstabel,0,1))
    {
        case "1":
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nfdesc = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nfdesc = false;
          $nfdesc_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case "5":
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($nfdesc = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $nfdesc = false;
          $nfdesc_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($nfdesc  === false)
     {
         echo "Erro de acesso ou sintaxe - função calcularDescontoNF!";
     }
     else
     {
         while (!$nfdesc->EOF)
         {
             $descNota = $this->converterDecimal($nfdesc->fields[0]);
             if(is_numeric($descNota) or is_float($descNota)){
                 $totalDesconto += $descNota;
             }

             $nfdesc->MoveNext();
         }
         $nfdesc->Close();
     }
    return $totalDesconto;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function calcularDescontoNF ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function calcularTotaisFatur ------*/

function calcularTotaisFatur($empresa,$filtro)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aTotais = array();
    $lAchou = false;
    $valor = 0;
    $quant = 0;
    $sql = "select sum(\"vl-tot-nota\"), count(\"nr-nota-fis\") from
			PUB.\"nota-fiscal\" nf ";
    $sql .= $filtro;
    switch($empresa)
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($total  === false)
    {
        echo "Erro de acesso  - calcularTotaisFatur. Mensagem = " . $total_erro  ;
    }
    elseif (empty($total ))
    {
        $valor = 0;
        $quant = 0;

        $aTotais[] = array("valor" => $valor, "qte" => $quant);
        $lAchou = true;

    }
    else
    {
        $valor = $total[0][0] ;
		$quant = $total[0][1];
		$aTotais[] = array("valor" => $valor , "qte" => $quant);
		$lAchou = true;
	}
    if($lAchou == false){
        $aTotais = '';
    }
	return $aTotais;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function calcularTotaisFatur ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function calcularTotaisDevol ------*/

function calcularTotaisDevol($empresa,$filtro)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $valor = 0;
    $quant = 0;
    $aTotais = array();
    $lAchou = false;
    $sql = "
	        select sum(\"vl-devol\"), count(PUB.\"docum-est\".\"cod-estabel\")				  
				  
			       from PUB.\"docum-est\" docum, PUB.\"natur-oper\" nat, PUB.\"devol-cli\" devol, PUB.\"nota-fiscal\" nf
	       "  ;
    $joinNaturOper = " and  docum.\"nat-operacao\" = nat.\"nat-operacao\"
                       and \"tipo-compra\" = 3 and \"tp-rec-desp\" = 1
                     ";
    $joinDevolCli  = " 
						and   docum.\"nro-docto\"        = devol.\"nro-docto\"
						and   docum.\"serie-docto\"      = devol.\"serie-docto\"
						and   docum.\"cod-estabel\"      = devol.\"cod-estabel\"
						and   docum.\"nat-operacao\"     = devol.\"nat-operacao\"
						and   docum.\"cod-emitente\"     = devol.\"cod-emitente\"
					 ";
    $joinNFVenda   = "
						and   nf.\"nr-nota-fis\"      = devol.\"nr-nota-fis\"
						and   nf.\"serie\"            = devol.\"serie\"
                        and   nf.\"cod-estabel\"      = devol.\"cod-estabel\"						
						and   nf.\"cod-emitente\"     = devol.\"cod-emitente\"
";



    $sql .= $filtro.$joinNaturOper.$joinDevolCli.$joinNFVenda;

    switch($empresa)
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($total  === false)
    {
        echo "Erro de acesso  - calcularTotaisDevol. Mensagem = " . $total_erro  ;
    }
    elseif (empty($total ))
    {
        $valor = 0;
        $quant = 0;

        $aTotais[] = array("valor" => $valor, "qte" => $quant);
        $lAchou = true;

    }
    else
    {
        $valor = $total[0][0]  ;
        $quant = $total[0][1];
        $aTotais[] = array("valor" => $valor , "qte" => $quant);
        $lAchou = true;
    }
    if($lAchou == false){
        $aTotais = '';
    }
    return $aTotais;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function calcularTotaisDevol ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarDadosDocumEst ------*/

function buscarDadosDocumEst($cod_estab,$serieParam,$documento,$codEmitente,$campos=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $condicao   = 'doc_est."cod-estabel" = '.$cod_estab.' and doc_est."serie-docto" = '.$serieParam.' 
    and doc_est."nro-docto" = '."'$documento'".' and doc_est."cod-emitente" = '.$codEmitente;
    $aDadosDocumEst = $this->getDados('multi','pub."docum-est" doc_est',$campos,$condicao,'med');
    return $aDadosDocumEst;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarDadosDocumEst ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function updateCodRejei ------*/

function updateCodRejei($valor,$cod_estab,$serieParam,$documento,$codEmitente){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = " update pub.\"devol-cli\" set \"codigo-rejei\" = $valor
                     where \"nro-docto\" = '$documento'
			and \"serie-docto\" = '$serieParam' and \"cod-estabel\" = '$cod_estab' and \"cod-emitente\" = $codEmitente";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_medw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_medw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function updateCodRejei ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function buscarMotivosDevolucao ------*/

function buscarMotivosDevolucao($cod_estab,$serieParam,$documento,$codEmitente)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $descDevol = '';
    $sql = "select distinct pub.\"devol-cli\".\"codigo-rejei\", pub.\"cod-rejeicao\".descricao
			from pub.\"devol-cli\", pub.\"cod-rejeicao\" where \"nro-docto\" = '$documento'
			and \"serie-docto\" = '$serieParam' and \"cod-estabel\" = '$cod_estab' and \"cod-emitente\" = $codEmitente
			and  pub.\"cod-rejeicao\".\"codigo-rejei\" = pub.\"devol-cli\".\"codigo-rejei\" " ;
    switch($cod_estab){
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($itensdevol = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $itensdevol = false;
          $itensdevol_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
        case '505':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($itensdevol = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $itensdevol = false;
          $itensdevol_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($itensdevol  === false){
    echo "Erro de Acesso.Função buscarMotivosDevolucao Mensagem=". $itensdevol_erro ;
	}
	else{
    while (!$itensdevol->EOF){
        
        $codRejeicao = $itensdevol->fields[0];
        $descRejeicao = $itensdevol->fields[1];
        $descDevol  .= "$codRejeicao - $descRejeicao|" ;
        $itensdevol->MoveNext();
    }
    $itensdevol->Close();
}
   return substr($descDevol,0,200);
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function buscarMotivosDevolucao ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getUltsNotaTriang ------*/

function getUltsNotaTriang($clienteParam)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $logTriang = 0;
    $aReg = $this->getDados('unico','pub."nota-fiscal" nf, pub."natur-oper" nat',
        'top 3 "dt-emis-nota"',
        "nf.\"nat-operacao\" = nat.\"nat-operacao\"
                        and   nat.\"log-oper-triang\" = 1
                        and \"cod-emitente\" = $clienteParam order by \"dt-emis-nota\" desc ",
        "med");
    if(is_array($aReg)){
        $logTriang = 1;
    }
    return $logTriang;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getUltsNotaTriang ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getDadosNotaFisc ------*/

function getDadosNotaFisc($codEstabel,$nrPedido,$campos=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $tipo     = "multi";
    $tabela   = " pub.\"nota-fiscal\" ";
    $condicao = "  \"cod-estabel\" = $codEstabel and \"nr-pedcli\" = $nrPedido";
    $conexao  = "med";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getDadosNotaFisc ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getNrNfRemessa ------*/

function getNrNfRemessa($nf,$campo){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $numNf = $nf + 1;
    $condicao = "'nr-nota-fis' = $numNf and nome-abrev-tri <> ''";
    $aDados = $this->getDados('multi','pub."nota-fiscal"',$campo,$condicao,'med');
    var_dump($aDados);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getNrNfRemessa ------*/


/*----- Scriptcase Locale: PHP Method: notafiscal.php => function getUltNfEmit ------*/

function getUltNfEmit($codEmit){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $somaTotNfs = 0;
    $condicao = "\"cod-emitente\" = $codEmit and \"esp-docto\" = 22 order by \"dt-emis-nota\" desc";
    $inner    = "inner join pub.\"natur-oper\" nat on nat.\"nat-operacao\" = nf.\"nat-operacao\" and nat.\"tp-rec-desp\" = 1 and nat.\"tipo-compra\" <> 3";
    $aDados = $this->getDados('multi','"nota-fiscal" nf','top 3 "nr-nota-fis" as num_nf,
     "cod-estabel" as estab ,"vl-tot-nota" as vl_nf, "dt-emis-nota" as dt_emis_nf ',$condicao,'med',$inner);
    if($aDados){
        foreach($aDados as $dadosNf){
            $totNf = $dadosNf['vl_nf'];
            $somaTotNfs = $somaTotNfs + $totNf;
        }
    }
    $somaTotNfs = $this->formatarPreco('real',$somaTotNfs);
    return $somaTotNfs;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: notafiscal.php => function getUltNfEmit ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function convertArrayEmUpdate ------*/

function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
                if($this->getNumEmLista($cpsSemAspas, $i + 1)){
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function convertArrayEmUpdate ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function execAcaoPDO ------*/

function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function execAcaoPDO ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getODBCDireto ------*/

function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
        case 'wdfe':
            $retorno = $base =='producao'? 'wdfe':'wdfe_tst';
            break;
        case 'tss':
            $retorno = $base =='producao'? 'tss':'tss_tst';
            break;
        case 'correio':
            $retorno = $base =='producao'? 'correio':'correio_tst';
            break;

        default:
            $retorno = $conexaoSC;
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getODBCDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function retornoSimplesTb01 ------*/

function retornoSimplesTb01($tabParam, $campos, $condicao, $conexao = '', $inner = '', 
                            $logUTF8=0, $logSql=0,$formato='queryParams')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRetorno = array();
    $lAchou = false;
    $txtArray = '';
    $txtComum = '';
    $tipoConexao = 'progress';
    if ($campos == '' ) {
        $aCampos = $this->getCpsTbSessao($conexao, $this->retirarPubTab($tabParam) );
        $campos = $aCampos['campos'];
    }
    $aCampos = explode(',', $campos);
    
    $campos = str_replace("|", ",", $campos);
    $tpConexao = $this->getTipoConexao($conexao);
    if($tpConexao == 'progress'){
        $tabParam = $this->convNomeTabProgress($tabParam);
    }

    $sql = "select $campos from $tabParam $inner
		  where $condicao";

    if($logSql == 1){
        echo "<h1>$sql</h1>";
    }

    switch ($conexao) {
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
        case 'ima':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_ima->ErrorMsg();
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
        case 'med':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_med->ErrorMsg();
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
        case 'integracoes':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_integracoes->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_integracoes->ErrorMsg();
      } 

            break;
        case 'geral':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_geral->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_geral->ErrorMsg();
      } 

            break;
        case 'dinamico':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_dinamico->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_dinamico->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_ticontrole->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_ticontrole->ErrorMsg();
      } 

            break;
        case 'wdfe':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_wdfe->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_wdfe->ErrorMsg();
      } 

            break;
        case 'tss':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_tss->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_tss->ErrorMsg();
      } 

            break;
        case 'correio':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $meus_dados = array();
      if ($SCrx = $this->Ini->nm_db_correio->Execute($nm_select)) 
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
          $meus_dados_erro = $this->Ini->nm_db_correio->ErrorMsg();
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
    if($this->getLogSql() == 1){
        $this->inserirLogDb('comando SQL reg unico',$sql,__FUNCTION__);
    }

    if($conexao == 'api'){
        $aParam = $this->convertDadosSqlParaAPI($tabParam,$campos,$condicao,$inner,$formato);

        
        $aRet = $this->getApiTotvs('fnd/v1/consdin','GET',$aParam);
        $aRetorno = $this->getValsArrayMultiDin($aRet, $this->convertCpParaAPI($campos) );
    }else{ 
        if ($meus_dados    === false){
            if($this->getLogSql() == 1){
                $erro = $meus_dados_erro ;
                $this->inserirLogDb("erro comando SQL - conexao:$conexao",$erro,__FUNCTION__);
            }
            echo "Erro de acesso retornoSimplesTB01. Mensagem = " . $meus_dados_erro ;
        }elseif (empty($meus_dados )){
              if($this->getLogSql() == 1){
                  $this->inserirLogDb('retorno comando SQL unico','VAZIO',__FUNCTION__);
              }
        }
        else{
          for ($i = 0; $i < count($aCampos); $i++) {
              $aApelido = explode(' as ', $aCampos[$i]);
              if (count($aApelido) > 1) {
                  $nomeCampo = ltrim(rtrim($aApelido[1]));
              } else {
                  $nomeCampo = ltrim(rtrim($aApelido[0]));
              }

              
              if($logUTF8 == 1){
                  $cp = $this->convISO88591ParaUtf8($meus_dados[0][$i]);
              }
              else{
                  $cp = $meus_dados[0][$i];
              }
              $aRetorno[0][$nomeCampo] = $cp;
              $lAchou = true;

          }

      
        }
       if ($lAchou == false) {
           $aRetorno = '';
       }
    }
   return $aRetorno;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function retornoSimplesTb01 ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function convertDadosSqlParaAPI ------*/

function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aJson = array();
    $tabelas = $tabParam;
    $tabelas = str_replace('\"','',$tabelas);
    $tabelas = str_replace('pub.','',$tabelas);
    $tabelas = str_replace('"','',$tabelas);
    $campos = str_replace('"','',$campos);
    $condicao = str_replace('"','',$condicao);
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function convertDadosSqlParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getTipoConexao ------*/

function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch ($conexao) {
        case 'espec':
        case 'comum':
        case 'ima':
        case 'med':
        case 'multi':
        case 'ems5':
            $tipoConexao = 'progress';
            break;
        case 'log_db':
        case 'integracoes':
        case 'geral':
        case 'dinamico':
        case 'ticontrole':
        case 'wdfe':
        case 'cfsc':
        case 'tss':
        case 'correio':
        case 'simulacao':
        case 'pendencias':

            $tipoConexao = 'sql';
            break;

        default:
            $tipoConexao = 'progress';
    }
    return $tipoConexao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getTipoConexao ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function retornoMultReg ------*/

function retornoMultReg($tabela, $campos, $condicao, $conexao = '', $inner = '',$logUTF8=0,$logSql=0,$formato='queryParams')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $iCont = 0;
    $aRetorno = array();
    $lAchou = false;
    $txtArray = '';
    $txtComum = '';
    $tipoConexao = 'progress';
    if ($campos == '' ) {
        $aCampos = $this->getCpsTbSessao($conexao, $this->retirarPubTab($tabela) );
        $campos = $aCampos['campos'];
    }
    $aCampos = explode(',', $campos);
    
    $campos = str_replace("|", ",", $campos);
    $tpConexao = $this->getTipoConexao($conexao);
    if($tpConexao == 'progress'){
        $tabela = $this->convNomeTabProgress($tabela);
    }
    $sql = "select $campos from $tabela $inner
		  where $condicao ";
    if($logSql == 1){
        echo "<h1>$sql</h1>";
    }
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
        case 'integracoes':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_integracoes->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_integracoes->ErrorMsg();
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
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ticontrole->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ticontrole->ErrorMsg();
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
        case 'wdfe':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_wdfe->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_wdfe->ErrorMsg();
      } 

            break;
        case 'pendencias':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_pendencias->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_pendencias->ErrorMsg();
      } 

            break;
        case 'correio':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_correio->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_correio->ErrorMsg();
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

    if($conexao == 'api') {
        $aParam = $this->convertDadosSqlParaAPI($tabela, $campos, $condicao, $inner, $formato);
        
        $aRet = $this->getApiTotvs('fnd/v1/consdin', 'GET', $aParam);
        $aRetorno = $this->getValsArrayMultiDin($aRet, $this->convertCpParaAPI($campos));
    }else{
        if($this->getLogSql() == 1){
            $this->inserirLogDb('comando SQL multi',$sql,__FUNCTION__);
        }
        if ($dados   === false){
            if($this->getLogSql() == 1){
                $this->inserirLogDb("erro comando SQL - conexao:$conexao",$dados_erro ,__FUNCTION__);
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
                        $cp = $this->convISO88591ParaUtf8($dados->fields[$i]);
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
    }
    return $aRetorno;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function retornoMultReg ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function retornarChaveEstr ------*/

function retornarChaveEstr($apelidoConj, $numRetorno)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tabelas = '';
    $camposJoin = '';
    $camposRet = '';
    $aRetorno = '';
    $retorno = '';
    $aDadosTB = $this->retornoSimplesTb01('tabs_chave_estr t , conj_cp_chave_estr c',
        't.tabela_origem,t.tabela_estrangeira,c.cod_conj_cp_chave_estr',
        'c.apelido = $apelidoConj and c.cod_tab_chave_estr = t.cod_tab_chave_estr');

    if (is_array($aDadosTB)) {
        $tabelas = $aDadosTB[0]['t.tabela_origem'] . "," . $aDadosTB[0]['t.tabela_estranjeira'];


        $aCamposJoin = $this->retornoSimplesTb01('cps_cj_chave_estr c',
            'c.campo_origem,c.campo_estranjeiro',
            'c.cod_conj_cp_chave_estr =' . $aDadosTB[0]['c.cod_conj_cp_chave_estr']);
        if (is_array($aCamposJoin)) {
            for ($i = 0; $i < count($aCamposJoin); $i++) {
                $comum = $aCamposJoin[$i]['c.campo_origem'] . "=" . $aCamposJoin[$i]['c.campo_estrangeiro'];
                if ($camposJoin == '') $camposJoin = $comum;
                else $camposJoin .= "," . $comum;
            }
        }
        $aCamposRet = $this->retornoSimplesTb01('rets_cj_cp_chave_estr r, cps_ret_cj_cp_chave_estr c',
                'c.campo',
                'r.cod_conj_cp_chave_estr =' . $aDadosTB[0]['c.cod_conj_cp_chave_estr']) .
            " and r.num_retorno = $numRetorno ";
        if (is_array($aCamposRet)) {
            for ($i = 0; $i < count($aCamposRet); $i++) {
                $comum = $aCamposRet[$i]['c.campo'];
                if ($camposRet == '') $camposRet = $comum;
                else $camposRet .= "," . $comum;
            }
        }
        $aRetorno = $this->retornoSimplesTb01($tabelas, $camposRet, $camposJoin);
        $aLstCamposJoin = explode(",", $camposJoin);
        if (is_array($aRetorno)) {
            for ($i = 0; $i < count($aLstCamposJoin); $i++) {
                $comum = $aRetorno[0][$aLstCamposJoin[$i]];
                if ($retorno == '') $retorno = $comum;
                else $retorno .= "-" . $comum;
            }
        }
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function retornarChaveEstr ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTb ------*/

function getCpsTb($catalogo, $tb, $logNomeTabela = false, $logMulti = true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $listaCampos = '';
    $listaTipoCp = '';
    $listaExtentCp = '';

    $tabela = "sysprogress.syscolumns_full  ";
    if ($logMulti == true) {
        $tabela = "$catalogo.$tabela";
        $conexao = "multi";
    } else {
        $conexao = $catalogo;
    }
    $campos = " coltype as tipo_dado, 
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
    $aResult = $this->retornoMultReg($tabela, $campos, $condicao, $conexao);
    if (is_array($aResult)) {
        $tam = count($aResult);
        for ($i = 0; $i < $tam; $i++) {
            $campo = $aResult[$i]['campo'];
            $campoSemAspas = $campo;
            if (stristr($campo, '-') <> false and stristr($campo, chr(34)) == false) {
                $campo = "\"$campo\"";
            }
            $tipo = $aResult[$i]['tipo_dado'];
            $extensao = $aResult[$i]['extensao'];
            $esquema = $aResult[$i]['esquema'];
            $tab = '';
            $tabApelido = '';
            if ($logNomeTabela == true) {
                $tabApelido = str_replace('-', '_', $tb);
                if ($logMulti == true) {
                    $tab = "$catalogo.$esquema.$tb.";

                } else {
                    $tab = "$esquema.$tb.";
                }
                $campo = "$tab.$campo";
            }
            if ($extensao > 0) {
                for ($x = 1; $x <= $extensao; $x++) {
                    if ($tabApelido <> '') {
                        $campoIncr = "pro_element($campo,$x,$x) as {$tabApelido}_{$campoSemAspas}_{$x}";
                    } else {
                        $campoIncr = "pro_element($tab$campo,$x,$x) as {$campoSemAspas}_{$x}";
                    }
                    $listaCampos = $this->util_incr_valor($listaCampos, $campoIncr,',',true,false);
                    $listaTipoCp = $this->util_incr_valor($listaTipoCp, $tipo,',',true,false);
                    $listaExtentCp = $this->util_incr_valor($listaExtentCp, $extensao,',',true,false);
                }


            } else {
                $listaCampos = $this->util_incr_valor($listaCampos, $campo,',',true,false);
                $listaTipoCp = $this->util_incr_valor($listaTipoCp, $tipo,',',true,false);
                $listaExtentCp = $this->util_incr_valor($listaExtentCp, $extensao,',',true,false);
            }

        }
        $aRetorno = array('campos' => $listaCampos, 'tipos' => $listaTipoCp,
            'extensoes' => $listaExtentCp);
    }
    return $aRetorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTb ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTbSQLSERVER ------*/

function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTbSQLSERVER ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTbSessao ------*/

function getCpsTbSessao($catalogo, $tabela)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $var = "cps_" . $catalogo . "_" . $tabela;
    if (!isset($_SESSION[$var]) or $_SESSION[$var] == '') {
        $this->setCpsTbSessao($catalogo, $tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function setCpsTbSessao ------*/

function setCpsTbSessao($catalogo, $tabela)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $var = "cps_" . $catalogo . "_" . $tabela;
    $tipoConexao = $this->getTipoConexao($catalogo);
    switch ($tipoConexao){
        case 'progress':
            $lista = $this->getCpsTb($catalogo, $tabela);
            break;
        case 'sql':
            $lista = $this->getCpsTbSQLSERVER($catalogo, $tabela);
            break;
    }
    $this->setVarSessao('lista_cps_definidas',$var,1);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function setCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getDados ------*/

function getDados($tipo, $tab01, $campos, $condicao, $conexao = '', $inner = '', $logUTF8=0, $logSql=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch ($tipo) {
        case 'unico':
            $aRet = $this->retornoSimplesTb01($tab01, $campos, $condicao, $conexao, $inner,$logUTF8,$logSql);
            break;
        case 'multi':
            $aRet = $this->retornoMultReg($tab01, $campos, $condicao, $conexao, $inner,$logUTF8,$logSql);
            break;
    }
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getDados ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getUltIdTabela ------*/

function getUltIdTabela($tabela, $tipoBanco = 'sql', $banco = "log_db")
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch ($tipoBanco) {
        case 'sql':
            $sql = "SELECT IDENT_CURRENT ('$tabela') AS Current_Identity";
            break;
    }
    $this->setVarSessao('sql_corrente',$sql);
    switch ($banco) {
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
        case 'integracoes':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $id = array();
      if ($SCrx = $this->Ini->nm_db_integracoes->Execute($nm_select)) 
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
          $id_erro = $this->Ini->nm_db_integracoes->ErrorMsg();
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

    if ($id   === false)
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getUltIdTabela ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getRegsSqlLivre ------*/

function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
        case 'fnd':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_fnd->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_fnd->ErrorMsg();
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
        case 'wdfe':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_wdfe->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_wdfe->ErrorMsg();
      } 

            break;
        case 'ticontrole':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($dados = $this->Ini->nm_db_ticontrole->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $dados = false;
          $dados_erro = $this->Ini->nm_db_ticontrole->ErrorMsg();
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
    if($this->getLogSql() == 1){
        $this->inserirLogDb('comando SQL - sql livre',$sql,__FUNCTION__);
    }
    if ($dados   === false){
    if($this->getLogSql() == 1){
        $this->inserirLogDb('erro comando SQL - conexao:'.$conexao,$dados_erro ,__FUNCTION__);
        }
    echo "Erro de acesso. Mensagem = " . $dados_erro ;
    }else{
    while (!$dados->EOF)
       {
        for ($i = 0; $i < count($aCampos); $i++) {
            $aApelido = explode(' as ', $aCampos[$i]);
            if (count($aApelido) > 1) {
                $nomeCampo = ltrim(rtrim($aApelido[1]));
            } else {
                $nomeCampo = ltrim(rtrim($aApelido[0]));
            }
            if($logUTF8 == 1){
                $cp = $this->convISO88591ParaUtf8($dados->fields[$i]);
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getRegsSqlLivre ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function convertArrayEmInsert ------*/

function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aCampos = array_keys($aDados);
    $campos    = '';
    $vlCampos = '' ;
    if(is_array($aCampos)){
        $tam = count($aCampos);
        for($i=0;$i<$tam;$i++){
            $campos  = $this->util_incr_valor($campos,$aCampos[$i]);
            if($this->getNumEmLista($cpsSemAspas,$i + 1)  == true){
                $incr = $aDados[$aCampos[$i]];
            }else{
                $incr = "'".$aDados[$aCampos[$i]]."'";
            }
            $vlCampos = $this->util_incr_valor($vlCampos,$incr)  ;


        }
    }
    $cmd = "insert into {$tabela}({$campos})values({$vlCampos})";
    return $cmd;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function convertArrayEmInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function updateDireto ------*/

function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function updateDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function setCondWhere ------*/

function setCondWhere($cond)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['inicio']);
}

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function setCondWhere ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function conectarBase ------*/

function conectarBase($conexaoSC,$usuario='sysprogress',$senha='sysprogress',$logOdbc=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function conectarBase ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function conectarBaseMysql ------*/

function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function conectarBaseMysql ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getUsuarioLock ------*/

function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getUsuarioLock ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getReg ------*/

function getReg($conexao, $tabelaParam, $camposChave, $valoresCamposChave, $campos = '', $filtroCompl = '', $logUTF8=0, $logSql=0,$ordenacao='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $condicao = '';
    $tipoConexao = $this->getTipoConexao($conexao);
    if (strstr($camposChave, ",") <> false) {
        $camposChave = explode(',', $camposChave);
    }
    if (strstr($valoresCamposChave, ",") <> false) {
        $valoresCamposChave = explode(',', $valoresCamposChave);
    }

    if (is_array($camposChave)) {
        $tam = count($camposChave);
        for ($i = 0; $i < $tam; $i++) {
            $incr = $camposChave[$i] . "=" . $valoresCamposChave[$i];

            $condicao = $this->util_incr_valor($condicao, $incr, " AND ");
        }
        if ($condicao == '') {
            $condicao = '1 = 1 ';
        }
    } else {
        if ($camposChave <> '' and $valoresCamposChave <> '') {
            $condicao = " $camposChave = $valoresCamposChave ";
        } else {
            $condicao = "1 = 1 ";
        }
    }
    if ($campos == '' ) {
        $aCampos = $this->getCpsTbSessao($conexao, $tabelaParam);
        $campos = $aCampos['campos'];
    }
    if (!empty($filtroCompl) ) {
        $condicao = $this->util_incr_valor($condicao, $filtroCompl, ' AND ', true);
    }
    $tpConexao = $this->getTipoConexao($conexao);
    if($tpConexao == 'progress'){
        $tabelaParam = $this->convNomeTabProgress($tabelaParam);
    }
    if ($tipoConexao == 'progress') {
        $tabelaParam = "pub.$tabelaParam";
    }

    $tipo = "unico"; 
    if(!empty($ordenacao)){
        $condicao = $this->util_incr_valor($condicao,$ordenacao,' ');
    }
    $aRet = $this->getDados($tipo, $tabelaParam, $campos, $condicao, $conexao,'',$logUTF8,$logSql);

    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getReg ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function acertarAspasSimplesInsert ------*/

function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function acertarAspasSimplesInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function convertCpParaAPI ------*/

function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function convertCpParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: sql_projeto.php => function getLastIdSimulacao ------*/

function getLastIdSimulacao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aResult = $this->getRegsSqlLivre("select last_insert_id() as id","id",'simulacao');
    return $this->getVlIndiceArray($aResult,'id',0);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql_projeto.php => function getLastIdSimulacao ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function inserirListaRestrClientesUsuar ------*/

function inserirListaRestrClientesUsuar($tipo,$lista,$restrId){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($tipo == 'repres'){
        $del = " delete from pub.repres_restr_cliente_usuario where restr_cliente_usuario_id = $restrId";
        
     $nm_select = $del; 
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
    if($tipo == 'uf'){
        $del = " delete from pub.regiao_restr_cliente_usuario where restr_cliente_usuario_id = $restrId";
        
     $nm_select = $del; 
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

    $aLista = explode(';',$lista);
    foreach($aLista as $dados){
        $reg = '';
        switch ($tipo){
            case 'repres':
                $aRet = $this->getReg('espec','repres_restr_cliente_usuario','cod_repres',
                    $dados,"cod_repres","restr_cliente_usuario_id = $restrId" );
                if($aRet){
                    $reg = $aRet[0]['cod_repres'];
                }
                if($reg <> $dados){
                    $cmd = " insert into PUB.repres_restr_cliente_usuario (repres_restr_cliente_usuario_id,restr_cliente_usuario_id,cod_repres)
                    values(PUB.seq_repres_restr_cliente_usuario.NEXTVAL,$restrId,$dados)";
                    
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
                break;

            case 'uf':
                $aRet = $this->getReg('espec','regiao_restr_cliente_usuario','regiao',
                    "'$dados'","regiao","restr_cliente_usuario_id = $restrId" );
                if($aRet){
                    $reg = $aRet[0]['regiao'];
                }
                if($reg <> $dados){
                    $cmd = " insert into PUB.regiao_restr_cliente_usuario (regiao_restr_cliente_usuario_id,restr_cliente_usuario_id,regiao)
                    values(PUB.seq_regiao_restr_cliente_usuario.NEXTVAL,$restrId,'$dados')";
                    
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
                break;
        }

    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function inserirListaRestrClientesUsuar ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function retornaListaNomeRepsRestrUsuar ------*/

function retornaListaNomeRepsRestrUsuar($lista){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaNomReps = '';
    $aLista = explode(',',$lista);
    foreach($aLista as $codReps){
        $codRep = $codReps;
        $codRep = str_replace("'",'',$codRep);
        $nomeRep = $this->getNomeAbrevRepres($codRep);
        $listaNomReps = $this->util_incr_valor($listaNomReps,"'$nomeRep'",',');
    }
    return $listaNomReps;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function retornaListaNomeRepsRestrUsuar ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function getListaRestrClientesUsuar ------*/

function getListaRestrClientesUsuar($tipo,$restrId,$delimitador=';'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $indice = '';
    $lista = '';
    switch ($tipo){
        case 'repres':
            $aDados = $this->getDados('multi','PUB.repres_restr_cliente_usuario','cod_repres',
                "restr_cliente_usuario_id = $restrId",'espec');
            $indice = 'cod_repres';
            break;

        case 'uf':
            $aDados = $this->getDados('multi','PUB.regiao_restr_cliente_usuario','regiao',
                "restr_cliente_usuario_id = $restrId",'espec');
            $indice = 'regiao';
            break;
    }
    if($aDados){
        foreach($aDados as $dados){
            $reg = $dados["$indice"];
            if($delimitador <> ';'){
               $reg = "'$reg'";
            }
            $lista = $this->util_incr_valor($lista,$reg,$delimitador);


        }
    }


    return $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function getListaRestrClientesUsuar ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function getTpRestrUsuar ------*/

function getTpRestrUsuar($login,$tipo){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $restricao = '';
    if($tipo == 'ativo'){
        $campo = 'ind_segur_cli_ativo';
    }else if($tipo == 'inativo'){
        $campo = 'ind_segur_cli_inativo';
    }
    $aRet = $this->getReg('espec','restrs_clientes_usuario','login',
        "'$login'","$campo");
    if($aRet){
        $restricao = $aRet[0]["$campo"];
    }

    return $restricao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function getTpRestrUsuar ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function getDadosRestrClienteUsuar ------*/

function getDadosRestrClienteUsuar($login,$campo=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aDados = $this->getDados('multi','PUB.restrs_clientes_usuario',$campo,
        "login = '$login'",'espec');
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function getDadosRestrClienteUsuar ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function getGerRepres ------*/

function getGerRepres($codRep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $listaNomRestri = '';
    $aDados = $this->getDados('multi','PUB.repres_restr_cliente_usuario','restr_cliente_usuario_id',
        "cod_repres = $codRep",'espec');

    if($aDados){
        foreach($aDados as $dadosId){
            $id = $dadosId["restr_cliente_usuario_id"];
            $tpUsuarRestri = $this->getRegRestriUsuar('restrs_clientes_usuario_id','tp_usuar',$id);
            if($tpUsuarRestri == 2){
                $nomId = $this->getRegRestriUsuar('restrs_clientes_usuario_id','login',$id);
                $listaNomRestri = $this->util_incr_valor($listaNomRestri,$nomId,',');
            }
        }
    }

    return $listaNomRestri;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function getGerRepres ------*/


/*----- Scriptcase Locale: PHP Method: restr_usuar.php => function getRegRestriUsuar ------*/

function getRegRestriUsuar($campoChave,$campo,$chave){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $dado = '';
    $aReg = $this->getReg('espec','restrs_clientes_usuario',$campoChave,$chave,$campo);
    if($aReg){
        $dado = $aReg[0]["$campo"];
    }
    return $dado;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: restr_usuar.php => function getRegRestriUsuar ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAberto ------*/

function getPedWebEmAberto($login,$container,$divideComis,$percVend,$percRepres,$agrup,$tbPreco=1,$moeda=1,$codEstabel='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ped = 0;
    $moeda = $this->getCodMoeda($moeda);
    $tabela   = " pub.peds_web ped ";
    $campos   = " ped_web_id ";
    $sitsEmAberto = $this->getSitsPedWebEmAberto();
    $condicao = "  ped.login = '$login'    
    and ped.nr_container        = $container 
    and ped.log_divide_comissao = $divideComis
    and ped.perc_comis_vend     = '$percVend' 
    and ped.perc_comis_repres   = '$percRepres'
    and ped.num_agrup           = $agrup 
    and ped.tb_preco_id         = $tbPreco
    and ped.cod_moeda           = '$moeda'
    and ped.cod_estabel         = '$codEstabel'
    and ped.ind_sit_ped_web     in ($sitsEmAberto)";
    $aRet = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aRet)){
        $ped = $aRet[0]['ped_web_id'];
    }
    return $ped;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAberto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoManual ------*/

function getPedWebEmAbertoManual($login,$container,$tbPreco,$moeda)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $moeda = $this->tratarNumero($moeda);
    $ped = 0;
    $tabela   = " pub.peds_web ped ";
    $campos   = " ped_web_id ";
    $sitsAberto = $this->getSitsPedWebEmAberto();
    $condicao = "  ped.login = '$login' 
    and ped.ind_sit_ped_web     in($sitsAberto) 
    and ped.nr_container        = $container     
    and ped.tb_preco_id         = $tbPreco
    and ped.cod_moeda           = $moeda";
    $aRet = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aRet)){
        $ped = $aRet[0]['ped_web_id'];
    }
    return $ped;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoManual ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoTodos ------*/

function getPedWebEmAbertoTodos($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tabela   = " pub.peds_web ped ";
    $campos   = " ped_web_id,tb_preco_id ";
    $sitsAberto = $this->getSitsPedWebEmAberto();
    $condicao = "  ped.login = '$login' and ped.ind_sit_ped_web in($sitsAberto)";
    $aRet = $this->getDados('multi',$tabela,$campos,$condicao);
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoTodos ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoComCondPagto ------*/

function getPedWebEmAbertoComCondPagto($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tabela   = " pub.peds_web ped ";
    $campos   = " ped_web_id ";
    $sitsAberto = $this->getSitsPedWebEmAberto();
    $condicao = "  ped.login = '$login' 
    and ped.ind_sit_ped_web in ($sitsAberto) 
    and (dias_cond_pagto_esp <> '' or log_a_vista = 1)";
    $aRet = $this->getDados('multi',$tabela,$campos,$condicao);
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getPedWebEmAbertoComCondPagto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function atualizarCondPagtoPedsAberto ------*/

function atualizarCondPagtoPedsAberto($logVista,$diasCondPagto,$qtParcelasCred,$codFormPagto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aPeds = $this->getPedWebEmAbertoTodos($this->getLoginCorrente());
    if(is_array($aPeds)){
        $tam = count($aPeds);
        for($i=0;$i< $tam;$i++){
            $pedWebId = $aPeds[$i]['ped_web_id'];
            $aReg = $this->getRegPedWeb($pedWebId,'ped_web_id,log_a_vista,dias_cond_pagto_esp');
            if(is_array($aReg) ){
                $pedidoCorr       = $aReg[0]['ped_web_id'];
                $logVistaPed      = $aReg[0]['log_a_vista'];
                $diasCondPagtoPed = $aReg[0]['dias_cond_pagto_esp'];
                if(($logVista <> $logVistaPed) or ($diasCondPagto <> $diasCondPagtoPed)){
                    $cmd = " update pub.peds_web set log_a_vista = $logVista, 
                              dias_cond_pagto_esp = '$diasCondPagto',
                              parcelas_credito = '$qtParcelasCred',
                              cod_forma_pagto = '$codFormPagto'
                              where ped_web_id = $pedidoCorr";
                    
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
            }
        }
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function atualizarCondPagtoPedsAberto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function calcTipoFretePedsAberto ------*/

function calcTipoFretePedsAberto()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aRegs = $this->getPedWebEmAbertoTodos($this->getLoginCorrente());
    if(is_array($aRegs)){
        $tam = count($aRegs);
        for($i=0;$i<$tam;$i++){
            $pedWebId = $aRegs[$i]['ped_web_id'];
            $tbPreco  = $aRegs[$i]['tb_preco_id'];
            atualizarTipoFrete($pedWebId,'',$tbPreco);
        }
    }


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function calcTipoFretePedsAberto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function criarPedWeb ------*/

function criarPedWeb($login,$container,$moeda,$codEstabel,$logManual,
                     $divideComis,$percVend,$percRepres,$agrupPed,$tbPreco)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['gl_parcelas_credito'])) {$_SESSION['gl_parcelas_credito'] = "";}
if (!isset($this->sc_temp_gl_parcelas_credito)) {$this->sc_temp_gl_parcelas_credito = (isset($_SESSION['gl_parcelas_credito'])) ? $_SESSION['gl_parcelas_credito'] : "";}
if (!isset($_SESSION['gl_form_pagto'])) {$_SESSION['gl_form_pagto'] = "";}
if (!isset($this->sc_temp_gl_form_pagto)) {$this->sc_temp_gl_form_pagto = (isset($_SESSION['gl_form_pagto'])) ? $_SESSION['gl_form_pagto'] : "";}
if (!isset($_SESSION['gl_dias_cond_pagto'])) {$_SESSION['gl_dias_cond_pagto'] = "";}
if (!isset($this->sc_temp_gl_dias_cond_pagto)) {$this->sc_temp_gl_dias_cond_pagto = (isset($_SESSION['gl_dias_cond_pagto'])) ? $_SESSION['gl_dias_cond_pagto'] : "";}
if (!isset($_SESSION['gl_log_a_vista'])) {$_SESSION['gl_log_a_vista'] = "";}
if (!isset($this->sc_temp_gl_log_a_vista)) {$this->sc_temp_gl_log_a_vista = (isset($_SESSION['gl_log_a_vista'])) ? $_SESSION['gl_log_a_vista'] : "";}
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
if (!isset($_SESSION['perfil_pai'])) {$_SESSION['perfil_pai'] = "";}
if (!isset($this->sc_temp_perfil_pai)) {$this->sc_temp_perfil_pai = (isset($_SESSION['perfil_pai'])) ? $_SESSION['perfil_pai'] : "";}
  
    if(isset($this->sc_temp_perfil_pai) and  $this->sc_temp_perfil_pai <> ''){
        $loginDigitacao = $this->sc_temp_perfil_pai;
    }else{
        $loginDigitacao = $login;
    }

    
    $moeda = $this->getCodMoeda($moeda);
    if($container ==0){
        $codTipoPedido = 'PE';
    }else{
        $codTipoPedido = 'PI';
    }
    $repres = $this->sc_temp_codRepIni;

    $dtHrVencto = new DateTime();

    if($codTipoPedido == "PE"){
        $qtMinutos  = $this->getMinutosVenctoPe();

    }else{
        $qtMinutos  = $this->getMinutosVenctoPi();
    }

    $dtHrVencto->add(new DateInterval('PT' . $qtMinutos . 'M'));

    $dtHrVencto = $dtHrVencto->format('Y-m-d H:i');

    if(isset($this->sc_temp_gl_log_a_vista) and $this->sc_temp_gl_log_a_vista <> ''){
      $logVista = $this->sc_temp_gl_log_a_vista;
    }else{
      $logVista = 0;
    }

    if(isset($this->sc_temp_gl_dias_cond_pagto) and $this->sc_temp_gl_dias_cond_pagto <> ''){
        $diasCondPagto = $this->sc_temp_gl_dias_cond_pagto;
    }else{
        $diasCondPagto = '';
    }

    if(isset($this->sc_temp_gl_form_pagto) and $this->sc_temp_gl_form_pagto <> ''){
        $formPagto = $this->sc_temp_gl_form_pagto;
    }else{
        $formPagto = 0;
    }

    if(isset($this->sc_temp_gl_parcelas_credito) and $this->sc_temp_gl_parcelas_credito <> ''){
        $parcelasCredito = $this->sc_temp_gl_parcelas_credito;
    }else{
        $parcelasCredito = 0;
    }

    if($logManual == true){
        $logManual = 1;
    }else{
        $logManual = 0;
    }

    if($this->getTipoUsuarioCorrente() == 5){
        $loginPreposto = $this->getLoginCorrente();
    }else{
       $loginPreposto = '';
    }
    $codEmpresa = substr($codEstabel,0,1)."00"  ;
    $percComis = $this->getPercComisRepres($codEmpresa,$repres);

    $aInsert = array('ped_web_id'           => 'pub.seq_ped_web.NEXTVAL',
                    'login'                 => $login,
                    'nr_container'          => $container,
                    'dt_hr_registro'        => 'now()',
                    'ind_sit_ped_web'       => 1,
                    'cod_moeda'             => $moeda,
                    'cod_estabel'           => $codEstabel,
                    'repres_id'             => $repres,
                    'cod_tipo_pedido'       => $codTipoPedido,
                    'login_digitacao'       => $loginDigitacao,
                    'dt_hr_vencto'          => $dtHrVencto,
                    'log_a_vista'           => $logVista,
                    'dias_cond_pagto_esp'   => $diasCondPagto,
                    'log_pedido_manual'     => $logManual,
                    'login_preposto'        => $loginPreposto,
                    'parcelas_credito'      => $parcelasCredito,
                    'cod_forma_pagto'       => $formPagto,
                    'perc_comis'            => $percComis,
                    'num_agrup'             => $agrupPed,
                    'log_divide_comissao'   => $divideComis,
                    'perc_comis_vend'       => $percVend,
                    'perc_comis_repres'     => $percRepres,
                    'tb_preco_id'           => $tbPreco
                    );
    $cmd = $this->convertArrayEmInsert('pub.peds_web',$aInsert,'1,3,4,5,8');
    
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
      
    $ped = $this->buscarVlSequenciaEspec('seq_ped_web','peds_web');
    return $ped;
if (isset($this->sc_temp_perfil_pai)) {$_SESSION['perfil_pai'] = $this->sc_temp_perfil_pai;}
if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
if (isset($this->sc_temp_gl_log_a_vista)) {$_SESSION['gl_log_a_vista'] = $this->sc_temp_gl_log_a_vista;}
if (isset($this->sc_temp_gl_dias_cond_pagto)) {$_SESSION['gl_dias_cond_pagto'] = $this->sc_temp_gl_dias_cond_pagto;}
if (isset($this->sc_temp_gl_form_pagto)) {$_SESSION['gl_form_pagto'] = $this->sc_temp_gl_form_pagto;}
if (isset($this->sc_temp_gl_parcelas_credito)) {$_SESSION['gl_parcelas_credito'] = $this->sc_temp_gl_parcelas_credito;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function criarPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function sincrPedWeb ------*/

function sincrPedWeb($login, $container, $paramMoeda, $codEstabel, $divideComis,
                     $percVend, $percRepres, $agrup, $tbPreco)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $this->habilitarLogSql(1);
    $this->inserirLogDb('logsql',$this->getLogSql(),__FUNCTION__);


    $ped = $this->getPedWebEmAberto($login,$container,$divideComis,$percVend,
        $percRepres,$agrup,$tbPreco,$paramMoeda,$codEstabel);

    $this->habilitarLogSql(0);
    $this->inserirLogDb('ped. retorno busca ped.venda',$ped,__FUNCTION__);
    $this->inserirLogDb('Parametros busca pedido web em aberto->login - container - dividecomis - percvend - percrepres - agrup - tbpreco - moeda',
        "$login - $container - $divideComis - $percVend - $percRepres - $agrup - $tbPreco - $paramMoeda",__FUNCTION__);
    if($ped == 0){

        $this->inserirLogDb('Pedido de Venda Encontrado?' ,"NAO",__FUNCTION__);
        $ped = $this->criarPedWeb($login,$container,$paramMoeda,$codEstabel,
            false,$divideComis,$percVend,$percRepres,$agrup,$tbPreco);

    }else{
        $this->inserirLogDb('Pedido de Venda Encontrado?' ,"SIM",__FUNCTION__);
    }

    return $ped;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function sincrPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function limparCarrinho ------*/

function limparCarrinho()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $sitsAberto = $this->getSitsPedWebEmAberto();
    $cmd = "update pub.peds_web set ind_sit_ped_web = 3 
            where login = '".$this->getLoginCorrente()."' and ind_sit_ped_web in($sitsAberto) ";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function limparCarrinho ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function cancelarPedido ------*/

function cancelarPedido($id)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = "update pub.peds_web set ind_sit_ped_web = 3 
            where ped_web_id = $id ";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function cancelarPedido ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function efetivarPedido ------*/

function efetivarPedido($id)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aPed = $this->getRegPedWeb($id,'cod_tipo_pedido');
    if(is_array($aPed)){
        $tipo = $aPed[0]['cod_tipo_pedido'];
    }else{
        $tipo = '';
    }
    $aprovarGer = $this->getAprovGerenciaPedWeb($tipo);
    if($aprovarGer == 1){
        $sit = 8;
        $lAvaliarPed = true;
    }else{
        $sit = 2;
        $lAvaliarPed = false;
    }
    $cmd = "update pub.peds_web set ind_sit_ped_web = $sit 
            where ped_web_id = $id ";
    
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
      
    if($lAvaliarPed){
        $usuarioErp = $this->getUsuarioERP($this->getUsuarioCorrente());
        avaliarPedido($id,1,1,0,6,'',$usuarioErp);
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function efetivarPedido ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function efetivarPedidosEmAberto ------*/

function efetivarPedidosEmAberto()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aIds = $this->getPedWebEmAbertoTodos($this->getLoginCorrente());
    if(is_array($aIds)){
        $tam = count($aIds);
        for($i=0;$i<$tam;$i++){
            $id = $aIds[$i]['ped_web_id'];
            $this->efetivarPedido($id);
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function efetivarPedidosEmAberto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getDescCondPagtoPedWeb ------*/

function getDescCondPagtoPedWeb($condPagtoId,$diasCondEsp)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($condPagtoId <> 0){
        $descricao = getDescCondPagto($condPagtoId);
    }else{
        if($diasCondEsp <> ''){
            $descricao = "ESPECIAL($diasCondEsp)";
        }else{
            $descricao = "<span style='color:red;font-weight: bold;'>Não Informada</span>";
        }
    }
    return $descricao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getDescCondPagtoPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getRegPedWeb ------*/

function getRegPedWeb($id,$campos='',$filtroCompl='',$logUTF8=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $campoChave = "ped_web_id";
    $tabela   = "peds_web";
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
        $condicao = $this->util_incr_valor($condicao,$filtroCompl,' AND ',true);
    }

    $tabela   = "pub.$tabela";
    $tipo     = "unico"; 
    $conexao  = "espec";
    $aRet = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao,'',$logUTF8);
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getRegPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getClienteDestinoPedWeb ------*/

function getClienteDestinoPedWeb($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg =$this->getRegPedWeb($pedWebId,'cliente_id,cliente_triang_id');
    if(is_array($aReg)){
        $clienteId       = $this->getVlIndiceArrayDireto($aReg[0],'cliente_id',0);
        $clienteTriangId = $this->getVlIndiceArrayDireto($aReg[0],'cliente_triang_id',0);
        if($clienteTriangId == 0){
            return $clienteId;
        }else{
            return $clienteTriangId;
        }
    }else{
        return 0;
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getClienteDestinoPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getUFDestinoPedWeb ------*/

function getUFDestinoPedWeb($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cliente = $this->getClienteDestinoPedWeb($pedWebId);
    return  getUfCliente($cliente);



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getUFDestinoPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getRegiaoDestinoPedWeb ------*/

function getRegiaoDestinoPedWeb($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $uf = $this->getUFDestinoPedWeb($pedWebId);
    return getRegiaoUF($uf);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getRegiaoDestinoPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getCodigoClienteNovo ------*/

function getCodigoClienteNovo($CNPJ)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
  
    $msg = '';
    $aCliente = existClienteCNPJ($CNPJ);
    $codCliente = $aCliente['cod_cliente'];
    $codRepres	= $aCliente['cod_rep'];
    $nomeRepres = $aCliente['nome_abrev_repres'];
    if($codCliente <> 0){ 
        echo"<h1>".$this->sc_temp_codRepIni." - $codRepres </h1>";
        if($this->sc_temp_codRepIni <> $codRepres){
            $msg = "Cliente Cadastrado com o numero $codCliente, mas, atribuido ao representante $codRepres - $nomeRepres";
        }
    }
    $aRetorno = array('cod_cliente' => $codCliente, 'msg' => $msg);
    return $aRetorno;

if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getCodigoClienteNovo ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function atualizarCodClienteNovo ------*/

function atualizarCodClienteNovo($pedWebId,$codCliente,$tipo) 
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($tipo == 'principal'){
        $campo = "cliente_id";
    }else{
        $campo = "cliente_triang_id";
    }
    $cmd = "update pub.peds_web set $campo = $codCliente
	where ped_web_id = $pedWebId ";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function atualizarCodClienteNovo ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setTipoFrete ------*/

function setTipoFrete($pedWebId,$tipoFrete,$logAtuFrete=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $cmdTransp = "";
    if($logAtuFrete == false){
        $aRegPedWeb = $this->getRegPedWeb($pedWebId,'cod_estabel, cod_tipo_frete_cliente, cliente_id,cliente_triang_id');
        $codEstabel       = $aRegPedWeb[0]['cod_estabel'];
        $tipoFreteCliente = $aRegPedWeb[0]['cod_tipo_frete_cliente'];
        $cliente          = $aRegPedWeb[0]['cliente_id'];
        $clienteTriang    = $aRegPedWeb[0]['cliente_triang_id'];
        if($tipoFreteCliente == 0){
            $logAtuFrete = true;
        }
    }
    switch($tipoFrete){
        case 1:
        case 4:
            if(empty($clienteTriang)){
                if($codEstabel == 5){
                    $transp  =  getTranspPadraoCliente($cliente);
                }else{
                    $transp  = getTranspPadraoItajai($cliente);
                }

            }else{

                if($codEstabel == 5){
                    $transp  =  getTranspPadraoCliente($clienteTriang);
                }else{
                    $transp  = getTranspPadraoItajai($clienteTriang);
                }
            }
            $cmdTransp =", transp_id = $transp";
        break;

        case 2:
            if($codEstabel == 505){
                $transp = $this->getTranspRedesp505();
                $cmdTransp =", transp_id = $transp";
            }else if($codEstabel == 5){
                $transp = $this->getTranspRedesp5();
                $cmdTransp =", transp_id = $transp";
            }
            break;

        case 3:
            $cmdTransp = " ,transp_id = 0 ";
        break;
        default:
            $cmdTransp = '';

    }

    if($logAtuFrete == true){
        $cdmFrete = ",cod_tipo_frete = $tipoFrete";
    }else{
        $cdmFrete= '';
        $cmdTransp = '';
    }

    $cmd = "update pub.peds_web set cod_tipo_frete_calc = $tipoFrete $cdmFrete $cmdTransp 
            where ped_web_id = $pedWebId";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setTipoFrete ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getDescrCliente ------*/

function getDescrCliente($cliente,$cnpj ='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $descricao = '';
    $nomeAbrev = getNomeAbrevCliente($cliente,true);
    if($nomeAbrev == ''){
        if($cnpj <> ''){
            $cnpj = $this->mascara($cnpj,"##.###.###/####-##");
            $descricao = "CLIENTE NOVO:$cnpj";
        }else{
            $descricao = " ";
        }
    }else{
        $descricao = $nomeAbrev;
    }
    return $descricao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getDescrCliente ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setObservacao ------*/

function setObservacao($pedWebId,$compl)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = "update pub.peds_web set comentario = comentario + '$compl' where ped_web_id = $pedWebId ";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setObservacao ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setObsSemEmail ------*/

function setObsSemEmail($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $this->setObservacao($pedWebId,'\n Cliente sem e-mail cadastrado');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setObsSemEmail ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setObsTelefonesTransp ------*/

function setObsTelefonesTransp($pedWebId,$telefoneTransp,$telefoneTranspRedesp='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($telefoneTransp <> ''){
        $compl = " \n Nova Transportadora - telefone para contato: $telefoneTransp  " ;
    }

    if($telefoneTranspRedesp <> ''){
        $compl .= " \n Nova Transportadora Resdespacho - telefone para contato: $telefoneTranspRedesp  " ;
    }

    $this->setObservacao($pedWebId,$compl);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setObsTelefonesTransp ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function limparCNPJ ------*/

function limparCNPJ($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getRegPedWeb($pedWebId,'cnpj_novo_cliente, cnpj_novo_cliente_triang');
    if(is_array($aReg)) {

        $cnpj = $aReg[0]['cnpj_novo_cliente'];
        $cnpj = str_replace('.', '', $cnpj);
        $cnpj = str_replace('/', '', $cnpj);



        $cnpjTriang = $aReg[0]['cnpj_novo_cliente_triang'];
        $cnpjTriang = str_replace('.', '', $cnpjTriang);
        $cnpjTriang = str_replace('/', '', $cnpjTriang);


        $cmd = "update pub.peds_web set cnpj_novo_cliente = '$cnpj', cnpj_novo_cliente_triang = '$cnpjTriang'
 where ped_web_id = $pedWebId ";
        
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function limparCNPJ ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function tratarCondPagtoEspecial ------*/

function tratarCondPagtoEspecial($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($valor <> ''){
        $aValor = explode(',',$valor);
        if(is_array($aValor)){
            for($i=0;$i<count($aValor);$i++){
                $dia = $aValor[$i];
                if($dia <> "" and $dia <> 0){
                    $aDias[] = $dia;
                }
            }
        }
        if(is_array($aDias)){
            asort($aDias);
            $retorno = implode($aDias,',');
        }else{
            $retorno = $aDias;
        }


    }else{
        $retorno = '';
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function tratarCondPagtoEspecial ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setCondpagtoPedWeb ------*/

function setCondpagtoPedWeb($pedWebId,$logVista,$diasCondPagto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = " update pub.peds_web set log_a_vista = $logVista, dias_cond_pagto_esp = '$diasCondPagto'
             where ped_web_id = $pedWebId";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setCondpagtoPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setClientePedWeb ------*/

function setClientePedWeb($pedWebId,$cliente)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = " update pub.peds_web set cliente_id = $cliente
             where ped_web_id = $pedWebId";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setClientePedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setDadosPedWeb ------*/

function setDadosPedWeb($pedWebId,$logOperacTriang,$logNovoCliente,$clienteId,$cnpjNovoCliente,
                        $logNovoClienteTriang,$cnpjNovoClienteTriang,$clienteTriangId,
                        $emailsAdicionais, $codFinalidade,$codPrioridade, $indSitPedWeb,
                        $logPedidoManual,$logVista,$diasCondPagtoEsp,
                        $logDtFixa,$comentario,$codFormaPagto,$parcelasCredito)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $msg = '';
    $logDtFixa = $this->tratarNumero($logDtFixa);
    $logOperacTriang = $this->tratarNumero($logOperacTriang);
    $logNovoClienteTriang = $this->tratarNumero($logNovoClienteTriang);
    $logNovoCliente  = $this->tratarNumero($logNovoCliente);
    $clienteTriangId = $this->tratarNumero($clienteTriangId);
    if($codPrioridade   == ''){
        $codPrioridade = '10';
    }
    if($codFormaPagto == 2){ 
        $diasCondPagtoEsp = 0;
    }

    
    if($msg == ''){
        $cmd = "update pub.peds_web
              set log_operac_triang = $logOperacTriang ,
              log_novo_cliente = $logNovoCliente,
              cliente_id = $clienteId,
              cnpj_novo_cliente = '$cnpjNovoCliente',
              log_novo_cliente_triang = $logNovoClienteTriang,
            cnpj_novo_cliente_triang = '$cnpjNovoClienteTriang',
            cliente_triang_id = $clienteTriangId,
            emails_adicionais = '$emailsAdicionais',
            cod_finalidade = $codFinalidade,
            cod_prioridade = $codPrioridade ,
            log_a_vista = $logVista ,
            dias_cond_pagto_esp = '$diasCondPagtoEsp' ,
            log_dt_fixa = $logDtFixa ,
            comentario = '$comentario',
            cod_forma_pagto = $codFormaPagto,
            parcelas_credito = $parcelasCredito
            where ped_web_id = $pedWebId
            ";
        
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
    return $msg;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setDadosPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function validacoesDadosPedWeb ------*/

function validacoesDadosPedWeb($logOperacTriang, $logNovoCliente, $clienteId, $cnpjNovoCliente,
                               $logNovoClienteTriang, $cnpjNovoClienteTriang, $clienteTriangId,
                               $emailsAdicionais, $codFinalidade, $codPrioridade, $indSitPedWeb,
                               $logPedidoManual, $logVista, $diasCondPagtoEsp,
                               $logDtFixa, $comentario, $logAVista, $logDivideComis=0, $numAgrup=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $msg = '';
    if($clienteId == 0 and $logNovoCliente == 0){

        $msg1 = '1 - O cliente precisa ser informado.';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($clienteId == $clienteTriangId and $clienteId <> 0){
        $msg1 = '2 - O cliente Triangular não pode ser igual ao cliente do Pedido.';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($clienteTriangId == 0 and $logOperacTriang == 1 and $logNovoClienteTriang == 0){
        $msg1 ='3 - O cliente Triangular precisa ser informado.';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    $sit = getSitCliente($clienteId);

    $msg1= getMsgErroSitCliente($sit, $logAVista, $clienteId);
    if($msg1 <> '' and $clienteId <> 0){
        $msg1 = "13 - $msg1";
        $msg  = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    $bloqAdvVendas = getSitCliAdmVendas($clienteId);
    if($bloqAdvVendas == 1){
        $msg1 = '13.1 - Cliente bloqueado pela ADM Vendas';
        $msg  = $this->util_incr_valor($msg,$msg1,"</br>");
    }



    if($diasCondPagtoEsp == '' and $logVista == 0){
        $msg1 = '4 - Informe uma condição de pagamento Especial';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($logNovoCliente == 1 and $cnpjNovoCliente == '' ){
        $msg1 = '5 - Preencha o campo CNPJ, pois, foi marcado que este pedido é para um cliente novo.';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    if( $logNovoClienteTriang == 1 and   $cnpjNovoClienteTriang == ''){
        $msg1 = '6 - Preencha o campo CNPJ Triang, pois, foi marcado que este pedido é 	
        para um cliente novo e que é um pedido de operação triangular.';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    if(strlen($diasCondPagtoEsp) > 3 and strstr($diasCondPagtoEsp,',') == false){
        $msg1= '7 - A condição de pagamento deve estar separada por virgulas';
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");

    }


    if($cnpjNovoCliente <> ''){
        $aMsg = validarClienteNovo($cnpjNovoCliente);
        if(isset($aMsg['erro'])){
            $erro = $aMsg['erro'];
            $msg = $this->util_incr_valor($msg,"$erro",'</br>',
                true);
        }
    }

    if($cnpjNovoClienteTriang <> ''){
        $aMsg = validarClienteNovo($cnpjNovoClienteTriang);
        if(isset($aMsg['erro'])){
            $erro = $aMsg['erro'];
            $msg = $this->util_incr_valor($msg,"$erro",'</br>',true);
        }
    }



    

    if((strstr('10,16,17,18',$codPrioridade) == false or  $codPrioridade < 10) and ($codPrioridade <> '' and $codPrioridade <> 0) ){
        $msg1 = "8 - Código de Prioridade($codPrioridade) Inválido. Os valores válidos são: 10,16,17,18";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    

    if($this->getTodosClienteCorrente() <> 1){
        $vendLoja		= $this->verifVendLoja();
        $aCliOutroVend = verifCliOutroRepres($clienteId);
        $lCliOutroVend = $aCliOutroVend['log_outro_vend'];
        $nomeRepresCli = $aCliOutroVend['nome_repres_cli'];
        $admVendas = $this->verificGrupoLogin(4);
        $tpUsuario = $this->getTipoUsuarioCorrente();
        if($vendLoja == 0 and $lCliOutroVend and $admVendas == false and $tpUsuario <> 5){
            $msg1 ="9-O Cliente $clienteId  pertence ao representante $nomeRepresCli 
                e não está inativo. Favor alterar o cliente ou solicitar alteração ao setor de cadastro";
            $msg = $this->util_incr_valor($msg,$msg1,"</br>");
        }
        if( $logDivideComis == 0 and $numAgrup <> 0  and  $lCliOutroVend           and $vendLoja == 1 ){
            $msg1 ='12 - Este pedido não permite divisão de comissão. Escolha um cliente que esteja
                na sua carteira ou inativo.';
            $msg = $this->util_incr_valor($msg,$msg1,"</br>");
        }
        
        if($vendLoja == 1 and $lCliOutroVend ){
            $tipoVend = $this->getTipoVendedor($nomeRepresCli);
            if($tipoVend == 'interno'){
                $msg1 ="11 - O cliente escolhido pertence a outro vendedor interno e não 
                    está inativo";
                $msg = $this->util_incr_valor($msg,$msg1,"</br>");
            }
        }
    }
    return $msg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function validacoesDadosPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function validacoesComisPedWeb ------*/

function validacoesComisPedWeb($logPercNegoc, $percComisNegoc,$percLimite)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $msg = '';
    if($logPercNegoc == 1 and ($percComisNegoc == 0 or $percComisNegoc == '')){
        $msg1 = "10 - Quando a comissão é negociada é necessário informar o % de comissão negociada";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    if($percComisNegoc >= $percLimite and $logPercNegoc == 1){
        $msg1 = "20 - O percentual de comissão negociado($percComisNegoc) deve ser menor que  $percLimite .";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    return $msg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function validacoesComisPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function validacoesFreteTranspPedweb ------*/

function validacoesFreteTranspPedweb($tipoFrete, $transpId, $logNovoTransp,
                                     $transpRedespId, $logNovoTranspRedesp,
                                     $telefoneNovoTransp, $telefoneNovoTranspRedesp,$tpFreteCliente=0){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $msg = '';
    if($tipoFrete == 3 and $transpId == 0 and $logNovoTransp == 0){
        $msg1 = "<h4>Para o tipo de frete FOB é necessário informar uma transportadora</h4>";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($tipoFrete == 2 and $transpRedespId == 0 and $logNovoTranspRedesp == 0 and $tpFreteCliente <> 1){
        $msg1 = "<h4>Para o tipo de frete CIF Parcial é necessário informar uma transportadora de redespacho</h4>";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    if($transpRedespId == 0 and $logNovoTranspRedesp == 0 and $tpFreteCliente == 2){
        $msg1 = "<h4>Para o tipo de frete CIF Parcial é necessário informar uma transportadora de redespacho </h4>";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($logNovoTransp == 1 and $telefoneNovoTransp == ''){
        $msg1 = "<h4>Informe um Telefone para na nova transportadora</h4>";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }

    if($logNovoTranspRedesp == 1 and $telefoneNovoTranspRedesp == ''){
        $msg1 = "<h4>Informe um Telefone para na nova transportadora de redespacho</h4>";
        $msg = $this->util_incr_valor($msg,$msg1,"</br>");
    }
    return $msg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function validacoesFreteTranspPedweb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getDescrIndSitPed ------*/

function getDescrIndSitPed($sit)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $descr = "";
    switch ($sit){
        case 1:
            $descr = "Em Digitação";
            break;
        case 2:
            $descr = "Efetivado";
            break;
        case 3:
            $descr = "Cancelado";
            break;
        case 4:
            $descr = "Integrado ERP";
            break;
        case 5:
            $descr = "Rejeitado";
            break;
        case 6:
            $descr = "Vencido";
            break;
    }
    return $descr;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getDescrIndSitPed ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setComisPedWeb ------*/

function setComisPedWeb($pedWebId, $aComis)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $percComis = $aComis[0] ['perc_comis'];
    echo "<h1>Comissão=$percComis</h1>";
    $percComis = str_replace(',','.',$percComis);
    if(isset($aComis[1])){
        $percComis2 = $aComis[1] ['perc_comis'];
        $percComis2 = str_replace(',','.',$percComis);
        $codRep2    = $aComis[1] ['cod_rep'];
    }else{
        $percComis2 = '';
        $codRep2    = 0;
    }
    $array['perc_comis'] = $percComis;
    if($percComis2 <> ''){
        $array['perc_comis_2'] = $percComis2;
        $array['repres_2_id']  = $codRep2;
    }
    $cmd = $this->convertArrayEmUpdate('peds_web',$array,
        " ped_web_id = $pedWebId ");

    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setComisPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getFormaPagtoCartao ------*/

function getFormaPagtoCartao($ped_web_id)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $formaPagto = 0;

    $tabela   = " PUB.peds_web ";
    $campos   = " cod_forma_pagto ";
    $condicao = "  PUB.peds_web.ped_web_id = $ped_web_id ";
    $aRet = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aRet)){
        $formaPagto = $aRet[0]['cod_forma_pagto'];
    }
    return $formaPagto;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getFormaPagtoCartao ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function avaliarFormaPagtoCartao ------*/

function avaliarFormaPagtoCartao($formaPagto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $lAchou = false;
    if(strstr('3,4',$formaPagto) <> false){
        $lAchou = true;
    }
    return $lAchou;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function avaliarFormaPagtoCartao ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setPrepostoPedsWeb ------*/

function setPrepostoPedsWeb($pedWebId,$preposto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $array = array('login_preposto' => $preposto);
    $cmd = $this->convertArrayEmUpdate('pub.peds_web', $array, "ped_web_id = $pedWebId");
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setPrepostoPedsWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getCodMoeda ------*/

function getCodMoeda($moeda)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch($moeda)
    {
        case 2:
        case 'dolar':
            $ret = 'dolar';
            break;
        default:
            $ret = 'real';
    }
    return $ret;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getCodMoeda ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function calcSitComissao ------*/

function calcSitComissao($qtItens,$divideComissao,$percComisRepres,$percComisVend)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $sitPercVend     = '';
    $sitComissaoPerc = '';
    if ($qtItens == 0) {
        $sitComissao = 'Em Aberto - Sem Itens';
    } else {
        if ($divideComissao == 1) {
            $sitComissao = "Comissão Dividida";
        } else {
            $sitComissao = "Comissão Única";
        }
        if ($percComisRepres == 0) {
            $sitPercRepres = "Repres: Comissão Padrão";

        } else {
            $sitPercRepres = "Repres: Comissão Especial:$perc_comis_repres ";
        }
        if ($percComisVend == 0) {
            $sitPercVend = "Vendedor: Comissão Padrão";
        } else {
            $sitPercRepres = "Repres: Comissão Especial:$perc_comis_vend ";
        }

        if ($this->verifVendLoja() == 1) {
            if ($divideComissao == 1) {
                $sitComissaoPerc = " $sitPercVend - $sitPercRepres ";
            } else {
                $sitComissaoPerc = $sitPercVend;
            }
        } else {
            $sitComissaoPerc = $sitPercRepres;
        }
    }
    $sitComissao .= " - $sitComissaoPerc ";

    return $sitComissao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function calcSitComissao ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function atuDadosPedWeb ------*/

function atuDadosPedWeb($pedWebId,$aDados)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd= $this->convertArrayEmUpdate('peds_web',$aDados, " ped_web_id = $pedWebId");
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function atuDadosPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function atuAgrupPedWeb ------*/

function atuAgrupPedWeb($pedWebId,$divideComis,$percComisRepres,$percComisVend)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qt = getQtItensRefPedWeb($pedWebId);
    if($qt == 0){
        $aPedWeb = $this->getRegPedWeb($pedWebId);
        if(is_array($aPedWeb)){
            $codMoeda       = $aPedWeb[0]['cod_moeda'];
            $nrContainer    = $aPedWeb[0]['nr_container'];
            $tbPreco        = $aPedWeb[0]['tb_preco_id'];
            $codEstabel     = $aPedWeb[0]['cod_estabel'];

            $numAgrup = getAgrupPedido($codMoeda,$nrContainer,$tbPreco,
                $divideComis,$percComisVend,$percComisRepres,$codEstabel);
            $array = array('log_divide_comissao'=>$divideComis,
                'perc_comis_repres'=>$percComisRepres,
                'perc_comis_vend'=>$percComisVend,
                'num_agrup'=> $numAgrup
            );
            $this->atuDadosPedWeb($pedWebId,$array);
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function atuAgrupPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function limparNumAgrupPedWeb ------*/

function limparNumAgrupPedWeb($pedWebId)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aDados = array('num_agrup'=>0);
    $this->atuDadosPedWeb($pedWebId,$aDados);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function limparNumAgrupPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function setSitPedWeb ------*/

function setSitPedWeb($numSit){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $array = array();

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function setSitPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getQtPedsGerecial ------*/

function getQtPedsGerecial($tpUsuario, $usuario='',$listaCodReps=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $tabela   = " PUB.peds_web ";
    $campos   = " ped_web_id ";

    if($tpUsuario == 4 or $tpUsuario == 3){
        if($listaCodReps <> ''){
            $listaNomReps = $this->retornaListaNomeRepsRestrUsuar($listaCodReps);
            $condicao = "  PUB.peds_web.ind_sit_ped_web = 8 and login in($listaNomReps)";
        }else{
            $condicao = "  PUB.peds_web.ind_sit_ped_web = 8";
        }
    }else{
        $condicao = "  PUB.peds_web.ind_sit_ped_web = 8 and login >= '$usuario' and login <= '$usuario'";
    }
    $aRet = $this->getDados('multi',$tabela,$campos,$condicao,'espec');

    if($aRet <> ''){
        $tam = count($aRet);
    }else{
        $tam = 0;
    }
    return $tam;




$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getQtPedsGerecial ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getSitsPedWebEmAberto ------*/

function getSitsPedWebEmAberto(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '1,9';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getSitsPedWebEmAberto ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getSitsPedWebAlocados ------*/

function getSitsPedWebAlocados(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return '1,2,5,9';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getSitsPedWebAlocados ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function calcDestaqueFretePedWeb ------*/

function calcDestaqueFretePedWeb($pedsWebId,$vlPedido='calcular')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aPedido        = $this->getRegPedWeb($pedsWebId,'');
    $regiao         = $this->getRegiaoDestinoPedWeb($pedsWebId);
    $uf = $this->getUFDestinoPedWeb($pedsWebId);
    $percDestaque = getPercDestaqFreteCIFTotalPorUF($uf);


    if($vlPedido=='calcular'){
        $aVlsPedido     = valorizarItensRefPedWeb($pedsWebId);
        $vlPedido       = $aVlsPedido['total'];
    }

    $vlDestaqueFrete= $vlPedido * $percDestaque / 100;
    return array('vl_pedido'=>$vlPedido,
        'vl_destaque_frete'=>$vlDestaqueFrete,
        'regiao'=>$regiao,
        'uf'=>$uf,
        'perc_destaque_frete'=> $percDestaque );

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function calcDestaqueFretePedWeb ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function alteraLogSafira ------*/

function alteraLogSafira($usuario,$idTabela){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($idTabela == 3){
        $aRegs = $this->getPedWebEmAbertoTodos($usuario);
        if($aRegs){
            $aUltPed = end($aRegs);
            $idUltPed = $aUltPed["ped_web_id"];
            $cmd = " update pub.peds_web set log_safira = 1
                     where ped_web_id = $idUltPed";
            
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
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function alteraLogSafira ------*/


/*----- Scriptcase Locale: PHP Method: peds_web.php => function getRegPedsWebNrErp ------*/

function getRegPedsWebNrErp($nrPedidoErp,$campo){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $reg = '';
    $aReg = $this->getReg('espec','peds_web','nr_pedido_erp',$nrPedidoErp,$campo);

    if($aReg){
        $reg = $aReg[0]["$campo"];
    }

    return $reg;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: peds_web.php => function getRegPedsWebNrErp ------*/


/*----- Scriptcase Locale: PHP Method: dia_calend_glob.php => function getUtilizDiaCalend ------*/

function getUtilizDiaCalend($data){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $diaUtil = 0;
    $calend = $this->buscarParametroIma('calend_global','fiscal');
    $aReg= $this->getReg('ems5',
        'dia_calend_glob',
        'cod_calend',
        "'$calend'",
        'log_dia_util',
    "dat_calend='$data'" );
    if(is_array($aReg)){
        $diaUtil = $aReg[0]['log_dia_util'];
    }
    return $diaUtil;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: dia_calend_glob.php => function getUtilizDiaCalend ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function toFloatBr ------*/

function toFloatBr(string $valor): float
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $valor = preg_replace('/[^\d,.\-]/', '', $valor);

    $valor = str_replace('.', '', $valor);

    $valor = str_replace(',', '.', $valor);

    return floatval($valor);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function toFloatBr ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function maiorQueBr ------*/

function maiorQueBr(string $valor1, string $valor2): bool
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->toFloatBr($valor1) > $this->toFloatBr($valor2);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function maiorQueBr ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function maiorQueBrEn ------*/

function maiorQueBrEn(string $valor1, string $valor2): bool
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->toFloatBr($valor1) > $valor2;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function maiorQueBrEn ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function hex2Rgb ------*/

function hex2Rgb($hex) {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $hex = str_replace("#", "", $hex);
    $hex = trim($hex);
    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $corR = substr($hex,0,2);
        $corG = substr($hex,2,2);
        $corB = substr($hex,4,2);
        $r = hexdec($corR);
        $g = hexdec($corG);
        $b = hexdec($corB);
    }
    $rgb = array($r, $g, $b);
    return $rgb;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function hex2Rgb ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function exibirMsgErro ------*/

function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    str_replace(chr(13),'<br/>',$msg);
    if($msg <> ''){
        switch ($indTransformacao){
            case 1:
                $msg = $this->convISO88591ParaUtf8($msg);
                break;
            case 2:
                $msg = $this->convUtf8ParaISO88591($msg);
                break;
        }
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $msg;
;
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function exibirMsgErro ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convNomeTabProgress ------*/

function convNomeTabProgress($tb)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tbComTraco = strpos($tb,'-');
    $tbComAspas = strpos($tb, chr(34),1);
    if( $tbComTraco <> ''){
        if( $tbComAspas == ''){
            $tb = chr(34).$tb.chr(34);
        }
    }
    if(!strstr(strtolower($tb), "pub.") and !strstr(strtolower($tb), "sysprogress.")
        and !strstr(strtolower($tb), "dados.")){
        $tb = "pub.{$tb}";
    }
    return str_replace('pub.pub.','pub.',$tb);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convNomeTabProgress ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function util_incr_valor ------*/

function util_incr_valor($variavel,$incremento,$delimitador = ',',$logDesconsideraBranco=false,$logDelimitarBranco=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = $variavel;
    $logIncrementar = false;
    if($logDesconsideraBranco == true){
        if($incremento <> '' ){
            $logIncrementar = true;
        }
    }else{
        $logIncrementar = true;
    }
    if($logIncrementar == true){
        if($variavel == ''){
            if($logDelimitarBranco){
                $retorno .= $delimitador.$incremento;
            }else{
                $retorno = $incremento;
            }
        }
        else{
            $retorno .= $delimitador.$incremento;
        }
    }

    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function util_incr_valor ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retornarOpcoesTxt ------*/

function retornarOpcoesTxt($campo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
	$aCampo = explode(',',$campo);
	$retorno = '';
	for($i = 0;$i < count($aCampo);$i++ )
	{
		if($retorno =='' )
		 $retorno = "'".$aCampo[$i]."'";
		else
		 $retorno .= ",'".$aCampo[$i]."'";

	}
	return $retorno;




$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retornarOpcoesTxt ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function converterDecimal ------*/

function converterDecimal($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
	$valor = str_replace(".","",$valor);
    $valor = str_replace(",",".",$valor);
	return $valor;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function converterDecimal ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function buscarVlSequenciaEspec ------*/

function buscarVlSequenciaEspec($sequencia,$tabela){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

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
        echo "<h1>To aqui</h1>";
	}
	else{
		$valor = $seq[0][0];
	}
	return $valor;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function buscarVlSequenciaEspec ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function incrementarVlSequenciaEspec ------*/

function incrementarVlSequenciaEspec($sequencia,$tabela){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

	$valor = 0;
	$sql =" SELECT pub.\"$sequencia\".NEXTVAL from pub.\"_File\" WHERE \"_File-Name\" = '$tabela'";
	 
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function incrementarVlSequenciaEspec ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function sincrVlSequenciaEspec ------*/

function sincrVlSequenciaEspec($sequencia,$tabela,$numCorrente)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $numSeq = $this->buscarVlSequenciaEspec($sequencia,$tabela);
    if($numCorrente > $numSeq){
       $this->incrementarVlSequenciaEspec($sequencia,$tabela);
    }


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function sincrVlSequenciaEspec ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function dataAtual ------*/

function dataAtual()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    $completaUs = "{$ano}-{$mes}-{$dia}";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa,
        'completa_us'=> $completaUs);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function dataAtual ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function intervaloData ------*/

function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function intervaloData ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function preencherZerosAEsquerda ------*/

function preencherZerosAEsquerda($num,$tamanho=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tamanhoNumero = strlen($num);

    $qtRepeticoes = $tamanho - $tamanhoNumero;
    if($qtRepeticoes < 0){
        $qtRepeticoes = 0;
    }
    $zeros = str_repeat('0',$qtRepeticoes);
    $numero = $zeros.$num;
    return $numero;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function preencherZerosAEsquerda ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarAcento ------*/

function retirarAcento($palavra)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

	return $palavra;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarAcento ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarAcentoSimples ------*/

function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarAcentoSimples ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function formatarNumero ------*/

function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function formatarNumero ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function tratarNumero ------*/

function tratarNumero($num)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
	if(trim($num) == ''){
		$num = 0;
	}
	return $num;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function tratarNumero ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVlLogico ------*/

function getVlLogico($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $valor == 1 ? 'Sim' : 'Não';


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVlLogico ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function formatarPreco ------*/

function formatarPreco($moeda,$vl)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $valor  = round($vl,2);
	if(strstr($valor,'.') ==false){
		$valor = "$valor.00";
	}
    $moeda = strtolower($moeda);

    if($moeda =='real' or $moeda == '1'){
        $sinal = "R$";
    }else{
        $sinal = "US$";
    }
    if(!empty($valor)){

		$valor = number_format($valor,2,',','.');
	}
       

    $valor = "$sinal $valor";

	if($vl == 0){
		$valor = '';
	}
    return $valor;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function formatarPreco ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desformatarValor ------*/

function desformatarValor($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $valor = str_replace("R$",'',$valor);
    $valor = str_replace("US$",'',$valor);
    $valor = str_replace(".",'',$valor);
    $valor = str_replace(",",'.',$valor);
    return $valor;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desformatarValor ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function validaCNPJ ------*/

function validaCNPJ($cnpj = null)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if(empty($cnpj)) {
        return false;
    }

    $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
    $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

    if (strlen($cnpj) != 14) {
        return false;
    }

    else if ($cnpj == '00000000000000' ||
        $cnpj == '11111111111111' ||
        $cnpj == '22222222222222' ||
        $cnpj == '33333333333333' ||
        $cnpj == '44444444444444' ||
        $cnpj == '55555555555555' ||
        $cnpj == '66666666666666' ||
        $cnpj == '77777777777777' ||
        $cnpj == '88888888888888' ||
        $cnpj == '99999999999999') {
        return false;

    } else {

        $j = 5;
        $k = 6;
        $soma1 = "";
        $soma2 = "";

        for ($i = 0; $i < 13; $i++) {

            $j = $j == 1 ? 9 : $j;
            $k = $k == 1 ? 9 : $k;

            $soma2 += ($cnpj[$i] * $k);

            if ($i < 12) {
                $soma1 += ($cnpj[$i] * $j);
            }

            $k--;
            $j--;

        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        return (($cnpj[12] == $digito1) and ($cnpj[13] == $digito2));

    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function validaCNPJ ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function mascara ------*/

function mascara($val, $mask)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

 $maskared = '';

 $k = 0;

 for($i = 0; $i<=strlen($mask)-1; $i++) {
     if($mask[$i] == '#') {

        if(isset($val[$k])) $maskared .= $val[$k++];
    }
    else{
        if(isset($mask[$i]))  $maskared .= $mask[$i];

    }
 }
 return $maskared;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function mascara ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function atualizarPg ------*/

function atualizarPg()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
     if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->nm_cod_apl, $this->nm_location, "","_self", 440, 630);
 };
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function atualizarPg ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function tratarAspasSimples ------*/

function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function tratarAspasSimples ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayParaLista ------*/

function convArrayParaLista($array,$logEntreAspas=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayParaLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayMultParaLista ------*/

function convArrayMultParaLista($array,$indice,$logEntreAspas=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayMultParaLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function setAplCorrente ------*/

function setAplCorrente(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['apl_corrente'])) {$_SESSION['apl_corrente'] = "";}
if (!isset($this->sc_temp_apl_corrente)) {$this->sc_temp_apl_corrente = (isset($_SESSION['apl_corrente'])) ? $_SESSION['apl_corrente'] : "";}
  
    $this->sc_temp_apl_corrente = $this->Ini->nm_cod_apl;


if (isset($this->sc_temp_apl_corrente)) {$_SESSION['apl_corrente'] = $this->sc_temp_apl_corrente;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function setAplCorrente ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getQtLista ------*/

function getQtLista($lista,$separador=',')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qt = 0;
    if($lista <> ''){
        $aLista = explode($separador,$lista);
        if(is_array($aLista)){
            $qt = count($aLista);
        }
    }

    return $qt;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getQtLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function unique_multidim_array ------*/

function unique_multidim_array($array, $key) {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $temp_array = array();
    $i = 0;
    $key_array = array();
    if(is_array($array)){
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
    }


    return $temp_array;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function unique_multidim_array ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getDadosEmpresa ------*/

function getDadosEmpresa($empresa)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $empresa = substr($empresa,0,1);
    switch($empresa)
    {
        case '1':
            $nrTabPre = 'TAB A12';
            $conexao = "ima";
            break;
        case '5':
            $nrTabPre = 'TAB E12';
            $conexao = "med";
            break;
        default:
            $nrTabPre = 'TAB E12';
            $conexao = 'med';
            break;

    }
    return array('nr_tab_pre'=>$nrTabPre,'conexao'=>$conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getDadosEmpresa ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function setVarSessao ------*/

function setVarSessao($variavel,$valor,$incremento=0,$logEscopoApl=false,$varPai='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $variavel = $this->getNomeVarSessaoComApl($variavel);
    }
    if($varPai <> ''){
        if($incremento == 0 or ! isset($_SESSION[$varPai][$variavel]) ){
            $_SESSION[$varPai][$variavel] = $valor;
        }else{
            $_SESSION[$varPai][$variavel] =  $this->util_incr_valor($_SESSION[$varPai][$variavel],$valor);
        }
    }else{
        if($incremento == 0 or ! isset($_SESSION[$variavel]) ){
            $_SESSION[$variavel] = $valor;
        }else{
            $_SESSION[$variavel] =  $this->util_incr_valor($_SESSION[$variavel],$valor);
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function setVarSessao ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getNomeVarSessaoComApl ------*/

function getNomeVarSessaoComApl($var)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $apl = $this->getAplCorrente();
    $variavel = $apl."_".$var;
    return $variavel;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getNomeVarSessaoComApl ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVarSessao ------*/

function getVarSessao($varParam,$logEscopoApl=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = $this->getNomeVarSessaoComApl($varParam);
    }

    if(isset($_SESSION[$varParam])){
        $retParam =  $_SESSION[$varParam];
    }else{
        $retParam = '';
    }
    return $retParam;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVarSessao ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function limparVarSessao ------*/

function limparVarSessao($variavel,$logEscopoApl=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($logEscopoApl){
        $varParam = $this->getNomeVarSessaoComApl($variavel);
    }

    if($variavel <> ''){
        $aVar = explode(',',$variavel);
        foreach ($aVar as $var) {
            unset($_SESSION[$var]);
        }
    }


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function limparVarSessao ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getNumEmLista ------*/

function getNumEmLista($lista,$numero)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $lAchou = false;
    if($lista <> ''){
        $aLista = explode(',',$lista);
        foreach ($aLista as $numLista){
            if($numLista == $numero){
                $lAchou = true;
                break;
            }
        }
    }

    return $lAchou;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getNumEmLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayEmMsg ------*/

function convArrayEmMsg($aMsg,$tagHeader='h1')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $msg = '';
    if(!is_array($aMsg)){
        $texto = $aMsg;
        $aMsg = array();
        $aMsg[] = $texto;
    }
    if(is_array($aMsg)){
        $tam = count($aMsg);
        for($i=0;$i<$tam;$i++){
            $incr = $aMsg[$i];
            $incr = str_replace(chr(13),'<br/>',$incr);
            if($tagHeader <> ''){
                $tagHeaderIni = "<$tagHeader>";
                $tagHeaderFim = "</$tagHeader>";

            }
            $msg = $this->util_incr_valor($msg,"{$tagHeaderIni}{$incr}{$tagHeaderFim}");
        }
    }
    return $msg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayEmMsg ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function gerarListaPartes ------*/

function gerarListaPartes($campo, $lista,$ciclo=400)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $iContCiclo = 0;
    $condSqlFinal = '';
    $listaCorrente = '';
    $aLista = explode(",",$lista);
    if(is_array($aLista)){
        $tam = count($aLista);
        if($tam > $ciclo){
            $this->inserirLogDb("menor que o clico de $ciclo?",'nao',__FUNCTION__);
            for($i=0;$i<$tam;$i++){

                $iContCiclo++;
                if($iContCiclo == $ciclo){
                    $this->inserirLogDb("entrei na condicao de clico igual ao contador",'sim',__FUNCTION__);
                    $iContCiclo = 0;
                    $condSql = "$campo in ($listaCorrente)";
                    $this->inserirLogDb('condsql',$condSql,__FUNCTION__);
                    $condSqlFinal = $this->util_incr_valor($condSqlFinal,$condSql," AND ",
                        true);
                    $this->inserirLogDb('condsqlfinal',$condSqlFinal,__FUNCTION__);
                    $listaCorrente = '';
                }
                $listaCorrente = $this->util_incr_valor($listaCorrente,$aLista[$i],',',true);
                $this->inserirLogDb("lista - posicao $i",$listaCorrente,__FUNCTION__);
                if($tam == $i + 1 and $iContCiclo < $ciclo){
                    $this->inserirLogDb("lista - posicao $i - menor que ciclo",$listaCorrente,__FUNCTION__);
                    $condSql = "$campo in ($listaCorrente)";
                    $condSqlFinal = $this->util_incr_valor($condSqlFinal,$condSql," AND ",
                        true);
                }
            }
        }else{
            $this->inserirLogDb("menor que o clico de $ciclo?",'sim',__FUNCTION__);
            $condSqlFinal = " $campo in ($lista)";
        }

    }
    return $condSqlFinal;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function gerarListaPartes ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayHtml ------*/

function convArrayHtml($array,$elementoChave,$elementoValor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /*
     *  <h1>pedido</h1><h1>1236548</h1>
     * $a = array('Pedido: $pedido_resumo  = $this->convArrayHtml($a,'span style="font-weigth:900; text-align;right;" ', 'span');
     */

    $props   ='';
    $propsVl ='';

    $html = '';
    if(is_array($array) and $elementoChave <> '' and $elementoValor <> ''){
        foreach($array as $chave =>$reg){
            $aElementoChave = explode(' ',$elementoChave);
            $tagChave = $aElementoChave[0];
            for($i=1;$i < count($aElementoChave);$i++){
                $props = $this->util_incr_valor($props,$aElementoChave[$i],' ');
            }

            $aElementoValor = explode(' ',$elementoValor);
            $tagValor = $aElementoValor[0];
            for($i=1;$i < count($aElementoValor);$i++){
                $propsVl = $this->util_incr_valor($props,$aElementoValor[$i],' ');
            }

            $html .= "<{$tagChave} $props>{$chave}</{$tagChave}>
            <{$tagValor} $propsVl >{$reg}</{$tagValor}></br>";
        }
    }
    return $html;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayHtml ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getMsgAnaliseDif ------*/

function getMsgAnaliseDif($descricao,$descOrigem,$descDestino,$s1,$s2): string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = '';
    if($s1 <> $s2){
        $retorno = "$descricao $descOrigem $s1 <> $descDestino $s2";
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getMsgAnaliseDif ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getAplCorrente ------*/

function getAplCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->Ini->nm_cod_apl;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getAplCorrente ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convNomeVar ------*/

function convNomeVar($nomeVar,$sufixo='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $novaVar = '';
    $logExplode = false;
    $aNomeVar = array();
    $nomeVar = str_replace(chr(34),'',$nomeVar);
    if(strstr($nomeVar,'_')){
        $aNomeVar = explode('_',$nomeVar);
        $logExplode = true;
    }
    if(strstr($nomeVar,'-')){
        $aNomeVar = explode('-',$nomeVar);
        $logExplode = true;
    }
    if($logExplode == false){
        $aNomeVar = explode(' ',$nomeVar);
    }

    if(is_array($aNomeVar)){
        $tam = count($aNomeVar);
        for($i=0;$i<$tam;$i++){
            switch($i){
                case 0:
                    $incr = $aNomeVar[$i];
                    break;
                default:
                    $incr = ucfirst($aNomeVar[$i]) ;
            }
            $novaVar .=$incr;
        }
    }
    if($sufixo <> ''){
        $sufixo = ucfirst($sufixo);
        $novaVar = $this->util_incr_valor($novaVar,$sufixo,'');
    }
    return $novaVar;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convNomeVar ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function removerIndicesArray ------*/

function removerIndicesArray($array,$listaIndices)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aInd = explode(',',$listaIndices);
    if(is_array($aInd)){
        $tam = count($aInd);
        for($i=0;$i<$tam;$i++){
            unset($array[$aInd[$i]]);
        }
    }
    return $array;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function removerIndicesArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function aplicarSubstArray ------*/

function aplicarSubstArray($cmd,$listaCaracterDivisao,$listaCaracterBusca,$listaCaracterSubst)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $novoComando = '';
    $aListaDivisao = explode(',', $listaCaracterDivisao);
    $aListaBusca = explode(',', $listaCaracterBusca);
    $aListaSubst = explode(',', $listaCaracterSubst);
    $qtNiveis = count($aListaDivisao);

    for ($a = 0; $a < $qtNiveis; $a++) {
        if ($a == 0) {
            $array = explode($aListaDivisao[$a], $cmd);
        } else {
            $array = $this->subdividirArray($array, $aListaDivisao[$a]);
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function aplicarSubstArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function subdividirArray ------*/

function subdividirArray($array,$caracterDivisor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tam = count($array);
    for($i=0;$i<$tam;$i++){
        if($caracterDivisor <> '*'){
            $aParte = explode($caracterDivisor,$array[$i]);
            $array[$i] = $aParte;
        }
    }
    return $array;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function subdividirArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function iniciarApl ------*/

function iniciarApl($gerarLinkManual=false,$titulo='',$logBuscaTitulo=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['tit_apl_corrente'])) {$_SESSION['tit_apl_corrente'] = "";}
if (!isset($this->sc_temp_tit_apl_corrente)) {$this->sc_temp_tit_apl_corrente = (isset($_SESSION['tit_apl_corrente'])) ? $_SESSION['tit_apl_corrente'] : "";}
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    if($titulo == '' and $logBuscaTitulo ){
       $titulo = getTitPorCodigo($aplCorrente);
    }
    if($gerarLinkManual){
        $this->sc_temp_tit_apl_corrente =  "$titulo ( <a href='../bl_manual_dinamico/bl_manual_dinamico.php?codigo=$aplCorrente' target='_blank'  >Manual<a/> )";
    }else{
        $this->sc_temp_tit_apl_corrente = $titulo;
    }



if (isset($this->sc_temp_tit_apl_corrente)) {$_SESSION['tit_apl_corrente'] = $this->sc_temp_tit_apl_corrente;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function iniciarApl ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArrayBody ------*/

function getArrayBody($listaNiveis)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    while($lFim or $qtWhile == 100){
        $qtWhile++;
        foreach( $obj as $chave =>$valor ){


            if($valor == 'items'){
                $obj = $obj->$valor;
            }
            if($valor == 'ttRetorno'){
                $obj = $obj->$valor;
                $lRetorno = true;
                continue;
            }
            if($lRetorno){
                $tam = count($obj);
                $qt++;
                $aRet[] = array('codigo'=> $valor->codigo,'descricao'=>$valor->descricao ) ;
                if($qt == $tam -1){
                    $lFim = false;
                }
           }

        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArrayBody ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getValsArrayMultiDin ------*/

function getValsArrayMultiDin($arrayParam, $chavesParam)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $agora = time();
    $usuario = $this->getUsuarioCorrente();
    $escopo = "{$agora}_{$usuario}";
    $varSessao = "resultado_$escopo";
    $this->setVarSessao($varSessao,array());
    $chaveSessao = 'chave_ref_'.$escopo;
    $aChavesParam = explode(',',$chavesParam);
    $this->setVarSessao($chaveSessao,0);
    $ret2 = $this->getValsArrayMultiDinAux($arrayParam,$chavesParam,$varSessao,$chaveSessao);
    $retorno = $this->getVarSessao($varSessao);
    $this->limparVarSessao($varSessao);
    $this->limparVarSessao($chaveSessao);
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getValsArrayMultiDin ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getValsArrayMultiDinAux ------*/

function getValsArrayMultiDinAux($arrayParam, $chavesParam,$varSessaoParam,$chaveSessao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRet = array();
    $retNivel = array();
    $lRetornar = false;
    $iCont = 0;
    $aChave = explode(',',$chavesParam);
    foreach($arrayParam as $chave => $valor ){
        $lRetornar = false;
        if(is_array($valor) or is_object($valor)){
            $retNivel = $this->getValsArrayMultiDinAux($valor,$chavesParam,$varSessaoParam,$chaveSessao);
            $lRetornar = true;
            if(isset($retNivel['log_achou']) and $retNivel['log_achou'] == true){
                $aRet[] = $retNivel;

            }else{
            }

        }else{
            $lAchou = $this->getNumEmLista($chavesParam,$chave);
            if($lAchou){
                $aRet[$chave] = $valor;
                $result = $this->getVarSessao($varSessaoParam);
                $qtResult = count($result);

                $idObjAnt = $this->getVarSessao($chaveSessao);
                if(spl_object_id($arrayParam) <> $idObjAnt){
                    $qtResult++;
                }
                $this->setVarSessao($chaveSessao,spl_object_id($arrayParam));
                $result[$qtResult][$chave] =$valor;
                $this->setVarSessao($varSessaoParam,$result);

            }
            else{
            }
            $aRet['log_achou'] = $lAchou;
        }
    }
    if($lRetornar == true){
        $aRet = $retNivel;
   }
   return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getValsArrayMultiDinAux ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getInputPhpToArq ------*/

function getInputPhpToArq($origem)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $client_data = file_get_contents("php://input");
    $num = idate("U");
    $arquivo = fopen("/tmp/webhook/{$origem}_{$num}.txt",'w');
    if ($arquivo == false) die('Não foi possível criar o arquivo.');

    fwrite($arquivo, $client_data);
    fclose($arquivo);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getInputPhpToArq ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getCondAnoMesPer ------*/

function getCondAnoMesPer($data,$per){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $qt = $per - 1;
    $inicio = 
         $this->nm_data->CalculaData($data, "aaaa-mm-dd", "-", 0, $qt, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
    $dtInicio =  substr($inicio,0,8). "01";
    $anoIni = substr($dtInicio,0,4);
    $mesIni = substr($dtInicio,5,2);
    $cond = '';
    $anoCorrente = $anoIni;
    $mesCorrente = $mesIni - 1;
    for($i=0;$i<$per;$i++)
    {

        $mesCorrente  += 1;
        if($mesCorrente > 12){

            $anoCorrente += 1;
            $mesCorrente = $mesCorrente % 12;

        }
        $cond = $this->util_incr_valor($cond,"(ano = $anoCorrente and mes= $mesCorrente)"," OR ");
    }
    $cond = " ($cond) ";
    return $cond;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getCondAnoMesPer ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getUltDiasMesAnoCorrente ------*/

function getUltDiasMesAnoCorrente($logMesPosterior=1)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $union = '';
    if($logMesPosterior == 1){
        $union = "union
            select distinct dt_referencia as ult
            from pub.repres_sit_cli r1  where dt_referencia    in
            (	select max(dt_referencia) from pub.repres_sit_cli r2
            where dt_referencia >=
            to_date(to_char(month(curdate())) + '/01/' + to_char(year(curdate()))))";
    }
    $sql = "select distinct to_date (to_char(month(dt_referencia)) + '/01/' + to_char(year(dt_referencia))) -1 as ult
  from pub.repres_sit_cli r    
   where 
   dt_referencia >= to_date('02/01/' + to_char(year(curdate())   )   ) 
   $union
   ";
    $aRegs = $this->getRegsSqlLivre($sql,'ult','espec');
    $lista = $this->convArrayMultParaLista($aRegs,'ult');
    $aLista = explode(',',$lista);
    $lista = $this->convArrayParaLista($aLista,true);
    return $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getUltDiasMesAnoCorrente ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getUltDiasMesAnoCorrente2 ------*/

function getUltDiasMesAnoCorrente2()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $sql = "select distinct to_date (to_char(month(dt_referencia)) + '/01/' + to_char(year(dt_referencia))) -1 as ult
  from pub.repres_sit_cli r    
   where 
   dt_referencia >= to_date('02/01/' + to_char(year(curdate())   )   ) 
   ";
    $aRegs = $this->getRegsSqlLivre($sql,'ult','espec');
    var_dump($aRegs);
    $lista = $this->convArrayMultParaLista($aRegs,'ult');
    $aLista = explode(',',$lista);
    $lista = $this->convArrayParaLista($aLista,true);
    return $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getUltDiasMesAnoCorrente2 ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function inserirAspasEmLista ------*/

function inserirAspasEmLista($lista)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaRet = $lista;
    if(strpos($lista,"'") === false){
        $aLista = explode(',',$lista);
        $listaRet = $this->convArrayParaLista($aLista,true);
    }
    return $listaRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function inserirAspasEmLista ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarPubTab ------*/

function retirarPubTab($tabela)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if( strstr( strtolower($tabela),'pub.') <> false){
        $tabela = substr($tabela,4,strlen($tabela) - 4);
    }
    return $tabela;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarPubTab ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function compararExtensaoArq ------*/

function compararExtensaoArq($fileName,$extensao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $extArq = $this->getExtensaoArquivo($fileName);
    return strtolower($extensao) == strtolower($extArq) ;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function compararExtensaoArq ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getExtensaoArquivo ------*/

function getExtensaoArquivo($fileName)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $extensao = '';
    $aFileName = explode('.',$fileName);
    $tam= count($aFileName);
    if($tam > 0){
        $extensao = $aFileName[$tam - 1];

    }
    return $extensao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getExtensaoArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function gravarConteudoArquivo ------*/

function gravarConteudoArquivo($nomeArquivo,$conteudo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
   return file_put_contents($nomeArquivo,$conteudo);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function gravarConteudoArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function execOperMat ------*/

function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function execOperMat ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVlUltPosicaoArray ------*/

function getVlUltPosicaoArray($array)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ultPosicao = '';
    $qt = count($array);
    if($qt > 0){
        $qt -=1;
        $ultPosicao = $array[$qt];
    }
    return $ultPosicao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVlUltPosicaoArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function compararVlUltPosicaoArquivo ------*/

function compararVlUltPosicaoArquivo($array,$vlComparar): bool
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ultPos = $this->getVlUltPosicaoArray($array);
    return strtolower($ultPos) == $vlComparar;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function compararVlUltPosicaoArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVlIndiceArray ------*/

function getVlIndiceArray($array,$indice,$vlPadrao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = '';
    if(is_array($array)){
        foreach ($array as $item) {
            $logSair = false;
            if(isset($item[$indice])){
                $retorno = $item[$indice];
                $logSair = true;
            }else{
                $retorno = $vlPadrao;
            }
            if($logSair){
                break;
            }
        }
    }else{
        $retorno = $vlPadrao;
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVlIndiceArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVlIndiceArrayDireto ------*/

function getVlIndiceArrayDireto($array,$indice,$vlPadrao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(isset($array[$indice])){
        $retorno = $array[$indice];
    }else{
        $retorno = $vlPadrao;
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVlIndiceArrayDireto ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getLastValPostGres ------*/

function getLastValPostGres()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getRegsSqlLivre('select lastval() as id','id','wdfe');
    return  $this->getVlIndiceArray($aReg,'id',0);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getLastValPostGres ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getCurrValPostGres ------*/

function getCurrValPostGres($tabela,$tipo='tabela')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


        if($tipo == 'tabela'){
            $sequencia = "{$tabela}_id_seq";
        }else{
            $sequencia = $tabela;
        }
        $aReg = $this->getRegsSqlLivre("select last_value as id from $sequencia",'id','wdfe');
    return  $this->getVlIndiceArray($aReg,'id',0);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getCurrValPostGres ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArquivoDirRecursiveMultFiltro ------*/

function getArquivoDirRecursiveMultFiltro($diretorio,$filtros,$findFiles='',$tipoRetorno='relativo',$dirRel='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /***********************************************************************************************
     * lê o diretorios passados por parametro e aplica os filtros em cada diretorio
     * até encontrar algum arquivo por aproximação.
     * NÃO É UMA BUSCA EXATA PELO NOME DO ARQUIVO
     * desta função é necessário incluir o projeto sursum classe no sc através do comando
     * sc_include_library("sys", "sursum_classes", "FindFile.php", true, true);
     * **********************************************************************************************/
    if($findFiles == ''){
        $findFiles = new FindFile();
        $findFiles->insertDirectory($diretorio,true);
        echo "<h1>inseri diretorios para busca</h2>";
    }else{
        echo "<h1>instancia aproveitada</h2>";
    }

    $findFiles->emptyFilter();
    $findFiles->emptyFiles();
    if(!is_array($filtros)){
        $aFiltros = explode(',',$filtros);
    }
    if(is_array($aFiltros)){
        foreach($aFiltros as $filtro){
            $findFiles->insertFilter($filtro);
        }
    }
    return array('obj'=>$findFiles,'files'=>$findFiles->setStopFound(true)->find()->getFiles());

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArquivoDirRecursiveMultFiltro ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArquivo ------*/

function getArquivo($diretorio,$dirRel,$filtro,$log,$logTipoRetArq='relativo',$logBuscaPorAprox=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aRet       = '';
    $arquivo    = '';
    $lAchou     = false;
    if($logBuscaPorAprox){
        $dir = new DirectoryIterator( $diretorio );
        $filtro = new RegexIterator( $dir , $filtro );
        foreach ($filtro as $arquivo) {
            $log .="<h1>Arquivo:$arquivo </h1>";
            $arquivo = $this->limparNomeArquivo($arquivo);
            $lAchou =true;
            break;
        }
    }else{
        $separador = $this->getSeparadorArquivo($diretorio);
        $arquivoBusca = "{$diretorio}{$separador}{$filtro}";
        if(file_exists($arquivoBusca)){
            $lAchou = true;
            $arquivo = $filtro;
        }
    }
    if($lAchou){
        if($logTipoRetArq == 'relativo'){
            $dirFinal = $dirRel;
        }else{ //fisico
            $dirFinal = $diretorio;
        }
        $aRet = array('caminho' => "$dirFinal/$arquivo","tipo"=>'','log' => $log);
    }
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function limparNomeArquivo ------*/

function limparNomeArquivo($arquivo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(substr($arquivo,0,2) == '._'){
        $arquivo = substr($arquivo,2, strlen($arquivo) - 2);
    }
    return $arquivo ;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function limparNomeArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArquivoPuro ------*/

function getArquivoPuro($arquivo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $arquivoPuro = '';
    if($arquivo <> ''){
        $separador = $this->getSeparadorArquivo($arquivo);
        $arquivo = str_replace($separador.$separador,$separador,$arquivo);
        $aArquivo = explode($separador,$arquivo);
        if(is_array($aArquivo)){
            $tam = count($aArquivo);
            $arquivoPuro = $aArquivo[$tam - 1 ];
        }
    }else{
    }
    return $arquivoPuro;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArquivoPuro ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getSeparadorArquivo ------*/

function getSeparadorArquivo($arqParam)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(!empty($arqParam)){
        if(strstr($arqParam,'/') <> false){
            $separador ='/';
        }else{
            $separador = '\\';
        }
    }else{
        $separador ='';
    }

    return $separador;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getSeparadorArquivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayToCondSql ------*/

function convArrayToCondSql($array)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /*
    chaves do array: tabela( ou apelido),campo,valor,operador,logSemAspas,oper_cond

    */
    $vlFinal = '';
    $condicao = '';

    foreach($array as $chave=>$valor){
        $tabela      = $valor['tabela'];
        $campo		 = $valor['campo'];
        $campo       = $this->convVlComTraco($campo);
        $vl 		 = $valor['valor'];
        $operador	 = $valor['operador'];
        $logSemAspas = $valor['log_sem_aspas'];
        $operCond	 = $valor['oper_cond'];
        if($chave == 0){
            $juncao = " where ";
        }else{
            $juncao =  $operCond;
        }

        if($logSemAspas){
            $vlFinal = $vl;
        }else{
            $vlFinal = "'$vl'";
        }
        if($tabela <> ''){
            $tabela = $this->convVlComTraco($tabela);
            $campo = "{$tabela}.{$campo}";
        }
        $condicao = $this->util_incr_valor($condicao,"$campo $operador $vlFinal",$juncao);

    }
    return $condicao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayToCondSql ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayMultiToCondSql ------*/

function convArrayMultiToCondSql($array)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /******************************************************************************************************
    chaves do array: condicao,operadorCond,ordem
     * ainda não implementada a ordem
    *******************************************************************************************************/

    $vlFinal   = '';
    $condicao  = '';
    $textoCond = '';
    foreach($array as $chave=>$valor){
        $condicao     = $valor['condicao'];
        $operadorCond = $valor['operador'];
        $ordem        = $valor['ordem'];
        if(is_array($condicao)){
            $tamanho    = count($condicao);
            foreach($condicao as $cond){
                $textoCond  = $this->util_incr_valor($textoCond,$this->convArrayToCondSql($cond))  ;
            }
            if($tamanho > 1){
                $textoCond = "({$textoCond})";
            }
        }else{
            $textoCond = $condicao;
        }
        $condicao = $this->util_incr_valor($condicao,$textoCond,$operadorCond);
    }
    return $condicao;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayMultiToCondSql ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convVlComTraco ------*/

function convVlComTraco($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if(stristr($valor, '-') <> false){
        $valor = "\"$valor\"";
    }
    return $valor;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convVlComTraco ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function inserirArrayCondMultiNivel ------*/

function inserirArrayCondMultiNivel($aFiltroMulti,$filtro,$operador=' and ',$ordem=0)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aFiltroMulti[] = array('condicao'=>$filtro,'operador'=>$operador,'ordem'=>$ordem);
    return $aFiltroMulti;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function inserirArrayCondMultiNivel ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function inserirArrayCond ------*/

function inserirArrayCond($aFiltro,$tabela,$campo,$valor,$operador='=',$logSemAspas=false,$logAceitaBranco=false,$operCond=' and ')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($valor <> '' or ($valor == '' and $logAceitaBranco)){
        $valor = $this->setMascaraPorOper($operador,$valor);
        $operador = $this->convOperador($operador);
        $aFiltro[] = array('tabela'=> $tabela,
            'campo'=> $campo,
            'valor'=> $valor,
            'operador'=> $operador,
            'log_sem_aspas' => $logSemAspas,
            'oper_cond'=> $operCond);
    }
    return $aFiltro;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function inserirArrayCond ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convOperador ------*/

function convOperador($operador):string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch($operador){
        case 'not_in':
            $retorno = "not in";
            break;
        default:
            $retorno = $operador;
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convOperador ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function setMascaraPorOper ------*/

function setMascaraPorOper($operador,$valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno = '';
    $mascara = $this->getMascaraVlSQL($operador);
    if($mascara == ''){
        $retorno = $valor;
    }else{
        $retorno = str_replace('#valor#',$valor,$mascara) ;
    }
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function setMascaraPorOper ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getMascaraVlSQL ------*/

function getMascaraVlSQL($tipo)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $mascara = '';

    switch(strtolower(trim($tipo))){ //minusculo e sem espaço
        case 'like':
            $mascara = '%#valor#%';
            break;
        case 'not_in':
        case 'in':
            $mascara = '(#valor#)';
            break;
    }
    return $mascara;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getMascaraVlSQL ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function gerarFiltroPartes ------*/

function gerarFiltroPartes($cpNumerico,$cpTexto,$condicao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaNums = '';
    $filtro = '';
    $condicao = str_replace('  ', ' ', $condicao); // retira dois espaços
    $aCondTermos = explode(',', $condicao);
    if (is_array($aCondTermos)) {
        $tam = count($aCondTermos);
        for ($i = 0; $i < $tam; $i++) {
            $termo = $aCondTermos[$i];
            if (is_numeric(ltrim(trim($termo)))) {
                $termo = ltrim(trim($termo));
                $listaNums = $this->util_incr_valor($listaNums, $termo, ',');
            }
            else{
                $filtroTexto = gerarFiltroTermo($cpTexto,$termo);
                $filtro = $this->util_incr_valor($filtro, $filtroTexto, ' or ');

            }
        }
    }
    if($listaNums <> '' and $cpNumerico <> ''){
        $listaNums   = $this->retornarOpcoesTxt($listaNums);
        $aListaNums  = explode(',',$listaNums);
        $qt          = count($aListaNums);
        if($qt == 1){
            $incr = " $cpNumerico = $listaNums ";
        }else{
            $incr = " $cpNumerico in($listaNums)";
        }
        $filtro = $this->util_incr_valor($filtro,$incr, " or ") ;
    }
    return $filtro;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function gerarFiltroPartes ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function criarPastas ------*/

function criarPastas($dirBase,$caminho)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $separador =  $this->getSeparadorArquivo($caminho);
    $aCaminho  =  explode($separador,$caminho);
    $dirCompleto = $separador;
    foreach($aCaminho as $dir ){
        $dirCompleto = $this->util_incr_valor($dirCompleto,$dir,$separador,true);
        if( $dirCompleto <> ''){
            if($dirCompleto == $separador){
                echo "<h1>diretorio igual ao separador -> $dirCompleto = $separador   </h1>";
            }else{
                $dirFinal = $this->juntarDirArq($dirBase,$dirCompleto);
                $dirFinal = str_replace("{$separador}{$separador}",$separador,$dirFinal);
                if(trim($dirFinal) <> '' and !is_dir($dirFinal)){
                    mkdir($dirFinal);
                }

            }
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function criarPastas ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function juntarDirArq ------*/

function juntarDirArq($dir,$arquivo){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $separador = $this->getSeparadorArquivo($dir);
    $arquivo = join($separador,array($dir,$arquivo));
    return $arquivo;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function juntarDirArq ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function ziparDir ------*/

function ziparDir($dir,$nomeZip)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
     $zip = new zipArchive;
    $logOK = false;
    if($zip -> open($nomeZip, ZipArchive::CREATE ) === TRUE) {
        $arqs = $this->getArqsDir($dir,true);
        if(is_array($arqs)){
            foreach($arqs as $arq){
                $arquivo  = $this->getArquivoPuro($arq['arquivo']) ;
                $subpasta = $arq['subpasta'];
                if($subpasta <> ''){
                    $arquivo = $subpasta.DIRECTORY_SEPARATOR.$subpasta;
                }
                $zip->addFile($arq,$arquivo);
            }
        }
        $logOK = true;
    }
    $zip->close();

    return $logOK;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function ziparDir ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArqsDirUmNivel ------*/

function getArqsDirUmNivel($dir)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aDir = array();
    $lAchou = false;
    $iCont = 0;
    if (is_dir($dir)) {
        $sepDir = $this->getSeparadorArquivo($dir);
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $arqCompleto =$dir.$sepDir.$file;
                $arqPuro = $this->getArquivoPuro($file);
                if(substr($file,0,1) <> '.' and $arqPuro <> '.' and $arqPuro <> '..'  ) {
                    $aDir[] = array('arquivo'=>$file, 'diretorio'=>is_dir($arqCompleto));
                    $lAchou = true;
                }
            }
            closedir($dh);
        }
    }
    if($lAchou == false ){
      $aDir = '';
    }
    return $aDir;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArqsDirUmNivel ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getArqsDir ------*/

function getArqsDir($dir,$logMultiNivel=false,$subPasta='',$aDir=array())
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $lAchou = false;
    $iCont = 0;
    if (is_dir($dir)) {
        $sepDir = $this->getSeparadorArquivo($dir);
        $iCont = count($aDir);
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                $arqCompleto =$dir.$sepDir.$file;
                $arqPuro = $this->getArquivoPuro($file);
                if(substr($file,0,1) <> '.' and $arqPuro <> '.' and $arqPuro <> '..'   ){
                   if(!is_dir($arqCompleto)){
                       if($logMultiNivel){
                           $aDir[$iCont]['arquivo'] = $file;
                           $aDir[$iCont]['subpasta'] = $subPasta;
                       }else{
                           $aDir[$iCont] = $file;
                       }
                       $iCont++;
                       $lAchou = true;
                   }else{
                       echo "<h1>entrei dir-> $file</h1>";
                       var_dump($aDir);
                       $aDir =  $this->getArqsDir($arqCompleto,true,$this->getArquivoPuro($arqCompleto) ,$aDir);
                       echo "<h1>depois dir </h1>";
                       var_dump($aDir);
                   }
                }else{
                }
            }
            closedir($dh);

        }
    }
    if($lAchou == false ){
        if(is_array($aDir)){
            if(count($aDir) == 0){
                $aDir = '';
            }
        }else{
            $aDir = '';
        }

    }

    return $aDir;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getArqsDir ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getDirRaizWeb ------*/

function getDirRaizWeb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /*$paramDirRelEst = $this->buscarParametroIma("diretorio_raiz_web");
    if($paramDirRelEst == ''){
        $diretorio = $this->getDirRaizWeb()."/";
    }else{
        $diretorio = $paramDirRelEst;
    }*/
    $diretorio = $this->getDirVoltarNivel(__DIR__,2);
    return $diretorio;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getDirRaizWeb ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getDirVoltarNivel ------*/

function getDirVoltarNivel($dir,$qtNiveisVoltar=1)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $novoDir = '';
    $aDir = explode(DIRECTORY_SEPARATOR,$dir);

    if(is_array($aDir)){
        $tam = count($aDir);
        for($i=0;$i < $tam;$i++){
            if($tam - $qtNiveisVoltar > $i){
                $novoDir = $this->util_incr_valor($novoDir,$aDir[$i],DIRECTORY_SEPARATOR,
                    true,
                    true);
            }else{
                break;
            }
        }
    }
    return $novoDir;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getDirVoltarNivel ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getRelDirRaizWeb ------*/

function getRelDirRaizWeb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $paramDirRelEst = $this->buscarParametroIma("diretorio_rel_raiz_web");
    if($paramDirRelEst == ''){
        $diretorio = "";
    }else{
        $diretorio = $paramDirRelEst;
    }
    return $diretorio;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getRelDirRaizWeb ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getBsCDN ------*/

function getBsCDN($versao,$logIncorporar=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $retorno    = '';
    $incorpCss  = '';
    $incorpJs   = '';
    switch($versao){
        case '5':
            if($logIncorporar){
                $incorpCss = $this->util_incr_valor($incorpCss,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'),'');
                $incorpCss  = $this->util_incr_valor($incorpCss,file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'));
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://code.jquery.com/jquery-3.6.3.min.js'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'),'');

                $retorno = <<<RET
                           <style>
                                $incorpCss 
                           </style> 
                           <script>
                                $incorpJs                         
                            </script>
RET;
                return $retorno;
            }
            $retorno = <<<RET
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
           <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
           <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
           
RET;
        case '4':
            if($logIncorporar){
                $incorpCss = $this->util_incr_valor($incorpCss,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://code.jquery.com/jquery-3.6.3.min.js'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js'),'');

                $retorno = <<<RET
                           <style>
                                $incorpCss 
                           </style> 
                           <script>
                                $incorpJs                         
                            </script>
RET;
                return $retorno;
            }
            $retorno = <<<RET
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
RET;
        case '3':
            if($logIncorporar){
                $incorpCss = $this->util_incr_valor($incorpCss,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css'),'');
                $incorpCss = $this->util_incr_valor($incorpCss,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://code.jquery.com/jquery-3.6.3.min.js'),'');
                $incorpJs = $this->util_incr_valor($incorpJs,
                    file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js'),'');

                $retorno = <<<RET
                           <style>
                                $incorpCss 
                           </style> 
                           <script>
                                $incorpJs                         
                            </script>
RET;
                return $retorno;
            }
            $retorno = <<<RET
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
RET;
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getBsCDN ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharCabTbBsHtml ------*/

function desenharCabTbBsHtml($array,$aPropsCab=array()):array
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaChaves = '';
    $cab = '<thead>';
    if(is_array($array)){
        foreach ($array[0] as $key => $value) {
            $chaveBuscada = array_search(trim($key), array_column($aPropsCab, 'chave'));
            $listaChaves = $this->util_incr_valor($listaChaves,$key);
            $label = $key;
            $class= '';
            if(is_int($chaveBuscada) === true ){
                foreach($aPropsCab[$chaveBuscada] as $keyCab => $valorCab){
                    $prop = $valorCab;
                    switch($keyCab){
                        case 'label':
                            $label = $prop;
                            break;
                        case 'class_th':
                            $class = "class='$prop'";
                            break;
                    }
                }

            }
            $cab = $this->util_incr_valor($cab,"<th $class > $label </th>",'');
        }
    }
    $cab = $this->util_incr_valor($cab,"</thead>",'');
    return  array('desenho_cab'=>$cab,'lista_campos_cab'=>$listaChaves);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharCabTbBsHtml ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharDadosTbBsHtml ------*/

function desenharDadosTbBsHtml($array,$listaChaves,$aPropsCps=array())
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $linhas = '';
    $linhas = $this->util_incr_valor($linhas,'<tbody>','');
    $lExistSoma = false;
    $aColsSoma      = array();
    $colTituloSoma  = '';
    if(is_array($array)){
        foreach($array as $key =>$linha)
        {

            $funcao         = '';
            $aParamsFuncao  = '';
            $class          = '';
            $linhas = $this->util_incr_valor($linhas,"<tr>",'');
            $aListaChaves = explode(',',$listaChaves);
            foreach($aListaChaves as $coluna)
            {
                $chaveBuscada = array_search($coluna, array_column($aPropsCps, 'chave'));
                $funcao         = '';
                $aParamsFuncao  = '';
                $class          = '';
                $somar          = false;
                if(is_int($chaveBuscada) === true){

                    foreach($aPropsCps[$chaveBuscada] as $keyCp=> $valorCp){
                        switch($keyCp){
                            case 'funcao':
                                $funcao = $valorCp;
                                break;
                            case 'array_parametros_funcao':
                                $aParamsFuncao = $valorCp;
                                break;
                            case 'class_td':
                                $class = "class='$valorCp'";
                                break;
                            case 'somar':
                                $somar = true;
                                break;
                            case 'titulo_soma':
                                $colTituloSoma = $coluna;
                                break;
                        }
                    }
                }
                $valor = $linha[$coluna];
                $valorSoma = $this->tratarNumero($valor);
                if($somar){
                    $lExistSoma = true;
                    if(!isset($aColsSoma[$coluna])){
                        $aColsSoma[$coluna] = 0;
                    }
                    $aColsSoma[$coluna] += $valorSoma;
                }

                if($funcao <> '' ){
                    if(is_array($aParamsFuncao)){
                        $valor = call_user_func_array(array($this,$funcao),$aParamsFuncao);
                    }else{
                        $valor = call_user_func(array($this,$funcao), $valor);

                    }
                }
                $linhas = $this->util_incr_valor($linhas,"<td $class>$valor</td>",'');
            }
            $linhas = $this->util_incr_valor($linhas,"</tr>",'');
        }
    }
    if($lExistSoma){
        $linhas = $this->util_incr_valor($linhas,"<tr>",'');

        foreach($aListaChaves as $coluna)
        {
            $valor = '';
            $class = 'class="totais"';
            if(isset($aColsSoma[$coluna])){
                $valor = $aColsSoma[$coluna];
                $valor = $this->formatarNumero($valor);
            }
            if($coluna == $colTituloSoma){
                $valor = "TOTAL";
                $class = 'class="totais_lb"';
            }
            $linhas = $this->util_incr_valor($linhas,"<td $class>$valor</td>",'');
        }
        $linhas = $this->util_incr_valor($linhas,"</tr>",'');
    }
    return $this->util_incr_valor($linhas,"</tbody>",'');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharDadosTbBsHtml ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArrayParaTbBSHtml ------*/

function convArrayParaTbBSHtml( $array,$classesTb,$aPropsCab=array(),$aPropsCps=array(),$msgSemDados='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /* aPropsCab -> Propriedades pela chave do array a serem colocadas na tabela.
        exemplo:$aPropsCab[] = array('chave'=>'nome_cliente','label'=> 'Nome', 'class_td'=>'clth', 'funcao'=>'formatarNumero','array_parametros_funcao'=> $aParams )
       aPropsCps -> item aPropsCab mas para o campos
    */
    if(is_array($array))
    {
        if($classesTb <> ''){
            $classesTb = "class='".$classesTb."'";
        }
        $tabela      = "<table $classesTb >";
        $aCab        = $this->desenharCabTbBsHtml($array,$aPropsCab);
        $listaChaves = $aCab['lista_campos_cab'];
        $tabela      = $this->util_incr_valor($tabela,$aCab['desenho_cab'],'');
        $tabela = $this->util_incr_valor($tabela,
            $this->desenharDadosTbBsHtml($array,$listaChaves,$aPropsCps),'') ;
        $tabela =  $this->util_incr_valor($tabela,"</table>",'');

    }else{
        if($msgSemDados == ''){
            $msgSemDados = "<h2>Sem Dados há exibir</h2>";
        }
        $tabela = $msgSemDados;
    }
    return $tabela;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArrayParaTbBSHtml ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharPgHtml ------*/

function desenharPgHtml($aProps)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tituloPagina    = $aProps['titulo_pagina'] ?? '';
    $tituloBody      = $aProps['titulo_body']   ?? '';
    $head            = $aProps['head']   ?? '';
    $body            = $aProps['body']   ?? '';
    $divPrincipal    = $aProps['div_principal']   ?? '';
    if($divPrincipal <> ''){
        $body = "<div $divPrincipal> $tituloBody  $body </div> ";
    }

    $pg = <<<PG
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            $head
            <title>$tituloPagina</title>
        </head>
        <body>
            $body
        </body>
        </html>
PG;
    return $pg;





$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharPgHtml ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getRelacMMToPIXEL ------*/

function getRelacMMToPIXEL()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return 3.779527559055;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getRelacMMToPIXEL ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convMMToPIXEL ------*/

function convMMToPIXEL($mm)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $mm * $this->getRelacMMToPIXEL();

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convMMToPIXEL ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retH ------*/

function retH($hNivel, $texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    echo "<$hNivel>$texto</$hNivel>";

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retH ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getCssComum ------*/

function getCssComum($titulo='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $css= <<<CSS
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>$titulo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .lb{font-weight: bold; text-align:right;}        
        .faturado{color:blue;font-size: 18px;}
        .aberto{color:green;font-size: 18px;}
        .cancelado{color:darkred;font-size: 18px;}
		.naoavaliado{color:orange;font-size: 13px;}
        .aprovado{color:green;font-size: 13px;}
        .reprovado{color:darkred;font-size: 13px;}
        .okNomeCli{color:blue;font-size: 13px;}
        .nokNomeCli{color:red;font-size: 13px;}
        .medioNomeCli{color:orange;font-size: 13px;}
        .vl{color:#2c3034;font-size: 15px;font-weight: bolder}
		.endereco{font-size:12px;}
		.telefone{font-size:12px;}
		.email{font-size:12px;}
		.nome{font-size:13px;}
		.links{font-size:14px;}
		
    </style>

CSS;

    return $css;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getCssComum ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharAlertBS ------*/

function desenharAlertBS($tipo,$texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /*IMPORTANTE: a página que utilizar esta função deve ter a chamada do boostrap . A função getCssComum possui esta chamada.
     * tipo da versão 5.2 boostrap
     * Primary(azul escuro)
     * Secundary(cinza claro)
     * Success(verde claro)
     *danger(vermelho claro)
     * warning(amarelo claro)
     * info(azul claro)
     * light(transparente)
     * dark(cinza escuro)
     * */
    $objeto = <<<OBJ
    <div class="alert alert-$tipo" role="alert">
     $texto
    </div>
OBJ;
    return $objeto;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharAlertBS ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharLinkComoBotaoBS ------*/

function desenharLinkComoBotaoBS($tipo,$texto,$link,$tamanho='',$target='_self',$fontAweasome='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($fontAweasome <> ''){
        $fontAweasome = '<i class="'.$fontAweasome.'"></i>';
    }

    switch (strtolower($tamanho)){
        case 'grande':
            $classTam = "btn-lg";
            break;
        case 'pequeno':
            $classTam = "btn-sm";
            break;
        default:
            $classTam = '';
    }


    $objeto = <<<OBJ
        <a class="btn btn-$tipo" href="$link" role="button" $classTam target="$target">$fontAweasome $texto</a>
OBJ;
    return $objeto;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharLinkComoBotaoBS ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharSpinner ------*/

function desenharSpinner($texto,$tipo='',$style='style="width: 3rem; height: 3rem;"',$formato='spinner-border')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    /*formatos-> spinner-border , spinner-grow
     * no caso do spinner-border pode-se passar a grossura. exemplo:  spinner-border m-5
     * tipos -> text-primary ,  text-secondary , text-success, text-danger, text-warning,text-info,text-light,text-dark
     *
     *
     * */
    $objeto = <<<OBJ
    <div class="$formato $tipo" $style role="status">
        <span class="sr-only">$texto </span>
    </div>
OBJ;
    return $objeto;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharSpinner ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function desenharImagemBs ------*/

function desenharImagemBs($src,$alt='',$altura='',$largura='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $image = <<<IMAGE
    <img src="$src" class="img-thumbnail" alt="$alt" width="$largura" height="$altura">
IMAGE;
    return $image;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function desenharImagemBs ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convArqAbs2Rel ------*/

function convArqAbs2Rel($arquivo,$dirBase='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($dirBase == ''){
        $dirBase = $this->getDirRaizWeb();
    }
    $host           = "http://".$_SERVER['HTTP_HOST']."/";
    return str_replace($dirBase,$host,$arquivo);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convArqAbs2Rel ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function calcPropDiasUteisMes ------*/

function calcPropDiasUteisMes($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aDiasUteis = $this->diasUteisMes();
    if($aDiasUteis){
        $qtDiasMes       = $aDiasUteis['qt_dias_uteis'];
        $qtDias          = $aDiasUteis['qt_dias_passados'];
    }

    $calc = $this->execOperMat('divisao',$valor,$qtDiasMes );
    $calc *= $qtDias;

    return $calc;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function calcPropDiasUteisMes ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getVlUnicoArray ------*/

function getVlUnicoArray($array,$coluna)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aColuna = array_column($array,$coluna);
    $aColuna = array_unique($aColuna);
    return array_values($aColuna);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getVlUnicoArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function retirarColunaArrayMult ------*/

function retirarColunaArrayMult($array,$coluna)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aResultado = array();
    if(is_array($array)){
        foreach ($array as $key => $row) {
            $aResultado[$key]  = $row[$coluna];
        }
    }
    return $aResultado;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function retirarColunaArrayMult ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getValoresFormSC ------*/

function getValoresFormSC($valorProcurado='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRegistro = array();


    foreach($this->nmgp_dados_form as $field => $value) {
        $aRegistro[$field] = $value;
    }
    if($valorProcurado <> ''){
        var_dump($this);
        $this->exibirCaminhoObjeto($this,$valorProcurado,0);
    }

    return $aRegistro;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getValoresFormSC ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function encontrarCaminhoNoObjeto ------*/

function encontrarCaminhoNoObjeto($objeto, $valorProcurado, $pularOcorrencias = 0, $caminhoAtual = []) {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ocorrenciasEncontradas = 0;

    $array = is_object($objeto) ? get_object_vars($objeto) : $objeto;

    foreach ($array as $chave => $valor) {
        $novoCaminho = array_merge($caminhoAtual, [$chave]);

        if ($valor === $valorProcurado) {
            $ocorrenciasEncontradas++;

            if ($ocorrenciasEncontradas > $pularOcorrencias) {
                $ocorrenciasEncontradas = 0;
                return $novoCaminho;
            }
        }

        if (is_object($valor) || is_array($valor)) {
            $resultado = $this->encontrarCaminhoNoObjeto($valor, $valorProcurado, $pularOcorrencias, $novoCaminho);

            if ($resultado !== null) {
                return $resultado;
            }
        }
    }

    if (empty($caminhoAtual)) {
        $ocorrenciasEncontradas = 0;
    }
    return null;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function encontrarCaminhoNoObjeto ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function exibirCaminhoObjeto ------*/

function exibirCaminhoObjeto($objeto, $valor, $pular = 0) {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $caminho = $this->encontrarCaminhoNoObjeto($objeto, $valor, $pular);

    if (is_array($caminho)) {
        echo "Ocorrência #" . ($pular + 1) . ": " . implode(' -> ', $caminho) . PHP_EOL;
    } else {
        echo "Nenhuma ocorrência encontrada após pular $pular vezes" . PHP_EOL;
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function exibirCaminhoObjeto ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function atualizarDtHr ------*/

function atualizarDtHr($dtHr)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $agora = $this->getAgora();
    if(strtotime($dtHr) < strtotime($agora) ){
    $dtHr = $agora;
    }
    return $dtHr;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function atualizarDtHr ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function adicionarCampoPorChave ------*/

function adicionarCampoPorChave(array $array, $chaveFiltro, $valorSetar,$chaveValor = 'valor', string $modo = 'auto'): array {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if ($modo === 'auto') {
        $tamanho = count($array, COUNT_RECURSIVE);
        $modo = ($tamanho > 1000) ? 'iterativo' : 'recursivo';
    }

    return ($modo === 'iterativo')
        ? $this->_processarIterativo($array, $chaveFiltro, $valorSetar,$chaveValor)
        : $this->_processarRecursivo($array, $chaveFiltro, $valorSetar,$chaveValor);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function adicionarCampoPorChave ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function _processarRecursivo ------*/

function _processarRecursivo(array $array, $chaveFiltro, $valorSetar,$chaveValor): array {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = $this->_processarRecursivo($value, $chaveFiltro, $valorSetar,$chaveValor);
        }
    }
    unset($value);

    if (array_key_exists($chaveFiltro, $array)) {
        $array[$chaveValor] = $valorSetar;
    }

    return $array;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function _processarRecursivo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function _processarIterativo ------*/

function _processarIterativo(array $array, $chaveFiltro, $valorSetar,$chaveValor): array {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $stack = [&$array];

    while (!empty($stack)) {
        $current = &$stack[count($stack)-1];
        array_pop($stack);

        foreach ($current as $key => &$value) {
            if (is_array($value)) {
                $stack[] = &$value;
            }
        }
        unset($value);

        if (array_key_exists($chaveFiltro, $current)) {
            $current[$chaveValor] = $valorSetar;
        }
    }

    return $array;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function _processarIterativo ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function removerDuplicados ------*/

function removerDuplicados($array, $chaveUnica, $opcoes = []) {
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $config = array_merge([
        'manter' => 'primeira',   // 'primeira' ou 'ultima'
        'abordagem' => 2,          // 1 (in_array) ou 2 (associativa)
        'registros_sem_chave' => 'ignorar' // 'ignorar' ou 'manter'
    ], $opcoes);

    $resultado = [];
    $valoresVistos = [];

    foreach ($array as $indice => $registro) {
        $chaveExiste = array_key_exists($chaveUnica, $registro);

        if (!$chaveExiste) {
            if ($config['registros_sem_chave'] === 'manter') {
                $resultado[] = $registro;
            }
            continue;
        }

        $valor = $registro[$chaveUnica];

        if ($config['abordagem'] == 1) {
            $valorJaExiste = in_array($valor, $valoresVistos);

            if (!$valorJaExiste) {
                $valoresVistos[] = $valor;
            }

            if ($config['manter'] === 'primeira' && !$valorJaExiste) {
                $resultado[] = $registro;
            } elseif ($config['manter'] === 'ultima') {
                if ($valorJaExiste) {
                    foreach ($resultado as $idx => $item) {
                        if ($item[$chaveUnica] === $valor) {
                            $resultado[$idx] = $registro;
                            break;
                        }
                    }
                } else {
                    $valoresVistos[] = $valor;
                    $resultado[] = $registro;
                }
            }
        }
        else {
            if ($config['manter'] === 'primeira') {
                if (!isset($valoresVistos[$valor])) {
                    $valoresVistos[$valor] = true;
                    $resultado[] = $registro;
                }
            } else { // Manter última
                $valoresVistos[$valor] = $indice;
            }
        }
    }

    if ($config['abordagem'] == 2 && $config['manter'] === 'ultima') {
        $indicesUnicos = array_values($valoresVistos);
        sort($indicesUnicos);

        $temp = [];
        foreach ($indicesUnicos as $indice) {
            $temp[] = $array[$indice];
        }
        $resultado = $temp;
    }

    return $resultado;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function removerDuplicados ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getNomeTbNoSingular ------*/

function getNomeTbNoSingular(string $tableName): string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $parts = explode('_', strtolower($tableName));

    $rules = [
        '/oes$/i' => 'ao',
        '/aes$/i' => 'ao',
        '/is$/i'  => 'il',
        '/eis$/i' => 'el',
        '/ais$/i' => 'al',
        '/ns$/i'  => 'm',
        '/res$/i' => 'r',
        '/zes$/i' => 'z',
        '/ses$/i' => 's',
        '/s$/i'   => '',

        '/ies$/i' => 'y',
        '/ves$/i' => 'f',
        '/oes$/i' => 'o',
        '/xes$/i' => 'x',
    ];

    foreach ($parts as &$part) {
        foreach ($rules as $pattern => $replacement) {
            if (preg_match($pattern, $part)) {
                $part = preg_replace($pattern, $replacement, $part);
                break;
            }
        }
    }

    return implode('_', $parts);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getNomeTbNoSingular ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function getPosicaoChaveArray ------*/

function getPosicaoChaveArray($array,$chaveProcurada)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $pos = null;
    foreach (array_keys($array) as $i => $k) {
        if ($k === $chaveProcurada) {
            $pos = $i;
            break;
        }
    }
   return $pos;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function getPosicaoChaveArray ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function incluiAspasSimples ------*/

function incluiAspasSimples($string){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $string = trim($string);
    if ($string[0] !== "'" && substr($string, -1) !== "'") {
        $string = "'" . $string . "'";
    }

    return $string;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function incluiAspasSimples ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function paraUtf8 ------*/

function paraUtf8(?string $texto,$enconding=''): ?string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if ($texto === null || $texto === '') {
        return $texto;
    }

    if (mb_check_encoding($texto, 'UTF-8')) {
        return $texto;
    }

    if($enconding){
        if(strtolower($enconding) == 'auto'){
            return mb_convert_encoding($texto, 'UTF-8', mb_detect_encoding($texto));
        }else{
            return mb_convert_encoding($texto, 'UTF-8', $enconding);
        }
    }else{
        return mb_convert_encoding($texto, 'UTF-8', [
            'Windows-1252',
            'ISO-8859-1',
            'UTF-8'
        ]);
    }


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function paraUtf8 ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convISO88591ParaUtf8 ------*/

function convISO88591ParaUtf8(?string $texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->paraUtf8($texto,'ISO-8859-1');
    

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convISO88591ParaUtf8 ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function convUtf8ParaISO88591 ------*/

function convUtf8ParaISO88591(?string $texto)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function convUtf8ParaISO88591 ------*/


/*----- Scriptcase Locale: PHP Method: util.php => function textoPdf ------*/

function textoPdf($valor)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if ($valor === null) {
        return '';
    }

    $valor = (string) $valor;

    $valor = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $valor);

    if (!mb_check_encoding($valor, 'UTF-8')) {
        $valor = mb_convert_encoding(
            $valor,
            'UTF-8',
            'Windows-1252, ISO-8859-1'
        );
    }

    return htmlspecialchars(
        $valor,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: util.php => function textoPdf ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosPE ------*/

function buscarPedidosPE($filtroEmp='',$filtroComum='',$filtroEsp='',$filtroContainerPE='', $empresa='MED')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $agora = date("Y_m_d_G_i_s");
    $html = "";
    $aPedidos    = array();
    $lAchou      = false;
    $origem      = '';
    $nrContainer = '';
    $vlLiquido   = 0 ;
    $vlDesconto  = 0 ;
    $naoAprovar = "";
    $iCont = 0;
    $aPedConsider = array();
    $sql = "select pedido.\"cod-estabel\", 
                   pedido.\"nr-pedcli\" , 
                   pedido.\"dt-implant\",
                   pedido.\"cod-emitente\",
                   pedido.\"nome-abrev\", 
                   pedido.\"no-ab-reppri\",                  
                   pedido.\"cod-sit-ped\",
                   pedido.\"cod-sit-aval\",
				   pedido.\"cod-sit-com\",
                   pedido.\"tp-pedido\",                   
                   pedido.\"vl-liq-abe\",
                   pedido.\"val-desconto-total\",
                   pedido.completo,
				   pedido.\"cod-priori\",
				   pedido.\"mo-codigo\",
				   pedido.\"cod-sit-preco\",
                   ped_rep.\"nome-ab-rep\" as rep_nome,
                   ped_rep.\"perc-comis\"
                   from PUB.\"ped-venda\" pedido inner join PUB.\"ped-repre\" ped_rep on 
			       ped_rep.\"nr-pedido\" = pedido.\"nr-pedido\" 
                   where rep_nome <> 'fulano'
                   

                    " ;

    if(strstr($sql,'where') <> false){
        $operador = " and ";
    }else{
        $operador = " where ";
    }
    $sql  = $this->util_incr_valor($sql, $filtroEmp.$filtroComum,$operador);
    switch($empresa)
    {
        case "IMA":
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($ped = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $ped = false;
          $ped_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case "MED":
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($ped = $this->Ini->nm_db_med->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $ped = false;
          $ped_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($ped  === false)
     {
         echo "Erro de acesso. Banco $empresa desconectado!";
         $html .= "<h1> CONSEGUI acesso a base de dados</h1>";
     }
     else
     {
         $html .= "<h1>CONSEGUI acesso a base de dados</h1>";
         while (!$ped->EOF)
         {
             $aPedVendaExt = $this->retornarDadosPedVendaExt($ped->fields[0],$ped->fields[1],$filtroEsp);
             if(is_array($aPedVendaExt) || $filtroEsp == '')
             {
                 if($aPedVendaExt != '')
                 {
                     @$prepPE     = $aPedVendaExt[0]["preposto"];
                     $origem      = $aPedVendaExt[0]["origem"];
                     $nrContainer = $aPedVendaExt[0]["nr-container"];
                     $naoAprovar  = $aPedVendaExt[0]["l-nao-aprovar"];
                 }
                 else
                 {
                     @$prepPE 	 = '' ;
                     $origem   	 = '' ;
                     $nrContainer = '' ;
                     $naoAprovar  = '' ;
                 }

                 if($ped->fields[12] == 0) 
                 {
                     $aTotaisIncompleto =  $this->calcularTotPedIncompleto($ped->fields[0], $ped->fields[1],$ped->fields[4],$ped->fields[13]);
                     $vlLiquido  = $aTotaisIncompleto[0]["liquido"] ;
                     $vlDesconto = $aTotaisIncompleto[0]["desconto"];
                 }

                 else
                 {

                     $vlLiquido  = $ped->fields[10];
                     $vlDesconto = $ped->fields[11];

                 }

                 if($ped->fields[6] == 3  or $ped->fields[6] == 6  ){
                     $atotaisFaturados =$this->calcularTotPedFatur($ped->fields[0],
                         $ped->fields[1],
                         $ped->fields[4],
                         $ped->fields[13]);
                     $vlLiquido  = $atotaisFaturados[0]["liquido"] ;
                     $vlDesconto = $atotaisFaturados[0]["desconto"];

                 }

                 $chave = $ped->fields[0]."_".$ped->fields[1];

                 
                 $this->inserirLogDb('icont - chave',"$iCont - $chave",__FUNCTION__);

                 $aPedidos[] = array(
                     "cod-estabel"        => $ped->fields[0],
                     "nr-pedcli"          => $ped->fields[1],
                     "dt-implant"         => $this->nm_conv_data_db($ped->fields[2],"aaaa-mm-dd","mm/dd/aaaa"),
                     "cod-emitente"       => $ped->fields[3],
                     "nome-abrev"         => $ped->fields[4],
                     "no-ab-reppri"       => $ped->fields[5],
                     "cod-sit-ped"        => $ped->fields[6],
                     "cod-sit-aval"       => $ped->fields[7],
                     "cod-sit-preco"      => $ped->fields[15],
                     "tp-pedido"          => strtoupper($ped->fields[9]),
                     "vl-liq-ped"         => $vlLiquido,
                     "val-desconto-total" => $vlDesconto,
                     "nr-container"       => $nrContainer,
                     "preposto"           => @$prepPE,
                     "origem"             => $origem,
                     "completo"			  => $ped->fields[12],
                     "cod-priori"		  => $ped->fields[13],
                     "mo-codigo"		  => $ped->fields[14],
                     "l-nao-aprovar"      => $naoAprovar,
                     "nome_abrev_repres"  => $ped->fields[16],
                     "perc_repres"		  => $ped->fields[17]
                     
                 );
                 $lAchou = true;
             }
             $ped->MoveNext();

         }
         $ped->Close();
     }
    if($lAchou == false){
        $aPedidos = '';
    }
	return $aPedidos ;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosPE ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosPI ------*/

function buscarPedidosPI($filtroComum , $filtroPI, $desconsiderarPI)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aPedidos = array();
    $lAchou = false;


    $sql = " select PUB.\"pp-ped-venda\".\"cod-estabel\", 
                   PUB.\"pp-ped-venda\".\"nr-pedcli\" , 
                   PUB.\"pp-ped-venda\".\"dt-implant\",
                   PUB.\"pp-ped-venda\".\"cod-emitente\",
                   PUB.\"pp-ped-venda\".\"nome-abrev\",
                   PUB.\"pp-ped-venda\".\"no-ab-reppri\",                  
                   PUB.\"pp-ped-venda\".\"cod-sit-ped\",
                   '0',
				   '0',
                   PUB.\"pp-ped-venda\".\"tp-pedido\",
                   PUB.\"pp-ped-venda\".\"des-pct-desconto-inform\",
                   PUB.\"pp-ped-venda\".\"nr-container\",
                   PUB.\"pp-ped-venda\".preposto,
                   PUB.\"pp-ped-venda\".origem 
              from PUB.\"pp-ped-venda\",PUB.\"pp-container\"            
                        
            ";

    $pedidosPEPI = ''; 
    $joinPPContainer = " and \"pp-container\".situacao = '1' ";
    $sql .= $filtroComum.$filtroPI.$pedidosPEPI.$joinPPContainer ;
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($pedidospi = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $pedidospi = false;
          $pedidospi_erro = $this->Db->ErrorMsg();
      } 

    while (!$pedidosPI->EOF)
    {
        $totPed = $this->retornarTotPedPI($pedidosPI->fields[1], $pedidosPI->fields[4]);

        $aPedidos[] = array(
            "cod-estabel"        => $pedidosPI->fields[0],
            "nr-pedcli"          => $pedidosPI->fields[1],
            "dt-implant"         => $pedidosPI->fields[2],
            "cod-emitente"       => $pedidosPI->fields[3],
            "nome-abrev"         => $pedidosPI->fields[4],
            "no-ab-reppri"       => $pedidosPI->fields[5],
            "cod-sit-ped"        => $pedidosPI->fields[6],
            "cod-sit-aval"       => $pedidosPI->fields[7],
            "cod-sit-preco"      => $pedidosPI->fields[15],
            "tp-pedido"          => strtoupper($pedidosPI->fields[9]),
            "vl-liq-ped"         => $totPed * ( 1 - $pedidosPI->fields[10] / 100),
            "val-desconto-total" => $totPed * $pedidosPI->fields[10] / 100 ,
            "nr-container"       => $pedidosPI->fields[11],
            "preposto"           => $pedidosPI->fields[12],
            "origem"             => $pedidosPI->fields[13]
        );
        $lAchou = true;
        $pedidosPI->MoveNext();
    }
    $pedidosPI->Close();
    if($lAchou == false){
        $aPedidos = '';
    }
    return $aPedidos;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosPI ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function retornarTotPedPI ------*/

function retornarTotPedPI($nrPedCli, $nomeAbrev)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
     
    $sql = "
            select sum(\"vl-preuni\" * \"qt-pedida\") as totped
            from PUB.\"pp-ped-item\" 
            where \"nr-pedcli\" = '$nrPedCli'
            and   \"nome-abrev\" = '$nomeAbrev' 
            and   \"sit-item\" = 1 
          ";
    $totPed = 0;
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $pedidosPIItem = array();
      $pedidospiitem = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $pedidosPIItem[$SCy] [$SCx] = $SCrx->fields[$SCx];
                        $pedidospiitem[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $pedidosPIItem = false;
          $pedidosPIItem_erro = $this->Db->ErrorMsg();
          $pedidospiitem = false;
          $pedidospiitem_erro = $this->Db->ErrorMsg();
      } 

    if ($pedidospiitem  === false)
    {
        echo "Erro de acesso. Mensagem = " . $pedidospiitem_erro ;
    }
    elseif (empty($pedidospiitem ))
    {
        $totPed = 0;
    }
    else
    {
        $totPed = $pedidospiitem[0][0];
	}
	return $totPed;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function retornarTotPedPI ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function retornarContainerPE ------*/

function retornarContainerPE($nrPedcli, $nomeAbrev,$condicao)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    
    $container = '';
    $sql = "select \"nr-container\" from PUB.\"pp-ped-venda\" 
                    where \"nr-pedcli\" = '$nrPedcli' and \"nome-abrev\" = '$nomeAbrev' ";
    $sql .= $condicao;

     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $container = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $container[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $container = false;
          $container_erro = $this->Db->ErrorMsg();
      } 

    if ($container  === false)
    {
        echo "Erro de acesso. Mensagem = " . $container_erro ;
    }
    elseif (empty($container ))
    {
        $container = '';
    }
    else
    {
        $container = $container[0][0];
	}
	return $container;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function retornarContainerPE ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function retornarDadosPedVendaExt ------*/

function retornarDadosPedVendaExt($codEstabel='',$nrPedido='',$filtroEsp='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    
    $prepostoExt = "";
    $origem = "";
    $naoAprovar = "";
    $aPedVendaExt = array();
    if($codEstabel == ''){
        $aCodEstab = $this->getDadosPedVenda($nrPedido,'"cod-estabel"');
        $codEstabel = $aCodEstab[0]['"cod-estabel"'];
    }
    if($nrPedido == "")
    {
        $nrPedido = 0;
    }
    $aReg = $this->getReg('espec','ped-venda-ext','"cod-estabel","nr-pedido"',
        "'$codEstabel','$nrPedido'",
        'preposto, origem,"nr-container","l-nao-aprovar","tp-frete","tp-pagto",tb_preco_id',$filtroEsp);
	
    if($aReg <> ''){
		$prepostoExt    = $aReg[0]['preposto'];
		$origem         = $aReg[0]['origem'];
		$nrContainer    = $aReg[0]['"nr-container"'];
		$naoAprovar     = $aReg[0]['"l-nao-aprovar"'];
		$tpFrete        = $aReg[0]['"tp-frete"'];
		$tbPreco        = $aReg[0]['tb_preco_id'];
		$aPedVendaExt[] = array("preposto" => $prepostoExt,"origem" => $origem ,"nr-container" => $nrContainer,
            "l-nao-aprovar"=>$naoAprovar,'tp-frete' => $tpFrete, "tb_preco_id" =>$tbPreco);
	}else{
		$aPedVendaExt = '';
	}
	return $aPedVendaExt;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function retornarDadosPedVendaExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getNrContainerPedVenda ------*/

function getNrContainerPedVenda($codEstab,$nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aDados = $this->retornarDadosPedVendaExt($codEstab,$nrPedido);
    return $aDados[0]["nr-container"];

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getNrContainerPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getCodEstabPedVenda ------*/

function getCodEstabPedVenda($codEstab,$nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
  $nrContainer = $this->getNrContainerPedVenda($codEstab,$nrPedido);
  return getEstabContainerOrigemPedido($nrContainer,$codEstab);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getCodEstabPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getPrepostoPedVenda ------*/

function getPrepostoPedVenda($codEstab,$nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getPrepostoPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getDescTpFrete ------*/

function getDescTpFrete($tpFrete){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch($tpFrete){
        case 1:
            $desc ='CIF' ;
            break;
        case 2:
            $desc ='CIF PARCIAL' ;
            break;
        case 1:
            $desc ='FOB' ;
            break;

    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getDescTpFrete ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotaisPedVenda ------*/

function calcularTotaisPedVenda($empresa,$filtro)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aTotais = array();
    $sql   = "select sum(\"vl-tot-ped\"), count(\"nr-pedcli\"),sum(\"val-desconto-total\") from PUB.\"ped-venda\" ";
    $sql   =str_replace("''","'''",$sql);
    $sql  .= $filtro;
    switch(substring($empresa,0,1))
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($total  === false)
    {
        echo "Erro de acesso  - calcularTotaisPedVenda. Mensagem = " . $total_erro  ;
    }
    elseif (empty($total ))
    {
        $valor = 0;
        $quant = 0;
        $aTotais[] = array("valor" => $valor, "qte" => $quant);
    }
    else
    {
        $valor = $total[0][0] + $total[0][2] ;
		$quant = $total[0][1];

		$aTotais[] = array("valor" => $valor , "qte" => $quant);
	}
	return $aTotais;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotaisPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotPedIncompleto ------*/

function calcularTotPedIncompleto($empresa, $nrPedcli,$nomeAbrev,$codPriori)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $totalBruto    = 0;
    $totalLiquido  = 0;
    $totalDesconto = 0;
    $aTotais = array();
    $nomeAbrev = str_replace("'","''",$nomeAbrev);
    $sql = <<<SQL
        select sum(ped_item."vl-preuni" *  ped_item."qt-pedida"  * ( mod ( 20 - $codPriori , 10 )  /10 ) ) as desconto,
                    sum(ped_item."vl-preuni" *  ped_item."qt-pedida") as bruto
           from PUB."ped-item" ped_item
           inner join pub."ped-venda" ped
           on ped."nome-abrev" = ped_item."nome-abrev" 
           and ped."nr-pedcli" = ped_item."nr-pedcli"
           where ped."nr-pedcli"   = '$nrPedcli'
           and   ped."nome-abrev" = '$nomeAbrev'
           and   ped."cod-estabel" = '$empresa'  
           and   ped_item."cod-sit-item" <> 6
SQL;




    switch(substr($empresa,0,1))
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;

    }
    if ($total  === false)
    {
        echo "Erro de acesso ou sintaxe. Mensagem = " . $total_erro  ;

    }
    elseif (empty($total ))
    {
        $totalBruto 	= 0;
        $totalDesconto  = 0;
        $totalLiquido	= 0;

    }
    else
    {
        $totalBruto 	= $total[0][1];
		$totalDesconto  = $total[0][0];
		$totalLiquido	= $totalBruto - $totalDesconto;


	}
	$aTotais[] = array("bruto" => $totalBruto,
        "desconto" => $totalDesconto,
        "liquido" => $totalLiquido);
	return $aTotais;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotPedIncompleto ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotPedFatur ------*/

function calcularTotPedFatur($empresa, $nrPedcli,$nomeAbrev,$codPriori)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $totalBruto    = 0;
    $totalLiquido  = 0;
    $totalDesconto = 0;
    $aTotais = array();
    $nomeAbrev = str_replace("'","''",$nomeAbrev);
    $sql = "
 			select sum(\"vl-preori\" *  \"qt-pedida\"  * ( mod ( 20 - $codPriori , 10 )  /10 ) ) as desconto,
                    sum(\"vl-preori\" *  \"qt-pedida\") as bruto
           from PUB.\"ped-item\"
           where \"nr-pedcli\"   = '$nrPedcli'
           and   \"nome-abrev\" = '$nomeAbrev' and \"cod-sit-item\" <> 6

           ";
    switch($empresa)
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
        case '505':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $total = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $total[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $total = false;
          $total_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($total  === false)
    {
        echo "Erro de acesso ou sintaxe. Mensagem = " . $total_erro  ;
    }
    elseif (empty($total ))
    {
        $totalBruto 	= 0;
        $totalDesconto  = 0;
        $totalLiquido	= 0;
    }
    else
    {
        $totalBruto 	= $total[0][1];
		$totalDesconto  = $total[0][0];
		$totalLiquido	= $totalBruto - $totalDesconto;

	}
	$aTotais[] = array("bruto" => $totalBruto,
        "desconto" => $totalDesconto,
        "liquido" => $totalLiquido);
	return $aTotais;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotPedFatur ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosContainer ------*/

function buscarPedidosContainer($empresa,$nrContainer)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $inPedidos = '';
    $sql = "select \"nr-pedido\" from pub.\"ped-venda-ext\"
			where \"nr-container\" = $nrContainer
			and \"cod-estabel\" = '$empresa'
		   "	;
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($pedidos = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $pedidos = false;
          $pedidos_erro = $this->Db->ErrorMsg();
      } 


    while (!$pedidos->EOF)
    {
        if($inPedidos == '')
            $inPedidos = $pedidos->fields[0];
        else
            $inPedidos .= ','.$pedidos->fields[0];

        $pedidos->MoveNext();
    }
    $pedidos->Close();
    return $inPedidos;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function buscarPedidosContainer ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotalPedPI ------*/

function calcularTotalPedPI($empresa,$inNrPedidos,$item,$referencia)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $total = 0;
    if($inNrPedidos == '')
        $inNrPedidos = 0;
    $sql = <<<SQL
        select sum(ped_item."qt-pedida")
		from pub."ped-venda" ped , pub."ped-item" ped_item
	    where ped."nr-pedido" in ($inNrPedidos)
        and   ped_item."nr-pedcli"    =  ped."nr-pedcli"
		and   ped_item."nome-abrev"   =  ped."nome-abrev"
		and   ped_item."cod-sit-item" <> 6   		
        and   ped_item."it-codigo"   = '$item'
        and   ped_item."cod-refer"   = '$referencia'
        and   ped_item."cod-estabel" = '$empresa'
SQL;



    switch(substr($empresa,0,1))
    {
        case '1':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $totped = array();
      if ($SCrx = $this->Ini->nm_db_ima->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $totped[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $totped = false;
          $totped_erro = $this->Ini->nm_db_ima->ErrorMsg();
      } 

            break;
        case '5':
             
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $totped = array();
      if ($SCrx = $this->Ini->nm_db_med->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $totped[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $totped = false;
          $totped_erro = $this->Ini->nm_db_med->ErrorMsg();
      } 

            break;
    }
    if ($totped  === false)
    {
        echo "Erro de acesso. Mensagem = " . $totped_erro ;
    }
    elseif (empty($totped ))
    {
        $total = 0;
    }
    else
    {
        $total = $totped[0][0];
	}
	return $total;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcularTotalPedPI ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function buscarTotalPedPIItem ------*/

function buscarTotalPedPIItem($empresa,$nrContainer,$item,$referencia)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $inPedidos = $this->buscarPedidosContainer($empresa,$nrContainer);
    $total	   = $this->calcularTotalPedPI($empresa,$inPedidos,$item,$referencia);
    return $total;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function buscarTotalPedPIItem ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcularPercDescPedido ------*/

function calcularPercDescPedido($codPrioridade)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $perc = 20 - $codPrioridade;
    $retorno = ($perc % 10)/ 10;
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcularPercDescPedido ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getRegPedVenda ------*/

function getRegPedVenda($nrPedido,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('med','ped-venda','"nr-pedido"',
                    $nrPedido,$campos,$filtroCompl);
    return $aReg;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getRegPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getCampoPedVendaExt ------*/

function getCampoPedVendaExt($codEstabel,$nrPedido,$campo){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $cp = '';
    $tipo     = "unico";
    $tabela   = " pub.\"ped-venda-ext\" ";
    $condicao = "  \"cod-estabel\" = '$codEstabel' and \"nr-pedido\" = $nrPedido";
    $conexao  = "espec";
    $aDados  = $this->getDados($tipo,$tabela,$campo,$condicao,$conexao);
    if(is_array($aDados)){
        $cp = $aDados[0][$campo];

    }
    return $cp;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getCampoPedVendaExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedVendaExt ------*/

function getDadosPedVendaExt($codEstabel,$nrPedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $naoAprovar = "";
    $tipo     = "unico";
    $tabela   = " pub.\"ped-venda-ext\" ";
    $campos   = "\"l-nao-aprovar\" as nao_aprovar";
    $condicao = "  \"cod-estabel\" = $codEstabel and \"nr-pedcli\" = $nrPedido";
    $conexao  = "espec";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $$naoAprovar = $aDados[0]['nao_aprovar'];

    }
    return $naoAprovar;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedVendaExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getPedPercComis ------*/

function getPedPercComis($nrPedido,$nomeRep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $percComis  = 0;
    $tipo     = "unico";
    $tabela   = " pub.\"ped-repre\" ";
    $campos   = "\"perc-comis\" as perc_comis" ;
    $condicao = "\"nr-pedido\" = $nrPedido and \"nome-ab-rep\" = '$nomeRep'";
    $conexao  = "med";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $percComis = $aDados[0]['perc_comis'];
    }
    return $percComis;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getPedPercComis ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getListaPedidosFiltroExt ------*/

function getListaPedidosFiltroExt($filtroEsp,$filtroComum){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $lista = '';
    $aDados = $this->getDados('multi','pub."ped-venda-ext" ped_ext','ped_ext."nr-pedido" as pedido',
        " 1=1 $filtroEsp and $filtroComum",'multi',
        " inner join med.pub.\"ped-venda\" pedido on pedido.\"nr-pedido\" = ped_ext.\"nr-pedido\" 
               inner join med.pub.\"ped-repre\" ped_rep on  pedido.\"nr-pedido\" = ped_rep.\"nr-pedido\" ");
    if(is_array($aDados)){
        foreach($aDados as $reg){
            $lista = $this->util_incr_valor($lista,$reg['pedido']);

        }
    }

    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getListaPedidosFiltroExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getListaPedidosFiltroPedRepre ------*/

function getListaPedidosFiltroPedRepre($filtro){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $lista = '';
    $aDados = $this->getDados('multi','pub."ped-repre" ped_rep','distinct ped_rep."nr-pedido" as pedido',
        "$filtro",'med',
        " inner join pub.\"ped-venda\" pedido on pedido.\"nr-pedido\" = ped_rep.\"nr-pedido\"");
    var_dump($aDados);
    $this->inserirLogDb('filtro comum',$filtro   ,__FUNCTION__);
    $this->inserirLogDb('array de retorno',$aDados,__FUNCTION__);
    if(is_array($aDados)){
        foreach($aDados as $reg){
            $lista = $this->util_incr_valor($lista,$reg['pedido']);
            echo "<h2>Passei Aqui!!!</h2>";
        }
    }

    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getListaPedidosFiltroPedRepre ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getListaNfFiltroPedRepre ------*/

function getListaNfFiltroPedRepre($filtroComum){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $lista = '';
    if(substr($filtroComum,0,4) == ' and'){
        $filtroComum = substr($filtroComum,5,strlen($filtroComum)) ;
    }

    $aDados = $this->getDados('multi','pub."ped-repre" ped_rep',
        'distinct nf."nr-nota-fis" as nf',
        "$filtroComum",'med',
        " inner join pub.\"ped-venda\" pedido on pedido.\"nr-pedido\" = ped_rep.\"nr-pedido\"
                inner join pub.\"nota-fiscal\" nf on 
                pedido.\"nome-abrev\" = nf.\"nome-ab-cli\"
                and pedido.\"nr-pedcli\" = nf.\"nr-pedcli\" inner join pub.\"natur-oper\" nat on
                nf.\"nat-operacao\" = nat.\"nat-operacao\" 
                 and nat.\"tp-rec-desp\" = 1 and nat.\"tipo-compra\" <> 3");
    if(is_array($aDados)){
        foreach($aDados as $reg){
            $lista = $this->util_incr_valor($lista,"'".$reg['nf']."'");
        }
    }
    if($lista == ''){
        $lista ="'0'";
    }


    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getListaNfFiltroPedRepre ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getListaDevNfFiltroPedRepre ------*/

function getListaDevNfFiltroPedRepre($filtroComum){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $lista = '';
    if(substr($filtroComum,0,4) == ' and'){
        $filtroComum = substr($filtroComum,5,strlen($filtroComum)) ;
    }

    $aDados = $this->getDados('multi','pub."ped-repre" ped_rep','distinct venda."nr-nota-fis" as venda',
        "$filtroComum",'med',
        " inner join pub.\"ped-venda\" ped on ped.\"nr-pedido\" = ped_rep.\"nr-pedido\"
                inner join pub.\"nota-fiscal\" venda on 
                ped.\"nome-abrev\" = venda.\"nome-ab-cli\"
                and ped.\"nr-pedcli\" = venda.\"nr-pedcli\" inner join pub.\"natur-oper\" nat on
                venda.\"nat-operacao\" = nat.\"nat-operacao\" inner join pub.\"devol-cli\" relacto_venda on
                venda.\"nat-operacao\" =  relacto_venda.\"nat-operacao\" inner join PUB.\"docum-est\" dev on 
                relacto_venda.\"serie-docto\"     = dev.\"serie-docto\" and
                 relacto_venda.\"nro-docto\"       = dev.\"nro-docto\"
                 and nat.\"tp-rec-desp\" = 1 and nat.\"tipo-compra\" <> 3");
    if(is_array($aDados)){
        foreach($aDados as $reg){
            $lista = $this->util_incr_valor($lista,"'".$reg['nf']."'");
        }
    }
    if($lista == ''){
        $lista ="'0'";
    }


    return $lista;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getListaDevNfFiltroPedRepre ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedRepre ------*/

function getDadosPedRepre($pedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aRet = array();
    $lAchou = false;
    $aDados = $this->getDados('multi','pub."ped-repre"','"nr-pedido","nome-ab-rep","perc-comis"',
        "pub.\"ped-repre\".\"nr-pedido\" = $pedido and pub.\"ped-repre\".\"nome-ab-rep\" <> 'fulano'",'med');
    if(is_array($aDados)){
        foreach($aDados as $reg){
            $lAchou =true;
            $ped       = $reg['"nr-pedido"'];
            $nomeRep   = $reg['"nome-ab-rep"'];
            $percComis = $reg['"perc-comis"'];
            $aRet[] = array(

                'rep' =>  $nomeRep,
                'comis' => $percComis,
                'ped' => $ped

            );
        }
    }
    if($lAchou == false){
        $aRet = '';
    }

    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedRepre ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getVlsPedVenda ------*/

function getVlsPedVenda($sitPed,$completo,$estab,$nrPedido,$nomeAbrev,$priori,$vlLiqAbe,$valDescTot){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $vlLiquido  = $vlLiqAbe;
    $vlDesconto = $valDescTot;

    if($completo == 0) 
    {
        $aTotaisIncompleto =  $this->calcularTotPedIncompleto($estab, $nrPedido,$nomeAbrev,$priori);
        $vlLiquido  = $aTotaisIncompleto[0]["liquido"] ;
        $vlDesconto = $aTotaisIncompleto[0]["desconto"];
    }

    if($sitPed == 3  or $sitPed == 6  ){
        $atotaisFaturados =$this->calcularTotPedFatur($estab,$nrPedido,
            $nomeAbrev,
            $priori);
        $vlLiquido  = $atotaisFaturados[0]["liquido"] ;
        $vlDesconto = $atotaisFaturados[0]["desconto"];

    }

    return array('vl_liq' => $vlLiquido, 'vl_desc'=> $vlDesconto);




$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getVlsPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getTabPrecoPedVendaExt ------*/

function getTabPrecoPedVendaExt($codEstabel,$nrPedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $tbPreco  = "";
    $tipo     = "unico";
    $tabela   = " pub.\"ped-venda-ext\" ";
    $campos   = "tb_preco_id";
    $condicao = "  \"cod-estabel\" = $codEstabel and \"nr-pedcli\" = $nrPedido";
    $conexao  = "espec";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $tbPreco = $aDados[0]['tb_preco'];

    }
    return $tbPreco;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getTabPrecoPedVendaExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedVenda ------*/

function getDadosPedVenda($nrPedido,$campos='',$codEstab='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $tipo     = "unico";
    $tabela   = " pub.\"ped-venda\" ";
    if($codEstab <> ''){
        $condicao = " \"cod-estabel\" = '$codEstab' and \"nr-pedido\" = $nrPedido";
    }else{
        $condicao = " \"nr-pedido\" = $nrPedido";
    }
    $conexao  = "med";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getEstabPedVenda ------*/

function getEstabPedVenda($nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cpCodEstab = '"cod-estabel"';
    $a = $this->getDadosPedVenda($nrPedido,$cpCodEstab);
    return $this->getVlIndiceArray($a,$cpCodEstab,'');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getEstabPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getCondPagtoPedVenda ------*/

function getCondPagtoPedVenda($nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cond = '';
    $aReg = $this->getDadosPedVenda($nrPedido,'"cod-cond-pag" as cond');
    if(is_array($aReg)){
        $cond = $aReg[0]['cond'];
    }
    return $cond;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getCondPagtoPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getTpPagtoPedVendaExt ------*/

function getTpPagtoPedVendaExt($nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tpPagto  = "";
    $tipo     = "unico";
    $tabela   = " pub.\"ped-venda-ext\" ";
    $campos   = "\"tp-pagto\" as tp_pagto" ;
    $condicao = " \"nr-pedido\" = $nrPedido and \"cod-estabel\" = 5";
    $conexao  = "espec";
    $aDados  = $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);
    if(is_array($aDados)){
        $tpPagto = $aDados[0]['tp_pagto'];

    }
    return $tpPagto;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getTpPagtoPedVendaExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getPedTbRubiX ------*/

function getPedTbRubiX($nrPedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $rubiX = "";
    $condicao = "ped.\"nr-pedido\" = $nrPedido and ped.\"cod-estabel\" = 5";
    $aDados = $this->getDados('multi','pub."ped-venda-ext" as ped','l_tab_x',
        $condicao,'espec');
    if($aDados){
        $rubiX = $aDados[0]["l_tab_x"];
    }
    return $rubiX;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getPedTbRubiX ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getCidadeUfDestPedVenda ------*/

function getCidadeUfDestPedVenda($codEstabel,$nrPedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $codEmit    = '';
    $nomeAbrevTri = '';
    $aDadosEmit = array();

    $condicao = " ped.\"cod-estabel\" = $codEstabel and ped.\"nr-pedido\" = $nrPedido ";

    $aDados = $this->getDados('multi','PUB."ped-venda" as ped','"cod-emitente","nome-abrev-tri"',
        $condicao,'med');


    if($aDados){
        $codEmit      = $aDados[0]['"cod-emitente"'];
        $nomeAbrevTri = $aDados[0]['"nome-abrev-tri"'];
    }

    if($aDados){
        if($nomeAbrevTri <> ''){
            $aDadosEmit = $this->getDados('multi','PUB.emitente as emit','cidade,estado',
                'emit."nome-abrev" = '."'$nomeAbrevTri'",'comum');
        }else{
            $aDadosEmit = $this->getDados('multi','PUB.emitente as emit','cidade,estado',
                'emit."cod-emitente" = '.$codEmit,'comum');
        }
    }


    return $aDadosEmit;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getCidadeUfDestPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function verificaRestricaoPedVenda ------*/

function verificaRestricaoPedVenda($arrayRestris,$codPriori=10){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaRestr = '';
    $resPreco   = '';
    $resFrete   = '';
    $resComis   = '';
    $resNaoAprovar = '';
    $resCredito = '';
    $desconto = '';
    if($arrayRestris){

            $preco      = $arrayRestris['preco_res'];
            $frete      = $arrayRestris['frete_res'];
            $comis      = $arrayRestris['comis_res'];
            $naoAprovar = $arrayRestris['nao_aprovar_res'];
            $credito    = $arrayRestris['credito_res'];
            $desconto   = $arrayRestris['desconto_res'];
            if($preco <> 2){
                $resPreco = 'Preço não aprovado';
                $listaRestr = $this->util_incr_valor($listaRestr,$resPreco,' - ');
            }
            if($frete <> 2){
                $resFrete = 'Frete não aprovado';
                $listaRestr = $this->util_incr_valor($listaRestr,$resFrete,' - ');
            }
            if($comis <> ''){
                $resComis = 'Comissão não aprovada';
                $listaRestr = $this->util_incr_valor($listaRestr,$resComis,' - ');
            }
            if($naoAprovar){
                $resNaoAprovar = 'Não aprovar';
                $listaRestr = $this->util_incr_valor($listaRestr,$resNaoAprovar,' - ');
            }
            if($credito <> 2 and $credito <> 3){
                $resCredito = 'Credito não aprovado';
                $listaRestr = $this->util_incr_valor($listaRestr,$resCredito,' - ');
            }
            if($desconto <> 2 and $codPriori > 10){
                $desconto = 'Desconto não aprovado';
                $listaRestr = $this->util_incr_valor($listaRestr,$desconto,' - ');
            }

    }

    return $listaRestr;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function verificaRestricaoPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getSitEtqPedItemExt ------*/

function getSitEtqPedItemExt($codEstab,$nrPedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aReg = $this->getReg('espec','"ped-venda-ext"',
        '"cod-estabel","nr-pedido"',"$codEstab,$nrPedido",'"l-etiqueta"');

    $reg = $aReg[0]['"l-etiqueta"'];

    return $reg;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getSitEtqPedItemExt ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getSitAvalPedVenda ------*/

function getSitAvalPedVenda($codEstab,$nrPedido,$nomeAbrev){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aSitsPed = array();
    $lAval = false;
    $lAvalCredito = false;
    $campos   = 'ped."cod-sit-preco" as preco, ped."cod-sit-com" as frete, ped."cod-sit-aval" as credito, ped_rep."cod-classificador" as comis';
    $condicao = "ped.\"cod-estabel\" = $codEstab and ped.\"nr-pedido\" = $nrPedido and ped.\"nome-abrev\" = '$nomeAbrev'";
    $inner    = "inner join pub.\"ped-repre\" ped_rep on ped_rep.\"nome-ab-rep\" = ped.\"no-ab-reppri\" and ped_rep.\"nr-pedido\" = ped.\"nr-pedido\"";
    $aDados = $this->getDados('multi','PUB."ped-venda" ped',$campos,$condicao,'med',$inner);
    if($aDados){
        $avalPreco   = $aDados[0]['preco'];
        $avalFrete   = $aDados[0]['frete'];
        $avalCredito = $aDados[0]['credito'];
        $avalComis   = $aDados[0]['comis'];
        if($avalCredito == 2 or $avalCredito == 3){
            $lAvalCredito = true;
        }
        if($avalPreco == 2 and $avalFrete == 2 and $avalComis == '' and $lAvalCredito){
            $lAval = true;
        }
    }

    return $aSitsPed = array(
        'log_aval'     => $lAval,
        'aval_preco'   => $avalPreco,
        'aval_frete'   => $avalFrete,
        'aval_credito' => $avalCredito,
        'aval_comis'   => $avalComis
    );


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getSitAvalPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedParcela ------*/

function getDadosPedParcela($nePedido){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aDadosPed = array();
    $lConfPagto = '';
    $dtSolic   = '';
    $dtPagto   = '';
    $user      = '';
    $condicao = "ped.\"nr-pedido\" = $nePedido";
    $campos   = '"dt-solic","dt-pagto",usuario as usuar,log_confirma_pagto';
    $aDados   = $this->getDados('multi',"PUB.\"ped-parcela\" ped",$campos,$condicao,'espec');
    if($aDados){
        $dtSolic    = $aDados[0]['"dt-solic"'];
        $dtSolic    = date('d/m/Y', strtotime($dtSolic));
        $dtPagto    = $aDados[0]['"dt-pagto"'];
        $dtPagto    = date('d/m/Y', strtotime($dtPagto));
        $user       = $aDados[0]['usuar'];
        $lConfPagto = $aDados[0]['log_confirma_pagto'];
    }
    return $aDadosPed = array(
        'dt_solic'       => $dtSolic,
        'dt_pagto'       => $dtPagto,
        'usr'            => $user,
        'log_conf_pagto' => $lConfPagto
    );


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getDadosPedParcela ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcDiasAtrasoPagtoPed ------*/

function calcDiasAtrasoPagtoPed($estab,$diasParam,$data){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dataFim = '';
    $condicao = "calend.\"cod-estabel\" = $estab and calend.\"tipo-dia\" = 1 and calend.data >= '$data'";
    $aDados = $this->getDados('multi','PUB."calen-coml" calend','data',$condicao,'comum');
    if($aDados){
        $datafim = $aDados[$diasParam]['data'];
    }
    return $datafim;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcDiasAtrasoPagtoPed ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function criaPedParcela ------*/

function criaPedParcela($codEstab,$nrPedido,$vlSolic,$vlDesc,$usuario){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $dtSolicitacao = date('Y-m-d');
    $dtPagto       = $this->calcDiasAtrasoPagtoPed($codEstab,3,$dtSolicitacao);


    $cmd = "insert into PUB.\"ped-parcela\" (\"cod-estabel\",\"nr-pedido\",\"vlr-solic\",\"vl-desconto\",
                                 \"dt-solic\",\"dt-pagto\",usuario)
                    values('$codEstab',$nrPedido,$vlSolic,$vlDesc,'$dtSolicitacao','$dtPagto','$usuario')";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function criaPedParcela ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function confirmaPagtoPedAVista ------*/

function confirmaPagtoPedAVista($nrPedido)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cmd = " update pub.\"ped-parcela\" set log_confirma_pagto = 1 
                            where pub.\"ped-parcela\".\"nr-pedido\" = $nrPedido";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function confirmaPagtoPedAVista ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getNumPedidosComReservaEssp0154 ------*/

function getNumPedidosComReservaEssp0154(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $listaPeds = '';
    $campos = 'distinct ped."nr-pedcli" as num_pedido';
    $condicao = " ped.\"cod-sit-ped\" = 1 and ped.\"tp-pedido\" = 'PE' and (ped.\"cod-sit-aval\" = 2 or ped.\"cod-sit-aval\" = 3) and ped.completo = 1
and ped_rep.\"nome-ab-rep\" <> 'fulano' and ped.\"cod-sit-preco\" = 2 and ped.\"cod-sit-com\" = 2 and ped_ext.\"l-etiqueta\" = 1 and ped_ext.\"l-nao-aprovar\" = 0";
    $inner = " inner join PUB.\"ped-venda-ext\" ped_ext on ped_ext.\"cod-estabel\" = ped.\"cod-estabel\"
and ped_ext.\"nr-pedido\" = ped.\"nr-pedido\" and ped_ext.\"nome-abrev\" = ped.\"nome-abrev\"
inner join med.PUB.\"ped-repre\" ped_rep on ped_rep.\"nr-pedido\" = ped.\"nr-pedido\" and ped_rep.\"nome-ab-rep\" = ped.\"no-ab-reppri\" 
inner join PUB.\"ped-item-rom\" ped_rom on ped.\"cod-estabel\" = ped_rom.\"cod-estabel\" and ped.\"nr-pedido\" = ped_rom.\"nr-pedcli\" and ped.\"nome-abrev\" = ped_rom.\"nome-abrev\"";
    $aDados = $this->getDados('multi','med.pub."ped-venda" ped',$campos,$condicao,'multi',$inner);
    if($aDados){
        foreach ($aDados as $d){
            $numPedido = $d['num_pedido'];
            $listaPeds = $this->util_incr_valor($listaPeds,$numPedido,',');
        }
    }

    return $listaPeds;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getNumPedidosComReservaEssp0154 ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function calcVlTotPed10 ------*/

function calcVlTotPed10($numPed,$nomAbrev){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $vlPed = 0;
    $condicao = "ped_item.\"nr-pedcli\" = $numPed and ped_item.\"nome-abrev\" = '$nomAbrev' and (\"cod-sit-item\" = 1 or \"cod-sit-item\" = 3)";
    $aItens = $this->getDados('multi','PUB."ped-item" ped_item','"qt-pedida","vl-preori"',$condicao,'med');
    if($aItens){
        foreach ($aItens as $itens){
            $qt = $itens['"qt-pedida"'];
            $vl = $itens['"vl-preori"'];
            $vl = $vl*$qt;
            $vlPed += $vl;
        }
    }

    return $vlPed;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function calcVlTotPed10 ------*/


/*----- Scriptcase Locale: PHP Method: pedvenda.php => function getQtPedsAberto ------*/

function getQtPedsAberto($nomRepIni,$nomRepFim,$tpUsuar='representante',$listaCodRep=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  


    $inner = "inner join pub.\"ped-repre\" ped_rep on ped_rep.\"nr-pedido\" = ped.\"nr-pedido\"
                and  ped_rep.\"nome-ab-rep\" = ped.\"no-ab-reppri\"";
    if($tpUsuar == 'representante'){
        $condicao = "ped.\"cod-sit-ped\" not in (3,6) and ((completo = 1 and \"tp-pedido\" ='PE') 
        or (\"tp-pedido\" = 'PI')) and ped_rep.\"nome-ab-rep\" <> 'fulano'
        and ped.\"no-ab-reppri\" >= '$nomRepIni' and ped.\"no-ab-reppri\" <= '$nomRepFim'";
    }else{
        $listaNomeReps = $this->retornaListaNomeRepsRestrUsuar($listaCodRep);
        $condicao = "ped.\"cod-sit-ped\" not in (3,6) and ((completo = 1 and \"tp-pedido\" ='PE') 
        or (\"tp-pedido\" = 'PI')) and ped_rep.\"nome-ab-rep\" <> 'fulano'
        and ped.\"no-ab-reppri\" in ($listaNomeReps)";
    }
    $aDados = $this->getDados('multi','pub."ped-venda" ped',
        'ped."nr-pedido" as num_ped, ped."no-ab-reppri" as rep_nome',$condicao,'med',$inner);
    if($aDados){
        $qtPeds = count($aDados);
    }else{
        $qtPeds = 0;
    }
    return $qtPeds;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: pedvenda.php => function getQtPedsAberto ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function existMetaAnoMes ------*/

function existMetaAnoMes($mes,$ano)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
  $tabela   = " metas_repres ";
  $campos   = " meta_repres_id ";
  $condicao = "  mes = $mes e ano = $ano ";
  $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
  if(is_array($aResult)){
     $retorno = true;
  }else{
     $retorno = false;
  }
  return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function existMetaAnoMes ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getIdAnoMesRepres ------*/

function getIdAnoMesRepres($mes,$ano,$repres)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tabela   = " pub.metas_repres ";
    $campos   = " meta_repres_id ";
    $condicao = "  mes = $mes and ano = $ano and cod_repres = $repres ";
    $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aResult)){
        $retorno = $aResult[0]['meta_repres_id'];
    }else{
        $retorno = 0;
    }
    return $retorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getIdAnoMesRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getDadosMetaRepres ------*/

function getDadosMetaRepres($id,$campos='',$cond='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $condicao = '';
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','metas_repres');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.metas_repres ";
    if($id <> 0){
        $condicao = "  meta_repres_id = $id ";
    }

    if($cond <> ''){
        $condicao .= $cond;
    }
    $aResult = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aResult;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getDadosMetaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaPerfilMesCorrente ------*/

function getMetaPerfilMesCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['codRepFim'])) {$_SESSION['codRepFim'] = "";}
if (!isset($this->sc_temp_codRepFim)) {$this->sc_temp_codRepFim = (isset($_SESSION['codRepFim'])) ? $_SESSION['codRepFim'] : "";}
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
  
    $anoAtual = $this->getParteDtCorrente('ano');
    $mesAtual = $this->getParteDtCorrente('mes');
    $meta     = 0;
    $tabela   = " pub.metas_repres ";
    $campos   = " sum(vl_meta) as vl_meta ";
    $condicao = "  ano = $anoAtual and mes = $mesAtual and cod_repres >= $this->sc_temp_codRepIni and cod_repres <= $this->sc_temp_codRepFim ";
    $aRet = $this->retornoMultReg($tabela,$campos,$condicao);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $meta += $aRet[$i]['vl_meta'];
        }
    }
    return $meta;


if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
if (isset($this->sc_temp_codRepFim)) {$_SESSION['codRepFim'] = $this->sc_temp_codRepFim;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaPerfilMesCorrente ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getUltMesMetaRepres ------*/

function getUltMesMetaRepres()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aResult = $this->getDadosMetaRepres(0,'ano,mes',
        "meta_repres_id in (select top 1 meta_repres_id from pub.metas_repres mr2
         order by  to_char(ano) + '_' + to_char(mes) desc)");
    return $aResult;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getUltMesMetaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getlistaIdRepresMetaAnoMes ------*/

function getlistaIdRepresMetaAnoMes($ano,$mes)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tabela   = " pub.metas_repres ";
    $campos   = " cod_repres ";
    $condicao = "  ano = $ano and mes = $mes ";
    $lista = '';
    $aResult = $this->retornoMultReg($tabela,$campos,$condicao,"espec");
    if(is_array($aResult))	{
        $tam = count($aResult);
        for($i=0;$i<$tam;$i++){
            $codRepres = $aResult[$i]['cod_repres'];
            $lista = $this->util_incr_valor($lista,$codRepres);
        }
    }
    return $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getlistaIdRepresMetaAnoMes ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function inserirMetaRepres ------*/

function inserirMetaRepres($ano,$mes,$repres,$meta,$tipoMeta='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch($tipoMeta){
        case '': 
            $cp = 'vl_meta';
            break;
        case 'quinzenal': 
            $cp = 'vl_meta_quinz';
            break;
        case 'cli_atend': 
            $cp = 'qt_cli_meta';
            break;
    }

    $cmd = "insert into pub.metas_repres(meta_repres_id,ano,mes,cod_repres,$cp)
            values(pub.seq_meta_repres.NEXTVAL,$ano,$mes,$repres,'$meta')";
    
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
      
    $ultSeq = $this->buscarVlSequenciaEspec('seq_meta_repres','metas_repres');

    return $ultSeq;
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function inserirMetaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function atualizarMetaRepres ------*/

function atualizarMetaRepres($id,$meta,$tipoMeta)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    switch($tipoMeta){
        case '': 
            $cp = 'vl_meta';
            break;
        case 'quinzenal': 
            $cp = 'vl_meta_quinz';
            break;
        case 'cli_atend': 
            $cp = 'qt_cli_meta';
            break;
    }
    $cmd = "update pub.metas_repres set $cp ='$meta' where 
            meta_repres_id = $id";
    
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
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function atualizarMetaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function sincrMetaRepres ------*/

function sincrMetaRepres($ano,$mes,$repres,$meta,$tipo='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $id = $this->getIdAnoMesRepres($mes,$ano,$repres);
    if($id == 0){
        $id = $this->inserirMetaRepres($ano,$mes,$repres,$meta,$tipo);
        $acao = "Inclusão";
    }else{
        $this->atualizarMetaRepres($id,$meta,$tipo);
        $acao = "Alteração";
    }
    return array('id' =>$id, 'acao' => $acao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function sincrMetaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaCorrentePorListaRepres ------*/

function getMetaCorrentePorListaRepres($listaCodRep,$mes='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $anoAtual = $this->getParteDtCorrente('ano');
    $mesAtual = $this->getParteDtCorrente('mes');
    $filtro = "and ano = $anoAtual and mes = $mesAtual";
    if($mes <> ''){
        $filtro = "and ano = $anoAtual and mes = $mes";
    }
    $retorno = $this->getMetaPorListaRepres($listaCodRep,$filtro);
    return $retorno;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaCorrentePorListaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaPorListaRepres ------*/

function getMetaPorListaRepres($listaCodRep,$filtro='')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['codRepIni'])) {$_SESSION['codRepIni'] = "";}
if (!isset($this->sc_temp_codRepIni)) {$this->sc_temp_codRepIni = (isset($_SESSION['codRepIni'])) ? $_SESSION['codRepIni'] : "";}
  

    $aMeta = array();
    $aMetaQunz = array();
    $vlMetaTotal = 0;
    $vlMetaTotalQuinz = 0;
    $vlMetaCorrente = 0;
    $vlMetaQuinzCorrente = 0;
    $vlMetaGeral = 0;
    $vlMetaQuinzGeral = 0;
    if($listaCodRep == ''){
        $listaCodRep = 0;
    }
    $tabela   = " pub.metas_repres ";
    $campos   = " vl_meta, cod_repres, vl_meta_quinz ";
    $condicao = "  cod_repres in($listaCodRep) ";
    $condicao.=$filtro;
     $aRet = $this->retornoMultReg($tabela,$campos,$condicao,'espec');
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $codRepres      = $aRet[$i]['cod_repres'];
            $vlMeta         = $aRet[$i]['vl_meta'];
            $vlMetaQuinz    = $aRet[$i]['vl_meta_quinz'];
            $aMeta[$codRepres]     = $vlMeta;
            $aMetaQunz[$codRepres] = $vlMetaQuinz;
            if($codRepres == $this->sc_temp_codRepIni){
                $vlMetaCorrente      = $vlMeta;
                $vlMetaQuinzCorrente = $vlMetaQuinz;
            }else{
                $vlMetaTotal      += $vlMeta;
                $vlMetaTotalQuinz += $vlMetaQuinz;
            }
        }
        $vlMetaGeral = $vlMetaCorrente + $vlMetaTotal;
        $vlMetaQuinzGeral = $vlMetaQuinzCorrente + $vlMetaTotalQuinz;
    }
    return array( 'vl_meta_corrente' => $vlMetaCorrente,'meta_vend' => $aMeta,
                  'vl_total_sem_corrente' => $vlMetaTotal,
                  'vl_total' => $vlMetaGeral,
                  'vl_meta_quinz_corrente' => $vlMetaQuinzCorrente,'meta_vend_quinz' => $aMetaQunz,
                  'vl_total_quinz_sem_corrente' => $vlMetaTotalQuinz,
                  'vl_quinz_total' => $vlMetaQuinzGeral);

if (isset($this->sc_temp_codRepIni)) {$_SESSION['codRepIni'] = $this->sc_temp_codRepIni;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaPorListaRepres ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaMesCorrente ------*/

function getMetaMesCorrente($mes='',$tpMeta='mensal')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $anoAtual = $this->getParteDtCorrente('ano');
    $mesAtual = $this->getParteDtCorrente('mes');
    $meta     = 0;
    $tabela   = " pub.metas_repres ";
    if($tpMeta == 'quinzenal'){
        $campos   = " sum(vl_meta_quinz) as vl_meta ";
    }else{
        $campos   = " sum(vl_meta) as vl_meta ";
    }

    $condicao = "  ano = $anoAtual and mes = $mesAtual ";
    if($mes <> ''){
        $condicao = "  ano = $anoAtual and mes = $mes ";
    }
    $aRet = $this->retornoMultReg($tabela,$campos,$condicao);
    if(is_array($aRet))	{
        $tam = count($aRet);
        for($i=0;$i<$tam;$i++){
            $meta += $aRet[$i]['vl_meta'];
        }
    }
    return $meta;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaMesCorrente ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaQuinzenalCor ------*/

function getMetaQuinzenalCor($codrep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ano = date('Y');
    $mes = date('m');
    $aReg = $this->getReg('espec','metas_repres','cod_repres',$codrep,
                'vl_meta_quinz',"ano = $ano and mes = $mes");

    if(is_array($aReg)){
        $metaQuinz = $aReg[0]['vl_meta_quinz'];
    }else{
        $metaQuinz = 0;
    }

    return $metaQuinz;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaQuinzenalCor ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaCliAtendCor ------*/

function getMetaCliAtendCor($codrep){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $ano = date('Y');
    $mes = date('m');
    $aReg = $this->getReg('espec','metas_repres','cod_repres',$codrep,
        'qt_cli_meta',"ano = $ano and mes = $mes");
    if(is_array($aReg)){
        $metaCliAtend = $aReg[0]['qt_cli_meta'];
    }else{
        $metaCliAtend = 0;
    }

    return $metaCliAtend;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaCliAtendCor ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetaGeral ------*/

function getMetaGeral($mes,$ano){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $metaGeral = 0;
    $condicao = "mes = $mes and ano = $ano";
    $aDados = $this->getDados('multi','metas_geral','meta',$condicao,'espec');
    if($aDados){
        $metaGeral = $aDados[0]['meta'];
    }
    return $metaGeral;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetaGeral ------*/


/*----- Scriptcase Locale: PHP Method: metas_repres.php => function getMetasGerentes ------*/

function getMetasGerentes($codRepGer,$mes,$ano){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

   $metaGeralGer = 0;
    $aReg = $this->getReg('espec','metas_gerencial','cod_rep_ger,mes,ano ',"$codRepGer,$mes,$ano",'meta');
    if(is_array($aReg)){
        $metaGeralGer = $aReg[0]['meta'];
    }

    return $metaGeralGer;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: metas_repres.php => function getMetasGerentes ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function buscarParametroIma ------*/

function buscarParametroIma($parametro,$vlPadrao='',$logGravarSessao=true)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
        if($logGravarSessao){
            $_SESSION['im_param'][$parametro] = $valor;
        }
    }
    return $valor;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function buscarParametroIma ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPe ------*/

function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaGrupos = $this->getGruposUsuario($this->getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    return $this->buscarParametroIma($parametro);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPi ------*/

function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    return $this->buscarParametroIma($parametro);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMinutosVenctoPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getHabilitarBonusRepres ------*/

function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getHabilitarBonusRepres ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getBase ------*/

function getBase()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getBase ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getMudancaMoeda ------*/

function getMudancaMoeda()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getMudancaMoeda ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamPrecoTbERP ------*/

function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('buscar_preco_tb_erp',1);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamPrecoTbERP ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getPrecoTbLiquidaIma ------*/

function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getPrecoTbLiquidaIma ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamGrupoAvalAdm ------*/

function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('grupo_aval_adm',12);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamGrupoAvalAdm ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getPercRedTbRubi ------*/

function getPercRedTbRubi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('perc_reduc_tb_rubi',50);



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getPercRedTbRubi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getIdTbRubi ------*/

function getIdTbRubi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('tb_rubi_id',2);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getIdTbRubi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAutLogDb ------*/

function getAutLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('aut_log_db','670477Im@');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAutLogDb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUserLogDb ------*/

function getUserLogDb()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('user_log_db','sa');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUserLogDb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function credBdConsultas ------*/

function credBdConsultas()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('cred_bd_consulta','670477Im@');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function credBdConsultas ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArqOutlet ------*/

function getDirArqOutlet()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_arq_outlet','');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArqOutlet ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getCaminhoArqCampanha ------*/

function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_arq_campanha',
        $this->getDirRaizWeb().'/iol/_lib/file/doc');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getCaminhoArqCampanha ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIFSudeste ------*/

function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '500');

    }
    return $param;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIFSudeste ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIF ------*/

function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVlMinFreteCIF ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirTmpBook ------*/

function getDirTmpBook()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_tmp_book', $this->getDirRaizWeb().'/tmp');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirTmpBook ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlServico ------*/

function getUrlServico()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlServico ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUserApiTotvs ------*/

function getUserApiTotvs()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUserApiTotvs ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaApiTotvs ------*/

function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('senha_api_totvs',
        'api');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaApiTotvs ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getVersaoApiHomolog ------*/

function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('versao_api_homolog',
        'v99');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getVersaoApiHomolog ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getApiHistAvalPedVenda ------*/

function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getApiHistAvalPedVenda ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getApiValidIncItemContainer ------*/

function getApiValidIncItemContainer()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('api_valid_inc_item_container',
        'cdp/v1/validarItemContainer');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getApiValidIncItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPe ------*/

function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPi ------*/

function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWebPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWeb ------*/

function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getAprovGerenciaPedWeb ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParametros ------*/

function getParametros()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParametros ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function atualizarParametros ------*/

function atualizarParametros()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $this->limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function atualizarParametros ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function setParamsSessao ------*/

function setParamsSessao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        $this->setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function setParamsSessao ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getNomeVarParams ------*/

function getNomeVarParams()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getNomeVarParams ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getConsiderarDepositoFechado ------*/

function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('considerar_deposito_fechado','1');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getConsiderarDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getEstabDepositoFechado ------*/

function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('cod_estab_deposito_fechado','504');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getEstabDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getCodDeposDepositoFechado ------*/

function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('cod_depos_deposito_fechado','ter');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getCodDeposDepositoFechado ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirAnexosEmail ------*/

function getDirAnexosEmail($estab)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_anexo_email_'.$estab,
        $this->getDirRaizWeb().'/dfe');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirAnexosEmail ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirRelAnexosEmail ------*/

function getDirRelAnexosEmail($estab)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_rel_anexo_email_'.$estab,'../../dfe');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirRelAnexosEmail ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getCaixaNFe ------*/

function getCaixaNFe($estab)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('caixa_nfe_'.$estab,'{outlook.office365.com:993/imap/ssl}INBOX');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getCaixaNFe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUsuarioCaixaNFe ------*/

function getUsuarioCaixaNFe($estab){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('usr_caixa_nfe_'.$estab,'nfe.medtextil@imatextil.com.br');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUsuarioCaixaNFe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaCaixaNFe ------*/

function getSenhaCaixaNFe($estab){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('senha_caixa_nfe_'.$estab,'IMATEXTIL@0123');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getSenhaCaixaNFe ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getQtDiasBuscaDocManif ------*/

function getQtDiasBuscaDocManif()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_busca_doc_manif',90);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getQtDiasBuscaDocManif ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getWSDLManifTSS ------*/

function getWSDLManifTSS()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return  $this->buscarParametroIma('wsdl_manif_tss','http://192.168.0.30:8080/MANIFESTACAODESTINATARIO.apw?WSDL') ;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getWSDLManifTSS ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getFuncaoManifTSS ------*/

function getFuncaoManifTSS()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
  return  $this->buscarParametroIma('funcao_manif_tss','BAIXARXMLDOCUMENTOS');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getFuncaoManifTSS ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getNumAmbienteTSS ------*/

function getNumAmbienteTSS()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return  $this->buscarParametroIma('num_amb_tss','1');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getNumAmbienteTSS ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getParamBuscarXmlTss ------*/

function getParamBuscarXmlTss()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return  $this->buscarParametroIma('buscar_xml_tss','1',false);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getParamBuscarXmlTss ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getSubDirAnexosXml ------*/

function getSubDirAnexosXml(): string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('subpastas_xml', ",lidos,Error,invalidos", false);


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getSubDirAnexosXml ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlBookPorDemanda ------*/

function getUrlBookPorDemanda()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('url_book_demanda',
        "http://desenv.imatextil.com.br/sc94/app/imaonline/bl_gerar_book_por_demanda/bl_gerar_book_por_demanda.php",
        false);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getUrlBookPorDemanda ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function limparVar ------*/

function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function limparVar ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getTranspRedesp505 ------*/

function getTranspRedesp505()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('cod_transp_redesp_505','661');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getTranspRedesp505 ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getTranspRedesp5 ------*/

function getTranspRedesp5()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('cod_transp_redesp_5','355');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getTranspRedesp5 ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getNumModeloRegraFrete ------*/

function getNumModeloRegraFrete()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('num_modelo_regra_frete','1');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getNumModeloRegraFrete ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirPV ------*/

function getDirPV()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_pv','iol');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirPV ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArquivoCsvImpPreco ------*/

function getDirArquivoCsvImpPreco(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('dir_csv_imp_preco',
        $this->getDirRaizWeb().'/'.$this->getDirPV().'/_lib/file/doc/item_preco');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getDirArquivoCsvImpPreco ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getFormaCalculoTipoFrete ------*/

function getFormaCalculoTipoFrete()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('forma_calculo_tipo_frete','codigo');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getFormaCalculoTipoFrete ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getInstanciaMegaAPi ------*/

function getInstanciaMegaAPi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('instancia_mega_api','');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getInstanciaMegaAPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getTokenMegaAPi ------*/

function getTokenMegaAPi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('token_mega_api','');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getTokenMegaAPi ------*/


/*----- Scriptcase Locale: PHP Method: parametros_ima.php => function getHostMegaApi ------*/

function getHostMegaApi()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('host_mega_api','');

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: parametros_ima.php => function getHostMegaApi ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarLoginSessao ------*/

function getNomeVarLoginSessao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return "glo_usr_login";

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarLoginSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarPercParComis ------*/

function getNomeVarPercParComis()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return "perc_participacao_comis";

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarPercParComis ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeVarTodosCliente ------*/

function getNomeVarTodosCliente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return "log_todos_cliente";

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeVarTodosCliente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getCamposUsuario ------*/

function getCamposUsuario()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return  'priv_admin,ativo,nome,email,"tp-usuario" as tp_usuario,usuario,
		"nome-ab-cli" as nome_ab_cli,login,usuario,log_pedido_on_line,
                 log_aprovador,id,perc_participacao_comis,log_todos_clientes,
                 log_venda_ped_imp';

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getCamposUsuario ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function validarLogin ------*/

function validarLogin($login,$pswd)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $login = $this->retirarAcentoSimples($login);
    $erro = '';
    $slogin = $this->Db->qstr($login);
    $spswd  = $this->Db->qstr($pswd);
    $logSetarVariaveis = false;
    $campos = $this->getCamposUsuario();
    $slogin = str_replace("'","",$slogin);
    $spswd  = str_replace("'","",$spswd);

    if($spswd == '67047700'){
        $filtroCompl = '';
    }else{
        $filtroCompl = " senha = '$spswd' ";
    }

    $aUsuario = $this->getDadosUserWeb($slogin,$campos,$filtroCompl);
    $vendLoja = 0;
    if(! is_array($aUsuario)){
        ;
        $erro = 'Informe um usuário e uma senha válida ';
    }else{
        $reg = $aUsuario[0];
        $ativo              = $reg['ativo'];
        if($ativo <> 1){
            $erro = "Usuário Inativo";
        }
    }
    return array('array'=>$aUsuario,'erro'=>$erro);
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function validarLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function setarVarsLogin ------*/

function setarVarsLogin($aUsuario)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaReps = '';
    $listaUfs  = '';
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
    $logVendaPedImp     = $reg['log_venda_ped_imp'];
    switch($tipoUsuario)
    {
        case 1: 
            $nomeClienteIni  = $nomeAbCli;
            $nomeClienteFim  = $nomeAbCli;
            break;
        case 2: 
            $nomeRepresIni      = 	$usr_login;
            $nomeRepresFim      = 	$usr_login;
            $codRepIni          = $this->buscarCodRep($usr_login);
            $codRepFim          = $codRepIni;
            $classe             = $this->getClasseVendedor($codRepIni);

            if(strstr($this->getClasseVendInterno(), $classe) <> false) {
                $vendLoja = 1;
            }
            break;

        case 3: 
            $codRep = $this->buscarCodRep($usr_login);
            $aCodRestrUsuar      = $this->getDadosRestrClienteUsuar($usr_login,'restrs_clientes_usuario_id');
            if($aCodRestrUsuar){
                $codRestrUsuar = $aCodRestrUsuar[0]['restrs_clientes_usuario_id'];
            }
            $restrPermisAtivo   = $this->getTpRestrUsuar($usr_login,'ativo');
            $restrPermisInativo = $this->getTpRestrUsuar($usr_login,'inativo');
            $hierarq = $this->getTpHierarquiaGer($codRep);
            if($hierarq == 3){
                $listaReps       = $this->getListaRepresGer('cod',$usr_login);
            }
            if($restrPermisAtivo == 3){
                $listaReps = $this->getListaRestrClientesUsuar('repres',$codRestrUsuar,',');
            }
            if($restrPermisInativo == 3){
                $listaUfs = $this->getListaRestrClientesUsuar('uf',$codRestrUsuar,',');
            }
            break;

        case 4: 
            $aCodRestrUsuar      = $this->getDadosRestrClienteUsuar($usr_login,'restrs_clientes_usuario_id');
            if($aCodRestrUsuar){
                $codRestrUsuar = $aCodRestrUsuar[0]['restrs_clientes_usuario_id'];
            }
            $restrPermisAtivo   = $this->getTpRestrUsuar($usr_login,'ativo');
            $restrPermisInativo = $this->getTpRestrUsuar($usr_login,'inativo');

            if($restrPermisAtivo == 3){
                $listaReps = $this->getListaRestrClientesUsuar('repres',$codRestrUsuar,',');
            }
            if($restrPermisInativo == 3){
                $listaUfs = $this->getListaRestrClientesUsuar('uf',$codRestrUsuar,',');
            }
            break;


        case 5: 
            $nomeRepresIni       = 	$usuario;
            $nomeRepresFim       = 	$usuario;
            $prepostoIni         = 	$usr_login;
            $prepostoFim         =  $usr_login;
            $codRepIni		  	 = $this->buscarCodRep($usuario);
            $codRepFim		     = $codRepIni;
            break;
    }

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
    $_SESSION['glo_lista_reps_ger']     = $listaReps;
    $_SESSION['glo_lista_ufs_ger']      = $listaUfs;

    $this->setVarSessao($this->getParamVendLoja(),$vendLoja);
    $this->setVarSessao('id_usuario',$idUsuario);
    $this->setVarSessao($this->getNomeVarPercParComis(),$percPartComis);
    $this->setVarSessao($this->getNomeVarTodosCliente(),$logTodosCliente);
    $this->setVarSessao('log_venda_ped_imp',$logVendaPedImp);



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function setarVarsLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function logar ------*/

function logar($login,$pswd)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLogin($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
        $this->setarVarsLogin($aUsuario);
        $this->atualizarParametros();
    }

    return $erro;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function logar ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getNomeRepresSessao ------*/

function getNomeRepresSessao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $nomeRepresIni = $this->getVarSessao('glo_nomeRepresIni');
    if($nomeRepresIni == ''){
        $nomeRepresFim = 'zzzzzzzzzzzzzzzz';
    }else{
        $nomeRepresFim = $nomeRepresIni;
    }
    $aRetorno = array('nome_repres_ini' => $nomeRepresIni, 'nome_repres_fim' => $nomeRepresFim);
    return  $aRetorno;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getNomeRepresSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function aplicarPermissoesSC ------*/

function aplicarPermissoesSC($login)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
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
        ;
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function aplicarPermissoesSC ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function has_priv ------*/

function has_priv($param)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return ($param == 'Y' ? 'on' : 'off');


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function has_priv ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function limparLogin ------*/

function limparLogin($logLimparPerfilPai=false)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
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
        $this->limparVarSessao('perfil_pai');
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
    $this->limparVarSessao($listaVar);
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
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function limparLogin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function inicioAplicacao ------*/

function inicioAplicacao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

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
    $msg = $this->verifDispSite();
    if($msg){
        echo "<h1>$msg</h1>";
        die;
    }
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function inicioAplicacao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getLoginCorrente ------*/

function getLoginCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarLoginSessao());


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getLoginCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getPercPartComisCorrente ------*/

function getPercPartComisCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarPercParComis());

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getPercPartComisCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getTodosClienteCorrente ------*/

function getTodosClienteCorrente()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    return $this->getVarSessao($this->getNomeVarTodosCliente());

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getTodosClienteCorrente ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function limparListaCpsSessao ------*/

function limparListaCpsSessao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aLista =$this->getVarSessao('lista_cps_definida');
    if(is_array($aLista)){
        $tam = count($aLista);
        for($i=0;$i<$tam;$i++){
            $variavel = $aLista[$i];
            unset($_SESSION[$variavel]);
        }
    }

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function limparListaCpsSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getListasRepsUfsUsuar ------*/

function getListasRepsUfsUsuar($tipoLista,$tipoUsuar,$usr_login){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    if($tipoLista == ''){
        $tipoLista = 'rep';
    }
    $lista = '';

    switch ($tipoUsuar){

        case 3: 
            $codRep = $this->buscarCodRep($usr_login);
            $aCodRestrUsuar      = $this->getDadosRestrClienteUsuar($usr_login,'restrs_clientes_usuario_id');
            if($aCodRestrUsuar){
                $codRestrUsuar = $aCodRestrUsuar[0]['restrs_clientes_usuario_id'];
            }
            $restrPermisAtivo   = $this->getTpRestrUsuar($usr_login,'ativo');
            $restrPermisInativo = $this->getTpRestrUsuar($usr_login,'inativo');
            $hierarq = $this->getTpHierarquiaGer($codRep);
            
            if($restrPermisAtivo == 3){
                $lista = $this->getListaRestrClientesUsuar('repres',$codRestrUsuar,',');
            }
            if($restrPermisAtivo == 1){
                $lista = '';
            }
            if($tipoLista == 'uf'){
                if($restrPermisInativo == 3){
                    $lista = $this->getListaRestrClientesUsuar('uf',$codRestrUsuar,',');
                }else{
                    $lista = '';
                }
            }
            break;

        case 4: 
            $aCodRestrUsuar      = $this->getDadosRestrClienteUsuar($usr_login,'restrs_clientes_usuario_id');
            if($aCodRestrUsuar){
                $codRestrUsuar = $aCodRestrUsuar[0]['restrs_clientes_usuario_id'];
            }
            $restrPermisAtivo   = $this->getTpRestrUsuar($usr_login,'ativo');
            $restrPermisInativo = $this->getTpRestrUsuar($usr_login,'inativo');

            if($tipoLista == 'uf'){
                if($restrPermisInativo == 3){
                    $lista = $this->getListaRestrClientesUsuar('uf',$codRestrUsuar,',');
                }
            }else{
                if($restrPermisAtivo == 3){
                    $lista = $this->getListaRestrClientesUsuar('repres',$codRestrUsuar,',');
                }
            }

            break;

    }

    return $lista;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getListasRepsUfsUsuar ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function verifUsuarioCorrenteAdmin ------*/

function verifUsuarioCorrenteAdmin()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $log= 0;

    $tipo = $this->getTipoUsuarioCorrente();
    if($tipo <> 2 and $tipo <> 5){
        $log = 1;
    }
    return $log;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function verifUsuarioCorrenteAdmin ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function setVarsSCSessao ------*/

function setVarsSCSessao()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['aprovador'])) {$_SESSION['aprovador'] = "";}
if (!isset($this->sc_temp_aprovador)) {$this->sc_temp_aprovador = (isset($_SESSION['aprovador'])) ? $_SESSION['aprovador'] : "";}
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
if (!isset($_SESSION['usr_email'])) {$_SESSION['usr_email'] = "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($_SESSION['usr_name'])) {$_SESSION['usr_name'] = "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($_SESSION['usr_priv_admin'])) {$_SESSION['usr_priv_admin'] = "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->sc_temp_usr_login 		 = $_SESSION['glo_usr_login'];
    $this->sc_temp_usr_priv_admin 	 = $_SESSION['glo_usr_priv_admin'];
    $this->sc_temp_usr_name 			 = $_SESSION['glo_usr_name'];
    $this->sc_temp_usr_email			 = $_SESSION['glo_usr_email'];
    $this->sc_temp_nomeClienteIni     = $_SESSION['glo_nomeClienteIni'] ;
    $this->sc_temp_nomeClienteFim	 = $_SESSION['glo_nomeClienteFim'];
    $this->sc_temp_nomeRepresIni		 = $_SESSION['glo_nomeRepresIni'];
    $this->sc_temp_nomeRepresFim      = $_SESSION['glo_nomeRepresFim'];
    $this->sc_temp_codRepIni			 = $_SESSION['glo_codRepIni'];
    $this->sc_temp_codRepFim			 = $_SESSION['glo_codRepFim'];
    $this->sc_temp_prepostoIni		 = $_SESSION['glo_prepostoIni'];
    $this->sc_temp_prepostoFim		 = $_SESSION['glo_prepostoFim'];
    $this->sc_temp_tipoUsuario		 = $_SESSION['glo_tipoUsuario'];
    $this->sc_temp_aplicacaoPrincipal = $_SESSION['glo_aplicacaoPrincipal'];
    $this->sc_temp_inicio_sessao		 = $_SESSION['glo_inicio_sessao'];
    $this->sc_temp_aprovador	    	 = $_SESSION['glo_aprovador'];

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) {$_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) {$_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) {$_SESSION['usr_email'] = $this->sc_temp_usr_email;}
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
if (isset($this->sc_temp_aprovador)) {$_SESSION['aprovador'] = $this->sc_temp_aprovador;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function setVarsSCSessao ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function verifDispSite ------*/

function verifDispSite():string
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $raizWeb = $this->getDirRaizWeb();
    $arqIndisp = $raizWeb.DIRECTORY_SEPARATOR."lock.txt";
    if (file_exists($arqIndisp)){
        $mensagem = file_get_contents($arqIndisp);
    }else{
        $mensagem = '';
    }
    return $mensagem;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function verifDispSite ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function getUsuarioErpOuPortal ------*/

function getUsuarioErpOuPortal()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $usuario = $this->getUsuarioERP($this->getUsuarioCorrente());
    if($usuario == ''){
        $usuario = $this->getUsuarioCorrente();
    }
    return $usuario;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function getUsuarioErpOuPortal ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function logarUnificado ------*/

function logarUnificado($login,$pswd,$sistema='imaonline')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $vendLoja = 0;
    $aRet = $this->validarLoginUnificado($login,$pswd);
    $aUsuario = $aRet['array'];
    $erro = $aRet['erro'];

    if($erro == ''){
        $this->setarVarsLoginUnificado($aUsuario,$sistema);
    }

    return $erro;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function logarUnificado ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function validarLoginUnificado ------*/

function validarLoginUnificado($login,$senha)
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $aReg = getRegSUsers($login);
    $erro = '';
    if(!is_array($aReg)){
        ;
        $erro = 'Informe um usuário existente ';
    }else{
        $reg        = $aReg[0];
        $ativo      = $reg['active'];
        $usuarioAd  = $reg['usuario_ad'];
        $senhaReg   = $reg['pswd'];
        if(strtoupper($ativo) <> 'Y'){
            $erro = "Usuário Inativo";
        }else{
            if($usuarioAd){
                $aDominio = getDadosAD();
                $servidor = $aDominio['servidor_ad'];
                $dominio  = $aDominio['dominio'];
                $base     = $aDominio['base'];
                $porta    = $aDominio['porta'];


                $ldapConn =  logarLDAP($login,$senha,$servidor,'ima');


                if($ldapConn == ''){
                    ;
                    $erro = 'Informe um usuário de rede e uma senha de rede válida';
                }
            }else{
                if(md5($senha) != $senhaReg){
                    ;
                    $erro = 'Informe um usuário e uma senha válida ';
                }
            }
        }
    }
    return array('array'=>$aReg,'erro'=>$erro);
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function validarLoginUnificado ------*/


/*----- Scriptcase Locale: PHP Method: login.php => function setarVarsLoginUnificado ------*/

function setarVarsLoginUnificado($aUsuario,$sistema='imaonline')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $vendLoja = 0;
    $reg = $aUsuario[0];
    extract($reg);

    $this->setVarSessao('id_usuario',$codigo);
    $this->setVarSessao('tipo_usuario',$tp_suario);
    $this->setVarSessao('usr_email',$email);
    $this->setVarSessao('usr_ativo',$active);
    $this->setVarSessao('nome_usuar',$name);
    $this->setVarSessao('log_venda_ped_imp',$log_venda_ped_imp);

    $aplicacaoPrincipal = 'container_ini_repres';

    $inicio_sessao = date('d-m-Y H:i:s');
    $nomeVarLogin = $this->getNomeVarLoginSessao($sistema);
    $this->setVarSessao($nomeVarLogin,strtoupper($login));



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: login.php => function setarVarsLoginUnificado ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function registrarLog ------*/

function registrarLog($aplicacao='')	
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  		
	

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function registrarLog ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function inserirLogProgramas ------*/

function inserirLogProgramas($usuario,$aplicacao,$sistema){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $dateTime = new \DateTime();
    $dateTime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
    $dateTime = $dateTime->format('Y-m-d H:i:s');

    $cmd = "insert into log_programas_acessados (usuario,programa,data_acesso,sistema)
                    values('$usuario','$aplicacao','$dateTime','$sistema')";
    
     $nm_select = $cmd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Ini->nm_db_ticontrole->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ticontrole->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function inserirLogProgramas ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getUltAcessoProgramas ------*/

function getUltAcessoProgramas($dataInicial = '', $dataFinal = ''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    if($dataInicial == ''){
        $dateTime = new \DateTime();
        $dateTime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
        $dataInicial = $dateTime->format('Y-m-d');
    }
    if($dataFinal == ''){
        $dataFinal = $dataInicial;
    }
    $dataHoraInicial = $dataInicial . " 00:00:00";
    $dataHoraFinal   = $dataFinal . " 23:59:59";
    $condicaoData = "data_acesso between '$dataHoraInicial' and '$dataHoraFinal'";
    $tipo     = "unico";
    $tabela   = "dbo.log_programas_acessados";
    $campos   = "COUNT(*) as total_acessos,
                 COUNT(DISTINCT usuario) as usuarios_unicos,
                 MAX(data_acesso) as ultimo_acesso,
                 (SELECT TOP 1 usuario
                    FROM dbo.log_programas_acessados
                   WHERE $condicaoData
                   ORDER BY data_acesso DESC) as ultimo_usuario,
                 (SELECT TOP 1 programa
                    FROM dbo.log_programas_acessados
                   WHERE $condicaoData
                   ORDER BY data_acesso DESC) as ultimo_programa,
                 (SELECT TOP 1 sistema
                    FROM dbo.log_programas_acessados
                   WHERE $condicaoData
                   ORDER BY data_acesso DESC) as ultimo_sistema
                 " ;
    $condicao = $condicaoData;
    $conexao  = "ticontrole";
    return $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getUltAcessoProgramas ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getProgramaMaisAcessado ------*/

function getProgramaMaisAcessado(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tipo     = "unico";
    $tabela   = "dbo.log_programas_acessados";
    $campos   = "TOP 1
                 programa as nome_programa,
                 sistema,
                 COUNT(*) as total_acessos,
                 COUNT(DISTINCT usuario) as usuarios_unicos,
                 MAX(data_acesso) as ultimo_acesso";
    $condicao = "1 = 1
                 GROUP BY programa, sistema
                 ORDER BY COUNT(*) DESC, MAX(data_acesso) DESC";
    $conexao  = "ticontrole";
    return $this->getDados($tipo,$tabela,$campos,$condicao,$conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getProgramaMaisAcessado ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getDadosGraficoAcessosProgramas ------*/

function getDadosGraficoAcessosProgramas($dataInicial = '', $dataFinal = '', $limit = 10, $sistema = '')
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $limit = (int) $limit;
    if ($limit <= 0) {
        $limit = 10;
    }
    if ($dataInicial !== '' && $dataFinal === '') {
        $dataFinal = $dataInicial;
    }
    $where = array();
    $where[] = "1 = 1";
    if ($dataInicial !== '') {
        $where[] = "data_acesso >= '" . str_replace("'", "''", $dataInicial . " 00:00:00") . "'";
    }
    if ($dataFinal !== '') {
        $where[] = "data_acesso <= '" . str_replace("'", "''", $dataFinal . " 23:59:59") . "'";
    }
    if ($sistema !== '') {
        $where[] = "sistema = '" . str_replace("'", "''", $sistema) . "'";
    }
    $condicaoBase = implode(' AND ', $where);
    $tabela       = "dbo.log_programas_acessados";
    $conexao      = "ticontrole";
    $camposProgramas = "TOP {$limit}
                        programa as nome_programa,
                        sistema,
                        COUNT(*) as total_acessos,
                        COUNT(DISTINCT usuario) as usuarios_unicos,
                        MAX(data_acesso) as ultimo_acesso";
    $condicaoProgramas = $condicaoBase . "
                          AND programa IS NOT NULL
                          AND programa <> ''
                          GROUP BY programa, sistema
                          ORDER BY COUNT(*) DESC, MAX(data_acesso) DESC";
    $camposUsuarios = "TOP {$limit}
                       usuario as nome_usuario,
                       COUNT(*) as total_acessos,
                       COUNT(DISTINCT programa) as programas_acessados,
                       MAX(data_acesso) as ultimo_acesso";
    $condicaoUsuarios = $condicaoBase . "
                         AND usuario IS NOT NULL
                         AND usuario <> ''
                         GROUP BY usuario
                         ORDER BY COUNT(*) DESC, MAX(data_acesso) DESC";
    return array(
        'programas_mais_acessados' => $this->getDados('multi', $tabela, $camposProgramas, $condicaoProgramas, $conexao),
        'usuarios_mais_acessam'    => $this->getDados('multi', $tabela, $camposUsuarios, $condicaoUsuarios, $conexao)
    );

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getDadosGraficoAcessosProgramas ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getLogsProgramas ------*/

function getLogsProgramas($limit = 50, $filtros = array())
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $limit = (int) $limit;
    if ($limit <= 0) {
        $limit = 50;
    }
    $dataInicial = isset($filtros['data_inicial']) ? trim((string) $filtros['data_inicial']) : '';
    $dataFinal   = isset($filtros['data_final']) ? trim((string) $filtros['data_final']) : '';
    $usuario     = isset($filtros['usuario']) ? trim((string) $filtros['usuario']) : '';
    $programa    = isset($filtros['nome_programa']) ? trim((string) $filtros['nome_programa']) : '';
    $where = array();
    $where[] = "1 = 1";
    if ($dataInicial !== '') {
        $where[] = "data_acesso >= '" . str_replace("'", "''", $dataInicial . " 00:00:00") . "'";
    }
    if ($dataFinal !== '') {
        $where[] = "data_acesso <= '" . str_replace("'", "''", $dataFinal . " 23:59:59") . "'";
    }
    if ($usuario !== '') {
        $where[] = "usuario = '" . str_replace("'", "''", $usuario) . "'";
    }
    if ($programa !== '') {
        $where[] = "programa = '" . str_replace("'", "''", $programa) . "'";
    }
    $tipo     = "multi";
    $tabela   = "dbo.log_programas_acessados";
    $campos   = "TOP {$limit}
                 id,
                 data_acesso,
                 usuario,
                 programa,
                 sistema";
    $condicao = implode(' AND ', $where) . " ORDER BY data_acesso DESC, id DESC";
    $conexao  = "ticontrole";
    return $this->getDados($tipo, $tabela, $campos, $condicao, $conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getLogsProgramas ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getUsuariosLogProgramas ------*/

function getUsuariosLogProgramas()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tipo     = "multi";
    $tabela   = "dbo.log_programas_acessados";
    $campos   = "DISTINCT usuario as nome_usuario ";
    $condicao = "usuario IS NOT NULL
                 AND usuario <> ''
                 ORDER BY usuario";
    $conexao  = "ticontrole";
    return $this->getDados($tipo, $tabela, $campos, $condicao, $conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getUsuariosLogProgramas ------*/


/*----- Scriptcase Locale: PHP Method: log.php => function getListaProgramasLog ------*/

function getListaProgramasLog()
{
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $tipo     = "multi";
    $tabela   = "dbo.log_programas_acessados";
    $campos   = "DISTINCT programa as nome_programa";
    $condicao = "programa IS NOT NULL
                 AND programa <> ''
                 ORDER BY programa";
    $conexao  = "ticontrole";
    return $this->getDados($tipo, $tabela, $campos, $condicao, $conexao);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: log.php => function getListaProgramasLog ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getRankingRepres ------*/

function getRankingRepres($periodo,$numMes='',$tipoVl='fat_liq',$listaCodReps='',$codPeriodo='',$dtIni='',$dtFim='',$ano=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = '1=1';
    $listaNomeReps = '';
        if($numMes == ''){
            $numMes = date('m');
        }
        $condMes = "mes = $numMes";
        if($ano == ''){
            $condAnoCorrente = "ano = year(curdate())";
        }else{
            $condAnoCorrente = "ano = $ano";
        }
        switch ($periodo){
            case 'ano_corrente':
                $condicao = $condAnoCorrente;
                break;
            case 'mes_corrente':
                $condicao = " $condAnoCorrente and $condMes";

                break;
            case 'periodo':
                $aCondRanking = $this->getCondPerDashboardRanking($codPeriodo,$listaCodReps,$dtIni,$dtFim);
                if($aCondRanking){
                    $condicao     = $aCondRanking['condicao'];
                }
                break;
        }


    $aRet = array();
    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi', 'PUB.fats_repres',
        'cod_rep,  
                sum(vl_desconto) as vl_desc,
                sum(vl_desconto_dev) as vl_desc_dev,
                sum(vl_devolucoes) as devol,
                sum(vl_faturamento) as vl_fat,
                sum(vl_meta) as meta'
                ,
        " $condicao $condTrans  group by cod_rep",
        'espec',$inner);
    if(is_array($aDados)){
        $tam = count($aDados);
        for($i=0;$i<$tam;$i++){
            $vlFat      = $aDados[$i]['vl_fat'];
            $vlDesc     = $aDados[$i]['vl_desc'];
            $vlDevol    = $aDados[$i]['devol'];
            $vlDescDev  = $aDados[$i]['vl_desc_dev'];
            $vlMeta     = $aDados[$i]['meta'];
            switch($tipoVl){
                case 'fat_liq':
                    $aDados[$i]['valor'] = $vlFat  + $vlDesc + $vlDevol + $vlDescDev;
                    break;
                case 'perc_meta':
                    if($vlMeta <> 0){
                        $aDados[$i]['valor'] = ($vlFat  + $vlDesc + $vlDevol + $vlDescDev) / $vlMeta * 100;
                    }else{
                        $aDados[$i]['valor']  = 0;
                    }
                    break;
            }
        }
        foreach ($aDados as $key => $row) {
            $aRanking[$key]  = $row['valor'];
        }
        array_multisort($aRanking,SORT_DESC,SORT_NUMERIC,$aDados);

        if($listaCodReps <> ''){
            $aListaRepres = explode(',',$listaCodReps);
            foreach($aListaRepres as $listCodReps){
                $nomeRep = str_replace("'",'',$listCodReps);
                $nomeRep = $this->getNomeAbrevRepres($nomeRep);
                $listaNomeReps = $this->util_incr_valor($listaNomeReps,$nomeRep,',');
            }

            $listaRepres = $listaNomeReps;
            $tamReps = count($aListaRepres);
        }

        $iPosicao = 0;
        for($i=0;$i<$tam;$i++){
            $codRep     = $aDados[$i]['cod_rep'];
            $nomeAbrev = $this->getNomeAbrevRepres($codRep);
            if($listaCodReps <> ''){
                if(strpos($listaRepres,$nomeAbrev) === false or strtoupper($nomeAbrev) == 'IMA'){
                    continue;
                }
                $tamFinal = $tamReps;

            }else{
              $tamFinal = $tam;
            }
            $iPosicao++;
            $aRet[$codRep]  = "$nomeAbrev - {$iPosicao}º / $tamFinal ";
        }

    }
    return $aRet;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getRankingRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresClientes ------*/

function getDadosFatsRepresClientes($logMes=1,$periodo,$represIni='000000',$represFim='999999',$mes,$listaCodReps='',$codEstabel='5,505',$condCompl=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaClientes = 0;
    $listaReps = $listaCodReps;
    $loginCorrente =  $this->getLoginCorrente();
    $codRepLogin = $this->buscarCodRep($loginCorrente);
    $tipoUsuario = $this->getTipoUsuario($loginCorrente);

    if($logMes == 2){
        $condMesCorrente = "mes = $mes - 1";
    }else{
        $condMesCorrente = "mes = $mes";
    }

    $condAnoCorrente = "ano = year(curdate())";
    switch ($periodo){
        case 'ano_corrente':
            if($tipoUsuario <> 2){
                if($listaCodReps <> '' and $represIni <> $represFim){
                    $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and cod_rep in($listaReps)" ;
                }else{
                    $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and cod_rep >= $represIni and cod_rep <= $represFim" ;
                }
            }else{
                $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and cod_rep = $codRepLogin" ;
            }

            break;
        case 'mes_corrente':
            if($tipoUsuario <> 2){
                if($listaCodReps <> '' and $represIni <> $represFim){
                    $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and $condMesCorrente and cod_rep in($listaReps) ";
                }else{
                    $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and $condMesCorrente and cod_rep >= $represIni and cod_rep <= $represFim ";
                }
            }else{
                $condicao = " cod_estabel in($codEstabel) and $condAnoCorrente and $condMesCorrente and cod_rep = $codRepLogin ";
            }


            break;
    }
    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres_clientes.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres_clientes','
    cod_emitente as cliente,    
    sum(qt_dev),
    sum(qt_fat),   
    sum(vl_desconto),
    sum(vl_desconto_dev),
    sum(vl_devolucoes) as devol,
    sum(vl_faturamento) as fat,
    sum(vl_meta)',"$condicao $condCompl $condTrans group by cliente
    order by sum(vl_faturamento) desc",'espec',$inner);

    $qtCli = 0;
    if(is_array($aDados)){
        foreach($aDados as $dados){
            $cliente = $dados['cliente'];
            $fat     = $dados['fat'];
            if($fat > 0){
                if($cliente <> 0){
                    $listaClientes = $this->util_incr_valor($listaClientes,$cliente,',');
                }
            }

        }
        $aCliente = explode(',',$listaClientes);
        $qtCli = count($aCliente);
    }

    return $qtCli;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresClientes ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresCliPeriodo ------*/

function getDadosFatsRepresCliPeriodo($periodo,$tpUsuario,$listaReps='',$represIni='000000',$represFim='999999',$dtIni='',$dtFim='',$codEstabel){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaClientes = 0;
    $condicao      = '';

    $aDadosDash = $this->getCondPeriodoDashboard($periodo,$tpUsuario,$listaReps,$represIni,$represFim,$dtIni,$dtFim,$codEstabel);
    if($aDadosDash){
        $condicao = $aDadosDash['condicao'];
        $titulo  = $aDadosDash['titulo'];
    }

    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres_clientes.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres_clientes','
    cod_emitente as cliente,    
    sum(qt_dev),
    sum(qt_fat),   
    sum(vl_desconto),
    sum(vl_desconto_dev),
    sum(vl_devolucoes) as devol,
    sum(vl_faturamento) as fat,
    sum(vl_meta)',"$condicao $condTrans  group by cliente
    order by sum(vl_faturamento) desc",'espec',$inner);

    $qtCli = 0;
    if(is_array($aDados)){
        foreach($aDados as $dados){
            $cliente = $dados['cliente'];
            $fat     = $dados['fat'];
            if($fat > 0){
                if($cliente <> 0){
                    $listaClientes = $this->util_incr_valor($listaClientes,$cliente,',');
                }
            }

        }
        $aCliente = explode(',',$listaClientes);
        $qtCli = count($aCliente);
    }
    $aRet = array(
        'qt_cli' => $qtCli,
        'titulo' => $titulo
    );

    return $aRet;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresCliPeriodo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtCliPeriodo ------*/

function getQtCliPeriodo($periodo,$listaRep,$codRepIni,$codRepFim,$dtIni,$dtFim,$codEstabel='5,505'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $listaClientes = 0;
    $totMes = 0;
    $qtCli  = 0;

    $aDadosDash = $this->getCondPeriodoDashboard($periodo,'',$listaRep,$codRepIni,$codRepFim,$dtIni,$dtFim,$codEstabel);
    if($aDadosDash){
        $condicao = $aDadosDash['condicao'];
    }


    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres_clientes.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres_clientes','distinct cod_emitente as emitente, ano, mes',
        $condicao.$condTrans.' group by ano, mes, emitente','espec',$inner);


    $aDadosMes = $this->getDados('multi','PUB.fats_repres_clientes','mes, ano',
        $condicao.$condTrans.' group by mes, ano','espec',$inner);

    if($aDadosMes){
        $totMes = count($aDadosMes);
    }

    if(is_array($aDados)){
        foreach($aDados as $dados){
            $cliente = $dados['emitente'];
                if($cliente <> 0){
                    $listaClientes = $this->util_incr_valor($listaClientes,$cliente,',');
                    $aCliente = explode(',',$listaClientes);
                    $qtCli    = count($aCliente);
                }

        }



    }
    $aDadosCli = array(
        'qt_clientes' => $qtCli,
        'tot_mes'     => $totMes
    );

    return $aDadosCli;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtCliPeriodo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtAnoFatsRepresClientes ------*/

function getQtAnoFatsRepresClientes($represIni='000000',$represFim='999999',$listaCodReps=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaClientes = 0;
    $listaReps = $listaCodReps;
    $condAnoCorrente = "ano = ". date('Y');
    $loginCorrente =  $this->getLoginCorrente();
    $codRepLogin = $this->buscarCodRep($loginCorrente);
    $tipoUsuario = $this->getTipoUsuario($loginCorrente);
    $mesCur = date('m');


        for($i=0;$i<$mesCur;$i++){
            $meses = $mesCur - $i;
            $condMesCorrente = "mes = $meses";
            if($tipoUsuario <> 2){
                if($listaCodReps <> '' and $represIni <> $represFim){
                    $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep in($listaReps) ";
                }else{
                    $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep >= $represIni and cod_rep <= $represFim ";
                }
            }else{
                $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep = $codRepLogin ";
            }

            $aDados = $this->getDados('multi','PUB.fats_repres_clientes','
            cod_emitente as cliente,    
            sum(qt_dev),
            sum(qt_fat),   
            sum(vl_desconto),
            sum(vl_desconto_dev),
            sum(vl_devolucoes),
            sum(vl_faturamento) as fat,
            sum(vl_meta)',"$condicao  group by cliente
            order by sum(vl_faturamento) desc",'espec');

            $qtCli = 0;
            if(is_array($aDados)){
                foreach($aDados as $dados){
                    $cliente = $dados['cliente'];
                    $fat     = $dados['fat'];
                    if($fat > 0){
                        if($cliente <> 0){
                            $listaClientes = $this->util_incr_valor($listaClientes,$cliente,',');
                        }
                    }
                    $aCliente = explode(',',$listaClientes);
                    $qtCli = count($aCliente);
                }


            }

        }

    return $qtCli;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtAnoFatsRepresClientes ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtFatsRepresClientesPeriodo ------*/

function getQtFatsRepresClientesPeriodo($represIni='000000',$represFim='999999',$listaCodReps='',$dtIni='2020-01-01',$dtFim='2999-01-01'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $listaClientes = 0;
    $listaReps = $listaCodReps;
    $condAnoCorrente = "ano = ". date('Y');
    $loginCorrente =  $this->getLoginCorrente();
    $codRepLogin = $this->buscarCodRep($loginCorrente);
    $tipoUsuario = $this->getTipoUsuario($loginCorrente);
    $mesCur = date('m');
    $condicao = '';


    for($i=0;$i<$mesCur;$i++){
        $meses = $mesCur - $i;
        $condMesCorrente = "mes = $meses";
        if($tipoUsuario <> 2){
            if($listaCodReps <> '' and $represIni <> $represFim){
                $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep in($listaReps) ";
            }else{
                $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep >= $represIni and cod_rep <= $represFim ";
            }
        }else{
            $condicao = " $condAnoCorrente and $condMesCorrente and cod_rep = $codRepLogin ";
        }

        $aDados = $this->getDados('multi','PUB.fats_repres_clientes','
            cod_emitente as cliente,    
            sum(qt_dev),
            sum(qt_fat),   
            sum(vl_desconto),
            sum(vl_desconto_dev),
            sum(vl_devolucoes),
            sum(vl_faturamento) as fat,
            sum(vl_meta)',"$condicao  group by cliente
            order by sum(vl_faturamento) desc",'espec');

        $qtCli = 0;
        if(is_array($aDados)){
            foreach($aDados as $dados){
                $cliente = $dados['cliente'];
                $fat     = $dados['fat'];
                if($fat > 0){
                    if($cliente <> 0){
                        $listaClientes = $this->util_incr_valor($listaClientes,$cliente,',');
                    }
                }
                $aCliente = explode(',',$listaClientes);
                $qtCli = count($aCliente);
            }


        }

    }

    return $qtCli;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtFatsRepresClientesPeriodo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtNfsFatsRepres ------*/

function getQtNfsFatsRepres($tipo='mes_corrente',$codRepIni,$codRepFim,$listaRep='',$mesQtNfs,$codEstabel='5,505'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  

    $qtNfs = 0;
    $codRepLogin = $this->buscarCodRep($this->sc_temp_usr_login);
    $tipoUsuario = $this->getTipoUsuario($this->sc_temp_usr_login);
    $mes = date('m');
    $anoQtNfs = date('Y');
    if($tipoUsuario <> 2){
        if($listaRep <> '' and $codRepIni <> $codRepFim){
            if($tipo == 'mes_corrente'){
                $condicao = " cod_estabel in ($codEstabel) and mes >= $mesQtNfs and mes <= $mesQtNfs and ano = $anoQtNfs and cod_rep in ($listaRep) ";
            }else{
                $condicao = " cod_estabel in ($codEstabel) and mes >= 01 and mes <= $mes and ano = $anoQtNfs and cod_rep in ($listaRep) ";
            }

        }else{
            if($tipo == 'mes_corrente'){
                $condicao = " cod_estabel in ($codEstabel) and mes >= $mesQtNfs and mes <= $mesQtNfs and ano = $anoQtNfs and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }else{
                $condicao = " cod_estabel in ($codEstabel) and mes >= 01 and mes <= $mes and ano = $anoQtNfs and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
        }
    }else{
        if($tipo == 'mes_corrente'){
            $condicao = " cod_estabel in ($codEstabel) and mes >= $mesQtNfs and mes <= $mesQtNfs and ano = $anoQtNfs and cod_rep = $codRepLogin ";
        }else{
            $condicao = " cod_estabel in ($codEstabel) and mes >= 01 and mes <= $mes and ano = $anoQtNfs and cod_rep = $codRepLogin ";
        }
    }


    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres','qt_nf',$condicao.$condTrans,'espec',$inner);
    if(is_array($aDados)){

            foreach($aDados as $aQtNfs){
                $qtNfsMes = $aQtNfs['qt_nf'];
                $qtNfs = $qtNfs + $qtNfsMes;
            }

    }

    return $qtNfs;


if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtNfsFatsRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtNfsFatsRepresPeriodo ------*/

function getQtNfsFatsRepresPeriodo($codPeriodo,$tpUsuario,$codRepIni,$codRepFim,$listaRep='',$dtIni,$dtFim,$codEstabel='5,505'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $qtNfs = 0;

    $aDadosDash = $this->getCondPeriodoDashboard($codPeriodo,$tpUsuario,$listaRep,$codRepIni,$codRepFim,$dtIni,$dtFim,$codEstabel);
    if($aDadosDash){
        $condicao = $aDadosDash['condicao'];
    }

    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres','qt_nf',$condicao.$condTrans,'espec',$inner);
    if(is_array($aDados)){

        foreach($aDados as $aQtNfs){
            $qtNfsMes = $aQtNfs['qt_nf'];
            $qtNfs = $qtNfs + $qtNfsMes;
        }

    }

    return $qtNfs;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtNfsFatsRepresPeriodo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepres ------*/

function getDadosFatsRepres($tipo='mes_corrente', $campo='', $codRepIni='0', $codRepFim='99999', $listaRep='', $mesSel, $codEstabel='5,505', $anoSel=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  

    $vlTot = 0;
    $codRepLogin = $this->buscarCodRep($this->sc_temp_usr_login);
    $tipoUsuario = $this->getTipoUsuario($this->sc_temp_usr_login);
    if($codRepFim <> '99999'){
        $codRepLogin = $codRepFim;
        $tipoUsuario = 2;
    }
    $mesCor = date('m');
    if($anoSel == ''){
        $anoSel = date('Y');
    }
    if($tipoUsuario <> 2){
        if($listaRep <> '' and $codRepIni <> $codRepFim){
            if($tipo == 'mes_corrente'){
                $condicao = " cod_estabel in($codEstabel) and mes >= $mesSel and mes <= $mesSel and ano = $anoSel and cod_rep in ($listaRep) ";
            }else{
                $condicao = " cod_estabel in($codEstabel) and mes >= 01 and mes <= $mesCor and ano = $anoSel and cod_rep in ($listaRep) ";
            }

        }else{
            if($tipo == 'mes_corrente'){
                $condicao = " cod_estabel in($codEstabel) and mes >= $mesSel and mes <= $mesSel and ano = $anoSel and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }else{
                $condicao = " cod_estabel in($codEstabel) and mes >= 01 and mes <= $mesCor and ano = $anoSel and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
        }
    }else{
        if($tipo == 'mes_corrente'){
            $condicao = " cod_estabel in($codEstabel) and mes >= $mesSel and mes <= $mesSel and ano = $anoSel and cod_rep = $codRepLogin ";
        }else{
            $condicao = " cod_estabel in($codEstabel) and mes >= 01 and mes <= $mesCor and ano = $anoSel and cod_rep = $codRepLogin ";
        }
    }

    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';

    $aDados = $this->getDados('multi','PUB.fats_repres',$campo,$condicao.$condTrans,'espec',$inner);
    if(is_array($aDados)){

        foreach($aDados as $reg){
            $vlMes  = $reg[$campo];
            $vlTot += $vlMes;
        }

    }
    $vlTot = str_replace('-','',$vlTot);
    return $vlTot;


if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresPeriodo ------*/

function getDadosFatsRepresPeriodo($codPeriodo,$tpUsuario,$campo='',$codRepIni,$codRepFim,$listaRep='',$dtIni,$dtFim,$codEstabel='5,505'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $vlTot = 0;


    $aDadosDash = $this->getCondPeriodoDashboard($codPeriodo,$tpUsuario,$listaRep,$codRepIni,$codRepFim,$dtIni,$dtFim,$codEstabel);
    if($aDadosDash){
        $condicao = $aDadosDash['condicao'];
        $titulo  = $aDadosDash['titulo'];
    }

    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $aDados = $this->getDados('multi','PUB.fats_repres',$campo,$condicao.$condTrans,'espec',$inner);
    if(is_array($aDados)){

        foreach($aDados as $reg){
            $vlMes  = $reg[$campo];
            $vlTot += $vlMes;
        }

    }
    $vlTot = str_replace('-','',$vlTot);

    $aDadosDashboard = array(
        'vl_tot' => $vlTot,
        'titulo' => $titulo
    );
    return $aDadosDashboard;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosFatsRepresPeriodo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDtHrUltTransEspd004a ------*/

function getDtHrUltTransEspd004a(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $aDtHrTrans = array();

    $sql = "select dat_exec_ped_exec, hra_criac_ped_exec from pub.ped_exec p1
            where num_ped_exec in(
            select MAX(NUM_PED_EXEC)  from pub.ped_exec
            where cod_prog_dtsul = 'espd004a')";

    $aRegs = $this->getRegsSqlLivre($sql,'dat_exec_ped_exec ,hra_criac_ped_exec','fnd');

    if($aRegs){
        $dtTrans = $aRegs[0]['dat_exec_ped_exec'];
        $hrTrans = $aRegs[0]['hra_criac_ped_exec'];
        $dtTrans = new DateTime($dtTrans);
        $dtTrans = $dtTrans->format('d-m-Y');
        $hrTransH = substr($hrTrans,'0','2');
        $hrTransM = substr($hrTrans,'2','2');
        $hrTransS = substr($hrTrans,'4','2');
        $horario  = "$hrTransH:$hrTransM:$hrTransS";

        $aDtHrTrans = array(
            'hora' => $horario,
            'data' => $dtTrans
        );
    }

    return$aDtHrTrans;



$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDtHrUltTransEspd004a ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function ultAtuFatsRepres ------*/

function ultAtuFatsRepres(){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    

    $sql = "select dt_hr_ini from pub.transacoes t1
            where transacao_id in(
            select max(transacao_id) from pub.transacoes
            where chave like 'FAT-%')";

    $aRegs = $this->getRegsSqlLivre($sql,'dt_hr_ini','espec');
    $dtHrTrans = $aRegs[0]['dt_hr_ini'];
    $dtHrTrans = substr($dtHrTrans,'0','19');
    $dtHrTrans = date_create($dtHrTrans);
    $dtHrTrans = date_format($dtHrTrans,'d-m-Y H:i:s');
    return $dtHrTrans;




$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function ultAtuFatsRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getItensMaisVendidos ------*/

function getItensMaisVendidos($codRepIni,$codRepFim){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $sql = "SELECT    
    top 10
    it_codigo as item,      
    sum(vl_desconto) as vl_desc,
    sum(vl_desconto_dev) as vl_desc_dev,
    sum(vl_devolucoes) as vl_dev, 
    sum(vl_faturamento) as fat
FROM
    PUB.fats_repres_clientes_prod tb01    
    where ano = year(curdate()) and cod_rep >= $codRepIni and cod_rep <= $codRepFim
    group by it_codigo     
    order by sum(vl_faturamento) desc
    ";

    $aRegs = $this->getRegsSqlLivre($sql,'item,vl_desc,vl_desc_dev,vl_dev,fat','espec');
    $itensFats = '';
    $dadosItem = '';
    if($aRegs){
        foreach($aRegs as $itensFat){
            $item      = $itensFat['item'];
            $vlDesc    = $itensFat['vl_desc'];
            $vlDecDev  = $itensFat['vl_desc_dev'];
            $vlDev     = $itensFat['vl_dev'];
            $devol     = str_replace('-','',$vlDev);
            $vlFat     = $itensFat['fat'];
            $vlTotFat  = $vlFat + $vlDesc - ($devol + $vlDecDev);
            $vlTotFat  = $this->formatarPreco('real',$vlTotFat);
            $dadosItem = $item." - ".$vlTotFat;
            $itensFats = $this->util_incr_valor($itensFats,$dadosItem,' / ');
        }
    }
    return $dadosItem;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getItensMaisVendidos ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getCondPeriodoDashboard ------*/

function getCondPeriodoDashboard($codPeriodo=1,$tpUsuario,$listaRep='',$codRepIni=0,$codRepFim=99999,$dtIni='0001-01-01',$dtFim='9999-12-31',$codEstabel){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cond   = '';
    $titulo = '';
    $mesAtual   = date('m');
    $nomeMês = $this->convMes($mesAtual,'completo');
    $anoFim     = date('Y');
    if($mesAtual <> 1){
        $mesFim = $mesAtual - 1;
    }else{
        $mesFim = 12;
        $anoFim = $anoFim - 1;
    }
    if($codEstabel <> ''){
        $condicaoEstab = "cod_estabel in ($codEstabel) and";
    }else{
        $condicaoEstab = '';
    }
    $diasMesFim = $this->convMes($mesFim,'dias_mes');
    $dtFinal    =  "$anoFim-$mesFim-$diasMesFim";
    if($codPeriodo == ''){
        $codPeriodo = 1;
    }
    switch ($codPeriodo){
        case 1:   
            $titulo = $nomeMês;
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab ano = year(curdate()) and mes = month(curdate()) and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab ano = year(curdate()) and mes = month(curdate()) and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab ano = year(curdate()) and mes = month(curdate()) and cod_rep >= $codRepIni and cod_rep <= $codRepFim";
            }
            break;
        case 2:
            $titulo = ' Últimos 3 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 3:
            $titulo = 'Últimos 6 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 4: 
            $titulo = 'Últimos 12 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab dt_ini_mes >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 5: 
            $dataIni = date('d/m/Y', strtotime($dtIni));
            $mesFimInterval  = substr($dtFim,5,2);
            $diaFimInterval  = $this->convMes($mesFimInterval,'dias_mes');
            $dtFim = "$dtFim-$diaFimInterval";
            $dataFim = date('d/m/Y', strtotime($dtFim));
            $titulo = "Período: $dataIni á $dataFim";
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab dt_ini_mes >= '$dtIni' and dt_fim_mes <= '$dtFim' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab dt_ini_mes >= '$dtIni' and dt_fim_mes <= '$dtFim' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab dt_ini_mes >= '$dtIni' and dt_fim_mes <= '$dtFim' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
    }
    $aDadosDash = array (
        'condicao'   => $cond,
        'titulo' => $titulo
    );
    return $aDadosDash;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getCondPeriodoDashboard ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getCondPorDataDashboard ------*/

function getCondPorDataDashboard($codPeriodo=1,$tpUsuario,$listaRep='',$codRepIni=0,$codRepFim=99999,$dtIni='0001-01-01',$dtFim='9999-12-31',$codEstabel){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cond   = '';
    $titulo = '';
    $mesAtual   = date('m');
    $nomeMês = $this->convMes($mesAtual,'completo');
    $anoAtual = date('Y');
    $anoFim     = date('Y');
    if($mesAtual <> 1){
        $mesFim = $mesAtual - 1;
    }else{
        $mesFim = 12;
        $anoFim = $anoFim - 1;
    }
    if($codEstabel <> ''){
        $condicaoEstab = "cod_estabel in ($codEstabel) and";
    }else{
        $condicaoEstab = '';
    }

    $diasMesFim = $this->convMes($mesFim,'dias_mes');
    $dtFinal    =  "$anoFim-$mesFim-$diasMesFim";
    if($codPeriodo == ''){
        $codPeriodo = 1;
    }
    switch ($codPeriodo){
        case 1:   
            $titulo = $nomeMês;
            $dtIniMesAtu = "$anoAtual-$mesAtual-01";
            $diasMesAtu = $this->convMes($mesAtual,'dias_mes');
            $dtFimMesAtu = "$anoAtual-$mesAtual-$diasMesAtu";
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab data >= '$dtIniMesAtu' and data <= '$dtFimMesAtu' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab data >= '$dtIniMesAtu' and data <= '$dtFimMesAtu' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab data >= '$dtIniMesAtu' and data <= '$dtFimMesAtu' and cod_rep >= $codRepIni and cod_rep <= $codRepFim";
            }
            break;
        case 2:
            $titulo = ' Últimos 3 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and data <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab data >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab data >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 3:
            $titulo = 'Últimos 6 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab data >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and data <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab data >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab data >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 4: 
            $titulo = 'Últimos 12 meses';
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab data >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and data <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab data >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab data >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and data <= '$dtFinal' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
        case 5: 
            $dataIni = date('d/m/Y', strtotime($dtIni));
            $mesFimInterval  = substr($dtFim,5,2);
            $diaFimInterval  = $this->convMes($mesFimInterval,'dias_mes');
            $dtFim = "$dtFim-$diaFimInterval";
            $dataFim = date('d/m/Y', strtotime($dtFim));
            $titulo = "Período: $dataIni á $dataFim";
            if($tpUsuario <> 2){
                if($listaRep <> '' and $codRepIni <> $codRepFim){
                    $cond = " $condicaoEstab data >= '$dtIni' and data <= '$dtFim' and cod_rep in($listaRep)";
                }else{
                    $cond = " $condicaoEstab data >= '$dtIni' and data <= '$dtFim' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
                }
            }else{
                $cond = " $condicaoEstab data >= '$dtIni' and data <= '$dtFim' and cod_rep >= $codRepIni and cod_rep <= $codRepFim ";
            }
            break;
    }
    $aDadosDash = array (
        'condicao'   => $cond,
        'titulo' => $titulo
    );
    return $aDadosDash;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getCondPorDataDashboard ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getCondPerDashboardRanking ------*/

function getCondPerDashboardRanking($codPeriodo=1,$listaRep='',$dtIni='0001-01-01',$dtFim='9999-12-31'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $cond   = '';
    $titulo = '';
    $mesAtual   = date('m');
    $nomeMês = $this->convMes($mesAtual,'completo');
    $anoFim     = date('Y');
    if($mesAtual <> 1){
        $mesFim = $mesAtual - 1;
    }else{
        $mesFim = 12;
        $anoFim = $anoFim - 1;
    }
    $diasMesFim = $this->convMes($mesFim,'dias_mes');
    $dtFinal    =  "$anoFim-$mesFim-$diasMesFim";

    if($codPeriodo == ''){
        $codPeriodo = 1;
    }
    switch ($codPeriodo){
        case 1:   
            $titulo = $nomeMês;
                if($listaRep <> ''){
                    $cond = " ano = year(curdate()) and mes = month(curdate()) and cod_rep in($listaRep)";
                }else{
                    $cond = " ano = year(curdate()) and mes = month(curdate())";
                }

            break;
        case 2:
            $titulo = ' Últimos 3 meses';

                if($listaRep <> ''){
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 90)) + '-' + to_char(month(curdate() - 90)) + '-01' and dt_fim_mes <= '$dtFinal'";
                }

            break;
        case 3:
            $titulo = 'Últimos 6 meses';

                if($listaRep <> ''){
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 180)) + '-' + to_char(month(curdate() - 180)) + '-01' and dt_fim_mes <= '$dtFinal'";
                }

            break;
        case 4: 
            $titulo = 'Últimos 12 meses';
                if($listaRep <> ''){
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and dt_fim_mes <= '$dtFinal' and cod_rep in($listaRep)";
                }else{
                    $cond = " dt_ini_mes >= to_char(year(curdate() - 360)) + '-' + to_char(month(curdate() - 360)) + '-01' and dt_fim_mes <= '$dtFinal' ";
                }

            break;
        case 5: 
            $dataIni = date('d/m/Y', strtotime($dtIni));
            $mesFimInterval  = substr($dtFim,5,2);
            $diaFimInterval  = $this->convMes($mesFimInterval,'dias_mes');
            $dtFim = "$dtFim-$diaFimInterval";
            $dataFim = date('d/m/Y', strtotime($dtFim));
            $titulo = "Período: $dataIni á $dataFim";

                if($listaRep <> ''){
                    $cond = " dt_ini_mes >= '$dtIni' and dt_fim_mes <= '$dtFim' and cod_rep in($listaRep)";
                }else{
                    $cond = " dt_ini_mes >= '$dtIni' and dt_fim_mes <= '$dtFim' ";
                }

            break;
    }
    $aDadosDash = array (
        'condicao'   => $cond,
        'titulo' => $titulo
    );
    return $aDadosDash;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getCondPerDashboardRanking ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosRanking ------*/

function getDadosRanking($repIni,$repFim,$campo='',$numMes='',$listaCodReps=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $fatur = $this->getDadosFatsRepres('mes_corrente',$campo,$repIni,$repFim,$listaCodReps,$numMes);




$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosRanking ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDadosRankingKendo ------*/

function getDadosRankingKendo($numMes='',$tipoVl='fat_liq',$listaCodReps='',$ano=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condCompl = "";
    $aLbFat = array();
    $aMeta  = array();
    $aFatur = array();
    $aMetaPercVendido = array();
    if($listaCodReps <> ''){
        $condCompl = "and cod_rep in ($listaCodReps)";
    }
    $mesCorrente = date('m');
    $anoCorrente = date('Y');

    if($numMes == ''){
        $numMes = $mesCorrente;
    }
    if($ano == ''){
        $ano = $anoCorrente;
    }

    $condMes = "mes = $numMes";
    $condAno = "ano = $ano";

    if($mesCorrente == $numMes and $anoCorrente == $ano){
        $lMesCorrente = true;
    }else{
        $lMesCorrente = false;
    }




    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id ';
    $condTrans = ' and ind_sit_transacao = 1';
    $condicao = "$condMes and $condAno $condCompl $condTrans";
    $aDados = $this->getDados('multi', 'PUB.fats_repres',
        'cod_rep,  
                sum(vl_desconto) as vl_desc,
                sum(vl_desconto_dev) as vl_desc_dev,
                sum(vl_devolucoes) as devol,
                sum(vl_faturamento) as vl_fat,
                sum(vl_meta) as meta'
        ,
        " $condicao  group by cod_rep",
        'espec',$inner);

    if(is_array($aDados)) {
        $tam = count($aDados);
        for ($i = 0; $i < $tam; $i++) {
            $vlFat = $aDados[$i]['vl_fat'];
            $vlDesc = $aDados[$i]['vl_desc'];
            $vlDevol = $aDados[$i]['devol'];
            $vlDescDev = $aDados[$i]['vl_desc_dev'];
            $vlMeta = $aDados[$i]['meta'];
            $aDados[$i]['valor_cheio'] = $vlFat + $vlDesc + $vlDevol + $vlDescDev;
            switch ($tipoVl) {
                case 'fat_liq':
                     $aDados[$i]['valor'] = $vlFat + $vlDesc + $vlDevol + $vlDescDev;

                     $aFat[$i]   = $aDados[$i]['valor'];

                    break;
                case 'perc_meta':
                    if ($vlMeta <> 0) {
                        $aDados[$i]['valor'] = ($vlFat + $vlDesc + $vlDevol + $vlDescDev) / $vlMeta ;

                    } else {
                        $aDados[$i]['valor'] = 0;

                    }
                    break;
            }


        }


        if($aDados){
            foreach ($aDados as $key => $row) {
                $aFat[$key]  = $row['valor'];
            }
            array_multisort($aFat,SORT_DESC,SORT_NUMERIC,$aDados);
        }

        $iPosicao = 0;
        if(is_array($aDados)){
            foreach($aDados as $chave => $reg){
                $iPosicao++;
                $repres             = $aDados[$chave]['cod_rep'];
                $aFatur[$chave]     = $aDados[$chave]['valor'];
                if($aFatur[$chave] < 0 ){
                    $espaco =  '&nbsp;';
                    $espaco = str_repeat($espaco,2);
                }else{
                    $espaco = '';
                }
                $aLbFat[$chave]     = $this->getNomeAbrevRepres($repres)." - {$iPosicao}&#186; / $tam $espaco";
                $aMeta[$chave]      = floatval($aDados[$chave]['meta']) ;
                $aMetaPerc[$chave]  = 1 ;

                if($lMesCorrente){

                    $aMetaPercVendido[$chave]    = floatval($this->execOperMat('divisao',$aDados[$chave]['valor_cheio'],$aDados[$chave]['meta']));
                    $aMeta[$chave]               = $this->calcPropDiasUteisMes($aDados[$chave]['meta']);


                }
            }
        }

    }
    if($lMesCorrente){
        $calcIdeal = $this->calcPropDiasUteisMes(1);
    }else{
        $calcIdeal = floatval(1.0) ;
    }

    return array('repres'=>$aLbFat,
                'meta'=>$aMeta,
                'valor'=>$aFatur,
                'meta_perc_vendido'=>$aMetaPercVendido,
                'meta_perc_ideal'=>$calcIdeal);

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDadosRankingKendo ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtItensFatUm ------*/

function getQtItensFatUm($periodo,$tpUsuar,$listaRep='',$codRepIni,$codRepFim,$dtInicial,$dtFinal,$um='',$codEstab='5,505'){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $condCompl = '';
    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres_clientes_prod_data.transacao_id ';
    $aCondicao = $this->getCondPorDataDashboard($periodo,$tpUsuar,$listaRep,$codRepIni,$codRepFim,$dtInicial,$dtFinal,$codEstab);
    $condTrans = ' and ind_sit_transacao = 1';
    $condicaoCor  = $aCondicao['condicao'].$condTrans;
    if($um <> ''){
        $condCompl = ' and um = '."'$um'";
    }
    $aDados = $this->getDados('multi', 'PUB.fats_repres_clientes_prod_data',
        'top 10
                it_codigo as item,    
                sum(qt_dev) as qt_dev,
                sum(qt_fat) as qt_fat,
                sum(qt_fat - qt_dev) as qt_tot'
        ,
        " $condicaoCor $condCompl  group by it_codigo order by qt_tot desc",
        'espec',$inner);
    return $aDados;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtItensFatUm ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getFatMetaFatsRepres ------*/

function getFatMetaFatsRepres($periodo,$tpUsuar,$listaRep='',$codRepIni,$codRepFim,$dtInicial,$dtFinal,$codEstab,$logGer=0,$usuar=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $metaGeral = '';
    $aMes = '';
    $tpGer     = 0;
    $condTrans = ' and ind_sit_transacao = 1';
    $inner     = 'inner join PUB.transacoes on PUB.transacoes.transacao_id = PUB.fats_repres.transacao_id';
    $aCondicao = $this->getCondPeriodoDashboard($periodo,$tpUsuar,$listaRep,$codRepIni,$codRepFim,$dtInicial,$dtFinal,$codEstab);
    $condicaoCor  = $aCondicao['condicao'].$condTrans;
    $aDados = $this->getDados('multi', 'PUB.fats_repres',
        'ano, mes, sum(vl_faturamento) as fat,sum(vl_devolucoes) as dev, sum(vl_meta) as meta '
        ,
        "$condicaoCor group by ano, mes order by ano desc, mes desc" ,
        'espec',$inner);

    if($logGer <> 0){
        $codGer = $this->buscarCodRep($usuar);
        if($codGer <> ''){
            $tpGer = $this->getTpHierarquiaGer($codGer);
        }
    }
    if($aDados){
        foreach($aDados as $dados){
            $ano = $dados['ano'];
            $mes = $dados['mes'];
            $metaGeral = $this->getMetaGeral($mes,$ano);
            if($metaGeral == ''){
                $metaGeral = $dados['meta'];
            }
            if($tpGer == 3 and $codRepIni <> $codRepFim){
                $metaGeral = $this->getMetasGerentes($codGer,$mes,$ano);
            }
            $fatur = $dados['fat'];
            $devol = $dados['dev'];
            $fatTot = $fatur + $devol;

            $aDadosGeral[] = array('ano'=>$ano,'mes'=>$mes,'fat_tot'=>$fatTot,'meta'=>$metaGeral);
        }


    }


    return $aDadosGeral;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getFatMetaFatsRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getQtRepMaisAtendMes ------*/

function getQtRepMaisAtendMes($mesCor){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  
    $qtMaiorCliRep = 0;
    $aDadosReps = $this->getDados('multi','PUB.fats_repres_clientes','distinct cod_rep as reps','1=1','espec');
    foreach ($aDadosReps as $codReps){
        $codRep = $codReps['reps'];
        $qtClientesMesAtu    = $this->getDadosFatsRepresClientes(1,'mes_corrente',$codRep,$codRep,$mesCor);
        if($qtClientesMesAtu > $qtMaiorCliRep){
            $qtMaiorCliRep = $qtClientesMesAtu;
        }
        $nomeRep = $this->getNomeAbrevRepres($codRep);
    }
    return $qtMaiorCliRep;


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getQtRepMaisAtendMes ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDescEstabFatsRepres ------*/

function getDescEstabFatsRepres($codEstab){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $descEstab = '';

    switch($codEstab){
        case '5':
            $descEstab = "VILA VELHA - ES";
            break;
        case '505':
            $descEstab = "ITAJAÍ - SC";
            break;
    }

    return $descEstab;

$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDescEstabFatsRepres ------*/


/*----- Scriptcase Locale: PHP Method: fats_repres.php => function getDevolFatsRepres ------*/

function getDevolFatsRepres($mes,$ano,$rep=''){
$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'on';
  

    $condicao = " ano = $ano and mes = $mes";
    if($rep <> ''){
        $condicao .= " and cod_rep = $rep";
    }
    $aDados = $this->getDados('multi','PUB.fats_repres','sum(vl_devolucoes) as devol','1=1 and '.$condicao,'espec');

    if($aDados){
        return $aDados[0]['devol'];
    }else{
        return 0;
    }


$_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: fats_repres.php => function getDevolFatsRepres ------*/

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
                  $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger'][substr($val, 1, -1)];
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['iframe_print']) && $_SESSION['sc_session'][$this->Ini->sc_page]['bl_pag_ini_ger']['iframe_print'] )
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
   SC_dir_app_ini('ImaOnLine');
   $_SESSION['scriptcase']['bl_pag_ini_ger']['contr_erro'] = 'off';
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
            nm_limpa_str_bl_pag_ini_ger($nmgp_val);
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
            nm_limpa_str_bl_pag_ini_ger($nmgp_val);
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
       if (isset($_COOKIE['sc_apl_default_ImaOnLine'])) {
           $apl_def = explode(",", $_COOKIE['sc_apl_default_ImaOnLine']);
       }
       elseif (is_file($root . $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp'] . "/sc_apl_default_ImaOnLine.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['bl_pag_ini_ger']['glo_nm_path_imag_temp'] . "/sc_apl_default_ImaOnLine.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "bl_pag_ini_ger") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_ImaOnLine'])) {
               $_SESSION['scriptcase']['bl_pag_ini_ger']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_ImaOnLine'];
           }
       }
   }
   if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
   {
       $_SESSION['sc_session']['SC_parm_violation'] = true;
   }
   if (isset($_POST["usr_login"])) 
   {
       $_SESSION["usr_login"] = $_POST["usr_login"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["usr_login"]);
   }
   if (isset($_GET["usr_login"])) 
   {
       $_SESSION["usr_login"] = $_GET["usr_login"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["usr_login"]);
   }
   if (!isset($_SESSION["usr_login"])) 
   {
       $_SESSION["usr_login"] = "";
   }
   if (isset($_POST["lista_reps_ger"])) 
   {
       $_SESSION["lista_reps_ger"] = $_POST["lista_reps_ger"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["lista_reps_ger"]);
   }
   if (isset($_GET["lista_reps_ger"])) 
   {
       $_SESSION["lista_reps_ger"] = $_GET["lista_reps_ger"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["lista_reps_ger"]);
   }
   if (!isset($_SESSION["lista_reps_ger"])) 
   {
       $_SESSION["lista_reps_ger"] = "";
   }
   if (isset($_POST["tipoUsuario"])) 
   {
       $_SESSION["tipoUsuario"] = $_POST["tipoUsuario"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["tipoUsuario"]);
   }
   if (!isset($_POST["tipoUsuario"]) && isset($_POST["tipousuario"])) 
   {
       $_SESSION["tipoUsuario"] = $_POST["tipousuario"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["tipoUsuario"]);
   }
   if (isset($_GET["tipoUsuario"])) 
   {
       $_SESSION["tipoUsuario"] = $_GET["tipoUsuario"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["tipoUsuario"]);
   }
   if (!isset($_GET["tipoUsuario"]) && isset($_GET["tipousuario"])) 
   {
       $_SESSION["tipoUsuario"] = $_GET["tipousuario"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["tipoUsuario"]);
   }
   if (!isset($_SESSION["tipoUsuario"])) 
   {
       $_SESSION["tipoUsuario"] = "";
   }
   if (isset($_POST["nomeRepresIni"])) 
   {
       $_SESSION["nomeRepresIni"] = $_POST["nomeRepresIni"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["nomeRepresIni"]);
   }
   if (!isset($_POST["nomeRepresIni"]) && isset($_POST["nomerepresini"])) 
   {
       $_SESSION["nomeRepresIni"] = $_POST["nomerepresini"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["nomeRepresIni"]);
   }
   if (isset($_GET["nomeRepresIni"])) 
   {
       $_SESSION["nomeRepresIni"] = $_GET["nomeRepresIni"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["nomeRepresIni"]);
   }
   if (!isset($_GET["nomeRepresIni"]) && isset($_GET["nomerepresini"])) 
   {
       $_SESSION["nomeRepresIni"] = $_GET["nomerepresini"];
       nm_limpa_str_bl_pag_ini_ger($_SESSION["nomeRepresIni"]);
   }
   if (!isset($_SESSION["nomeRepresIni"])) 
   {
       $_SESSION["nomeRepresIni"] = "";
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
   if (isset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu']);
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "bl_pag_ini_ger";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'bl_pag_ini_ger' || $achou)
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
        $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['iframe_menu'] = $salva_iframe;
   }

   if (!isset($_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '.php'))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize'] = true;
   }
   else
   {
       $sReferer = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '.php'));
       $sReferer = substr($sReferer, strrpos($sReferer, '/') + 1);
       if ('bl_pag_ini_ger' == $sReferer || 'bl_pag_ini_ger_' == substr($sReferer, 0, 15))
       {
           $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize'] = false;
       }
       else
       {
           $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['initialize'] = true;
       }
   }

   $_POST['script_case_init'] = $script_case_init;
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'bl_pag_ini_ger')
   {
       $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['bl_pag_ini_ger']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/bl_pag_ini_ger_erro.php");
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
                nm_limpa_str_bl_pag_ini_ger($cadapar[1]);
                if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                $Tmp_par   = $cadapar[0];;
                $$Tmp_par = $cadapar[1];
            }
            $ix++;
       }
       if (isset($usr_login)) 
       {
           $_SESSION['usr_login'] = $usr_login;
           nm_limpa_str_bl_pag_ini_ger($_SESSION["usr_login"]);
       }
       if (isset($lista_reps_ger)) 
       {
           $_SESSION['lista_reps_ger'] = $lista_reps_ger;
           nm_limpa_str_bl_pag_ini_ger($_SESSION["lista_reps_ger"]);
       }
       if (!isset($tipoUsuario) && isset($tipousuario)) 
       {
           $_SESSION["tipoUsuario"] = $tipousuario;
       }
       if (isset($tipoUsuario)) 
       {
           $_SESSION['tipoUsuario'] = $tipoUsuario;
           nm_limpa_str_bl_pag_ini_ger($_SESSION["tipoUsuario"]);
       }
       if (!isset($nomeRepresIni) && isset($nomerepresini)) 
       {
           $_SESSION["nomeRepresIni"] = $nomerepresini;
       }
       if (isset($nomeRepresIni)) 
       {
           $_SESSION['nomeRepresIni'] = $nomeRepresIni;
           nm_limpa_str_bl_pag_ini_ger($_SESSION["nomeRepresIni"]);
       }
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0;  
   $contr_bl_pag_ini_ger = new bl_pag_ini_ger_apl();
   $contr_bl_pag_ini_ger->controle();
//
   function nm_limpa_str_bl_pag_ini_ger(&$str)
   {
   }
?>
