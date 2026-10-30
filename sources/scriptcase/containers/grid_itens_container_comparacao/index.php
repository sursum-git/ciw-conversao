<?php
   include_once('grid_itens_container_comparacao_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil']          = "espec";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_doc']        = "";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_especw']         = "especw";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems5w']         = "ems5w";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_comumw']         = "comumw";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_multi']         = "multi";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems5']         = "ems5";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems2ima']         = "ems2ima";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems2med']         = "ems2med";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_comum']         = "comum";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_cfsc']         = "cfsc";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_log_db']         = "log_db";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ticontrole2']         = "ticontrole2";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ima']         = "ima";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_med']         = "med";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_geral']         = "geral";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_dinamico']         = "dinamico";
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_log_imp_mysql']         = "log_imp_mysql";
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
    if(empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class grid_itens_container_comparacao_ini
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
   var $link_form_itens_proc_compra_edit;
   var $link_vl_dif_perc_apl_or;
   var $link_vl_dif_perc_apl;
   var $link_vl_dif_perc_parms;
   var $link_vl_dif_perc_hint;
   var $link_vl_dif_perc_target;
   var $link_vl_dif_perc_pos;
   var $link_vl_dif_perc_alt;
   var $link_vl_dif_perc_larg;
   var $link_vl_distr_apl_or;
   var $link_vl_distr_apl;
   var $link_vl_distr_parms;
   var $link_vl_distr_hint;
   var $link_vl_distr_target;
   var $link_vl_distr_pos;
   var $link_vl_distr_alt;
   var $link_vl_distr_larg;
   var $link_vl_contr_distr_custo_apl_or;
   var $link_vl_contr_distr_custo_apl;
   var $link_vl_contr_distr_custo_parms;
   var $link_vl_contr_distr_custo_hint;
   var $link_vl_contr_distr_custo_target;
   var $link_vl_contr_distr_custo_pos;
   var $link_vl_contr_distr_custo_alt;
   var $link_vl_contr_distr_custo_larg;
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "grid_itens_container_comparacao"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "Importacao"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20160503"; 
      $this->nm_hr_criacao   = "173140"; 
      $this->nm_autor_alt    = "tadeu"; 
      $this->nm_dt_ult_alt   = "20250429"; 
      $this->nm_hr_ult_alt   = "093512"; 
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
      $this->path_prod       = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_doc'];
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
      if (!isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['grid_itens_container_comparacao']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['grid_itens_container_comparacao']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['sub_cons_schema_filter'];
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
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/grid_itens_container_comparacao';
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
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

      if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['actual_lang']) || $_SESSION['scriptcase']['grid_itens_container_comparacao']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['grid_itens_container_comparacao']['actual_lang'] = $this->str_lang;
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
          include_once("grid_itens_container_comparacao_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['ancor_save'] = $_POST['ancor_save'];
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
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
      $this->sc_lig_target["C_@scinf_item_proc_compra_id"] = '_self';
      $this->sc_lig_target["C_@scinf_item_proc_compra_id_@scinf_form_itens_proc_compra"] = '_self';
      $Tmp_apl_lig = "bl_item_custos";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/bl_item_custos_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/bl_item_custos_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
          if (isset($arr_data['md5']) && trim($arr_data['md5']) == "LigMd5")
          {
              $this->sc_lig_md5["bl_item_custos"] = 'S';
          }
      }
      $this->sc_lig_target["B_@scinf_calc_custo_item"] = '_self';
      $this->sc_lig_target["B_@scinf_calc_custo_item_@scinf_bl_item_custos"] = '_self';
      $Tmp_apl_lig = "ctrl_simul_distr_custo";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/ctrl_simul_distr_custo_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/ctrl_simul_distr_custo_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
      }
      $Tmp_apl_lig = "ctrl_simul_distr_custo";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/ctrl_simul_distr_custo_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/ctrl_simul_distr_custo_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
      }
      $Tmp_apl_lig = "bl_distribuir_custo_contr";
      if (is_file($this->root . $this->path_link . "_lib/_app_data/bl_distribuir_custo_contr_ini.php"))
      {
          require($this->root . $this->path_link . "_lib/_app_data/bl_distribuir_custo_contr_ini.php");
          $Tmp_apl_lig = $arr_data['friendly_url'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_itens_container_comparacao"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_itens_container_comparacao"] as $sTmpTargetLink => $sTmpTargetWidget)
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
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['link_info']['margin_top'] = $link_margin_top;
        }
      $this->link_form_itens_proc_compra_edit =  $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('form_itens_proc_compra') . "/" ; 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']);
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
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir']))
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['path_doc'] = $this->path_doc; 
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
          if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'])) 
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
      if (!isset($_SESSION['scriptcase'][$script_case_init]['grid_itens_container_comparacao']['nm_contr_attrs']))
      {
          $_SESSION['scriptcase'][$script_case_init]['grid_itens_container_comparacao']['nm_contr_attrs'] = "ok";
          $_SESSION['grid_itens_container_comparacao']['atrib_valores'] = ""; 
          $_SESSION['grid_itens_container_comparacao']['perc_container'] = ""; 
          $_SESSION['grid_itens_container_comparacao']['dolar_medio'] = ""; 
          $_SESSION['grid_itens_container_comparacao']['moeda_corrente'] = ""; 
      }
// 
      include_once($this->path_aplicacao . "grid_itens_container_comparacao_erro.class.php"); 
      $this->Erro = new grid_itens_container_comparacao_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('grid_itens_container_comparacao'); 
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

      $this->arr_buttons_usr['mostrar_vl_dolar']['hint']             = "Permite a visualização dos valores em Dólar";
      $this->arr_buttons_usr['mostrar_vl_dolar']['type']             = "button";
      $this->arr_buttons_usr['mostrar_vl_dolar']['value']            = "Mostrar Valores em Dólar";
      $this->arr_buttons_usr['mostrar_vl_dolar']['display']          = "only_text";
      $this->arr_buttons_usr['mostrar_vl_dolar']['display_position'] = "text_right";
      $this->arr_buttons_usr['mostrar_vl_dolar']['style']            = "default";
      $this->arr_buttons_usr['mostrar_vl_dolar']['image']            = "";

      $this->arr_buttons_usr['mostrar_vl_real']['hint']             = "Permite a visualização dos valores em real";
      $this->arr_buttons_usr['mostrar_vl_real']['type']             = "button";
      $this->arr_buttons_usr['mostrar_vl_real']['value']            = "Mostrar Valores Em Real";
      $this->arr_buttons_usr['mostrar_vl_real']['display']          = "only_text";
      $this->arr_buttons_usr['mostrar_vl_real']['display_position'] = "text_right";
      $this->arr_buttons_usr['mostrar_vl_real']['style']            = "default";
      $this->arr_buttons_usr['mostrar_vl_real']['image']            = "";

      $this->arr_buttons_usr['calc_custo_item']['hint']             = "";
      $this->arr_buttons_usr['calc_custo_item']['type']             = "button";
      $this->arr_buttons_usr['calc_custo_item']['value']            = "Calcular Custo item";
      $this->arr_buttons_usr['calc_custo_item']['display']          = "only_text";
      $this->arr_buttons_usr['calc_custo_item']['display_position'] = "text_right";
      $this->arr_buttons_usr['calc_custo_item']['style']            = "default";
      $this->arr_buttons_usr['calc_custo_item']['image']            = "";
      $this->str_google_fonts= isset($str_google_fonts)?$str_google_fonts:'';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'])) {
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
          if ($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir_tp'] == "R") {
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
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']);
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
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1DcBwDQX7D1BeHuJwDMzGVIBOH5FqHMBqDcJUH9BqHIveZMB/DMvCHErsDWFqZuB/D9NmH9FGDSBYHQFaDMvmVcFKV5BmVoBqD9BsZkFGHAvsD5XGHgBeHEFiV5B3DoF7D9XsDuFaHAveHuBOHgrKVcFKDuFqHMraD9BsZ1FGDSrYHuJeDMzGZSXeHEXKZuBqD9NmDQX7DSBYHuF7DMvmVcFKV5BmVoBqD9BsZkFGHArKD5JeDMBYVkJqV5FaDorqD9NwH9X7Z1rwD5NUHuBOVIBODWFYHMBiD9BsVIraD1rwV5X7HgBeHEFKV5FaVoBqD9NwH9X7DSBYD5JsHgrYDkBOHEFYVENUDcJUZ1B/Z1NOD5JeDMNKZSXeH5FYDoB/D9XsH9FGD1veV5FUHuvmVcBOV5F/DoraD9XOZSBOZ1BeD5rqDEBOZSXeV5FqDoBODcJeDQFGHANOV5FUHgvsDkBODWFaVoraHQFYZSFaHArKV5XGDErKHErCDWF/VoBiDcJUZSX7Z1BYHuFaHuzGVcFeHEFGVoFGHQXGZ1rqHArKD5F7HgveDkB/H5F/DoraHQFYDQB/Z1rwHQJwDMvsVcBODuFqHMBiD9BsVIraD1rwV5X7HgBeHErCV5B7ZuJsHQJKH9FUD1BeHQFaDMBYVcXKDuFGDoXGHQNwZSBqHANOHuFGHgrKDkXKDWB3VoFGHQJKH9FUD1veHuraDMrYVcFeV5BmDoXGHQXGZ1FGD1zGZMFaHgNKZSJqDWBmDoF7D9XsDQJsDSBYV5FGHgNKDkBsV5X/VEBiHQBsZ1X7HABYHuFaDMveHENiDWB3VoFGHQJeDQFUDSN7HQJsDMBOVcXKDWrmDoXGHQBsH9BqHIBeHQXGHgrKDkB/DurmVoFGHQXsDQFaD1BOVWJwDMvODkBsDWrmVoBqD9BsZ1F7DSrYD5rqDMrYDkBsHEB3VoJsHQJwZ9JeHAveHuFGHgrKZSrCDWXCDoXGD9BiZ1B/HIrwZMB/DEBeHEJGDWF/VoX7DcBwDuBOHAveHuFGDMNOVcrsH5B7VoFaDcBqZ1FaHAN7V5FaDMrYHEBUH5FYVoJeD9XsZSFGHIrwD5NUDMrwVcFiDWXCVEFGD9BsH9FaD1zGD5raDMBYZSXeDWX7VoBiDcJUDQJwHABYV5BqHgrKV9FiDWXCDoraD9JmZ1FaD1rKV5XGDMzGHEJGDWrGDoNUD9XsZSX7HAvCV5BiHuBYVcFKDur/DoraD9BsZkFUHArKV5BqDEBOZSJGDWrGDoNUD9XsDQJsDSBYV5FGHgrKVcBOV5F/VoFGD9JmZ1B/Z1NOV5BOHgvCDkFeH5FYVoX7D9JKDQX7D1BOV5FGDMzGV9BUHEF/HMBOHQNwZkBiHIveHuJsHgNOHEFKV5FqHIBqDcXGDuBqHAvmV5BODMzGVcFiV5FYHMJeHQXOH9BqD1rKHuFaHgBOHEFKV5FqHMB/HQNwH9FUDSBYHQJsDMvsVcFiH5FqDoJeD9JmZ1B/D1NaD5rqHgrKHArsHEXCDoJsHQFYZSBiZ1BYHQJeDMzGVcFiV5FYHIBiHQNmH9BOHArYHQraHgBeDkBsV5FqHMX7HQNmDQFaD1vOV5BODMvOZSrCV5FYHIJeHQJmZSBOD1rKHQBqHgNOHEFKH5FYVoX7D9JKDQX7D1BOV5FGDMBYVcBUHEBmVoX7HQXOZ1FGHIveHQJeHgvsHAFKV5FqHIBOHQJKZ9XGHIrKHQJwDMvmV9FiV5FYHMBOHQJmZkFGDSBeHQNUHgNOHEFKV5FqHIraHQXOZSFUD1BOVWBODMBOZSJ3H5FqDoJeD9JmZ1B/D1NaD5rqDErKZSXeH5FYDoFUD9NwDQJsHArYVWJsHuvmVcXKV5FGVoraD9BiZSB/HABYD5XGHgvCZSJGDuFaZuBqD9NmZ9rqZ1rwV5FGHuNOVcFKHEFYDoraD9BsZSFaD1rKD5JeHgvCZSXeH5FYVoX7D9JKDQX7HABYD5NUHuBYVcBUDWXKVoraD9BiH9B/HArYD5F7HgNKDkBsV5FaZuBqDcBwDQX7HAvmV5JwHuzGDkBOH5B7VEFGHQBqZ1FUZ1BOD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkBODur/VoraD9XOH9FaD1rKD5BiDMzGHEXeV5FqDoraD9JKDQX7HIBeHuFaHuNOZSrCH5FqDoXGHQJmZ1BiHAvCD5BqHgveDkXKH5FGDoBOHQXODQBqHAvmVWBqDMvmVcFKV5BmVoBqD9BsZkFGHArKHQXGDEBOVkJGDWF/ZuFaHQJKH9BiHIBeHuFGHuzGZSJqDur/VEraDcJUZSBqHArKV5FUDMrYZSXeV5FqHIJsHQNmDQX7HABYD5JsHuBYVcFKDWFYVEX7D9BiZ1F7DSrYV5FGDMrYHErCHEFqVoFGD9NwDQJsZ1rwV5BOHuBYVcFKDWr/DoF7VQBqH9B/Z1BOD5raDMzGHAFKDWF/HIFUD9FYDQJwHAveV5JwHuzGVIFCH5XCVoB/VQJUZ9X7D1rwD5FaDMrYHErCDuFYZuFaDcBwDQJsHArYHuFaHuNOZSrCH5FqDoXGHQJmZ1BiDSvOV5FUHgveHEBOV5JeZura";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['initialize'])  
      { 
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['Gera_log_access'] = true;
          $_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['moeda_grid_itens_container_comparacao'])) {$_SESSION['moeda_grid_itens_container_comparacao'] = "";}
if (!isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$this->sc_temp_moeda_grid_itens_container_comparacao = (isset($_SESSION['moeda_grid_itens_container_comparacao'])) ? $_SESSION['moeda_grid_itens_container_comparacao'] : "";}
  $_SESSION['grid_itens_container_comparacao']['atrib_valores'] = '';
$_SESSION['grid_itens_container_comparacao']['dolar_medio'] = 0;
if($this->sc_temp_moeda_grid_itens_container_comparacao=='' or !isset($this->sc_temp_moeda_grid_itens_container_comparacao)){
	$this->sc_temp_moeda_grid_itens_container_comparacao == 'dolar';
}
if (isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$_SESSION['moeda_grid_itens_container_comparacao'] = $this->sc_temp_moeda_grid_itens_container_comparacao;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off'; 
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['initialize'] = false;
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
          if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'])) 
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
          $this->nm_tabela = "pub.itens_container"; 
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
              if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']) && $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil']) && $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']))
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
      if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_especw'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems5w'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems5w['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems5w['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems5w['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems5w['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems5w['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems5w['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5w['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems5w['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems5w['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_comumw'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_comumw['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_comumw['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_comumw['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_comumw['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_comumw['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_comumw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comumw['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_comumw['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_comumw['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_multi'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems5'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems2ima'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems2ima['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2ima['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2ima['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2ima['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2ima['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2ima['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2ima['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2ima['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ems2med'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ems2med['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ems2med['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ems2med['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ems2med['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ems2med['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ems2med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2med['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ems2med['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ems2med['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_comum'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_cfsc'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_log_db'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ticontrole2'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_ticontrole2['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_ticontrole2['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_ticontrole2['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_ticontrole2['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_ticontrole2['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_ticontrole2['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole2['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_ticontrole2['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_ticontrole2['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_ima'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_med'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_geral'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_dinamico'], $this->path_libs, "S", $this->path_conf);
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
          carrega_perfil($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_con_log_imp_mysql'], $this->path_libs, "S", $this->path_conf);
          $this->nm_con_log_imp_mysql['servidor']               = $_SESSION['scriptcase']['glo_servidor'];
          $this->nm_con_log_imp_mysql['usuario']                = $_SESSION['scriptcase']['glo_usuario'];
          $this->nm_con_log_imp_mysql['banco']                  = $_SESSION['scriptcase']['glo_banco'];
          $this->nm_con_log_imp_mysql['senha']                  = $_SESSION['scriptcase']['glo_senha'];
          $this->nm_con_log_imp_mysql['tpbanco']                = $_SESSION['scriptcase']['glo_tpbanco'];
          $this->nm_con_log_imp_mysql['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_imp_mysql['decimal']                = $_SESSION['scriptcase']['glo_decimal_db'];
          $this->nm_con_log_imp_mysql['protect']                = $_SESSION['scriptcase']['glo_senha_protect'];
          $this->nm_con_log_imp_mysql['glo_database_encoding']  = isset($_SESSION['scriptcase']['glo_database_encoding'])?$_SESSION['scriptcase']['glo_database_encoding']:'';
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
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida_init']) 
      {
          if (!isset($_SESSION['container_corrente'])) 
          {
              $this->nm_falta_var .= "container_corrente; ";
          }
          if (!isset($_SESSION['moeda_grid_itens_container_comparacao'])) 
          {
              $this->nm_falta_var .= "moeda_grid_itens_container_comparacao; ";
          }
          if (!isset($_SESSION['log_dolar_medio_corrente'])) 
          {
              $this->nm_falta_var .= "log_dolar_medio_corrente; ";
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date1'];
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['volta_redirect_apl'] = $_SESSION['scriptcase']['sc_url_saida'][$this->sc_page]; 
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['volta_redirect_tp']  = $nm_apl_dependente; 
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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_conexao'], $this->root . $this->path_prod, 'Importacao', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida'])
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
          $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function conectExtra()
   {
      if (!$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida'])
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
      if (!$_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['embutida'])
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date1'];
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
       if (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date']))
       {
           $delim  = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date'];
           $delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_sep_date1'];
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
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, `action`, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_container_comparacao', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       elseif (in_array(strtolower($this->nm_con_ticontrole2['tpbanco']), $this->nm_bases_sqlite))
       { 
           $comando = "INSERT INTO sc_log (id, inserted_date, username, application, creator, ip_user, action, description) VALUES (NULL, $dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_container_comparacao', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
       } 
       else
       { 
           $comando = "INSERT INTO sc_log (inserted_date, username, application, creator, ip_user, action, description) VALUES ($dt, " . $this->nm_db_ticontrole2->qstr($usr) . ", 'grid_itens_container_comparacao', '$orig', '" . $_SERVER['REMOTE_ADDR'] . "', '$evento', " . $this->nm_db_ticontrole2->qstr($texto) . ")"; 
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
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_itens_container_comparacao']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
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
class grid_itens_container_comparacao_sub_css
{
   function __construct()
   {
      global $script_case_init;
      $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_SoftCloud_sm/Sc9_SoftCloud_sm";
      if ($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['SC_herda_css'] == "N")
      {
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css']['grid_itens_container_comparacao']    = $str_schema_all . "_grid.css";
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css_bw']['grid_itens_container_comparacao'] = $str_schema_all . "_grid_bw.css";
      }
   }
}
//
class grid_itens_container_comparacao_apl
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
             $glo_senha_protect, $nmgp_opcao, $nm_call_php, $rec, $nmgp_quant_linhas, $nmgp_fast_search, $nmgp_cond_fast_search, $nmgp_arg_fast_search, $nmgp_parms_where;

      $Parms_form_pdf = false;
      if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_container_comparacao']))
      { 
          $GLOBALS['nmgp_parms'] = $_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_container_comparacao'];
          $Parms_form_pdf = true;
      } 
      if ($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'] || $Parms_form_pdf)
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
                       nm_limpa_str_grid_itens_container_comparacao($cadapar[1]);
                       nm_protect_num_grid_itens_container_comparacao($cadapar[0], $cadapar[1]);
                       if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                       $Tmp_par   = $cadapar[0];
                       $$Tmp_par = $cadapar[1];
                       if ($Tmp_par == "nmgp_opcao")
                       {
                           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = $cadapar[1];
                       }
                   }
              }
          } 
          if (isset($container_corrente)) 
          {
              $_SESSION['container_corrente'] = $container_corrente;
              nm_limpa_str_grid_itens_container_comparacao($_SESSION["container_corrente"]);
          }
          if (isset($moeda_grid_itens_container_comparacao)) 
          {
              $_SESSION['moeda_grid_itens_container_comparacao'] = $moeda_grid_itens_container_comparacao;
              nm_limpa_str_grid_itens_container_comparacao($_SESSION["moeda_grid_itens_container_comparacao"]);
          }
          if (isset($log_dolar_medio_corrente)) 
          {
              $_SESSION['log_dolar_medio_corrente'] = $log_dolar_medio_corrente;
              nm_limpa_str_grid_itens_container_comparacao($_SESSION["log_dolar_medio_corrente"]);
          }
      } 
      if ($Parms_form_pdf)
      { 
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_pdf'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_full'] = false;
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_pai'] = "";
      } 
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      if (!$this->Ini || isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_ibase'])) 
      { 
          $this->Ini = new grid_itens_container_comparacao_ini(); 
          $this->Ini->init();
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_ibase'] = true;
      }
      $this->Ini->Proc_print      = false;
      $this->Ini->Export_det_zip  = false;
      $this->Ini->Export_html_zip = false;
      $this->Ini->Export_zip      = false;
      $this->Ini->Export_img_zip  = false;
      $this->Ini->Img_export_zip  = array();
      $this->Ini->Embutida_iframe = (strpos($this->Ini->sc_page, "-") !== false) ? true : false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['emb_lig_aba'] = array();
      $this->Change_Menu = false;
      if (!isset($nmgp_opcao)) {
         $nmgp_opcao = "";
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'])) {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "";
      }
       if ($nmgp_opcao == "link_res")  
       { 
           $nmgp_opcao = "inicio";  
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "inicio";  
           $Temp_parms = "";  
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms_where);
           $todox = stripslashes($todox);
           $todo  = explode("?@?", $todox);
           foreach ($todo as $param)
           {
                $cadapar  = explode("?#?", $param);
                if ($cadapar[0] == "qt_descontos")  
                { 
                    $cadapar[0] = str_replace("qt_descontos", "select count(desconto_importacao_id) from
      pub.descontos_importacao where item_container_id = {item_container_id}", $cadapar[0]);
                } 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] == "q_item")
                { 
                    $Temp_parms .= (empty($Temp_parms)) ? "" : " and ";
                    $Tmp_pos = strpos($cadapar[1], "@aspass@");
                    $cadapar[1] = str_replace("@aspass@", "", $cadapar[1]);
                    if ($Tmp_pos !== false)
                    {
                        $cadapar[1] = $this->Ini->Db->qstr($cadapar[1]);
                    }
                    if ($cadapar[1] == "__SCNULL__" || $cadapar[1] == "'__SCNULL__'")
                    {
                        $Temp_parms .= $cadapar[0] . " is null" ;
                    }
                    else
                    {
                        $Temp_parms .= $cadapar[0] . " = " . $cadapar[1];
                    }
                } 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_resumo'] = $Temp_parms;
       } 
      if ($nmgp_opcao != "ajax_navigate" && $nmgp_opcao != "ajax_detalhe" && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['sc_outra_jan'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['sc_modal']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_itens_container_comparacao']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_itens_container_comparacao'];
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'] && $this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_container_comparacao']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_container_comparacao']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('grid_itens_container_comparacao') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_itens_container_comparacao']['label'] = "" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . " - Itens do Container - Moeda - " . $_SESSION['moeda_grid_itens_container_comparacao'] . "";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "grid_itens_container_comparacao")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          $this->Change_Menu = false;
      }
      $this->Db = $this->Ini->Db; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['nm_tpbanco'] = $this->Ini->nm_tpbanco;
      $this->nm_data = new nm_data("pt_br");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      { 
          include_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_erro.class.php"); 
      } 
      else 
      { 
          include_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_erro.class.php"); 
      } 
      $this->Erro      = new grid_itens_container_comparacao_erro();
      $this->Erro->Ini = $this->Ini;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      { 
          require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_lookup.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_lookup.class.php"); 
      } 
      $this->Lookup       = new grid_itens_container_comparacao_lookup();
      $this->Lookup->Db   = $this->Db;
      $this->Lookup->Ini  = $this->Ini;
      $this->Lookup->Erro = $this->Erro;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          $this->Ini->sc_Include($this->Ini->path_libs . "/nm_trata_saida.php", "C", "nm_trata_saida") ; 
          $nm_saida = new nm_trata_saida();
          $ajax_opc_print = false;
          if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_export")
          {
              $this->Ini->sc_export_ajax = true;
              $this->Ini->Arr_result     = array();
              $nmgp_opcao                = $_POST['export_opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = $nmgp_opcao;
              if ($nmgp_opcao == "print" || $nmgp_opcao == "res_print" || $nmgp_opcao == "det_print")
              {
                  $ajax_opc_print   = true;
                  $nm_arquivo_print = "/sc_grid_itens_container_comparacao_" . session_id();
                  $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
                  $this->Ini->sc_export_ajax_img = true;
              }
              ob_start();
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          $_SESSION['scriptcase']['saida_var'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['ajax_nav'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['scroll_navigate'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['scroll_navigate_reload'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['scroll_navigate_app'] = false;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['scroll_navigate_header_row']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['scroll_navigate_header_row'] = 1;
          }
          if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_navigate" || $_POST['nmgp_opcao'] == "ajax_detalhe"))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['ajax_nav'] = true;
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $this->Ini->Arr_result = array();
              $nmgp_opcao = $_POST['opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = $nmgp_opcao;
              if (isset($_POST['parm']) && $_POST['parm'] == "save_grid")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['save_grid'] = true;
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
                  $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['contr_total_geral'] = "NAO";
                  $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['contr_array_resumo'] = "NAO";
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['tot_geral']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['arr_total']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['using_summary_cache']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_group_by']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_x_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_y_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_fill']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_order']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_order_col']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_order_level']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_order_sort']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['pivot_tabular']);
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
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Gb_date_format'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Gb_date_format'] = array();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_All_Groupby'] = array('_NM_SC_' => 'grid', 'q_item' => 'all');
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Groupby_hide'])) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Groupby_hide'] = array();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'])) 
      { 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_All_Groupby'] as $Ind => $Tp)
          {
              if (!in_array($Ind, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Groupby_hide'])) 
              { 
                  break;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] = $Ind;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['Labels_GB'] = array();
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] == "q_item")
      {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['Labels_GB'][] = "" . $this->Ini->Nm_lang['lang_itens_container_fld_item_container_id'] . "";
      }
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] == "_NM_SC_")
      {
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item'][2] = array('label' => "" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . "", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']['q_item'][] = 2;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item'][3] = array('label' => "Custo(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']['q_item'][] = 3;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item'][4] = array('label' => "Rat.Despesas(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']['q_item'][] = 4;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item'][5] = array('label' => "Custo + Desp.(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']['q_item'][] = 5;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']['q_item'][6] = array('label' => "" .  $this->Ini->Nm_lang['lang_itens_container_fld_qt_recbto_fisico'] . "(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")", 'display' => true);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']['q_item'][] = 6;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_control']['q_item']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_control']['q_item'] = array(
               array(
                   'cmp_res' => "NM_Count",
                   'label' => "" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . "",
                   'label_field' => "" .  $this->Ini->Nm_lang['lang_btns_smry_msge_cnt'] . "",
                   'options' => array(
                       array('op' => 'C', 'index' => '2', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_count'] . "", 'abbrev' => "Count"),
                   ),
                   'select' => "<select class=\"sc-ui-select-NM_Count\" onChange=\"scSummChange($(this))\" style=\"display: none\"><option value=\"2\" class=\"sc-ui-select-option-C\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_count'] . "</option></select>",
               ),
               array(
                   'cmp_res' => "tot_custo",
                   'label' => "Custo(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")",
                   'label_field' => "Vl.Neg.",
                   'options' => array(
                       array('op' => 'S', 'index' => '3', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-tot_custo\" onChange=\"scSummChange($(this))\"><option value=\"3\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
               array(
                   'cmp_res' => "vl_rat_desp",
                   'label' => "Rat.Despesas(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")",
                   'label_field' => "Vl.Despesa",
                   'options' => array(
                       array('op' => 'S', 'index' => '4', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-vl_rat_desp\" onChange=\"scSummChange($(this))\"><option value=\"4\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
               array(
                   'cmp_res' => "vl_custo_final",
                   'label' => "Custo + Desp.(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")",
                   'label_field' => "Custo + Desp.",
                   'options' => array(
                       array('op' => 'S', 'index' => '5', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-vl_custo_final\" onChange=\"scSummChange($(this))\"><option value=\"5\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
               array(
                   'cmp_res' => "qt_recbto_fisico",
                   'label' => "" .  $this->Ini->Nm_lang['lang_itens_container_fld_qt_recbto_fisico'] . "(" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . ")",
                   'label_field' => "" .  $this->Ini->Nm_lang['lang_itens_container_fld_qt_recbto_fisico'] . "",
                   'options' => array(
                       array('op' => 'S', 'index' => '6', 'label' => "" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "", 'abbrev' => "Sum"),
                   ),
                   'select' => "<select class=\"sc-ui-select-qt_recbto_fisico\" onChange=\"scSummChange($(this))\"><option value=\"6\" class=\"sc-ui-select-option-S\">" . $this->Ini->Nm_lang['lang_btns_smry_msge_sumt'] . "</option></select>",
               ),
           );
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['all']['SC_Ind_Groupby'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['all']['SC_Ind_Groupby'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Gb_Free_cmp']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Gb_Free_cmp'];
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_display'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_order']   = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_control'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['pivot_x_axys']               = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_display'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_display'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_order'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_control']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['summarizing_fields_control'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['summarizing_fields_control'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pivot_x_axys']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dados_orig_gb']['res']['pivot_x_axys'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pivot_x_axys'];
          }
      }
      $this->Ini->Apl_resumo  = "grid_itens_container_comparacao_resumo_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] . ".class.php"; 
      $this->Ini->Apl_grafico = "grid_itens_container_comparacao_grafico_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['SC_Ind_Groupby'] . ".class.php"; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['Gera_log_access'])
      {
          $this->Ini->NM_gera_log_insert("Scriptcase", "access");
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['Gera_log_access'] = false;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['xls_return']  = ($nmgp_opcao == "xls")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['csv_return']  = ($nmgp_opcao == "csv")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['xml_return']  = ($nmgp_opcao == "xml")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['json_return'] = ($nmgp_opcao == "json") ? "volta_grid" : "resumo"; 
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_return'] = $this->ret_print;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
          if ($this->Ini->Export_html_zip)
          {
              $this->Ini->Export_img_zip = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['html_name']))
              {
                  $nm_arquivo_html = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['html_name'];
              }
              elseif ($nmgp_opcao == 'print' && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
              {
                  $nm_arquivo_html = "/sc_grid_itens_container_comparacao_" . session_id() . ".html";
              }
              else
              {
                  $nm_arquivo_html = "/sc_grid_itens_container_comparacao_res_" . session_id() . ".html";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html);
          }
      }
      if ($nmgp_opcao == "doc_word") {  
          $this->ret_word = "volta_grid";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res") {  
          $this->ret_word = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "doc_word"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "doc_word"; 
      }
      elseif ($nmgp_opcao == "doc_word" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "doc_word_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "doc_word_res"; 
      }
      if ($nmgp_opcao == "xls_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xls"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "xls"; 
      }
      elseif ($nmgp_opcao == "xls" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xls_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "xls_res"; 
      }
      if ($nmgp_opcao == "csv_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "csv"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "csv"; 
      }
      elseif ($nmgp_opcao == "csv" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "csv_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "csv_res"; 
      }
      if ($nmgp_opcao == "xml_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xml"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "xml"; 
      }
      elseif ($nmgp_opcao == "xml" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xml_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "xml_res"; 
      }
      if ($nmgp_opcao == "json_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "json"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "json"; 
      }
      elseif ($nmgp_opcao == "json" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "json_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "json_res"; 
      }
      $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_charts'] = (strpos(" " . $this->Ini->SC_module_export, "chart") !== false) ? false : true;
      $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_summary'] = false;
      if ('chart' == $this->Ini->SC_module_export) {
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_summary'] = true;
          $this->Ini->SC_module_export = 'resume,chart';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_det'] = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['conf_chart_level'] = "S";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida']      = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_grid']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_grid'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_init']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_init'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_label']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_label'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['cab_embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['cab_embutida'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_pdf']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_pdf'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_treeview']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_treeview'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_opcao']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_opcao'] = "";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['proc_pdf'] = (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'] && ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "pdf_res")) ? true : false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['proc_pdf']) {
          $_SESSION['scriptcase']['proc_mobile'] = false;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['proc_pdf_vert'] = false;
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
          'value'            => "Exportação",
          'hint'             => "",
          'type'             => "button",
          'display'          => "only_text",
          'display_position' => "text_right",
          'image'            => "",
          'fontawesomeicon'  => "",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

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

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "item_container_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "desc_item";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "qt_alocada";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "qt_confirm_emb";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "tot_custo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_rat_desp";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_distr";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_custo_final";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_unitario_previsto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "perc_desp_prod";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_rat_desp_perc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_custo_final_perc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_unitario_previsto_perc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_dif_perc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "vl_contr_distr_custo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "container_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "item_proc_compra_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'][] = "qt_recbto_fisico";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'];
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel']))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel'] = array();
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel']['container_id'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel']['item_proc_compra_id'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel']['qt_recbto_fisico'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_itens_container_comparacao']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_container_comparacao']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_container_comparacao']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
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
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
      { 
          $this->pdf_zip = (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_pdf']['pdf_zip'])) ? $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_pdf']['pdf_zip'] : "N";
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['use_pass_pdf'] = "";
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
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_prt'] = array();
          $_SESSION['scriptcase']['sc_idioma_prt']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_btns_prtn_titl_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modoimp' => $this->Ini->Nm_lang['lang_btns_mode_prnt_hint'], 'curr' => $this->Ini->Nm_lang['lang_othr_curr_page'], 'total' => $this->Ini->Nm_lang['lang_othr_full'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_word'] = array();
          $_SESSION['scriptcase']['sc_idioma_word']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
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
      if ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "inicio";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_itens_container_comparacao']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_itens_container_comparacao']['start'] == 'filter')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "grid")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "busca";
          }   
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opc_liga'] = array();  
          if (isset($NMSC_conf_apl) && !empty($NMSC_conf_apl))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opc_liga'] = $NMSC_conf_apl;  
          }   
      }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opc_liga']['paginacao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opc_liga']['paginacao']))
          { 
              $this->Ini->Apl_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opc_liga']['paginacao'];
          } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "busca")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "grid" ;  
      }   
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao_print']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao_print']))  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao_print'] = "inicio" ;  
      }   
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_all'] = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "print")  
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "res_print";
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "res_print")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']     = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_all'] = true;
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "print";
              $nmgp_tipo_print = "RC";
          }
      } 
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'], 0, 7) == "grafico")  
      { 
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "pdf")
      { 
          $this->Ini->path_img_modelo = $this->Ini->path_img_modelo;
      } 

      if (isset($_POST['nmgp_opcao']) && 'resumo' == $_POST['nmgp_opcao']
          &&
          isset($_POST['reload_summary_data']) && 'Y' == $_POST['reload_summary_data']
      ) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_array_resumo'] = 'NAO';
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_total_geral'] = 'NAO';
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['using_summary_cache']);
      }

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "fast_search")  
      { 
          $this->SC_fast_search($GLOBALS["nmgp_fast_search"], $GLOBALS["nmgp_cond_fast_search"], $GLOBALS["nmgp_arg_fast_search"]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'])
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = 'igual';
          } 
          else 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_array_resumo'] = "NAO";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_total_geral']  = "NAO";
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['tot_geral']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['using_summary_cache']);
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = 'pesq';
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['orig_pesq'] = 'grid';
          } 
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == 'pesq' && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['orig_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['orig_pesq']))  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['orig_pesq'] == "res")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = 'resumo';
          } 
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['orig_pesq'] == "grid") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = 'inicio';
          } 
      } 
//
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['prim_cons'] = false;  
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))  
      { 
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf']);
       if (!$GLOBALS['nm_restore_grid_save']) { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['prim_cons'] = true;  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'] = " where (container_id = " . $_SESSION['container_corrente'] . ")";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['cond_pesq']         = ""; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_grid']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_lookup'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['campos_busca']      = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['grid_pesq']         = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['Grid_search']       = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_fast']   = "";
       }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_total_geral'] = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['sc_total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['tot_geral']);
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_ant'];  
      if ($nmgp_opcao == "formphp")
      { 
          if ($nm_call_php == "mostrar_vl_dolar")
          { 
              $this->mostrar_vl_dolar();
          } 
          if ($nm_call_php == "mostrar_vl_real")
          { 
              $this->mostrar_vl_real();
          } 
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
          $this->Ini->nm_db_log_imp_mysql->Close(); 
          exit;
      } 
      $nm_flag_pdf   = true;
      $nm_vendo_pdf  = ("pdf" == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['graf_pdf'] = "S";
      if (isset($nmgp_graf_pdf) && !empty($nmgp_graf_pdf))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['graf_pdf'] = $nmgp_graf_pdf;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            $nm_arquivo_htm_temp = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_itens_container_comparacao_html_" . session_id() . "_2.html";
            $nm_arquivo_pdf_base = "/sc_pdf_" . md5(date("Ymd") . "_" . session_id()) . "_grid_itens_container_comparacao.pdf";
            $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . $nm_arquivo_pdf_base;
            $nm_arquivo_pdf_serv = $this->Ini->root . $nm_arquivo_pdf_url;
            $nm_arquivo_de_saida = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_itens_container_comparacao_html_" . session_id() . ".html";
            $nm_url_de_saida = $this->Ini->server_pdf . $this->Ini->path_imag_temp . "/sc_grid_itens_container_comparacao_html_" . session_id() . ".html";
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "doc_word_res")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_navigator'] = "Microsoft Internet Explorer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_all'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['doc_word']  = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']     = "resumo";
          $_SESSION['scriptcase']['saida_word'] = true;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name']))
          {
              $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'], ".");
              if ($Pos === false) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'] .= ".doc";
              }
              $nm_arquivo_doc_word = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'];
          }
          else
          {
              $nm_arquivo_doc_word = "/sc_grid_itens_container_comparacao_res_" . session_id() . ".doc";
          }
          $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->Ini->nm_limite_lin_res_prt = 0;
          $GLOBALS['nmgp_cor_print'] = $nmgp_cor_word;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "xls")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_xls.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_xls.class.php"); 
          } 
          $this->xls  = new grid_itens_container_comparacao_xls();
          $this->prep_modulos("xls");
          $this->xls->monta_xls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "xml")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_xml.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_xml.class.php"); 
          } 
          $this->xml  = new grid_itens_container_comparacao_xml();
          $this->prep_modulos("xml");
          $this->xml->monta_xml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "json")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_json.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_json.class.php"); 
          } 
          $this->json  = new grid_itens_container_comparacao_json();
          $this->prep_modulos("json");
          $this->json->monta_json();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "csv")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_csv.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_csv.class.php"); 
          } 
          $this->csv  = new grid_itens_container_comparacao_csv();
          $this->prep_modulos("csv");
          $this->csv->monta_csv();
      }
      else   
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "rtf")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_rtf.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_rtf.class.php"); 
          } 
          $this->rtf  = new grid_itens_container_comparacao_rtf();
          $this->prep_modulos("rtf");
          $this->rtf->monta_rtf();
      }
      else
    if (isset($_POST['chartapp_action']) && 'Y' == $_POST['chartapp_action']) {
        if (isset($_POST['chartapp_chart_type']) && 'Y' == $_POST['chartapp_chart_type'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_info'][$_POST['chart_md5']])) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_itens_container_comparacao" . $this->Ini->Apl_resumo);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_app_change_type'] = true;
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_app_md5'] = $_POST['chart_md5'];
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_app_type'] = $_POST['chart_type'];
            $this->Res = new grid_itens_container_comparacao_resumo("out");
            $this->prep_modulos("Res");
            $this->Res->monta_resumo();
        } else {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_itens_container_comparacao" . $this->Ini->Apl_grafico);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico);
            }
            $this->Graf = new grid_itens_container_comparacao_grafico();
            $this->prep_modulos("Graf");
            $this->Graf->display_chartApp_type($_POST['chart_md5'], $_POST['chart_type']);
        }
    }
    else
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'], 0, 7) == "grafico")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . " . grid_itens_container_comparacao . /" . $this->Ini->Apl_grafico); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          } 
          $this->Graf  = new grid_itens_container_comparacao_grafico();
          $this->prep_modulos("Graf");
          if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'], 7, 1) == "_")  
          { 
              $this->Graf->grafico_col(substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'], 8));
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "grid";
          }
          else
          { 
              if (isset($_POST['summary_chart_data']) && 'Y' == $_POST['summary_chart_data'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_data($_POST['chart_md5']);
              }
              elseif (isset($_POST['summary_chart']) && 'Y' == $_POST['summary_chart'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_newPage($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_create']) && 'Y' == $_POST['chart_inline_create'] && isset($_POST['chart_md5'])) {
                  $this->Graf->display_summaryChart_inline_initialAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_update']) && 'Y' == $_POST['chart_inline_update'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_inline_updateAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dashboard_refresh_after_chart'])) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dashboard_refresh_after_chart'];
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['dashboard_refresh_after_chart']);
              }
              else {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] = "grid";
              }
              $this->Graf->monta_grafico();
          }
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "busca")  
      { 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_mobile_pesq.class.php"); 
          } 
          $this->pesq  = new grid_itens_container_comparacao_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_flag    = $this->NM_ajax_flag;
          $this->pesq->NM_ajax_opcao   = $this->NM_ajax_opcao;
          $this->pesq->monta_busca();
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "resumo")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/" . $this->Ini->Apl_resumo); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          } 
          $this->Res = new grid_itens_container_comparacao_resumo("out");
          $this->prep_modulos("Res");
          $this->Res->monta_resumo();
      }
      else 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "print" && $nmgp_tipo_print == "RC")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_navigator'] = $nmgp_navegator_print;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']     = "pdf";
              $GLOBALS['nmgp_tipo_pdf'] = strtolower($nmgp_cor_print);
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] == "doc_word")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_navigator'] = "Microsoft Internet Explorer";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['doc_word']  = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao']     = "pdf";
              $_SESSION['scriptcase']['saida_word'] = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name']))
              {
                  $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'], ".");
                  if ($Pos === false) {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'] .= ".doc";
                  }
                  $nm_arquivo_doc_word =  "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_name'];
              }
              else
              {
                  $nm_arquivo_doc_word = "/sc_grid_itens_container_comparacao_" . session_id() . ".doc";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
              $this->Ini->nm_limite_lin_prt = 0;
              $GLOBALS['nmgp_tipo_pdf'] = $nmgp_cor_word;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_itens_container_comparacao/grid_itens_container_comparacao_grid.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_itens_container_comparacao_grid.class.php"); 
          } 
          $this->grid  = new grid_itens_container_comparacao_grid();
          $this->prep_modulos("grid");
          $this->grid->monta_grid($linhas);
      }   
//--- 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida'])
      {
         $nm_saida->finaliza();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['ajax_nav'])
         {
             $Temp = ob_get_clean();
             if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['opcao'] != "ajax_detalhe")  
             {
                 $this->Ini->Arr_result['setVar'][] = array('var' => 'scQtReg', 'value' => $this->Ini->Qtd_reg_ajax_grid);
             }
             $_SESSION['scriptcase']['saida_var'] = false;
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Ini->Arr_result);
             exit;
         }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['field_order']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['field_order'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['field_order']);
            }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['usr_cmp_sel']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['usr_cmp_sel'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['export_sel_columns']['usr_cmp_sel']);
            }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['doc_word'])
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'] = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
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
                $str_pd4ml    = " --page-size A4 --orientation Landscape";
            }
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_res'])
            { 
                $str_pd4ml .= " --outline-depth 0";
            }
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name']))
            {
                $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'], ".");
                if ($Pos === false) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'] .= ".pdf";
                }
                if ('/' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'], 0, 1)) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'] = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'], 1);
                }
                $nm_arquivo_pdf_serv = $this->Ini->root .  $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'];
                $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'];
                $nm_arquivo_pdf_base = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_name']);
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
            elseif (is_dir($this->Ini->path_third . $dir_qpdf) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf']))
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
                $str_execcmd2 = 'wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]/[toPage]" --margin-top 5 --margin-left 5 --margin-bottom 5 --margin-right 5';
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (isset($_SERVER['NM_SC_SYS_CONFIG']) && $_SERVER['NM_SC_SYS_CONFIG'] == 1) 
                {
                    chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]/[toPage]" --margin-top 5 --margin-left 5 --margin-bottom 5 --margin-right 5';
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
                    $str_execcmd2 = './wkhtmltopdf-i386 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]/[toPage]" --margin-top 5 --margin-left 5 --margin-bottom 5 --margin-right 5';
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
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]/[toPage]" --margin-top 5 --margin-left 5 --margin-bottom 5 --margin-right 5';
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/osx/Contents/MacOS");
                $str_execcmd2 = './wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]/[toPage]" --margin-top 5 --margin-left 5 --margin-bottom 5 --margin-right 5';
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
                $pdf_pass = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf'] : "";
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
            elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf']))
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
                    $pdf_pass  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['use_pass_pdf'];
                    $str_cmd_qpdf .= "--encrypt " . $pdf_pass . " " . $pdf_pass . " 256 -- " . $arq_pdf_out . " " . $arq_pdf_final;
                    exec($str_cmd_qpdf);
                    if (is_file($arq_pdf_final)) 
                    {
                        unlink($arq_pdf_out);
                    }
                }
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_array_resumo'] = '';
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['contr_total_geral']  = '';
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
unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_file']);
if (is_file($nm_arquivo_pdf_serv))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['pdf_file'] = $nm_arquivo_pdf_serv;
}
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
</HEAD>
<BODY>
<?php
if (!is_file($nm_arquivo_pdf_serv))
{
?>
  <table><tr><td><font color="FF0000"><b><?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?></b></font></td></tr></table>
<?php
}
else
{
?>
  <SCRIPT>
    window.location='<?php echo $nm_arquivo_pdf_url; ?>';
  </SCRIPT>
<?php
}
?>
</BODY>
</HTML>
<?php
         }
      }
   } 
   function mostrar_vl_dolar() 
   {
      global 
      $nm_apl_dependente;
      $this->SC_redir_btn = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'];
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
      $_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['moeda_grid_itens_container_comparacao'])) {$_SESSION['moeda_grid_itens_container_comparacao'] = "";}
if (!isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$this->sc_temp_moeda_grid_itens_container_comparacao = (isset($_SESSION['moeda_grid_itens_container_comparacao'])) ? $_SESSION['moeda_grid_itens_container_comparacao'] : "";}
  $moeda_grid_itens_container_comparacao = 'dolar';
 if (isset($moeda_grid_itens_container_comparacao)) {$this->sc_temp_moeda_grid_itens_container_comparacao = $moeda_grid_itens_container_comparacao;}
;
 if (isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$_SESSION['moeda_grid_itens_container_comparacao'] = $this->sc_temp_moeda_grid_itens_container_comparacao;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('bl_chama_grid_itens_container_comparacao') . "/", $this->nm_location, "moeda_param?#?" . NM_encode_input("dolar") . "?@?","_self", 440, 630);
 };
if (isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$_SESSION['moeda_grid_itens_container_comparacao'] = $this->sc_temp_moeda_grid_itens_container_comparacao;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off'; 
?>
      </td></tr><tr><td align="center">
      <form name="F4" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value="volta_grid"/>
      <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page);?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
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
      $this->SC_redir_btn = false;
   }
   function mostrar_vl_real() 
   {
      global 
      $nm_apl_dependente;
      $this->SC_redir_btn = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'];
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
      $_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['moeda_grid_itens_container_comparacao'])) {$_SESSION['moeda_grid_itens_container_comparacao'] = "";}
if (!isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$this->sc_temp_moeda_grid_itens_container_comparacao = (isset($_SESSION['moeda_grid_itens_container_comparacao'])) ? $_SESSION['moeda_grid_itens_container_comparacao'] : "";}
  $moeda_grid_itens_container_comparacao = 'real';
 if (isset($moeda_grid_itens_container_comparacao)) {$this->sc_temp_moeda_grid_itens_container_comparacao = $moeda_grid_itens_container_comparacao;}
;
 if (isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$_SESSION['moeda_grid_itens_container_comparacao'] = $this->sc_temp_moeda_grid_itens_container_comparacao;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('bl_chama_grid_itens_container_comparacao') . "/", $this->nm_location, "moeda_param?#?" . NM_encode_input("real") . "?@?","_self", 440, 630);
 };
if (isset($this->sc_temp_moeda_grid_itens_container_comparacao)) {$_SESSION['moeda_grid_itens_container_comparacao'] = $this->sc_temp_moeda_grid_itens_container_comparacao;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off'; 
?>
      </td></tr><tr><td align="center">
      <form name="F4" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value="volta_grid"/>
      <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page);?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
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
      $this->SC_redir_btn = false;
   }
function diaDaSemana($data,$retorno=0,$formato='aaaa-mm-dd')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
     
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function converterDataBra($data)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aData = explode("-",$data);
    return $aData[2]."/".$aData[1]."/".$aData[0];



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function converterHoraEmMinutos($hora)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $aQtMinutos = explode(':',$hora);
    if(is_array($aQtMinutos) and count($aQtMinutos) == 3){
        $qtMinutos = $aQtMinutos[0] * 60 + $aQtMinutos[1] + $aQtMinutos[2] / 60;
    }
    else{
        $qtMinutos = 0;
    }
    return $qtMinutos;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function converterMinutosEmHoras($minutos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $hora = round($minutos / 60,0);
    if($hora < 1){
        $hora = 0;
    }
    $hora = preencherZerosAEsquerda ($hora,2);
    $min =  round($minutos % 60,0);
    $min = preencherZerosAEsquerda ($min,2);
    $formato_hora = "$hora:$min:00";
    return $formato_hora;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getQuinzenaMesAnoData($data)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convMes($mes,$tipo='abrev')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getParteDataAMD($data,$parte)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCotacaoDolarVendaBC($serieParam = 1, $tempo = 3, $tipoRetorno = 'valor', $logHist = true, $logForcarBusca = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirHistCotacaoBc($serie, $data, $valor, $nome, $logOk)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosCotacaoHoje($serieParam = 1)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = '';
    $data = date('Y-m-d');
    $aRet = $this->getDadosHistCotacoesBc(0,
        'top 1 valor  as valor,nome_serie,data',
        " serie = $serieParam and data = '$data' and (log_ok = 1 or log_manual = 1) order by hist_cotacao_bc_id desc");
    if (is_array($aRet)) {
        $aRetorno = $aRet[0];
    }
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlCotacaoHoje($serie = 1)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $valor = 0;
    $aDados = $this->getDadosCotacaoHoje($serie);
    if (is_array($aDados)) {
        $valor = $aDados['valor'];
    }
    return $valor;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosUltCotacao($serie = 1)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosHistCotacoesBc($id, $campos = '', $filtro = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrCotacaoDia($serie = 1)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logAtu = false;
    $vl = $this->getVlCotacaoHoje($serie);
    if ($vl == 0) {
        $vl = $this->atualizarCotacaoDia($serie);
        $logAtu = true;
    }
    $aRetorno = array('valor' => $vl, 'log_atu' => $logAtu);
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCotacaoDia($serie, $valor = 0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aCotacao = $this->getCotacaoEms5($indicador, $data);
    $logAchou = $aCotacao['log_achou'];
    if ($logAchou == 0) {
        $this->inserirCotacaoEms5($indicador, $data, $valor);
    } else {
        $this->atualizarCotacaoEms5($indicador, $data, $valor);
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCotacaoEms5($indicador, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrCotacaoEms2($indicador, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCotacaoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCotacoesPeriodoEms2($serie, $data, $logConvSerie = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCotacaoEms5($serie, $data)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirCotacaoEms5($serie, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirCotacaoEms2($serie, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCotacaoEms($serie, $data, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $indicador = $this->convSerieEmIndicador($serie, 'ems2');
    $this->sincrCotacaoEms2($indicador, $data, $valor);
    $indicador = $this->convSerieEmIndicador($serie, 'ems5');
    $this->sincrCotacaoEms5($indicador, $data, $valor);


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convSerieEmIndicador($serie, $destino)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarRegCtaCorrenFornec($fornecedorId,$data,$itemProcCompraId,$historico,$codTipoMovto,$vlLancto,
                                 $codAcao,$numIdTitAp=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
if (!isset($_SESSION['transacao_universal'])) {$_SESSION['transacao_universal'] = "";}
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
             exit;
         }
         $rf->Close();
      
    }
    return $logCriar;
if (isset($this->sc_temp_transacao_universal)) {$_SESSION['transacao_universal'] = $this->sc_temp_transacao_universal;}
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function alterarFornecItensPed($pedido,$fornec)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aItens =  $this->getIDItensProcCompra($pedido);
    if(is_array($aItens)){
        $tam = count($aItens);
        for($i=0;$i< $tam; $i++){
            $itemProcCompra = $aItens[$i]['item_proc_compra_id'];
            $cmd = "update pub.cta_corren_fornec_imp set fornecedor_id = $fornec 
            where item_proc_compra_id = $itemProcCompra ";
        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verifTitPedImp($numIdTitulo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarPgtosContainerPedImp($containerParam,$descOrigem='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarPagtosContainerSemItens($containerParam,$histCompl,$itemContainerParam=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logExiste = $this->existItensContainer($containerParam);
    $descLogExiste = $this->convLogEmString($logExiste);
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
                            $descRetCriacao = $this->convLogEmString($retCriacao);
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarPagtosItemContainer($itemContainerId,$histCompl)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $transacaoId = iniciarTransacao('estornarPagtosItemContainer');
    setTransacaoUniversal($transacaoId);
    $data      = date('Y-m-d');
    inserirLogDb("transacao",$transacaoId,__FUNCTION__);
    $aReg = $this->getSomasCtaCorrenFornec(5,true,0,0,$itemContainerId);
    $descAReg = $this->convArrayToString($aReg);
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
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 6 e acao 3',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
        decrNivelCorrenteLogDb();
    }
    finalizarTransacao($transacaoId);
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarTitAssocPedImp($numIdTitulo,$descOrigem='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logAssociado = $this->verifTitPedImp($numIdTitulo);
    $descrLogAssociado = $this->convLogEmString($logAssociado);
    inserirLogDb('Inicio funcao',__FUNCTION__,__FUNCTION__);
    inserirLogDb('Titulo associado a algum Pedido de Compra e que tenha gerado movto cta corrente fornecedor?',
        $descrLogAssociado,__FUNCTION__);
    if($logAssociado == true){
        $aRet =  $this->getSomasCtaCorrenFornec('4', 
            true,$numIdTitulo);
        $descARet = $this->convArrayToString($aRet);
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
                $descrRetCriacao = $this->convLogEmString($retCriacao);
                inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 1 - movto negativo',
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);
            }


            decrNivelCorrenteLogDb();
        }
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarPagtosContainer($nivel, $id,$histCompl='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
            $arrayTxt = $this->convArrayToString($aReg);
            inserirLogDb("Array Titulos do container:$id",$arrayTxt,__FUNCTION__);

            if(is_array($aReg)){
                $tam = count($aReg);
                incrNivelCorrenteLogDb();
                for($i=0;$i<$tam;$i++){
                    $titulo = $aReg[$i]['num_id_tit_ap'];
                    inserirLogDb('titulo encontrado?',$titulo,__FUNCTION__);
                    $aSaldo = $this->getSomasCtaCorrenFornec('5,6',true,$titulo);
                    $arrayTxt = $this->convArrayToString($aSaldo);
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
                            $descrRetCriacao = $this->convLogEmString($retCriacao);
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
            $arrayTxt = $this->convArrayToString($aSaldo);
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
                    $descrRetCriacao = $this->convLogEmString($retCriacao);
                    inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 5 e acao 3',
                        "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                }
            }
            break;
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSomasCtaCorrenFornec($tipoMovto,
                                 $logQuebra,
                                 $numIdTitulo=0,
                                 $itemPedId=0,
                                 $itemContainerId=0,
                                 $fornecId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $quebraCampos  = '';
    $quebraGroup   = '';
    $condTitulo    = '';
    $condItemPed   = '';
    $condContainer = '';
    $condFornec    = '';

    if($logQuebra == true){
        if($numIdTitulo == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'num_id_tit_ap',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'num_id_tit_ap',",");
        }
        if($itemPedId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'item_proc_compra_id',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'item_proc_compra_id',",");
        }
        if($itemContainerId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'item_container_id',",");
            $quebraGroup  = $this->util_incr_valor($quebraGroup,'item_container_id',",");
        }
        if($fornecId == 0){
            $quebraCampos = $this->util_incr_valor($quebraCampos,'fornecedor_id',",");
            $quebraGroup = $this->util_incr_valor($quebraGroup,'fornecedor_id',",");
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function estornarSaldoPgtosItemPed($itemPedido,$historico='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb('Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao 3 - movto negativo',
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);

        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarSaldoInicialFornec($fornec)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = false;
    $tabela = " pub.cta_corren_fornec_imp  ";
    $campo  = "fornecedor_id";
    $condicao = " fornecedor_id = $fornec and cod_tipo_movto = 1 ";
    $aResultado = $this->retornoSimplesTb01($tabela,$campo	,$condicao,"espec");
    if(is_array($aResultado)){
        $retorno = true ;
    }
    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarVlPagarItemPedido($itemProcCompra,$vlLancto,$acao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $data = date('Y-m-d');
    $procCompraID = $this->buscarProcCompraItem($itemProcCompra);
    $aPedido = $this->getDadosPedidoImp($procCompraID);
    $logGerarPrevisao = $aPedido[0]['log_considerar_previsao'];
    $descLogGerarPrevisao = $this->convLogEmString($logGerarPrevisao);
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
            $descrRetCriacao = $this->convLogEmString($retCriacao);
            inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $acao",
                "Movimento Criado? $descrRetCriacao",__FUNCTION__);
        }
        finalizarTransacao($transacaoId);
    }else{
        inserirLogDb('Lancamento nao gerado',
            'pedido de compra configurado para nao integrar conta corrente fornecedor ',__FUNCTION__);
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoVlPagarItemPedido($itemProcCompra)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrRateioAntecipPedImp($procCompra,$histCompl,$logForcarRateio = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
        $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompra);
        inserirLogDb($titulo,"Lista de titulos: $listaTitulos",__FUNCTION__);
        if($listaTitulos <> ''){
            $aTitulos = explode(',',$listaTitulos);
            if(is_array($aTitulos)){
                $tam = count($aTitulos);
                for($i=0;$i<$tam;$i++){
                    $numIdTitAp = $aTitulos[$i];
                    $logRateio = $this->verificarNecesAtualizPgtoPedido($numIdTitAp);
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarRateioAntecipPedImp($procCompra,$numIdTitAp,$histCompl='',$logEstorno=false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $titLog = "Geracao de Rateio Pgtos - Ped.Imp";
    $data   = date('Y-m-d');
    $empImp = $this->buscarEmpProcCompra($procCompra);
    $codEmp  = $this->buscarcodEmpresa($empImp,'importacao','ems5');
    $codEstab = $this->getEstabEms5($codEmp) ;
    $vlAdiantDolar  =   $this->buscarVlMoeda($numIdTitAp,'','dolar' );
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
                $descrRetCriacao = $this->convLogEmString($retCriacao);

                inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 4 e acao $codAcao",
                    "Movimento Criado? $descrRetCriacao",__FUNCTION__);

            }
        }
        decrNivelCorrenteLogDb();
    }
    inserirLogDb('Fim funcao',__FUNCTION__,__FUNCTION__);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atuRatPagtoPedTitContainer($numIdTitAp, $histCompl='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    inserirLogDb('inicio',__FUNCTION__,__FUNCTION__);
    inserirLogDb(' param titulo:',$numIdTitAp,__FUNCTION__);
    inserirLogDb(' param histCompl:',$histCompl,__FUNCTION__);
    inserirLogDb('antes da funcao getProcCompraPgto - param titulo:',$numIdTitAp,__FUNCTION__);
    $procCompraId = $this->getProcCompraPgto($numIdTitAp);
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atuRatPagtoPedItemContainer($itemPedido,$histCompl)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoFornecAntItem($fornec, $numIdTitAp,$itemProcCompra )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoFornecTituloItemRatContainer($fornec, $numIdTitAp,$itemProcCompra,$itemContainerId )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarRateioFornecAntecipsContainer($container,$histCompl='',$logEstorno=false,$titulo=0,$itemContainer=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
                $vlTitDolar = $this->buscarVlMoeda($numIdTitAp,'','dolar');
                inserirLogDb('Vl.Tit.Dolar',$vlTitDolar,__FUNCTION__);
                $aItens     = $this->buscarIDItensContainer($container);
                $descAItens = $this->convArrayToString($aItens);
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
                        $descLogEstorno = $this->convLogEmString($logEstorno);
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
                            $descrRetCriacao = $this->convLogEmString($retCriacao);
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarRateioFornecContainer($container, $tipoMovto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 - negativo ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto,0 );
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9 ",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);

                        break;
                    case 2: 
                        $historico = "ESTORNO da Transferência do valor pago ao fornecedor $codFornecContainer para o 
                        fornecedor $codFornecPedImp, referente ao item $descItem alocado ao container $container";
                         $retCriacao = $this->criarRegCtaCorrenFornec($codFornecContainer,$data,$itemContainerId,$historico,9,
                            $vlLancto ,0);
                         $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        $retCriacao = $this->criarRegCtaCorrenFornec($codFornecPedImp,$data,$itemContainerId,$historico,9,
                            $vlLancto * -1,0);
                        $descrRetCriacao = $this->convLogEmString($retCriacao);
                        inserirLogDb("Apos criacao do registro de conta corrente do fornecedor com o tipo movto 9",
                            "Movimento Criado? $descrRetCriacao",__FUNCTION__);
                        break;
                }
            }
        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoAntCtaCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aDados = $this->getDadosCtaCorrenFornecImp($fornecedor,'vl_lancto','cod_tipo_movto = 1' );
    if(is_array($aDados)){
        $vlSaldoAnterior = $aDados[0]['vl_lancto'];
    }else{
        $vlSaldoAnterior = 0;
    }
    return $vlSaldoAnterior;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTotLancManualFornecImp($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCpSomaSaldoPorSitContainer()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoNaoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoEmbarcadoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSaldoEntreguePortoCorrenFornecImp($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosCtaCorrenFornecImp($fornecedor,$campos='',$cond='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $tipo     = "unico"; 
    $tabela   = " pub.cta_corren_fornec_imp ";
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','cta_corren_fornec_imp');
        $campos = $aCampos['campos'];
    }
    $condicao = '';
    $condicao =  $this->util_incr_valor($condicao, " fornecedor_id = $fornecedor ", " AND ",
            true) ;

    if($cond <> ''){
        $condicao =  $this->util_incr_valor($condicao, $cond, " AND ",true) ;
    }
    $aReg = $this->getDados($tipo,$tabela,$campos,$condicao,'espec');
    return $aReg;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function eliminarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function ajustarCtaCorrenFornec()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarLanctosCtaCorrenPedImp($pedImp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
            $listaItensPedido = $this->util_incr_valor($listaItensPedido,$itemProcCompraId);
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
    $listaPagtosPedido = $this->buscarTitAssociadosProcCompra($pedImp);
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
                $listaContainersGeral = $this->util_incr_valor($listaContainersGeral,$listaContainers,',');
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarLanctosPedidosIntegrCtaCorrente()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function eliminarLanctosPedidosNaoIntegrCtaCorrente()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDeParaSitCta($sitCta)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarRegDistrCusto($item_container_custo_id,$item_container_id,$historico,$cod_tipo_movto,$vl_lancto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if(!$this->getParamDistrCusto()){
        $vl_lancto = 0;
        $historico .=" - Lançamento zerado devido a distribuição de custo estar desligada";
    }
    $login = getLoginCorrente();
    $cmd = "insert into pub.cta_corren_custo_distr(cta_corren_custo_distr_id,data,item_container_custo_id,item_container_id,historico,
            cod_tipo_movto,vl_lancto,login)
            values(pub.seq_cta_corren_custo_distr.NEXTVAL,CURDATE(),$item_container_custo_id,$this->item_container_id,'$historico',$cod_tipo_movto,$vl_lancto,'$login')";
    
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
      
    $novoId = $this->buscarVlSequenciaEspec('seq_cta_corren_custo_distr','cta_corren_custo_distr');
    return $novoId;
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDadosCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $tabela = "pub.cta_corren_custo_distr";
    $campos = "data,item_container_custo_id,item_container_id,historico,cod_tipo_movto,vl_lancto";
    $condicao = "cta_corren_custo_distr_id = $id";
    $aRetorno = $this->retornoSimplesTb01 ($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarContainerCtaCorrenCustoDistr($id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarDespesaDistrCusto($idCtaCorrenCustoDistr,$valor,$itemContainerId=0,$container=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarVlDespesaDistrCusto($idCtaCorrenCustoDistr, $valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logAtualizado = 0;
    $id = $this->buscarDespesaContainerDistrCusto($idCtaCorrenCustoDistr);
    if($id <> 0){
        $logAtualizado = 1;
        $this->atualizarVlDespesaContainerPorId($id,$valor);
    }
    return $logAtualizado;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarSaldoAtualDistrCusto()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $valor = 0;
    $tabela = "pub.cta_corren_custo_distr";
    $campo = "sum(vl_lancto) as saldo";
    $condicao = " 1=1 ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['saldo'];
    }
    return $valor;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularSaldoAnteriorDistrCusto($condicao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTotalDistrParaItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $vlTotal = 0;
    $tabela   = " pub.cta_corren_custo_distr ";
    $campos   = " sum(vl_lancto) as tot ";
    $condicao = "  item_container_id = $itemContainerId and cod_tipo_movto = 4";
    $aDados = $this->getDados('unico',$tabela,$campos,$condicao);
    if(is_array($aDados)){
        $vlTotal = $aDados[0]['tot'];
    }
    return $vlTotal;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTotalDistrPorItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlDistrContainer($containerParam, $itemContainerParam='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFornecItemProcCompra($itemProcCompra)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlTribItens($proc_compra_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $valor = 0;
    $aRetorno = $this->retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $this->proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtAlocItemProc($item_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $qtAlocada  = $this->buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = $this->buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtCompradaItemProc($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarItemAlocado($container_id,$item_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $this->container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarProcCompraItem($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCodItemERP($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = $this->retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarContainersItemProcCompra($item_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $qt = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = 
         $this->nm_data->CalculaData($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
    }
    return 	$dtPrevRecbtoAmostras;
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = 
         $this->nm_data->CalculaData($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtMaximaProducao;
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sugerirDtPrevEmbarque($dtFinalProducao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = $this->buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = 
         $this->nm_data->CalculaData($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0, "aaaa-mm-dd", "yyyy-mm-dd"); 
      ;
    }
    return $dtPrevEmbarque;
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
    }
    $aRetorno = $this->retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIDItensProcCompra($procCompra)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTitAssociadosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlTotPagtoProcCompra($procCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $listaTitulos = $this->buscarTitAssociadosProcCompra($procCompraId);
    $codEstab     = $this->buscarEmpERPProcCompra($procCompraId,'ems5');
    $codEstab     += 1 ;
    $valor = $this->buscarTotPagoLista($codEstab,$listaTitulos,'dolar');
    return $valor;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlPgtoAssocContainer($procCompra,$container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function preencherCondPgtoProcCompra($condicaoTitAP)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function existTitProcCompra($numIdTitAp,$procCompraId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarNecesAtualizPgtoPedido($numIdTitAp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logAtualizar = true;
    $container = $this->getcontainerPagto($numIdTitAp);
    if($container <> 0){
        $logExisteItens = $this->existItensContainer($container);
        if($logExisteItens == true){
            $logAtualizar = false;
        }
    }
    return $logAtualizar;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getProcCompraPgto($numIdTitAp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function desassociarTituloPedido($numIdTitAp,$procCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function associarTituloPedido($numIdTitAp,$proCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTitAssocSoPedido($fornecedor,$tipoReg)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaTitAssocPedido()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescItem($itCodigo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDescItem($itCodigo){
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aReg = $this->getReg('ems2med','item','"it-codigo"',
        "$itCodigo",'"desc-item" as desc_it');
    return $aReg;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaItCodigoPorDescricao($descricao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarEmpProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $empresa = 0;
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " empresa_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){
        $empresa = $aRetorno[0]['empresa_id'];
    }
    return $empresa;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescProcCompra($procCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $processo = '';

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " cod_proc_fornec, fornecedor_id ",
        " proc_compra_id = $procCompraId ","espec");
    if(is_array($aRetorno)){
        $processo = $aRetorno[0]['cod_proc_fornec'];
        $fornecedor = $this->buscarDescFornecedor($aRetorno[0]['fornecedor_id']);
        $processo .= ' '. $fornecedor;
    }
    return $processo;



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFornecedorProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $fornecedor = 0;

    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " fornecedor_id ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $fornecedor =$aRetorno[0]['fornecedor_id'];
    }
    return $fornecedor;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDtRegProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $data = '2001-01-01';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ", " dt_registro ",
        " proc_compra_id = $procCompraIdParam ","espec");
    if(is_array($aRetorno)){

        $data =$aRetorno[0]['dt_registro'];
    }
    return $data;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarEmpERPProcCompra($procCompraIdParam,$sistema)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCotPrevProcCompra($procCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'cotacao_prevista';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtContainerProcCompra($procCompraId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $vl = 0;
    $campo   = 'qt_container';
    $aRetorno = $this->retornoSimplesTb01(" pub.procs_compra ",  $campo , " proc_compra_id = $procCompraId ");
    if(is_array($aRetorno)){
        $vl = $aRetorno[0][$campo];
    }
    return $vl;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarADProcCompra($procCompraID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosPedidoImp($id,$campos='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','procs_compra');
        $campos = $aCampos['campos'];
    }

    $tabela   = " pub.procs_compra ";
    $condicao = "  proc_compra_id = $id ";
    $aResult = $this->getDados('unico',$tabela,$campos,$condicao,"espec");
    return $aResult;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getProcsCompraCtaPorFornec($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getProcsCompraIntegrCtaFornec()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getProcsCompraNaoIntegrCtaFornec()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarAltPedCompra($pedido)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $erro = '';
    $vl = $this->buscarVlTotPagtoProcCompra($pedido);
    if($vl > 0 ){
        $erro = "Para alterar o fornecedor não pode existir nenhum pagamento associado";
    }
    return $erro;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validacoesPedCompra($pedido)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $erro = $this->validarAltPedCompra($pedido);
    return $erro;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getFornecsPedImpGeraPrev()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlMoeda($numIdTitAp,$codEstab='',$moeda='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getEspecsAdiant()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_adiant_importacao");
    if ($param == '') {
        $especs = "'AF'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getEspecsTit()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma("especs_tit_importacao");
    if ($param == '') {
        $especs = "'DI'";
    } else {
        $especs = $param;
    }
    return $especs;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDadosTitulo($numTitAp,$codEstab='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $condicao = " num_id_tit_ap = $numTitAp  ";
    if($codEstab <> ''){
        $condicao .= " and cod_estab = '$codEstab'";
    }
    $tabela = 'pub.tit_ap';
    $campo  = 'cod_espec_docto,cod_ser_docto,cod_tit_ap,cod_parcela,dat_emis_docto,
	dat_vencto_tit_ap,dat_liquidac_tit_ap,cod_estab';

    return $this->retornoSimplesTb01($tabela,$campo,$condicao,"ems5");


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCpsTb($catalogo,$tb,$logNomeTabela=false,$logMulti=true)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTipoConexao($conexao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getReg($conexao,$tabela, $camposChave,$valoresCamposChave, $campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDados($tipo,$tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retornoSimplesTb01($tabela,$campos,$condicao,$conexao='',$inner='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirLogSQL($tabela,$campos,$condicao,$conexao,$inner,$sql,$aRetorno,$funcao){
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $var = "cps_".$catalogo."_".$tabela;
    if(!isset($_SESSION[$var]) or $_SESSION[$var] == ''){
        $this->setCpsTbSessao($catalogo,$tabela);
    }
    return $_SESSION[$var];


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setCpsTbSessao($catalogo,$tabela)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $var = "cps_".$catalogo."_".$tabela;
    $lista = $this->getCpsTb ($catalogo,$tabela);
    $_SESSION[$var] = $lista;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retornoMultReg($tabela,$campos,$condicao,$conexao ='',$inner = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUltIdTabela($tabela,$tipoBanco='sql',$banco="log_db")
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function execAcaoPDO($cmd,$conexaoBase,$acao='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getODBCDireto($conexaoSC)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function conectarBase($conexaoSC,$usuario='sysprogress',$senha='sysprogress',$logOdbc=true)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retornarChaveEstr($apelidoConj,$numRetorno)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convertArrayEmUpdate($tabela,$aDados,$condicao,$cpsSemAspas='',$logPub=true)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convertDadosSqlParaAPI($tabParam, $campos, $condicao, $inner,$formato='json')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCpsTbSQLSERVER($conexao, $tb, $logNomeTabela = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getRegsSqlLivre($sql,$campos,$conexao,$logUTF8=0,$logSql=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convertArrayEmInsert($tabela,$aDados,$cpsSemAspas='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function updateDireto($conexaoSC,$tabela,$aDados,$condicao,$cpsSemAspas='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setCondWhere($cond)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($cond <> ''){
        if (empty($this->sc_where_atual )){
            $this->nm_where_dinamico = "where $cond ";
        }else{
            $this->nm_where_dinamico = "AND $cond ";
        }
    }
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['inicio']);
}

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function conectarBaseMysql($nomeBanco)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUsuarioLock($tabela,$conexaoSC)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function acertarAspasSimplesInsert($cmd)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return $cmd;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convertCpParaAPI($campos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $campos = str_replace(chr(34),'',$campos);

    return $campos;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDadositemContainer($itemContainer)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    $campos   = "qt_alocada,qt_confirm_emb,qt_recbto_fisico,item_proc_compra_id,item_container_id,container_id";
    $condicao = " item_container_id = $itemContainer ";
    $aValores = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aValores;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getRegItemContainer($itemContainer,$campos='',$filtroCompl='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFornecProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarProcCompraItemContainer($itemContainerID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarIDItensContainer($container,$campos='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $tabela   = "pub.itens_container";
    if($campos == ''){
        $campos   = "item_container_id , item_proc_compra_id, qt_alocada, qt_confirm_emb, qt_recbto_fisico";
    }
    $condicao = "container_id = $container";
    $aRetorno = $this->retornoMultReg($tabela ,$campos,$condicao,"espec" );
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function existItensContainer($containerParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarItensContainer($container_id,$aItens)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotCustoPrevDolarContainer($containerId, $tipo='tributado', $item='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotCustoPrevRealContainer($containerId, $tipo='tributado', $aCotacao, $item='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotCustosPrevRealContainer($containerId,$aCotacao='',$item='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $aVls['vl_tributado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'tributado',$aCotacao,$item);
    $aVls['vl_proforma']   = $this->buscarTotCustoPrevRealContainer($containerId, 'proforma',$aCotacao,$item);
    $aVls['vl_negociado']  = $this->buscarTotCustoPrevRealContainer($containerId, 'negociado',$aCotacao,$item);
    $aVls['vl_trib_neg']  = $this->buscarTotCustoPrevRealContainer($containerId, 'trib_neg',$aCotacao,$item);
    return $aVls;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCustoRealItens($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlCustoTotalContainer($containerId,$moeda)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularCustoGeralItem($container,$totDespesas,$totCustoPrevDolar,$moeda,$tipoCusto='tributado' ,$logBuscarCustoReal = true,
                                $logBuscarDespSemDistrCusto=true )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarUtilizCustoItem($item_custo_id, $item_container_custos_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarItensSemCodERP($container){
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDescrItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getContainerItemContainer($itemContainerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $container = 0;
    $aReg = $this->getRegItemContainer($itemContainerId,'container_id');
    if(is_array($aReg)){
        $container = $aReg[0]['container_id'];
    }
    return $container;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIdContainersAlocItemPedImp($itemPedImp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrQtEmbarcadaCtaCorrenFornec($itemContainerParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarUltItemCusto($itCodigo,$container='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularNovoCustoItem($container,$itemContainerId,$logPriorizarCustoPrevisto=0,$aDadosItemContainer='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirItemCustosTipoContainer($dtHrCusto, $vlUnitNovo, $itCodigo, $qtEstoque, $qtNfMae,
                                        $qtEtiqContainer, $vlUnitAnterior,$vlUnitContainer,
                                        $qtContainer )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
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
             exit;
         }
         $rf->Close();
      
    $seq = $this->buscarVlSequenciaEspec('seq_item_custos','item_custos');
    return $seq;
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirItemCustosTipoMedia($vlUnitNovo,$itCodigo,$qtEstoque,$vlUnitAnterior,
                                    $itCodigoMedia, $qtEstoqueMedia, $vlUnitMedia,
                                    $mediaCustoId=0,$memoriaCalculo='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
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
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getContainerItemCusto($itemCustoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getItensCustoContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaIdsUltCusto()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getQtItensMediaId($mediaId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $qt = 0;
    $aReg = $this->getReg('espec','item_custos','media_custo_id',
        $mediaId,'count(item_custo_id) as qt');
    if(is_array($aReg)){
        $qt = $aReg[0]['qt'];
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesaLogImpostoOuCalc($despesaId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesaDescr($despesaId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = '';
    $aRetorno = $this->retornoSimplesTb01('pub.despesas','descricao'," despesa_id = '$despesaId'",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["descricao"];
    return $retorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesasImposto($imposto_id,$empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.despesas_impostos", "despesa_id", " empresa_id = $empresa and imposto_id = $imposto_id","espec");
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIdsRelacDespCalculadas($despesa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescMotivosDesconto($motivo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $descricao = '';
    $tabela   = "pub.motivos_desconto";
    $campos   = 'descricao';
    $condicao = " motivo_desconto_id = $motivo";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0]['descricao'];
    }
    return $descricao;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarDespesaProcCompra($proc_compra_id, $despesa_id, $valor, $calc_id = 0 )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarDespesasProcCompra($proc_compra_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $empresa  = $this->buscarEmpProcCompra($this->proc_compra_id);
    $aRetorno = $this->buscarDespesasEmp($empresa);
    if(is_array($aRetorno)){
        for($i=0;$i < count($aRetorno);$i++){
            $despesaId = $aRetorno[$i]['emp_desp.despesa_id'];
            $valorPadrao = $aRetorno[$i]['emp_desp.vl_padrao'];
            $this->criarDespesaProcCompra($this->proc_compra_id, $despesaId, $valorPadrao);
        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularImpostosProcCompra($procCompraIdParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularImposto($proc_compra_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $vlImposto = 0;
    $lSemCalcImposto = false;
    if($empresa == ''){
        $empresa     = $this->buscarEmpProcCompra($this->proc_compra_id);
    }

    $vlTribItens = $this->buscarVlTribItens($this->proc_compra_id);
    $aDespesas   =  $this->buscarDespesasImposto($imposto,$empresa);
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
            $aLogImposto = $this->buscarDespesaLogImpostoOuCalc($despesaImp);
            $logImposto = $aLogImposto['log_imposto'];

            if($logImposto == 1){
                $logCalcImposto = $this->verificarCalcImpProcCompra($this->proc_compra_id,$novoCalculo,$despesaImp);
                if($logCalcImposto != 1){
                    $lSemCalcImposto = true;
                    $perc  = $this->buscarImpostoPerc($despesaImp,$empresa);
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarCalculoImpProcCompra($usuario_id = 0 )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarCalcImpProcCompra($proc_compra_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra','despesa_proc_compra_id',
                                   " proc_compra_id = $this->proc_compra_id and despesa_id = $despesa and
								     calc_imp_proc_compra_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCalculoImposto($novoCalculo,$proc_compra_id,	$imposto,$vlImposto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotDespesasProcCompra($procCompraID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $vlTot = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_proc_compra', 'sum(vl_prev) as tot'," proc_compra_id = $procCompraID ","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesasEmp($empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = array();

    $aRetorno = $this->retornoMultReg('pub.empresas_despesa emp_desp INNER JOIN pub.despesas desp
                               ON emp_desp.despesa_id = desp.despesa_id',
        'emp_desp.despesa_id, emp_desp.vl_padrao, desp.perc_calculo',
        " emp_desp.log_ativo = 1 and desp.log_imposto = 0
							  and emp_desp.empresa_id = $empresa","espec");

    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarImpostosEmpresa($empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.empresas_despesa, pub.despesas",
        "pub.despesas.despesa_id, pub.empresas_despesa.percentual",
        " pub.despesas.log_imposto = 1 
        and pub.despesas.despesa_id = pub.empresas_despesa.despesa_id 
        and pub.empresas_despesa.empresa_id = $empresa and pub.despesas.log_calc_por_item = 0","espec");
    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarImpostoPerc($despesa,$empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarImpostoPercCusto($despesaID,$empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosEmpresaDespesa($id,$campos,$filtroCompl)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarcodEmpresa($codigo,$sistOrigem,$sistDestino)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getEstabEms5($estab)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
         $rf = $this->Ini->nm_db_especw->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_especw->ErrorMsg());
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcDespesaCalculada($containerId,$despesaId,$aVlItens,$logGravarValores=true,$histOrigemDolar='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atuDespsCalcContainer($containerParam,$listaDespesas='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIdsDespesasCalcContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,$totNegociado,
                               $totProforma,$idCtaCorren=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aLogExistDespesa = $this->verificarDespesaContainer($container,$despesa,$itemContainerId);
    $logExistDespesa  = $aLogExistDespesa[0]['qt'];
    if($logExistDespesa <> 0 and $logExistDespesa <> '') {
        $this->atualizarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer, $totNegociado,$totProforma,
            $idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId) ;
    }else{
        $this->criarDespesaContainer($container,$despesa,$totTrib,$calcImpContainer,
            $totNegociado,$totProforma,$idCtaCorren,$memoriaCalculo,$percCalc,$itemContainerId);
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcBaseDespCalculada($containerId,$despesaId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosDespContainer($containerId,$despesaId,$campos='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = "  container_id = $containerId and despesa_id = $despesaId ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRet;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getValoresDespContainer($containerId,$despesaId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRet = $this->getDadosDespContainer($containerId,$despesaId,'vl_prev,vl_proforma,vl_negociado');
    return $aRet;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarDespesasContainer($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarDespesaContainer($containerId,$despesaId,$vlPrev,$calcImpId=0,$vlNegociado=0,$vlProforma=0,
                                   $idCtaCorrenDistr=0,$memoriaCalculo='',$percCalc=0,$itemContainerId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarVlDespesaContainerPorId($despesaContainerId,$vlPrev,$vlNegociado=0,$vlProforma=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setCamposDespesaContainer($despesaId,$containerId,$campos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setLogUtilizadoDespesaContainer($container,$listaDespesas)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aDespesas = explode(',',$listaDespesas);
    if(is_array($aDespesas)){
        $tam = count($aDespesas);
        for($i=0;$i<$tam;$i++){
            $despesaId = $aDespesas[$i];
            $this->setCamposDespesaContainer($despesaId,$container,'log_utilizado = 1');
        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarDespesaContainer($containerId,$despesaId,$itemContainerId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $tabela 	= "pub.despesas_container";
    $campo  	= "count(despesa_container_id) as qt";
    $condicao 	= "container_id = $containerId  and despesa_id = $despesaId and item_container_id = $itemContainerId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $id = 0;
    $tabela 	= "pub.despesas_container";
    $campo  	= "despesa_container_id";
    $condicao 	= "cta_corren_custo_distr_id = $ctaCorrenCustoDistrId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $id = $aRetorno[0]['despesa_container_id'];
    }
    return $id;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function excluirDespesaContainerDistrCusto($ctaCorrenCustoDistrId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarCalculoImpContainer($container_id,$usuario_id = 0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['cod_usuario_corrente'])) {$_SESSION['cod_usuario_corrente'] = "";}
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarCalcImpContainer($container_id,$calc_id,$despesa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.despesas_container','despesa_container_id',
        " container_id = $this->container_id and despesa_id = $despesa and
                                     calc_imp_container_id = $calc_id","espec");
    if(is_array($aRetorno)){
        $retorno = 1;
    }
    return $retorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function incrementarMenCalcImpContainer($calc_id,$mem_calc)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarCalculoImpContainer($novoCalculo,$container_id,$imposto,$aVlImposto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
     
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
    

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesaDistrCusto()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $despesaId = $this->buscarParametroIma('despesa_distr_custo');
    if($despesaId == ''){
        $despesaId = 0;
    }
    return $despesaId;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularImpostoContainer($container_id,$imposto,$percentual,$novoCalculo,$empresa = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarDespImpostoContainer($container,$idCalculo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularImpostosContainer($container_id,$idCalculo='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotDespesasContainer($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincronizarImpostos($container,$origem='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $novoCalculo = $this->criarCalculoImpContainer($container);
    $this->calcularImpostosContainer($container,$novoCalculo);
    $this->gerarDespImpostoContainer($container,$novoCalculo);
    $this->Ini->NM_gera_log_insert("User", "sincImp", "Sincronizacao Calculo de Impostos container:$container - Origem:$origem - Usuario:".$this->sc_temp_usr_login);

    $this->sincrIpiItensContainer($container);
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosDespesaContainer( $container, $despesa,$campos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec','despesas_container');
        $campos = $aCampos['campos'];
    }
    $tabela   = " pub.despesas_container ";
    $condicao = " container_id = $container and despesa_id = $despesa ";
    $aRet = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    return $aRet;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarDespesaContainerManual($container,$despesa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $log = 0;
    $aRet = $this->getDadosDespesaContainer($container,$despesa,'log_manual');
    if(is_array($aRet)){
        $log = $aRet[0]['log_manual'];
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlDespADistribuir($nivel, $idParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTotDespItemContainer($itemContainerId,$tipo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTotDespContainerRatItem($containerParam, $tipo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCpTipoVlDespContainer($tipo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularIpiItensContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function sincrIpiItensContainer($container)
    {
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcularIpiItemContainer($container, $itemContainerId,$despesaIpi,$aVls,$aVlBase='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function calcBaseDespesaContainer($container, $despesaId,$empresa=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIdDespesaIPI()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aReg = $this->getDadosDespesa(0,'despesa_id', 'ind_imposto = 3');
    if(is_array($aReg)){
        $id = $aReg[0]['despesa_id'];
    }else{
        $id = 0;
    }
    return $id;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarDespIPIEmpresa($despesaIpi,$codEmpresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logEmp = false;
    $aReg = $this->getDadosEmpresaDespesa(0,'',
        "despesa_id = $despesaIpi and empresa_id = $codEmpresa");
    if(is_array($aReg)){
        $logEmp = true;
    }
    return $logEmp;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function util_incr_valor($variavel,$incremento,$delimitador = ',', $logDesconsideraBranco=false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function dataAtual()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $dia= date('d');
    $mes= date('m');
    $ano= date('Y');
    $completa = "$dia/$mes/$ano";
    return array('dia' => $dia, 'mes' => $mes, 'ano' => $ano, 'completa' => $completa);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function intervaloData($dtHrIni,$dtHrFim,$tipoRetorno = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function incrementarVlSequenciaEspec($sequencia,$tabela)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
	return $valor;
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retirarAcento($palavra)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//IGNORE', $palavra ) );

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarDifValorListas($lista1, $lista2,$delimitador=',')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function formatarNumero($numero,$qtDecimais=2)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if(strstr($numero,'.') ==false){
        $numero = "$numero.00";
    }
    $numero = number_format($numero,$qtDecimais,',','.');
    return $numero;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convLogEmString($valor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($valor == true){
        $retorno = 'Sim';
    }else{
        $retorno = 'Nao';
    }
    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function convArrayToString($array)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = '';
    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function tratarAspasSimples($texto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $texto = str_replace("'","''",$texto);
    return $texto;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function retirarAcentoSimples($texto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function tratarNumero($num)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if(trim($num) == ''){
        $num = 0;
    }
    return $num;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function execOperMat(string $operacao, int $primeiroTermo, int $segundoTermo=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function exibirMsgErro($msg,$indTransformacao=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function limparVar($var,$caracteres,$separador=',')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aCaracteres  = explode($separador,$caracteres);
    foreach($aCaracteres as $caract){
        $var = str_replace($caract,'',$var);
    }
    return $var;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVendasContainer($containerId,$empresa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aSitPedTot = array();
    $lAchou = 0;
    switch(substr($empresa,0,1)){
        case '1':
            $banco = 'ima';
            break;
        case '5':
            $banco = 'med';
            break;
    }
    $tabela = ' espec.pub."ped-venda-ext" ,'.$banco.'.pub."ped-venda" ,'.$banco.'.pub."ped-item"  ';
    $campos = 'sum('.$banco.'.pub."ped-item"."qt-pedida" * '.$banco.'.pub."ped-item"."vl-preuni" ) as tot, 
              sum('.$banco.'.pub."ped-item"."vl-preuni"  *  '.$banco.'.pub."ped-item"."qt-pedida"  * ( mod ( 20 - '.$banco.'.pub."ped-venda"."cod-priori" | 10 )  /10 ) ) as desconto,
			  "cod-sit-ped" as sit_ped, "mo-codigo" as moeda';
    $condicao = 	" $banco.pub.\"ped-item\".\"nome-abrev\" = $banco.pub.\"ped-venda\".\"nome-abrev\"
   and $banco.pub.\"ped-item\".\"nr-pedcli\" = $banco.pub.\"ped-venda\".\"nr-pedcli\"
   and $banco.pub.\"ped-venda\".\"nr-pedido\" = espec.pub.\"ped-venda-ext\".\"nr-pedido\"
   and  $banco.pub.\"ped-venda\".\"cod-estabel\" = espec.pub.\"ped-venda-ext\".\"cod-estabel\"
   and  $banco.pub.\"ped-venda\".\"cod-sit-ped\" not in (6) 
   and  espec.pub.\"ped-venda-ext\".\"nr-container\" = $containerId
group by \"cod-sit-ped\", \"mo-codigo\" ";
    $aRetorno = $this->retornoMultReg($tabela,$campos,$condicao,'multi');
    if(is_array($aRetorno)){
        for($i = 0; $i < count($aRetorno);$i++){
            $valor 	= $aRetorno[$i]['tot'];
            $situacao  = $aRetorno[$i]['sit_ped'];
            $moeda     = $aRetorno[$i]['moeda'];
            $desconto  = $aRetorno[$i]['desconto'];
            $aSitPedTot[] = array("moeda"=> $moeda ,"cod_sit_ped" => $situacao, "valor" => $valor,"desconto" => $desconto);
            $lAchou = 1;
        }
    }
    if($lAchou == 0){
        $aSitPedTot = '';
    }
    return $aSitPedTot;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFaturItemContainer($item,$container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $qt = 0;
    $codEstab = $this->buscarEstabContainer($container);
    if($codEstab == 1){
        $conexao ='ems2ima';
    }
    else{
        $conexao = 'ems2med';
    }
    $dtNotaMae 	= $this->buscarDtEmisNotaMaeContainer($container);
    
    $listaPedidos = $this->buscarPedidosContainer($container);
    $tabela = "pub.\"it-nota-fisc\" item";
    $campo  	= ' sum(to_number(pro_element(item."qt-faturada"|1|1))) as qt';
    $condicao 	= " item.\"cod-estabel\" = '$codEstab' and item.\"dt-cancela\" is null
				and item.\"it-codigo\" = '$item' and item.\"nr-pedcli\" in ($listaPedidos)";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,$conexao);
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'] ;
    }
    if($qt == ''){
        $qt = 0 ;
    }
    return $qt;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarPedidosContainer($container){
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $listaPedidos = '';
    $comum = '';
    $tabela = ' pub."ped-venda-ext" ';
    $campo  = '"nr-pedido"';
    $condicao = "\"nr-container\" = $container";
    $aPedidos = $this->retornoMultReg($tabela,$campo,$condicao,'espec');
    if(is_array($aPedidos)){
        $tam = count($aPedidos);
        for($i = 0; $i < $tam;$i++){
            $nrPedido = $aPedidos[$i]['"nr-pedido"'];
            $comum = "'$nrPedido'";
            if($listaPedidos  == '' ){
                $listaPedidos = $comum;
            }
            else{
                $listaPedidos .= ",".$comum;
            }
        }
    }
    return $listaPedidos;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function preencherIDLog($aplicacao='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setIdLogAPlCorrente()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aplCorrente = $this->Ini->nm_cod_apl;
    $this->preencherIDLog($aplCorrente);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarLinkLog($tipo,$idChave=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function iniciarTransLog($programa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
   $transLog = getDate();
   $idTransLog = $transLog[0];
   $this->setArqTransLog($idTransLog,$programa);


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setArqTransLog($transLog,$programa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
  
    $this->setProgramaCorrenteLog($programa);

    $_SESSION['trans_log'][$programa]['arquivo'] = "$this->sc_temp_usr_login_{$programa}_{$transLog}.html";
    $this->criarArqLog($_SESSION['trans_log'][$programa]['arquivo']);

if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getArqTransLog($programa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log'][$programa]['arquivo'])){
        $retorno = $_SESSION['trans_log'][$programa]['arquivo'];
    }else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setProgramaCorrenteLog($programa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $_SESSION['trans_log']['programa_corrente'] = $programa;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getProgramaCorrenteLog()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if(isset($_SESSION['trans_log']['programa_corrente'] )){
        $retorno = $_SESSION['trans_log']['programa_corrente'];
    } else{
        $retorno = '';
    }
    return ;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirLog($log,$arquivo='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function linkLogAtual()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function criarArqLog($arquivo)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
     $dataAtual =date('d/m/Y G:i:s');
    $conteudo = "<h1>Inicio:$dataAtual</h1>";
     $aDir = $this->getDirCompletoArqsLog();
     $dir = $aDir['diretorio'];
     $separador = $aDir['separador'];
     $arqCompleto = "{$dir}{$separador}{$arquivo}";
     file_put_contents($arqCompleto,$conteudo);


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDirCompletoArqsLog()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
   $dirCriar    = $this->getDirArqsLog();
   $dirCorrente = getcwd();

   $aDiretorio  = voltarNivelDir($dirCorrente,1);
   $diretorio   = $aDiretorio['diretorio'];
   $separador   = $aDiretorio['separador'];
   $diretorio  .= "{$separador}{$dirCriar}";
   $aRetorno    = array('diretorio' => $diretorio, 'separador' => $separador);
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDirArqsLog()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return 'log';

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescFornecedor($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarNomeAbrevFornecedor($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarParametroIma($parametro,$vlPadrao='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getMinutosVenctoPe()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $listaGrupos = getGruposUsuario(getLoginCorrente());
    if(strstr($listaGrupos,'2')<> false){ 
      $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE_LOJA';
    } else{
        $parametro = 'PORTAL_MINUTOS_DESALOCAR_PE';
    }

    $ret = $this->buscarParametroIma($parametro);
    return $ret;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getMinutosVenctoPi()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $parametro = 'PORTAL_MINUTOS_DESALOCAR_PI';
    $ret = $this->buscarParametroIma($parametro);
    return $ret;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getHabilitarBonusRepres()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logBonus = 0;
    $param = $this->buscarParametroIma('habilitar_bonus_comissao');
    if($param <> ''){
        $logBonus = $param;
    }
    return $logBonus;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getBase()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $base = '';
    $param = $this->buscarParametroIma('base');
    if($param <> ''){
        $base = $param;
    }
    return $base;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getMudancaMoeda()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $logMudaMoeda = 0;
    $param = $this->buscarParametroIma('pv_mudar_moeda');
    if($param <> ''){
        $logMudaMoeda = $param ;
    }
    return $logMudaMoeda;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getParamPrecoTbERP()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_erp',1);
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getPrecoTbLiquidaIma()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('buscar_preco_tb_liquida_ima',1);
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getParamGrupoAvalAdm()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('grupo_aval_adm',12);
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getPercRedTbRubi()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('perc_reduc_tb_rubi',50);
    return $param;



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getIdTbRubi()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tb_rubi_id',2);
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getAutLogDb()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aut_log_db','670477Im@');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUserLogDb()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('user_log_db','sa');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function credBdConsultas()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cred_bd_consulta','670477Im@');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDirArqOutlet()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_outlet','');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCaminhoArqCampanha()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_arq_campanha',
        '/var/www/clients/client1/web2/web/iol_homolog/_lib/file/doc');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlMinFreteCIFSudeste($moeda)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif_sudeste',
            '1500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_sudeste_dolar',
            '300');

    }
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlMinFreteCIF($moeda)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($moeda == 1 or $moeda == 'real'){
        $param = $this->buscarParametroIma('vl_min_cif',
            '2500');
    }else{
        $param = $this->buscarParametroIma('vl_min_cif_dolar',
            '600');

    }
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDirTmpBook()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('dir_tmp_book',
        '/var/www/clients/client1/web2/web/tmp');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUrlServico()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('url_api_totvs',
        '192.168.0.38:8180/api/');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUserApiTotvs()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('usuario_api_totvs',
        'apitotvs');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getSenhaApiTotvs()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('senha_api_totvs',
        'api');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVersaoApiHomolog()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('versao_api_homolog',
        'v99');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getApiHistAvalPedVenda()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('api_histAvalPedVenda',
        'pdp/v1/histAvalPedVenda');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPe()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pe',
        '1');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWebPi()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('aprovar_ger_ped_web_pi',
        '1');
    return $param;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getAprovGerenciaPedWeb($tipoPed)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($tipoPed == 'pe'){
        $ret =$this->getAprovGerenciaPedWebPe();
    }else{
      $ret = $this->getAprovGerenciaPedWebPi();
    }
    return $ret;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getParametros()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRet = $this->getDados('multi',
                    'pub."im-param"',
                    '"cod-param","val-param"',
                    '1=1',
            'api');
    return $aRet;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atualizarParametros()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    limparVarSessao($this->getNomeVarParams());
    $this->setParamsSessao();

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setParamsSessao()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aParams = $this->getParametros();
    foreach($aParams as $reg)
    {
        $codParam = $reg['cod-param'];
        $vlParam  = $reg['val-param'];
        setVarSessao($codParam,$vlParam,0,0,$this->getNomeVarParams());

    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getNomeVarParams()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return 'im_param';

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getConsiderarDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('considerar_deposito_fechado','1');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getEstabDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_estab_deposito_fechado','504');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCodDeposDepositoFechado()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('cod_depos_deposito_fechado','ter');
    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getTiposVersaoValidNFMae()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $param = $this->buscarParametroIma('tipo_versao_valida_nf','4,5');

    return $param;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getParamDistrCusto()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('gerar_distr_custo',0);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getQtDiasCalcPrevChegadaPedImp()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('qt_dias_calc_cheg_ped',
        "60", true);

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaNatOperNotaMae()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_mae','');

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaNatOperNotaCompl()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    return $this->buscarParametroIma('nat_operacao_nf_compl','');

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCamposContainer($container,$campos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"',
        $campos,
        "\"nr-container\" = $container ",'espec');
    return $aRetorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $descricao = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"nr-container","nome-ab-forn", "cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $descricao = $aRetorno[0]['"nr-container"']."-".$aRetorno[0]['"cod-emit-forn"']."(".$aRetorno[0]['"nome-ab-forn"'].")";
    }
    return $descricao;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCotacaoVendaContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCotacaoCompraContainer($containerID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $valor= 1;
    $campoRetorno = '"vl-dolar-compra"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDolarDIContainer($containerID)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $valor = 1;
    $campoRetorno = '"vl_dolar_di"';
    $condicao = '"nr-container" ='.$containerID ;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', $campoRetorno, $condicao,'espec');
    if(is_array($aRetorno))	{
        $valor = $aRetorno[0]["$campoRetorno"];
    }
    if($valor == 0){$valor = 1; }
    return $valor;



$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDolar($containerId,$tipoDolar,$logDesprezaDolarMedio = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarEmpContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarEstabContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
    $estab = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' "cod-estabel" ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $estab = $aRetorno[0]['"cod-estabel"'];
    }
    return $estab;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarSitDistrCustoContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', ' log_gerar_distr_custo ',
        " \"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno)){
        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFornecedorContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $fornecedor = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', '"cod-emit-forn"',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $fornecedor = $aRetorno[0]['"cod-emit-forn"'];
    }
    return $fornecedor;




$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarSituacoesContainer($container_id)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aSituacoes = '';
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'situacao,situacao_container_id',
        "\"nr-container\" = $this->container_id ",'espec');
    if(is_array($aRetorno))	{
        $aSituacoes = array('situacao' => $aRetorno[0]['situacao'],
            'situacao_container_id' => $aRetorno[0]['situacao_container_id']);
    }
    return $aSituacoes;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarSitDistrSituacaoContainer($situacao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $log = 0;
    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', 'log_gerar_distr_custo',
        "situacao_container_id = $situacao ",'espec');
    if(is_array($aRetorno)) {

        $log = $aRetorno[0]['log_gerar_distr_custo'];
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCamposSituacaoContainer($situacao,$campos)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $aRetorno = $this->retornoSimplesTb01('pub.situacoes_container', $campos,
        "situacao_container_id = $situacao ",'espec');

    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDtRegContainer($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarEmpERPContainer($containerId,$sistema)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarLiberCustoContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $log = false;
    $aRetorno = $this->retornoSimplesTb01('pub."pp-container"', 'log_liberar_custo_realizado',
        "\"nr-container\" = $container ",'espec');
    if(is_array($aRetorno))	{
        $log = $aRetorno[0]['log_liberar_custo_realizado'];
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarGeracaoDistrCusto($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDolarMedio($container,$logSaldoNeg = false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setDtPrevEmbarque($containerID,$dtPrevEmbarque)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarPercCustoContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $campo = 'perc_custo';
    $aContainer = $this->buscarCamposContainer ($container,$campo);
    if(is_array ($aContainer)){
        $percCusto = $aContainer[0][$campo];
    }else{
        $percCusto = 0;
    }
    return $percCusto;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDescTipoProjDolar($tipoProj)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosContainer($container,$campos='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    if($campos == ''){
        $aCampos = $this->getCpsTbSessao('espec',"pp-container");
        $campos = $aCampos['campos'];
    }
    $aReg = $this->buscarCamposContainer($container,$campos) ;
    return $aReg;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function setCustoContainerDesatualiz($containerParam,$iSit)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVersaoCustoDesatu($containerParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aContainer = $this->getDadosContainer($containerParam,'log_versao_custo_desatualizada,dt_hr_ult_alt_versao_custo' );
    return $aContainer;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDifTempoVersaoCusto($containerParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $qtDias = 0;
    $data = $this->getDataUltVersaoCustoContainer($containerParam);
    if($data <> ''){
        $dataAtual = date('Y-m-d');
        $qtDias = $this->nm_data->Dif_Datas($dataAtual, "aaaa-mm-dd", $data, "aaaa-mm-dd");
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaContainersDesatualizCotacao()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function atuDesatualizContainerCotacao()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $listaContainer = $this->getListaContainersDesatualizCotacao();
    $aContainer     = explode(',',$listaContainer);
    if(is_array($aContainer)){
        $tam = count($aContainer);
        for($i=0;$i<$tam;$i++){
            $container = $aContainer[$i];
            $this->setCustoContainerDesatualiz($container,1);
        }
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function dependenciasContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $erro = '';
    $logPPItemContainer = $this->verExistPpItemContainer($container);
    if($logPPItemContainer == true) {
        $erro = "Não é possível excluir o container, pois, itens de venda já foram 
        digitados pelo setor comercial";
    }
    return $erro;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verExistPpItemContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $log = false;
    $aReg = $this->getDados('unico',' pub."pp-it-container"', ' top 1 "it-codigo","cod-refer"',
             "\"nr-container\" = $container",'espec');
    if(is_array($aReg)){
        $log = true;
    }
    return $log;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirVersaoCusto($containerParam,$tipoVersao,$descricao)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gerarAutVersaoCusto($containerParam,$descComplementar)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aReg = $this->getUltVersao();
    if(is_array($aReg)){
        $tipoVersao  =  $aReg[0]['tipo_versao_id'];
        $versaoId    =  $aReg[0]['versao_id'];
        $descricao   =  "Versão gerada automaticamente a partir da versão $versaoId $descComplementar";
        $this->inserirVersaoCusto($containerParam,$tipoVersao,$descricao);
    }

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getUltVersao()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container) ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosVersaoCusto($id,$campos='',$filtroCompl)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoCusto($versaoId,$logSincrImpostos=1,$logDespCalc=1)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function completarVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoCustoDadosContainer($versaoId,$container='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarContainerVersaoCusto($versaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'container_id';
    $condicao = "versao_id = $versaoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $container;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function verificarVersaoCustoIncompleta()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $versaoId = 0;
    $tabela   = 'pub.versoes_item_custo_container';
    $campo     = 'versao_id';
    $condicao = " ind_sit_versao = 1";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campo,$condicao,"espec");
    if(is_array($aRetorno)){
        $container = $aRetorno[0]["$campo"];
    }
    return $versaoId;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDespesas($versaoId,$container='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDespesas($versaoId,$despesaId,$vlPrev,$vlNegociado,$vlProforma,$vlBaseImp,$calcImpContainerId,$logCusto)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCusto($versaoId,$container='',$logGerarDistrCusto=false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoCustoNfs($versaoId,$container='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirVersaoCustoNfs($versao,$documento,$serie,$natOperacao,$codEmitente,$vlMercadoria,$vlDespesa)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoPagtos($versaoId,$container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirVersaoCustoPagtos($versao,$numIdTitAp,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarContainerVersao($versaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $container = 0;
    $tabela 	= 'pub.versoes_item_custo_container';
    $campo  	= 'container_id';
    $condicao	= "versao_id = $versaoId";
    $aRetorno   = $this->retornoSimplesTb01($tabela,$campo,$condicao);
    if(is_array($aRetorno)){
        $container = $aRetorno[0][$campo];
    }
    return $container;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDadosUltVersaoCustoContainer($container,$itemContainerId='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDataUltVersaoCustoContainer($containerParam)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarUltVersaoCustoContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $versao = 0;
    $tabela = 'pub.versoes_item_custo_container';
    $campos =  'select max(versao.versao_id) as ult';
    $condicao = " versao.container_id = $container ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $versao = $aRetorno[0]['ult'];
    }
    return $versao;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getDadosVersaoCorrenteContainer($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $filtro = " versao_id in (select max(versao_id) 
                from pub.versoes_item_custo_container
                where container_id = $container)
                ";
    $aReg   = $this->getDadosVersaoCusto(0,'',$filtro);
    return $aReg;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotDistrItemCustoContainer($itemContainer)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $tot = 0;
    $tabela = 'pub.item_container_custos';
    $campos =  'sum(vl_custo_distribuido) as tot';
    $condicao = " item_container_id = $itemContainer ";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao);
    if(is_array($aRetorno)){
        $tot = $aRetorno[0]['tot'];
    }
    return $tot;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function gravarVersaoItemContainerCustoDescontos($versaoId,$container='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function inserirVersaoItemContainerCustoDescontos($versaoId,$descontoId,$vlReal,$vlDolar)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDadosDescontos($descontoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  

    $tabela   = "pub.descontos_importacao";
    $campos   = 'motivo_desconto_id, descricao, log_credito, cod_tipo, dt_autorizacao, fornecedor_id';
    $condicao = " desconto_importacao_id = $descontoId";
    $aRetorno = $this->retornoSimplesTb01($tabela,$campos,$condicao,"espec");
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlsDescontosPorFornecedor($fornecedor=0 )
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescontosUtiliz($container,$itemContainerId='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescontosCreditosUtiliz($container){
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarVlAprovadoEmReal($vlReal,$vlRealAutoriz)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlRealAutoriz > $vlReal){
        $erro = 'ERRO.O Valor Aprovado em Real não pode ser maior que o Valor Solicitado em Real';
    }
    return $erro;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarVlAprovadoEmDolar($vlDolar,$vlDolarAutoriz)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $erro = '';
    if($vlDolarAutoriz > $vlDolar){
        $erro = 'ERRO. O Valor Aprovado em Dólar não pode ser maior que o Valor Solicitado em Dólar';
    }
    return $erro;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function validarVlsAutorizacao($vlDolarAutoriz, $vlRealAutoriz, $dtAutoriz)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlSaldoUtilizar($descontoImportacaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = 0;
    $vlDolar = $this->buscarVlDolarAutorizDesconto($descontoImportacaoId);
    $vlUtilizado = $this->buscarDescontoTotalUtilizado($descontoImportacaoId);
    $retorno = $vlDolar - $vlUtilizado;

    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDescontoTotalUtilizado($descontoImportacaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
     $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.cta_corren_desconto ',
                                   ' sum(valor_utilizado) as valor ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["valor"];
    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarVlDolarAutorizDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
                                   ' vl_dolar_autorizado ',
                                   "  desconto_importacao_id = $descontoImportacaoId ",'espec');
    if(is_array($aRetorno))
        $retorno = $aRetorno[0]["vl_dolar_autorizado"];

    return $retorno;


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarFornecDesconto($descontoImportacaoId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $retorno = 0;
    $aRetorno = $this->retornoSimplesTb01(' pub.descontos_importacao ',
        ' fornecedor_id ',
        " desconto_importacao_id = $descontoImportacaoId ", 'espec');
    if (is_array($aRetorno))
        $retorno = $aRetorno[0]["fornecedor_id"];

    return $retorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getVlDescAutorizado($fornecedor)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarValoresNFs($estab,$documento,$serie,$natOperacao,$codEmitente)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarNfAssociadasContainer($nrContainer)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoMultReg("pub.nfs_container","documento, serie, estab, nat_operacao, cod_emitente", "container_id = $nrContainer",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $aRetorno = $this->retornoSimplesTb01("pub.nfs_container",
        "documento, serie, estab, nat_operacao, cod_emitente",
        "container_id = $nrContainer and substring(nat_operacao,1,1) ='3'",'espec');
    return $aRetorno;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDtEmisNotaMaeContainer($nrContainer)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarQtRecContainer($containerId,$item)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarNfsPorEmbarque($nrEmbarque)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    




$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespesasRealizadas($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    

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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarValoresItensNFImp($containerId,$item = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarDespRealizadasItens($containerId,$item='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCustoCOFINSNFMae($container,$item='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarCustoPISNFMae($container, $item = '')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotTribContainer($container,$tipo='tributado')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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


$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotDifImp($container, $tipo,$tipoComp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    $vlTipo = $this->buscarTotTribContainer($container,$tipo);
    $vlTipoComp = $this->buscarTotTribContainer($container,$tipoComp);
    $vlSaldoDistr = $vlTipo - $vlTipoComp;
    return $vlSaldoDistr;

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTitAssociadosContainer($containerId)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotPagoContainer($containerId,$moeda='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function buscarTotPagoLista($codEstab,$lista,$moeda='')
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function preencherCondPagtoContainer($condicaoTitAP,$logPgtoPosDI=false)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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

if (isset($this->sc_temp_fornecedor_container_corrente)) {$_SESSION['fornecedor_container_corrente'] = $this->sc_temp_fornecedor_container_corrente;}
if (isset($this->sc_temp_empresa_container_corrente_ems5)) {$_SESSION['empresa_container_corrente_ems5'] = $this->sc_temp_empresa_container_corrente_ems5;}
if (isset($this->sc_temp_container_corrente)) {$_SESSION['container_corrente'] = $this->sc_temp_container_corrente;}
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function existTitContainer($numIdTitAp,$containerId=0)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getcontainerPagto($numIdTitAp)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function associarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function desassociarTituloContainer($numIdTitAp,$container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
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
      
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getCotacaoUltPagto($container)
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
  
    
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

$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
}
function getListaTitAssocContainer()
{
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
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
                  $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao'][substr($val, 1, -1)];
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
      if (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../")
      {
          echo "<SCRIPT language=\"javascript\">";
          if (strtolower($target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
              echo "</SCRIPT>";
              return;
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
              echo "</SCRIPT>";
              exit;
          }
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
           if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['embutida_form_full']) || (isset($this->grid_emb_form_full) && $this->grid_emb_form_full))
           {
              $this->redir_modal = "$(function() { parent.tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
           else
           {
              $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') }) \r\n";
           }
          return;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['iframe_print']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['iframe_print'] )
      {
          $target = "_parent";
      }
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
     <!DOCTYPE html>
      <HTML>
      <HEAD>
      <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0," />
<?php
}
?>
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
      </HEAD>
      <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
      <BODY>
   <?php
      }
   ?>
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
      <SCRIPT type="text/javascript">
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
   <?php
      if (!isset($this->SC_redir_btn) || !$this->SC_redir_btn)
      {
   ?>
      </BODY>
      </HTML>
   <?php
      }
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
  function close_emb()
  {
      if ($this->Db)
      {
          $this->Db->Close(); 
      }
      if(isset($this->Ini->nm_db_especw)){ 
        $this->Ini->nm_db_especw->Close(); 
      }
      if(isset($this->Ini->nm_db_ems5w)){ 
        $this->Ini->nm_db_ems5w->Close(); 
      }
      if(isset($this->Ini->nm_db_comumw)){ 
        $this->Ini->nm_db_comumw->Close(); 
      }
      if(isset($this->Ini->nm_db_multi)){ 
        $this->Ini->nm_db_multi->Close(); 
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_fast'] = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'])) 
          {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig']; 
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'] . ")"; 
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'] = $tmp_cmd;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['fast_search']);
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "item_container_id") 
          {
              $this->SC_monta_condicao($comando, "item_container_id", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "container_id") 
          {
              $this->SC_monta_condicao($comando, "container_id", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "item_proc_compra_id") 
          {
              $this->SC_monta_condicao($comando, "item_proc_compra_id", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "qt_alocada") 
          {
              $this->SC_monta_condicao($comando, "qt_alocada", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "qt_confirm_emb") 
          {
              $this->SC_monta_condicao($comando, "qt_confirm_emb", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "qt_recbto_fisico") 
          {
              $this->SC_monta_condicao($comando, "qt_recbto_fisico", $arg_search, str_replace(",", ".", $data_search));
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_fast'] = $comando;
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq_filtro'] . ")"; 
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['where_pesq'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['fast_search'][0] = $in_fields;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['fast_search'][2] = $sv_data;
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
      $nm_numeric[] = "item_container_id";$nm_numeric[] = "container_id";$nm_numeric[] = "item_proc_compra_id";$nm_numeric[] = "qt_alocada";$nm_numeric[] = "qt_confirm_emb";$nm_numeric[] = "qt_recbto_fisico";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['decimal_db'] == ".")
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
  function html_doc_word($nm_arquivo_doc_word, $nmgp_password)
  {
      global $nm_url_saida;
      $Word_password = "";
      if ($this->Ini->Export_zip || $Word_password != "")
      { 
          $Parm_pass  = ($Word_password != "") ? " -p" : "";
          $Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'], ".");
          if ($Pos !== false) {
              $Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'], 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_doc = $nm_arquivo_doc_word;
          $Pos = strrpos($nm_arquivo_doc_word, ".");
          if ($Pos !== false) {
              $Arq_doc = substr($nm_arquivo_doc_word, 0, $Pos);
          }
          $Arq_doc  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'], ' ')) ? " \"" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'] . "\"" :  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'];
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
               unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file']);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file'] = $Arq_zip;
               $nm_arquivo_doc_word = $Arq_doc;
          } 
      } 
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao']['word_file']);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_doc_word);
          $Temp = ob_get_clean();
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
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
<SCRIPT>
    window.location='<?php echo $this->Ini->path_imag_temp . "/" . $nm_arquivo_doc_word; ?>';
</SCRIPT>
</BODY>
</HTML>
<?php
  }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      global $nm_url_saida;
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_html;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_itens_container_comparacao'][$path_doc_md5][1] = substr($nm_arquivo_html, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'] . "/");
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
   if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['sc_process_barr'])) {
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
   $_SESSION['scriptcase']['grid_itens_container_comparacao']['contr_erro'] = 'off';
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
            nm_limpa_str_grid_itens_container_comparacao($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_itens_container_comparacao($nmgp_var, $nmgp_val);
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
            nm_limpa_str_grid_itens_container_comparacao($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_itens_container_comparacao($nmgp_var, $nmgp_val);
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
       elseif (is_file($root . $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['grid_itens_container_comparacao']['glo_nm_path_imag_temp'] . "/sc_apl_default_Importacao.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "grid_itens_container_comparacao") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_Importacao'])) {
               $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_Importacao'];
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
   if (isset($container_corrente)) 
   {
       $_SESSION['container_corrente'] = $container_corrente;
   }
   if (isset($moeda_grid_itens_container_comparacao)) 
   {
       $_SESSION['moeda_grid_itens_container_comparacao'] = $moeda_grid_itens_container_comparacao;
   }
   if (isset($log_dolar_medio_corrente)) 
   {
       $_SESSION['log_dolar_medio_corrente'] = $log_dolar_medio_corrente;
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
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_pai']))
   {
       $apl_pai = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_pai'];
       if (isset($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho']))
       {
           foreach ($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho'] as $init_filho)
           {
               if (isset($_SESSION['sc_session'][$init_filho]['grid_itens_container_comparacao']['master_pai']) && $_SESSION['sc_session'][$init_filho]['grid_itens_container_comparacao']['master_pai'] == $script_case_init)
               {
                   $script_case_init = $init_filho;
                   break;
               }
           }
       }
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form'] && !isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['master_pai']))
   {
       $SC_init_ant = $script_case_init;
       $script_case_init = rand(2, 10000);
       if (isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_pai']))
       {
           $_SESSION['sc_session'][$SC_init_ant][$_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_pai']]['embutida_filho'][] = $script_case_init;
       }
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['master_pai'] = $SC_init_ant;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['master_pai']))
   {
       $SC_init_ant = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['master_pai'];
       if (!isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_parms']))
       {
           $_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_parms'] = "";
       }
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms'] = $_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_parms'];
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form'] = true;
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_full'] = (isset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_full'])) ? $_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_full'] : false;
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['reg_start'] = "";
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = "inicio";
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form']);
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_itens_container_comparacao']['embutida_form_parms']);
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms'])) 
   {
       if (!empty($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms'])) 
       {
           $nmgp_parms = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms'];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms'] = "";
       }
   }
   elseif (isset($script_case_init))
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_full']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_parms']);
   }
   if (!isset($nmgp_opcao) || !isset($script_case_init) || ((!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']) && $nmgp_opcao != "formphp"))
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
                    nm_limpa_str_grid_itens_container_comparacao($cadapar[1]);
                    nm_protect_num_grid_itens_container_comparacao($cadapar[0], $cadapar[1]);
                    if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                    $Tmp_par   = $cadapar[0];
                    $$Tmp_par = $cadapar[1];
                }
           }
           if (isset($container_corrente)) 
           {
               $_SESSION['container_corrente'] = $container_corrente;
               nm_limpa_str_grid_itens_container_comparacao($_SESSION["container_corrente"]);
           }
           if (isset($moeda_grid_itens_container_comparacao)) 
           {
               $_SESSION['moeda_grid_itens_container_comparacao'] = $moeda_grid_itens_container_comparacao;
               nm_limpa_str_grid_itens_container_comparacao($_SESSION["moeda_grid_itens_container_comparacao"]);
           }
           if (isset($log_dolar_medio_corrente)) 
           {
               $_SESSION['log_dolar_medio_corrente'] = $log_dolar_medio_corrente;
               nm_limpa_str_grid_itens_container_comparacao($_SESSION["log_dolar_medio_corrente"]);
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
               unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']);
               $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['b_sair'] = false;
           }   
       } 
   } 
   if (!isset($nmgp_opcao)) {
      $nmgp_opcao = "";
   }
   $ini_embutida = "";
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'])
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
        if (!isset($_SESSION['sc_session'][$ini_embutida]['grid_itens_container_comparacao']['embutida']))
        { 
           $_SESSION['sc_session'][$ini_embutida]['grid_itens_container_comparacao']['embutida'] = false;
        }
        if (!$_SESSION['sc_session'][$ini_embutida]['grid_itens_container_comparacao']['embutida'])
        { 
           $script_case_init = $ini_embutida;
        }
   }
   if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['protect_modal']) && !empty($_SESSION['scriptcase']['grid_itens_container_comparacao']['protect_modal']))
   {
       $script_case_init = $_SESSION['scriptcase']['grid_itens_container_comparacao']['protect_modal'];
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_emb    = false;
   $salva_iframe = false;
   if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu']);
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']))
   {
       $salva_emb = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']);
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "grid_itens_container_comparacao";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'grid_itens_container_comparacao' || $achou)
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
        $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu'] = $salva_iframe;
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['doc_word'] = false;
   $_SESSION['scriptcase']['saida_word'] = false;
   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_charts'] = false;
   }
   if (isset($_REQUEST['sc_create_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['skip_charts'] = 'N' == $_REQUEST['sc_create_charts'];
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'] = $salva_emb;

   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '/grid_itens_container_comparacao/'))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize'] = false;
   }
   if ($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['initialize'])
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['tot_geral']);
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['contr_total_geral'] = "NAO";
   }

   $_POST['script_case_init'] = $script_case_init;
   if (!isset($nmgp_opcao) || empty($nmgp_opcao) || $nmgp_opcao == "grid" && (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['b_sair'])))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['b_sair'] = true;
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
   if (isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['lang'])) {
       $STR_lang = $_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['lang'];
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
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'grid_itens_container_comparacao')
   {
       $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/grid_itens_container_comparacao_erro.php");
   }
   $salva_tp_saida  = (isset($_SESSION['scriptcase']['sc_tp_saida']))  ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
   $salva_url_saida  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
   if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_itens_container_comparacao']))
   { 
       return;
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'] && $nmgp_opcao != "formphp")
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
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_change_lang'] = true;
           unset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['tot_geral']);
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['contr_total_geral'] = "NAO";
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
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['num_css'] = rand(0, 1000);
       } 
       if ($nmgp_opcao == "volta_grid")  
       { 
           $nmgp_opcao = "igual";  
       }   
       if (!empty($nmgp_opcao))  
       { 
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = $nmgp_opcao ;  
       }   
       if (isset($_POST["container_corrente"])) 
       {
           $_SESSION["container_corrente"] = $_POST["container_corrente"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["container_corrente"]);
       }
       if (isset($_GET["container_corrente"])) 
       {
           $_SESSION["container_corrente"] = $_GET["container_corrente"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["container_corrente"]);
       }
       if (!isset($_SESSION["container_corrente"])) 
       {
           $_SESSION["container_corrente"] = "";
       }
       if (isset($_POST["moeda_grid_itens_container_comparacao"])) 
       {
           $_SESSION["moeda_grid_itens_container_comparacao"] = $_POST["moeda_grid_itens_container_comparacao"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["moeda_grid_itens_container_comparacao"]);
       }
       if (isset($_GET["moeda_grid_itens_container_comparacao"])) 
       {
           $_SESSION["moeda_grid_itens_container_comparacao"] = $_GET["moeda_grid_itens_container_comparacao"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["moeda_grid_itens_container_comparacao"]);
       }
       if (!isset($_SESSION["moeda_grid_itens_container_comparacao"])) 
       {
           $_SESSION["moeda_grid_itens_container_comparacao"] = "";
       }
       if (isset($_POST["log_dolar_medio_corrente"])) 
       {
           $_SESSION["log_dolar_medio_corrente"] = $_POST["log_dolar_medio_corrente"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["log_dolar_medio_corrente"]);
       }
       if (isset($_GET["log_dolar_medio_corrente"])) 
       {
           $_SESSION["log_dolar_medio_corrente"] = $_GET["log_dolar_medio_corrente"];
           nm_limpa_str_grid_itens_container_comparacao($_SESSION["log_dolar_medio_corrente"]);
       }
       if (!isset($_SESSION["log_dolar_medio_corrente"])) 
       {
           $_SESSION["log_dolar_medio_corrente"] = "";
       }
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['mostra_edit'])) 
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['mostra_edit'] = "S";
       }
       if (isset($nmgp_lig_edit_lapis)) 
       {
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['mostra_edit'] = $nmgp_lig_edit_lapis;
           unset($GLOBALS["nmgp_lig_edit_lapis"]) ;  
           if (isset($_SESSION['nmgp_lig_edit_lapis'])) 
           {
               unset($_SESSION['nmgp_lig_edit_lapis']);
           }
       }
       if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'] = true;
       }
       $nm_saida = "";
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_modal']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_modal'] = false;
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_apl']) && !empty($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_apl']))
       {
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_apl']; 
           $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_tp']; 
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_apl'] = "";
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['volta_redirect_tp'] = "";
           $nm_url_saida = "grid_itens_container_comparacao_fim.php"; 
       
       }
       elseif (substr($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] != "pdf" ) 
       {
           if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'])
           {
               if ($nmgp_url_saida == "modal")
               {
                   $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_modal'] = true;
               }
               $nm_url_saida = "grid_itens_container_comparacao_fim.php"; 
           }
           else
           {
               $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
               $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida);
               if (!empty($nmgp_url_saida)) 
               { 
                   $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['retorno_cons'] = $nmgp_url_saida ; 
               } 
               if (!empty($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['retorno_cons'])) 
               { 
                   $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['retorno_cons']  . "?script_case_init=" . NM_encode_input($script_case_init);  
                   $nm_apl_dependente = 1 ; 
               } 
               if (!empty($nm_url_saida)) 
               { 
                   $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida ; 
               } 
               $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
               $nm_url_saida = "grid_itens_container_comparacao_fim.php"; 
               $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
               if ($nm_apl_dependente == 1) 
               { 
                   $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
               } 
           } 
       }
// 
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && substr($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] != "pdf" ) 
       { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
            $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['menu_desenv'] = true;   
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
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['form_psq_ret']  = $todo[0];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['campo_psq_ret'] = $todo[1];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['dado_psq_ret']  = $todo[2];
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['js_apos_busca'] = $nm_evt_ret_busca;
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_psq'] = true;   
           if (isset($nmgp_iframe_ret)) {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_ret_cap'] = $nmgp_iframe_ret;
           }
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['psq_edit'] = 'N';   
           if (isset($nmgp_perm_edit)) {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['psq_edit'] = $nmgp_perm_edit;
           }
       } 
       elseif (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_psq']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_psq']  = false;   
           $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['psq_edit'] = 'N';   
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form'])
       {
           if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_full']) || !$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form_full'])
           {
               $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['mostra_edit'] = "N";   
           } 
           $_SESSION['scriptcase']['sc_tp_saida']  = $salva_tp_saida;
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $salva_url_saida;
       } 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_container_comparacao'] = "on";
       } 
       if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
       { 
           $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_container_comparacao'] = "on";
       } 
       if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opc_psq'] && !isset($_SESSION['scriptcase']['grid_itens_container_comparacao']['session_timeout']['redir'])) 
       { 
          if (!isset($_SESSION['scriptcase']['sc_apl_seg']['grid_itens_container_comparacao']) || $_SESSION['scriptcase']['sc_apl_seg']['grid_itens_container_comparacao'] != "on")
          { 
              $NM_Mens_Erro = $Nm_lang['lang_errm_unth_user'];
              $nm_botao_ok = ($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['iframe_menu']) ? false : true;
              if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
              {
                  foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
                  {
                      if (in_array("grid_itens_container_comparacao", $apls_aba))
                      {
                          $nm_botao_ok = false;
                           break;
                      }
                  }
              }
              if ((isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida']) || (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida_form']))
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
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
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
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['sc_outra_jan'])
       {
           $nm_apl_dependente = 0;
       }
       $contr_grid_itens_container_comparacao = new grid_itens_container_comparacao_apl();

      if ('ajax_autocomp' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = "busca";
          $contr_grid_itens_container_comparacao->NM_ajax_flag = true;
          $contr_grid_itens_container_comparacao->NM_ajax_opcao = $NM_ajax_opcao;
      }
      if ('ajax_filter_save' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = "busca";
          $contr_grid_itens_container_comparacao->NM_ajax_flag = true;
          $contr_grid_itens_container_comparacao->NM_ajax_opcao = "ajax_filter_save";
      }
      if ('ajax_filter_delete' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = "busca";
          $contr_grid_itens_container_comparacao->NM_ajax_flag = true;
          $contr_grid_itens_container_comparacao->NM_ajax_opcao = "ajax_filter_delete";
      }
      if ('ajax_filter_select' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] = "busca";
          $contr_grid_itens_container_comparacao->NM_ajax_flag = true;
          $contr_grid_itens_container_comparacao->NM_ajax_opcao = "ajax_filter_select";
      }
      if ('ajax_fixed_columns_grid_save' == $nmgp_opcao) {
          _10cf7784b802cc852e95c4656d5cf6f1_saveFixedColumnsGrid($_POST['fixed_index'], $_POST['fixed_action'], $_POST['script_case_init']);
      }
      if ('ajax_fixed_columns_grid_load' == $nmgp_opcao) {
          _10cf7784b802cc852e95c4656d5cf6f1_loadFixedColumnsGrid($_POST['script_case_init']);
      }
       $contr_grid_itens_container_comparacao->controle();
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['embutida'] && $nmgp_opcao == "formphp")
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       $contr_grid_itens_container_comparacao = new grid_itens_container_comparacao_apl();
       $contr_grid_itens_container_comparacao->controle();
   } 
//
   function nm_limpa_str_grid_itens_container_comparacao(&$str)
   {
   }
   function nm_protect_num_grid_itens_container_comparacao($name, &$val)
   {
       if (empty($val))
       {
          return;
       }
       $Nm_numeric = array();
       $Nm_numeric[] = "item_container_id";
       $Nm_numeric[] = "container_id";
       $Nm_numeric[] = "item_proc_compra_id";
       $Nm_numeric[] = "qt_alocada";
       $Nm_numeric[] = "qt_confirm_emb";
       $Nm_numeric[] = "qt_recbto_fisico";
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
   function grid_itens_container_comparacao_pack_protect_string($sString)
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

    function grid_itens_container_comparacao_pdf_progress_call($message, $Nm_lang, $flushBuffer = false) {
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
        if ($flushBuffer && $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['opcao'] != 'print') {
            $bufferSize = @ini_get('output_buffering');
            if ('' != $bufferSize) {
                echo str_repeat('&nbsp;', $bufferSize * 5);
            }
        }
        flush();
    }

    function _10cf7784b802cc852e95c4656d5cf6f1_initializeFixedColumnsGrid($script_case_init)
    {
        if (!isset($_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid'])) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid'] = '';
        }
    }

    function _10cf7784b802cc852e95c4656d5cf6f1_saveFixedColumnsGrid($index, $action, $script_case_init)
    {
        _10cf7784b802cc852e95c4656d5cf6f1_initializeFixedColumnsGrid($script_case_init);

        if ('on' == $action) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid'] = $index;
        } elseif (0 < $index) {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid'] = $index - 1;
        } else {
            $_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid'] = '';
        }

        echo json_encode(
            array(
                'status' => 'ok'
            )
        );
        exit;
    }

    function _10cf7784b802cc852e95c4656d5cf6f1_loadFixedColumnsGrid($script_case_init)
    {
        _10cf7784b802cc852e95c4656d5cf6f1_initializeFixedColumnsGrid($script_case_init);

        echo json_encode(
            array(
                'status' => 'ok',
                'last_index' =>$_SESSION['sc_session'][$script_case_init]['grid_itens_container_comparacao']['fixed_columns_grid']
            )
        );
        exit;
    }

?>
