<?php
   include_once('bl_sincrIpiItensContainer_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems5w']         = "ems5w";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_comumw']         = "comumw";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems2ima']         = "ems2ima";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems2med']         = "ems2med";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ticontrole2']         = "ticontrole2";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_dinamico']         = "dinamico";
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
    if(empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class bl_sincrIpiItensContainer_ini
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
   var $nm_db_ems5w;
   var $nm_con_ems5w = array();
   var $nm_db_comumw;
   var $nm_con_comumw = array();
   var $nm_db_multi;
   var $nm_con_multi = array();
   var $nm_db_ems5;
   var $nm_con_ems5 = array();
   var $nm_db_ems2ima;
   var $nm_con_ems2ima = array();
   var $nm_db_ems2med;
   var $nm_con_ems2med = array();
   var $nm_db_comum;
   var $nm_con_comum = array();
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
      $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "bl_sincrIpiItensContainer"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "Importacao"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20190113"; 
      $this->nm_hr_criacao   = "065703"; 
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
      $this->path_prod       = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_doc'];
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
      if (!isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['sub_cons_schema_filter'];
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
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/bl_sincrIpiItensContainer';
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
      $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
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

      if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['actual_lang']) || $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['actual_lang'] = $this->str_lang;
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
          include_once("bl_sincrIpiItensContainer_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
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
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['ancor_save'] = $_POST['ancor_save'];
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_sincrIpiItensContainer"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_sincrIpiItensContainer"] as $sTmpTargetLink => $sTmpTargetWidget)
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
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['link_info']['margin_top'] = $link_margin_top;
        }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']);
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
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir']))
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
      $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['path_doc'] = $this->path_doc; 
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan'])) 
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
      include_once($this->path_aplicacao . "bl_sincrIpiItensContainer_erro.class.php"); 
      $this->Erro = new bl_sincrIpiItensContainer_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('bl_sincrIpiItensContainer'); 
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
      if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir'])) {
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
          if ($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir_tp'] == "R") {
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
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']);
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
      $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQBiH9BiHIBeD5JeDMBOV9BUDWF/VEFGD9BiZ1B/HANOV5JwHgNOHErCHEB3DoBqD9NmH9FUDSN7HuFaHuNOZSrCH5FqDoXGHQJmZ1BiHAN7HQJwDEBODkFeH5FYVoFGHQJKDQBqD1veD5B/HgvOVcXKV5X7HMJsHQBiZ1F7HANOHQNUHgrKHEXeV5FqHIF7HQJeDQJsD1veHuX7DMNOVcFeDWXCDoJsDcBwH9B/Z1rYHQJwDErKZSXeDWr/DoFUDcJeH9FGHANOV5JwHuNOVIFCHEF/DoraHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoB/DcJeH9X7HIBeV5raHuzGDkBOHEFYDoJsDcBqH9FaHAN7HQrqDErKHEFiHEFqHIF7D9NmDQJsHABYD5NUHuzGDkBsH5FqVoraD9BsZSFaD1rKD5NUDEBeHEXeV5XCVoB/D9NwZ9JeZ1N7V5JeHuvmVcrsDWXCHMBiD9BsVIraD1rwV5X7HgBeHEFiH5F/ZuBqDcXGZSFGD1veD5XGHgvOVIBOHEF/VoJwDcJUZSB/HABYV5JeDMveHEJGDWX7HIXGHQNwDQFaHAveD5NUHgNKDkBOV5FYHMBiHQBiZkBiDSNOHQFGHgNOZSJqDWF/HMBODcXGZ9rqZ1zGVWJeDMNOVIB/DWJeHINUHQNwVIraZ1rYHQFGDMvCHErCH5FGZuFaHQNmZ9JeZ1BYHQFaDMNOV9BUH5XKVEF7HQXGZ1FUD1rwV5FGDEBeHEXeH5X/DoF7HQNmDuBqDSN7HuNUDMBOV9FeHEX7HMX7DcFYVIraZ1vOZMJeDMveVkJ3HEXCHMJsHQFYZ9JeZ1BYHuFUDMNODkB/Dur/HIraHQBqZ1FUZ1rYHQFUHgBeDkB/H5FGDoXGHQJKZ9JeD1BeD5rqHuvmVcBOH5B7VoBqHQNGVIraDSvmV5JwDMrYHErCHEFqVoBODcJUDQJsZ1BYVWJwHuNOVcrsH5XCDoFGD9XOZ1F7HIrwV5FaDMrYHErCHEFqHIBiD9NwZ9rqHAveV5FUHuzGVIBOH5XKVoFaD9XOH9B/HIveD5FaDEvsZSXeV5B3VoX7DcJUDQJwDSBYV5JwHuBYV9FiDWXCVoBqDcBqZ1B/Z1vmD5raDEvsHEJGH5FYVoB/DcJUDQJsHABYD5BqHuBYVcFKDur/DoraD9XOVIraHArKD5FaDMzGDkFeDWF/ZuFaD9JKDQJsHABYD5F7HgNKVcFKDWF/VoraD9XOVIraHArKV5FGDEBeHEXeH5FYVoB/D9XsH9FGD1BeD5BqHuNOVIBODuFGDoJsDcBwH9B/HIrwV5JeDMBYDkBsH5FYHIF7HQJeH9BiHIvsVWJwDMvsVcXKDWFaHIBiHQFYZ1BOHIBeHQFaHgveDkXKDWr/HIrqHQXGDuFaHANOHQJwDMNOVcFeHEX7HMJsHQFYZkFGDSBeHuB/DMveHArCHEB3ZuJeDcJUZSX7HIBeD5BqHgvsZSJ3H5FqHMBqHQBqZSBODSNOHuX7HgvsHArCDuFYHIrqHQXGDQFUHANKV5BqHgrwV9FeDWF/HMXGHQFYZ1BOHAN7HuBqHgBOHArsDWrGDoJeHQXGDQFUHANOHurqHgrwVcXKDWF/HIBiDcBwH9B/HIrwV5JeDMBYDkBsH5FYHMBOHQJeZ9XGHANOHuX7DMzGVcXKHEFYHIF7HQFYZ1BOHANOHQFGHgBYHErCHEFaHIJwHQXGDuFaHIrKHuB/DMzGDkBsDuX7HIBiHQFYZkFGHIBOZMBOHgNODkB/DuJeHMFGDcJUZSX7HIBeD5BqHgvsZSJ3H5FqVoFGDcBqH9BOZ1BeD5BqDMBYHEJGH5F/VoJeDcXOZ9rqZ1rwVWJeHgvsVcFCDWrmVoraD9BiH9FaHIBeZMBOHgvCZSXeH5FYVoX7D9JKDQX7HABYD5NUHuBYVcrsH5B7VoraDcBqH9B/HIrwV5JeDMzGHEXeV5XCZuFaHQBiDuBOZ1rwVWXGHgrKVcBODWrmVEF7HQFYH9FaHIBeV5FaDMBYDkFeV5FaDoXGDcJeZ9F7DSzGVWBODMrwZSJ3H5FqDoJeD9JmZ1B/D1NaD5rqDErKZSXeH5FYDoFUD9JKDQJsZ1rwV5BqHuBYVcXKV5X7DoraD9BsZ1B/HABYV5JeDEBOHErCDWF/VoBiDcJUZSX7Z1BYHuFaDMvOZSNiDWB3VoX7HQNwZkBiHAvsZMB/HgveDkXKHEFqHIJsD9XsZ9JeD1BeD5F7DMvmVcFKDWXKVoX7D9JmH9FaHABYHuJwHgBeHArCDWX7HMBiHQFYZ9F7D1BeHuFGDMBODkB/Dur/VoB/HQNmZSBqHArKV5FUDMrYZSXeV5FqHIJsHQNmDQX7HABYD5JsHuBYVcFKDWFYVEX7D9BiZ1F7DSrYV5FGDMrYHErCHEFqVoFGD9NwDQJsZ1rwV5BOHuBYVcFKDWr/DoF7VQBqH9B/Z1BOD5raDMzGHAFKDWF/HIFUD9FYDQJwHAveV5JwHuzGVIFCH5XCVoB/VQJUZ9X7D1rwD5FaDMrYHErCDuFYZuFaDcBwDQJsHArYHuFaHuNOZSrCH5FqDoXGHQJmZ1BiDSvOV5FUHgveHEBOV5JeZura";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['initialize'])  
      { 
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['Gera_log_access'] = true;
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['initialize']      = false;
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan'])) 
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
              if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']) && $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil']) && $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']))
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
          db_conect_devel('ems5w', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_ems5w['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5w['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5w['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5w['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5w['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5w['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5w['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_ems5w['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5w['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_ems5w['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_ems5w['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
          }
          db_conect_devel('comumw', $this->root . $this->path_prod, 'Importacao', 2, $this->force_db_utf8); 
          $this->nm_con_comumw['servidor']    = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comumw['usuario']     = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comumw['banco']       = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comumw['senha']       = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comumw['tpbanco']     = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comumw['decimal']     = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comumw['SC_sep_date'] = $_SESSION['scriptcase']['glo_date_separator'];
          $this->nm_con_comumw['protect']     = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comumw['glo_database_encoding'] = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $this->nm_con_comumw['nm_arr_db_extra_args'] = array(); 
          if (isset($_SESSION['scriptcase']['glo_use_ssl']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
          }
          if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslmode']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslkey']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
          }
          if (isset($_SESSION['scriptcase']['postgres_sslcert']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_encrypt']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststore']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
          }
          if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
          }
          if (isset($_SESSION['scriptcase']['oracle_type']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_charset']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_rolename']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
          }
          if (isset($_SESSION['scriptcase']['ibase_dialect']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
          }
          if (isset($_SESSION['scriptcase']['security']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['security'] = $_SESSION['scriptcase']['security']; 
          }
          if (isset($_SESSION['scriptcase']['sslservercertificate']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientkeystash']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
          }
          if (isset($_SESSION['scriptcase']['authentication']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['authentication'] = $_SESSION['scriptcase']['authentication']; 
          }
          if (isset($_SESSION['scriptcase']['sslclientlabel']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
          }
          if (isset($_SESSION['scriptcase']['use_ssh']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_server']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_user']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_port']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_privatecert']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localserver']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localport']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
          }
          if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
          {
              $this->nm_con_comumw['nm_arr_db_extra_args']['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
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
      if (isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems5w'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems5w['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5w['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5w['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5w['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5w['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5w['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5w['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5w['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5w['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_comumw'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_comumw['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comumw['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comumw['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comumw['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comumw['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comumw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comumw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comumw['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comumw['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems2ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ems2med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ticontrole2'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida_init']) 
      {
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
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date1'];
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan'])) 
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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_conexao'], $this->root . $this->path_prod, 'Importacao', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      $this->Db->debug = true;
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
          $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
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
      $this->nm_db_especw->debug = true;
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_ems5w['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_ems5w['nm_arr_db_extra_args'])?$this->nm_con_ems5w['nm_arr_db_extra_args']:array();
      $this->nm_db_ems5w = db_conect($this->nm_con_ems5w['tpbanco'], $this->nm_con_ems5w['servidor'], $this->nm_con_ems5w['usuario'], $this->nm_con_ems5w['senha'], $this->nm_con_ems5w['banco'], $this->nm_con_ems5w['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_ems5w['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_ems5w['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_ems5w->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_ems5w->Execute("set dateformat ymd");
          $this->nm_db_ems5w->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_ems5w['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_ems5w->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_ems5w['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_ems5w->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_ems5w->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_ems5w['decimal'] = "."; 
      } 
      $this->nm_db_ems5w->debug = true;
      $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_con_comumw['glo_database_encoding'];
      $nm_arr_db_extra_args = isset($this->nm_con_comumw['nm_arr_db_extra_args'])?$this->nm_con_comumw['nm_arr_db_extra_args']:array();
      $this->nm_db_comumw = db_conect($this->nm_con_comumw['tpbanco'], $this->nm_con_comumw['servidor'], $this->nm_con_comumw['usuario'], $this->nm_con_comumw['senha'], $this->nm_con_comumw['banco'], $this->nm_con_comumw['protect'], 'S', 'N', '', $databaseEncoding, $nm_arr_db_extra_args); 
      if (in_array(strtolower($this->nm_con_comumw['tpbanco']), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if (in_array(strtolower($this->nm_con_comumw['tpbanco']), $this->nm_bases_sybase))
      {
          $this->nm_db_comumw->fetchMode = ADODB_FETCH_BOTH;
          $this->nm_db_comumw->Execute("set dateformat ymd");
          $this->nm_db_comumw->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_con_comumw['tpbanco']), $this->nm_bases_mssql))
      {
          $this->nm_db_comumw->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_con_comumw['tpbanco']), $this->nm_bases_oracle))
      {
          $this->nm_db_comumw->Execute("alter session set nls_date_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->nm_db_comumw->Execute("alter session set nls_numeric_characters = '.,'");
          $this->nm_con_comumw['decimal'] = "."; 
      } 
      $this->nm_db_comumw->debug = true;
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
      $this->nm_db_multi->debug = true;
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
      $this->nm_db_ems5->debug = true;
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
      $this->nm_db_ems2ima->debug = true;
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
      $this->nm_db_ems2med->debug = true;
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
      $this->nm_db_comum->debug = true;
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
      $this->nm_db_cfsc->debug = true;
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
      $this->nm_db_log_db->debug = true;
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
      $this->nm_db_ticontrole2->debug = true;
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
      $this->nm_db_ima->debug = true;
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
      $this->nm_db_med->debug = true;
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
      $this->nm_db_geral->debug = true;
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
      $this->nm_db_dinamico->debug = true;
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['embutida'])
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date1'];
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
       if (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_sincrIpiItensContainer', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_sincrIpiItensContainer', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'bl_sincrIpiItensContainer', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
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
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_sincrIpiItensContainer']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
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
class bl_sincrIpiItensContainer_apl
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

      $this->Ini = new bl_sincrIpiItensContainer_ini(); 
      $this->Ini->init();
      $this->Change_Menu = false;
      if (isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_sincrIpiItensContainer']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_sincrIpiItensContainer'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_sincrIpiItensContainer']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_sincrIpiItensContainer']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('bl_sincrIpiItensContainer') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_sincrIpiItensContainer']['label'] = "" . $this->Ini->Nm_lang['lang_othr_blank_title'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "bl_sincrIpiItensContainer")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['Gera_log_access'])
      {
          $this->Ini->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['Gera_log_access'] = false;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['bl_sincrIpiItensContainer']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['bl_sincrIpiItensContainer']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['bl_sincrIpiItensContainer']['exit'];
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
      include_once($this->Ini->path_aplicacao . "bl_sincrIpiItensContainer_erro.class.php"); 
      $this->Erro      = new bl_sincrIpiItensContainer_erro();
      $this->Erro->Ini = $this->Ini;
//
      header("X-XSS-Protection: 1; mode=block");
      header("X-Frame-Options: SAMEORIGIN");
      $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  $this->sincrIpiItensContainer(184018);
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off'; 
//--- 
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
function buscarCotacaoDolarVendaBC($serieParam = 1, $tempo = 3, $tipoRetorno = 'valor', $logHist = true, $logForcarBusca = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirHistCotacaoBc($serie, $data, $valor, $nome, $logOk)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosCotacaoHoje($serieParam = 1)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $data = date('Y-m-d');
    $aRet = $this->getDadosHistCotacoesBc(0,
        'top 1 valor  as valor,nome_serie,data',
        " serie = $serieParam and data = '$data' and (log_ok = 1 or log_manual = 1) order by hist_cotacao_bc_id desc");
    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVlCotacaoHoje($serie = 1)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $valor = 0;
    $aDados = $this->getDadosCotacaoHoje($serie);
    if (is_array($aDados)) {
        $valor = $aDados['valor'];
    }
    return $valor;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosUltCotacao($serie = 1)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosHistCotacoesBc($id, $campos = '', $filtro = '')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrCotacaoDia($serie = 1)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $logAtu = false;
    $vl = $this->getVlCotacaoHoje($serie);
    if ($vl == 0) {
        $vl = $this->atualizarCotacaoDia($serie);
        $logAtu = true;
    }
    $aRetorno = array('valor' => $vl, 'log_atu' => $logAtu);
    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarCotacaoDia($serie, $valor = 0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aCotacao = $this->getCotacaoEms5($indicador, $data);
    $logAchou = $aCotacao['log_achou'];
    if ($logAchou == 0) {
        $this->inserirCotacaoEms5($indicador, $data, $valor);
    } else {
        $this->atualizarCotacaoEms5($indicador, $data, $valor);
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
    }
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCotacaoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCotacoesPeriodoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCotacaoEms5($serie, $data)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirCotacaoEms5($serie, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirCotacaoEms2($serie, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarCotacaoEms($serie, $data, $valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $indicador = $this->convSerieEmIndicador($serie, 'ems2');
    $this->sincrCotacaoEms2($indicador, $data, $valor);
    $indicador = $this->convSerieEmIndicador($serie, 'ems5');
    $this->sincrCotacaoEms5($indicador, $data, $valor);


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convSerieEmIndicador($serie, $destino)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function diaDaSemana($data,$retorno=0,$formato='aaaa-mm-dd')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
     
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function converterDataBra($data)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aData = explode("-",$data);
    return $aData[2]."/".$aData[1]."/".$aData[0];



$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function converterHoraEmMinutos($hora)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $aQtMinutos = explode(':',$hora);
    if(is_array($aQtMinutos) and count($aQtMinutos) == 3){
        $qtMinutos = $aQtMinutos[0] * 60 + $aQtMinutos[1] + $aQtMinutos[2] / 60;
    }
    else{
        $qtMinutos = 0;
    }
    return $qtMinutos;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function converterMinutosEmHoras($minutos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $hora = round($minutos / 60,0);
    if($hora < 1){
        $hora = 0;
    }
    $hora = preencherZerosAEsquerda ($hora,2);
    $min =  round($minutos % 60,0);
    $min = preencherZerosAEsquerda ($min,2);
    $formato_hora = "$hora:$min:00";
    return $formato_hora;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getParteDataAMD($data,$parte)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retornarOpcoesTxt($lista)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
	 $novaLista = '';
	 $aLista = explode(",",$lista);
	 if(is_array($aLista)){
		$qt = count($aLista);
		for($i = 0;$i <  $qt;$i++){
			$comum = "'".$aLista[$i]."'";
			if($novaLista == ''){
			   	$novaLista = $comum;
			}	
			else{
			    $novaLista = $novaLista.','.$comum;	
			}					
		}	 
	}	
	return $novaLista;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " update \"pp-container\" set dt_prev_embarque = '$dtPrevEmbarque' 
			where \"nr-container\" = $containerID ";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = $this->getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDadosDescontos($descontoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $tabela   = "pub.descontos_importacao";
    $campos   = 'motivo_desconto_id, descricao, log_credito, cod_tipo, dt_autorizacao, fornecedor_id';
    $condicao = " desconto_importacao_id = $descontoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarVlsDescontosPorFornecedor($fornecedor=0 )
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescontosUtiliz($container,$itemContainerId='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescontosCreditosUtiliz($container){
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validarVlAprovadoEmReal($vlReal,$vlRealAutoriz)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlRealAutoriz > $vlReal){
        $erro = 'ERRO.O Valor Aprovado em Real não pode ser maior que o Valor Solicitado em Real';
    }
    return $erro;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validarVlAprovadoEmDolar($vlDolar,$vlDolarAutoriz)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlDolarAutoriz > $vlDolar){
        $erro = 'ERRO. O Valor Aprovado em Dólar não pode ser maior que o Valor Solicitado em Dólar';
    }
    return $erro;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validarVlsAutorizacao($vlDolarAutoriz, $vlRealAutoriz, $dtAutoriz)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarVlSaldoUtilizar($descontoImportacaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = 0;
    $vlDolar = $this->buscarVlDolarAutorizDesconto($descontoImportacaoId);
    $vlUtilizado = $this->buscarDescontoTotalUtilizado($descontoImportacaoId);
    $retorno = $vlDolar - $vlUtilizado;

    return $retorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescontoTotalUtilizado($descontoImportacaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
     $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.cta_corren_desconto ',
                                   ' sum(valor_utilizado) as valor ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["valor"];
    return $retorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarVlDolarAutorizDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
                                   ' vl_dolar_autorizado ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["vl_dolar_autorizado"];

    return $retorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarFornecDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
        ' fornecedor_id ',
        " desconto_importacao_id = $descontoImportacaoId ", 'espec');
    if (is_array($aRetorno))
        $retorno = $aRetorno[0]["fornecedor_id"];

    return $retorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVlDescAutorizado($fornecedor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesaLogImpostoOuCalc($despesaId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesaDescr($despesaId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = '';
    $aRetorno = $this->retornoSimplesTb01('pub.despesas','descricao'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["descricao"];
    return $retorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesasImposto($imposto_id,$empresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.despesas_impostos", "despesa_id", " empresa_id = $empresa and imposto_id = $imposto_id","espec");
    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getIdsRelacDespCalculadas($despesa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
    }else{
        $retorno = 'Campos não informados';
    }
    return $retorno;
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
             exit;
         }
         $rf->Close();
      
    }
    return $id;
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
if (!isset($_SESSION['cod_usuario_corrente'])) {$_SESSION['cod_usuario_corrente'] = "";}
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
             exit;
         }
         $rf->Close();
      
    $aUltReg = $this->retornoSimplesTb01(" pub.calcs_imp_container ", " max(calc_imp_container_id) as ult ", "1 = 1","espec");
    return $aUltReg[0]['ult'];
if (isset($this->sc_temp_cod_usuario_corrente)) {$_SESSION['cod_usuario_corrente'] = $this->sc_temp_cod_usuario_corrente;}
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
     
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
    

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $despesaId = $this->buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->Ini->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = $this->getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarcodEmpresa($codigo,$sistOrigem,$sistDestino)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getEstabEms5($estab)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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



$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDespesasEmp($empresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRetorno = array();

    $aRetorno = $this->retornoMultReg('pub.empresas_despesa emp_desp INNER JOIN pub.despesas desp
                               ON emp_desp.despesa_id = desp.despesa_id',
        'emp_desp.despesa_id, emp_desp.vl_padrao, desp.perc_calculo',
        " emp_desp.log_ativo = 1 and desp.log_imposto = 0
							  and emp_desp.empresa_id = $empresa","espec");

    return $aRetorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarImpostosEmpresa($empresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id, pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 
        and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 
        and pub.empresas_despesa.empresa_id = $empresa and pub.despesas.log_calc_por_item = 0","espec");
    return $aRetorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarImpostoPerc($despesa,$empresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarImpostoPercCusto($despesaID,$empresa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosEmpresaDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescItem($itCodigo)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = '';
    $sql = " select \"desc-item\" from med.pub.\"item\" item_med
			where \"it-codigo\" = '$itCodigo'
			union 
			select \"desc-item\" from ima.pub.\"item\" item_ima
			where \"it-codigo\" = '$itCodigo'";
     
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $desc_item = array();
      if ($SCrx = $this->Ini->nm_db_multi->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $desc_item[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $desc_item = false;
          $desc_item_erro = $this->Ini->nm_db_multi->ErrorMsg();
      } 

    if ($desc_item  === false){
    echo "Erro ao acessar função buscarDescitem. Messagem=". $desc_item_erro  ;
	}
	elseif (empty($desc_item )){
}
	else{
    $retorno = $desc_item[0][0];
	}
	if($retorno == ''){
        $retorno = 'Item Não Encontrado';
    }
	return $retorno;
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDescItem($itCodigo){
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('ems2med','item','"it-codigo"',
        "$itCodigo",'"desc-item" as desc_it');
    return $aReg;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getListaItCodigoPorDescricao($descricao)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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
    $fornec = buscarFornecItemProcCompra($itemProcCompra);
    return $fornec;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $procCompraId = 0;
    $tabela = "pub.itens_container";
    $campos = "item_proc_compra_id";
    $condicao = "item_container_id = $itemContainerID";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    if(is_array($aValores)){
        $itemProcCompra = $aValores[0]['item_proc_compra_id'];
        $procCompraId = buscarProcCompraItem($itemProcCompra);
    }
    return $procCompraId;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $contAloc = 0;
    $logItensExistente = false;
    if(is_array($aItens)){
        $tot = count($aItens);
        for($x = 0; $x < $tot; $x++){
            $itemID           = $aItens[$x]['ID'];
            $qtAlocada        = buscarQtAlocItemProc($itemID);
            $logJaSelecionado = buscarItemAlocado($container_id,$itemID);
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
            $vlItemProcCompra 			= buscarVlItemProcCompra($itemProcCompraID,$tipoCusto);

            
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


            


            $codItem                = buscarCodItemERP($itemProcCompraID);

            

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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " update pub.item_container_custos set item_custo_id = $item_custo_id
			where item_container_custo_id = $item_container_custos_id";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = false;
    $aItens = $this->buscarIDItensContainer($container);
    $tam = count($aItens);
    if(is_array($aItens) and $tam > 0){
        for($i=0;$i<$tam;$i++){
            $itemProcCompraId = $aItens[$i]['item_proc_compra_id'];
            $codErp = buscarCodItemERP($itemProcCompraId);
            if($codErp == ''){
                $retorno = true;
                break;
            }
        }
    }
    return $retorno;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
        $vlNegociado = buscarVlItemProcCompra($itemProcCompraId,'negociado');
        inserirLogDb('vl.negociado - funcao buscarVlItemProcCompra(item do pedido,tipo=negociado) ',
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
                    $fornec = buscarFornecItemProcCompra($itemProcCompraId);

                    inserirLogDb('fornecedor do container - funcao buscarFornecItemProcCompra(itemProccompraId)',"$fornec(itemProcCompra:$itemProcCompraId)",__FUNCTION__);
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
if (!isset($_SESSION['container_corrente'])) {$_SESSION['container_corrente'] = "";}
if (!isset($this->sc_temp_container_corrente)) {$this->sc_temp_container_corrente = (isset($_SESSION['container_corrente'])) ? $_SESSION['container_corrente'] : "";}
if (!isset($_SESSION['empresa_container_corrente_ems5'])) {$_SESSION['empresa_container_corrente_ems5'] = "";}
if (!isset($this->sc_temp_empresa_container_corrente_ems5)) {$this->sc_temp_empresa_container_corrente_ems5 = (isset($_SESSION['empresa_container_corrente_ems5'])) ? $_SESSION['empresa_container_corrente_ems5'] : "";}
if (!isset($_SESSION['fornecedor_container_corrente'])) {$_SESSION['fornecedor_container_corrente'] = "";}
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

if (isset($this->sc_temp_fornecedor_container_corrente)) {$_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
if (isset($this->sc_temp_empresa_container_corrente_ems5)) {$_SESSION['empresa_container_corrente_ems5'] = $this->sc_temp_empresa_container_corrente_ems5;}
if (isset($this->sc_temp_container_corrente)) {$_SESSION['container_corrente'] = $this->sc_temp_container_corrente;}
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = "insert into pub.pagtos_container(num_id_tit_ap,container_id) values($numIdTitAp,$container)";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = "delete from pub.pagtos_container where num_id_tit_ap = $numIdTitAp and  container_id = $container" ;
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
if (!isset($_SESSION['fornecedor_container_corrente'])) {$_SESSION['fornecedor_container_corrente'] = "";}
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

if (isset($this->sc_temp_fornecedor_container_corrente)) {$_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarEmpProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " empresa_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){
        $empresa = $aRetorno[0]['empresa_id'];
    }
    return $empresa;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDescProcCompra($procCompraId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $processo = '';

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " cod_proc_fornec, fornecedor_id ",
        " proc_compra_id = $procCompraId ","espec");
    if(is_array($aRetorno)){
        $processo = $aRetorno[0]['cod_proc_fornec'];
        $fornecedor = buscarDescFornecedor($aRetorno[0]['fornecedor_id']);
        $processo .= ' '. $fornecedor;
    }
    return $processo;



$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarFornecedorProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $fornecedor = 0;

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " fornecedor_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $fornecedor =$aRetorno[0]['fornecedor_id'];
    }
    return $fornecedor;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDtRegProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $data = '2001-01-01';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " dt_registro ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $data =$aRetorno[0]['dt_registro'];
    }
    return $data;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarEmpERPProcCompra($procCompraIdParam,$sistema)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarCotPrevProcCompra($procCompraId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'cotacao_prevista';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarQtContainerProcCompra($procCompraId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'qt_container';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarADProcCompra($procCompraID)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosPedidoImp($id,$campos='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','procs_compra');
        $campos = $aCampos['campos'];
    }

    $tabela   = " pub.procs_compra ";
    $condicao = "  proc_compra_id = $id ";
    $aResult = $this->getDados('unico',$tabela,$campos,$condicao,"espec");
    return $aResult;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getProcsCompraCtaPorFornec($fornecedor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getProcsCompraIntegrCtaFornec()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getProcsCompraNaoIntegrCtaFornec()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validarAltPedCompra($pedido)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $erro = '';
    $vl = buscarVlTotPagtoProcCompra($pedido);
    if($vl > 0 ){
        $erro = "Para alterar o fornecedor não pode existir nenhum pagamento associado";
    }
    return $erro;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function validacoesPedCompra($pedido)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $erro = $this->validarAltPedCompra($pedido);
    return $erro;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getFornecsPedImpGeraPrev()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_sincrIpiItensContainer']['inicio']);
}

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirVersaoCusto($containerParam,$tipoVersao,$descricao)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    if(isset($this->sc_temp_usr_login)){
        $login = $this->sc_temp_usr_login;
    }else{
        $login = ''; 
    }
    $cmd = "insert into pub.versoes_item_custo_container(versao_id,ind_sit_versao,tipo_versao_id,descricao,
          container_id,dt_hr_versao,cod_usuario)
           values(pub.seq_versao_item_container_custo.NEXTVAL,2,$tipoVersao,'$descricao',$containerParam,now(),'$login')";
    
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
      
    $id = $this->buscarVlSequenciaEspec('seq_versao_item_container_custo',
        'versoes_item_custo_container');
    $this->gravarVersaoCusto($id);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gerarAutVersaoCusto($containerParam,$descComplementar)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $aReg = $this->getUltVersao();
    if(is_array($aReg)){
        $tipoVersao  =  $aReg[0]['tipo_versao_id'];
        $versaoId    =  $aReg[0]['versao_id'];
        $descricao   =  "Versão gerada automaticamente a partir da versão $versaoId $descComplementar";
        $this->inserirVersaoCusto($containerParam,$tipoVersao,$descricao);
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getUltVersao()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container) ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosVersaoCusto($id,$campos='',$filtroCompl)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoCusto($versaoId,$logSincrImpostos=1,$logDespCalc=1)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $container = $this->buscarContainerVersaoCusto($versaoId);
    $versaoIncompleta = $this->verificarVersaoCustoIncompleta();
    if($versaoIncompleta <> $versaoId and $versaoIncompleta <> 0){
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Problema:Já existe um outro processo de custo incompleto.<br>
						  É necessário excluir ou reprocessar a versão de Custo: $versaoIncompleta";
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function completarVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = "update pub.versoes_item_custo_container set ind_sit_versao = 2
			where versao_id = $versaoId";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoCustoDadosContainer($versaoId,$container='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
            $descricao = $aSituacao[0]['descricao'];
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarContainerVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'container_id';
    $condicao = "versao_id = $versaoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $container;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function verificarVersaoCustoIncompleta()
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $versaoId = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'versao_id';
    $condicao = " ind_sit_versao = 1";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $versaoId;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDespesas($versaoId,$container='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDespesas($versaoId,$despesaId,$vlPrev,$vlNegociado,$vlProforma,$vlBaseImp,$calcImpContainerId,$logCusto)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_despesas(versao_id, 
			despesa_id, vl_prev, calc_imp_container_id,log_custo,vl_negociado,vl_proforma,vl_base_imp)
			values($versaoId,$despesaId,$vlPrev,$calcImpContainerId,$logCusto,$vlNegociado,$vlProforma,$vlBaseImp) ";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCusto($versaoId,$container='',$logGerarDistrCusto=false)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

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


        $aContainerDistr = getVlDistrContainer($container);
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
                $itCodigo 	= buscarCodItemERP($itemProcCompraId);
            }
            else{
                $qtAlocada 		= 0;
                $qtEmb			= 0;
                $qtRecboFisico  = 0;
                $itCodigo		= '';
                $itemProcCompraId = 0;
            }
            $aRetorno = retornarCampoItemProcCompra ( $itemProcCompraId , 'vl_negociado' );
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
                    $aItem = getVlDistrContainer('',$itemContainerId);
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
                $distrCustoID = criarRegDistrCusto($id,0,'Vl.Distribuição de Custo Automático',
                    3,$vlDistrItem);
                criarDespesaDistrCusto($distrCustoID,$vlDistrItem,$itemContainerId);
                
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
    $id = $this->buscarVlSequenciaEspec('seq_item_container_custos','item_container_custos');
    return $id;
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoCustoNfs($versaoId,$container='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
        $aRetorno2 = buscarValoresNFs($estab,$documento,$serie,$natOperacao,$codEmitente);
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirVersaoCustoNfs($versao,$documento,$serie,$natOperacao,$codEmitente,$vlMercadoria,$vlDespesa)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_nfs(versao_id, documento, serie, nat_operacao,cod_emitente,vl_mercadoria,
			vl_despesa)
			values($versao,'$documento','$serie','$natOperacao',$codEmitente,'$vlMercadoria','$vlDespesa') ";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoPagtos($versaoId,$container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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
            $vlReal				= buscarVlMoeda($numIdTitAp);
            $vlDolar			= buscarVlMoeda($numIdTitAp,'','dolar');
            $this->inserirVersaoCustoPagtos($versaoId,$numIdTitAp,$vlReal,$vlDolar);
        }
    }

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirVersaoCustoPagtos($versao,$numIdTitAp,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_pgtos(versao_id,num_id_tit_ap,vl_real,vl_dolar)
			values($versao,$numIdTitAp,'$vlReal','$vlDolar') ";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarContainerVersao($versaoId)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela 	= 'pub.versoes_item_custo_container';
    $campo  	= 'container_id';
    $condicao	= "versao_id = $versaoId";
    $aRetorno   = $this->retornoSimplesTb01($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $container = $aRetorno[0][$campo];
    }
    return $container;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarDadosUltVersaoCustoContainer($container,$itemContainerId='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDataUltVersaoCustoContainer($containerParam)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarUltVersaoCustoContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $versao = 0;
    $tabela = 'pub.versoes_item_custo_container';
    $campos =  'select max(versao.versao_id) as ult';
    $condicao = " versao.container_id = $container ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $versao = $aRetorno[0]['ult'];
    }
    return $versao;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function getDadosVersaoCorrenteContainer($container)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container
                where container_id = $container)
                ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;


$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function buscarTotDistrItemCustoContainer($itemContainer)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  

    $tot = 0;
    $tabela = 'pub.item_container_custos';
    $campos =  'sum(vl_custo_distribuido) as tot';
    $condicao = " item_container_id = $itemContainer ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $tot = $aRetorno[0]['tot'];
    }
    return $tot;

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDescontos($versaoId,$container='')
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'on';
  
    $cmd = " insert into pub.item_container_custo_descontos(versao_id, 
			desconto_importacao_id, vl_autoriz_real,vl_autoriz_dolar)values($versaoId,$descontoId,$vlReal,$vlDolar) ";
    
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
      
$_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
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
   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['contr_erro'] = 'off';
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
            nm_limpa_str_bl_sincrIpiItensContainer($nmgp_val);
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
            nm_limpa_str_bl_sincrIpiItensContainer($nmgp_val);
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
       elseif (is_file($root . $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "bl_sincrIpiItensContainer") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_Importacao'])) {
               $_SESSION['scriptcase']['bl_sincrIpiItensContainer']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Importacao'];
           }
       }
   }
   if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
   {
       $_SESSION['sc_session']['SC_parm_violation'] = true;
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
   if (isset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu']);
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "bl_sincrIpiItensContainer";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'bl_sincrIpiItensContainer' || $achou)
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
        $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['iframe_menu'] = $salva_iframe;
   }

   if (!isset($_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '.php'))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize'] = true;
   }
   else
   {
       $sReferer = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '.php'));
       $sReferer = substr($sReferer, strrpos($sReferer, '/') + 1);
       if ('bl_sincrIpiItensContainer' == $sReferer || 'bl_sincrIpiItensContainer_' == substr($sReferer, 0, 26))
       {
           $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize'] = false;
       }
       else
       {
           $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['initialize'] = true;
       }
   }

   $_POST['script_case_init'] = $script_case_init;
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'bl_sincrIpiItensContainer')
   {
       $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['bl_sincrIpiItensContainer']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/bl_sincrIpiItensContainer_erro.php");
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
                nm_limpa_str_bl_sincrIpiItensContainer($cadapar[1]);
                if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                $Tmp_par   = $cadapar[0];;
                $$Tmp_par = $cadapar[1];
            }
            $ix++;
       }
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0;  
   $contr_bl_sincrIpiItensContainer = new bl_sincrIpiItensContainer_apl();
   $contr_bl_sincrIpiItensContainer->controle();
//
   function nm_limpa_str_bl_sincrIpiItensContainer(&$str)
   {
   }
?>
