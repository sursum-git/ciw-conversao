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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Container's"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Container's"); } ?></TITLE>
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
.css_read_off_dt_prev_embarque button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_real_embarque button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_12 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_prev_chegada_loja button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_11 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_4 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_9 button {
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
.css_read_off_vl_proj_dolar button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['embutida_pdf']))
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
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_pp_container/form_pp_container_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_pp_container_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['last'] : 'off'); ?>";
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
<?php

include_once('form_pp_container_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  sc_form_onload();

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
   });
 if($(".sc-ui-block-control").length) {
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

</script>
</HEAD>
<?php
$str_iframe_body = 'margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['recarga'];
}
if ('' != $this->sc_field_3)
{
    $this->lookup_sc_field_3($look_rpc_sc_field_3);
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['link_info']['remove_border']) {
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
    $vertical_center = 'display: flex; flex-direction: column; justify-content: flex-start; margin: 0px; min-height: 100vh;';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
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
 include_once("form_pp_container_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
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
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['insert_validation']; ?>">
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_pp_container'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_pp_container'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R")
{
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['update'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_log'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['btn_label']['bt_log'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_log", "scBtnFn_bt_log()", "scBtnFn_bt_log()", "sc_bt_log_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['sc_field_2']))
   {
       $this->nmgp_cmp_hidden['sc_field_2'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['situacao']))
   {
       $this->nmgp_cmp_hidden['situacao'] = 'off';
   }
?>
<script type="text/javascript">
function sc_change_tabs(bTabDisp, sTabId, sTabParts)
{
  if (document.getElementById(sTabId)) {
    if (bTabDisp) {
      document.getElementById("div_" + sTabId).style.width = "";
      document.getElementById("div_" + sTabId).style.height = "";
      document.getElementById("div_" + sTabId).style.display = "";
      document.getElementById("div_" + sTabId).style.overflow = "visible";
      document.getElementById(sTabParts).className = "scTabActive";
    }
    else {
      document.getElementById("div_" + sTabId).style.width = "1px";
      document.getElementById("div_" + sTabId).style.height = "0px";
      document.getElementById("div_" + sTabId).style.display = "none";
      document.getElementById("div_" + sTabId).style.overflow = "scroll";
      document.getElementById(sTabParts).className = "scTabInactive";
    }
  }
}
</script>
<script type="text/javascript">
function sc_control_tabs_0(iTabIndex)
{
  sc_change_tabs(iTabIndex == 0, 'hidden_bloco_0', 'id_tabs_0_0');
  if (iTabIndex == 0) {
    displayChange_block("0", "on");
  }
  sc_change_tabs(iTabIndex == 1, 'hidden_bloco_1', 'id_tabs_0_1');
  if (iTabIndex == 1) {
    displayChange_block("1", "on");
  }
  sc_change_tabs(iTabIndex == 2, 'hidden_bloco_2', 'id_tabs_0_2');
  if (iTabIndex == 2) {
    displayChange_block("2", "on");
  }
  sc_change_tabs(iTabIndex == 3, 'hidden_bloco_3', 'id_tabs_0_3');
  if (iTabIndex == 3) {
    displayChange_block("3", "on");
  }
  sc_change_tabs(iTabIndex == 4, 'hidden_bloco_4', 'id_tabs_0_4');
  if (iTabIndex == 4) {
    displayChange_block("4", "on");
  }
  sc_change_tabs(iTabIndex == 5, 'hidden_bloco_5', 'id_tabs_0_5');
  if (iTabIndex == 5) {
    displayChange_block("5", "on");
  }
  sc_change_tabs(iTabIndex == 6, 'hidden_bloco_6', 'id_tabs_0_6');
  if (iTabIndex == 6) {
    displayChange_block("6", "on");
  }
  sc_change_tabs(iTabIndex == 7, 'hidden_bloco_7', 'id_tabs_0_7');
  if (iTabIndex == 7) {
    displayChange_block("7", "on");
  }
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)">Principal</a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Embarque</a></li>
<li id="id_tabs_0_2" class="scTabInactive"><a href="javascript: sc_control_tabs_0(2)">Chegada</a></li>
<li id="id_tabs_0_3" class="scTabInactive"><a href="javascript: sc_control_tabs_0(3)">Perguntas</a></li>
<li id="id_tabs_0_4" class="scTabInactive"><a href="javascript: sc_control_tabs_0(4)">Narrativa</a></li>
<li id="id_tabs_0_5" class="scTabInactive"><a href="javascript: sc_control_tabs_0(5)">Dólar Compra</a></li>
<li id="id_tabs_0_6" class="scTabInactive"><a href="javascript: sc_control_tabs_0(6)">Dólar DI</a></li>
<li id="id_tabs_0_7" class="scTabInactive"><a href="javascript: sc_control_tabs_0(7)">Dólar Venda</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['sc_field_10']))
           {
               $this->nmgp_cmp_readonly['sc_field_10'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['sc_field_1']))
   {
       $this->nm_new_label['sc_field_1'] = "Estab.";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_1 = $this->sc_field_1;
   $sStyleHidden_sc_field_1 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_1']) && $this->nmgp_cmp_hidden['sc_field_1'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_1']);
       $sStyleHidden_sc_field_1 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_1 = 'display: none;';
   $sStyleReadInp_sc_field_1 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_1']) && $this->nmgp_cmp_readonly['sc_field_1'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_1']);
       $sStyleReadLab_sc_field_1 = '';
       $sStyleReadInp_sc_field_1 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_1']) && $this->nmgp_cmp_hidden['sc_field_1'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="sc_field_1" value="<?php echo $this->form_encode_input($this->sc_field_1) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_1_line" id="hidden_field_data_sc_field_1" style="<?php echo $sStyleHidden_sc_field_1; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_1_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_1_label" style=""><span id="id_label_sc_field_1"><?php echo $this->nm_new_label['sc_field_1']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_1']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_1'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_1"]) &&  $this->nmgp_cmp_readonly["sc_field_1"] == "on") { 

$sc_field_1_look = "";
 if ($this->sc_field_1 == "1") { $sc_field_1_look .= "IMA" ;} 
 if ($this->sc_field_1 == "5") { $sc_field_1_look .= "ES - VILA VELHA" ;} 
 if ($this->sc_field_1 == "505") { $sc_field_1_look .= "SC - ITAJAI" ;} 
 if (empty($sc_field_1_look)) { $sc_field_1_look = $this->sc_field_1; }
?>
<input type="hidden" name="sc_field_1" value="<?php echo $this->form_encode_input($sc_field_1) . "\">" . $sc_field_1_look . ""; ?>
<?php } else { ?>
<?php

$sc_field_1_look = "";
 if ($this->sc_field_1 == "1") { $sc_field_1_look .= "IMA" ;} 
 if ($this->sc_field_1 == "5") { $sc_field_1_look .= "ES - VILA VELHA" ;} 
 if ($this->sc_field_1 == "505") { $sc_field_1_look .= "SC - ITAJAI" ;} 
 if (empty($sc_field_1_look)) { $sc_field_1_look = $this->sc_field_1; }
?>
<span id="id_read_on_sc_field_1" class="css_sc_field_1_line"  style="<?php echo $sStyleReadLab_sc_field_1; ?>"><?php echo $this->form_format_readonly("sc_field_1", $this->form_encode_input($sc_field_1_look)); ?></span><span id="id_read_off_sc_field_1" class="css_read_off_sc_field_1<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_sc_field_1; ?>">
 <span id="idAjaxSelect_sc_field_1" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_sc_field_1_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_1" name="sc_field_1" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_sc_field_1'][] = ''; ?>
 <option value="">--Selecione--</option>
 <option  value="1" <?php  if ($this->sc_field_1 == "1") { echo " selected" ;} ?>>IMA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_sc_field_1'][] = '1'; ?>
 <option  value="5" <?php  if ($this->sc_field_1 == "5") { echo " selected" ;} ?>>ES - VILA VELHA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_sc_field_1'][] = '5'; ?>
 <option  value="505" <?php  if ($this->sc_field_1 == "505") { echo " selected" ;} ?>>SC - ITAJAI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_sc_field_1'][] = '505'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_1_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_1_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['sc_field_10']))
    {
        $this->nm_new_label['sc_field_10'] = "Nr.Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_10 = $this->sc_field_10;
   $sStyleHidden_sc_field_10 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_10']) && $this->nmgp_cmp_hidden['sc_field_10'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_10']);
       $sStyleHidden_sc_field_10 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_10 = 'display: none;';
   $sStyleReadInp_sc_field_10 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["sc_field_10"]) &&  $this->nmgp_cmp_readonly["sc_field_10"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_10']);
       $sStyleReadLab_sc_field_10 = '';
       $sStyleReadInp_sc_field_10 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_10']) && $this->nmgp_cmp_hidden['sc_field_10'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_10" value="<?php echo $this->form_encode_input($sc_field_10) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_10_line" id="hidden_field_data_sc_field_10" style="<?php echo $sStyleHidden_sc_field_10; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_10_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_10_label" style=""><span id="id_label_sc_field_10"><?php echo $this->nm_new_label['sc_field_10']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_10']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_10'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["sc_field_10"]) &&  $this->nmgp_cmp_readonly["sc_field_10"] == "on")) { 

 ?>
<input type="hidden" name="sc_field_10" value="<?php echo $this->form_encode_input($sc_field_10) . "\"><span id=\"id_ajax_label_sc_field_10\">" . $sc_field_10 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_10" class="sc-ui-readonly-sc_field_10 css_sc_field_10_line" style="<?php echo $sStyleReadLab_sc_field_10; ?>"><?php echo $this->form_format_readonly("sc_field_10", $this->form_encode_input($this->sc_field_10)); ?></span><span id="id_read_off_sc_field_10" class="css_read_off_sc_field_10<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_10; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_10_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_10" type=text name="sc_field_10" value="<?php echo $this->form_encode_input($sc_field_10) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'integer', maxLength: 6, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_10']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_10']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_10']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_10_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_10_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_sc_field_1_dumb = ('' == $sStyleHidden_sc_field_1) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_1_dumb" style="<?php echo $sStyleHidden_sc_field_1_dumb; ?>"></TD>
<?php $sStyleHidden_sc_field_10_dumb = ('' == $sStyleHidden_sc_field_10) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_10_dumb" style="<?php echo $sStyleHidden_sc_field_10_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_3']))
    {
        $this->nm_new_label['sc_field_3'] = "Fornecedor";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_3 = $this->sc_field_3;
   $sStyleHidden_sc_field_3 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_3']) && $this->nmgp_cmp_hidden['sc_field_3'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_3']);
       $sStyleHidden_sc_field_3 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_3 = 'display: none;';
   $sStyleReadInp_sc_field_3 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_3']) && $this->nmgp_cmp_readonly['sc_field_3'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_3']);
       $sStyleReadLab_sc_field_3 = '';
       $sStyleReadInp_sc_field_3 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_3']) && $this->nmgp_cmp_hidden['sc_field_3'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_3" value="<?php echo $this->form_encode_input($sc_field_3) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_3_line" id="hidden_field_data_sc_field_3" style="<?php echo $sStyleHidden_sc_field_3; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_3_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_3_label" style=""><span id="id_label_sc_field_3"><?php echo $this->nm_new_label['sc_field_3']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_3']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['sc_field_3'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_3"]) &&  $this->nmgp_cmp_readonly["sc_field_3"] == "on") { 

 ?>
<input type="hidden" name="sc_field_3" value="<?php echo $this->form_encode_input($sc_field_3) . "\">" . $sc_field_3 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_3" class="sc-ui-readonly-sc_field_3 css_sc_field_3_line" style="<?php echo $sStyleReadLab_sc_field_3; ?>"><?php echo $this->form_format_readonly("sc_field_3", $this->form_encode_input($this->sc_field_3)); ?></span><span id="id_read_off_sc_field_3" class="css_read_off_sc_field_3<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_3; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_3_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_3" type=text name="sc_field_3" value="<?php echo $this->form_encode_input($sc_field_3) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=7"; } ?> alt="{datatype: 'integer', maxLength: 7, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_3']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_3']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_3']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php
   $Sc_iframe_master = ($this->Embutida_call) ? 'nmgp_iframe_ret*scinnmsc_iframe_liga_form_pp_container*scout' : '';
   if (isset($this->Ini->sc_lig_md5["cons_fornecedor"]) && $this->Ini->sc_lig_md5["cons_fornecedor"] == "S") {
       $Parms_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,sc_field_3,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_sc_field_3_onchange(this)*scoutnmgp_perm_edit*scinS*scoutjs_lookup*scinlookup_sc_field_3*scout" . $Sc_iframe_master;
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_pp_container@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,sc_field_3,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_sc_field_3_onchange(this)*scoutnmgp_perm_edit*scinS*scoutjs_lookup*scinlookup_sc_field_3*scout" . $Sc_iframe_master;
   }
?>

<?php if (!$this->Ini->Export_img_zip) { ?><?php echo nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "cap_sc_field_3", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
<?php } ?>
 <SPAN id="id_lookup_sc_field_3"><?php echo $look_rpc_sc_field_3; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_3_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_3_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['cod_agente_cargas']))
    {
        $this->nm_new_label['cod_agente_cargas'] = "Agente Cargas";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_agente_cargas = $this->cod_agente_cargas;
   $sStyleHidden_cod_agente_cargas = '';
   if (isset($this->nmgp_cmp_hidden['cod_agente_cargas']) && $this->nmgp_cmp_hidden['cod_agente_cargas'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_agente_cargas']);
       $sStyleHidden_cod_agente_cargas = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_agente_cargas = 'display: none;';
   $sStyleReadInp_cod_agente_cargas = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_agente_cargas']) && $this->nmgp_cmp_readonly['cod_agente_cargas'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_agente_cargas']);
       $sStyleReadLab_cod_agente_cargas = '';
       $sStyleReadInp_cod_agente_cargas = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_agente_cargas']) && $this->nmgp_cmp_hidden['cod_agente_cargas'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_agente_cargas" value="<?php echo $this->form_encode_input($cod_agente_cargas) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cod_agente_cargas_line" id="hidden_field_data_cod_agente_cargas" style="<?php echo $sStyleHidden_cod_agente_cargas; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_agente_cargas_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cod_agente_cargas_label" style=""><span id="id_label_cod_agente_cargas"><?php echo $this->nm_new_label['cod_agente_cargas']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_agente_cargas"]) &&  $this->nmgp_cmp_readonly["cod_agente_cargas"] == "on") { 

 ?>
<input type="hidden" name="cod_agente_cargas" value="<?php echo $this->form_encode_input($cod_agente_cargas) . "\">" . $cod_agente_cargas . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_agente_cargas" class="sc-ui-readonly-cod_agente_cargas css_cod_agente_cargas_line" style="<?php echo $sStyleReadLab_cod_agente_cargas; ?>"><?php echo $this->form_format_readonly("cod_agente_cargas", $this->form_encode_input($this->cod_agente_cargas)); ?></span><span id="id_read_off_cod_agente_cargas" class="css_read_off_cod_agente_cargas<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_agente_cargas; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_agente_cargas_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_agente_cargas" type=text name="cod_agente_cargas" value="<?php echo $this->form_encode_input($cod_agente_cargas) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=7"; } ?> alt="{datatype: 'integer', maxLength: 7, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_agente_cargas']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_agente_cargas']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_agente_cargas']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php
   $Sc_iframe_master = ($this->Embutida_call) ? 'nmgp_iframe_ret*scinnmsc_iframe_liga_form_pp_container*scout' : '';
   if (isset($this->Ini->sc_lig_md5["cons_fornecedor"]) && $this->Ini->sc_lig_md5["cons_fornecedor"] == "S") {
       $Parms_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,cod_agente_cargas,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_cod_agente_cargas_onchange(this)*scoutnmgp_perm_edit*scinS*scout" . $Sc_iframe_master;
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_pp_container@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,cod_agente_cargas,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_cod_agente_cargas_onchange(this)*scoutnmgp_perm_edit*scinS*scout" . $Sc_iframe_master;
   }
?>

<?php if (!$this->Ini->Export_img_zip) { ?><?php echo nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "cap_cod_agente_cargas", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
<?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_agente_cargas_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_agente_cargas_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_sc_field_3_dumb = ('' == $sStyleHidden_sc_field_3) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_3_dumb" style="<?php echo $sStyleHidden_sc_field_3_dumb; ?>"></TD>
<?php $sStyleHidden_cod_agente_cargas_dumb = ('' == $sStyleHidden_cod_agente_cargas) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_cod_agente_cargas_dumb" style="<?php echo $sStyleHidden_cod_agente_cargas_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_armador']))
    {
        $this->nm_new_label['cod_armador'] = "Armador";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_armador = $this->cod_armador;
   $sStyleHidden_cod_armador = '';
   if (isset($this->nmgp_cmp_hidden['cod_armador']) && $this->nmgp_cmp_hidden['cod_armador'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_armador']);
       $sStyleHidden_cod_armador = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_armador = 'display: none;';
   $sStyleReadInp_cod_armador = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_armador']) && $this->nmgp_cmp_readonly['cod_armador'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_armador']);
       $sStyleReadLab_cod_armador = '';
       $sStyleReadInp_cod_armador = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_armador']) && $this->nmgp_cmp_hidden['cod_armador'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_armador" value="<?php echo $this->form_encode_input($cod_armador) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cod_armador_line" id="hidden_field_data_cod_armador" style="<?php echo $sStyleHidden_cod_armador; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_armador_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cod_armador_label" style=""><span id="id_label_cod_armador"><?php echo $this->nm_new_label['cod_armador']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_armador"]) &&  $this->nmgp_cmp_readonly["cod_armador"] == "on") { 

 ?>
<input type="hidden" name="cod_armador" value="<?php echo $this->form_encode_input($cod_armador) . "\">" . $cod_armador . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_armador" class="sc-ui-readonly-cod_armador css_cod_armador_line" style="<?php echo $sStyleReadLab_cod_armador; ?>"><?php echo $this->form_format_readonly("cod_armador", $this->form_encode_input($this->cod_armador)); ?></span><span id="id_read_off_cod_armador" class="css_read_off_cod_armador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_armador; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_armador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_armador" type=text name="cod_armador" value="<?php echo $this->form_encode_input($cod_armador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=7"; } ?> alt="{datatype: 'integer', maxLength: 7, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_armador']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_armador']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_armador']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php
   $Sc_iframe_master = ($this->Embutida_call) ? 'nmgp_iframe_ret*scinnmsc_iframe_liga_form_pp_container*scout' : '';
   if (isset($this->Ini->sc_lig_md5["cons_fornecedor"]) && $this->Ini->sc_lig_md5["cons_fornecedor"] == "S") {
       $Parms_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,cod_armador,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_cod_armador_onchange(this)*scoutnmgp_perm_edit*scinS*scout" . $Sc_iframe_master;
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_pp_container@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "nmgp_url_saida*scin*scoutnmgp_parms_ret*scinF1,cod_armador,cod-emitente*scoutnm_evt_ret_busca*scinsc_form_pp_container_cod_armador_onchange(this)*scoutnmgp_perm_edit*scinS*scout" . $Sc_iframe_master;
   }
?>

<?php if (!$this->Ini->Export_img_zip) { ?><?php echo nmButtonOutput($this->arr_buttons, "bform_captura", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_cons_fornecedor_cons_psq. "', '" . $Md5_Lig . "')", "cap_cod_armador", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
<?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_armador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_armador_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['sc_field_18']))
    {
        $this->nm_new_label['sc_field_18'] = "Cod Depos";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_18 = $this->sc_field_18;
   $sStyleHidden_sc_field_18 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_18']) && $this->nmgp_cmp_hidden['sc_field_18'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_18']);
       $sStyleHidden_sc_field_18 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_18 = 'display: none;';
   $sStyleReadInp_sc_field_18 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_18']) && $this->nmgp_cmp_readonly['sc_field_18'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_18']);
       $sStyleReadLab_sc_field_18 = '';
       $sStyleReadInp_sc_field_18 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_18']) && $this->nmgp_cmp_hidden['sc_field_18'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_18" value="<?php echo $this->form_encode_input($sc_field_18) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_18_line" id="hidden_field_data_sc_field_18" style="<?php echo $sStyleHidden_sc_field_18; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_18_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_18_label" style=""><span id="id_label_sc_field_18"><?php echo $this->nm_new_label['sc_field_18']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_18"]) &&  $this->nmgp_cmp_readonly["sc_field_18"] == "on") { 

 ?>
<input type="hidden" name="sc_field_18" value="<?php echo $this->form_encode_input($sc_field_18) . "\">" . $sc_field_18 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_18" class="sc-ui-readonly-sc_field_18 css_sc_field_18_line" style="<?php echo $sStyleReadLab_sc_field_18; ?>"><?php echo $this->form_format_readonly("sc_field_18", $this->form_encode_input($this->sc_field_18)); ?></span><span id="id_read_off_sc_field_18" class="css_read_off_sc_field_18<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_18; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_18_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_18" type=text name="sc_field_18" value="<?php echo $this->form_encode_input($sc_field_18) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> maxlength=16 alt="{datatype: 'text', maxLength: 16, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_18_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_18_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_cod_armador_dumb = ('' == $sStyleHidden_cod_armador) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_cod_armador_dumb" style="<?php echo $sStyleHidden_cod_armador_dumb; ?>"></TD>
<?php $sStyleHidden_sc_field_18_dumb = ('' == $sStyleHidden_sc_field_18) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_18_dumb" style="<?php echo $sStyleHidden_sc_field_18_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['situacao']))
    {
        $this->nm_new_label['situacao'] = "Situação ERP";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $situacao = $this->situacao;
   if (!isset($this->nmgp_cmp_hidden['situacao']))
   {
       $this->nmgp_cmp_hidden['situacao'] = 'off';
   }
   $sStyleHidden_situacao = '';
   if (isset($this->nmgp_cmp_hidden['situacao']) && $this->nmgp_cmp_hidden['situacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['situacao']);
       $sStyleHidden_situacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_situacao = 'display: none;';
   $sStyleReadInp_situacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['situacao']) && $this->nmgp_cmp_readonly['situacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['situacao']);
       $sStyleReadLab_situacao = '';
       $sStyleReadInp_situacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['situacao']) && $this->nmgp_cmp_hidden['situacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="situacao" value="<?php echo $this->form_encode_input($situacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_situacao_line" id="hidden_field_data_situacao" style="<?php echo $sStyleHidden_situacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_situacao_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_situacao_label" style=""><span id="id_label_situacao"><?php echo $this->nm_new_label['situacao']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["situacao"]) &&  $this->nmgp_cmp_readonly["situacao"] == "on") { 

 ?>
<input type="hidden" name="situacao" value="<?php echo $this->form_encode_input($situacao) . "\">" . $situacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_situacao" class="sc-ui-readonly-situacao css_situacao_line" style="<?php echo $sStyleReadLab_situacao; ?>"><?php echo $this->form_format_readonly("situacao", $this->form_encode_input($this->situacao)); ?></span><span id="id_read_off_situacao" class="css_read_off_situacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_situacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_situacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_situacao" type=text name="situacao" value="<?php echo $this->form_encode_input($situacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['situacao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['situacao']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['situacao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_situacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_situacao_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['sc_field_2']))
    {
        $this->nm_new_label['sc_field_2'] = "Nome Ab Forn";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_2 = $this->sc_field_2;
   if (!isset($this->nmgp_cmp_hidden['sc_field_2']))
   {
       $this->nmgp_cmp_hidden['sc_field_2'] = 'off';
   }
   $sStyleHidden_sc_field_2 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_2']) && $this->nmgp_cmp_hidden['sc_field_2'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_2']);
       $sStyleHidden_sc_field_2 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_2 = 'display: none;';
   $sStyleReadInp_sc_field_2 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_2']) && $this->nmgp_cmp_readonly['sc_field_2'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_2']);
       $sStyleReadLab_sc_field_2 = '';
       $sStyleReadInp_sc_field_2 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_2']) && $this->nmgp_cmp_hidden['sc_field_2'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_2" value="<?php echo $this->form_encode_input($sc_field_2) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_2_line" id="hidden_field_data_sc_field_2" style="<?php echo $sStyleHidden_sc_field_2; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_2_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_2_label" style=""><span id="id_label_sc_field_2"><?php echo $this->nm_new_label['sc_field_2']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_2"]) &&  $this->nmgp_cmp_readonly["sc_field_2"] == "on") { 

 ?>
<input type="hidden" name="sc_field_2" value="<?php echo $this->form_encode_input($sc_field_2) . "\">" . $sc_field_2 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_2" class="sc-ui-readonly-sc_field_2 css_sc_field_2_line" style="<?php echo $sStyleReadLab_sc_field_2; ?>"><?php echo $this->form_format_readonly("sc_field_2", $this->form_encode_input($this->sc_field_2)); ?></span><span id="id_read_off_sc_field_2" class="css_read_off_sc_field_2<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_2; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_2_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_2" type=text name="sc_field_2" value="<?php echo $this->form_encode_input($sc_field_2) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> maxlength=24 alt="{datatype: 'text', maxLength: 24, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_2_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_2_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_situacao_dumb = ('' == $sStyleHidden_situacao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_situacao_dumb" style="<?php echo $sStyleHidden_situacao_dumb; ?>"></TD>
<?php $sStyleHidden_sc_field_2_dumb = ('' == $sStyleHidden_sc_field_2) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_2_dumb" style="<?php echo $sStyleHidden_sc_field_2_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['medidas_container']))
    {
        $this->nm_new_label['medidas_container'] = "Medidas Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $medidas_container = $this->medidas_container;
   $sStyleHidden_medidas_container = '';
   if (isset($this->nmgp_cmp_hidden['medidas_container']) && $this->nmgp_cmp_hidden['medidas_container'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['medidas_container']);
       $sStyleHidden_medidas_container = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_medidas_container = 'display: none;';
   $sStyleReadInp_medidas_container = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['medidas_container']) && $this->nmgp_cmp_readonly['medidas_container'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['medidas_container']);
       $sStyleReadLab_medidas_container = '';
       $sStyleReadInp_medidas_container = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['medidas_container']) && $this->nmgp_cmp_hidden['medidas_container'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="medidas_container" value="<?php echo $this->form_encode_input($medidas_container) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_medidas_container_line" id="hidden_field_data_medidas_container" style="<?php echo $sStyleHidden_medidas_container; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_medidas_container_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_medidas_container_label" style=""><span id="id_label_medidas_container"><?php echo $this->nm_new_label['medidas_container']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["medidas_container"]) &&  $this->nmgp_cmp_readonly["medidas_container"] == "on") { 

 ?>
<input type="hidden" name="medidas_container" value="<?php echo $this->form_encode_input($medidas_container) . "\">" . $medidas_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_medidas_container" class="sc-ui-readonly-medidas_container css_medidas_container_line" style="<?php echo $sStyleReadLab_medidas_container; ?>"><?php echo $this->form_format_readonly("medidas_container", $this->form_encode_input($this->medidas_container)); ?></span><span id="id_read_off_medidas_container" class="css_read_off_medidas_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_medidas_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_medidas_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_medidas_container" type=text name="medidas_container" value="<?php echo $this->form_encode_input($medidas_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_medidas_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_medidas_container_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['situacao_container_id']))
   {
       $this->nm_new_label['situacao_container_id'] = "Situação Acompanhamento";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $situacao_container_id = $this->situacao_container_id;
   $sStyleHidden_situacao_container_id = '';
   if (isset($this->nmgp_cmp_hidden['situacao_container_id']) && $this->nmgp_cmp_hidden['situacao_container_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['situacao_container_id']);
       $sStyleHidden_situacao_container_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_situacao_container_id = 'display: none;';
   $sStyleReadInp_situacao_container_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['situacao_container_id']) && $this->nmgp_cmp_readonly['situacao_container_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['situacao_container_id']);
       $sStyleReadLab_situacao_container_id = '';
       $sStyleReadInp_situacao_container_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['situacao_container_id']) && $this->nmgp_cmp_hidden['situacao_container_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="situacao_container_id" value="<?php echo $this->form_encode_input($this->situacao_container_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_situacao_container_id_line" id="hidden_field_data_situacao_container_id" style="<?php echo $sStyleHidden_situacao_container_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_situacao_container_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_situacao_container_id_label" style=""><span id="id_label_situacao_container_id"><?php echo $this->nm_new_label['situacao_container_id']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["situacao_container_id"]) &&  $this->nmgp_cmp_readonly["situacao_container_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'] = array(); 
    }

   $old_value_sc_field_10 = $this->sc_field_10;
   $old_value_sc_field_3 = $this->sc_field_3;
   $old_value_cod_agente_cargas = $this->cod_agente_cargas;
   $old_value_cod_armador = $this->cod_armador;
   $old_value_situacao = $this->situacao;
   $old_value_perc_custo = $this->perc_custo;
   $old_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $old_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $old_value_dt_prev_embarque = $this->dt_prev_embarque;
   $old_value_dt_real_embarque = $this->dt_real_embarque;
   $old_value_sc_field_12 = $this->sc_field_12;
   $old_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $old_value_sc_field_11 = $this->sc_field_11;
   $old_value_sc_field_17 = $this->sc_field_17;
   $old_value_vl_proj_dolar = $this->vl_proj_dolar;
   $old_value_vl_dolar_di = $this->vl_dolar_di;
   $old_value_sc_field_16 = $this->sc_field_16;
   $old_value_ptax = $this->ptax;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_sc_field_10 = $this->sc_field_10;
   $unformatted_value_sc_field_3 = $this->sc_field_3;
   $unformatted_value_cod_agente_cargas = $this->cod_agente_cargas;
   $unformatted_value_cod_armador = $this->cod_armador;
   $unformatted_value_situacao = $this->situacao;
   $unformatted_value_perc_custo = $this->perc_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $unformatted_value_dt_prev_embarque = $this->dt_prev_embarque;
   $unformatted_value_dt_real_embarque = $this->dt_real_embarque;
   $unformatted_value_sc_field_12 = $this->sc_field_12;
   $unformatted_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $unformatted_value_sc_field_11 = $this->sc_field_11;
   $unformatted_value_sc_field_17 = $this->sc_field_17;
   $unformatted_value_vl_proj_dolar = $this->vl_proj_dolar;
   $unformatted_value_vl_dolar_di = $this->vl_dolar_di;
   $unformatted_value_sc_field_16 = $this->sc_field_16;
   $unformatted_value_ptax = $this->ptax;

   $nm_comando = "SELECT situacao_container_id, descricao  FROM PUB.situacoes_container";

   $this->sc_field_10 = $old_value_sc_field_10;
   $this->sc_field_3 = $old_value_sc_field_3;
   $this->cod_agente_cargas = $old_value_cod_agente_cargas;
   $this->cod_armador = $old_value_cod_armador;
   $this->situacao = $old_value_situacao;
   $this->perc_custo = $old_value_perc_custo;
   $this->dt_hr_ult_alt_versao_custo = $old_value_dt_hr_ult_alt_versao_custo;
   $this->dt_hr_ult_alt_versao_custo_hora = $old_value_dt_hr_ult_alt_versao_custo_hora;
   $this->dt_prev_embarque = $old_value_dt_prev_embarque;
   $this->dt_real_embarque = $old_value_dt_real_embarque;
   $this->sc_field_12 = $old_value_sc_field_12;
   $this->dt_prev_chegada_loja = $old_value_dt_prev_chegada_loja;
   $this->sc_field_11 = $old_value_sc_field_11;
   $this->sc_field_17 = $old_value_sc_field_17;
   $this->vl_proj_dolar = $old_value_vl_proj_dolar;
   $this->vl_dolar_di = $old_value_vl_dolar_di;
   $this->sc_field_16 = $old_value_sc_field_16;
   $this->ptax = $old_value_ptax;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'][] = $rs->fields[0];
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
   $situacao_container_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->situacao_container_id_1))
          {
              foreach ($this->situacao_container_id_1 as $tmp_situacao_container_id)
              {
                  if (trim($tmp_situacao_container_id) === trim($cadaselect[1])) {$situacao_container_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->situacao_container_id) && trim($this->situacao_container_id) === trim($cadaselect[1])) {$situacao_container_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="situacao_container_id" value="<?php echo $this->form_encode_input($situacao_container_id) . "\">" . $situacao_container_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_situacao_container_id();
   $x = 0 ; 
   $situacao_container_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->situacao_container_id_1))
          {
              foreach ($this->situacao_container_id_1 as $tmp_situacao_container_id)
              {
                  if (trim($tmp_situacao_container_id) === trim($cadaselect[1])) {$situacao_container_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->situacao_container_id)) {
                 if (trim($this->situacao_container_id) == trim($cadaselect[1])) { $situacao_container_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->situacao_container_id == $cadaselect[1]) { $situacao_container_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($situacao_container_id_look))
          {
              $situacao_container_id_look = $this->situacao_container_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_situacao_container_id\" class=\"css_situacao_container_id_line\" style=\"" .  $sStyleReadLab_situacao_container_id . "\">" . $this->form_format_readonly("situacao_container_id", $this->form_encode_input($situacao_container_id_look)) . "</span><span id=\"id_read_off_situacao_container_id\" class=\"css_read_off_situacao_container_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_situacao_container_id . "\">";
   echo " <span id=\"idAjaxSelect_situacao_container_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_situacao_container_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_situacao_container_id\" name=\"situacao_container_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_situacao_container_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->situacao_container_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->situacao_container_id)) 
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
   if (isset($this->Ini->sc_lig_md5["form_situacoes_container"]) && $this->Ini->sc_lig_md5["form_situacoes_container"] == "S") {
       $Parms_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_pp_container_lkpedt_refresh_situacao_container_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_pp_container@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_pp_container_lkpedt_refresh_situacao_container_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "nm_submit_cap('" . $this->Ini->link_form_situacoes_container_edit. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_form_situacoes_container_edit. "', '" . $Md5_Lig . "')", "fldedt_situacao_container_id", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_situacao_container_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_situacao_container_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_medidas_container_dumb = ('' == $sStyleHidden_medidas_container) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_medidas_container_dumb" style="<?php echo $sStyleHidden_medidas_container_dumb; ?>"></TD>
<?php $sStyleHidden_situacao_container_id_dumb = ('' == $sStyleHidden_situacao_container_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_situacao_container_id_dumb" style="<?php echo $sStyleHidden_situacao_container_id_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['perc_custo']))
    {
        $this->nm_new_label['perc_custo'] = "% Custo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $perc_custo = $this->perc_custo;
   $sStyleHidden_perc_custo = '';
   if (isset($this->nmgp_cmp_hidden['perc_custo']) && $this->nmgp_cmp_hidden['perc_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['perc_custo']);
       $sStyleHidden_perc_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_perc_custo = 'display: none;';
   $sStyleReadInp_perc_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['perc_custo']) && $this->nmgp_cmp_readonly['perc_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['perc_custo']);
       $sStyleReadLab_perc_custo = '';
       $sStyleReadInp_perc_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['perc_custo']) && $this->nmgp_cmp_hidden['perc_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="perc_custo" value="<?php echo $this->form_encode_input($perc_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_perc_custo_line" id="hidden_field_data_perc_custo" style="<?php echo $sStyleHidden_perc_custo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_perc_custo_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_perc_custo_label" style=""><span id="id_label_perc_custo"><?php echo $this->nm_new_label['perc_custo']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["perc_custo"]) &&  $this->nmgp_cmp_readonly["perc_custo"] == "on") { 

 ?>
<input type="hidden" name="perc_custo" value="<?php echo $this->form_encode_input($perc_custo) . "\">" . $perc_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_perc_custo" class="sc-ui-readonly-perc_custo css_perc_custo_line" style="<?php echo $sStyleReadLab_perc_custo; ?>"><?php echo $this->form_format_readonly("perc_custo", $this->form_encode_input($this->perc_custo)); ?></span><span id="id_read_off_perc_custo" class="css_read_off_perc_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_perc_custo; ?>">
 <input class="sc-js-input scFormObjectOdd css_perc_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_perc_custo" type=text name="perc_custo" value="<?php echo $this->form_encode_input($perc_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_custo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_custo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['perc_custo']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['perc_custo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_perc_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_perc_custo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['log_versao_custo_desatualizada']))
   {
       $this->nm_new_label['log_versao_custo_desatualizada'] = "Versão de Custo Desatualizada?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_versao_custo_desatualizada = $this->log_versao_custo_desatualizada;
   $sStyleHidden_log_versao_custo_desatualizada = '';
   if (isset($this->nmgp_cmp_hidden['log_versao_custo_desatualizada']) && $this->nmgp_cmp_hidden['log_versao_custo_desatualizada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_versao_custo_desatualizada']);
       $sStyleHidden_log_versao_custo_desatualizada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_versao_custo_desatualizada = 'display: none;';
   $sStyleReadInp_log_versao_custo_desatualizada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_versao_custo_desatualizada']) && $this->nmgp_cmp_readonly['log_versao_custo_desatualizada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_versao_custo_desatualizada']);
       $sStyleReadLab_log_versao_custo_desatualizada = '';
       $sStyleReadInp_log_versao_custo_desatualizada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_versao_custo_desatualizada']) && $this->nmgp_cmp_hidden['log_versao_custo_desatualizada'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_versao_custo_desatualizada" value="<?php echo $this->form_encode_input($this->log_versao_custo_desatualizada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_versao_custo_desatualizada_line" id="hidden_field_data_log_versao_custo_desatualizada" style="<?php echo $sStyleHidden_log_versao_custo_desatualizada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_versao_custo_desatualizada_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_versao_custo_desatualizada_label" style=""><span id="id_label_log_versao_custo_desatualizada"><?php echo $this->nm_new_label['log_versao_custo_desatualizada']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_versao_custo_desatualizada"]) &&  $this->nmgp_cmp_readonly["log_versao_custo_desatualizada"] == "on") { 

$log_versao_custo_desatualizada_look = "";
 if ($this->log_versao_custo_desatualizada == "1") { $log_versao_custo_desatualizada_look .= "Sim" ;} 
 if ($this->log_versao_custo_desatualizada == "0") { $log_versao_custo_desatualizada_look .= "Não" ;} 
 if (empty($log_versao_custo_desatualizada_look)) { $log_versao_custo_desatualizada_look = $this->log_versao_custo_desatualizada; }
?>
<input type="hidden" name="log_versao_custo_desatualizada" value="<?php echo $this->form_encode_input($log_versao_custo_desatualizada) . "\">" . $log_versao_custo_desatualizada_look . ""; ?>
<?php } else { ?>
<?php

$log_versao_custo_desatualizada_look = "";
 if ($this->log_versao_custo_desatualizada == "1") { $log_versao_custo_desatualizada_look .= "Sim" ;} 
 if ($this->log_versao_custo_desatualizada == "0") { $log_versao_custo_desatualizada_look .= "Não" ;} 
 if (empty($log_versao_custo_desatualizada_look)) { $log_versao_custo_desatualizada_look = $this->log_versao_custo_desatualizada; }
?>
<span id="id_read_on_log_versao_custo_desatualizada" class="css_log_versao_custo_desatualizada_line"  style="<?php echo $sStyleReadLab_log_versao_custo_desatualizada; ?>"><?php echo $this->form_format_readonly("log_versao_custo_desatualizada", $this->form_encode_input($log_versao_custo_desatualizada_look)); ?></span><span id="id_read_off_log_versao_custo_desatualizada" class="css_read_off_log_versao_custo_desatualizada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_versao_custo_desatualizada; ?>">
 <span id="idAjaxSelect_log_versao_custo_desatualizada" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_versao_custo_desatualizada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_versao_custo_desatualizada" name="log_versao_custo_desatualizada" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_versao_custo_desatualizada == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_versao_custo_desatualizada'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_versao_custo_desatualizada == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_versao_custo_desatualizada'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_versao_custo_desatualizada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_versao_custo_desatualizada_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_perc_custo_dumb = ('' == $sStyleHidden_perc_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_perc_custo_dumb" style="<?php echo $sStyleHidden_perc_custo_dumb; ?>"></TD>
<?php $sStyleHidden_log_versao_custo_desatualizada_dumb = ('' == $sStyleHidden_log_versao_custo_desatualizada) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_versao_custo_desatualizada_dumb" style="<?php echo $sStyleHidden_log_versao_custo_desatualizada_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_hr_ult_alt_versao_custo']))
    {
        $this->nm_new_label['dt_hr_ult_alt_versao_custo'] = "Dt.Hr.Ult.Alt.Versão Custo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $guarda_datahora = $this->field_config['dt_hr_ult_alt_versao_custo']['date_format'];
   $this->field_config['dt_hr_ult_alt_versao_custo']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
   $sStyleHidden_dt_hr_ult_alt_versao_custo = '';
   if (isset($this->nmgp_cmp_hidden['dt_hr_ult_alt_versao_custo']) && $this->nmgp_cmp_hidden['dt_hr_ult_alt_versao_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_hr_ult_alt_versao_custo']);
       $sStyleHidden_dt_hr_ult_alt_versao_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_hr_ult_alt_versao_custo = 'display: none;';
   $sStyleReadInp_dt_hr_ult_alt_versao_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_hr_ult_alt_versao_custo']) && $this->nmgp_cmp_readonly['dt_hr_ult_alt_versao_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_hr_ult_alt_versao_custo']);
       $sStyleReadLab_dt_hr_ult_alt_versao_custo = '';
       $sStyleReadInp_dt_hr_ult_alt_versao_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_hr_ult_alt_versao_custo']) && $this->nmgp_cmp_hidden['dt_hr_ult_alt_versao_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_hr_ult_alt_versao_custo" value="<?php echo $this->form_encode_input($dt_hr_ult_alt_versao_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dt_hr_ult_alt_versao_custo_hora_line" id="hidden_field_data_dt_hr_ult_alt_versao_custo" style="<?php echo $sStyleHidden_dt_hr_ult_alt_versao_custo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_hr_ult_alt_versao_custo_hora_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_hr_ult_alt_versao_custo_label" style=""><span id="id_label_dt_hr_ult_alt_versao_custo"><?php echo $this->nm_new_label['dt_hr_ult_alt_versao_custo']; ?></span></span><br><input type="hidden" name="dt_hr_ult_alt_versao_custo" value="<?php echo $this->form_encode_input($dt_hr_ult_alt_versao_custo); ?>"><span id="id_ajax_label_dt_hr_ult_alt_versao_custo"><?php echo nl2br($dt_hr_ult_alt_versao_custo); ?></span>
<?php
$tmp_form_data = $this->field_config['dt_hr_ult_alt_versao_custo']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span>
<input type="hidden" name="dt_hr_ult_alt_versao_custo_hora" value="<?php echo $this->form_encode_input($dt_hr_ult_alt_versao_custo_hora); ?>"><span id="id_ajax_label_dt_hr_ult_alt_versao_custo_hora"><?php echo nl2br($dt_hr_ult_alt_versao_custo_hora); ?></span>
<?php
$tmp_form_data = $this->field_config['dt_hr_ult_alt_versao_custo_hora']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_hr_ult_alt_versao_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_hr_ult_alt_versao_custo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="1" >&nbsp;</TD>




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
<?php $sStyleHidden_dt_hr_ult_alt_versao_custo_dumb = ('' == $sStyleHidden_dt_hr_ult_alt_versao_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_hr_ult_alt_versao_custo_dumb" style="<?php echo $sStyleHidden_dt_hr_ult_alt_versao_custo_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_dt_embarque']))
   {
       $this->nm_new_label['ind_dt_embarque'] = "Sit.Dt.Embarque";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_dt_embarque = $this->ind_dt_embarque;
   $sStyleHidden_ind_dt_embarque = '';
   if (isset($this->nmgp_cmp_hidden['ind_dt_embarque']) && $this->nmgp_cmp_hidden['ind_dt_embarque'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_dt_embarque']);
       $sStyleHidden_ind_dt_embarque = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_dt_embarque = 'display: none;';
   $sStyleReadInp_ind_dt_embarque = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_dt_embarque']) && $this->nmgp_cmp_readonly['ind_dt_embarque'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_dt_embarque']);
       $sStyleReadLab_ind_dt_embarque = '';
       $sStyleReadInp_ind_dt_embarque = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_dt_embarque']) && $this->nmgp_cmp_hidden['ind_dt_embarque'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_dt_embarque" value="<?php echo $this->form_encode_input($this->ind_dt_embarque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ind_dt_embarque_line" id="hidden_field_data_ind_dt_embarque" style="<?php echo $sStyleHidden_ind_dt_embarque; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_dt_embarque_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_dt_embarque_label" style=""><span id="id_label_ind_dt_embarque"><?php echo $this->nm_new_label['ind_dt_embarque']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_dt_embarque"]) &&  $this->nmgp_cmp_readonly["ind_dt_embarque"] == "on") { 

$ind_dt_embarque_look = "";
 if ($this->ind_dt_embarque == "1") { $ind_dt_embarque_look .= "Previsão Inicial" ;} 
 if ($this->ind_dt_embarque == "2") { $ind_dt_embarque_look .= "Após Informação do Fornecedor" ;} 
 if ($this->ind_dt_embarque == "3") { $ind_dt_embarque_look .= "Confirmada Pelo Agente de Cargas" ;} 
 if (empty($ind_dt_embarque_look)) { $ind_dt_embarque_look = $this->ind_dt_embarque; }
?>
<input type="hidden" name="ind_dt_embarque" value="<?php echo $this->form_encode_input($ind_dt_embarque) . "\">" . $ind_dt_embarque_look . ""; ?>
<?php } else { ?>
<?php

$ind_dt_embarque_look = "";
 if ($this->ind_dt_embarque == "1") { $ind_dt_embarque_look .= "Previsão Inicial" ;} 
 if ($this->ind_dt_embarque == "2") { $ind_dt_embarque_look .= "Após Informação do Fornecedor" ;} 
 if ($this->ind_dt_embarque == "3") { $ind_dt_embarque_look .= "Confirmada Pelo Agente de Cargas" ;} 
 if (empty($ind_dt_embarque_look)) { $ind_dt_embarque_look = $this->ind_dt_embarque; }
?>
<span id="id_read_on_ind_dt_embarque" class="css_ind_dt_embarque_line"  style="<?php echo $sStyleReadLab_ind_dt_embarque; ?>"><?php echo $this->form_format_readonly("ind_dt_embarque", $this->form_encode_input($ind_dt_embarque_look)); ?></span><span id="id_read_off_ind_dt_embarque" class="css_read_off_ind_dt_embarque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_dt_embarque; ?>">
 <span id="idAjaxSelect_ind_dt_embarque" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_dt_embarque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_dt_embarque" name="ind_dt_embarque" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_embarque'][] = '0'; ?>
 <option value="0"></option>
 <option  value="1" <?php  if ($this->ind_dt_embarque == "1") { echo " selected" ;} ?>>Previsão Inicial</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_embarque'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_dt_embarque == "2") { echo " selected" ;} ?>>Após Informação do Fornecedor</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_embarque'][] = '2'; ?>
 <option  value="3" <?php  if ($this->ind_dt_embarque == "3") { echo " selected" ;} ?>>Confirmada Pelo Agente de Cargas</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_embarque'][] = '3'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_dt_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_dt_embarque_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_prev_embarque']))
    {
        $this->nm_new_label['dt_prev_embarque'] = "Dt. Prev. Embarque";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_embarque = $this->dt_prev_embarque;
   $sStyleHidden_dt_prev_embarque = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_embarque']) && $this->nmgp_cmp_hidden['dt_prev_embarque'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_embarque']);
       $sStyleHidden_dt_prev_embarque = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_embarque = 'display: none;';
   $sStyleReadInp_dt_prev_embarque = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_embarque']) && $this->nmgp_cmp_readonly['dt_prev_embarque'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_embarque']);
       $sStyleReadLab_dt_prev_embarque = '';
       $sStyleReadInp_dt_prev_embarque = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_embarque']) && $this->nmgp_cmp_hidden['dt_prev_embarque'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_embarque" value="<?php echo $this->form_encode_input($dt_prev_embarque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dt_prev_embarque_line" id="hidden_field_data_dt_prev_embarque" style="<?php echo $sStyleHidden_dt_prev_embarque; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_embarque_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_embarque_label" style=""><span id="id_label_dt_prev_embarque"><?php echo $this->nm_new_label['dt_prev_embarque']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_embarque"]) &&  $this->nmgp_cmp_readonly["dt_prev_embarque"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_embarque" value="<?php echo $this->form_encode_input($dt_prev_embarque) . "\">" . $dt_prev_embarque . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_embarque" class="sc-ui-readonly-dt_prev_embarque css_dt_prev_embarque_line" style="<?php echo $sStyleReadLab_dt_prev_embarque; ?>"><?php echo $this->form_format_readonly("dt_prev_embarque", $this->form_encode_input($dt_prev_embarque)); ?></span><span id="id_read_off_dt_prev_embarque" class="css_read_off_dt_prev_embarque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_embarque; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_embarque']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_embarque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_embarque" type=text name="dt_prev_embarque" value="<?php echo $this->form_encode_input($dt_prev_embarque) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_embarque']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_embarque']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_embarque_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_real_embarque']))
    {
        $this->nm_new_label['dt_real_embarque'] = "Dt Real Embarque";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_real_embarque = $this->dt_real_embarque;
   $sStyleHidden_dt_real_embarque = '';
   if (isset($this->nmgp_cmp_hidden['dt_real_embarque']) && $this->nmgp_cmp_hidden['dt_real_embarque'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_real_embarque']);
       $sStyleHidden_dt_real_embarque = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_real_embarque = 'display: none;';
   $sStyleReadInp_dt_real_embarque = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_real_embarque']) && $this->nmgp_cmp_readonly['dt_real_embarque'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_real_embarque']);
       $sStyleReadLab_dt_real_embarque = '';
       $sStyleReadInp_dt_real_embarque = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_real_embarque']) && $this->nmgp_cmp_hidden['dt_real_embarque'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_real_embarque" value="<?php echo $this->form_encode_input($dt_real_embarque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dt_real_embarque_line" id="hidden_field_data_dt_real_embarque" style="<?php echo $sStyleHidden_dt_real_embarque; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_real_embarque_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_real_embarque_label" style=""><span id="id_label_dt_real_embarque"><?php echo $this->nm_new_label['dt_real_embarque']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_real_embarque"]) &&  $this->nmgp_cmp_readonly["dt_real_embarque"] == "on") { 

 ?>
<input type="hidden" name="dt_real_embarque" value="<?php echo $this->form_encode_input($dt_real_embarque) . "\">" . $dt_real_embarque . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_real_embarque" class="sc-ui-readonly-dt_real_embarque css_dt_real_embarque_line" style="<?php echo $sStyleReadLab_dt_real_embarque; ?>"><?php echo $this->form_format_readonly("dt_real_embarque", $this->form_encode_input($dt_real_embarque)); ?></span><span id="id_read_off_dt_real_embarque" class="css_read_off_dt_real_embarque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_real_embarque; ?>"><?php
$tmp_form_data = $this->field_config['dt_real_embarque']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_real_embarque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_real_embarque" type=text name="dt_real_embarque" value="<?php echo $this->form_encode_input($dt_real_embarque) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_real_embarque']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_real_embarque']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_real_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_real_embarque_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_dt_real_embarque_dumb = ('' == $sStyleHidden_dt_real_embarque) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_embarque_dumb" style="<?php echo $sStyleHidden_dt_real_embarque_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_dt_prev_chegada']))
   {
       $this->nm_new_label['ind_dt_prev_chegada'] = "Sit.Dt.Prev.Chegada";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_dt_prev_chegada = $this->ind_dt_prev_chegada;
   $sStyleHidden_ind_dt_prev_chegada = '';
   if (isset($this->nmgp_cmp_hidden['ind_dt_prev_chegada']) && $this->nmgp_cmp_hidden['ind_dt_prev_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_dt_prev_chegada']);
       $sStyleHidden_ind_dt_prev_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_dt_prev_chegada = 'display: none;';
   $sStyleReadInp_ind_dt_prev_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_dt_prev_chegada']) && $this->nmgp_cmp_readonly['ind_dt_prev_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_dt_prev_chegada']);
       $sStyleReadLab_ind_dt_prev_chegada = '';
       $sStyleReadInp_ind_dt_prev_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_dt_prev_chegada']) && $this->nmgp_cmp_hidden['ind_dt_prev_chegada'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_dt_prev_chegada" value="<?php echo $this->form_encode_input($this->ind_dt_prev_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ind_dt_prev_chegada_line" id="hidden_field_data_ind_dt_prev_chegada" style="<?php echo $sStyleHidden_ind_dt_prev_chegada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_dt_prev_chegada_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_dt_prev_chegada_label" style=""><span id="id_label_ind_dt_prev_chegada"><?php echo $this->nm_new_label['ind_dt_prev_chegada']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_dt_prev_chegada"]) &&  $this->nmgp_cmp_readonly["ind_dt_prev_chegada"] == "on") { 

$ind_dt_prev_chegada_look = "";
 if ($this->ind_dt_prev_chegada == "1") { $ind_dt_prev_chegada_look .= "Previsão Inicial" ;} 
 if ($this->ind_dt_prev_chegada == "2") { $ind_dt_prev_chegada_look .= "Após Informação Agende de Cargas" ;} 
 if ($this->ind_dt_prev_chegada == "3") { $ind_dt_prev_chegada_look .= "Data Confirmada pelo Agente de Cargas" ;} 
 if (empty($ind_dt_prev_chegada_look)) { $ind_dt_prev_chegada_look = $this->ind_dt_prev_chegada; }
?>
<input type="hidden" name="ind_dt_prev_chegada" value="<?php echo $this->form_encode_input($ind_dt_prev_chegada) . "\">" . $ind_dt_prev_chegada_look . ""; ?>
<?php } else { ?>
<?php

$ind_dt_prev_chegada_look = "";
 if ($this->ind_dt_prev_chegada == "1") { $ind_dt_prev_chegada_look .= "Previsão Inicial" ;} 
 if ($this->ind_dt_prev_chegada == "2") { $ind_dt_prev_chegada_look .= "Após Informação Agende de Cargas" ;} 
 if ($this->ind_dt_prev_chegada == "3") { $ind_dt_prev_chegada_look .= "Data Confirmada pelo Agente de Cargas" ;} 
 if (empty($ind_dt_prev_chegada_look)) { $ind_dt_prev_chegada_look = $this->ind_dt_prev_chegada; }
?>
<span id="id_read_on_ind_dt_prev_chegada" class="css_ind_dt_prev_chegada_line"  style="<?php echo $sStyleReadLab_ind_dt_prev_chegada; ?>"><?php echo $this->form_format_readonly("ind_dt_prev_chegada", $this->form_encode_input($ind_dt_prev_chegada_look)); ?></span><span id="id_read_off_ind_dt_prev_chegada" class="css_read_off_ind_dt_prev_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_dt_prev_chegada; ?>">
 <span id="idAjaxSelect_ind_dt_prev_chegada" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_dt_prev_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_dt_prev_chegada" name="ind_dt_prev_chegada" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_prev_chegada'][] = '0'; ?>
 <option value="0"></option>
 <option  value="1" <?php  if ($this->ind_dt_prev_chegada == "1") { echo " selected" ;} ?>>Previsão Inicial</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_prev_chegada'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_dt_prev_chegada == "2") { echo " selected" ;} ?>>Após Informação Agende de Cargas</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_prev_chegada'][] = '2'; ?>
 <option  value="3" <?php  if ($this->ind_dt_prev_chegada == "3") { echo " selected" ;} ?>>Data Confirmada pelo Agente de Cargas</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ind_dt_prev_chegada'][] = '3'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_dt_prev_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_dt_prev_chegada_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_12']))
    {
        $this->nm_new_label['sc_field_12'] = "Dt Prev Chegada";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_12 = $this->sc_field_12;
   $sStyleHidden_sc_field_12 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_12']) && $this->nmgp_cmp_hidden['sc_field_12'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_12']);
       $sStyleHidden_sc_field_12 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_12 = 'display: none;';
   $sStyleReadInp_sc_field_12 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_12']) && $this->nmgp_cmp_readonly['sc_field_12'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_12']);
       $sStyleReadLab_sc_field_12 = '';
       $sStyleReadInp_sc_field_12 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_12']) && $this->nmgp_cmp_hidden['sc_field_12'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_12" value="<?php echo $this->form_encode_input($sc_field_12) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_12_line" id="hidden_field_data_sc_field_12" style="<?php echo $sStyleHidden_sc_field_12; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_12_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_12_label" style=""><span id="id_label_sc_field_12"><?php echo $this->nm_new_label['sc_field_12']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_12"]) &&  $this->nmgp_cmp_readonly["sc_field_12"] == "on") { 

 ?>
<input type="hidden" name="sc_field_12" value="<?php echo $this->form_encode_input($sc_field_12) . "\">" . $sc_field_12 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_12" class="sc-ui-readonly-sc_field_12 css_sc_field_12_line" style="<?php echo $sStyleReadLab_sc_field_12; ?>"><?php echo $this->form_format_readonly("sc_field_12", $this->form_encode_input($sc_field_12)); ?></span><span id="id_read_off_sc_field_12" class="css_read_off_sc_field_12<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_12; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_12']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_12_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_12" type=text name="sc_field_12" value="<?php echo $this->form_encode_input($sc_field_12) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_12']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_12']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_12_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_12_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_prev_chegada_loja']))
    {
        $this->nm_new_label['dt_prev_chegada_loja'] = "Dt Prev Chegada Loja";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $sStyleHidden_dt_prev_chegada_loja = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_chegada_loja']) && $this->nmgp_cmp_hidden['dt_prev_chegada_loja'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_chegada_loja']);
       $sStyleHidden_dt_prev_chegada_loja = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_chegada_loja = 'display: none;';
   $sStyleReadInp_dt_prev_chegada_loja = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_chegada_loja']) && $this->nmgp_cmp_readonly['dt_prev_chegada_loja'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_chegada_loja']);
       $sStyleReadLab_dt_prev_chegada_loja = '';
       $sStyleReadInp_dt_prev_chegada_loja = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_chegada_loja']) && $this->nmgp_cmp_hidden['dt_prev_chegada_loja'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_chegada_loja" value="<?php echo $this->form_encode_input($dt_prev_chegada_loja) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dt_prev_chegada_loja_line" id="hidden_field_data_dt_prev_chegada_loja" style="<?php echo $sStyleHidden_dt_prev_chegada_loja; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_chegada_loja_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_chegada_loja_label" style=""><span id="id_label_dt_prev_chegada_loja"><?php echo $this->nm_new_label['dt_prev_chegada_loja']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_chegada_loja"]) &&  $this->nmgp_cmp_readonly["dt_prev_chegada_loja"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_chegada_loja" value="<?php echo $this->form_encode_input($dt_prev_chegada_loja) . "\">" . $dt_prev_chegada_loja . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_chegada_loja" class="sc-ui-readonly-dt_prev_chegada_loja css_dt_prev_chegada_loja_line" style="<?php echo $sStyleReadLab_dt_prev_chegada_loja; ?>"><?php echo $this->form_format_readonly("dt_prev_chegada_loja", $this->form_encode_input($dt_prev_chegada_loja)); ?></span><span id="id_read_off_dt_prev_chegada_loja" class="css_read_off_dt_prev_chegada_loja<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_chegada_loja; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_chegada_loja']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_chegada_loja_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_chegada_loja" type=text name="dt_prev_chegada_loja" value="<?php echo $this->form_encode_input($dt_prev_chegada_loja) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_chegada_loja']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_chegada_loja']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_chegada_loja_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_chegada_loja_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_11']))
    {
        $this->nm_new_label['sc_field_11'] = "Dt Recebimento";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_11 = $this->sc_field_11;
   $sStyleHidden_sc_field_11 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_11']) && $this->nmgp_cmp_hidden['sc_field_11'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_11']);
       $sStyleHidden_sc_field_11 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_11 = 'display: none;';
   $sStyleReadInp_sc_field_11 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_11']) && $this->nmgp_cmp_readonly['sc_field_11'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_11']);
       $sStyleReadLab_sc_field_11 = '';
       $sStyleReadInp_sc_field_11 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_11']) && $this->nmgp_cmp_hidden['sc_field_11'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_11" value="<?php echo $this->form_encode_input($sc_field_11) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_11_line" id="hidden_field_data_sc_field_11" style="<?php echo $sStyleHidden_sc_field_11; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_11_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_11_label" style=""><span id="id_label_sc_field_11"><?php echo $this->nm_new_label['sc_field_11']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_11"]) &&  $this->nmgp_cmp_readonly["sc_field_11"] == "on") { 

 ?>
<input type="hidden" name="sc_field_11" value="<?php echo $this->form_encode_input($sc_field_11) . "\">" . $sc_field_11 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_11" class="sc-ui-readonly-sc_field_11 css_sc_field_11_line" style="<?php echo $sStyleReadLab_sc_field_11; ?>"><?php echo $this->form_format_readonly("sc_field_11", $this->form_encode_input($sc_field_11)); ?></span><span id="id_read_off_sc_field_11" class="css_read_off_sc_field_11<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_11; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_11']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_11_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_11" type=text name="sc_field_11" value="<?php echo $this->form_encode_input($sc_field_11) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_11']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_11']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_11_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_11_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_sc_field_11_dumb = ('' == $sStyleHidden_sc_field_11) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sc_field_11_dumb" style="<?php echo $sStyleHidden_sc_field_11_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_3"></a>
<div id="div_hidden_bloco_3" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_pagto_final']))
   {
       $this->nm_new_label['log_pagto_final'] = "Pagto Final Realizado?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_pagto_final = $this->log_pagto_final;
   $sStyleHidden_log_pagto_final = '';
   if (isset($this->nmgp_cmp_hidden['log_pagto_final']) && $this->nmgp_cmp_hidden['log_pagto_final'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_pagto_final']);
       $sStyleHidden_log_pagto_final = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_pagto_final = 'display: none;';
   $sStyleReadInp_log_pagto_final = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_pagto_final']) && $this->nmgp_cmp_readonly['log_pagto_final'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_pagto_final']);
       $sStyleReadLab_log_pagto_final = '';
       $sStyleReadInp_log_pagto_final = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_pagto_final']) && $this->nmgp_cmp_hidden['log_pagto_final'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_pagto_final" value="<?php echo $this->form_encode_input($this->log_pagto_final) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_pagto_final_line" id="hidden_field_data_log_pagto_final" style="<?php echo $sStyleHidden_log_pagto_final; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_pagto_final_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_pagto_final_label" style=""><span id="id_label_log_pagto_final"><?php echo $this->nm_new_label['log_pagto_final']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_pagto_final"]) &&  $this->nmgp_cmp_readonly["log_pagto_final"] == "on") { 

$log_pagto_final_look = "";
 if ($this->log_pagto_final == "1") { $log_pagto_final_look .= "Sim" ;} 
 if ($this->log_pagto_final == "0") { $log_pagto_final_look .= "Não" ;} 
 if (empty($log_pagto_final_look)) { $log_pagto_final_look = $this->log_pagto_final; }
?>
<input type="hidden" name="log_pagto_final" value="<?php echo $this->form_encode_input($log_pagto_final) . "\">" . $log_pagto_final_look . ""; ?>
<?php } else { ?>
<?php

$log_pagto_final_look = "";
 if ($this->log_pagto_final == "1") { $log_pagto_final_look .= "Sim" ;} 
 if ($this->log_pagto_final == "0") { $log_pagto_final_look .= "Não" ;} 
 if (empty($log_pagto_final_look)) { $log_pagto_final_look = $this->log_pagto_final; }
?>
<span id="id_read_on_log_pagto_final" class="css_log_pagto_final_line"  style="<?php echo $sStyleReadLab_log_pagto_final; ?>"><?php echo $this->form_format_readonly("log_pagto_final", $this->form_encode_input($log_pagto_final_look)); ?></span><span id="id_read_off_log_pagto_final" class="css_read_off_log_pagto_final<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_pagto_final; ?>">
 <span id="idAjaxSelect_log_pagto_final" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_pagto_final_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_pagto_final" name="log_pagto_final" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_pagto_final == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_pagto_final'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_pagto_final == "0") { echo " selected" ;} ?><?php  if (empty($this->log_pagto_final)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_pagto_final'][] = '0'; ?>
 </select></span>
</span><?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('log_pagto_final')", "nm_mostra_mens('log_pagto_final')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_pagto_final_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_pagto_final_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_liberar_custo_realizado']))
   {
       $this->nm_new_label['log_liberar_custo_realizado'] = "Liberar Custo Realizado?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_liberar_custo_realizado = $this->log_liberar_custo_realizado;
   $sStyleHidden_log_liberar_custo_realizado = '';
   if (isset($this->nmgp_cmp_hidden['log_liberar_custo_realizado']) && $this->nmgp_cmp_hidden['log_liberar_custo_realizado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_liberar_custo_realizado']);
       $sStyleHidden_log_liberar_custo_realizado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_liberar_custo_realizado = 'display: none;';
   $sStyleReadInp_log_liberar_custo_realizado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_liberar_custo_realizado']) && $this->nmgp_cmp_readonly['log_liberar_custo_realizado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_liberar_custo_realizado']);
       $sStyleReadLab_log_liberar_custo_realizado = '';
       $sStyleReadInp_log_liberar_custo_realizado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_liberar_custo_realizado']) && $this->nmgp_cmp_hidden['log_liberar_custo_realizado'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_liberar_custo_realizado" value="<?php echo $this->form_encode_input($this->log_liberar_custo_realizado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_liberar_custo_realizado_line" id="hidden_field_data_log_liberar_custo_realizado" style="<?php echo $sStyleHidden_log_liberar_custo_realizado; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_liberar_custo_realizado_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_liberar_custo_realizado_label" style=""><span id="id_label_log_liberar_custo_realizado"><?php echo $this->nm_new_label['log_liberar_custo_realizado']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_liberar_custo_realizado"]) &&  $this->nmgp_cmp_readonly["log_liberar_custo_realizado"] == "on") { 

$log_liberar_custo_realizado_look = "";
 if ($this->log_liberar_custo_realizado == "1") { $log_liberar_custo_realizado_look .= "Sim" ;} 
 if ($this->log_liberar_custo_realizado == "0") { $log_liberar_custo_realizado_look .= "Não" ;} 
 if (empty($log_liberar_custo_realizado_look)) { $log_liberar_custo_realizado_look = $this->log_liberar_custo_realizado; }
?>
<input type="hidden" name="log_liberar_custo_realizado" value="<?php echo $this->form_encode_input($log_liberar_custo_realizado) . "\">" . $log_liberar_custo_realizado_look . ""; ?>
<?php } else { ?>
<?php

$log_liberar_custo_realizado_look = "";
 if ($this->log_liberar_custo_realizado == "1") { $log_liberar_custo_realizado_look .= "Sim" ;} 
 if ($this->log_liberar_custo_realizado == "0") { $log_liberar_custo_realizado_look .= "Não" ;} 
 if (empty($log_liberar_custo_realizado_look)) { $log_liberar_custo_realizado_look = $this->log_liberar_custo_realizado; }
?>
<span id="id_read_on_log_liberar_custo_realizado" class="css_log_liberar_custo_realizado_line"  style="<?php echo $sStyleReadLab_log_liberar_custo_realizado; ?>"><?php echo $this->form_format_readonly("log_liberar_custo_realizado", $this->form_encode_input($log_liberar_custo_realizado_look)); ?></span><span id="id_read_off_log_liberar_custo_realizado" class="css_read_off_log_liberar_custo_realizado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_liberar_custo_realizado; ?>">
 <span id="idAjaxSelect_log_liberar_custo_realizado" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_liberar_custo_realizado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_liberar_custo_realizado" name="log_liberar_custo_realizado" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_liberar_custo_realizado == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_liberar_custo_realizado'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_liberar_custo_realizado == "0") { echo " selected" ;} ?><?php  if (empty($this->log_liberar_custo_realizado)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_liberar_custo_realizado'][] = '0'; ?>
 </select></span>
</span><?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('log_liberar_custo_realizado')", "nm_mostra_mens('log_liberar_custo_realizado')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_liberar_custo_realizado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_liberar_custo_realizado_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_gerar_saldo_a_pagar']))
   {
       $this->nm_new_label['log_gerar_saldo_a_pagar'] = "Considera Cta. Corrente Fornecedor?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_gerar_saldo_a_pagar = $this->log_gerar_saldo_a_pagar;
   $sStyleHidden_log_gerar_saldo_a_pagar = '';
   if (isset($this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar']) && $this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar']);
       $sStyleHidden_log_gerar_saldo_a_pagar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_gerar_saldo_a_pagar = 'display: none;';
   $sStyleReadInp_log_gerar_saldo_a_pagar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_gerar_saldo_a_pagar']) && $this->nmgp_cmp_readonly['log_gerar_saldo_a_pagar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_gerar_saldo_a_pagar']);
       $sStyleReadLab_log_gerar_saldo_a_pagar = '';
       $sStyleReadInp_log_gerar_saldo_a_pagar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar']) && $this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_gerar_saldo_a_pagar" value="<?php echo $this->form_encode_input($this->log_gerar_saldo_a_pagar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_gerar_saldo_a_pagar_line" id="hidden_field_data_log_gerar_saldo_a_pagar" style="<?php echo $sStyleHidden_log_gerar_saldo_a_pagar; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_gerar_saldo_a_pagar_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_gerar_saldo_a_pagar_label" style=""><span id="id_label_log_gerar_saldo_a_pagar"><?php echo $this->nm_new_label['log_gerar_saldo_a_pagar']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_gerar_saldo_a_pagar"]) &&  $this->nmgp_cmp_readonly["log_gerar_saldo_a_pagar"] == "on") { 

$log_gerar_saldo_a_pagar_look = "";
 if ($this->log_gerar_saldo_a_pagar == "1") { $log_gerar_saldo_a_pagar_look .= "Sim" ;} 
 if ($this->log_gerar_saldo_a_pagar == "0") { $log_gerar_saldo_a_pagar_look .= "Não" ;} 
 if (empty($log_gerar_saldo_a_pagar_look)) { $log_gerar_saldo_a_pagar_look = $this->log_gerar_saldo_a_pagar; }
?>
<input type="hidden" name="log_gerar_saldo_a_pagar" value="<?php echo $this->form_encode_input($log_gerar_saldo_a_pagar) . "\">" . $log_gerar_saldo_a_pagar_look . ""; ?>
<?php } else { ?>
<?php

$log_gerar_saldo_a_pagar_look = "";
 if ($this->log_gerar_saldo_a_pagar == "1") { $log_gerar_saldo_a_pagar_look .= "Sim" ;} 
 if ($this->log_gerar_saldo_a_pagar == "0") { $log_gerar_saldo_a_pagar_look .= "Não" ;} 
 if (empty($log_gerar_saldo_a_pagar_look)) { $log_gerar_saldo_a_pagar_look = $this->log_gerar_saldo_a_pagar; }
?>
<span id="id_read_on_log_gerar_saldo_a_pagar" class="css_log_gerar_saldo_a_pagar_line"  style="<?php echo $sStyleReadLab_log_gerar_saldo_a_pagar; ?>"><?php echo $this->form_format_readonly("log_gerar_saldo_a_pagar", $this->form_encode_input($log_gerar_saldo_a_pagar_look)); ?></span><span id="id_read_off_log_gerar_saldo_a_pagar" class="css_read_off_log_gerar_saldo_a_pagar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_gerar_saldo_a_pagar; ?>">
 <span id="idAjaxSelect_log_gerar_saldo_a_pagar" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_gerar_saldo_a_pagar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_gerar_saldo_a_pagar" name="log_gerar_saldo_a_pagar" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_gerar_saldo_a_pagar == "1") { echo " selected" ;} ?><?php  if (empty($this->log_gerar_saldo_a_pagar)) { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_gerar_saldo_a_pagar'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_gerar_saldo_a_pagar == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_gerar_saldo_a_pagar'][] = '0'; ?>
 </select></span>
</span><?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('log_gerar_saldo_a_pagar')", "nm_mostra_mens('log_gerar_saldo_a_pagar')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_gerar_saldo_a_pagar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_gerar_saldo_a_pagar_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_gerar_distr_custo']))
   {
       $this->nm_new_label['log_gerar_distr_custo'] = "Gerar Distr. Custo?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_gerar_distr_custo = $this->log_gerar_distr_custo;
   $sStyleHidden_log_gerar_distr_custo = '';
   if (isset($this->nmgp_cmp_hidden['log_gerar_distr_custo']) && $this->nmgp_cmp_hidden['log_gerar_distr_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_gerar_distr_custo']);
       $sStyleHidden_log_gerar_distr_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_gerar_distr_custo = 'display: none;';
   $sStyleReadInp_log_gerar_distr_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_gerar_distr_custo']) && $this->nmgp_cmp_readonly['log_gerar_distr_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_gerar_distr_custo']);
       $sStyleReadLab_log_gerar_distr_custo = '';
       $sStyleReadInp_log_gerar_distr_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_gerar_distr_custo']) && $this->nmgp_cmp_hidden['log_gerar_distr_custo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_gerar_distr_custo" value="<?php echo $this->form_encode_input($this->log_gerar_distr_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_gerar_distr_custo_line" id="hidden_field_data_log_gerar_distr_custo" style="<?php echo $sStyleHidden_log_gerar_distr_custo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_gerar_distr_custo_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_gerar_distr_custo_label" style=""><span id="id_label_log_gerar_distr_custo"><?php echo $this->nm_new_label['log_gerar_distr_custo']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_gerar_distr_custo"]) &&  $this->nmgp_cmp_readonly["log_gerar_distr_custo"] == "on") { 

$log_gerar_distr_custo_look = "";
 if ($this->log_gerar_distr_custo == "1") { $log_gerar_distr_custo_look .= "Sim" ;} 
 if ($this->log_gerar_distr_custo == "0") { $log_gerar_distr_custo_look .= "Não" ;} 
 if (empty($log_gerar_distr_custo_look)) { $log_gerar_distr_custo_look = $this->log_gerar_distr_custo; }
?>
<input type="hidden" name="log_gerar_distr_custo" value="<?php echo $this->form_encode_input($log_gerar_distr_custo) . "\">" . $log_gerar_distr_custo_look . ""; ?>
<?php } else { ?>
<?php

$log_gerar_distr_custo_look = "";
 if ($this->log_gerar_distr_custo == "1") { $log_gerar_distr_custo_look .= "Sim" ;} 
 if ($this->log_gerar_distr_custo == "0") { $log_gerar_distr_custo_look .= "Não" ;} 
 if (empty($log_gerar_distr_custo_look)) { $log_gerar_distr_custo_look = $this->log_gerar_distr_custo; }
?>
<span id="id_read_on_log_gerar_distr_custo" class="css_log_gerar_distr_custo_line"  style="<?php echo $sStyleReadLab_log_gerar_distr_custo; ?>"><?php echo $this->form_format_readonly("log_gerar_distr_custo", $this->form_encode_input($log_gerar_distr_custo_look)); ?></span><span id="id_read_off_log_gerar_distr_custo" class="css_read_off_log_gerar_distr_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_gerar_distr_custo; ?>">
 <span id="idAjaxSelect_log_gerar_distr_custo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_gerar_distr_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_gerar_distr_custo" name="log_gerar_distr_custo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_gerar_distr_custo == "1") { echo " selected" ;} ?><?php  if (empty($this->log_gerar_distr_custo)) { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_gerar_distr_custo'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_gerar_distr_custo == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_log_gerar_distr_custo'][] = '0'; ?>
 </select></span>
</span><?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('log_gerar_distr_custo')", "nm_mostra_mens('log_gerar_distr_custo')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_gerar_distr_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_gerar_distr_custo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_log_gerar_distr_custo_dumb = ('' == $sStyleHidden_log_gerar_distr_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_gerar_distr_custo_dumb" style="<?php echo $sStyleHidden_log_gerar_distr_custo_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_4"></a>
<div id="div_hidden_bloco_4" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['narrativa']))
    {
        $this->nm_new_label['narrativa'] = "Narrativa";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $narrativa = $this->narrativa;
   $sStyleHidden_narrativa = '';
   if (isset($this->nmgp_cmp_hidden['narrativa']) && $this->nmgp_cmp_hidden['narrativa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['narrativa']);
       $sStyleHidden_narrativa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_narrativa = 'display: none;';
   $sStyleReadInp_narrativa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['narrativa']) && $this->nmgp_cmp_readonly['narrativa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['narrativa']);
       $sStyleReadLab_narrativa = '';
       $sStyleReadInp_narrativa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['narrativa']) && $this->nmgp_cmp_hidden['narrativa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="narrativa" value="<?php echo $this->form_encode_input($narrativa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_narrativa_line" id="hidden_field_data_narrativa" style="<?php echo $sStyleHidden_narrativa; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_narrativa_line" style="vertical-align: top;padding: 0px">
<?php
$narrativa_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($narrativa));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["narrativa"]) &&  $this->nmgp_cmp_readonly["narrativa"] == "on") { 

 ?>
<input type="hidden" name="narrativa" value="<?php echo $this->form_encode_input($narrativa) . "\">" . $narrativa_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_narrativa" class="sc-ui-readonly-narrativa css_narrativa_line" style="<?php echo $sStyleReadLab_narrativa; ?>"><?php echo $this->form_format_readonly("narrativa", $this->form_encode_input($narrativa_val)); ?></span><span id="id_read_off_narrativa" class="css_read_off_narrativa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_narrativa; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_narrativa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="narrativa" id="id_sc_field_narrativa" rows="5" cols="100"
 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $narrativa; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_narrativa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_narrativa_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_5"></a>
<div id="div_hidden_bloco_5" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ordem_busca_dolar_compra']))
   {
       $this->nm_new_label['ordem_busca_dolar_compra'] = "Ordem Busca Dólar Compra";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ordem_busca_dolar_compra = $this->ordem_busca_dolar_compra;
   $sStyleHidden_ordem_busca_dolar_compra = '';
   if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_compra']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_compra'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ordem_busca_dolar_compra']);
       $sStyleHidden_ordem_busca_dolar_compra = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ordem_busca_dolar_compra = 'display: none;';
   $sStyleReadInp_ordem_busca_dolar_compra = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ordem_busca_dolar_compra']) && $this->nmgp_cmp_readonly['ordem_busca_dolar_compra'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ordem_busca_dolar_compra']);
       $sStyleReadLab_ordem_busca_dolar_compra = '';
       $sStyleReadInp_ordem_busca_dolar_compra = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_compra']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_compra'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ordem_busca_dolar_compra" value="<?php echo $this->form_encode_input($this->ordem_busca_dolar_compra) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ordem_busca_dolar_compra_line" id="hidden_field_data_ordem_busca_dolar_compra" style="<?php echo $sStyleHidden_ordem_busca_dolar_compra; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ordem_busca_dolar_compra_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ordem_busca_dolar_compra_label" style=""><span id="id_label_ordem_busca_dolar_compra"><?php echo $this->nm_new_label['ordem_busca_dolar_compra']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['ordem_busca_dolar_compra']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['ordem_busca_dolar_compra'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ordem_busca_dolar_compra"]) &&  $this->nmgp_cmp_readonly["ordem_busca_dolar_compra"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra'] = array(); 
    }

   $old_value_sc_field_10 = $this->sc_field_10;
   $old_value_sc_field_3 = $this->sc_field_3;
   $old_value_cod_agente_cargas = $this->cod_agente_cargas;
   $old_value_cod_armador = $this->cod_armador;
   $old_value_situacao = $this->situacao;
   $old_value_perc_custo = $this->perc_custo;
   $old_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $old_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $old_value_dt_prev_embarque = $this->dt_prev_embarque;
   $old_value_dt_real_embarque = $this->dt_real_embarque;
   $old_value_sc_field_12 = $this->sc_field_12;
   $old_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $old_value_sc_field_11 = $this->sc_field_11;
   $old_value_sc_field_17 = $this->sc_field_17;
   $old_value_vl_proj_dolar = $this->vl_proj_dolar;
   $old_value_vl_dolar_di = $this->vl_dolar_di;
   $old_value_sc_field_16 = $this->sc_field_16;
   $old_value_ptax = $this->ptax;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_sc_field_10 = $this->sc_field_10;
   $unformatted_value_sc_field_3 = $this->sc_field_3;
   $unformatted_value_cod_agente_cargas = $this->cod_agente_cargas;
   $unformatted_value_cod_armador = $this->cod_armador;
   $unformatted_value_situacao = $this->situacao;
   $unformatted_value_perc_custo = $this->perc_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $unformatted_value_dt_prev_embarque = $this->dt_prev_embarque;
   $unformatted_value_dt_real_embarque = $this->dt_real_embarque;
   $unformatted_value_sc_field_12 = $this->sc_field_12;
   $unformatted_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $unformatted_value_sc_field_11 = $this->sc_field_11;
   $unformatted_value_sc_field_17 = $this->sc_field_17;
   $unformatted_value_vl_proj_dolar = $this->vl_proj_dolar;
   $unformatted_value_vl_dolar_di = $this->vl_dolar_di;
   $unformatted_value_sc_field_16 = $this->sc_field_16;
   $unformatted_value_ptax = $this->ptax;

   $nm_comando = "SELECT  top 2 cod_opcao, desc_opcao  FROM PUB.opcoes_lista  where lista_id = '1' ORDER BY desc_opcao";

   $this->sc_field_10 = $old_value_sc_field_10;
   $this->sc_field_3 = $old_value_sc_field_3;
   $this->cod_agente_cargas = $old_value_cod_agente_cargas;
   $this->cod_armador = $old_value_cod_armador;
   $this->situacao = $old_value_situacao;
   $this->perc_custo = $old_value_perc_custo;
   $this->dt_hr_ult_alt_versao_custo = $old_value_dt_hr_ult_alt_versao_custo;
   $this->dt_hr_ult_alt_versao_custo_hora = $old_value_dt_hr_ult_alt_versao_custo_hora;
   $this->dt_prev_embarque = $old_value_dt_prev_embarque;
   $this->dt_real_embarque = $old_value_dt_real_embarque;
   $this->sc_field_12 = $old_value_sc_field_12;
   $this->dt_prev_chegada_loja = $old_value_dt_prev_chegada_loja;
   $this->sc_field_11 = $old_value_sc_field_11;
   $this->sc_field_17 = $old_value_sc_field_17;
   $this->vl_proj_dolar = $old_value_vl_proj_dolar;
   $this->vl_dolar_di = $old_value_vl_dolar_di;
   $this->sc_field_16 = $old_value_sc_field_16;
   $this->ptax = $old_value_ptax;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_compra'][] = $rs->fields[0];
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
   $ordem_busca_dolar_compra_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ordem_busca_dolar_compra_1))
          {
              foreach ($this->ordem_busca_dolar_compra_1 as $tmp_ordem_busca_dolar_compra)
              {
                  if (trim($tmp_ordem_busca_dolar_compra) === trim($cadaselect[1])) {$ordem_busca_dolar_compra_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ordem_busca_dolar_compra) && trim($this->ordem_busca_dolar_compra) === trim($cadaselect[1])) {$ordem_busca_dolar_compra_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="ordem_busca_dolar_compra" value="<?php echo $this->form_encode_input($ordem_busca_dolar_compra) . "\">" . $ordem_busca_dolar_compra_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_ordem_busca_dolar_compra();
   $x = 0 ; 
   $ordem_busca_dolar_compra_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ordem_busca_dolar_compra_1))
          {
              foreach ($this->ordem_busca_dolar_compra_1 as $tmp_ordem_busca_dolar_compra)
              {
                  if (trim($tmp_ordem_busca_dolar_compra) === trim($cadaselect[1])) {$ordem_busca_dolar_compra_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ordem_busca_dolar_compra)) {
                 if (trim($this->ordem_busca_dolar_compra) == trim($cadaselect[1])) { $ordem_busca_dolar_compra_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->ordem_busca_dolar_compra == $cadaselect[1]) { $ordem_busca_dolar_compra_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($ordem_busca_dolar_compra_look))
          {
              $ordem_busca_dolar_compra_look = $this->ordem_busca_dolar_compra;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_ordem_busca_dolar_compra\" class=\"css_ordem_busca_dolar_compra_line\" style=\"" .  $sStyleReadLab_ordem_busca_dolar_compra . "\">" . $this->form_format_readonly("ordem_busca_dolar_compra", $this->form_encode_input($ordem_busca_dolar_compra_look)) . "</span><span id=\"id_read_off_ordem_busca_dolar_compra\" class=\"css_read_off_ordem_busca_dolar_compra" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_ordem_busca_dolar_compra . "\">";
   echo " <span id=\"idAjaxSelect_ordem_busca_dolar_compra\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_ordem_busca_dolar_compra_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_ordem_busca_dolar_compra\" name=\"ordem_busca_dolar_compra\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->ordem_busca_dolar_compra) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->ordem_busca_dolar_compra)) 
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
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ordem_busca_dolar_compra_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ordem_busca_dolar_compra_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_17']))
    {
        $this->nm_new_label['sc_field_17'] = "Vl Dolar Compra";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_17 = $this->sc_field_17;
   $sStyleHidden_sc_field_17 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_17']) && $this->nmgp_cmp_hidden['sc_field_17'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_17']);
       $sStyleHidden_sc_field_17 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_17 = 'display: none;';
   $sStyleReadInp_sc_field_17 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_17']) && $this->nmgp_cmp_readonly['sc_field_17'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_17']);
       $sStyleReadLab_sc_field_17 = '';
       $sStyleReadInp_sc_field_17 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_17']) && $this->nmgp_cmp_hidden['sc_field_17'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_17" value="<?php echo $this->form_encode_input($sc_field_17) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_17_line" id="hidden_field_data_sc_field_17" style="<?php echo $sStyleHidden_sc_field_17; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_17_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_17_label" style=""><span id="id_label_sc_field_17"><?php echo $this->nm_new_label['sc_field_17']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_17"]) &&  $this->nmgp_cmp_readonly["sc_field_17"] == "on") { 

 ?>
<input type="hidden" name="sc_field_17" value="<?php echo $this->form_encode_input($sc_field_17) . "\">" . $sc_field_17 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_17" class="sc-ui-readonly-sc_field_17 css_sc_field_17_line" style="<?php echo $sStyleReadLab_sc_field_17; ?>"><?php echo $this->form_format_readonly("sc_field_17", $this->form_encode_input($this->sc_field_17)); ?></span><span id="id_read_off_sc_field_17" class="css_read_off_sc_field_17<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_17; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_17_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_17" type=text name="sc_field_17" value="<?php echo $this->form_encode_input($sc_field_17) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_17']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_17']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_17']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_17']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_17_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_17_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cod_tipo_proj_dolar']))
   {
       $this->nm_new_label['cod_tipo_proj_dolar'] = "Tipo Projeção";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_tipo_proj_dolar = $this->cod_tipo_proj_dolar;
   $sStyleHidden_cod_tipo_proj_dolar = '';
   if (isset($this->nmgp_cmp_hidden['cod_tipo_proj_dolar']) && $this->nmgp_cmp_hidden['cod_tipo_proj_dolar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_tipo_proj_dolar']);
       $sStyleHidden_cod_tipo_proj_dolar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_tipo_proj_dolar = 'display: none;';
   $sStyleReadInp_cod_tipo_proj_dolar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_tipo_proj_dolar']) && $this->nmgp_cmp_readonly['cod_tipo_proj_dolar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_tipo_proj_dolar']);
       $sStyleReadLab_cod_tipo_proj_dolar = '';
       $sStyleReadInp_cod_tipo_proj_dolar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_tipo_proj_dolar']) && $this->nmgp_cmp_hidden['cod_tipo_proj_dolar'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cod_tipo_proj_dolar" value="<?php echo $this->form_encode_input($this->cod_tipo_proj_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_cod_tipo_proj_dolar_line" id="hidden_field_data_cod_tipo_proj_dolar" style="<?php echo $sStyleHidden_cod_tipo_proj_dolar; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_tipo_proj_dolar_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cod_tipo_proj_dolar_label" style=""><span id="id_label_cod_tipo_proj_dolar"><?php echo $this->nm_new_label['cod_tipo_proj_dolar']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['cod_tipo_proj_dolar']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['cod_tipo_proj_dolar'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_tipo_proj_dolar"]) &&  $this->nmgp_cmp_readonly["cod_tipo_proj_dolar"] == "on") { 

$cod_tipo_proj_dolar_look = "";
 if ($this->cod_tipo_proj_dolar == "1") { $cod_tipo_proj_dolar_look .= "Valor Exato(Sem Projeção)" ;} 
 if ($this->cod_tipo_proj_dolar == "2") { $cod_tipo_proj_dolar_look .= "Acrescimo Monetário" ;} 
 if ($this->cod_tipo_proj_dolar == "3") { $cod_tipo_proj_dolar_look .= "Acrescimo %" ;} 
 if (empty($cod_tipo_proj_dolar_look)) { $cod_tipo_proj_dolar_look = $this->cod_tipo_proj_dolar; }
?>
<input type="hidden" name="cod_tipo_proj_dolar" value="<?php echo $this->form_encode_input($cod_tipo_proj_dolar) . "\">" . $cod_tipo_proj_dolar_look . ""; ?>
<?php } else { ?>
<?php

$cod_tipo_proj_dolar_look = "";
 if ($this->cod_tipo_proj_dolar == "1") { $cod_tipo_proj_dolar_look .= "Valor Exato(Sem Projeção)" ;} 
 if ($this->cod_tipo_proj_dolar == "2") { $cod_tipo_proj_dolar_look .= "Acrescimo Monetário" ;} 
 if ($this->cod_tipo_proj_dolar == "3") { $cod_tipo_proj_dolar_look .= "Acrescimo %" ;} 
 if (empty($cod_tipo_proj_dolar_look)) { $cod_tipo_proj_dolar_look = $this->cod_tipo_proj_dolar; }
?>
<span id="id_read_on_cod_tipo_proj_dolar" class="css_cod_tipo_proj_dolar_line"  style="<?php echo $sStyleReadLab_cod_tipo_proj_dolar; ?>"><?php echo $this->form_format_readonly("cod_tipo_proj_dolar", $this->form_encode_input($cod_tipo_proj_dolar_look)); ?></span><span id="id_read_off_cod_tipo_proj_dolar" class="css_read_off_cod_tipo_proj_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_cod_tipo_proj_dolar; ?>">
 <span id="idAjaxSelect_cod_tipo_proj_dolar" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_cod_tipo_proj_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_tipo_proj_dolar" name="cod_tipo_proj_dolar" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->cod_tipo_proj_dolar == "1") { echo " selected" ;} ?>>Valor Exato(Sem Projeção)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_cod_tipo_proj_dolar'][] = '1'; ?>
 <option  value="2" <?php  if ($this->cod_tipo_proj_dolar == "2") { echo " selected" ;} ?>>Acrescimo Monetário</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_cod_tipo_proj_dolar'][] = '2'; ?>
 <option  value="3" <?php  if ($this->cod_tipo_proj_dolar == "3") { echo " selected" ;} ?>>Acrescimo %</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_cod_tipo_proj_dolar'][] = '3'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_tipo_proj_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_tipo_proj_dolar_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_proj_dolar']))
    {
        $this->nm_new_label['vl_proj_dolar'] = "Vl. Acresc. Proj. Dolar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_proj_dolar = $this->vl_proj_dolar;
   $sStyleHidden_vl_proj_dolar = '';
   if (isset($this->nmgp_cmp_hidden['vl_proj_dolar']) && $this->nmgp_cmp_hidden['vl_proj_dolar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_proj_dolar']);
       $sStyleHidden_vl_proj_dolar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_proj_dolar = 'display: none;';
   $sStyleReadInp_vl_proj_dolar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_proj_dolar']) && $this->nmgp_cmp_readonly['vl_proj_dolar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_proj_dolar']);
       $sStyleReadLab_vl_proj_dolar = '';
       $sStyleReadInp_vl_proj_dolar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_proj_dolar']) && $this->nmgp_cmp_hidden['vl_proj_dolar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_proj_dolar" value="<?php echo $this->form_encode_input($vl_proj_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_proj_dolar_line" id="hidden_field_data_vl_proj_dolar" style="<?php echo $sStyleHidden_vl_proj_dolar; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_proj_dolar_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_proj_dolar_label" style=""><span id="id_label_vl_proj_dolar"><?php echo $this->nm_new_label['vl_proj_dolar']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_proj_dolar"]) &&  $this->nmgp_cmp_readonly["vl_proj_dolar"] == "on") { 

 ?>
<input type="hidden" name="vl_proj_dolar" value="<?php echo $this->form_encode_input($vl_proj_dolar) . "\">" . $vl_proj_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_proj_dolar" class="sc-ui-readonly-vl_proj_dolar css_vl_proj_dolar_line" style="<?php echo $sStyleReadLab_vl_proj_dolar; ?>"><?php echo $this->form_format_readonly("vl_proj_dolar", $this->form_encode_input($this->vl_proj_dolar)); ?></span><span id="id_read_off_vl_proj_dolar" class="css_read_off_vl_proj_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_proj_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_proj_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_proj_dolar" type=text name="vl_proj_dolar" value="<?php echo $this->form_encode_input($vl_proj_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 4, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_proj_dolar']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_proj_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_proj_dolar']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_proj_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('vl_proj_dolar')", "nm_mostra_mens('vl_proj_dolar')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_proj_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_proj_dolar_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_vl_proj_dolar_dumb = ('' == $sStyleHidden_vl_proj_dolar) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_proj_dolar_dumb" style="<?php echo $sStyleHidden_vl_proj_dolar_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_6"></a>
<div id="div_hidden_bloco_6" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_6" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ordem_busca_dolar_di']))
   {
       $this->nm_new_label['ordem_busca_dolar_di'] = "Ordem Busca Dolar Di";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ordem_busca_dolar_di = $this->ordem_busca_dolar_di;
   $sStyleHidden_ordem_busca_dolar_di = '';
   if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_di']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_di'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ordem_busca_dolar_di']);
       $sStyleHidden_ordem_busca_dolar_di = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ordem_busca_dolar_di = 'display: none;';
   $sStyleReadInp_ordem_busca_dolar_di = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ordem_busca_dolar_di']) && $this->nmgp_cmp_readonly['ordem_busca_dolar_di'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ordem_busca_dolar_di']);
       $sStyleReadLab_ordem_busca_dolar_di = '';
       $sStyleReadInp_ordem_busca_dolar_di = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_di']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_di'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ordem_busca_dolar_di" value="<?php echo $this->form_encode_input($this->ordem_busca_dolar_di) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ordem_busca_dolar_di_line" id="hidden_field_data_ordem_busca_dolar_di" style="<?php echo $sStyleHidden_ordem_busca_dolar_di; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ordem_busca_dolar_di_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ordem_busca_dolar_di_label" style=""><span id="id_label_ordem_busca_dolar_di"><?php echo $this->nm_new_label['ordem_busca_dolar_di']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['ordem_busca_dolar_di']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['php_cmp_required']['ordem_busca_dolar_di'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ordem_busca_dolar_di"]) &&  $this->nmgp_cmp_readonly["ordem_busca_dolar_di"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di'] = array(); 
    }

   $old_value_sc_field_10 = $this->sc_field_10;
   $old_value_sc_field_3 = $this->sc_field_3;
   $old_value_cod_agente_cargas = $this->cod_agente_cargas;
   $old_value_cod_armador = $this->cod_armador;
   $old_value_situacao = $this->situacao;
   $old_value_perc_custo = $this->perc_custo;
   $old_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $old_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $old_value_dt_prev_embarque = $this->dt_prev_embarque;
   $old_value_dt_real_embarque = $this->dt_real_embarque;
   $old_value_sc_field_12 = $this->sc_field_12;
   $old_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $old_value_sc_field_11 = $this->sc_field_11;
   $old_value_sc_field_17 = $this->sc_field_17;
   $old_value_vl_proj_dolar = $this->vl_proj_dolar;
   $old_value_vl_dolar_di = $this->vl_dolar_di;
   $old_value_sc_field_16 = $this->sc_field_16;
   $old_value_ptax = $this->ptax;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_sc_field_10 = $this->sc_field_10;
   $unformatted_value_sc_field_3 = $this->sc_field_3;
   $unformatted_value_cod_agente_cargas = $this->cod_agente_cargas;
   $unformatted_value_cod_armador = $this->cod_armador;
   $unformatted_value_situacao = $this->situacao;
   $unformatted_value_perc_custo = $this->perc_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
   $unformatted_value_dt_hr_ult_alt_versao_custo_hora = $this->dt_hr_ult_alt_versao_custo_hora;
   $unformatted_value_dt_prev_embarque = $this->dt_prev_embarque;
   $unformatted_value_dt_real_embarque = $this->dt_real_embarque;
   $unformatted_value_sc_field_12 = $this->sc_field_12;
   $unformatted_value_dt_prev_chegada_loja = $this->dt_prev_chegada_loja;
   $unformatted_value_sc_field_11 = $this->sc_field_11;
   $unformatted_value_sc_field_17 = $this->sc_field_17;
   $unformatted_value_vl_proj_dolar = $this->vl_proj_dolar;
   $unformatted_value_vl_dolar_di = $this->vl_dolar_di;
   $unformatted_value_sc_field_16 = $this->sc_field_16;
   $unformatted_value_ptax = $this->ptax;

   $nm_comando = "SELECT cod_opcao, desc_opcao  FROM PUB.opcoes_lista  where lista_id = '1' ORDER BY desc_opcao";

   $this->sc_field_10 = $old_value_sc_field_10;
   $this->sc_field_3 = $old_value_sc_field_3;
   $this->cod_agente_cargas = $old_value_cod_agente_cargas;
   $this->cod_armador = $old_value_cod_armador;
   $this->situacao = $old_value_situacao;
   $this->perc_custo = $old_value_perc_custo;
   $this->dt_hr_ult_alt_versao_custo = $old_value_dt_hr_ult_alt_versao_custo;
   $this->dt_hr_ult_alt_versao_custo_hora = $old_value_dt_hr_ult_alt_versao_custo_hora;
   $this->dt_prev_embarque = $old_value_dt_prev_embarque;
   $this->dt_real_embarque = $old_value_dt_real_embarque;
   $this->sc_field_12 = $old_value_sc_field_12;
   $this->dt_prev_chegada_loja = $old_value_dt_prev_chegada_loja;
   $this->sc_field_11 = $old_value_sc_field_11;
   $this->sc_field_17 = $old_value_sc_field_17;
   $this->vl_proj_dolar = $old_value_vl_proj_dolar;
   $this->vl_dolar_di = $old_value_vl_dolar_di;
   $this->sc_field_16 = $old_value_sc_field_16;
   $this->ptax = $old_value_ptax;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['Lookup_ordem_busca_dolar_di'][] = $rs->fields[0];
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
   $ordem_busca_dolar_di_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ordem_busca_dolar_di_1))
          {
              foreach ($this->ordem_busca_dolar_di_1 as $tmp_ordem_busca_dolar_di)
              {
                  if (trim($tmp_ordem_busca_dolar_di) === trim($cadaselect[1])) {$ordem_busca_dolar_di_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ordem_busca_dolar_di) && trim($this->ordem_busca_dolar_di) === trim($cadaselect[1])) {$ordem_busca_dolar_di_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="ordem_busca_dolar_di" value="<?php echo $this->form_encode_input($ordem_busca_dolar_di) . "\">" . $ordem_busca_dolar_di_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_ordem_busca_dolar_di();
   $x = 0 ; 
   $ordem_busca_dolar_di_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ordem_busca_dolar_di_1))
          {
              foreach ($this->ordem_busca_dolar_di_1 as $tmp_ordem_busca_dolar_di)
              {
                  if (trim($tmp_ordem_busca_dolar_di) === trim($cadaselect[1])) {$ordem_busca_dolar_di_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->ordem_busca_dolar_di)) {
                 if (trim($this->ordem_busca_dolar_di) == trim($cadaselect[1])) { $ordem_busca_dolar_di_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->ordem_busca_dolar_di == $cadaselect[1]) { $ordem_busca_dolar_di_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($ordem_busca_dolar_di_look))
          {
              $ordem_busca_dolar_di_look = $this->ordem_busca_dolar_di;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_ordem_busca_dolar_di\" class=\"css_ordem_busca_dolar_di_line\" style=\"" .  $sStyleReadLab_ordem_busca_dolar_di . "\">" . $this->form_format_readonly("ordem_busca_dolar_di", $this->form_encode_input($ordem_busca_dolar_di_look)) . "</span><span id=\"id_read_off_ordem_busca_dolar_di\" class=\"css_read_off_ordem_busca_dolar_di" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_ordem_busca_dolar_di . "\">";
   echo " <span id=\"idAjaxSelect_ordem_busca_dolar_di\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_ordem_busca_dolar_di_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_ordem_busca_dolar_di\" name=\"ordem_busca_dolar_di\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->ordem_busca_dolar_di) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->ordem_busca_dolar_di)) 
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
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ordem_busca_dolar_di_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ordem_busca_dolar_di_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_dolar_di']))
    {
        $this->nm_new_label['vl_dolar_di'] = "Vl.Dolar DI";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_dolar_di = $this->vl_dolar_di;
   $sStyleHidden_vl_dolar_di = '';
   if (isset($this->nmgp_cmp_hidden['vl_dolar_di']) && $this->nmgp_cmp_hidden['vl_dolar_di'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_dolar_di']);
       $sStyleHidden_vl_dolar_di = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_dolar_di = 'display: none;';
   $sStyleReadInp_vl_dolar_di = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_dolar_di']) && $this->nmgp_cmp_readonly['vl_dolar_di'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_dolar_di']);
       $sStyleReadLab_vl_dolar_di = '';
       $sStyleReadInp_vl_dolar_di = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_dolar_di']) && $this->nmgp_cmp_hidden['vl_dolar_di'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_dolar_di" value="<?php echo $this->form_encode_input($vl_dolar_di) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_dolar_di_line" id="hidden_field_data_vl_dolar_di" style="<?php echo $sStyleHidden_vl_dolar_di; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_dolar_di_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_dolar_di_label" style=""><span id="id_label_vl_dolar_di"><?php echo $this->nm_new_label['vl_dolar_di']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_dolar_di"]) &&  $this->nmgp_cmp_readonly["vl_dolar_di"] == "on") { 

 ?>
<input type="hidden" name="vl_dolar_di" value="<?php echo $this->form_encode_input($vl_dolar_di) . "\">" . $vl_dolar_di . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_dolar_di" class="sc-ui-readonly-vl_dolar_di css_vl_dolar_di_line" style="<?php echo $sStyleReadLab_vl_dolar_di; ?>"><?php echo $this->form_format_readonly("vl_dolar_di", $this->form_encode_input($this->vl_dolar_di)); ?></span><span id="id_read_off_vl_dolar_di" class="css_read_off_vl_dolar_di<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_dolar_di; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_dolar_di_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_dolar_di" type=text name="vl_dolar_di" value="<?php echo $this->form_encode_input($vl_dolar_di) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_di']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_di']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_dolar_di']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_dolar_di']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_dolar_di_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_dolar_di_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_vl_dolar_di_dumb = ('' == $sStyleHidden_vl_dolar_di) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_dolar_di_dumb" style="<?php echo $sStyleHidden_vl_dolar_di_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_7"></a>
<div id="div_hidden_bloco_7" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_7" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_16']))
    {
        $this->nm_new_label['sc_field_16'] = "Vl Dolar Venda";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_16 = $this->sc_field_16;
   $sStyleHidden_sc_field_16 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_16']) && $this->nmgp_cmp_hidden['sc_field_16'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_16']);
       $sStyleHidden_sc_field_16 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_16 = 'display: none;';
   $sStyleReadInp_sc_field_16 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_16']) && $this->nmgp_cmp_readonly['sc_field_16'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_16']);
       $sStyleReadLab_sc_field_16 = '';
       $sStyleReadInp_sc_field_16 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_16']) && $this->nmgp_cmp_hidden['sc_field_16'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_16" value="<?php echo $this->form_encode_input($sc_field_16) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_sc_field_16_line" id="hidden_field_data_sc_field_16" style="<?php echo $sStyleHidden_sc_field_16; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_16_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sc_field_16_label" style=""><span id="id_label_sc_field_16"><?php echo $this->nm_new_label['sc_field_16']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_16"]) &&  $this->nmgp_cmp_readonly["sc_field_16"] == "on") { 

 ?>
<input type="hidden" name="sc_field_16" value="<?php echo $this->form_encode_input($sc_field_16) . "\">" . $sc_field_16 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_16" class="sc-ui-readonly-sc_field_16 css_sc_field_16_line" style="<?php echo $sStyleReadLab_sc_field_16; ?>"><?php echo $this->form_format_readonly("sc_field_16", $this->form_encode_input($this->sc_field_16)); ?></span><span id="id_read_off_sc_field_16" class="css_read_off_sc_field_16<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_16; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_16_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_16" type=text name="sc_field_16" value="<?php echo $this->form_encode_input($sc_field_16) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_16']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_16']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_16']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_16']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_16_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_16_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ptax']))
    {
        $this->nm_new_label['ptax'] = "Ptax";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ptax = $this->ptax;
   $sStyleHidden_ptax = '';
   if (isset($this->nmgp_cmp_hidden['ptax']) && $this->nmgp_cmp_hidden['ptax'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ptax']);
       $sStyleHidden_ptax = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ptax = 'display: none;';
   $sStyleReadInp_ptax = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ptax']) && $this->nmgp_cmp_readonly['ptax'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ptax']);
       $sStyleReadLab_ptax = '';
       $sStyleReadInp_ptax = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ptax']) && $this->nmgp_cmp_hidden['ptax'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ptax" value="<?php echo $this->form_encode_input($ptax) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ptax_line" id="hidden_field_data_ptax" style="<?php echo $sStyleHidden_ptax; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ptax_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ptax_label" style=""><span id="id_label_ptax"><?php echo $this->nm_new_label['ptax']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ptax"]) &&  $this->nmgp_cmp_readonly["ptax"] == "on") { 

 ?>
<input type="hidden" name="ptax" value="<?php echo $this->form_encode_input($ptax) . "\">" . $ptax . ""; ?>
<?php } else { ?>
<span id="id_read_on_ptax" class="sc-ui-readonly-ptax css_ptax_line" style="<?php echo $sStyleReadLab_ptax; ?>"><?php echo $this->form_format_readonly("ptax", $this->form_encode_input($this->ptax)); ?></span><span id="id_read_off_ptax" class="css_read_off_ptax<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ptax; ?>">
 <input class="sc-js-input scFormObjectOdd css_ptax_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ptax" type=text name="ptax" value="<?php echo $this->form_encode_input($ptax) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=22"; } ?> alt="{datatype: 'decimal', maxLength: 22, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['ptax']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ptax']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ptax']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['ptax']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ptax_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ptax_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






</TABLE></div><!-- bloco_f -->
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<?php
$requiredMessage = $this->Ini->Nm_lang['lang_othr_reqr'];
?>
<span class="scFormRequiredOddColor">* <?php echo $requiredMessage; ?></span>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5,6,7);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0,5 => 0,6 => 0,7 => 0);
  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_pp_container");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_pp_container");
 parent.scAjaxDetailHeight("form_pp_container", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_pp_container", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_pp_container", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['sc_modal'])
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
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
        function scBtnFn_sys_format_inc() {
                if ($("#sc_b_new_t.sc-unique-btn-1").length && $("#sc_b_new_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-2").length && $("#sc_b_ins_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-3").length && $("#sc_b_upd_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_exc() {
                if ($("#sc_b_del_t.sc-unique-btn-4").length && $("#sc_b_del_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
                         return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
                    if ($("#sc_b_hlp_t").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                         return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#sc_b_sai_t.sc-unique-btn-5").length && $("#sc_b_sai_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
        }
        function scBtnFn_bt_log() {
                if ($("#sc_bt_log_top").length && $("#sc_bt_log_top").is(":visible")) {
                    if ($("#sc_bt_log_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_log()
                         return;
                }
        }
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_pp_container']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
