<?php
   include_once('bl_cons_planilha_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems2ima']         = "ems2ima";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems2med']         = "ems2med";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ticontrole2']         = "ticontrole2";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_dinamico']         = "dinamico";
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
    if(empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class bl_cons_planilha_ini
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
      $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "bl_cons_planilha"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "Importacao"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "thiago"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20260921"; 
      $this->nm_hr_criacao   = "160138"; 
      $this->nm_autor_alt    = "thiago"; 
      $this->nm_dt_ult_alt   = "20261007"; 
      $this->nm_hr_ult_alt   = "160513"; 
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
      $this->path_prod       = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_doc'];
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
      if (!isset($_SESSION['scriptcase']['bl_cons_planilha']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['bl_cons_planilha']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['bl_cons_planilha']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_BlueBerry/Sc9_BlueBerry";
      if (isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['sub_cons_schema_filter'];
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
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/bl_cons_planilha';
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
      $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
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

      if (isset($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['bl_cons_planilha']['actual_lang']) || $_SESSION['scriptcase']['bl_cons_planilha']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['bl_cons_planilha']['actual_lang'] = $this->str_lang;
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
          include_once("bl_cons_planilha_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
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
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['ancor_save'] = $_POST['ancor_save'];
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_cons_planilha"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["bl_cons_planilha"] as $sTmpTargetLink => $sTmpTargetWidget)
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
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['link_info']['margin_top'] = $link_margin_top;
        }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']);
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
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir']))
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
      if (isset($_POST['nm_grid_submit']) && $_POST['nm_grid_submit'] == 1 && isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['csrf_token'] ) && !isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida']) && !isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida_form'])) {
          if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['csrf_token']) {
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
      $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['path_doc'] = $this->path_doc; 
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan'])) 
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
      include_once($this->path_aplicacao . "bl_cons_planilha_erro.class.php"); 
      $this->Erro = new bl_cons_planilha_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('bl_cons_planilha'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'])) 
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
      if (isset($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir'])) {
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
          if ($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir_tp'] == "R") {
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
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']);
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
      $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1DcJeDQFGHABYHuF7DMvOVcBOH5B3DoXGDcJUZ1FGHAN7HuJeHgveVkJGDWr/VoBqDcJeZ9F7HANOHuFaHuNOZSrCH5FqDoXGHQJmZ1BiHABYHuBOHgBYVkJ3DWr/HMFGHQFYDQFaHIBeHuXGDMrwV9BUDWF/HMFaHQXGZSBqDSvmZMBqHgvCHArCDWr/HMBiHQXsDuBqD1veHQBODMrwVcB/DWXCHMJwHQNwZkBiHIBeHuJwDMrYZSXeDuFYVoXGDcJeZ9rqD1BeHQXGDMvsZSNiDWBmVoFGHQXGZSBqHIBeHuJsHgvCHArsDuFaHIJwHQFYDuBqHABYHQJeDMrwV9BUDWrmVENUHQNwVINUHANOHQJsHgvCHArsHEFqHMBODcBiZ9XGD1vOVWJwHgNKDkBODuFqDoFGDcBqVIJwD1NaV5JwHgN7DkFeHEB3DoNUHQNwDQX7HAvCV5BiHuNOVcFCDWFYDoJeD9BiZ1F7DSrYD5BqDEBOHEFiH5FGDoNUHQNwDuFaD1veV5BqHgNKVcFKDWFaVoX7DcJUZkFUHArKD5JeDEBeHEFiV5FaZuBqD9XsZ9JeHIBOV5BiHuBOVcBOV5X7VEraDcBwZ1F7D1rwD5NUDEBODkFeDWF/ZuB/D9NwZSX7D1vOV5BiHgrKVcBOHEFYVENUD9JmZ1F7HArYD5XGDMrYHEFiV5FaVoBODcJUDQJwD1veD5BOHgrKVcBOV5X/VoFaDcJUZSB/Z1BeD5XGDMrYHEFiDuFYVoXGDcJeZSX7HABYD5NUHuzGDkBOHEFYDoJsDcJUVIJwZ1vmD5rqDEBOHEFiHEFqDoF7DcJUZSBiDSzGVWFaDMzGVcBUH5XKVEX7HQXGZ1BOHAvsV5X7DMvCZSJqH5FGDoJeHQBiH9BiHIvsD5F7DMvmVIBsHEX7HMJsHQXOH9BqD1vsV5X7HgrKZSJ3HEXCHIXGHQNwZ9XGHIvsV5FGHuNOVcFKHEFYVoBqDcBwH9BqDSvOZMJwDMveVkJqH5FYHMBqHQNmDQFaHIvsD5F7DMBOVcBUH5FqHMraHQBsZSBqD1NaV5X7HgNOVkJ3DuFYHIFUHQBiZ9XGHAvmD5F7DMBOVIBsDWJeHIJsDcFYZSBOHAvsD5rqDEBOHEFiHEFqDoF7DcJUZSBiHIBOVWFaDMvmV9FeDWFaHMFaHQBiZSBqZ1vmV5X7HgBOHErCDuFYHIB/HQXOH9BiD1BOD5F7DMBODkB/DWF/HMJsHQXGZkFGZ1vOV5X7HgrKDkXKHEFqHIX7HQNmZ9XGDSzGV5FGHuNOVcFKHEFYVoBqDcBwH9FaD1rwD5rqDMNKZSJGDWF/DoraD9NmDQJsHIrKV5raDMrwDkFCDWF/VoB/D9XOVIraZ1BeZMBODEvsZSJGDuXKDoB/DcJeZSX7HIBeD5BqHgrKVcBOV5F/VENUD9XOVIJwZ1BeD5rqDEBOHEFiHEFqVoB/D9XsH9FGD1NKV5XGDMrwDkFCDuX7DoraDcBqVINUHIBOD5FaDEvsZSXeDWFqDorqHQXGZSFGD1BeV5FGDMvsV9BUDurGVoraDcBwH9B/HIrwV5JeDMBYDkBsH5FYDoXGDcJeZSFUZ1rwD5BOHuNODkFCH5FqVENUDcNwH9B/HArYV5X7DMBYHEXeHEFqVoX7HQJKDQJsZ1vCV5FGHuNOV9FeDWXCVEraD9XOZ1X7DSrYHQBiHgNOHEXeDuJeHIBiHQJeDQJsHIrKV5BqHgrwVcB/DWFaDoJsDcBqZkFGHArKV5FUDMrYZSXeV5FqHIJsHQXGZSX7HANOD5rqHgrYDkBOH5FqVoraD9BsZSFaD1rwD5BiDErKHEFiDuFYDoraD9XsH9X7DSBYD5rqHuvmVcFKDWXKDoJsD9XOZ1F7HIveD5BqHgBeHEFiV5B3DoF7D9XsDuFaHAveHuFaHuNOZSrCH5FqDoXGHQJmZ1F7HANOHQF7DMvCHEXeH5FYHIJwHQNmDuBqHArYV5raHuzGZSJqHEFYHMrqDcNmZkFGDSBOV5X7DEBOHArCHEFqHIJsD9XsZ9JeD1BeD5F7DMvmVcrsH5FqVoBODcNwH9B/HAN7D5XGDEBOZSXeV5XCZuJsDcBwDuFaHAveD5NUHgNKDkBOV5FYHMBiHQNmVINUHAvsD5XGHgNKDkXKDWFGDoBOHQBiDQBqHIrwHuFaHuNOZSrCH5FqDoXGHQJmZ1FGHIBOD5BODEBeHArsDWr/DoJsDcBwZSBiHIrwHuX7DMzGDkB/DWFYDoF7HQNwVIJsHArYHQJwDEBODkFeH5FYVoFGHQJKDQFaZ1BYD5JwHgrKVcrsH5XCDoraD9XGZ1rqD1rKV5JeDEBOHEFKDWF/HIF7D9XsDQFGHAveV5JwHuzGVIFCH5XCVoB/VQJUZ9X7D1rwD5FaDMrYHEFiH5FGDoNUHQXsDQFGHIrKV5JeHuNODkFCDWJeVENUDcBqVIFGHIBYD5rqDEBODkBsDWF/HMBOD9NmDQJsD1veV5FUDMvmVcFKV5BmVoBqD9BsZkFGHAvsZMJeHgvCDkXKDWBmZura";
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan'])) 
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
              if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']) && $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil']) && $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['bl_cons_planilha']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']))
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
      if (isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = '__OMITIDO_NA_COPIA_DE_ANALISE__';
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems2ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ems2med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ticontrole2'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['bl_cons_planilha']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida_init']) 
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
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date1'];
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
          if (!$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan'])) 
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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_conexao'], $this->root . $this->path_prod, 'Importacao', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida'])
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
          $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida'])
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
      if (!$_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['embutida'])
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
       if (!isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['csrf_token']))
       {
           $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['csrf_token'] = $this->scCsrfGenerateToken();
       }

       return $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['csrf_token'];
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_sep_date1'];
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
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['bl_cons_planilha']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
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
class bl_cons_planilha_apl
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

      $this->Ini = new bl_cons_planilha_ini(); 
      $this->Ini->init();
      $this->Change_Menu = false;
      if (isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_cons_planilha']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['bl_cons_planilha'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_cons_planilha']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_cons_planilha']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('bl_cons_planilha') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['bl_cons_planilha']['label'] = "" . $this->Ini->Nm_lang['lang_othr_blank_title'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "bl_cons_planilha")
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['bl_cons_planilha']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['bl_cons_planilha']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['bl_cons_planilha']['exit'];
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
      include_once($this->Ini->path_aplicacao . "bl_cons_planilha_erro.class.php"); 
      $this->Erro      = new bl_cons_planilha_erro();
      $this->Erro->Ini = $this->Ini;
//
      header("X-XSS-Protection: 1; mode=block");
      header("X-Frame-Options: SAMEORIGIN");
      
/*----- Scriptcase Locale: Event onExecute ------*/
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  $GLOBALS['cie_contexto_scriptcase'] = $this;

echo $this->cie_executar_blank_controle_importacao($this);
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onExecute ------*/
 
//--- 
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

/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_valor ------*/

function cir_valor($linha, $campo, $padrao = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return isset($linha[$campo]) ? trim((string) $linha[$campo]) : $padrao;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_valor ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_primeiro_valor ------*/

function cir_primeiro_valor()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valores = func_get_args();
    foreach ($valores as $valor) {
        $valor = trim((string) $valor);
        if ($valor !== '') {
            return $valor;
        }
    }
    return '';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_primeiro_valor ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_sim_nao ------*/

function cir_sim_nao($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valor = trim((string) $valor);
    if ($valor === '') {
        return '';
    }
    return ((int) $valor === 1) ? 'Sim' : 'Nao';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_sim_nao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_data_iso ------*/

function cir_data_iso($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valor = trim((string) $valor);
    if ($valor === '' || $valor === '0000-00-00') {
        return '';
    }
    $valor = substr($valor, 0, 10);
    $data = DateTime::createFromFormat('Y-m-d', $valor);
    if ($data instanceof DateTime) {
        return $data->format('Y-m-d');
    }
    $data = DateTime::createFromFormat('d/m/Y', $valor);
    if ($data instanceof DateTime) {
        return $data->format('Y-m-d');
    }
    return '';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_data_iso ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_add_dias_corridos ------*/

function cir_add_dias_corridos($data, $dias)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $data = $this->cir_data_iso($data);
    $dias = (int) $dias;
    if ($data === '') {
        return '';
    }
    $dt = new DateTime($data);
    if ($dias !== 0) {
        $dt->modify(($dias > 0 ? '+' : '') . $dias . ' days');
    }
    return $dt->format('Y-m-d');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_add_dias_corridos ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_add_dias_uteis ------*/

function cir_add_dias_uteis($data, $dias)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $data = $this->cir_data_iso($data);
    $dias = (int) $dias;
    if ($data === '') {
        return '';
    }
    $dt = new DateTime($data);
    $passo = $dias >= 0 ? 1 : -1;
    $restantes = abs($dias);
    while ($restantes > 0) {
        $dt->modify(($passo > 0 ? '+1' : '-1') . ' day');
        $diaSemana = (int) $dt->format('N');
        if ($diaSemana < 6) {
            $restantes--;
        }
    }
    return $dt->format('Y-m-d');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_add_dias_uteis ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_classificacao_acabamento ------*/

function cir_classificacao_acabamento($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'classificacao_acabamento'),
        $this->cir_valor($linha, 'ipc_classificacao_acabamento')
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_classificacao_acabamento ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_acabamento_liso ------*/

function cir_acabamento_liso($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $acabamento = strtolower($this->cir_classificacao_acabamento($linha));
    return $acabamento === 'liso';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_acabamento_liso ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_acabamento_exige_desenho ------*/

function cir_acabamento_exige_desenho($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $acabamento = strtolower($this->cir_classificacao_acabamento($linha));
    return in_array($acabamento, array('estampado', 'bordado', 'fio tinto'), true);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_acabamento_exige_desenho ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_fornecedor ------*/

function cir_fornecedor($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $codigo = $this->cir_valor($linha, 'pc_fornecedor_id');
    $nome = $this->cir_valor($linha, 'c_nome_ab_forn');
    if ($codigo !== '' && $nome !== '') {
        return $codigo . ' - ' . $nome;
    }
    return $codigo !== '' ? $codigo : $nome;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_fornecedor ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_emitente_container ------*/

function cir_emitente_container($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $codigo = $this->cir_valor($linha, 'c_cod_emit_forn');
    $nome = $this->cir_valor($linha, 'c_nome_ab_forn');
    if ($codigo !== '' && $nome !== '') {
        return $codigo . ' - ' . $nome;
    }
    return $codigo !== '' ? $codigo : $nome;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_emitente_container ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_container ------*/

function cir_container($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'c_nr_container'),
        $this->cir_valor($linha, 'ic_container_id')
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_container ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_processo_origem ------*/

function cir_processo_origem($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'pc_nr_container_original'),
        $this->cir_valor($linha, 'PC_NR_CONTAINER_ORIGINAL'),
        $this->cir_valor($linha, 'c_nr_container_original'),
        $this->cir_valor($linha, 'C_NR_CONTAINER_ORIGINAL'),
        $this->cir_valor($linha, 'nr_container_original'),
        $this->cir_valor($linha, 'NR_CONTAINER_ORIGINAL')
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_processo_origem ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_processo_container ------*/

function cir_processo_container($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'pc_cod_proc_fornec'),
        $this->cir_valor($linha, 'cod_proc_fornec')
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_processo_container ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_descricao_coloracao ------*/

function cir_descricao_coloracao($codigo)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    static $cache = array();
    $codigo = trim((string) $codigo);
    if ($codigo === '') {
        return '';
    }
    if (!isset($cache[$codigo])) {
        $descricao = '';
        $codigoSql = "'" . str_replace("'", "''", $codigo) . "'";
        $aReg = $this->cir_chamar_getdados(
            array('unico', 'pub.coloracoes', 'descricao', "coloracao_id = $codigoSql", 'espec')
        );
        if (is_array($aReg) && isset($aReg[0]) && is_array($aReg[0])) {
            $descricao = $this->cir_primeiro_valor(
                isset($aReg[0]['descricao']) ? $aReg[0]['descricao'] : '',
                isset($aReg[0]['DESCRICAO']) ? $aReg[0]['DESCRICAO'] : '',
                isset($aReg[0][0]) ? $aReg[0][0] : ''
            );
        }
        $cache[$codigo] = $descricao !== '' ? $descricao : $codigo;
    }
    return $cache[$codigo];

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_descricao_coloracao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colecao ------*/

function cir_colecao($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_descricao_coloracao($this->cir_valor($linha, 'ipc_coloracao_id'));

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colecao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_chamar_getdados ------*/

function cir_chamar_getdados($argumentos)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (isset($GLOBALS['cie_contexto_scriptcase'])
        && is_object($GLOBALS['cie_contexto_scriptcase'])
        && method_exists($GLOBALS['cie_contexto_scriptcase'], 'getDados')) {
        return call_user_func_array(array($GLOBALS['cie_contexto_scriptcase'], 'getDados'), $argumentos);
    }
    if (isset($this) && is_object($this) && method_exists($this, 'getDados')) {
        return call_user_func_array(array($this, 'getDados'), $argumentos);
    }
    if (function_exists('getDados')) {
        return call_user_func_array('getDados', $argumentos);
    }
    return array();

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_chamar_getdados ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_buscar_desc_item_funcao ------*/

function cir_buscar_desc_item_funcao($codigo)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (isset($GLOBALS['cie_contexto_scriptcase'])
        && is_object($GLOBALS['cie_contexto_scriptcase'])
        && method_exists($GLOBALS['cie_contexto_scriptcase'], 'buscarDescItem')) {
        return $GLOBALS['cie_contexto_scriptcase']->buscarDescItem($codigo);
    }
    if (isset($this) && is_object($this) && method_exists($this, 'buscarDescItem')) {
        return $this->buscarDescItem($codigo);
    }
    if (function_exists('buscarDescItem')) {
        return buscarDescItem($codigo);
    }
    $arquivos = array(
        __DIR__ . '/item.php',
        dirname(__DIR__) . '/item.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/lib/php/item.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/grp/item.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/prj/item.php',
    );
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '' && is_file($arquivo)) {
            include_once $arquivo;
            if (function_exists('buscarDescItem')) {
                return buscarDescItem($codigo);
            }
        }
    }
    return '';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_buscar_desc_item_funcao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_descricao_item ------*/

function cir_descricao_item($codigo)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    static $cache = array();
    $codigo = trim((string) $codigo);
    if ($codigo === '') {
        return '';
    }
    if (isset($cache[$codigo])) {
        return $cache[$codigo];
    }
    $descricao = '';
    $codigoSql = "'" . str_replace("'", "''", $codigo) . "'";
    $descricao = $this->cir_buscar_desc_item_funcao($codigo);
    if ($descricao === '' || stripos($descricao, 'Item N') === 0) {
        $tabelas = array('med.pub."item"', 'ima.pub."item"', 'pub."item"');
        foreach ($tabelas as $tabela) {
            $aReg = $this->cir_chamar_getdados(
                array('unico', $tabela, '"desc-item" as desc_item', '"it-codigo" = ' . $codigoSql, 'multi')
            );
            if (!is_array($aReg) || !isset($aReg[0])) {
                continue;
            }
            $registro = $aReg[0];
            $descricao = $this->cir_primeiro_valor(
                isset($registro['desc_item']) ? $registro['desc_item'] : '',
                isset($registro['DESC_ITEM']) ? $registro['DESC_ITEM'] : '',
                isset($registro['desc-it']) ? $registro['desc-it'] : '',
                isset($registro['DESC-IT']) ? $registro['DESC-IT'] : '',
                isset($registro[0]) ? $registro[0] : ''
            );
            if ($descricao !== '') {
                break;
            }
        }
    }
    if ($descricao === '' || stripos($descricao, 'Item N') === 0) {
        $descricao = '';
    }
    $cache[$codigo] = $descricao;
    return $descricao;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_descricao_item ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_produto_ima ------*/

function cir_produto_ima($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_descricao_item($this->cir_valor($linha, 'ipc_codigo_erp'));

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_produto_ima ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_envio_desenhos ------*/

function cir_prev_envio_desenhos($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $dataPedido = $this->cir_valor($linha, 'pc_dt_registro');
    if ($this->cir_acabamento_liso($linha)) {
        return $this->cir_add_dias_uteis($dataPedido, 2);
    }
    if ($this->cir_acabamento_exige_desenho($linha)) {
        return $this->cir_add_dias_uteis($dataPedido, 5);
    }
    return $this->cir_data_iso($this->cir_valor($linha, 'ipc_dt_prev_envio_desenhos'));

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_envio_desenhos ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_recbto_so_ld ------*/

function cir_prev_recbto_so_ld($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $base = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'ipc_dt_real_envio_desenhos'),
        $this->cir_prev_envio_desenhos($linha)
    );
    if ($this->cir_acabamento_liso($linha)) {
        return $this->cir_add_dias_corridos($base, 20);
    }
    if ($this->cir_acabamento_exige_desenho($linha)) {
        return $this->cir_add_dias_corridos($base, 30);
    }
    return $this->cir_data_iso($this->cir_valor($linha, 'ipc_dt_prev_recbto_so_ld'));

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_recbto_so_ld ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_aprov_so_ld ------*/

function cir_prev_aprov_so_ld($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $base = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'ipc_dt_real_recbto_so_ld'),
        $this->cir_prev_recbto_so_ld($linha)
    );
    if ($base === '') {
        return $this->cir_data_iso($this->cir_valor($linha, 'ipc_dt_prev_aprov_so_ld'));
    }
    return $this->cir_add_dias_uteis($base, 1);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_aprov_so_ld ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_dt_maxima_producao ------*/

function cir_dt_maxima_producao($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $base = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'ipc_dt_real_aprov_so_ld'),
        $this->cir_prev_aprov_so_ld($linha)
    );
    $dias = $this->cir_valor($linha, 'ipc_qt_dias_producao');
    if ($base === '' || $dias === '') {
        return $this->cir_data_iso($this->cir_valor($linha, 'ipc_dt_maxima_producao'));
    }
    return $this->cir_add_dias_corridos($base, (int) $dias);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_dt_maxima_producao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_embarque ------*/

function cir_prev_embarque($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $base = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'ipc_dt_termino_producao'),
        $this->cir_dt_maxima_producao($linha)
    );
    if ($base === '') {
        return $this->cir_data_iso($this->cir_valor($linha, 'c_dt_prev_embarque'));
    }
    return $this->cir_add_dias_corridos($base, 15);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_embarque ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_chegada_porto ------*/

function cir_prev_chegada_porto($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $base = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'c_dt_real_embarque'),
        $this->cir_prev_embarque($linha)
    );
    $dias = $this->cir_valor($linha, 'pc_qt_dias_translado');
    if ($base === '' || $dias === '') {
        return $this->cir_data_iso($this->cir_valor($linha, 'c_dt_prev_chegada'));
    }
    return $this->cir_add_dias_corridos($base, (int) $dias);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_chegada_porto ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_transit_time_realizado ------*/

function cir_transit_time_realizado($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $embarque = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'c_dt_real_embarque'),
        $this->cir_valor($linha, 'c_dt_prev_embarque')
    );
    $chegada = $this->cir_primeiro_valor(
        $this->cir_valor($linha, 'c_dt_recebimento'),
        $this->cir_valor($linha, 'c_dt_prev_chegada')
    );
    $embarque = $this->cir_data_iso($embarque);
    $chegada = $this->cir_data_iso($chegada);
    if ($embarque === '' || $chegada === '') {
        return '';
    }
    $dtEmbarque = new DateTime($embarque);
    $dtChegada = new DateTime($chegada);
    return (string) $dtEmbarque->diff($dtChegada)->days;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_transit_time_realizado ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_envio_mostruario ------*/

function cir_prev_envio_mostruario($linha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $this->cir_add_dias_corridos($this->cir_valor($linha, 'ipc_dt_cheg_amostras_emb'), 15);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_prev_envio_mostruario ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colunas_base_relatorio ------*/

function cir_colunas_base_relatorio()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return array(
        array('key' => 'data_pedido_compra', 'titulo' => 'DATA DO PEDIDO COMPRA', 'tipo' => 'data', 'campo' => 'pc_dt_registro', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'pedido_fornecedor', 'titulo' => 'PEDIDO FORNECEDOR', 'tipo' => 'texto', 'campo' => 'pc_cod_proc_fornec', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'processo_origem', 'titulo' => 'PROCESSO DE ORIGEM', 'tipo' => 'texto', 'callback' => 'cir_processo_origem', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'processo_container', 'titulo' => 'PROCESSO CONTAINER', 'tipo' => 'texto', 'callback' => 'cir_processo_container', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'parcial'),
        array('key' => 'produto_fornecedor', 'titulo' => 'PRODUTO FORNECEDOR', 'tipo' => 'texto', 'campo' => 'ipc_descricao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'codigo_ima', 'titulo' => 'CÓDIGO IMA', 'tipo' => 'texto', 'campo' => 'ipc_codigo_erp', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'produto_ima', 'titulo' => 'PRODUTO IMA (A nível de pedido)', 'tipo' => 'texto', 'callback' => 'cir_produto_ima', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_proforma', 'titulo' => 'QTDE. PROFORMA', 'tipo' => 'numero', 'campo' => 'ipc_qt_comprada', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_packing_list', 'titulo' => 'QTDE DO PACKING LIST', 'tipo' => 'numero', 'campo' => 'ic_qt_confirm_emb', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'unidade_medida', 'titulo' => 'MTS/ KGS', 'tipo' => 'texto', 'campo' => 'ipc_unid_medida', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'cubagem', 'titulo' => 'CUBAGEM', 'tipo' => 'numero', 'campo' => 'ipc_vl_cubagem', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'colecao', 'titulo' => 'COLEÇÃO', 'tipo' => 'texto', 'callback' => 'cir_colecao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'classificacao_acabamento', 'titulo' => 'CLASSIFICAÇÃO ACABAMENTO', 'tipo' => 'texto', 'callback' => 'cir_classificacao_acabamento', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'observacao_pedido', 'titulo' => 'OBSERVAÇÃO DO PEDIDO', 'tipo' => 'texto', 'campo' => 'pc_observacao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'certificado_oekotex', 'titulo' => 'CONTÉM CERTIFICADO OEKOTEX (sim ou não)', 'tipo' => 'texto', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'importacao_direta_cliente', 'titulo' => 'IMPORTAÇÃO DIRETA PARA CLIENTE (sim ou não)', 'tipo' => 'texto', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'dt_chegada_amostra_qualidade_pedido', 'titulo' => 'DT. CHEGADA AMOSTRA QUALIDADE DO PEDIDO DE COMPRA', 'tipo' => 'data', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'dt_prev_envio_desenhos', 'titulo' => 'DT. PREV. ENVIO DOS DESENHOS', 'tipo' => 'data', 'callback' => 'cir_prev_envio_desenhos', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_real_envio_desenhos', 'titulo' => 'DT. REAL ENVIO DOS DESENHOS', 'tipo' => 'data', 'campo' => 'ipc_dt_real_envio_desenhos', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_prev_recbto_so_ld', 'titulo' => 'DT. PREV. RECEB. STIKE OFF E LAB DIP', 'tipo' => 'data', 'callback' => 'cir_prev_recbto_so_ld', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_real_recbto_so_ld', 'titulo' => 'DT. REAL. RECEB. STIKE OFF E LAB DIP', 'tipo' => 'data', 'campo' => 'ipc_dt_real_recbto_so_ld', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_prev_aprov_so_ld', 'titulo' => 'DT. PREV. APROVAÇÃO STIKE OFF E LAB DIP', 'tipo' => 'data', 'callback' => 'cir_prev_aprov_so_ld', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_real_aprov_so_ld', 'titulo' => 'DT. REAL APROVAÇÃO STIKE OFF E LAB DIP', 'tipo' => 'data', 'campo' => 'ipc_dt_real_aprov_so_ld', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_dias_producao', 'titulo' => 'QTDE. DIAS DE PRODUÇÃO', 'tipo' => 'numero0', 'campo' => 'ipc_qt_dias_producao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_maxima_producao', 'titulo' => 'DT. MÁX. PERMITIDA P/ O FIM DA PRODUÇÃO', 'tipo' => 'data', 'callback' => 'cir_dt_maxima_producao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_termino_producao', 'titulo' => 'TÉRMINO DA PRODUÇÃO', 'tipo' => 'data', 'campo' => 'ipc_dt_termino_producao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'producao_no_prazo', 'titulo' => 'PRODUÇÃO NO PRAZO', 'tipo' => 'sim_nao', 'campo' => 'ipc_ind_producao_no_prazo', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_chegada_amostras_embarque', 'titulo' => 'DT. CHEGADA DAS AMOSTRAS DE EMBARQUE', 'tipo' => 'data', 'campo' => 'ipc_dt_cheg_amostras_emb', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'andamento_pedido', 'titulo' => 'ANDAMENTO DO PEDIDO', 'tipo' => 'texto', 'campo' => 'c_situacao_container_id', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'parcial'),
        array('key' => 'dt_prev_embarque', 'titulo' => 'Dt.Prev.Embarque', 'tipo' => 'data', 'callback' => 'cir_prev_embarque', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_real_embarque', 'titulo' => 'DT. REAL EMBARQUE', 'tipo' => 'data', 'campo' => 'c_dt_real_embarque', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_prev_chegada_porto', 'titulo' => 'Dt previsão de  chegada no porto', 'tipo' => 'data', 'callback' => 'cir_prev_chegada_porto', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'calculo'),
        array('key' => 'dt_chegada_porto_atualizada', 'titulo' => 'Dt chegada no porto atualizada', 'tipo' => 'data', 'campo' => 'c_dt_recebimento', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'dt_recebimento_container_estoque', 'titulo' => 'DT. RECEBIMENTO CONTAINER NO ESTOQUE', 'tipo' => 'data', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'porto_recebido', 'titulo' => 'PORTO RECEBIDO', 'tipo' => 'texto', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'pendente'),
        array('key' => 'status_container', 'titulo' => 'STATUS CONTAINER', 'tipo' => 'texto', 'campo' => 'c_situacao', 'relatorios' => array('completo', 'sintetico'), 'situacao' => 'disponivel'),
        array('key' => 'proforma_recebida', 'titulo' => 'PROFORMA RECEBIDA (SIM OU NÃO)', 'tipo' => 'texto', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
        array('key' => 'data_ultimo_relatorio_semanal', 'titulo' => 'DATA DO ULTIMO RELATÓRIO SEMANAL', 'tipo' => 'data', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
        array('key' => 'laudo_conforme_proforma', 'titulo' => 'LAUDO CONFORME PROFORMA', 'tipo' => 'sim_nao', 'campo' => 'ipc_ind_prod_conf_pi', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'receb_laudo_antes_embarque', 'titulo' => 'RECEB. DO LAUDO ANTES DO EMBARQUE', 'tipo' => 'data', 'campo' => 'ipc_dt_recbto_laudo', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'dt_recebimento_amostra_embalagem', 'titulo' => 'DT. RECEBIMENTO AMOSTRA EMBALAGEM PRE EMBARQUE', 'tipo' => 'data', 'campo' => 'ipc_dt_recbto_embalagem', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'envio_ficha_tecnica_antes_embarque', 'titulo' => 'ENVIO DE FICHA TÉCNICA ANTES DO EMBARQUE (SIM OU NÃO)', 'tipo' => 'texto', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
        array('key' => 'envio_etiquetas', 'titulo' => 'ENVIO DAS ETIQUETAS (sim ou não)', 'tipo' => 'texto', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
        array('key' => 'doc_receb_ate_2_dias_embarque', 'titulo' => 'DOC. RECEB. ATÉ 02 DIAS APÓS EMBARQUE?', 'tipo' => 'sim_nao', 'campo' => 'ic_log_rec_doc_prazo_emb', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'booking_confirmado_agente', 'titulo' => 'BOOKING CONFIRMADO PELO AGENTE DE CARGAS (SIM OU NÃO)', 'tipo' => 'sim_nao', 'campo' => 'c_ind_dt_embarque', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_alocada', 'titulo' => 'QTDE. ALOCADA', 'tipo' => 'numero', 'campo' => 'ic_qt_alocada', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'dt_prev_envio_mostruario', 'titulo' => 'DT. PREVISTA ENVIO  DO MOSTRUÁRIO (Dt. de chegada das amostras de embarque finalizada+15 dias)', 'tipo' => 'data', 'callback' => 'cir_prev_envio_mostruario', 'relatorios' => array('completo'), 'situacao' => 'calculo'),
        array('key' => 'dt_envio_mostruario', 'titulo' => 'DT. DO  ENVIO MOSTRUÁRIO', 'tipo' => 'data', 'campo' => 'ipc_dt_mostruario', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'status_prev_chegada', 'titulo' => 'Status da Prev. Chegada', 'tipo' => 'texto', 'campo' => 'c_ind_dt_prev_chegada', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'situacao_ped_importacao', 'titulo' => 'SITUAÇÃO PED. IMPORTAÇÃO', 'tipo' => 'texto', 'campo' => 'pc_cod_situacao', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_recebida_estoque', 'titulo' => 'QTDE RECEBIDA NO ESTOQUE', 'tipo' => 'numero', 'campo' => 'ic_qt_recbto_fisico', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'recebimento_embalagem_padrao', 'titulo' => 'RECEBIMENTO EMBALAGEM NO ESTOQUE CONFORME PADRÃO', 'tipo' => 'sim_nao', 'campo' => 'ipc_ind_qualid_emb', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'qtde_alocada_conforme_proforma', 'titulo' => 'QTDE. ALOCADA CONFORME PROFORMA', 'tipo' => 'sim_nao', 'campo' => 'ipc_ind_qt_conf_proforma', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'transit_time_previsto', 'titulo' => 'TRANSIT TIME PREVISTO', 'tipo' => 'numero0', 'campo' => 'pc_qt_dias_translado', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'transit_time_realizado', 'titulo' => 'TRANSIT TIME REALIZADO (Dt. de chegada no porto - embarque)', 'tipo' => 'numero0', 'callback' => 'cir_transit_time_realizado', 'relatorios' => array('completo'), 'situacao' => 'calculo'),
        array('key' => 'id_ped_compra', 'titulo' => 'ID. PED. COMPRA', 'tipo' => 'texto', 'campo' => 'pc_proc_compra_id', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'codigo_fornecedor', 'titulo' => 'CÓDIGO DO FORNECEDOR', 'tipo' => 'texto', 'callback' => 'cir_fornecedor', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'emitente_container', 'titulo' => 'EMITENTE CONTAINER', 'tipo' => 'texto', 'callback' => 'cir_emitente_container', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'tamanho_container', 'titulo' => 'TAMANHO DO CONTAINER', 'tipo' => 'texto', 'campo' => 'c_medidas_container', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'formato_amostras', 'titulo' => 'FORMATO DAS AMOSTRAS', 'tipo' => 'texto', 'campo' => 'ipc_formato_amostra_id', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'amostras_enviadas_para', 'titulo' => 'AMOSTRAS ENVIADAS PARA TODOS/ALGUNS (Preenchimento pelo setor de Amostra)', 'tipo' => 'texto', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
        array('key' => 'tam_rolo', 'titulo' => 'TAM. ROLO', 'tipo' => 'texto', 'campo' => 'ipc_rolo', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'largura', 'titulo' => 'LARGURA', 'tipo' => 'texto', 'campo' => 'ipc_largura', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'peso', 'titulo' => 'PESO', 'tipo' => 'texto', 'campo' => 'ipc_peso', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'composicao', 'titulo' => 'COMPOSIÇÃO', 'tipo' => 'texto', 'campo' => 'ipc_composicao', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'agente_cargas', 'titulo' => 'AGENTE DE CARGAS', 'tipo' => 'texto', 'campo' => 'c_cod_agente_cargas', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'armador', 'titulo' => 'ARMADOR', 'tipo' => 'texto', 'campo' => 'c_cod_armador', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'cotacao_dolar_compra', 'titulo' => 'COTAÇÃO DÓLAR AO FECHAR PEDIDO DE COMPRA', 'tipo' => 'numero5', 'campo' => 'c_vl_dolar_compra', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'preco_compra_dolar', 'titulo' => 'PREÇO DE COMPRA DÓLAR', 'tipo' => 'numero5', 'campo' => 'ipc_vl_custo_dolar', 'relatorios' => array('completo'), 'situacao' => 'disponivel'),
        array('key' => 'dt_pagamento_final', 'titulo' => 'DT. PAGAMENTO FINAL (POR BUSCA)', 'tipo' => 'data', 'relatorios' => array('completo'), 'situacao' => 'pendente'),
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colunas_base_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colunas_relatorio ------*/

function cir_colunas_relatorio($tipoRelatorio = 'completo')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipoRelatorio = strtolower(trim((string) $tipoRelatorio));
    if ($tipoRelatorio !== 'sintetico') {
        $tipoRelatorio = 'completo';
    }
    $colunas = array();
    foreach ($this->cir_colunas_base_relatorio() as $coluna) {
        if (in_array($tipoRelatorio, $coluna['relatorios'], true)) {
            $colunas[] = $coluna;
        }
    }
    return $colunas;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_colunas_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_valor_coluna ------*/

function cir_valor_coluna($linha, $coluna)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (isset($coluna['callback'])) {
        if (isset($this) && is_object($this) && method_exists($this, $coluna['callback'])) {
            return call_user_func(array($this, $coluna['callback']), $linha);
        }
        if (function_exists($coluna['callback'])) {
            return call_user_func($coluna['callback'], $linha);
        }
    }
    if (!isset($coluna['campo'])) {
        return '';
    }
    $valor = $this->cir_valor($linha, $coluna['campo']);
    $tipo = isset($coluna['tipo']) ? $coluna['tipo'] : 'texto';
    if ($tipo === 'data') {
        return $this->cir_data_iso($valor);
    }
    if ($tipo === 'sim_nao') {
        return $this->cir_sim_nao($valor);
    }
    return $valor;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_valor_coluna ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_montar_linha_relatorio ------*/

function cir_montar_linha_relatorio($linha, $tipoRelatorio = 'completo')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $resultado = array();
    foreach ($this->cir_colunas_relatorio($tipoRelatorio) as $coluna) {
        $resultado[$coluna['key']] = $this->cir_valor_coluna($linha, $coluna);
    }
    return $resultado;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_montar_linha_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_montar_dados_relatorio ------*/

function cir_montar_dados_relatorio($dados, $tipoRelatorio = 'completo')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $resultado = array();
    if (!is_array($dados)) {
        return $resultado;
    }
    foreach ($dados as $linha) {
        $resultado[] = $this->cir_montar_linha_relatorio($linha, $tipoRelatorio);
    }
    return $resultado;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_montar_dados_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_buscar_dados_relatorio ------*/

function cir_buscar_dados_relatorio($processo = '', $container = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (isset($GLOBALS['cie_contexto_scriptcase'])
        && is_object($GLOBALS['cie_contexto_scriptcase'])
        && method_exists($GLOBALS['cie_contexto_scriptcase'], 'buscarItensContainerProcCompra')) {
        $dados = $GLOBALS['cie_contexto_scriptcase']->buscarItensContainerProcCompra($processo, $container);
        return is_array($dados) ? $dados : array();
    }
    if (isset($this) && is_object($this) && method_exists($this, 'buscarItensContainerProcCompra')) {
        $dados = $this->buscarItensContainerProcCompra($processo, $container);
        return is_array($dados) ? $dados : array();
    }
    if (function_exists('buscarItensContainerProcCompra')) {
        $dados = $this->buscarItensContainerProcCompra($processo, $container);
        return is_array($dados) ? $dados : array();
    }
    $arquivos = array(
        __DIR__ . '/itens_proc_compra.php',
        dirname(__DIR__) . '/itens_proc_compra.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/lib/php/itens_proc_compra.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/grp/itens_proc_compra.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/prj/itens_proc_compra.php',
    );
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '' && is_file($arquivo)) {
            include_once $arquivo;
            if (function_exists('buscarItensContainerProcCompra')) {
                $dados = $this->buscarItensContainerProcCompra($processo, $container);
                return is_array($dados) ? $dados : array();
            }
        }
    }
    return array();

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_buscar_dados_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_pendentes ------*/

function cir_campos_pendentes()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $pendentes = array();
    foreach ($this->cir_colunas_base_relatorio() as $coluna) {
        if (isset($coluna['situacao']) && $coluna['situacao'] === 'pendente') {
            $pendentes[] = $coluna;
        }
    }
    return $pendentes;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_pendentes ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_disponiveis ------*/

function cir_campos_disponiveis()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $disponiveis = array();
    foreach ($this->cir_colunas_base_relatorio() as $coluna) {
        if (isset($coluna['situacao']) && $coluna['situacao'] !== 'pendente') {
            $disponiveis[] = $coluna;
        }
    }
    return $disponiveis;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_disponiveis ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_fora_relatorio ------*/

function cir_campos_fora_relatorio()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return array(
        array('campo' => 'c_exclusivo', 'titulo' => 'Exclusivo?', 'motivo' => 'Controle de visibilidade para representantes; nao representa importacao direta para cliente.'),
        array('campo' => 'pc_dt_limite', 'titulo' => 'Dt.Limite Ped.Importacao', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'pc_log_facilid_contato_fornec', 'titulo' => 'Facilidade de Contato com Fornecedor?', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ipc_item_proc_compra_id', 'titulo' => 'ID Item Ped.Importacao', 'motivo' => 'Usar apenas como chave tecnica interna quando necessario; nao exibir no relatorio.'),
        array('campo' => 'ipc_vl_base_tributacao', 'titulo' => 'Vl.Base Tributacao', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ipc_log_aprov_so_ld', 'titulo' => 'Aprova Strike Offs e Lab Dips?', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ipc_log_mostruario', 'titulo' => 'Controla Data Mostruario?', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ipc_ind_laudo_antes_embarque', 'titulo' => 'Laudo Antes Embarque?', 'motivo' => 'Descontinuar; manter apenas Dt.Recbto.Laudo conforme planilha.'),
        array('campo' => 'c_log_pagto_final', 'titulo' => 'Log Pagto Final', 'motivo' => 'Flag interna; data de pagamento final permanece pendente.'),
        array('campo' => 'c_vl_dolar_venda', 'titulo' => 'Vl. Dolar Venda', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ipc_ind_tamanho_pecas_correto', 'titulo' => 'Tamanho de Pecas de acordo com o Solicitado?', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
        array('campo' => 'ic_observacao', 'titulo' => 'Observacao Item Container', 'motivo' => 'Marcado para excluir/ocultar na planilha de atualizacao.'),
    );

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_relatorio.php => function cir_campos_fora_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlItemProcCompra ------*/

function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItensContainerProcCompra ------*/

function buscarItensContainerProcCompra($codProcFornec='', $container='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tabela = 'PUB.procs_compra pc
        left outer join PUB.itens_proc_compra ipc
            on ipc.proc_compra_id = pc.proc_compra_id
        left outer join pub.itens_container ic
            on ipc.item_proc_compra_id = ic.item_proc_compra_id
        left outer join PUB."pp-container" c
            on ic.container_id = c."nr-container"';

    $campos = 'pc.proc_compra_id as pc_proc_compra_id,
        pc.empresa_id as pc_empresa_id,
        pc.qt_container as pc_qt_container,
        pc.cod_situacao as pc_cod_situacao,
        pc.cod_proc_fornec as pc_cod_proc_fornec,
        pc.qt_dias_translado as pc_qt_dias_translado,
        pc.cotacao_prevista as pc_cotacao_prevista,
        pc.observacao as pc_observacao,
        pc.dt_registro as pc_dt_registro,
        pc.fornecedor_id as pc_fornecedor_id,
        pc.dt_limite as pc_dt_limite,
        pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec,
        pc.nr_container_original as pc_nr_container_original,
        ipc.item_proc_compra_id as ipc_item_proc_compra_id,
        ipc.descricao as ipc_descricao,
        ipc.codigo_erp as ipc_codigo_erp,
        ipc.qt_dias_producao as ipc_qt_dias_producao,
        ipc.vl_base_tributacao as ipc_vl_base_tributacao,
        ipc.unid_medida as ipc_unid_medida,
        ipc.proc_compra_id as ipc_proc_compra_id,
        ipc.qt_comprada as ipc_qt_comprada,
        ipc.vl_custo_dolar as ipc_vl_custo_dolar,
        ipc.composicao as ipc_composicao,
        ipc.peso as ipc_peso,
        ipc.largura as ipc_largura,
        ipc.rolo as ipc_rolo,
        ipc.dt_prev_envio_desenhos as ipc_dt_prev_envio_desenhos,
        ipc.dt_real_envio_desenhos as ipc_dt_real_envio_desenhos,
        ipc.log_aprov_so_ld as ipc_log_aprov_so_ld,
        ipc.dt_prev_aprov_so_ld as ipc_dt_prev_aprov_so_ld,
        ipc.dt_real_aprov_so_ld as ipc_dt_real_aprov_so_ld,
        ipc.coloracao_id as ipc_coloracao_id,
        ipc.dt_maxima_producao as ipc_dt_maxima_producao,
        ipc.dt_mostruario as ipc_dt_mostruario,
        ipc.log_mostruario as ipc_log_mostruario,
        ipc.formato_amostra_id as ipc_formato_amostra_id,
        ipc.observacao as ipc_observacao,
        ipc.dt_cheg_amostras_emb as ipc_dt_cheg_amostras_emb,
        ipc.dt_prev_recbto_so_ld as ipc_dt_prev_recbto_so_ld,
        ipc.vl_cubagem as ipc_vl_cubagem,
        ipc.dt_recbto_laudo as ipc_dt_recbto_laudo,
        ipc.dt_recbto_embalagem as ipc_dt_recbto_embalagem,
        ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo,
        ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao,
        ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque,
        ipc.ind_qualid_emb as ipc_ind_qualid_emb,
        ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi,
        ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb,
        ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma,
        ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto,
        ipc.dt_real_recbto_so_ld as ipc_dt_real_recbto_so_ld,
        ipc.dt_termino_producao as ipc_dt_termino_producao,
        ic.container_id as ic_container_id,
        ic.item_proc_compra_id as ic_item_proc_compra_id,
        ic.qt_alocada as ic_qt_alocada,
        ic.item_container_id as ic_item_container_id,
        ic.qt_confirm_emb as ic_qt_confirm_emb,
        ic.qt_recbto_fisico as ic_qt_recbto_fisico,
        ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb,
        ic.observacao as ic_observacao,
        c."cod-estabel" as c_cod_estabel,
        c."nome-ab-forn" as c_nome_ab_forn,
        c."cod-emit-forn" as c_cod_emit_forn,
        c."dt-compra" as c_dt_compra,
        c."nr-container" as c_nr_container,
        c."dt-recebimento" as c_dt_recebimento,
        c."dt-prev-chegada" as c_dt_prev_chegada,
        c.situacao as c_situacao,
        c."vl-dolar-venda" as c_vl_dolar_venda,
        c."vl-dolar-compra" as c_vl_dolar_compra,
        c.medidas_container as c_medidas_container,
        c.dt_prev_embarque as c_dt_prev_embarque,
        c.dt_real_embarque as c_dt_real_embarque,
        c.situacao_container_id as c_situacao_container_id,
        c.ind_dt_embarque as c_ind_dt_embarque,
        c.ind_dt_prev_chegada as c_ind_dt_prev_chegada,
        c.log_pagto_final as c_log_pagto_final,
        c.cod_agente_cargas as c_cod_agente_cargas,
        c.cod_armador as c_cod_armador,
        c.exclusivo as c_exclusivo';

    $condicao = '1 = 1';

    if($codProcFornec <> ''){
        $codProcFornec = $this->Db->qstr($codProcFornec);
        $condicao .= " and pc.cod_proc_fornec = $codProcFornec";
    }

    if($container <> ''){
        $container = $this->Db->qstr($container);
        $condicao .= " and c.\"nr-container\" = $container";
    }

    $aRetorno = $this->getDados('multi',$tabela,$campos,$condicao,'espec');
    return $aRetorno;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItensContainerProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarFornecItemProcCompra ------*/

function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarFornecItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCustoItens ------*/

function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCustoItens ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlTribItens ------*/

function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlTribItens ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocItemProc ------*/

function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtSaldoItemProc ------*/

function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtSaldoItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtCompradaItemProc ------*/

function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtCompradaItemProc ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItemAlocado ------*/

function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarItemAlocado ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarPonderacaoItensProcCompra ------*/

function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarPonderacaoItensProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlProcCompraAtu ------*/

function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarVlProcCompraAtu ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarProcCompraItem ------*/

function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarProcCompraItem ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCodItemERP ------*/

function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarCodItemERP ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarDescItemProcCompra ------*/

function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarDescItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarContainersItemProcCompra ------*/

function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarContainersItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocadaItemProcCompra ------*/

function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function buscarQtAlocadaItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevRecbtoSoLd ------*/

function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevRecbtoSoLd ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtMaximaProducao ------*/

function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtMaximaProducao ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevEmbarque ------*/

function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function sugerirDtPrevEmbarque ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function retornarCampoItemProcCompra ------*/

function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function retornarCampoItemProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function getIDItensProcCompra ------*/

function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function getIDItensProcCompra ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function validarItemMesmoCodigoPrecoDif ------*/

function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function validarItemMesmoCodigoPrecoDif ------*/


/*----- Scriptcase Locale: PHP Method: itens_proc_compra.php => function updateDtCertificacaoItem ------*/

function updateDtCertificacaoItem($idItemProcCompra,$data){
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  


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
      
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_proc_compra.php => function updateDtCertificacaoItem ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTb ------*/

function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTb ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getTipoConexao ------*/

function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getTipoConexao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getReg ------*/

function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getReg ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getDados ------*/

function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getDados ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornoSimplesTb01 ------*/

function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornoSimplesTb01 ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function inserirLogSQL ------*/

function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function inserirLogSQL ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTbSessao ------*/

function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function setCpsTbSessao ------*/

function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function setCpsTbSessao ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornoMultReg ------*/

function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornoMultReg ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getUltIdTabela ------*/

function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getUltIdTabela ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function execAcaoPDO ------*/

function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function execAcaoPDO ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getODBCDireto ------*/

function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getODBCDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function conectarBase ------*/

function conectarBase($conexaoSC,$usuario='sysprogress',$senha='__OMITIDO_NA_COPIA_DE_ANALISE__',$logOdbc=true)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function conectarBase ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function retornarChaveEstr ------*/

function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function retornarChaveEstr ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertArrayEmUpdate ------*/

function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertArrayEmUpdate ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertDadosSqlParaAPI ------*/

function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertDadosSqlParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getCpsTbSQLSERVER ------*/

function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getCpsTbSQLSERVER ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getRegsSqlLivre ------*/

function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getRegsSqlLivre ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertArrayEmInsert ------*/

function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertArrayEmInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function updateDireto ------*/

function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function updateDireto ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function setCondWhere ------*/

function setCondWhere($cond)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['bl_cons_planilha']['inicio']);
}

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function setCondWhere ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function conectarBaseMysql ------*/

function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function conectarBaseMysql ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function getUsuarioLock ------*/

function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function getUsuarioLock ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function acertarAspasSimplesInsert ------*/

function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function acertarAspasSimplesInsert ------*/


/*----- Scriptcase Locale: PHP Method: sql.php => function convertCpParaAPI ------*/

function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: sql.php => function convertCpParaAPI ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarDadositemContainer ------*/

function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarDadositemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function getRegItemContainer ------*/

function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function getRegItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarFornecProcCompraItemContainer ------*/

function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarFornecProcCompraItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarProcCompraItemContainer ------*/

function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarProcCompraItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarIDItensContainer ------*/

function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarIDItensContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function existItensContainer ------*/

function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function existItensContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function criarItensContainer ------*/

function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function criarItensContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustoPrevDolarContainer ------*/

function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustoPrevDolarContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustoPrevRealContainer ------*/

function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valorEmReal = 0;
    $valorEmDOLAR = $this->buscarTotCustoPrevDolarContainer($containerId,$tipo,$item);
    if($aCotacao == ''){
        if($tipo == 'tributado'){
            $aCotacao     = buscarDolar($containerId,'di');
        }else{
            $aCotacao     = buscarDolar($containerId,'compra');
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustoPrevRealContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustosPrevRealContainer ------*/

function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarTotCustosPrevRealContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarCustoRealItens ------*/

function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $aCustoItens                    	 = array();
    $lAchou                              = false;
    $vlPagoItens                	     = buscarTotPagoContainer($containerId);
    $aPondItens             	         = buscarValoresItensNFImp($containerId);
    $listaNatOperNfMae                   = getListaNatOperNotaMae();
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarCustoRealItens ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function buscarVlCustoTotalContainer ------*/

function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function buscarVlCustoTotalContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function calcularCustoGeralItem ------*/

function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  

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
        $totDespesas = getTotDespContainerRatItem($container,$tipoCusto);
        
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
        $aDolarMedio = buscarDolarMedio($container,'negociado');
    }else{
        $aDolarMedio = buscarDolarMedio($container,'proforma');
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

                
                $vlDespItem = getTotDespItemContainer($itemContainerID,$tipoCusto);


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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function calcularCustoGeralItem ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function atualizarUtilizCustoItem ------*/

function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function atualizarUtilizCustoItem ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function verificarItensSemCodERP ------*/

function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function verificarItensSemCodERP ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function getDescrItemContainer ------*/

function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function getDescrItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function getContainerItemContainer ------*/

function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function getContainerItemContainer ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function getIdContainersAlocItemPedImp ------*/

function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function getIdContainersAlocItemPedImp ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function sincrQtEmbarcadaCtaCorrenFornec ------*/

function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function sincrQtEmbarcadaCtaCorrenFornec ------*/


/*----- Scriptcase Locale: PHP Method: itens_container.php => function getListaCodFornecItensContainer ------*/

function getListaCodFornecItensContainer($container)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $sql = "select distinct proc_compra.fornecedor_id as fornecedor_id from pub.itens_container item_container
            inner join pub.itens_proc_compra  item_proc_compra
            on item_proc_compra.item_proc_compra_id  = item_container.item_proc_compra_id 
            inner join pub.procs_compra proc_compra
            on proc_compra.proc_compra_id  = item_proc_compra.proc_compra_id 
            where item_container.container_id = $container";
    $aRet = $this->getRegsSqlLivre($sql,'fornecedor_id',"espec");
    return convArrayMultParaLista($aRet,'fornecedor_id');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: itens_container.php => function getListaCodFornecItensContainer ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_template_excel ------*/

function cie_template_excel($tipoRelatorio)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipoRelatorio = $this->cie_tipo_relatorio($tipoRelatorio);
    if ($tipoRelatorio === 'sintetico') {
        if (defined('CIE_TEMPLATE_SINTETICO') && is_file(CIE_TEMPLATE_SINTETICO)) {
            return CIE_TEMPLATE_SINTETICO;
        }
        $templates = array(
            '/var/www/clients/client1/web2/web/ciw/_lib/file/controle_importacao_sintetico.xlsx',
            dirname(__DIR__) . '/_lib/file/controle_importacao_sintetico.xlsx',
            __DIR__ . '/../_lib/file/controle_importacao_sintetico.xlsx',
            __DIR__ . '/controle_importacao_sintetico.xlsx',
        );
        foreach ($templates as $template) {
            if (is_file($template)) {
                return $template;
            }
        }
        return $templates[0];
    }
    if (defined('CIE_TEMPLATE_COMPLETO') && is_file(CIE_TEMPLATE_COMPLETO)) {
        return CIE_TEMPLATE_COMPLETO;
    }
    $templates = array(
        '/var/www/clients/client1/web2/web/ciw/_lib/file/controle_importacao_completo.xlsx',
        dirname(__DIR__) . '/_lib/file/controle_importacao_completo.xlsx',
        __DIR__ . '/../_lib/file/controle_importacao_completo.xlsx',
        __DIR__ . '/controle_importacao_completo.xlsx',
    );
    foreach ($templates as $template) {
        if (is_file($template)) {
            return $template;
        }
    }
    return $templates[0];

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_template_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_carregar_biblioteca_relatorio ------*/

function cie_carregar_biblioteca_relatorio()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (function_exists('cir_colunas_relatorio')) {
        return true;
    }
    if (isset($this) && is_object($this) && method_exists($this, 'cir_colunas_relatorio')) {
        return true;
    }
    $arquivos = array(
        __DIR__ . '/controle_importacao_relatorio.php',
        dirname(__DIR__) . '/controle_importacao_relatorio.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/lib/php/controle_importacao_relatorio.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/grp/controle_importacao_relatorio.php',
        '/var/www/clients/client1/web2/web/ciw/_lib/libraries/prj/controle_importacao_relatorio.php',
    );
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '' && is_file($arquivo)) {
            include_once $arquivo;
            if (function_exists('cir_colunas_relatorio')) {
                return true;
            }
            if (isset($this) && is_object($this) && method_exists($this, 'cir_colunas_relatorio')) {
                return true;
            }
        }
    }
    return function_exists('cir_colunas_relatorio')
        || (isset($this) && is_object($this) && method_exists($this, 'cir_colunas_relatorio'));

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_carregar_biblioteca_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_tipo_relatorio ------*/

function cie_tipo_relatorio($tipoRelatorio)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipoRelatorio = strtolower(trim((string) $tipoRelatorio));
    return $tipoRelatorio === 'sintetico' ? 'sintetico' : 'completo';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_tipo_relatorio ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_linha_titulos_excel ------*/

function cie_linha_titulos_excel()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return defined('CIE_LINHA_TITULOS_EXCEL') ? (int) CIE_LINHA_TITULOS_EXCEL : 1;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_linha_titulos_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_linha_modelo_excel ------*/

function cie_linha_modelo_excel()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return defined('CIE_LINHA_MODELO_EXCEL') ? (int) CIE_LINHA_MODELO_EXCEL : 2;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_linha_modelo_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_primeira_linha_dados_excel ------*/

function cie_primeira_linha_dados_excel()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return defined('CIE_PRIMEIRA_LINHA_DADOS_EXCEL') ? (int) CIE_PRIMEIRA_LINHA_DADOS_EXCEL : 2;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_primeira_linha_dados_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_indice_aba_excel ------*/

function cie_indice_aba_excel()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return defined('CIE_INDICE_ABA_EXCEL') ? (int) CIE_INDICE_ABA_EXCEL : 0;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_indice_aba_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_carregar_phpexcel ------*/

function cie_carregar_phpexcel()
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (class_exists('PHPExcel_IOFactory')) {
        return true;
    }
    if (function_exists('sc_include_lib')) {
        sc_include_lib('excel');
        if (class_exists('PHPExcel_IOFactory')) {
            return true;
        }
        sc_include_lib('phpexcel');
        if (class_exists('PHPExcel_IOFactory')) {
            return true;
        }
    }
    $arquivos = array(
        __DIR__ . '/PHPExcel/PHPExcel.php',
        __DIR__ . '/vendor/phpoffice/phpexcel/Classes/PHPExcel.php',
        __DIR__ . '/vendor/autoload.php',
        __DIR__ . '/_lib/prod/third/phpexcel/PHPExcel.php',
        __DIR__ . '/../_lib/prod/third/phpexcel/PHPExcel.php',
        __DIR__ . '/../../_lib/prod/third/phpexcel/PHPExcel.php',
        __DIR__ . '/../../../_lib/prod/third/phpexcel/PHPExcel.php',
    );
    if (function_exists('sc_url_library')) {
        $arquivos[] = sc_url_library('prj', 'PHPExcel', 'PHPExcel.php');
        $arquivos[] = sc_url_library('prj', 'phpexcel', 'PHPExcel.php');
        $arquivos[] = sc_url_library('sys', 'PHPExcel', 'PHPExcel.php');
        $arquivos[] = sc_url_library('sys', 'phpexcel', 'PHPExcel.php');
        $arquivos[] = sc_url_library('prj', 'PHPExcel', 'Classes/PHPExcel.php');
        $arquivos[] = sc_url_library('prj', 'phpexcel', 'Classes/PHPExcel.php');
        $arquivos[] = sc_url_library('sys', 'PHPExcel', 'Classes/PHPExcel.php');
        $arquivos[] = sc_url_library('sys', 'phpexcel', 'Classes/PHPExcel.php');
    }
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '' && file_exists($arquivo)) {
            include_once $arquivo;
            if (class_exists('PHPExcel_IOFactory')) {
                return true;
            }
        }
    }
    return class_exists('PHPExcel_IOFactory');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_carregar_phpexcel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_coluna_excel ------*/

function cie_coluna_excel($indice)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return PHPExcel_Cell::stringFromColumnIndex($indice);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_coluna_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_coluna_xlsx ------*/

function cie_coluna_xlsx($indiceZero)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $indice = $indiceZero + 1;
    $coluna = '';
    while ($indice > 0) {
        $resto = ($indice - 1) % 26;
        $coluna = chr(65 + $resto) . $coluna;
        $indice = (int) floor(($indice - 1) / 26);
    }
    return $coluna;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_coluna_xlsx ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_parse_data ------*/

function cie_parse_data($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valor = trim((string) $valor);
    if ($valor === '' || $valor === '0000-00-00') {
        return '';
    }
    $data = DateTime::createFromFormat('Y-m-d', substr($valor, 0, 10));
    if ($data instanceof DateTime) {
        return $data;
    }
    $data = DateTime::createFromFormat('d/m/Y', substr($valor, 0, 10));
    if ($data instanceof DateTime) {
        return $data;
    }
    return '';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_parse_data ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_parse_numero ------*/

function cie_parse_numero($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (is_int($valor) || is_float($valor)) {
        return (float) $valor;
    }
    $valor = trim((string) $valor);
    if ($valor === '') {
        return '';
    }
    $valor = str_replace(' ', '', $valor);
    $temVirgula = strpos($valor, ',') !== false;
    $temPonto = strpos($valor, '.') !== false;
    if ($temVirgula && $temPonto) {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
    } elseif ($temVirgula) {
        $valor = str_replace(',', '.', $valor);
    }
    return is_numeric($valor) ? (float) $valor : '';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_parse_numero ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_gravar_valor_excel ------*/

function cie_gravar_valor_excel($sheet, $celula, $valor, $coluna)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipo = isset($coluna['tipo']) ? $coluna['tipo'] : 'texto';
    if ($valor === null || $valor === '') {
        $sheet->setCellValueExplicit($celula, '', PHPExcel_Cell_DataType::TYPE_STRING);
        return;
    }
    if ($tipo === 'data') {
        $data = $this->cie_parse_data($valor);
        if ($data instanceof DateTime) {
            $sheet->setCellValue($celula, PHPExcel_Shared_Date::PHPToExcel($data));
            $sheet->getStyle($celula)->getNumberFormat()->setFormatCode('dd/mm/yyyy');
            return;
        }
    }
    if (in_array($tipo, array('numero', 'numero0', 'numero5'), true)) {
        $numero = $this->cie_parse_numero($valor);
        if ($numero !== '') {
            $formatos = array(
                'numero' => '#,##0.00',
                'numero0' => '#,##0',
                'numero5' => '#,##0.00000',
            );
            $sheet->setCellValue($celula, $numero);
            $sheet->getStyle($celula)->getNumberFormat()->setFormatCode($formatos[$tipo]);
            return;
        }
    }
    $sheet->setCellValueExplicit($celula, (string) $valor, PHPExcel_Cell_DataType::TYPE_STRING);
    $sheet->getStyle($celula)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_gravar_valor_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_validar_template ------*/

function cie_validar_template($sheet, $colunas, $linhaTitulos)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $divergencias = array();
    foreach ($colunas as $indice => $coluna) {
        $celula = $this->cie_coluna_excel($indice) . $linhaTitulos;
        $atual = trim((string) $sheet->getCell($celula)->getValue());
        $esperado = isset($coluna['titulo']) ? (string) $coluna['titulo'] : '';
        if ($atual !== $esperado) {
            $divergencias[] = array(
                'coluna' => $celula,
                'esperado' => $esperado,
                'atual' => $atual,
            );
        }
    }
    return $divergencias;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_validar_template ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_formula_na_celula ------*/

function cie_formula_na_celula($sheet, $celula)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $valor = $sheet->getCell($celula)->getValue();
    return is_string($valor) && strlen($valor) > 0 && $valor[0] === '=';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_formula_na_celula ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_verificar_formulas_area_dados ------*/

function cie_verificar_formulas_area_dados($sheet, $colunas, $primeiraLinha, $ultimaLinha)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $formulas = array();
    if ($ultimaLinha < $primeiraLinha) {
        return $formulas;
    }
    for ($linha = $primeiraLinha; $linha <= $ultimaLinha; $linha++) {
        foreach ($colunas as $indice => $coluna) {
            $celula = $this->cie_coluna_excel($indice) . $linha;
            if ($this->cie_formula_na_celula($sheet, $celula)) {
                $formulas[] = $celula;
            }
        }
    }
    return $formulas;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_verificar_formulas_area_dados ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_ajustar_formula_condicional_linha ------*/

function cie_ajustar_formula_condicional_linha($formula, $linhaModelo, $linhaDestino)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $retorno = $formula;
    if (is_string($formula) && $formula !== '' && $linhaModelo !== $linhaDestino) {
        $retorno = preg_replace('/(\$?[A-Z]{1,3})' . preg_quote((string) $linhaModelo, '/') . '/', '$1' . $linhaDestino, $formula);
    }

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
    return $retorno;
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_ajustar_formula_condicional_linha ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_copiar_condicionais_linha_modelo ------*/

function cie_copiar_condicionais_linha_modelo($sheet, $colunas, $linhaModelo, $linhaDestino)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    // As regras condicionais ficam no template aplicadas aos intervalos completos.
    // Copiar por linha duplica regras e pode prender formulas na linha modelo.

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_copiar_condicionais_linha_modelo ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_cor_fundo_coluna_controle_importacao ------*/

function cie_cor_fundo_coluna_controle_importacao($colunaExcel)
{
    $colunaExcel = strtoupper((string) $colunaExcel);
    $azul = array('C', 'D', 'F', 'G', 'BD', 'BE', 'BF', 'BG');
    $amarelo = array('R', 'V', 'AD', 'AF', 'AU', 'BR');
    $verde = array('T', 'Z', 'AA', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AZ', 'BA');
    $cinza = array('X', 'Y', 'AC', 'AW', 'AX', 'BB', 'BC');
    $cinzaClaro = array('AI', 'AJ', 'AK', 'AL', 'AT', 'AY', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ');
    if (in_array($colunaExcel, $azul, true)) { return 'FFD9E2F3'; }
    if (in_array($colunaExcel, $amarelo, true)) { return 'FFFFFF00'; }
    if (in_array($colunaExcel, $verde, true)) { return 'FFCCFFCC'; }
    if (in_array($colunaExcel, $cinza, true)) { return 'FFD9D9D9'; }
    if (in_array($colunaExcel, $cinzaClaro, true)) { return 'FFEDEDED'; }
    return '';
}
/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_cor_fundo_coluna_controle_importacao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_aplicar_cores_linha_controle_importacao ------*/

function cie_aplicar_cores_linha_controle_importacao($sheet, $colunas, $linhaExcel, $tipoRelatorio)
{
    if ($this->cie_tipo_relatorio($tipoRelatorio) !== 'completo') { return; }
    foreach ($colunas as $indiceColuna => $coluna) {
        $colunaExcel = $this->cie_coluna_excel($indiceColuna);
        $cor = $this->cie_cor_fundo_coluna_controle_importacao($colunaExcel);
        if ($cor === '') { continue; }
        $fill = $sheet->getStyle($colunaExcel . $linhaExcel)->getFill();
        $fill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $fill->getStartColor()->setARGB($cor);
        $fill->getEndColor()->setARGB($cor);
    }
}
/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_aplicar_cores_linha_controle_importacao ------*/

/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_exportar_excel_template ------*/

function cie_exportar_excel_template($dadosPreparados, $tipoRelatorio, $arquivoSaida, $opcoes = array())
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (!$this->cie_carregar_biblioteca_relatorio()) {
        throw new Exception('Biblioteca controle_importacao_relatorio.php nao carregada.');
    }
    if (!$this->cie_carregar_phpexcel()) {
        throw new Exception('Biblioteca PHPExcel nao encontrada.');
    }
    $tipoRelatorio = $this->cie_tipo_relatorio($tipoRelatorio);
    $template = isset($opcoes['template']) ? $opcoes['template'] : $this->cie_template_excel($tipoRelatorio);
    if (!is_file($template)) {
        throw new Exception('Template nao encontrado: ' . $template);
    }
    if ($arquivoSaida === '') {
        throw new Exception('Arquivo de saida nao informado.');
    }
    $colunas = $this->cir_colunas_relatorio($tipoRelatorio);
    $linhaTitulos = isset($opcoes['linha_titulos']) ? (int) $opcoes['linha_titulos'] : $this->cie_linha_titulos_excel();
    $linhaModelo = isset($opcoes['linha_modelo']) ? (int) $opcoes['linha_modelo'] : $this->cie_linha_modelo_excel();
    $primeiraLinhaDados = isset($opcoes['primeira_linha_dados']) ? (int) $opcoes['primeira_linha_dados'] : $this->cie_primeira_linha_dados_excel();
    $permitirSobrescreverFormulas = !empty($opcoes['permitir_sobrescrever_formulas']);
    $objPHPExcel = PHPExcel_IOFactory::load($template);
    $objPHPExcel->setActiveSheetIndex($this->cie_indice_aba_excel());
    $sheet = $objPHPExcel->getActiveSheet();
    $divergencias = $this->cie_validar_template($sheet, $colunas, $linhaTitulos);
    if (count($divergencias) > 0) {
        throw new Exception('Cabecalhos incompatíveis com a biblioteca: ' . json_encode($divergencias));
    }
    $dadosPreparados = is_array($dadosPreparados) ? $dadosPreparados : array();
    $ultimaLinhaPreencher = $primeiraLinhaDados + count($dadosPreparados) - 1;
    $ultimaLinhaLimpar = max($sheet->getHighestRow(), $ultimaLinhaPreencher);
    $formulas = $this->cie_verificar_formulas_area_dados($sheet, $colunas, $primeiraLinhaDados, $ultimaLinhaLimpar);
    if (!$permitirSobrescreverFormulas && count($formulas) > 0) {
        throw new Exception('Formula encontrada na area de dados do template. Revisar antes de exportar: ' . implode(', ', $formulas));
    }
    $ultimaColuna = $this->cie_coluna_excel(count($colunas) - 1);
    for ($linhaExcel = $primeiraLinhaDados; $linhaExcel <= $ultimaLinhaLimpar; $linhaExcel++) {
        $sheet->duplicateStyle(
            $sheet->getStyle('A' . $linhaModelo . ':' . $ultimaColuna . $linhaModelo),
            'A' . $linhaExcel . ':' . $ultimaColuna . $linhaExcel
        );
        $sheet->getRowDimension($linhaExcel)->setRowHeight(
            $sheet->getRowDimension($linhaModelo)->getRowHeight()
        );
        $this->cie_copiar_condicionais_linha_modelo($sheet, $colunas, $linhaModelo, $linhaExcel);
        foreach ($colunas as $indice => $coluna) {
            $celula = $this->cie_coluna_excel($indice) . $linhaExcel;
            if (!$this->cie_formula_na_celula($sheet, $celula) || $permitirSobrescreverFormulas) {
                $sheet->setCellValueExplicit($celula, '', PHPExcel_Cell_DataType::TYPE_STRING);
            }
        }
    }
    foreach ($dadosPreparados as $indiceLinha => $linha) {
        $linhaExcel = $primeiraLinhaDados + $indiceLinha;
        foreach ($colunas as $indiceColuna => $coluna) {
            $key = isset($coluna['key']) ? $coluna['key'] : '';
            $valor = (is_array($linha) && $key !== '' && array_key_exists($key, $linha)) ? $linha[$key] : '';
            $this->cie_gravar_valor_excel($sheet, $this->cie_coluna_excel($indiceColuna) . $linhaExcel, $valor, $coluna);
        }
            $this->cie_aplicar_cores_linha_controle_importacao($sheet, $colunas, $linhaExcel, $tipoRelatorio);
    }
    if (count($colunas) > 0) {
        $linhaFinalFiltro = max($linhaTitulos, $ultimaLinhaPreencher);
        $sheet->setAutoFilter('A' . $linhaTitulos . ':' . $ultimaColuna . $linhaFinalFiltro);
    }
    $diretorio = dirname($arquivoSaida);
    if ($diretorio !== '' && !is_dir($diretorio)) {
        if (!mkdir($diretorio, 0777, true)) {
            throw new Exception('Nao foi possivel criar diretorio de saida: ' . $diretorio);
        }
    }
    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    try {
        $writer->save($arquivoSaida);
    } catch (Exception $e) {
        throw new Exception('Falha ao salvar arquivo Excel: ' . $e->getMessage());
    }
    if (!is_file($arquivoSaida)) {
        throw new Exception('Falha ao salvar arquivo Excel: arquivo nao foi criado.');
    }
    return $arquivoSaida;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_exportar_excel_template ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_xml_escape ------*/

function cie_xml_escape($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_XML1, 'UTF-8');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_xml_escape ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_data_serial_xlsx ------*/

function cie_data_serial_xlsx($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $data = $this->cie_parse_data($valor);
    if (!($data instanceof DateTime)) {
        return '';
    }
    $base = new DateTime('1899-12-30');
    return (string) $base->diff($data)->days;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_data_serial_xlsx ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_celula_xlsx ------*/

function cie_celula_xlsx($celula, $valor, $coluna, $styleId = 2)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if ($valor === null || $valor === '') {
        return '<c r="' . $celula . '" s="' . $styleId . '"/>';
    }
    $tipo = isset($coluna['tipo']) ? $coluna['tipo'] : 'texto';
    if ($tipo === 'data') {
        $serial = $this->cie_data_serial_xlsx($valor);
        if ($serial !== '') {
            return '<c r="' . $celula . '" s="3"><v>' . $serial . '</v></c>';
        }
    }
    if (in_array($tipo, array('numero', 'numero0', 'numero5'), true)) {
        $numero = $this->cie_parse_numero($valor);
        if ($numero !== '') {
            $styleNumero = $tipo === 'numero5' ? 5 : ($tipo === 'numero0' ? 4 : 6);
            return '<c r="' . $celula . '" s="' . $styleNumero . '"><v>' . str_replace(',', '.', (string) $numero) . '</v></c>';
        }
    }
    return '<c r="' . $celula . '" s="' . $styleId . '" t="inlineStr"><is><t>' . $this->cie_xml_escape($valor) . '</t></is></c>';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_celula_xlsx ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_criar_template_xlsx ------*/

function cie_criar_template_xlsx($tipoRelatorio, $arquivoSaida, $dadosPreparados = array())
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
if (!isset($_SESSION['Content_Types'])) {$_SESSION['Content_Types'] = "";}
if (!isset($this->sc_temp_Content_Types)) {$this->sc_temp_Content_Types = (isset($_SESSION['Content_Types'])) ? $_SESSION['Content_Types'] : "";}
  
    if (!$this->cie_carregar_biblioteca_relatorio()) {
        throw new Exception('Biblioteca controle_importacao_relatorio.php nao carregada.');
    }
    if (!class_exists('ZipArchive')) {
        throw new Exception('Extensao ZipArchive nao encontrada.');
    }
    $tipoRelatorio = $this->cie_tipo_relatorio($tipoRelatorio);
    $colunas = $this->cir_colunas_relatorio($tipoRelatorio);
    $ultimaColuna = $this->cie_coluna_xlsx(count($colunas) - 1);
    $titulo = $tipoRelatorio === 'sintetico' ? 'Controle Sintetico' : 'Controle Completo';
    $dadosPreparados = is_array($dadosPreparados) ? $dadosPreparados : array();
    $qtLinhasDados = count($dadosPreparados) > 0 ? count($dadosPreparados) : 1;
    $ultimaLinha = 1 + $qtLinhasDados;
    $sheet = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' .
        '<dimension ref="A1:' . $ultimaColuna . $ultimaLinha . '"/>' .
        '<sheetViews><sheetView workbookViewId="0"><pane ySplit="1" topLeftCell="A2" activePane="bottomLeft" state="frozen"/></sheetView></sheetViews>' .
        '<sheetFormatPr defaultRowHeight="15"/><cols>';
    foreach ($colunas as $indice => $coluna) {
        $largura = 18;
        $tituloColuna = isset($coluna['titulo']) ? $coluna['titulo'] : '';
        if (strlen($tituloColuna) > 35) {
            $largura = 34;
        } elseif (strlen($tituloColuna) > 20) {
            $largura = 24;
        }
        $colNum = $indice + 1;
        $sheet .= '<col min="' . $colNum . '" max="' . $colNum . '" width="' . $largura . '" customWidth="1"/>';
    }
    $sheet .= '</cols><sheetData><row r="1" ht="36" customHeight="1">';
    foreach ($colunas as $indice => $coluna) {
        $cell = $this->cie_coluna_xlsx($indice) . '1';
        $sheet .= '<c r="' . $cell . '" s="1" t="inlineStr"><is><t>' . $this->cie_xml_escape($coluna['titulo']) . '</t></is></c>';
    }
    $sheet .= '</row>';
    if (count($dadosPreparados) === 0) {
        $sheet .= '<row r="2" ht="30" customHeight="1">';
        foreach ($colunas as $indice => $coluna) {
            $cell = $this->cie_coluna_xlsx($indice) . '2';
            $sheet .= '<c r="' . $cell . '" s="2"/>';
        }
        $sheet .= '</row>';
    } else {
        foreach ($dadosPreparados as $indiceLinha => $linha) {
            $linhaExcel = $indiceLinha + 2;
            $sheet .= '<row r="' . $linhaExcel . '" ht="30" customHeight="1">';
            foreach ($colunas as $indice => $coluna) {
                $cell = $this->cie_coluna_xlsx($indice) . $linhaExcel;
                $key = isset($coluna['key']) ? $coluna['key'] : '';
                $valor = (is_array($linha) && $key !== '' && array_key_exists($key, $linha)) ? $linha[$key] : '';
                $sheet .= $this->cie_celula_xlsx($cell, $valor, $coluna);
            }
            $sheet .= '</row>';
        }
    }
    $sheet .= '</sheetData><autoFilter ref="A1:' . $ultimaColuna . $ultimaLinha . '"/><pageMargins left="0.7" right="0.7" top="0.75" bottom="0.75" header="0.3" footer="0.3"/></worksheet>';
    $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">' .
        '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>' .
        '<Default Extension="xml" ContentType="application/xml"/>' .
        '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>' .
        '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>' .
        '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>' .
        '<Override PartName="/xl/theme/theme1.xml" ContentType="application/vnd.openxmlformats-officedocument.theme+xml"/>' .
        '<Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/>' .
        '<Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/>' .
        '</Types>';
    $rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' .
        '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>' .
        '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>' .
        '<Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/>' .
        '</Relationships>';
    $workbook = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' .
        '<sheets><sheet name="' . $this->cie_xml_escape($titulo) . '" sheetId="1" r:id="rId1"/></sheets></workbook>';
    $workbookRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' .
        '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>' .
        '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>' .
        '<Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/theme" Target="theme/theme1.xml"/>' .
        '</Relationships>';
    $styles = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' .
        '<numFmts count="3"><numFmt numFmtId="164" formatCode="dd/mm/yyyy"/><numFmt numFmtId="165" formatCode="#,##0.00"/><numFmt numFmtId="166" formatCode="#,##0.00000"/></numFmts>' .
        '<fonts count="2"><font><sz val="11"/><name val="Calibri"/></font><font><b/><sz val="10"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font></fonts>' .
        '<fills count="3"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill><fill><patternFill patternType="solid"><fgColor rgb="FF1F4E78"/><bgColor indexed="64"/></patternFill></fill></fills>' .
        '<borders count="2"><border><left/><right/><top/><bottom/><diagonal/></border><border><left style="thin"><color rgb="FFB7C9D6"/></left><right style="thin"><color rgb="FFB7C9D6"/></right><top style="thin"><color rgb="FFB7C9D6"/></top><bottom style="thin"><color rgb="FFB7C9D6"/></bottom><diagonal/></border></borders>' .
        '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>' .
        '<cellXfs count="7"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="center" wrapText="1"/></xf><xf numFmtId="164" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center" wrapText="1"/></xf><xf numFmtId="1" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center" wrapText="1"/></xf><xf numFmtId="166" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center" wrapText="1"/></xf><xf numFmtId="165" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment vertical="center" wrapText="1"/></xf></cellXfs>' .
        '<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles><dxfs count="0"/><tableStyles count="0" defaultTableStyle="TableStyleMedium2" defaultPivotStyle="PivotStyleLight16"/></styleSheet>';
    $theme = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<a:theme xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" name="Office Theme"><a:themeElements><a:clrScheme name="Office"><a:dk1><a:sysClr val="windowText" lastClr="000000"/></a:dk1><a:lt1><a:sysClr val="window" lastClr="FFFFFF"/></a:lt1><a:dk2><a:srgbClr val="1F4E78"/></a:dk2><a:lt2><a:srgbClr val="EAF2F8"/></a:lt2><a:accent1><a:srgbClr val="1F4E78"/></a:accent1><a:accent2><a:srgbClr val="70AD47"/></a:accent2><a:accent3><a:srgbClr val="FFC000"/></a:accent3><a:accent4><a:srgbClr val="5B9BD5"/></a:accent4><a:accent5><a:srgbClr val="A5A5A5"/></a:accent5><a:accent6><a:srgbClr val="ED7D31"/></a:accent6><a:hlink><a:srgbClr val="0563C1"/></a:hlink><a:folHlink><a:srgbClr val="954F72"/></a:folHlink></a:clrScheme><a:fontScheme name="Office"><a:majorFont><a:latin typeface="Calibri"/></a:majorFont><a:minorFont><a:latin typeface="Calibri"/></a:minorFont></a:fontScheme><a:fmtScheme name="Office"><a:fillStyleLst><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:fillStyleLst><a:lnStyleLst><a:ln w="6350" cap="flat" cmpd="sng" algn="ctr"><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:ln></a:lnStyleLst><a:effectStyleLst><a:effectStyle><a:effectLst/></a:effectStyle></a:effectStyleLst><a:bgFillStyleLst><a:solidFill><a:schemeClr val="phClr"/></a:solidFill></a:bgFillStyleLst></a:fmtScheme></a:themeElements></a:theme>';
    $core = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:title>' . $this->cie_xml_escape($titulo) . '</dc:title><dc:creator>Controle Importacao</dc:creator><cp:lastModifiedBy>Controle Importacao</cp:lastModifiedBy></cp:coreProperties>';
    $app = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
        '<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>Microsoft Excel</Application></Properties>';
    $diretorio = dirname($arquivoSaida);
    if ($diretorio !== '' && !is_dir($diretorio)) {
        if (!mkdir($diretorio, 0777, true)) {
            throw new Exception('Nao foi possivel criar diretorio: ' . $diretorio);
        }
    }
    $zip = new ZipArchive();
    if ($zip->open($arquivoSaida, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        throw new Exception('Nao foi possivel criar template: ' . $arquivoSaida);
    }
    $zip->addFromString('$this->sc_temp_Content_Types.xml', $contentTypes);
    $zip->addFromString('_rels/.rels', $rels);
    $zip->addFromString('xl/workbook.xml', $workbook);
    $zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
    $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
    $zip->addFromString('xl/styles.xml', $styles);
    $zip->addFromString('xl/theme/theme1.xml', $theme);
    $zip->addFromString('docProps/core.xml', $core);
    $zip->addFromString('docProps/app.xml', $app);
    $zip->close();
    if (!is_file($arquivoSaida)) {
        throw new Exception('Template nao foi criado: ' . $arquivoSaida);
    }
    return $arquivoSaida;

if (isset($this->sc_temp_Content_Types)) {$_SESSION['Content_Types'] = $this->sc_temp_Content_Types;}
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_criar_template_xlsx ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_html_escape ------*/

function cie_html_escape($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_html_escape ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_chamar_biblioteca ------*/

function cie_chamar_biblioteca($contexto, $funcao, $argumentos = array())
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (is_object($contexto) && method_exists($contexto, $funcao)) {
        return call_user_func_array(array($contexto, $funcao), $argumentos);
    }
    if (function_exists($funcao)) {
        return call_user_func_array($funcao, $argumentos);
    }
    throw new Exception('Funcao da biblioteca nao encontrada: ' . $funcao);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_chamar_biblioteca ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_chamar_getdados ------*/

function cie_chamar_getdados($contexto, $argumentos)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (is_object($contexto) && method_exists($contexto, 'getDados')) {
        return call_user_func_array(array($contexto, 'getDados'), $argumentos);
    }
    if (function_exists('getDados')) {
        return call_user_func_array('getDados', $argumentos);
    }
    return array();

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_chamar_getdados ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_sql_valor ------*/

function cie_sql_valor($valor)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (function_exists('$this->Db->qstr')) {
        return $this->Db->qstr($valor);
    }
    return "'" . str_replace("'", "''", (string) $valor) . "'";

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_sql_valor ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_autocomplete_processos ------*/

function cie_autocomplete_processos($contexto = null, $termo = '', $limite = 30)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $termo = strtoupper(trim((string) $termo));
    $limite = (int) $limite;
    if ($limite <= 0) {
        $limite = 30;
    }
    if (strlen($termo) < 2) {
        return array();
    }
    $valorSql = $this->cie_sql_valor($termo . '%');
    $condicao = 'cod_proc_fornec like ' . $valorSql;
    $dados = $this->cie_chamar_getdados(
        $contexto,
        array('multi', 'pub.procs_compra', 'cod_proc_fornec', $condicao, 'espec')
    );
    if (!is_array($dados)) {
        return array();
    }
    $processos = array();
    foreach ($dados as $linha) {
        $processo = '';
        if (is_array($linha)) {
            if (isset($linha['cod_proc_fornec'])) {
                $processo = trim((string) $linha['cod_proc_fornec']);
            } elseif (isset($linha['COD_PROC_FORNEC'])) {
                $processo = trim((string) $linha['COD_PROC_FORNEC']);
            } elseif (isset($linha[0])) {
                $processo = trim((string) $linha[0]);
            }
        }
        if ($processo !== '') {
            $processos[$processo] = $processo;
        }
        if (count($processos) >= $limite) {
            break;
        }
    }
    return array_values($processos);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_autocomplete_processos ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_responder_json ------*/

function cie_responder_json($dados)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados);
    exit;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_responder_json ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_nome_arquivo_download ------*/

function cie_nome_arquivo_download($tipoRelatorio)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    return 'controle_importacao_' . $this->cie_tipo_relatorio($tipoRelatorio) . '_' . date('Ymd_His') . '.xlsx';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_nome_arquivo_download ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_arquivo_temporario ------*/

function cie_arquivo_temporario($tipoRelatorio)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $diretorio = sys_get_temp_dir();
    if ($diretorio === '' || !is_dir($diretorio)) {
        $diretorio = '/tmp';
    }
    return rtrim($diretorio, '/\\') . DIRECTORY_SEPARATOR . $this->cie_nome_arquivo_download($tipoRelatorio);

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_arquivo_temporario ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_renderizar_filtro_controle_importacao ------*/

function cie_renderizar_filtro_controle_importacao($valores = array(), $mensagemErro = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipo = isset($valores['tipo_relatorio']) ? $this->cie_tipo_relatorio($valores['tipo_relatorio']) : 'completo';
    $processo = isset($valores['processo']) ? trim((string) $valores['processo']) : '';
    $container = isset($valores['container']) ? trim((string) $valores['container']) : '';
    echo '<!doctype html>';
    echo '<html lang="pt-br">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>Controle de Importacao</title>';
    echo '<style>';
    echo 'body{margin:0;background:#f4f6f8;color:#1f2933;font-family:Arial,Helvetica,sans-serif;}';
    echo '.wrap{max-width:760px;margin:42px auto;padding:0 18px;}';
    echo '.box{background:#fff;border:1px solid #d9e2ec;border-radius:6px;padding:24px;box-shadow:0 8px 24px rgba(15,23,42,.08);}';
    echo 'h1{font-size:22px;margin:0 0 20px;}';
    echo '.grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}';
    echo 'label{display:block;font-size:13px;font-weight:bold;margin-bottom:6px;color:#334e68;}';
    echo 'input,select{box-sizing:border-box;width:100%;height:38px;border:1px solid #bcccdc;border-radius:4px;padding:8px 10px;font-size:14px;background:#fff;}';
    echo '.full{grid-column:1 / -1;}';
    echo '.actions{display:flex;gap:10px;justify-content:flex-end;margin-top:22px;}';
    echo 'button{height:38px;border:0;border-radius:4px;background:#1f4e78;color:#fff;font-weight:bold;padding:0 18px;cursor:pointer;}';
    echo 'button:hover{background:#173b5c;}';
    echo '.erro{border:1px solid #f5c2c7;background:#f8d7da;color:#842029;border-radius:4px;padding:12px;margin-bottom:16px;white-space:pre-wrap;}';
    echo '@media(max-width:640px){.grid{grid-template-columns:1fr}.actions{justify-content:stretch}button{width:100%;}}';
    echo '</style>';
    echo '</head>';
    echo '<body><div class="wrap"><div class="box">';
    echo '<h1>Controle de Importacao</h1>';
    if ($mensagemErro !== '') {
        echo '<div class="erro">' . $this->cie_html_escape($mensagemErro) . '</div>';
    }
    echo '<form method="post">';
    echo '<input type="hidden" name="exportar" value="1">';
    echo '<div class="grid">';
    echo '<div class="full">';
    echo '<label for="tipo_relatorio">Relatorio</label>';
    echo '<select id="tipo_relatorio" name="tipo_relatorio">';
    echo '<option value="completo"' . ($tipo === 'completo' ? ' selected' : '') . '>Completo</option>';
    echo '<option value="sintetico"' . ($tipo === 'sintetico' ? ' selected' : '') . '>Sintetico</option>';
    echo '</select>';
    echo '</div>';
    echo '<div>';
    echo '<label for="processo">Processo</label>';
    echo '<input id="processo" name="processo" list="processos_controle_importacao" value="' . $this->cie_html_escape($processo) . '" autocomplete="off">';
    echo '<datalist id="processos_controle_importacao"></datalist>';
    echo '</div>';
    echo '<div>';
    echo '<label for="container">Container</label>';
    echo '<input id="container" name="container" value="' . $this->cie_html_escape($container) . '" autocomplete="off">';
    echo '</div>';
    echo '</div>';
    echo '<div class="actions"><button type="submit">Gerar Excel</button></div>';
    echo '</form>';
    echo '<script>';
    echo '(function(){';
    echo 'var campo=document.getElementById("processo");';
    echo 'var lista=document.getElementById("processos_controle_importacao");';
    echo 'var timer=null;';
    echo 'if(!campo||!lista||!window.fetch){return;}';
    echo 'campo.addEventListener("input",function(){';
    echo 'var termo=campo.value.trim();';
    echo 'clearTimeout(timer);';
    echo 'if(termo.length<2){lista.innerHTML="";return;}';
    echo 'timer=setTimeout(function(){';
    echo 'var url=new URL(window.location.href);';
    echo 'url.searchParams.set("cie_acao","autocomplete_processo");';
    echo 'url.searchParams.set("q",termo);';
    echo 'fetch(url.toString(),{credentials:"same-origin"})';
    echo '.then(function(resp){return resp.json();})';
    echo '.then(function(dados){';
    echo 'lista.innerHTML="";';
    echo 'if(!Array.isArray(dados)){return;}';
    echo 'dados.forEach(function(processo){';
    echo 'var opt=document.createElement("option");';
    echo 'opt.value=processo;';
    echo 'lista.appendChild(opt);';
    echo '});';
    echo '})';
    echo '.catch(function(){lista.innerHTML="";});';
    echo '},250);';
    echo '});';
    echo '})();';
    echo '</script>';
    echo '</div></div></body></html>';

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_renderizar_filtro_controle_importacao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_baixar_arquivo_excel ------*/

function cie_baixar_arquivo_excel($arquivo, $nomeDownload)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (!is_file($arquivo)) {
        throw new Exception('Arquivo Excel nao encontrado para download: ' . $arquivo);
    }
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $nomeDownload . '"');
    header('Content-Length: ' . filesize($arquivo));
    header('Cache-Control: max-age=0');
    header('Pragma: public');
    readfile($arquivo);
    @unlink($arquivo);
    exit;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_baixar_arquivo_excel ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_gerar_controle_importacao ------*/

function cie_gerar_controle_importacao($contexto = null, $tipoRelatorio = 'completo', $processo = '', $container = '', $arquivoSaida = '')
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    $tipoRelatorio = $this->cie_tipo_relatorio($tipoRelatorio);
    $processo = trim((string) $processo);
    $container = trim((string) $container);
    if ($arquivoSaida === '') {
        $arquivoSaida = $this->cie_arquivo_temporario($tipoRelatorio);
    }
    $dadosBrutos = $this->cie_chamar_biblioteca($contexto, 'cir_buscar_dados_relatorio', array($processo, $container));
    $dados = $this->cie_chamar_biblioteca($contexto, 'cir_montar_dados_relatorio', array($dadosBrutos, $tipoRelatorio));
    if (!is_array($dados) || count($dados) === 0) {
        throw new Exception('Nenhum registro encontrado para os filtros informados.');
    }
    $this->cie_chamar_biblioteca($contexto, 'cie_exportar_excel_template', array($dados, $tipoRelatorio, $arquivoSaida));
    return $arquivoSaida;

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_gerar_controle_importacao ------*/


/*----- Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_executar_blank_controle_importacao ------*/

function cie_executar_blank_controle_importacao($contexto = null)
{
$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'on';
  
    if (isset($_GET['cie_acao']) && $_GET['cie_acao'] === 'autocomplete_processo') {
        $termo = isset($_GET['q']) ? $_GET['q'] : '';
        $this->cie_responder_json($this->cie_autocomplete_processos($contexto, $termo));
    }
    $valores = array(
        'tipo_relatorio' => isset($_POST['tipo_relatorio']) ? $_POST['tipo_relatorio'] : 'completo',
        'processo' => isset($_POST['processo']) ? $_POST['processo'] : '',
        'container' => isset($_POST['container']) ? $_POST['container'] : '',
    );
    if (!isset($_POST['exportar']) || $_POST['exportar'] !== '1') {
        $this->cie_renderizar_filtro_controle_importacao($valores);
        exit;
    }
    try {
        $tipo = $this->cie_tipo_relatorio($valores['tipo_relatorio']);
        $arquivo = $this->cie_gerar_controle_importacao(
            $contexto,
            $tipo,
            $valores['processo'],
            $valores['container']
        );
        $this->cie_baixar_arquivo_excel($arquivo, $this->cie_nome_arquivo_download($tipo));
    } catch (Exception $e) {
        $this->cie_renderizar_filtro_controle_importacao($valores, 'Erro ao gerar controle de importacao:' . "\n" . $e->getMessage());
        exit;
    }

$_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: controle_importacao_excel.php => function cie_executar_blank_controle_importacao ------*/

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
   $_SESSION['scriptcase']['bl_cons_planilha']['contr_erro'] = 'off';
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
            nm_limpa_str_bl_cons_planilha($nmgp_val);
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
            nm_limpa_str_bl_cons_planilha($nmgp_val);
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
       elseif (is_file($root . $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['bl_cons_planilha']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "bl_cons_planilha") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_Importacao'])) {
               $_SESSION['scriptcase']['bl_cons_planilha']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Importacao'];
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
   if (isset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu']);
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "bl_cons_planilha";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'bl_cons_planilha' || $achou)
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
        $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['iframe_menu'] = $salva_iframe;
   }

   if (!isset($_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '.php'))
   {
       $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize'] = true;
   }
   else
   {
       $sReferer = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '.php'));
       $sReferer = substr($sReferer, strrpos($sReferer, '/') + 1);
       if ('bl_cons_planilha' == $sReferer || 'bl_cons_planilha_' == substr($sReferer, 0, 17))
       {
           $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize'] = false;
       }
       else
       {
           $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['initialize'] = true;
       }
   }

   $_POST['script_case_init'] = $script_case_init;
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'bl_cons_planilha')
   {
       $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['bl_cons_planilha']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/bl_cons_planilha_erro.php");
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
                nm_limpa_str_bl_cons_planilha($cadapar[1]);
                if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                $Tmp_par   = $cadapar[0];;
                $$Tmp_par = $cadapar[1];
            }
            $ix++;
       }
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0;  
   $contr_bl_cons_planilha = new bl_cons_planilha_apl();
   $contr_bl_cons_planilha->controle();
//
   function nm_limpa_str_bl_cons_planilha(&$str)
   {
   }
?>

