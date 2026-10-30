<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Descontos Importação- Avulso Por Fornecedor"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Descontos Importação - Avulso por Fornecedor"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
            <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon"   sizes="57x57" href="">
            <link rel="apple-touch-icon"   sizes="60x60" href="">
            <link rel="apple-touch-icon"   sizes="72x72" href="">
            <link rel="apple-touch-icon"   sizes="76x76" href="">
            <link rel="apple-touch-icon" sizes="114x114" href="">
            <link rel="apple-touch-icon" sizes="120x120" href="">
            <link rel="apple-touch-icon" sizes="144x144" href="">
            <link rel="apple-touch-icon" sizes="152x152" href="">
            <link rel="apple-touch-icon" sizes="180x180" href="">
            <link rel="icon" type="image/png" sizes="192x192" href="">
            <link rel="icon" type="image/png"   sizes="32x32" href="">
            <link rel="icon" type="image/png"   sizes="96x96" href="">
            <link rel="icon" type="image/png"   sizes="16x16" href="">
            <meta name="msapplication-TileColor" content="___">
            <meta name="msapplication-TileImage" content="">
            <meta name="theme-color" content="___">
            <meta name="apple-mobile-web-app-status-bar-style" content="___">
            <link rel="shortcut icon" href=""> <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
            <?php
               if ($_SESSION['scriptcase']['display_mobile'] && $_SESSION['scriptcase']['device_mobile']) {
                   $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
                   $sc_app_data   = json_encode([
                       'forceMobile' => $forced_mobile,
                       'appType' => 'form',
                       'improvements' => true,
                       'displayOptionsButton' => false,
                       'displayScrollUp' => true,
                       'scrollUpPosition' => 'R',
                       'toolbarOrientation' => 'H',
                       'mobilePanes' => 'true',
                       'navigationBarButtons' => unserialize('a:3:{i:0;s:2:"NP";i:1;s:2:"FL";i:2;s:2:"RC";}'),
                       'mobileSimpleToolbar' => true,
                       'bottomToolbarFixed' => true
                   ]); ?>
            <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
            <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
            <script type="text/javascript" src="../_lib/lib/js/nm_form_mobile.js"></script>
            <link rel='stylesheet' href='../_lib/lib/css/nm_form_mobile.css' type='text/css'/>
            <script>
                $(document).ready(function(){

                    bootstrapMobile();

                });
            </script>
            <?php } ?> <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/calculator/jquery.calculator.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.plugin.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.calculator.js"></SCRIPT>
<?php
switch ($_SESSION['scriptcase']['str_lang']) {
        case 'ca':
        case 'da':
        case 'de':
        case 'es':
        case 'fr':
        case 'hr':
        case 'it':
        case 'nl':
        case 'no':
        case 'pl':
        case 'ru':
//        case 'sr':
        case 'sl':
        case 'uk':
                $tmpCalcLocale = $_SESSION['scriptcase']['str_lang'];
                break;
        case 'pt_br':
                $tmpCalcLocale = 'pt-BR';
                break;
        case 'tr':
                $tmpCalcLocale = 'ar';
                break;
        case 'zh_cn':
                $tmpCalcLocale = 'zh-CN';
                break;
//        case 'zh_hk':
//                $tmpCalcLocale = 'zh-TW';
//                break;
        default:
                $tmpCalcLocale = '';
                break;
}
if ('' != $tmpCalcLocale) {
        echo " <SCRIPT type=\"text/javascript\" src=\"{$this->Ini->path_prod}/third/jquery_plugin/calculator/jquery.calculator-$tmpCalcLocale.js\"></SCRIPT>\r\n";
}
?>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<style type="text/css">
.sc-button-image.disabled {
        opacity: 0.25
}
.sc-button-image.disabled img {
        cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_dt_autorizacao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php
$miniCalculatorFA = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorFA) {
?>
<style type="text/css">
.css_read_off_vl_cotacao_dolar button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['margin_top'] ?>;
}
</style>
<?php
}

?>

 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_descontos_importacao/form_descontos_importacao_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_descontos_importacao_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
var scFormCtrlChanged = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_descontos_importacao_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  addAutocomplete(this);

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
   });
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

function addAutocomplete(elem) {
 $(".sc-ui-autocomp-fornecedor_id", elem).each(function() {

  $(this).on("focus", function() {
   var sId = $(this).attr("id").substr(6);
   scEventControl_data[sId]["autocomp"] = true;
  }).on("blur", function() {
   var sId = $(this).attr("id").substr(6), sRow = "fornecedor_id" != sId ? sId.substr(13) : "";
   if ("" == $(this).val()) {
    var hasChanged = "" != $("#id_sc_field_" + sId).val();
    $("#id_sc_field_" + sId).val("");
    if (hasChanged) {
     if ('function' == typeof do_ajax_form_descontos_importacao_event_fornecedor_id_onchange) { do_ajax_form_descontos_importacao_event_fornecedor_id_onchange(sRow); }
    }
   }
   scEventControl_data[sId]["autocomp"] = false;
  }).on("keydown", function(e) {
   if(e.keyCode == $.ui.keyCode.TAB && $(".ui-autocomplete").filter(":visible").length) {
    e.keyCode = $.ui.keyCode.DOWN;
    $(this).trigger(e);
    e.keyCode = $.ui.keyCode.ENTER;
    $(this).trigger(e);
   }
  }).autocomplete({
   minLength: 1,
   source: function (request, response) {
    $.ajax({
     url: "form_descontos_importacao.php",
     dataType: "json",
     data: {
      term: request.term,
      nmgp_opcao: "ajax_autocomp",
      nmgp_parms: "NM_ajax_opcao?#?autocomp_fornecedor_id",
      script_case_init: document.F2.script_case_init.value
     },
     success: function (data) {
      if (data == "ss_time_out") {
          nm_move('novo');
      }
      response(data);
     }
    });
   },
   focus: function (event, ui) {
    event.preventDefault();
   },
   select: function (event, ui) {
    var sId = $(this).attr("id").substr(6), sRow = 'fornecedor_id' != sId ? sId.substr(13) : '';
    $("#id_sc_field_" + sId).val(ui.item.value);
    $(this).val(ui.item.label);
    event.preventDefault();
    $("#id_sc_field_" + sId).trigger("focus");
    setTimeout(function() { scAjaxHideAutocomp(sId); }, 10);
   }
  });
 });
}
</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    if ('' != $remove_background) {
?>
<style>
.scFormBorder { <?php echo $remove_background ?> }
.scFormToolbar { <?php echo $remove_background ?> }
</style>
<?php
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_descontos_importacao_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
var scInsertFieldWithErrors = new Array();
<?php
foreach ($this->NM_ajax_info['fieldsWithErrors'] as $insertFieldName) {
?>
scInsertFieldWithErrors.push("<?php echo $insertFieldName; ?>");
<?php
}
?>
$(function() {
        scAjaxError_markFieldList(scInsertFieldWithErrors);
});
 </script>
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="arquivo_salva" value="<?php  echo $this->form_encode_input($this->arquivo) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_descontos_importacao'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_descontos_importacao'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="100%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input id='fast_search_f0_t' type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:none;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
?> 
          </select>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <img style="display: <?php echo $stateSearchIconSearch ?>; "  id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
                  <img style="display: <?php echo $stateSearchIconClose ?>; " id="SC_fast_search_close_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
          </span>  </div>
  <?php
      }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['empty_filter'] = true;
       }
  }
?>
<style>
.scTabInactive {
    cursor: pointer;
}
</style>
<script type="text/javascript">
var pag_ativa = "form_descontos_importacao_form0";
</script>
<ul class="scTabLine sc-ui-page-tab-line">
<?php
    $this->tabCssClass = array(
        'form_descontos_importacao_form0' => array(
            'title' => "Principal",
            'class' => empty($nmgp_num_form) || $nmgp_num_form == "form_descontos_importacao_form0" ? "scTabActive" : "scTabInactive",
        ),
        'form_descontos_importacao_form1' => array(
            'title' => "Utilização",
            'class' => $nmgp_num_form == "form_descontos_importacao_form1" ? "scTabActive" : "scTabInactive",
        ),
    );
    if (!empty($this->Ini->nm_hidden_pages)) {
        foreach ($this->Ini->nm_hidden_pages as $pageName => $pageStatus) {
            if ('Principal' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_descontos_importacao_form0']['class'] = 'scTabInactive';
            }
            if ('Utilização' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_descontos_importacao_form1']['class'] = 'scTabInactive';
            }
        }
        $displayingPage = false;
        foreach ($this->tabCssClass as $pageInfo) {
            if ('scTabActive' == $pageInfo['class']) {
                $displayingPage = true;
                break;
            }
        }
        if (!$displayingPage) {
            foreach ($this->tabCssClass as $pageForm => $pageInfo) {
                if (!isset($this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) || 'off' != $this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) {
                    $this->tabCssClass[$pageForm]['class'] = 'scTabActive';
                    break;
                }
            }
        }
    }
?>
<?php
    $css_celula = $this->tabCssClass["form_descontos_importacao_form0"]['class'];
?>
   <li id="id_form_descontos_importacao_form0" class="sc-form-page sc-tab-click <?php echo $css_celula; ?>" data-tab-name="form_descontos_importacao_form0">
     Principal
   </li>
<?php
    $css_celula = $this->tabCssClass["form_descontos_importacao_form1"]['class'];
?>
   <li id="id_form_descontos_importacao_form1" class="sc-form-page sc-tab-click <?php echo $css_celula; ?>" data-tab-name="form_descontos_importacao_form1">
     Utilização
   </li>
</ul>
<div style='clear:both'></div>
</td></tr> 
<tr><td style="padding: 0px">
<div id="form_descontos_importacao_form0" style='display: none; width: 1px; height: 0px; overflow: scroll'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="50%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['item_container_id']))
   {
       $this->nmgp_cmp_hidden['item_container_id'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['cod_tipo']))
   {
       $this->nmgp_cmp_hidden['cod_tipo'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><input type="hidden" name="arquivo_ul_name" id="id_sc_field_arquivo_ul_name" value="<?php echo $this->form_encode_input($this->arquivo_ul_name);?>">
<input type="hidden" name="arquivo_ul_type" id="id_sc_field_arquivo_ul_type" value="<?php echo $this->form_encode_input($this->arquivo_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['desconto_importacao_id']))
           {
               $this->nmgp_cmp_readonly['desconto_importacao_id'] = 'on';
           }
?>
   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Solicitado</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['desconto_importacao_id']))
    {
        $this->nm_new_label['desconto_importacao_id'] = "ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $desconto_importacao_id = $this->desconto_importacao_id;
   $sStyleHidden_desconto_importacao_id = '';
   if (isset($this->nmgp_cmp_hidden['desconto_importacao_id']) && $this->nmgp_cmp_hidden['desconto_importacao_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['desconto_importacao_id']);
       $sStyleHidden_desconto_importacao_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_desconto_importacao_id = 'display: none;';
   $sStyleReadInp_desconto_importacao_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["desconto_importacao_id"]) &&  $this->nmgp_cmp_readonly["desconto_importacao_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['desconto_importacao_id']);
       $sStyleReadLab_desconto_importacao_id = '';
       $sStyleReadInp_desconto_importacao_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['desconto_importacao_id']) && $this->nmgp_cmp_hidden['desconto_importacao_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="desconto_importacao_id" value="<?php echo $this->form_encode_input($desconto_importacao_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_desconto_importacao_id_label" id="hidden_field_label_desconto_importacao_id" style="<?php echo $sStyleHidden_desconto_importacao_id; ?>"><span id="id_label_desconto_importacao_id"><?php echo $this->nm_new_label['desconto_importacao_id']; ?></span></TD>
    <TD class="scFormDataOdd css_desconto_importacao_id_line" id="hidden_field_data_desconto_importacao_id" style="<?php echo $sStyleHidden_desconto_importacao_id; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_desconto_importacao_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_desconto_importacao_id" class="css_desconto_importacao_id_line" style="<?php echo $sStyleReadLab_desconto_importacao_id; ?>"><?php echo $this->form_format_readonly("desconto_importacao_id", $this->form_encode_input($this->desconto_importacao_id)); ?></span><span id="id_read_off_desconto_importacao_id" class="css_read_off_desconto_importacao_id" style="<?php echo $sStyleReadInp_desconto_importacao_id; ?>"><input type="hidden" name="desconto_importacao_id" value="<?php echo $this->form_encode_input($desconto_importacao_id) . "\">"?><span id="id_ajax_label_desconto_importacao_id"><?php echo nl2br($desconto_importacao_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_desconto_importacao_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_desconto_importacao_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['motivo_desconto_id']))
   {
       $this->nm_new_label['motivo_desconto_id'] = "Motivo";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $motivo_desconto_id = $this->motivo_desconto_id;
   $sStyleHidden_motivo_desconto_id = '';
   if (isset($this->nmgp_cmp_hidden['motivo_desconto_id']) && $this->nmgp_cmp_hidden['motivo_desconto_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['motivo_desconto_id']);
       $sStyleHidden_motivo_desconto_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_motivo_desconto_id = 'display: none;';
   $sStyleReadInp_motivo_desconto_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['motivo_desconto_id']) && $this->nmgp_cmp_readonly['motivo_desconto_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['motivo_desconto_id']);
       $sStyleReadLab_motivo_desconto_id = '';
       $sStyleReadInp_motivo_desconto_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['motivo_desconto_id']) && $this->nmgp_cmp_hidden['motivo_desconto_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="motivo_desconto_id" value="<?php echo $this->form_encode_input($this->motivo_desconto_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_motivo_desconto_id_label" id="hidden_field_label_motivo_desconto_id" style="<?php echo $sStyleHidden_motivo_desconto_id; ?>"><span id="id_label_motivo_desconto_id"><?php echo $this->nm_new_label['motivo_desconto_id']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['php_cmp_required']['motivo_desconto_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['php_cmp_required']['motivo_desconto_id'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_motivo_desconto_id_line" id="hidden_field_data_motivo_desconto_id" style="<?php echo $sStyleHidden_motivo_desconto_id; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_motivo_desconto_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["motivo_desconto_id"]) &&  $this->nmgp_cmp_readonly["motivo_desconto_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'] = array(); 
    }

   $old_value_desconto_importacao_id = $this->desconto_importacao_id;
   $old_value_fornecedor_id = $this->fornecedor_id;
   $old_value_vl_dolar = $this->vl_dolar;
   $old_value_vl_real = $this->vl_real;
   $old_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $old_value_item_container_id = $this->item_container_id;
   $old_value_cod_tipo = $this->cod_tipo;
   $old_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $old_value_vl_real_autorizado = $this->vl_real_autorizado;
   $old_value_dt_autorizacao = $this->dt_autorizacao;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_desconto_importacao_id = $this->desconto_importacao_id;
   $unformatted_value_fornecedor_id = $this->fornecedor_id;
   $unformatted_value_vl_dolar = $this->vl_dolar;
   $unformatted_value_vl_real = $this->vl_real;
   $unformatted_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $unformatted_value_item_container_id = $this->item_container_id;
   $unformatted_value_cod_tipo = $this->cod_tipo;
   $unformatted_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $unformatted_value_vl_real_autorizado = $this->vl_real_autorizado;
   $unformatted_value_dt_autorizacao = $this->dt_autorizacao;

   $log_credito_val_str = "";
   if (!empty($this->log_credito))
   {
       if (is_array($this->log_credito))
       {
           $Tmp_array = $this->log_credito;
       }
       else
       {
           $Tmp_array = explode(";", $this->log_credito);
       }
       $log_credito_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $log_credito_val_str)
          {
             $log_credito_val_str .= ", ";
          }
          $log_credito_val_str .= $Tmp_val_cmp;
       }
   }
   $nm_comando = "SELECT motivo_desconto_id, descricao  FROM PUB.motivos_desconto  ORDER BY descricao";

   $this->desconto_importacao_id = $old_value_desconto_importacao_id;
   $this->fornecedor_id = $old_value_fornecedor_id;
   $this->vl_dolar = $old_value_vl_dolar;
   $this->vl_real = $old_value_vl_real;
   $this->vl_cotacao_dolar = $old_value_vl_cotacao_dolar;
   $this->item_container_id = $old_value_item_container_id;
   $this->cod_tipo = $old_value_cod_tipo;
   $this->vl_dolar_autorizado = $old_value_vl_dolar_autorizado;
   $this->vl_real_autorizado = $old_value_vl_real_autorizado;
   $this->dt_autorizacao = $old_value_dt_autorizacao;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $motivo_desconto_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->motivo_desconto_id_1))
          {
              foreach ($this->motivo_desconto_id_1 as $tmp_motivo_desconto_id)
              {
                  if (trim($tmp_motivo_desconto_id) === trim($cadaselect[1])) {$motivo_desconto_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->motivo_desconto_id) && trim($this->motivo_desconto_id) === trim($cadaselect[1])) {$motivo_desconto_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="motivo_desconto_id" value="<?php echo $this->form_encode_input($motivo_desconto_id) . "\">" . $motivo_desconto_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_motivo_desconto_id();
   $x = 0 ; 
   $motivo_desconto_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->motivo_desconto_id_1))
          {
              foreach ($this->motivo_desconto_id_1 as $tmp_motivo_desconto_id)
              {
                  if (trim($tmp_motivo_desconto_id) === trim($cadaselect[1])) {$motivo_desconto_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->motivo_desconto_id)) {
                 if (trim($this->motivo_desconto_id) == trim($cadaselect[1])) { $motivo_desconto_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->motivo_desconto_id == $cadaselect[1]) { $motivo_desconto_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($motivo_desconto_id_look))
          {
              $motivo_desconto_id_look = $this->motivo_desconto_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_motivo_desconto_id\" class=\"css_motivo_desconto_id_line\" style=\"" .  $sStyleReadLab_motivo_desconto_id . "\">" . $this->form_format_readonly("motivo_desconto_id", $this->form_encode_input($motivo_desconto_id_look)) . "</span><span id=\"id_read_off_motivo_desconto_id\" class=\"css_read_off_motivo_desconto_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_motivo_desconto_id . "\">";
   echo " <span id=\"idAjaxSelect_motivo_desconto_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_motivo_desconto_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_motivo_desconto_id\" name=\"motivo_desconto_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_motivo_desconto_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->motivo_desconto_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->motivo_desconto_id)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   if (isset($this->Ini->sc_lig_md5["form_motivos_desconto"]) && $this->Ini->sc_lig_md5["form_motivos_desconto"] == "S") {
       $Parms_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_descontos_importacao_lkpedt_refresh_motivo_desconto_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_descontos_importacao@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_descontos_importacao_lkpedt_refresh_motivo_desconto_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "nm_submit_cap('" . $this->Ini->link_form_motivos_desconto_edit. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_form_motivos_desconto_edit. "', '" . $Md5_Lig . "')", "fldedt_motivo_desconto_id", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_motivo_desconto_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_motivo_desconto_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornecedor_id']))
    {
        $this->nm_new_label['fornecedor_id'] = "Fornecedor Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornecedor_id = $this->fornecedor_id;
   $sStyleHidden_fornecedor_id = '';
   if (isset($this->nmgp_cmp_hidden['fornecedor_id']) && $this->nmgp_cmp_hidden['fornecedor_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornecedor_id']);
       $sStyleHidden_fornecedor_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornecedor_id = 'display: none;';
   $sStyleReadInp_fornecedor_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornecedor_id']) && $this->nmgp_cmp_readonly['fornecedor_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornecedor_id']);
       $sStyleReadLab_fornecedor_id = '';
       $sStyleReadInp_fornecedor_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornecedor_id']) && $this->nmgp_cmp_hidden['fornecedor_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornecedor_id" value="<?php echo $this->form_encode_input($fornecedor_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fornecedor_id_label" id="hidden_field_label_fornecedor_id" style="<?php echo $sStyleHidden_fornecedor_id; ?>"><span id="id_label_fornecedor_id"><?php echo $this->nm_new_label['fornecedor_id']; ?></span></TD>
    <TD class="scFormDataOdd css_fornecedor_id_line" id="hidden_field_data_fornecedor_id" style="<?php echo $sStyleHidden_fornecedor_id; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornecedor_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornecedor_id"]) &&  $this->nmgp_cmp_readonly["fornecedor_id"] == "on") { 

 ?>
<input type="hidden" name="fornecedor_id" value="<?php echo $this->form_encode_input($fornecedor_id) . "\">" . $fornecedor_id . ""; ?>
<?php } else { ?>

<?php
$aRecData['fornecedor_id'] = $this->fornecedor_id;
$aLookup = array();
   if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'] = array(); 
    }

   $old_value_desconto_importacao_id = $this->desconto_importacao_id;
   $old_value_fornecedor_id = $this->fornecedor_id;
   $old_value_vl_dolar = $this->vl_dolar;
   $old_value_vl_real = $this->vl_real;
   $old_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $old_value_item_container_id = $this->item_container_id;
   $old_value_cod_tipo = $this->cod_tipo;
   $old_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $old_value_vl_real_autorizado = $this->vl_real_autorizado;
   $old_value_dt_autorizacao = $this->dt_autorizacao;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("fornecedor_id");

   $unformatted_value_desconto_importacao_id = $this->desconto_importacao_id;
   $unformatted_value_fornecedor_id = $this->fornecedor_id;
   $unformatted_value_vl_dolar = $this->vl_dolar;
   $unformatted_value_vl_real = $this->vl_real;
   $unformatted_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $unformatted_value_item_container_id = $this->item_container_id;
   $unformatted_value_cod_tipo = $this->cod_tipo;
   $unformatted_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $unformatted_value_vl_real_autorizado = $this->vl_real_autorizado;
   $unformatted_value_dt_autorizacao = $this->dt_autorizacao;

   $log_credito_val_str = "";
   if (!empty($this->log_credito))
   {
       if (is_array($this->log_credito))
       {
           $Tmp_array = $this->log_credito;
       }
       else
       {
           $Tmp_array = explode(";", $this->log_credito);
       }
       $log_credito_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $log_credito_val_str)
          {
             $log_credito_val_str .= ", ";
          }
          $log_credito_val_str .= $Tmp_val_cmp;
       }
   }
   if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\" + ' - ' + \"nome-emit\" + ' - ' + cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT \"cod-emitente\", concat(\"nome-abrev\", ' - ', \"nome-emit\",' - ', cgc) FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"&' - '&\"nome-emit\"&' - '&cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\" + ' - ' + \"nome-emit\" + ' - ' + cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   else
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->desconto_importacao_id = $old_value_desconto_importacao_id;
   $this->fornecedor_id = $old_value_fornecedor_id;
   $this->vl_dolar = $old_value_vl_dolar;
   $this->vl_real = $old_value_vl_real;
   $this->vl_cotacao_dolar = $old_value_vl_cotacao_dolar;
   $this->item_container_id = $old_value_item_container_id;
   $this->cod_tipo = $old_value_cod_tipo;
   $this->vl_dolar_autorizado = $old_value_vl_dolar_autorizado;
   $this->vl_real_autorizado = $old_value_vl_real_autorizado;
   $this->dt_autorizacao = $old_value_dt_autorizacao;

   if ('' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_comum->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array($rs->fields[0] => $rs->fields[1]);
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comum->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
$sAutocompValue = (isset($aLookup[0][$unformatted_value_fornecedor_id])) ? $aLookup[0][$unformatted_value_fornecedor_id] : $this->fornecedor_id;
$fornecedor_id_look = (isset($aLookup[0][$unformatted_value_fornecedor_id])) ? $aLookup[0][$unformatted_value_fornecedor_id] : $this->fornecedor_id;
?>
<span id="id_read_on_fornecedor_id" class="sc-ui-readonly-fornecedor_id css_fornecedor_id_line" style="<?php echo $sStyleReadLab_fornecedor_id; ?>"><?php echo $this->form_format_readonly("fornecedor_id", str_replace("<", "&lt;", $fornecedor_id_look)); ?></span><span id="id_read_off_fornecedor_id" class="css_read_off_fornecedor_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornecedor_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornecedor_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornecedor_id" type=text name="fornecedor_id" value="<?php echo $this->form_encode_input($fornecedor_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=7"; } ?> alt="{datatype: 'integer', maxLength: 7, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['fornecedor_id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['fornecedor_id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['fornecedor_id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php
$aRecData['fornecedor_id'] = $this->fornecedor_id;
$aLookup = array();
   if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'] = array(); 
    }

   $old_value_desconto_importacao_id = $this->desconto_importacao_id;
   $old_value_fornecedor_id = $this->fornecedor_id;
   $old_value_vl_dolar = $this->vl_dolar;
   $old_value_vl_real = $this->vl_real;
   $old_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $old_value_item_container_id = $this->item_container_id;
   $old_value_cod_tipo = $this->cod_tipo;
   $old_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $old_value_vl_real_autorizado = $this->vl_real_autorizado;
   $old_value_dt_autorizacao = $this->dt_autorizacao;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("fornecedor_id");

   $unformatted_value_desconto_importacao_id = $this->desconto_importacao_id;
   $unformatted_value_fornecedor_id = $this->fornecedor_id;
   $unformatted_value_vl_dolar = $this->vl_dolar;
   $unformatted_value_vl_real = $this->vl_real;
   $unformatted_value_vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $unformatted_value_item_container_id = $this->item_container_id;
   $unformatted_value_cod_tipo = $this->cod_tipo;
   $unformatted_value_vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $unformatted_value_vl_real_autorizado = $this->vl_real_autorizado;
   $unformatted_value_dt_autorizacao = $this->dt_autorizacao;

   $log_credito_val_str = "";
   if (!empty($this->log_credito))
   {
       if (is_array($this->log_credito))
       {
           $Tmp_array = $this->log_credito;
       }
       else
       {
           $Tmp_array = explode(";", $this->log_credito);
       }
       $log_credito_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $log_credito_val_str)
          {
             $log_credito_val_str .= ", ";
          }
          $log_credito_val_str .= $Tmp_val_cmp;
       }
   }
   if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\" + ' - ' + \"nome-emit\" + ' - ' + cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT \"cod-emitente\", concat(\"nome-abrev\", ' - ', \"nome-emit\",' - ', cgc) FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"&' - '&\"nome-emit\"&' - '&cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\" + ' - ' + \"nome-emit\" + ' - ' + cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   else
   {
       $nm_comando = "SELECT \"cod-emitente\", \"nome-abrev\"||' - '||\"nome-emit\"||' - '||cgc FROM PUB.emitente WHERE \"cod-emitente\" = " . substr($this->Db->qstr($this->fornecedor_id), 1, -1) . " ORDER BY \"nome-abrev\", \"nome-emit\", cgc";
   }
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->desconto_importacao_id = $old_value_desconto_importacao_id;
   $this->fornecedor_id = $old_value_fornecedor_id;
   $this->vl_dolar = $old_value_vl_dolar;
   $this->vl_real = $old_value_vl_real;
   $this->vl_cotacao_dolar = $old_value_vl_cotacao_dolar;
   $this->item_container_id = $old_value_item_container_id;
   $this->cod_tipo = $old_value_cod_tipo;
   $this->vl_dolar_autorizado = $old_value_vl_dolar_autorizado;
   $this->vl_real_autorizado = $old_value_vl_real_autorizado;
   $this->dt_autorizacao = $old_value_dt_autorizacao;

   if ('' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id && '' != $this->fornecedor_id)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_comum->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array($rs->fields[0] => $rs->fields[1]);
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_fornecedor_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comum->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
$sAutocompValue = (isset($aLookup[0][$unformatted_value_fornecedor_id])) ? $aLookup[0][$unformatted_value_fornecedor_id] : '';
$fornecedor_id_look = (isset($aLookup[0][$unformatted_value_fornecedor_id])) ? $aLookup[0][$unformatted_value_fornecedor_id] : '';
?>
<?php echo nmButtonOutput($this->arr_buttons, "bajaxcapt", "scAjaxShowAutocomp('fornecedor_id'); return false", "scAjaxShowAutocomp('fornecedor_id'); return false", "fornecedor_id_autocomp_cap", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
&nbsp;<div id="id_ac_frame_fornecedor_id" style="display: none; position: absolute; z-index: 1000"><table class="scFormACTable"><tr><td class="scFormACTitle"><?php echo nmButtonOutput($this->arr_buttons, "bajaxclose", "scAjaxHideAutocomp('fornecedor_id'); return false", "scAjaxHideAutocomp('fornecedor_id'); return false", "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
&nbsp;&nbsp;Nome Abrev/Nome Emitente/CNPJ</td></tr><tr><td class="scFormDataOdd"><input type="text" id="id_ac_fornecedor_id" name="fornecedor_id_autocomp" class="scFormObjectOdd sc-ui-autocomp-fornecedor_id css_fornecedor_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" size="30" value="<?php echo $sAutocompValue; ?>" alt="{datatype: 'integer', maxLength: 7, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['fornecedor_id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['fornecedor_id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['fornecedor_id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  /></td></tr></table></div></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornecedor_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornecedor_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['arquivo']))
    {
        $this->nm_new_label['arquivo'] = "Arquivo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $arquivo = $this->arquivo;
   $sStyleHidden_arquivo = '';
   if (isset($this->nmgp_cmp_hidden['arquivo']) && $this->nmgp_cmp_hidden['arquivo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['arquivo']);
       $sStyleHidden_arquivo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_arquivo = 'display: none;';
   $sStyleReadInp_arquivo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['arquivo']) && $this->nmgp_cmp_readonly['arquivo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['arquivo']);
       $sStyleReadLab_arquivo = '';
       $sStyleReadInp_arquivo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['arquivo']) && $this->nmgp_cmp_hidden['arquivo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="arquivo" value="<?php echo $this->form_encode_input($arquivo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_arquivo_label" id="hidden_field_label_arquivo" style="<?php echo $sStyleHidden_arquivo; ?>"><span id="id_label_arquivo"><?php echo $this->nm_new_label['arquivo']; ?></span></TD>
    <TD class="scFormDataOdd css_arquivo_line" id="hidden_field_data_arquivo" style="<?php echo $sStyleHidden_arquivo; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_arquivo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["arquivo"]) &&  $this->nmgp_cmp_readonly["arquivo"] == "on") { 

 ?>
<input type="hidden" name="arquivo" value="<?php echo $this->form_encode_input($arquivo) . "\"><img id=\"arquivo_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_arquivo\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_arquivo, 3)) . "', 'form_descontos_importacao')\">" . $arquivo . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_arquivo" class="scFormLinkOdd sc-ui-readonly-arquivo css_arquivo_line" style="<?php echo $sStyleReadLab_arquivo; ?>"><?php echo $this->form_format_readonly("arquivo", $this->arquivo) ?></span><span id="id_read_off_arquivo" class="css_read_off_arquivo" style="white-space: nowrap;<?php echo $sStyleReadInp_arquivo; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-arquivo" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_arquivo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="arquivo[]" id="id_sc_field_arquivo" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_arquivo"<?php if ($this->nmgp_opcao == "novo" || empty($arquivo)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="arquivo_limpa" value="<?php echo $arquivo_limpa . '" '; if ($arquivo_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="arquivo_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_arquivo"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_arquivo, 3)); ?>', 'form_descontos_importacao')"><?php echo $arquivo ?></a></span><div id="id_img_loader_arquivo" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_arquivo" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_arquivo" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_arquivo ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_arquivo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_arquivo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['descricao']))
    {
        $this->nm_new_label['descricao'] = "Descrição";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $descricao = $this->descricao;
   $sStyleHidden_descricao = '';
   if (isset($this->nmgp_cmp_hidden['descricao']) && $this->nmgp_cmp_hidden['descricao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['descricao']);
       $sStyleHidden_descricao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_descricao = 'display: none;';
   $sStyleReadInp_descricao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['descricao']) && $this->nmgp_cmp_readonly['descricao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['descricao']);
       $sStyleReadLab_descricao = '';
       $sStyleReadInp_descricao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['descricao']) && $this->nmgp_cmp_hidden['descricao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descricao" value="<?php echo $this->form_encode_input($descricao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_descricao_label" id="hidden_field_label_descricao" style="<?php echo $sStyleHidden_descricao; ?>"><span id="id_label_descricao"><?php echo $this->nm_new_label['descricao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['php_cmp_required']['descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['php_cmp_required']['descricao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_descricao_line" id="hidden_field_data_descricao" style="<?php echo $sStyleHidden_descricao; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_line" style="vertical-align: top;padding: 0px">
<?php
$descricao_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($descricao));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao"]) &&  $this->nmgp_cmp_readonly["descricao"] == "on") { 

 ?>
<input type="hidden" name="descricao" value="<?php echo $this->form_encode_input($descricao) . "\">" . $descricao_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao" class="sc-ui-readonly-descricao css_descricao_line" style="<?php echo $sStyleReadLab_descricao; ?>"><?php echo $this->form_format_readonly("descricao", $this->form_encode_input($descricao_val)); ?></span><span id="id_read_off_descricao" class="css_read_off_descricao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_descricao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="descricao" id="id_sc_field_descricao" rows="5" cols="50"
 alt="{datatype: 'text', maxLength: 8000, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $descricao; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_credito']))
   {
       $this->nm_new_label['log_credito'] = "Gerar Crédito?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_credito = $this->log_credito;
   $sStyleHidden_log_credito = '';
   if (isset($this->nmgp_cmp_hidden['log_credito']) && $this->nmgp_cmp_hidden['log_credito'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_credito']);
       $sStyleHidden_log_credito = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_credito = 'display: none;';
   $sStyleReadInp_log_credito = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_credito']) && $this->nmgp_cmp_readonly['log_credito'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_credito']);
       $sStyleReadLab_log_credito = '';
       $sStyleReadInp_log_credito = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_credito']) && $this->nmgp_cmp_hidden['log_credito'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_credito" value="<?php echo $this->form_encode_input($this->log_credito) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  if ($this->nmgp_opcao != "recarga") 
  {
      $this->log_credito_1 = explode(";", trim($this->log_credito));
  } 
  else
  {
      if (empty($this->log_credito))
      {
          $this->log_credito_1= array(); 
          $this->log_credito= "0";
      } 
      else
      {
          $this->log_credito_1= $this->log_credito; 
          $this->log_credito= ""; 
          foreach ($this->log_credito_1 as $cada_log_credito)
          {
             if (!empty($log_credito))
             {
                 $this->log_credito.= ";"; 
             } 
             $this->log_credito.= $cada_log_credito; 
          } 
      } 
  } 
?> 

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_credito_label" id="hidden_field_label_log_credito" style="<?php echo $sStyleHidden_log_credito; ?>"><span id="id_label_log_credito"><?php echo $this->nm_new_label['log_credito']; ?></span></TD>
    <TD class="scFormDataOdd css_log_credito_line" id="hidden_field_data_log_credito" style="<?php echo $sStyleHidden_log_credito; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_credito_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_credito"]) &&  $this->nmgp_cmp_readonly["log_credito"] == "on") { 

$log_credito_look = "";
 if ($this->log_credito == "1") { $log_credito_look .= "Sim" ;} 
 if (empty($log_credito_look)) { $log_credito_look = $this->log_credito; }
?>
<input type="hidden" name="log_credito" value="<?php echo $this->form_encode_input($log_credito) . "\">" . $log_credito_look . ""; ?>
<?php } else { ?>

<?php

$log_credito_look = "";
 if ($this->log_credito == "1") { $log_credito_look .= "Sim" ;} 
 if (empty($log_credito_look)) { $log_credito_look = $this->log_credito; }
?>
<span id="id_read_on_log_credito" class="css_log_credito_line" style="<?php echo $sStyleReadLab_log_credito; ?>"><?php echo $this->form_format_readonly("log_credito", $this->form_encode_input($log_credito_look)); ?></span><span id="id_read_off_log_credito" class="css_read_off_log_credito css_log_credito_line" style="<?php echo $sStyleReadInp_log_credito; ?>"><?php echo "<div id=\"idAjaxCheckbox_log_credito\" style=\"display: inline-block\" class=\"css_log_credito_line\">\r\n"; ?><TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_log_credito_line"><?php $tempOptionId = "id-opt-log_credito" . $sc_seq_vert . "-1"; ?>
 <input type=checkbox id="<?php echo $tempOptionId ?>" class="sc-ui-checkbox-log_credito sc-ui-checkbox-log_credito" name="log_credito[]" value="1"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_descontos_importacao']['Lookup_log_credito'][] = '1'; ?>
<?php  if (in_array("1", $this->log_credito_1))  { echo " checked" ;} ?><?php  if (empty($this->log_credito)) { echo " checked" ;} ?> onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
<?php echo "</div>\r\n"; ?></span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_credito_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_credito_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_dolar']))
    {
        $this->nm_new_label['vl_dolar'] = "Vl. em Dólar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_dolar = $this->vl_dolar;
   $sStyleHidden_vl_dolar = '';
   if (isset($this->nmgp_cmp_hidden['vl_dolar']) && $this->nmgp_cmp_hidden['vl_dolar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_dolar']);
       $sStyleHidden_vl_dolar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_dolar = 'display: none;';
   $sStyleReadInp_vl_dolar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_dolar']) && $this->nmgp_cmp_readonly['vl_dolar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_dolar']);
       $sStyleReadLab_vl_dolar = '';
       $sStyleReadInp_vl_dolar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_dolar']) && $this->nmgp_cmp_hidden['vl_dolar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_dolar" value="<?php echo $this->form_encode_input($vl_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_dolar_label" id="hidden_field_label_vl_dolar" style="<?php echo $sStyleHidden_vl_dolar; ?>"><span id="id_label_vl_dolar"><?php echo $this->nm_new_label['vl_dolar']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_dolar_line" id="hidden_field_data_vl_dolar" style="<?php echo $sStyleHidden_vl_dolar; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_dolar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_dolar"]) &&  $this->nmgp_cmp_readonly["vl_dolar"] == "on") { 

 ?>
<input type="hidden" name="vl_dolar" value="<?php echo $this->form_encode_input($vl_dolar) . "\">" . $vl_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_dolar" class="sc-ui-readonly-vl_dolar css_vl_dolar_line" style="<?php echo $sStyleReadLab_vl_dolar; ?>"><?php echo $this->form_format_readonly("vl_dolar", $this->form_encode_input($this->vl_dolar)); ?></span><span id="id_read_off_vl_dolar" class="css_read_off_vl_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_dolar" type=text name="vl_dolar" value="<?php echo $this->form_encode_input($vl_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_dolar']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_dolar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_real']))
    {
        $this->nm_new_label['vl_real'] = "Vl. em Real";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_real = $this->vl_real;
   $sStyleHidden_vl_real = '';
   if (isset($this->nmgp_cmp_hidden['vl_real']) && $this->nmgp_cmp_hidden['vl_real'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_real']);
       $sStyleHidden_vl_real = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_real = 'display: none;';
   $sStyleReadInp_vl_real = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_real']) && $this->nmgp_cmp_readonly['vl_real'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_real']);
       $sStyleReadLab_vl_real = '';
       $sStyleReadInp_vl_real = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_real']) && $this->nmgp_cmp_hidden['vl_real'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_real" value="<?php echo $this->form_encode_input($vl_real) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_real_label" id="hidden_field_label_vl_real" style="<?php echo $sStyleHidden_vl_real; ?>"><span id="id_label_vl_real"><?php echo $this->nm_new_label['vl_real']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_real_line" id="hidden_field_data_vl_real" style="<?php echo $sStyleHidden_vl_real; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_real_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_real"]) &&  $this->nmgp_cmp_readonly["vl_real"] == "on") { 

 ?>
<input type="hidden" name="vl_real" value="<?php echo $this->form_encode_input($vl_real) . "\">" . $vl_real . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_real" class="sc-ui-readonly-vl_real css_vl_real_line" style="<?php echo $sStyleReadLab_vl_real; ?>"><?php echo $this->form_format_readonly("vl_real", $this->form_encode_input($this->vl_real)); ?></span><span id="id_read_off_vl_real" class="css_read_off_vl_real<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_real; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_real_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_real" type=text name="vl_real" value="<?php echo $this->form_encode_input($vl_real) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_real']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_real']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_real']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_real']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_real_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_real_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_cotacao_dolar']))
    {
        $this->nm_new_label['vl_cotacao_dolar'] = "Vl.Cotação Dolar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_cotacao_dolar = $this->vl_cotacao_dolar;
   $sStyleHidden_vl_cotacao_dolar = '';
   if (isset($this->nmgp_cmp_hidden['vl_cotacao_dolar']) && $this->nmgp_cmp_hidden['vl_cotacao_dolar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_cotacao_dolar']);
       $sStyleHidden_vl_cotacao_dolar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_cotacao_dolar = 'display: none;';
   $sStyleReadInp_vl_cotacao_dolar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_cotacao_dolar']) && $this->nmgp_cmp_readonly['vl_cotacao_dolar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_cotacao_dolar']);
       $sStyleReadLab_vl_cotacao_dolar = '';
       $sStyleReadInp_vl_cotacao_dolar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_cotacao_dolar']) && $this->nmgp_cmp_hidden['vl_cotacao_dolar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_cotacao_dolar" value="<?php echo $this->form_encode_input($vl_cotacao_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_cotacao_dolar_label" id="hidden_field_label_vl_cotacao_dolar" style="<?php echo $sStyleHidden_vl_cotacao_dolar; ?>"><span id="id_label_vl_cotacao_dolar"><?php echo $this->nm_new_label['vl_cotacao_dolar']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_cotacao_dolar_line" id="hidden_field_data_vl_cotacao_dolar" style="<?php echo $sStyleHidden_vl_cotacao_dolar; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_cotacao_dolar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_cotacao_dolar"]) &&  $this->nmgp_cmp_readonly["vl_cotacao_dolar"] == "on") { 

 ?>
<input type="hidden" name="vl_cotacao_dolar" value="<?php echo $this->form_encode_input($vl_cotacao_dolar) . "\">" . $vl_cotacao_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_cotacao_dolar" class="sc-ui-readonly-vl_cotacao_dolar css_vl_cotacao_dolar_line" style="<?php echo $sStyleReadLab_vl_cotacao_dolar; ?>"><?php echo $this->form_format_readonly("vl_cotacao_dolar", $this->form_encode_input($this->vl_cotacao_dolar)); ?></span><span id="id_read_off_vl_cotacao_dolar" class="css_read_off_vl_cotacao_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_cotacao_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_cotacao_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_cotacao_dolar" type=text name="vl_cotacao_dolar" value="<?php echo $this->form_encode_input($vl_cotacao_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_cotacao_dolar']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_cotacao_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_cotacao_dolar']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_cotacao_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_cotacao_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_cotacao_dolar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['item_container_id']))
    {
        $this->nm_new_label['item_container_id'] = "Item Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $item_container_id = $this->item_container_id;
   if (!isset($this->nmgp_cmp_hidden['item_container_id']))
   {
       $this->nmgp_cmp_hidden['item_container_id'] = 'off';
   }
   $sStyleHidden_item_container_id = '';
   if (isset($this->nmgp_cmp_hidden['item_container_id']) && $this->nmgp_cmp_hidden['item_container_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['item_container_id']);
       $sStyleHidden_item_container_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_item_container_id = 'display: none;';
   $sStyleReadInp_item_container_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['item_container_id']) && $this->nmgp_cmp_readonly['item_container_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['item_container_id']);
       $sStyleReadLab_item_container_id = '';
       $sStyleReadInp_item_container_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['item_container_id']) && $this->nmgp_cmp_hidden['item_container_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="item_container_id" value="<?php echo $this->form_encode_input($item_container_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_item_container_id_label" id="hidden_field_label_item_container_id" style="<?php echo $sStyleHidden_item_container_id; ?>"><span id="id_label_item_container_id"><?php echo $this->nm_new_label['item_container_id']; ?></span></TD>
    <TD class="scFormDataOdd css_item_container_id_line" id="hidden_field_data_item_container_id" style="<?php echo $sStyleHidden_item_container_id; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_item_container_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["item_container_id"]) &&  $this->nmgp_cmp_readonly["item_container_id"] == "on") { 

 ?>
<input type="hidden" name="item_container_id" value="<?php echo $this->form_encode_input($item_container_id) . "\">" . $item_container_id . ""; ?>
<?php } else { ?>
<span id="id_read_on_item_container_id" class="sc-ui-readonly-item_container_id css_item_container_id_line" style="<?php echo $sStyleReadLab_item_container_id; ?>"><?php echo $this->form_format_readonly("item_container_id", $this->form_encode_input($this->item_container_id)); ?></span><span id="id_read_off_item_container_id" class="css_read_off_item_container_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_item_container_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_item_container_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_item_container_id" type=text name="item_container_id" value="<?php echo $this->form_encode_input($item_container_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['item_container_id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['item_container_id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['item_container_id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_item_container_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_item_container_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_tipo']))
    {
        $this->nm_new_label['cod_tipo'] = "Tipo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_tipo = $this->cod_tipo;
   if (!isset($this->nmgp_cmp_hidden['cod_tipo']))
   {
       $this->nmgp_cmp_hidden['cod_tipo'] = 'off';
   }
   $sStyleHidden_cod_tipo = '';
   if (isset($this->nmgp_cmp_hidden['cod_tipo']) && $this->nmgp_cmp_hidden['cod_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_tipo']);
       $sStyleHidden_cod_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_tipo = 'display: none;';
   $sStyleReadInp_cod_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_tipo']) && $this->nmgp_cmp_readonly['cod_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_tipo']);
       $sStyleReadLab_cod_tipo = '';
       $sStyleReadInp_cod_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_tipo']) && $this->nmgp_cmp_hidden['cod_tipo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_tipo" value="<?php echo $this->form_encode_input($cod_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_tipo_label" id="hidden_field_label_cod_tipo" style="<?php echo $sStyleHidden_cod_tipo; ?>"><span id="id_label_cod_tipo"><?php echo $this->nm_new_label['cod_tipo']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_tipo_line" id="hidden_field_data_cod_tipo" style="<?php echo $sStyleHidden_cod_tipo; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_tipo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_tipo"]) &&  $this->nmgp_cmp_readonly["cod_tipo"] == "on") { 

 ?>
<input type="hidden" name="cod_tipo" value="<?php echo $this->form_encode_input($cod_tipo) . "\">" . $cod_tipo . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_tipo" class="sc-ui-readonly-cod_tipo css_cod_tipo_line" style="<?php echo $sStyleReadLab_cod_tipo; ?>"><?php echo $this->form_format_readonly("cod_tipo", $this->form_encode_input($this->cod_tipo)); ?></span><span id="id_read_off_cod_tipo" class="css_read_off_cod_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_tipo; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_tipo" type=text name="cod_tipo" value="<?php echo $this->form_encode_input($cod_tipo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_tipo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_tipo']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_tipo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_tipo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="100%" height="">
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Aprovado</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_dolar_autorizado']))
    {
        $this->nm_new_label['vl_dolar_autorizado'] = "Vl.Dolar Negociado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_dolar_autorizado = $this->vl_dolar_autorizado;
   $sStyleHidden_vl_dolar_autorizado = '';
   if (isset($this->nmgp_cmp_hidden['vl_dolar_autorizado']) && $this->nmgp_cmp_hidden['vl_dolar_autorizado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_dolar_autorizado']);
       $sStyleHidden_vl_dolar_autorizado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_dolar_autorizado = 'display: none;';
   $sStyleReadInp_vl_dolar_autorizado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_dolar_autorizado']) && $this->nmgp_cmp_readonly['vl_dolar_autorizado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_dolar_autorizado']);
       $sStyleReadLab_vl_dolar_autorizado = '';
       $sStyleReadInp_vl_dolar_autorizado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_dolar_autorizado']) && $this->nmgp_cmp_hidden['vl_dolar_autorizado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_dolar_autorizado" value="<?php echo $this->form_encode_input($vl_dolar_autorizado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_dolar_autorizado_label" id="hidden_field_label_vl_dolar_autorizado" style="<?php echo $sStyleHidden_vl_dolar_autorizado; ?>"><span id="id_label_vl_dolar_autorizado"><?php echo $this->nm_new_label['vl_dolar_autorizado']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_dolar_autorizado_line" id="hidden_field_data_vl_dolar_autorizado" style="<?php echo $sStyleHidden_vl_dolar_autorizado; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_dolar_autorizado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_dolar_autorizado"]) &&  $this->nmgp_cmp_readonly["vl_dolar_autorizado"] == "on") { 

 ?>
<input type="hidden" name="vl_dolar_autorizado" value="<?php echo $this->form_encode_input($vl_dolar_autorizado) . "\">" . $vl_dolar_autorizado . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_dolar_autorizado" class="sc-ui-readonly-vl_dolar_autorizado css_vl_dolar_autorizado_line" style="<?php echo $sStyleReadLab_vl_dolar_autorizado; ?>"><?php echo $this->form_format_readonly("vl_dolar_autorizado", $this->form_encode_input($this->vl_dolar_autorizado)); ?></span><span id="id_read_off_vl_dolar_autorizado" class="css_read_off_vl_dolar_autorizado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_dolar_autorizado; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_dolar_autorizado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_dolar_autorizado" type=text name="vl_dolar_autorizado" value="<?php echo $this->form_encode_input($vl_dolar_autorizado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_autorizado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_autorizado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_dolar_autorizado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_dolar_autorizado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_dolar_autorizado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_dolar_autorizado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_real_autorizado']))
    {
        $this->nm_new_label['vl_real_autorizado'] = "Vl.Real Autorizado Negociado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_real_autorizado = $this->vl_real_autorizado;
   $sStyleHidden_vl_real_autorizado = '';
   if (isset($this->nmgp_cmp_hidden['vl_real_autorizado']) && $this->nmgp_cmp_hidden['vl_real_autorizado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_real_autorizado']);
       $sStyleHidden_vl_real_autorizado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_real_autorizado = 'display: none;';
   $sStyleReadInp_vl_real_autorizado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_real_autorizado']) && $this->nmgp_cmp_readonly['vl_real_autorizado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_real_autorizado']);
       $sStyleReadLab_vl_real_autorizado = '';
       $sStyleReadInp_vl_real_autorizado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_real_autorizado']) && $this->nmgp_cmp_hidden['vl_real_autorizado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_real_autorizado" value="<?php echo $this->form_encode_input($vl_real_autorizado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_real_autorizado_label" id="hidden_field_label_vl_real_autorizado" style="<?php echo $sStyleHidden_vl_real_autorizado; ?>"><span id="id_label_vl_real_autorizado"><?php echo $this->nm_new_label['vl_real_autorizado']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_real_autorizado_line" id="hidden_field_data_vl_real_autorizado" style="<?php echo $sStyleHidden_vl_real_autorizado; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_real_autorizado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_real_autorizado"]) &&  $this->nmgp_cmp_readonly["vl_real_autorizado"] == "on") { 

 ?>
<input type="hidden" name="vl_real_autorizado" value="<?php echo $this->form_encode_input($vl_real_autorizado) . "\">" . $vl_real_autorizado . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_real_autorizado" class="sc-ui-readonly-vl_real_autorizado css_vl_real_autorizado_line" style="<?php echo $sStyleReadLab_vl_real_autorizado; ?>"><?php echo $this->form_format_readonly("vl_real_autorizado", $this->form_encode_input($this->vl_real_autorizado)); ?></span><span id="id_read_off_vl_real_autorizado" class="css_read_off_vl_real_autorizado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_real_autorizado; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_real_autorizado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_real_autorizado" type=text name="vl_real_autorizado" value="<?php echo $this->form_encode_input($vl_real_autorizado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_real_autorizado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_real_autorizado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_real_autorizado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_real_autorizado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_real_autorizado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_real_autorizado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_autorizacao']))
    {
        $this->nm_new_label['dt_autorizacao'] = "Dt.Autorização";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_autorizacao = $this->dt_autorizacao;
   $sStyleHidden_dt_autorizacao = '';
   if (isset($this->nmgp_cmp_hidden['dt_autorizacao']) && $this->nmgp_cmp_hidden['dt_autorizacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_autorizacao']);
       $sStyleHidden_dt_autorizacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_autorizacao = 'display: none;';
   $sStyleReadInp_dt_autorizacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_autorizacao']) && $this->nmgp_cmp_readonly['dt_autorizacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_autorizacao']);
       $sStyleReadLab_dt_autorizacao = '';
       $sStyleReadInp_dt_autorizacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_autorizacao']) && $this->nmgp_cmp_hidden['dt_autorizacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_autorizacao" value="<?php echo $this->form_encode_input($dt_autorizacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_autorizacao_label" id="hidden_field_label_dt_autorizacao" style="<?php echo $sStyleHidden_dt_autorizacao; ?>"><span id="id_label_dt_autorizacao"><?php echo $this->nm_new_label['dt_autorizacao']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_autorizacao_line" id="hidden_field_data_dt_autorizacao" style="<?php echo $sStyleHidden_dt_autorizacao; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_autorizacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_autorizacao"]) &&  $this->nmgp_cmp_readonly["dt_autorizacao"] == "on") { 

 ?>
<input type="hidden" name="dt_autorizacao" value="<?php echo $this->form_encode_input($dt_autorizacao) . "\">" . $dt_autorizacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_autorizacao" class="sc-ui-readonly-dt_autorizacao css_dt_autorizacao_line" style="<?php echo $sStyleReadLab_dt_autorizacao; ?>"><?php echo $this->form_format_readonly("dt_autorizacao", $this->form_encode_input($dt_autorizacao)); ?></span><span id="id_read_off_dt_autorizacao" class="css_read_off_dt_autorizacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_autorizacao; ?>"><?php
$tmp_form_data = $this->field_config['dt_autorizacao']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_dt_autorizacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_autorizacao" type=text name="dt_autorizacao" value="<?php echo $this->form_encode_input($dt_autorizacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_autorizacao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_autorizacao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_autorizacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_autorizacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
