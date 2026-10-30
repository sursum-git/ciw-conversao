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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " PUB.\"pp-container\""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " PUB.\"pp-container\""); } ?></TITLE>
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
  var sc_css_status_pwd_box = '__OMITIDO_NA_COPIA_DE_ANALISE__';
  var sc_css_status_pwd_text = '__OMITIDO_NA_COPIA_DE_ANALISE__';
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
                       'scrollUpPosition' => 'A',
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
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
.css_read_off_sc_field_4 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_6 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_7 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_sc_field_8 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
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
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['margin_top'] ?>;
}
</style>
<?php
}

?>

<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_PUB_pp_container/form_PUB_pp_container_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_PUB_pp_container_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
var scFormCtrlChanged = true;
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_PUB_pp_container_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>

<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys.inc.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys_setup.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<script type="text/javascript">

function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

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
     $("#fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        placeholder: '<?php echo $this->Ini->Nm_lang['lang_srch_all_fields'] ?>',
    });
     $("#cond_fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        minimumResultsForSearch: -1
    });
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

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['link_info']['remove_border']) {
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
 include_once("form_PUB_pp_container_js0.php");
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
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['insert_validation']; ?>">
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
<input type="hidden" name="csrf_token" value='__OMITIDO_NA_COPIA_DE_ANALISE__' />
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_PUB_pp_container'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_PUB_pp_container'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="60%">
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <i id='SC_fast_search_dropdown_t' style='cursor: pointer;' class='fas fa-caret-down' onclick="nm_gp_open_qsearch_div('t');"></i>
                  <img id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search ?>" onclick="nm_gp_submit_qsearch('t');">
                  <img style="display: <?php echo $stateSearchIconClose ?>" class='css_toolbar_obj_qs_search_img' id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
                  <div id='id_qs_div_t' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>
                                  <div>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_btns_clmn'] ?></span></p>
          <select id='fast_search_f0_t' multiple=multiple  class="scFormToolbarInput" style="vertical-align: middle;" name="nmgp_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['sc_field_0'] = (isset($this->nm_new_label['sc_field_0'])) ? $this->nm_new_label['sc_field_0'] : 'Num Pedido'; 
          $SC_Label_atu['sc_field_1'] = (isset($this->nm_new_label['sc_field_1'])) ? $this->nm_new_label['sc_field_1'] : 'Cod Estabel'; 
          $SC_Label_atu['sc_field_2'] = (isset($this->nm_new_label['sc_field_2'])) ? $this->nm_new_label['sc_field_2'] : 'Nome Ab Forn'; 
          $SC_Label_atu['sc_field_3'] = (isset($this->nm_new_label['sc_field_3'])) ? $this->nm_new_label['sc_field_3'] : 'Cod Emit Forn'; 
          $SC_Label_atu['cod_agente_cargas'] = (isset($this->nm_new_label['cod_agente_cargas'])) ? $this->nm_new_label['cod_agente_cargas'] : 'Narrativa'; 
          $SC_Label_atu['cod_armador'] = (isset($this->nm_new_label['cod_armador'])) ? $this->nm_new_label['cod_armador'] : 'Usuario'; 
          $SC_Label_atu['cod_tipo_calculo'] = (isset($this->nm_new_label['cod_tipo_calculo'])) ? $this->nm_new_label['cod_tipo_calculo'] : 'Dt Compra'; 
          $SC_Label_atu['cod_tipo_proj_dolar'] = (isset($this->nm_new_label['cod_tipo_proj_dolar'])) ? $this->nm_new_label['cod_tipo_proj_dolar'] : 'Char 1'; 
          $SC_Label_atu['comprador'] = (isset($this->nm_new_label['comprador'])) ? $this->nm_new_label['comprador'] : 'Dec 1'; 
          $SC_Label_atu['sc_field_4'] = (isset($this->nm_new_label['sc_field_4'])) ? $this->nm_new_label['sc_field_4'] : 'Int 1'; 
          $SC_Label_atu['sc_field_5'] = (isset($this->nm_new_label['sc_field_5'])) ? $this->nm_new_label['sc_field_5'] : 'Log 1'; 
          $SC_Label_atu['sc_field_6'] = (isset($this->nm_new_label['sc_field_6'])) ? $this->nm_new_label['sc_field_6'] : 'Data 1'; 
          $SC_Label_atu['sc_field_7'] = (isset($this->nm_new_label['sc_field_7'])) ? $this->nm_new_label['sc_field_7'] : 'Nr Container'; 
          $SC_Label_atu['sc_field_8'] = (isset($this->nm_new_label['sc_field_8'])) ? $this->nm_new_label['sc_field_8'] : 'Comprador'; 
          $SC_Label_atu['dt_hr_ult_alt_versao_custo'] = (isset($this->nm_new_label['dt_hr_ult_alt_versao_custo'])) ? $this->nm_new_label['dt_hr_ult_alt_versao_custo'] : 'Dt Recebimento'; 
          $SC_Label_atu['dt_prev_embarque'] = (isset($this->nm_new_label['dt_prev_embarque'])) ? $this->nm_new_label['dt_prev_embarque'] : 'Dt Prev Chegada'; 
          $SC_Label_atu['dt_real_embarque'] = (isset($this->nm_new_label['dt_real_embarque'])) ? $this->nm_new_label['dt_real_embarque'] : 'Situacao'; 
          $SC_Label_atu['exclusivo'] = (isset($this->nm_new_label['exclusivo'])) ? $this->nm_new_label['exclusivo'] : 'Vlr Frete'; 
          $SC_Label_atu['ind_dt_embarque'] = (isset($this->nm_new_label['ind_dt_embarque'])) ? $this->nm_new_label['ind_dt_embarque'] : 'Vlr Seguro'; 
          $SC_Label_atu['ind_dt_prev_chegada'] = (isset($this->nm_new_label['ind_dt_prev_chegada'])) ? $this->nm_new_label['ind_dt_prev_chegada'] : 'Vlr Despesas'; 
          $SC_Label_atu['sc_field_9'] = (isset($this->nm_new_label['sc_field_9'])) ? $this->nm_new_label['sc_field_9'] : 'Exclusivo'; 
          $SC_Label_atu['sc_field_10'] = (isset($this->nm_new_label['sc_field_10'])) ? $this->nm_new_label['sc_field_10'] : 'Vl Dolar Venda'; 
          $SC_Label_atu['log_gerar_distr_custo'] = (isset($this->nm_new_label['log_gerar_distr_custo'])) ? $this->nm_new_label['log_gerar_distr_custo'] : 'Vl Dolar Compra'; 
          $SC_Label_atu['log_gerar_saldo_a_pagar'] = (isset($this->nm_new_label['log_gerar_saldo_a_pagar'])) ? $this->nm_new_label['log_gerar_saldo_a_pagar'] : 'Log Liberar Custo Realizado'; 
          $SC_Label_atu['log_liberar_custo_realizado'] = (isset($this->nm_new_label['log_liberar_custo_realizado'])) ? $this->nm_new_label['log_liberar_custo_realizado'] : 'Medidas Container'; 
          $SC_Label_atu['log_pagto_final'] = (isset($this->nm_new_label['log_pagto_final'])) ? $this->nm_new_label['log_pagto_final'] : 'Dt Prev Embarque'; 
          $SC_Label_atu['log_versao_custo_desatualizada'] = (isset($this->nm_new_label['log_versao_custo_desatualizada'])) ? $this->nm_new_label['log_versao_custo_desatualizada'] : 'Dt Real Embarque'; 
          $SC_Label_atu['medidas_container'] = (isset($this->nm_new_label['medidas_container'])) ? $this->nm_new_label['medidas_container'] : 'Situacao Container Id'; 
          $SC_Label_atu['narrativa'] = (isset($this->nm_new_label['narrativa'])) ? $this->nm_new_label['narrativa'] : 'Ind Dt Embarque'; 
          $SC_Label_atu['sc_field_11'] = (isset($this->nm_new_label['sc_field_11'])) ? $this->nm_new_label['sc_field_11'] : 'Ind Dt Prev Chegada'; 
          $SC_Label_atu['sc_field_12'] = (isset($this->nm_new_label['sc_field_12'])) ? $this->nm_new_label['sc_field_12'] : 'Ordem Busca Dolar Di'; 
          $SC_Label_atu['sc_field_13'] = (isset($this->nm_new_label['sc_field_13'])) ? $this->nm_new_label['sc_field_13'] : 'Log Pagto Final'; 
          $SC_Label_atu['ordem_busca_dolar_compra'] = (isset($this->nm_new_label['ordem_busca_dolar_compra'])) ? $this->nm_new_label['ordem_busca_dolar_compra'] : 'Cod Agente Cargas'; 
          $SC_Label_atu['ordem_busca_dolar_di'] = (isset($this->nm_new_label['ordem_busca_dolar_di'])) ? $this->nm_new_label['ordem_busca_dolar_di'] : 'Cod Armador'; 
          $SC_Label_atu['perc_custo'] = (isset($this->nm_new_label['perc_custo'])) ? $this->nm_new_label['perc_custo'] : 'Cod Tipo Calculo'; 
          $SC_Label_atu['ptax'] = (isset($this->nm_new_label['ptax'])) ? $this->nm_new_label['ptax'] : 'Perc Custo'; 
          $SC_Label_atu['situacao'] = (isset($this->nm_new_label['situacao'])) ? $this->nm_new_label['situacao'] : 'Vl Dolar Di'; 
          $SC_Label_atu['situacao_container_id'] = (isset($this->nm_new_label['situacao_container_id'])) ? $this->nm_new_label['situacao_container_id'] : 'Log Gerar Saldo A Pagar'; 
          $SC_Label_atu['usuario'] = (isset($this->nm_new_label['usuario'])) ? $this->nm_new_label['usuario'] : 'Log Gerar Distr Custo'; 
          $SC_Label_atu['sc_field_14'] = (isset($this->nm_new_label['sc_field_14'])) ? $this->nm_new_label['sc_field_14'] : 'Ordem Busca Dolar Compra'; 
          $SC_Label_atu['sc_field_15'] = (isset($this->nm_new_label['sc_field_15'])) ? $this->nm_new_label['sc_field_15'] : 'Cod Tipo Proj Dolar'; 
          $SC_Label_atu['sc_field_16'] = (isset($this->nm_new_label['sc_field_16'])) ? $this->nm_new_label['sc_field_16'] : 'Vl Proj Dolar'; 
          $SC_Label_atu['sc_field_17'] = (isset($this->nm_new_label['sc_field_17'])) ? $this->nm_new_label['sc_field_17'] : 'Log Versao Custo Desatualizada'; 
          $SC_Label_atu['sc_field_18'] = (isset($this->nm_new_label['sc_field_18'])) ? $this->nm_new_label['sc_field_18'] : 'Dt Hr Ult Alt Versao Custo'; 
          $SC_Label_atu['vl_dolar_di'] = (isset($this->nm_new_label['vl_dolar_di'])) ? $this->nm_new_label['vl_dolar_di'] : 'Ptax'; 
          $SC_Label_atu['vl_proj_dolar'] = (isset($this->nm_new_label['vl_proj_dolar'])) ? $this->nm_new_label['vl_proj_dolar'] : 'Cod Depos'; 
          foreach ($SC_Label_atu as $CMP => $LABEL)
          {
              if($CMP == 'SC_all_Cmp')
                  continue;
              $OPC_sel = ($CMP == $OPC_cmp) ? " selected" : "";
              echo "           <option value='" . $CMP . "'" . $OPC_sel . ">" . $LABEL . "</option>";
          }
?> 
          </select>
                                      </span>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_quck_srchcond'] ?></span></p>
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
          $OPC_sel = ("ii" == $OPC_arg) ? " selected" : "";
           echo "           <option value='ii'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>";
          $OPC_sel = ("eq" == $OPC_arg) ? " selected" : "";
           echo "           <option value='eq'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
          $OPC_sel = ("np" == $OPC_arg) ? " selected" : "";
           echo "           <option value='np'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>";
?> 
          </select>
                                      </span>
                                  </div>
                                  <div class='scGridQuickSearchDivToolbar'>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('t')", "nm_gp_cancel_qsearch_div_store_temp('t')", "qs_cancel", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('t');", "nm_gp_submit_qsearch('t');", "qs_search", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
                                  </div>
                               </div>          </span>  </div>
  <?php
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
        $sCondStyle = ($this->nmgp_botoes['reload'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['breload']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['breload']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['breload']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['breload']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['breload'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "breload", "scBtnFn_sys_format_reload()", "scBtnFn_sys_format_reload()", "sc_b_reload_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_0']))
    {
        $this->nm_new_label['sc_field_0'] = "Num Pedido";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_0 = $this->sc_field_0;
   $sStyleHidden_sc_field_0 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_0']) && $this->nmgp_cmp_hidden['sc_field_0'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_0']);
       $sStyleHidden_sc_field_0 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_0 = 'display: none;';
   $sStyleReadInp_sc_field_0 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_0']) && $this->nmgp_cmp_readonly['sc_field_0'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_0']);
       $sStyleReadLab_sc_field_0 = '';
       $sStyleReadInp_sc_field_0 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_0']) && $this->nmgp_cmp_hidden['sc_field_0'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_0" value="<?php echo $this->form_encode_input($sc_field_0) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_0_label" id="hidden_field_label_sc_field_0" style="<?php echo $sStyleHidden_sc_field_0; ?>"><span id="id_label_sc_field_0"><?php echo $this->nm_new_label['sc_field_0']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_0_line" id="hidden_field_data_sc_field_0" style="<?php echo $sStyleHidden_sc_field_0; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_0_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_0"]) &&  $this->nmgp_cmp_readonly["sc_field_0"] == "on") { 

 ?>
<input type="hidden" name="sc_field_0" value="<?php echo $this->form_encode_input($sc_field_0) . "\">" . $sc_field_0 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_0" class="sc-ui-readonly-sc_field_0 css_sc_field_0_line" style="<?php echo $sStyleReadLab_sc_field_0; ?>"><?php echo $this->form_format_readonly("sc_field_0", $this->form_encode_input($this->sc_field_0)); ?></span><span id="id_read_off_sc_field_0" class="css_read_off_sc_field_0<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_0; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_0_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_0" type=text name="sc_field_0" value="<?php echo $this->form_encode_input($sc_field_0) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_0_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_0_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_1']))
    {
        $this->nm_new_label['sc_field_1'] = "Cod Estabel";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['sc_field_1']) && $this->nmgp_cmp_hidden['sc_field_1'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_1" value="<?php echo $this->form_encode_input($sc_field_1) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_1_label" id="hidden_field_label_sc_field_1" style="<?php echo $sStyleHidden_sc_field_1; ?>"><span id="id_label_sc_field_1"><?php echo $this->nm_new_label['sc_field_1']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_1_line" id="hidden_field_data_sc_field_1" style="<?php echo $sStyleHidden_sc_field_1; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_1_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_1"]) &&  $this->nmgp_cmp_readonly["sc_field_1"] == "on") { 

 ?>
<input type="hidden" name="sc_field_1" value="<?php echo $this->form_encode_input($sc_field_1) . "\">" . $sc_field_1 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_1" class="sc-ui-readonly-sc_field_1 css_sc_field_1_line" style="<?php echo $sStyleReadLab_sc_field_1; ?>"><?php echo $this->form_format_readonly("sc_field_1", $this->form_encode_input($this->sc_field_1)); ?></span><span id="id_read_off_sc_field_1" class="css_read_off_sc_field_1<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_1; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_1_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_1" type=text name="sc_field_1" value="<?php echo $this->form_encode_input($sc_field_1) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> maxlength=16 alt="{datatype: 'text', maxLength: 16, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_1_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_1_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_2_label" id="hidden_field_label_sc_field_2" style="<?php echo $sStyleHidden_sc_field_2; ?>"><span id="id_label_sc_field_2"><?php echo $this->nm_new_label['sc_field_2']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_2_line" id="hidden_field_data_sc_field_2" style="<?php echo $sStyleHidden_sc_field_2; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_2_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_2"]) &&  $this->nmgp_cmp_readonly["sc_field_2"] == "on") { 

 ?>
<input type="hidden" name="sc_field_2" value="<?php echo $this->form_encode_input($sc_field_2) . "\">" . $sc_field_2 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_2" class="sc-ui-readonly-sc_field_2 css_sc_field_2_line" style="<?php echo $sStyleReadLab_sc_field_2; ?>"><?php echo $this->form_format_readonly("sc_field_2", $this->form_encode_input($this->sc_field_2)); ?></span><span id="id_read_off_sc_field_2" class="css_read_off_sc_field_2<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_2; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_2_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_2" type=text name="sc_field_2" value="<?php echo $this->form_encode_input($sc_field_2) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_2']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_2']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_2']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_2_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_2_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_3']))
    {
        $this->nm_new_label['sc_field_3'] = "Cod Emit Forn";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_3_label" id="hidden_field_label_sc_field_3" style="<?php echo $sStyleHidden_sc_field_3; ?>"><span id="id_label_sc_field_3"><?php echo $this->nm_new_label['sc_field_3']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_3_line" id="hidden_field_data_sc_field_3" style="<?php echo $sStyleHidden_sc_field_3; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_3_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_3"]) &&  $this->nmgp_cmp_readonly["sc_field_3"] == "on") { 

 ?>
<input type="hidden" name="sc_field_3" value="<?php echo $this->form_encode_input($sc_field_3) . "\">" . $sc_field_3 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_3" class="sc-ui-readonly-sc_field_3 css_sc_field_3_line" style="<?php echo $sStyleReadLab_sc_field_3; ?>"><?php echo $this->form_format_readonly("sc_field_3", $this->form_encode_input($this->sc_field_3)); ?></span><span id="id_read_off_sc_field_3" class="css_read_off_sc_field_3<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_3; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_3_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_3" type=text name="sc_field_3" value="<?php echo $this->form_encode_input($sc_field_3) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_3_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_3_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_agente_cargas']))
    {
        $this->nm_new_label['cod_agente_cargas'] = "Narrativa";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_agente_cargas_label" id="hidden_field_label_cod_agente_cargas" style="<?php echo $sStyleHidden_cod_agente_cargas; ?>"><span id="id_label_cod_agente_cargas"><?php echo $this->nm_new_label['cod_agente_cargas']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_agente_cargas_line" id="hidden_field_data_cod_agente_cargas" style="<?php echo $sStyleHidden_cod_agente_cargas; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_agente_cargas_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_agente_cargas"]) &&  $this->nmgp_cmp_readonly["cod_agente_cargas"] == "on") { 

 ?>
<input type="hidden" name="cod_agente_cargas" value="<?php echo $this->form_encode_input($cod_agente_cargas) . "\">" . $cod_agente_cargas . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_agente_cargas" class="sc-ui-readonly-cod_agente_cargas css_cod_agente_cargas_line" style="<?php echo $sStyleReadLab_cod_agente_cargas; ?>"><?php echo $this->form_format_readonly("cod_agente_cargas", $this->form_encode_input($this->cod_agente_cargas)); ?></span><span id="id_read_off_cod_agente_cargas" class="css_read_off_cod_agente_cargas<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_agente_cargas; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_agente_cargas_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_agente_cargas" type=text name="cod_agente_cargas" value="<?php echo $this->form_encode_input($cod_agente_cargas) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_agente_cargas']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_agente_cargas']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_agente_cargas']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_agente_cargas_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_agente_cargas_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_armador']))
    {
        $this->nm_new_label['cod_armador'] = "Usuario";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_armador_label" id="hidden_field_label_cod_armador" style="<?php echo $sStyleHidden_cod_armador; ?>"><span id="id_label_cod_armador"><?php echo $this->nm_new_label['cod_armador']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_armador_line" id="hidden_field_data_cod_armador" style="<?php echo $sStyleHidden_cod_armador; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_armador_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_armador"]) &&  $this->nmgp_cmp_readonly["cod_armador"] == "on") { 

 ?>
<input type="hidden" name="cod_armador" value="<?php echo $this->form_encode_input($cod_armador) . "\">" . $cod_armador . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_armador" class="sc-ui-readonly-cod_armador css_cod_armador_line" style="<?php echo $sStyleReadLab_cod_armador; ?>"><?php echo $this->form_format_readonly("cod_armador", $this->form_encode_input($this->cod_armador)); ?></span><span id="id_read_off_cod_armador" class="css_read_off_cod_armador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_armador; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_armador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_armador" type=text name="cod_armador" value="<?php echo $this->form_encode_input($cod_armador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_armador']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_armador']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_armador']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_armador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_armador_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_tipo_calculo']))
    {
        $this->nm_new_label['cod_tipo_calculo'] = "Dt Compra";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_tipo_calculo = $this->cod_tipo_calculo;
   $sStyleHidden_cod_tipo_calculo = '';
   if (isset($this->nmgp_cmp_hidden['cod_tipo_calculo']) && $this->nmgp_cmp_hidden['cod_tipo_calculo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_tipo_calculo']);
       $sStyleHidden_cod_tipo_calculo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_tipo_calculo = 'display: none;';
   $sStyleReadInp_cod_tipo_calculo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_tipo_calculo']) && $this->nmgp_cmp_readonly['cod_tipo_calculo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_tipo_calculo']);
       $sStyleReadLab_cod_tipo_calculo = '';
       $sStyleReadInp_cod_tipo_calculo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_tipo_calculo']) && $this->nmgp_cmp_hidden['cod_tipo_calculo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_tipo_calculo" value="<?php echo $this->form_encode_input($cod_tipo_calculo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_tipo_calculo_label" id="hidden_field_label_cod_tipo_calculo" style="<?php echo $sStyleHidden_cod_tipo_calculo; ?>"><span id="id_label_cod_tipo_calculo"><?php echo $this->nm_new_label['cod_tipo_calculo']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_tipo_calculo_line" id="hidden_field_data_cod_tipo_calculo" style="<?php echo $sStyleHidden_cod_tipo_calculo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_tipo_calculo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_tipo_calculo"]) &&  $this->nmgp_cmp_readonly["cod_tipo_calculo"] == "on") { 

 ?>
<input type="hidden" name="cod_tipo_calculo" value="<?php echo $this->form_encode_input($cod_tipo_calculo) . "\">" . $cod_tipo_calculo . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_tipo_calculo" class="sc-ui-readonly-cod_tipo_calculo css_cod_tipo_calculo_line" style="<?php echo $sStyleReadLab_cod_tipo_calculo; ?>"><?php echo $this->form_format_readonly("cod_tipo_calculo", $this->form_encode_input($this->cod_tipo_calculo)); ?></span><span id="id_read_off_cod_tipo_calculo" class="css_read_off_cod_tipo_calculo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_tipo_calculo; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_tipo_calculo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_tipo_calculo" type=text name="cod_tipo_calculo" value="<?php echo $this->form_encode_input($cod_tipo_calculo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_tipo_calculo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_tipo_calculo']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_tipo_calculo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_tipo_calculo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_tipo_calculo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_tipo_proj_dolar']))
    {
        $this->nm_new_label['cod_tipo_proj_dolar'] = "Char 1";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['cod_tipo_proj_dolar']) && $this->nmgp_cmp_hidden['cod_tipo_proj_dolar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_tipo_proj_dolar" value="<?php echo $this->form_encode_input($cod_tipo_proj_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_tipo_proj_dolar_label" id="hidden_field_label_cod_tipo_proj_dolar" style="<?php echo $sStyleHidden_cod_tipo_proj_dolar; ?>"><span id="id_label_cod_tipo_proj_dolar"><?php echo $this->nm_new_label['cod_tipo_proj_dolar']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_tipo_proj_dolar_line" id="hidden_field_data_cod_tipo_proj_dolar" style="<?php echo $sStyleHidden_cod_tipo_proj_dolar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_tipo_proj_dolar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_tipo_proj_dolar"]) &&  $this->nmgp_cmp_readonly["cod_tipo_proj_dolar"] == "on") { 

 ?>
<input type="hidden" name="cod_tipo_proj_dolar" value="<?php echo $this->form_encode_input($cod_tipo_proj_dolar) . "\">" . $cod_tipo_proj_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_tipo_proj_dolar" class="sc-ui-readonly-cod_tipo_proj_dolar css_cod_tipo_proj_dolar_line" style="<?php echo $sStyleReadLab_cod_tipo_proj_dolar; ?>"><?php echo $this->form_format_readonly("cod_tipo_proj_dolar", $this->form_encode_input($this->cod_tipo_proj_dolar)); ?></span><span id="id_read_off_cod_tipo_proj_dolar" class="css_read_off_cod_tipo_proj_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_tipo_proj_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_tipo_proj_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_tipo_proj_dolar" type=text name="cod_tipo_proj_dolar" value="<?php echo $this->form_encode_input($cod_tipo_proj_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_tipo_proj_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_tipo_proj_dolar']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_tipo_proj_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_tipo_proj_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_tipo_proj_dolar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['comprador']))
    {
        $this->nm_new_label['comprador'] = "Dec 1";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $comprador = $this->comprador;
   $sStyleHidden_comprador = '';
   if (isset($this->nmgp_cmp_hidden['comprador']) && $this->nmgp_cmp_hidden['comprador'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['comprador']);
       $sStyleHidden_comprador = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_comprador = 'display: none;';
   $sStyleReadInp_comprador = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['comprador']) && $this->nmgp_cmp_readonly['comprador'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['comprador']);
       $sStyleReadLab_comprador = '';
       $sStyleReadInp_comprador = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['comprador']) && $this->nmgp_cmp_hidden['comprador'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="comprador" value="<?php echo $this->form_encode_input($comprador) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_comprador_label" id="hidden_field_label_comprador" style="<?php echo $sStyleHidden_comprador; ?>"><span id="id_label_comprador"><?php echo $this->nm_new_label['comprador']; ?></span></TD>
    <TD class="scFormDataOdd css_comprador_line" id="hidden_field_data_comprador" style="<?php echo $sStyleHidden_comprador; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comprador_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comprador"]) &&  $this->nmgp_cmp_readonly["comprador"] == "on") { 

 ?>
<input type="hidden" name="comprador" value="<?php echo $this->form_encode_input($comprador) . "\">" . $comprador . ""; ?>
<?php } else { ?>
<span id="id_read_on_comprador" class="sc-ui-readonly-comprador css_comprador_line" style="<?php echo $sStyleReadLab_comprador; ?>"><?php echo $this->form_format_readonly("comprador", $this->form_encode_input($this->comprador)); ?></span><span id="id_read_off_comprador" class="css_read_off_comprador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comprador; ?>">
 <input class="sc-js-input scFormObjectOdd css_comprador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comprador" type=text name="comprador" value="<?php echo $this->form_encode_input($comprador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> maxlength=24 alt="{datatype: 'text', maxLength: 24, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comprador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comprador_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_4']))
    {
        $this->nm_new_label['sc_field_4'] = "Int 1";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_4 = $this->sc_field_4;
   $sStyleHidden_sc_field_4 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_4']) && $this->nmgp_cmp_hidden['sc_field_4'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_4']);
       $sStyleHidden_sc_field_4 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_4 = 'display: none;';
   $sStyleReadInp_sc_field_4 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_4']) && $this->nmgp_cmp_readonly['sc_field_4'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_4']);
       $sStyleReadLab_sc_field_4 = '';
       $sStyleReadInp_sc_field_4 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_4']) && $this->nmgp_cmp_hidden['sc_field_4'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_4" value="<?php echo $this->form_encode_input($sc_field_4) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_4_label" id="hidden_field_label_sc_field_4" style="<?php echo $sStyleHidden_sc_field_4; ?>"><span id="id_label_sc_field_4"><?php echo $this->nm_new_label['sc_field_4']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_4_line" id="hidden_field_data_sc_field_4" style="<?php echo $sStyleHidden_sc_field_4; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_4_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_4"]) &&  $this->nmgp_cmp_readonly["sc_field_4"] == "on") { 

 ?>
<input type="hidden" name="sc_field_4" value="<?php echo $this->form_encode_input($sc_field_4) . "\">" . $sc_field_4 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_4" class="sc-ui-readonly-sc_field_4 css_sc_field_4_line" style="<?php echo $sStyleReadLab_sc_field_4; ?>"><?php echo $this->form_format_readonly("sc_field_4", $this->form_encode_input($sc_field_4)); ?></span><span id="id_read_off_sc_field_4" class="css_read_off_sc_field_4<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_4; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_4']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_4_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_4" type=text name="sc_field_4" value="<?php echo $this->form_encode_input($sc_field_4) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_4']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_4']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_4_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_4_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_5']))
    {
        $this->nm_new_label['sc_field_5'] = "Log 1";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_5 = $this->sc_field_5;
   $sStyleHidden_sc_field_5 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_5']) && $this->nmgp_cmp_hidden['sc_field_5'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_5']);
       $sStyleHidden_sc_field_5 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_5 = 'display: none;';
   $sStyleReadInp_sc_field_5 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_5']) && $this->nmgp_cmp_readonly['sc_field_5'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_5']);
       $sStyleReadLab_sc_field_5 = '';
       $sStyleReadInp_sc_field_5 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_5']) && $this->nmgp_cmp_hidden['sc_field_5'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_5" value="<?php echo $this->form_encode_input($sc_field_5) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_5_label" id="hidden_field_label_sc_field_5" style="<?php echo $sStyleHidden_sc_field_5; ?>"><span id="id_label_sc_field_5"><?php echo $this->nm_new_label['sc_field_5']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_5_line" id="hidden_field_data_sc_field_5" style="<?php echo $sStyleHidden_sc_field_5; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_5_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_5"]) &&  $this->nmgp_cmp_readonly["sc_field_5"] == "on") { 

 ?>
<input type="hidden" name="sc_field_5" value="<?php echo $this->form_encode_input($sc_field_5) . "\">" . $sc_field_5 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_5" class="sc-ui-readonly-sc_field_5 css_sc_field_5_line" style="<?php echo $sStyleReadLab_sc_field_5; ?>"><?php echo $this->form_format_readonly("sc_field_5", $this->form_encode_input($this->sc_field_5)); ?></span><span id="id_read_off_sc_field_5" class="css_read_off_sc_field_5<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_5; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_5_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_5" type=text name="sc_field_5" value="<?php echo $this->form_encode_input($sc_field_5) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=23"; } ?> alt="{datatype: 'decimal', maxLength: 23, precision: 8, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_5']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_5']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_5']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_5']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_5_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_5_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_6']))
    {
        $this->nm_new_label['sc_field_6'] = "Data 1";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_6 = $this->sc_field_6;
   $sStyleHidden_sc_field_6 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_6']) && $this->nmgp_cmp_hidden['sc_field_6'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_6']);
       $sStyleHidden_sc_field_6 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_6 = 'display: none;';
   $sStyleReadInp_sc_field_6 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_6']) && $this->nmgp_cmp_readonly['sc_field_6'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_6']);
       $sStyleReadLab_sc_field_6 = '';
       $sStyleReadInp_sc_field_6 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_6']) && $this->nmgp_cmp_hidden['sc_field_6'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_6" value="<?php echo $this->form_encode_input($sc_field_6) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_6_label" id="hidden_field_label_sc_field_6" style="<?php echo $sStyleHidden_sc_field_6; ?>"><span id="id_label_sc_field_6"><?php echo $this->nm_new_label['sc_field_6']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_6_line" id="hidden_field_data_sc_field_6" style="<?php echo $sStyleHidden_sc_field_6; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_6_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_6"]) &&  $this->nmgp_cmp_readonly["sc_field_6"] == "on") { 

 ?>
<input type="hidden" name="sc_field_6" value="<?php echo $this->form_encode_input($sc_field_6) . "\">" . $sc_field_6 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_6" class="sc-ui-readonly-sc_field_6 css_sc_field_6_line" style="<?php echo $sStyleReadLab_sc_field_6; ?>"><?php echo $this->form_format_readonly("sc_field_6", $this->form_encode_input($sc_field_6)); ?></span><span id="id_read_off_sc_field_6" class="css_read_off_sc_field_6<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_6; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_6']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_6_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_6" type=text name="sc_field_6" value="<?php echo $this->form_encode_input($sc_field_6) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_6']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_6']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_6_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_6_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_7']))
    {
        $this->nm_new_label['sc_field_7'] = "Nr Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_7 = $this->sc_field_7;
   $sStyleHidden_sc_field_7 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_7']) && $this->nmgp_cmp_hidden['sc_field_7'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_7']);
       $sStyleHidden_sc_field_7 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_7 = 'display: none;';
   $sStyleReadInp_sc_field_7 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_7']) && $this->nmgp_cmp_readonly['sc_field_7'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_7']);
       $sStyleReadLab_sc_field_7 = '';
       $sStyleReadInp_sc_field_7 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_7']) && $this->nmgp_cmp_hidden['sc_field_7'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_7" value="<?php echo $this->form_encode_input($sc_field_7) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_7_label" id="hidden_field_label_sc_field_7" style="<?php echo $sStyleHidden_sc_field_7; ?>"><span id="id_label_sc_field_7"><?php echo $this->nm_new_label['sc_field_7']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_7_line" id="hidden_field_data_sc_field_7" style="<?php echo $sStyleHidden_sc_field_7; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_7_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_7"]) &&  $this->nmgp_cmp_readonly["sc_field_7"] == "on") { 

 ?>
<input type="hidden" name="sc_field_7" value="<?php echo $this->form_encode_input($sc_field_7) . "\">" . $sc_field_7 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_7" class="sc-ui-readonly-sc_field_7 css_sc_field_7_line" style="<?php echo $sStyleReadLab_sc_field_7; ?>"><?php echo $this->form_format_readonly("sc_field_7", $this->form_encode_input($sc_field_7)); ?></span><span id="id_read_off_sc_field_7" class="css_read_off_sc_field_7<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_7; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_7']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_7_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_7" type=text name="sc_field_7" value="<?php echo $this->form_encode_input($sc_field_7) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_7']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_7']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_7_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_7_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_8']))
    {
        $this->nm_new_label['sc_field_8'] = "Comprador";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_8 = $this->sc_field_8;
   $sStyleHidden_sc_field_8 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_8']) && $this->nmgp_cmp_hidden['sc_field_8'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_8']);
       $sStyleHidden_sc_field_8 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_8 = 'display: none;';
   $sStyleReadInp_sc_field_8 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_8']) && $this->nmgp_cmp_readonly['sc_field_8'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_8']);
       $sStyleReadLab_sc_field_8 = '';
       $sStyleReadInp_sc_field_8 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_8']) && $this->nmgp_cmp_hidden['sc_field_8'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_8" value="<?php echo $this->form_encode_input($sc_field_8) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_8_label" id="hidden_field_label_sc_field_8" style="<?php echo $sStyleHidden_sc_field_8; ?>"><span id="id_label_sc_field_8"><?php echo $this->nm_new_label['sc_field_8']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_8_line" id="hidden_field_data_sc_field_8" style="<?php echo $sStyleHidden_sc_field_8; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_8_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_8"]) &&  $this->nmgp_cmp_readonly["sc_field_8"] == "on") { 

 ?>
<input type="hidden" name="sc_field_8" value="<?php echo $this->form_encode_input($sc_field_8) . "\">" . $sc_field_8 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_8" class="sc-ui-readonly-sc_field_8 css_sc_field_8_line" style="<?php echo $sStyleReadLab_sc_field_8; ?>"><?php echo $this->form_format_readonly("sc_field_8", $this->form_encode_input($sc_field_8)); ?></span><span id="id_read_off_sc_field_8" class="css_read_off_sc_field_8<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_8; ?>"><?php
$tmp_form_data = $this->field_config['sc_field_8']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_sc_field_8_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_8" type=text name="sc_field_8" value="<?php echo $this->form_encode_input($sc_field_8) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['sc_field_8']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['sc_field_8']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_8_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_8_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_hr_ult_alt_versao_custo']))
    {
        $this->nm_new_label['dt_hr_ult_alt_versao_custo'] = "Dt Recebimento";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_hr_ult_alt_versao_custo = $this->dt_hr_ult_alt_versao_custo;
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_hr_ult_alt_versao_custo_label" id="hidden_field_label_dt_hr_ult_alt_versao_custo" style="<?php echo $sStyleHidden_dt_hr_ult_alt_versao_custo; ?>"><span id="id_label_dt_hr_ult_alt_versao_custo"><?php echo $this->nm_new_label['dt_hr_ult_alt_versao_custo']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_hr_ult_alt_versao_custo_line" id="hidden_field_data_dt_hr_ult_alt_versao_custo" style="<?php echo $sStyleHidden_dt_hr_ult_alt_versao_custo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_hr_ult_alt_versao_custo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_ult_alt_versao_custo"]) &&  $this->nmgp_cmp_readonly["dt_hr_ult_alt_versao_custo"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_ult_alt_versao_custo" value="<?php echo $this->form_encode_input($dt_hr_ult_alt_versao_custo) . "\">" . $dt_hr_ult_alt_versao_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_ult_alt_versao_custo" class="sc-ui-readonly-dt_hr_ult_alt_versao_custo css_dt_hr_ult_alt_versao_custo_line" style="<?php echo $sStyleReadLab_dt_hr_ult_alt_versao_custo; ?>"><?php echo $this->form_format_readonly("dt_hr_ult_alt_versao_custo", $this->form_encode_input($this->dt_hr_ult_alt_versao_custo)); ?></span><span id="id_read_off_dt_hr_ult_alt_versao_custo" class="css_read_off_dt_hr_ult_alt_versao_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_ult_alt_versao_custo; ?>">
 <input class="sc-js-input scFormObjectOdd css_dt_hr_ult_alt_versao_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_ult_alt_versao_custo" type=text name="dt_hr_ult_alt_versao_custo" value="<?php echo $this->form_encode_input($dt_hr_ult_alt_versao_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> maxlength=8 alt="{datatype: 'text', maxLength: 8, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_hr_ult_alt_versao_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_hr_ult_alt_versao_custo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_prev_embarque']))
    {
        $this->nm_new_label['dt_prev_embarque'] = "Dt Prev Chegada";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_prev_embarque_label" id="hidden_field_label_dt_prev_embarque" style="<?php echo $sStyleHidden_dt_prev_embarque; ?>"><span id="id_label_dt_prev_embarque"><?php echo $this->nm_new_label['dt_prev_embarque']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_prev_embarque_line" id="hidden_field_data_dt_prev_embarque" style="<?php echo $sStyleHidden_dt_prev_embarque; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_embarque_line" style="vertical-align: top;padding: 0px">
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_embarque']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_embarque']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_embarque_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_real_embarque']))
    {
        $this->nm_new_label['dt_real_embarque'] = "Situacao";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_real_embarque_label" id="hidden_field_label_dt_real_embarque" style="<?php echo $sStyleHidden_dt_real_embarque; ?>"><span id="id_label_dt_real_embarque"><?php echo $this->nm_new_label['dt_real_embarque']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_real_embarque_line" id="hidden_field_data_dt_real_embarque" style="<?php echo $sStyleHidden_dt_real_embarque; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_real_embarque_line" style="vertical-align: top;padding: 0px">
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_real_embarque']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_real_embarque']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_real_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_real_embarque_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['exclusivo']))
    {
        $this->nm_new_label['exclusivo'] = "Vlr Frete";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $exclusivo = $this->exclusivo;
   $sStyleHidden_exclusivo = '';
   if (isset($this->nmgp_cmp_hidden['exclusivo']) && $this->nmgp_cmp_hidden['exclusivo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['exclusivo']);
       $sStyleHidden_exclusivo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_exclusivo = 'display: none;';
   $sStyleReadInp_exclusivo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['exclusivo']) && $this->nmgp_cmp_readonly['exclusivo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['exclusivo']);
       $sStyleReadLab_exclusivo = '';
       $sStyleReadInp_exclusivo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['exclusivo']) && $this->nmgp_cmp_hidden['exclusivo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="exclusivo" value="<?php echo $this->form_encode_input($exclusivo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_exclusivo_label" id="hidden_field_label_exclusivo" style="<?php echo $sStyleHidden_exclusivo; ?>"><span id="id_label_exclusivo"><?php echo $this->nm_new_label['exclusivo']; ?></span></TD>
    <TD class="scFormDataOdd css_exclusivo_line" id="hidden_field_data_exclusivo" style="<?php echo $sStyleHidden_exclusivo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_exclusivo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["exclusivo"]) &&  $this->nmgp_cmp_readonly["exclusivo"] == "on") { 

 ?>
<input type="hidden" name="exclusivo" value="<?php echo $this->form_encode_input($exclusivo) . "\">" . $exclusivo . ""; ?>
<?php } else { ?>
<span id="id_read_on_exclusivo" class="sc-ui-readonly-exclusivo css_exclusivo_line" style="<?php echo $sStyleReadLab_exclusivo; ?>"><?php echo $this->form_format_readonly("exclusivo", $this->form_encode_input($this->exclusivo)); ?></span><span id="id_read_off_exclusivo" class="css_read_off_exclusivo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_exclusivo; ?>">
 <input class="sc-js-input scFormObjectOdd css_exclusivo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_exclusivo" type=text name="exclusivo" value="<?php echo $this->form_encode_input($exclusivo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_exclusivo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_exclusivo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ind_dt_embarque']))
    {
        $this->nm_new_label['ind_dt_embarque'] = "Vlr Seguro";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['ind_dt_embarque']) && $this->nmgp_cmp_hidden['ind_dt_embarque'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ind_dt_embarque" value="<?php echo $this->form_encode_input($ind_dt_embarque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ind_dt_embarque_label" id="hidden_field_label_ind_dt_embarque" style="<?php echo $sStyleHidden_ind_dt_embarque; ?>"><span id="id_label_ind_dt_embarque"><?php echo $this->nm_new_label['ind_dt_embarque']; ?></span></TD>
    <TD class="scFormDataOdd css_ind_dt_embarque_line" id="hidden_field_data_ind_dt_embarque" style="<?php echo $sStyleHidden_ind_dt_embarque; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_dt_embarque_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_dt_embarque"]) &&  $this->nmgp_cmp_readonly["ind_dt_embarque"] == "on") { 

 ?>
<input type="hidden" name="ind_dt_embarque" value="<?php echo $this->form_encode_input($ind_dt_embarque) . "\">" . $ind_dt_embarque . ""; ?>
<?php } else { ?>
<span id="id_read_on_ind_dt_embarque" class="sc-ui-readonly-ind_dt_embarque css_ind_dt_embarque_line" style="<?php echo $sStyleReadLab_ind_dt_embarque; ?>"><?php echo $this->form_format_readonly("ind_dt_embarque", $this->form_encode_input($this->ind_dt_embarque)); ?></span><span id="id_read_off_ind_dt_embarque" class="css_read_off_ind_dt_embarque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ind_dt_embarque; ?>">
 <input class="sc-js-input scFormObjectOdd css_ind_dt_embarque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_dt_embarque" type=text name="ind_dt_embarque" value="<?php echo $this->form_encode_input($ind_dt_embarque) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ind_dt_embarque']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ind_dt_embarque']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['ind_dt_embarque']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_dt_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_dt_embarque_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ind_dt_prev_chegada']))
    {
        $this->nm_new_label['ind_dt_prev_chegada'] = "Vlr Despesas";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['ind_dt_prev_chegada']) && $this->nmgp_cmp_hidden['ind_dt_prev_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ind_dt_prev_chegada" value="<?php echo $this->form_encode_input($ind_dt_prev_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ind_dt_prev_chegada_label" id="hidden_field_label_ind_dt_prev_chegada" style="<?php echo $sStyleHidden_ind_dt_prev_chegada; ?>"><span id="id_label_ind_dt_prev_chegada"><?php echo $this->nm_new_label['ind_dt_prev_chegada']; ?></span></TD>
    <TD class="scFormDataOdd css_ind_dt_prev_chegada_line" id="hidden_field_data_ind_dt_prev_chegada" style="<?php echo $sStyleHidden_ind_dt_prev_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_dt_prev_chegada_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_dt_prev_chegada"]) &&  $this->nmgp_cmp_readonly["ind_dt_prev_chegada"] == "on") { 

 ?>
<input type="hidden" name="ind_dt_prev_chegada" value="<?php echo $this->form_encode_input($ind_dt_prev_chegada) . "\">" . $ind_dt_prev_chegada . ""; ?>
<?php } else { ?>
<span id="id_read_on_ind_dt_prev_chegada" class="sc-ui-readonly-ind_dt_prev_chegada css_ind_dt_prev_chegada_line" style="<?php echo $sStyleReadLab_ind_dt_prev_chegada; ?>"><?php echo $this->form_format_readonly("ind_dt_prev_chegada", $this->form_encode_input($this->ind_dt_prev_chegada)); ?></span><span id="id_read_off_ind_dt_prev_chegada" class="css_read_off_ind_dt_prev_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ind_dt_prev_chegada; ?>">
 <input class="sc-js-input scFormObjectOdd css_ind_dt_prev_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_dt_prev_chegada" type=text name="ind_dt_prev_chegada" value="<?php echo $this->form_encode_input($ind_dt_prev_chegada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ind_dt_prev_chegada']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ind_dt_prev_chegada']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['ind_dt_prev_chegada']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_dt_prev_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_dt_prev_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_9']))
    {
        $this->nm_new_label['sc_field_9'] = "Exclusivo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_9 = $this->sc_field_9;
   $sStyleHidden_sc_field_9 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_9']) && $this->nmgp_cmp_hidden['sc_field_9'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_9']);
       $sStyleHidden_sc_field_9 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_9 = 'display: none;';
   $sStyleReadInp_sc_field_9 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_9']) && $this->nmgp_cmp_readonly['sc_field_9'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_9']);
       $sStyleReadLab_sc_field_9 = '';
       $sStyleReadInp_sc_field_9 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_9']) && $this->nmgp_cmp_hidden['sc_field_9'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_9" value="<?php echo $this->form_encode_input($sc_field_9) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_9_label" id="hidden_field_label_sc_field_9" style="<?php echo $sStyleHidden_sc_field_9; ?>"><span id="id_label_sc_field_9"><?php echo $this->nm_new_label['sc_field_9']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_9_line" id="hidden_field_data_sc_field_9" style="<?php echo $sStyleHidden_sc_field_9; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_9_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_9"]) &&  $this->nmgp_cmp_readonly["sc_field_9"] == "on") { 

 ?>
<input type="hidden" name="sc_field_9" value="<?php echo $this->form_encode_input($sc_field_9) . "\">" . $sc_field_9 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_9" class="sc-ui-readonly-sc_field_9 css_sc_field_9_line" style="<?php echo $sStyleReadLab_sc_field_9; ?>"><?php echo $this->form_format_readonly("sc_field_9", $this->form_encode_input($this->sc_field_9)); ?></span><span id="id_read_off_sc_field_9" class="css_read_off_sc_field_9<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_9; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_9_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_9" type=text name="sc_field_9" value="<?php echo $this->form_encode_input($sc_field_9) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_9']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_9']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_9']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_9_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_9_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_10']))
    {
        $this->nm_new_label['sc_field_10'] = "Vl Dolar Venda";
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
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_10']) && $this->nmgp_cmp_readonly['sc_field_10'] == 'on')
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_10_label" id="hidden_field_label_sc_field_10" style="<?php echo $sStyleHidden_sc_field_10; ?>"><span id="id_label_sc_field_10"><?php echo $this->nm_new_label['sc_field_10']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_10_line" id="hidden_field_data_sc_field_10" style="<?php echo $sStyleHidden_sc_field_10; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_10_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_10"]) &&  $this->nmgp_cmp_readonly["sc_field_10"] == "on") { 

 ?>
<input type="hidden" name="sc_field_10" value="<?php echo $this->form_encode_input($sc_field_10) . "\">" . $sc_field_10 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_10" class="sc-ui-readonly-sc_field_10 css_sc_field_10_line" style="<?php echo $sStyleReadLab_sc_field_10; ?>"><?php echo $this->form_format_readonly("sc_field_10", $this->form_encode_input($this->sc_field_10)); ?></span><span id="id_read_off_sc_field_10" class="css_read_off_sc_field_10<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_10; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_10_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_10" type=text name="sc_field_10" value="<?php echo $this->form_encode_input($sc_field_10) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_10_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_10_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['log_gerar_distr_custo']))
    {
        $this->nm_new_label['log_gerar_distr_custo'] = "Vl Dolar Compra";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['log_gerar_distr_custo']) && $this->nmgp_cmp_hidden['log_gerar_distr_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="log_gerar_distr_custo" value="<?php echo $this->form_encode_input($log_gerar_distr_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_gerar_distr_custo_label" id="hidden_field_label_log_gerar_distr_custo" style="<?php echo $sStyleHidden_log_gerar_distr_custo; ?>"><span id="id_label_log_gerar_distr_custo"><?php echo $this->nm_new_label['log_gerar_distr_custo']; ?></span></TD>
    <TD class="scFormDataOdd css_log_gerar_distr_custo_line" id="hidden_field_data_log_gerar_distr_custo" style="<?php echo $sStyleHidden_log_gerar_distr_custo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_gerar_distr_custo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_gerar_distr_custo"]) &&  $this->nmgp_cmp_readonly["log_gerar_distr_custo"] == "on") { 

 ?>
<input type="hidden" name="log_gerar_distr_custo" value="<?php echo $this->form_encode_input($log_gerar_distr_custo) . "\">" . $log_gerar_distr_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_log_gerar_distr_custo" class="sc-ui-readonly-log_gerar_distr_custo css_log_gerar_distr_custo_line" style="<?php echo $sStyleReadLab_log_gerar_distr_custo; ?>"><?php echo $this->form_format_readonly("log_gerar_distr_custo", $this->form_encode_input($this->log_gerar_distr_custo)); ?></span><span id="id_read_off_log_gerar_distr_custo" class="css_read_off_log_gerar_distr_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_log_gerar_distr_custo; ?>">
 <input class="sc-js-input scFormObjectOdd css_log_gerar_distr_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_gerar_distr_custo" type=text name="log_gerar_distr_custo" value="<?php echo $this->form_encode_input($log_gerar_distr_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_gerar_distr_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_gerar_distr_custo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['log_gerar_saldo_a_pagar']))
    {
        $this->nm_new_label['log_gerar_saldo_a_pagar'] = "Log Liberar Custo Realizado";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar']) && $this->nmgp_cmp_hidden['log_gerar_saldo_a_pagar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="log_gerar_saldo_a_pagar" value="<?php echo $this->form_encode_input($log_gerar_saldo_a_pagar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_gerar_saldo_a_pagar_label" id="hidden_field_label_log_gerar_saldo_a_pagar" style="<?php echo $sStyleHidden_log_gerar_saldo_a_pagar; ?>"><span id="id_label_log_gerar_saldo_a_pagar"><?php echo $this->nm_new_label['log_gerar_saldo_a_pagar']; ?></span></TD>
    <TD class="scFormDataOdd css_log_gerar_saldo_a_pagar_line" id="hidden_field_data_log_gerar_saldo_a_pagar" style="<?php echo $sStyleHidden_log_gerar_saldo_a_pagar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_gerar_saldo_a_pagar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_gerar_saldo_a_pagar"]) &&  $this->nmgp_cmp_readonly["log_gerar_saldo_a_pagar"] == "on") { 

 ?>
<input type="hidden" name="log_gerar_saldo_a_pagar" value="<?php echo $this->form_encode_input($log_gerar_saldo_a_pagar) . "\">" . $log_gerar_saldo_a_pagar . ""; ?>
<?php } else { ?>
<span id="id_read_on_log_gerar_saldo_a_pagar" class="sc-ui-readonly-log_gerar_saldo_a_pagar css_log_gerar_saldo_a_pagar_line" style="<?php echo $sStyleReadLab_log_gerar_saldo_a_pagar; ?>"><?php echo $this->form_format_readonly("log_gerar_saldo_a_pagar", $this->form_encode_input($this->log_gerar_saldo_a_pagar)); ?></span><span id="id_read_off_log_gerar_saldo_a_pagar" class="css_read_off_log_gerar_saldo_a_pagar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_log_gerar_saldo_a_pagar; ?>">
 <input class="sc-js-input scFormObjectOdd css_log_gerar_saldo_a_pagar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_gerar_saldo_a_pagar" type=text name="log_gerar_saldo_a_pagar" value="<?php echo $this->form_encode_input($log_gerar_saldo_a_pagar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_gerar_saldo_a_pagar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_gerar_saldo_a_pagar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['log_liberar_custo_realizado']))
    {
        $this->nm_new_label['log_liberar_custo_realizado'] = "Medidas Container";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['log_liberar_custo_realizado']) && $this->nmgp_cmp_hidden['log_liberar_custo_realizado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="log_liberar_custo_realizado" value="<?php echo $this->form_encode_input($log_liberar_custo_realizado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_liberar_custo_realizado_label" id="hidden_field_label_log_liberar_custo_realizado" style="<?php echo $sStyleHidden_log_liberar_custo_realizado; ?>"><span id="id_label_log_liberar_custo_realizado"><?php echo $this->nm_new_label['log_liberar_custo_realizado']; ?></span></TD>
    <TD class="scFormDataOdd css_log_liberar_custo_realizado_line" id="hidden_field_data_log_liberar_custo_realizado" style="<?php echo $sStyleHidden_log_liberar_custo_realizado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_liberar_custo_realizado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_liberar_custo_realizado"]) &&  $this->nmgp_cmp_readonly["log_liberar_custo_realizado"] == "on") { 

 ?>
<input type="hidden" name="log_liberar_custo_realizado" value="<?php echo $this->form_encode_input($log_liberar_custo_realizado) . "\">" . $log_liberar_custo_realizado . ""; ?>
<?php } else { ?>
<span id="id_read_on_log_liberar_custo_realizado" class="sc-ui-readonly-log_liberar_custo_realizado css_log_liberar_custo_realizado_line" style="<?php echo $sStyleReadLab_log_liberar_custo_realizado; ?>"><?php echo $this->form_format_readonly("log_liberar_custo_realizado", $this->form_encode_input($this->log_liberar_custo_realizado)); ?></span><span id="id_read_off_log_liberar_custo_realizado" class="css_read_off_log_liberar_custo_realizado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_log_liberar_custo_realizado; ?>">
 <input class="sc-js-input scFormObjectOdd css_log_liberar_custo_realizado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_liberar_custo_realizado" type=text name="log_liberar_custo_realizado" value="<?php echo $this->form_encode_input($log_liberar_custo_realizado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_liberar_custo_realizado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_liberar_custo_realizado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['log_pagto_final']))
    {
        $this->nm_new_label['log_pagto_final'] = "Dt Prev Embarque";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['log_pagto_final']) && $this->nmgp_cmp_hidden['log_pagto_final'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="log_pagto_final" value="<?php echo $this->form_encode_input($log_pagto_final) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_pagto_final_label" id="hidden_field_label_log_pagto_final" style="<?php echo $sStyleHidden_log_pagto_final; ?>"><span id="id_label_log_pagto_final"><?php echo $this->nm_new_label['log_pagto_final']; ?></span></TD>
    <TD class="scFormDataOdd css_log_pagto_final_line" id="hidden_field_data_log_pagto_final" style="<?php echo $sStyleHidden_log_pagto_final; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_pagto_final_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_pagto_final"]) &&  $this->nmgp_cmp_readonly["log_pagto_final"] == "on") { 

 ?>
<input type="hidden" name="log_pagto_final" value="<?php echo $this->form_encode_input($log_pagto_final) . "\">" . $log_pagto_final . ""; ?>
<?php } else { ?>
<span id="id_read_on_log_pagto_final" class="sc-ui-readonly-log_pagto_final css_log_pagto_final_line" style="<?php echo $sStyleReadLab_log_pagto_final; ?>"><?php echo $this->form_format_readonly("log_pagto_final", $this->form_encode_input($this->log_pagto_final)); ?></span><span id="id_read_off_log_pagto_final" class="css_read_off_log_pagto_final<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_log_pagto_final; ?>">
 <input class="sc-js-input scFormObjectOdd css_log_pagto_final_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_pagto_final" type=text name="log_pagto_final" value="<?php echo $this->form_encode_input($log_pagto_final) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_pagto_final_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_pagto_final_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['log_versao_custo_desatualizada']))
    {
        $this->nm_new_label['log_versao_custo_desatualizada'] = "Dt Real Embarque";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['log_versao_custo_desatualizada']) && $this->nmgp_cmp_hidden['log_versao_custo_desatualizada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="log_versao_custo_desatualizada" value="<?php echo $this->form_encode_input($log_versao_custo_desatualizada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_log_versao_custo_desatualizada_label" id="hidden_field_label_log_versao_custo_desatualizada" style="<?php echo $sStyleHidden_log_versao_custo_desatualizada; ?>"><span id="id_label_log_versao_custo_desatualizada"><?php echo $this->nm_new_label['log_versao_custo_desatualizada']; ?></span></TD>
    <TD class="scFormDataOdd css_log_versao_custo_desatualizada_line" id="hidden_field_data_log_versao_custo_desatualizada" style="<?php echo $sStyleHidden_log_versao_custo_desatualizada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_versao_custo_desatualizada_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_versao_custo_desatualizada"]) &&  $this->nmgp_cmp_readonly["log_versao_custo_desatualizada"] == "on") { 

 ?>
<input type="hidden" name="log_versao_custo_desatualizada" value="<?php echo $this->form_encode_input($log_versao_custo_desatualizada) . "\">" . $log_versao_custo_desatualizada . ""; ?>
<?php } else { ?>
<span id="id_read_on_log_versao_custo_desatualizada" class="sc-ui-readonly-log_versao_custo_desatualizada css_log_versao_custo_desatualizada_line" style="<?php echo $sStyleReadLab_log_versao_custo_desatualizada; ?>"><?php echo $this->form_format_readonly("log_versao_custo_desatualizada", $this->form_encode_input($this->log_versao_custo_desatualizada)); ?></span><span id="id_read_off_log_versao_custo_desatualizada" class="css_read_off_log_versao_custo_desatualizada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_log_versao_custo_desatualizada; ?>">
 <input class="sc-js-input scFormObjectOdd css_log_versao_custo_desatualizada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_versao_custo_desatualizada" type=text name="log_versao_custo_desatualizada" value="<?php echo $this->form_encode_input($log_versao_custo_desatualizada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=1"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_versao_custo_desatualizada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_versao_custo_desatualizada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['medidas_container']))
    {
        $this->nm_new_label['medidas_container'] = "Situacao Container Id";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_medidas_container_label" id="hidden_field_label_medidas_container" style="<?php echo $sStyleHidden_medidas_container; ?>"><span id="id_label_medidas_container"><?php echo $this->nm_new_label['medidas_container']; ?></span></TD>
    <TD class="scFormDataOdd css_medidas_container_line" id="hidden_field_data_medidas_container" style="<?php echo $sStyleHidden_medidas_container; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_medidas_container_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["medidas_container"]) &&  $this->nmgp_cmp_readonly["medidas_container"] == "on") { 

 ?>
<input type="hidden" name="medidas_container" value="<?php echo $this->form_encode_input($medidas_container) . "\">" . $medidas_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_medidas_container" class="sc-ui-readonly-medidas_container css_medidas_container_line" style="<?php echo $sStyleReadLab_medidas_container; ?>"><?php echo $this->form_format_readonly("medidas_container", $this->form_encode_input($this->medidas_container)); ?></span><span id="id_read_off_medidas_container" class="css_read_off_medidas_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_medidas_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_medidas_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_medidas_container" type=text name="medidas_container" value="<?php echo $this->form_encode_input($medidas_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_medidas_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_medidas_container_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['narrativa']))
    {
        $this->nm_new_label['narrativa'] = "Ind Dt Embarque";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_narrativa_label" id="hidden_field_label_narrativa" style="<?php echo $sStyleHidden_narrativa; ?>"><span id="id_label_narrativa"><?php echo $this->nm_new_label['narrativa']; ?></span></TD>
    <TD class="scFormDataOdd css_narrativa_line" id="hidden_field_data_narrativa" style="<?php echo $sStyleHidden_narrativa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_narrativa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["narrativa"]) &&  $this->nmgp_cmp_readonly["narrativa"] == "on") { 

 ?>
<input type="hidden" name="narrativa" value="<?php echo $this->form_encode_input($narrativa) . "\">" . $narrativa . ""; ?>
<?php } else { ?>
<span id="id_read_on_narrativa" class="sc-ui-readonly-narrativa css_narrativa_line" style="<?php echo $sStyleReadLab_narrativa; ?>"><?php echo $this->form_format_readonly("narrativa", $this->form_encode_input($this->narrativa)); ?></span><span id="id_read_off_narrativa" class="css_read_off_narrativa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_narrativa; ?>">
 <input class="sc-js-input scFormObjectOdd css_narrativa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_narrativa" type=text name="narrativa" value="<?php echo $this->form_encode_input($narrativa) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_narrativa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_narrativa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['sc_field_12']))
           {
               $this->nmgp_cmp_readonly['sc_field_12'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['sc_field_11']))
    {
        $this->nm_new_label['sc_field_11'] = "Ind Dt Prev Chegada";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_11_label" id="hidden_field_label_sc_field_11" style="<?php echo $sStyleHidden_sc_field_11; ?>"><span id="id_label_sc_field_11"><?php echo $this->nm_new_label['sc_field_11']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_11_line" id="hidden_field_data_sc_field_11" style="<?php echo $sStyleHidden_sc_field_11; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_11_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_11"]) &&  $this->nmgp_cmp_readonly["sc_field_11"] == "on") { 

 ?>
<input type="hidden" name="sc_field_11" value="<?php echo $this->form_encode_input($sc_field_11) . "\">" . $sc_field_11 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_11" class="sc-ui-readonly-sc_field_11 css_sc_field_11_line" style="<?php echo $sStyleReadLab_sc_field_11; ?>"><?php echo $this->form_format_readonly("sc_field_11", $this->form_encode_input($this->sc_field_11)); ?></span><span id="id_read_off_sc_field_11" class="css_read_off_sc_field_11<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_11; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_11_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_11" type=text name="sc_field_11" value="<?php echo $this->form_encode_input($sc_field_11) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> maxlength=24 alt="{datatype: 'text', maxLength: 24, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_11_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_11_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_12']))
    {
        $this->nm_new_label['sc_field_12'] = "Ordem Busca Dolar Di";
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
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["sc_field_12"]) &&  $this->nmgp_cmp_readonly["sc_field_12"] == "on"))
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_12_label" id="hidden_field_label_sc_field_12" style="<?php echo $sStyleHidden_sc_field_12; ?>"><span id="id_label_sc_field_12"><?php echo $this->nm_new_label['sc_field_12']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['php_cmp_required']['sc_field_12']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['php_cmp_required']['sc_field_12'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_sc_field_12_line" id="hidden_field_data_sc_field_12" style="<?php echo $sStyleHidden_sc_field_12; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_12_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["sc_field_12"]) &&  $this->nmgp_cmp_readonly["sc_field_12"] == "on")) { 

 ?>
<input type="hidden" name="sc_field_12" value="<?php echo $this->form_encode_input($sc_field_12) . "\"><span id=\"id_ajax_label_sc_field_12\">" . $sc_field_12 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_12" class="sc-ui-readonly-sc_field_12 css_sc_field_12_line" style="<?php echo $sStyleReadLab_sc_field_12; ?>"><?php echo $this->form_format_readonly("sc_field_12", $this->form_encode_input($this->sc_field_12)); ?></span><span id="id_read_off_sc_field_12" class="css_read_off_sc_field_12<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_12; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_12_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_12" type=text name="sc_field_12" value="<?php echo $this->form_encode_input($sc_field_12) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_12']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_12']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_12']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_12_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_12_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_13']))
    {
        $this->nm_new_label['sc_field_13'] = "Log Pagto Final";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_13 = $this->sc_field_13;
   $sStyleHidden_sc_field_13 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_13']) && $this->nmgp_cmp_hidden['sc_field_13'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_13']);
       $sStyleHidden_sc_field_13 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_13 = 'display: none;';
   $sStyleReadInp_sc_field_13 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_13']) && $this->nmgp_cmp_readonly['sc_field_13'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_13']);
       $sStyleReadLab_sc_field_13 = '';
       $sStyleReadInp_sc_field_13 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_13']) && $this->nmgp_cmp_hidden['sc_field_13'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_13" value="<?php echo $this->form_encode_input($sc_field_13) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_13_label" id="hidden_field_label_sc_field_13" style="<?php echo $sStyleHidden_sc_field_13; ?>"><span id="id_label_sc_field_13"><?php echo $this->nm_new_label['sc_field_13']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_13_line" id="hidden_field_data_sc_field_13" style="<?php echo $sStyleHidden_sc_field_13; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_13_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_13"]) &&  $this->nmgp_cmp_readonly["sc_field_13"] == "on") { 

 ?>
<input type="hidden" name="sc_field_13" value="<?php echo $this->form_encode_input($sc_field_13) . "\">" . $sc_field_13 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_13" class="sc-ui-readonly-sc_field_13 css_sc_field_13_line" style="<?php echo $sStyleReadLab_sc_field_13; ?>"><?php echo $this->form_format_readonly("sc_field_13", $this->form_encode_input($this->sc_field_13)); ?></span><span id="id_read_off_sc_field_13" class="css_read_off_sc_field_13<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_13; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_13_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_13" type=text name="sc_field_13" value="<?php echo $this->form_encode_input($sc_field_13) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_13']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_13']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_13']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_13_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_13_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ordem_busca_dolar_compra']))
    {
        $this->nm_new_label['ordem_busca_dolar_compra'] = "Cod Agente Cargas";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_compra']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_compra'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ordem_busca_dolar_compra" value="<?php echo $this->form_encode_input($ordem_busca_dolar_compra) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ordem_busca_dolar_compra_label" id="hidden_field_label_ordem_busca_dolar_compra" style="<?php echo $sStyleHidden_ordem_busca_dolar_compra; ?>"><span id="id_label_ordem_busca_dolar_compra"><?php echo $this->nm_new_label['ordem_busca_dolar_compra']; ?></span></TD>
    <TD class="scFormDataOdd css_ordem_busca_dolar_compra_line" id="hidden_field_data_ordem_busca_dolar_compra" style="<?php echo $sStyleHidden_ordem_busca_dolar_compra; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ordem_busca_dolar_compra_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ordem_busca_dolar_compra"]) &&  $this->nmgp_cmp_readonly["ordem_busca_dolar_compra"] == "on") { 

 ?>
<input type="hidden" name="ordem_busca_dolar_compra" value="<?php echo $this->form_encode_input($ordem_busca_dolar_compra) . "\">" . $ordem_busca_dolar_compra . ""; ?>
<?php } else { ?>
<span id="id_read_on_ordem_busca_dolar_compra" class="sc-ui-readonly-ordem_busca_dolar_compra css_ordem_busca_dolar_compra_line" style="<?php echo $sStyleReadLab_ordem_busca_dolar_compra; ?>"><?php echo $this->form_format_readonly("ordem_busca_dolar_compra", $this->form_encode_input($this->ordem_busca_dolar_compra)); ?></span><span id="id_read_off_ordem_busca_dolar_compra" class="css_read_off_ordem_busca_dolar_compra<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ordem_busca_dolar_compra; ?>">
 <input class="sc-js-input scFormObjectOdd css_ordem_busca_dolar_compra_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ordem_busca_dolar_compra" type=text name="ordem_busca_dolar_compra" value="<?php echo $this->form_encode_input($ordem_busca_dolar_compra) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ordem_busca_dolar_compra_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ordem_busca_dolar_compra_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ordem_busca_dolar_di']))
    {
        $this->nm_new_label['ordem_busca_dolar_di'] = "Cod Armador";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['ordem_busca_dolar_di']) && $this->nmgp_cmp_hidden['ordem_busca_dolar_di'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ordem_busca_dolar_di" value="<?php echo $this->form_encode_input($ordem_busca_dolar_di) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ordem_busca_dolar_di_label" id="hidden_field_label_ordem_busca_dolar_di" style="<?php echo $sStyleHidden_ordem_busca_dolar_di; ?>"><span id="id_label_ordem_busca_dolar_di"><?php echo $this->nm_new_label['ordem_busca_dolar_di']; ?></span></TD>
    <TD class="scFormDataOdd css_ordem_busca_dolar_di_line" id="hidden_field_data_ordem_busca_dolar_di" style="<?php echo $sStyleHidden_ordem_busca_dolar_di; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ordem_busca_dolar_di_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ordem_busca_dolar_di"]) &&  $this->nmgp_cmp_readonly["ordem_busca_dolar_di"] == "on") { 

 ?>
<input type="hidden" name="ordem_busca_dolar_di" value="<?php echo $this->form_encode_input($ordem_busca_dolar_di) . "\">" . $ordem_busca_dolar_di . ""; ?>
<?php } else { ?>
<span id="id_read_on_ordem_busca_dolar_di" class="sc-ui-readonly-ordem_busca_dolar_di css_ordem_busca_dolar_di_line" style="<?php echo $sStyleReadLab_ordem_busca_dolar_di; ?>"><?php echo $this->form_format_readonly("ordem_busca_dolar_di", $this->form_encode_input($this->ordem_busca_dolar_di)); ?></span><span id="id_read_off_ordem_busca_dolar_di" class="css_read_off_ordem_busca_dolar_di<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ordem_busca_dolar_di; ?>">
 <input class="sc-js-input scFormObjectOdd css_ordem_busca_dolar_di_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ordem_busca_dolar_di" type=text name="ordem_busca_dolar_di" value="<?php echo $this->form_encode_input($ordem_busca_dolar_di) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ordem_busca_dolar_di_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ordem_busca_dolar_di_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['perc_custo']))
    {
        $this->nm_new_label['perc_custo'] = "Cod Tipo Calculo";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_perc_custo_label" id="hidden_field_label_perc_custo" style="<?php echo $sStyleHidden_perc_custo; ?>"><span id="id_label_perc_custo"><?php echo $this->nm_new_label['perc_custo']; ?></span></TD>
    <TD class="scFormDataOdd css_perc_custo_line" id="hidden_field_data_perc_custo" style="<?php echo $sStyleHidden_perc_custo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_perc_custo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["perc_custo"]) &&  $this->nmgp_cmp_readonly["perc_custo"] == "on") { 

 ?>
<input type="hidden" name="perc_custo" value="<?php echo $this->form_encode_input($perc_custo) . "\">" . $perc_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_perc_custo" class="sc-ui-readonly-perc_custo css_perc_custo_line" style="<?php echo $sStyleReadLab_perc_custo; ?>"><?php echo $this->form_format_readonly("perc_custo", $this->form_encode_input($this->perc_custo)); ?></span><span id="id_read_off_perc_custo" class="css_read_off_perc_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_perc_custo; ?>">
 <input class="sc-js-input scFormObjectOdd css_perc_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_perc_custo" type=text name="perc_custo" value="<?php echo $this->form_encode_input($perc_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_custo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_custo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['perc_custo']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['perc_custo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_perc_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_perc_custo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ptax']))
    {
        $this->nm_new_label['ptax'] = "Perc Custo";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_ptax_label" id="hidden_field_label_ptax" style="<?php echo $sStyleHidden_ptax; ?>"><span id="id_label_ptax"><?php echo $this->nm_new_label['ptax']; ?></span></TD>
    <TD class="scFormDataOdd css_ptax_line" id="hidden_field_data_ptax" style="<?php echo $sStyleHidden_ptax; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ptax_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ptax"]) &&  $this->nmgp_cmp_readonly["ptax"] == "on") { 

 ?>
<input type="hidden" name="ptax" value="<?php echo $this->form_encode_input($ptax) . "\">" . $ptax . ""; ?>
<?php } else { ?>
<span id="id_read_on_ptax" class="sc-ui-readonly-ptax css_ptax_line" style="<?php echo $sStyleReadLab_ptax; ?>"><?php echo $this->form_format_readonly("ptax", $this->form_encode_input($this->ptax)); ?></span><span id="id_read_off_ptax" class="css_read_off_ptax<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ptax; ?>">
 <input class="sc-js-input scFormObjectOdd css_ptax_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ptax" type=text name="ptax" value="<?php echo $this->form_encode_input($ptax) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['ptax']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ptax']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ptax']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['ptax']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ptax_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ptax_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['situacao']))
    {
        $this->nm_new_label['situacao'] = "Vl Dolar Di";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $situacao = $this->situacao;
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_situacao_label" id="hidden_field_label_situacao" style="<?php echo $sStyleHidden_situacao; ?>"><span id="id_label_situacao"><?php echo $this->nm_new_label['situacao']; ?></span></TD>
    <TD class="scFormDataOdd css_situacao_line" id="hidden_field_data_situacao" style="<?php echo $sStyleHidden_situacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_situacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["situacao"]) &&  $this->nmgp_cmp_readonly["situacao"] == "on") { 

 ?>
<input type="hidden" name="situacao" value="<?php echo $this->form_encode_input($situacao) . "\">" . $situacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_situacao" class="sc-ui-readonly-situacao css_situacao_line" style="<?php echo $sStyleReadLab_situacao; ?>"><?php echo $this->form_format_readonly("situacao", $this->form_encode_input($this->situacao)); ?></span><span id="id_read_off_situacao" class="css_read_off_situacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_situacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_situacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_situacao" type=text name="situacao" value="<?php echo $this->form_encode_input($situacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['situacao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['situacao']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['situacao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_situacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_situacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['situacao_container_id']))
    {
        $this->nm_new_label['situacao_container_id'] = "Log Gerar Saldo A Pagar";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['situacao_container_id']) && $this->nmgp_cmp_hidden['situacao_container_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="situacao_container_id" value="<?php echo $this->form_encode_input($situacao_container_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_situacao_container_id_label" id="hidden_field_label_situacao_container_id" style="<?php echo $sStyleHidden_situacao_container_id; ?>"><span id="id_label_situacao_container_id"><?php echo $this->nm_new_label['situacao_container_id']; ?></span></TD>
    <TD class="scFormDataOdd css_situacao_container_id_line" id="hidden_field_data_situacao_container_id" style="<?php echo $sStyleHidden_situacao_container_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_situacao_container_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["situacao_container_id"]) &&  $this->nmgp_cmp_readonly["situacao_container_id"] == "on") { 

 ?>
<input type="hidden" name="situacao_container_id" value="<?php echo $this->form_encode_input($situacao_container_id) . "\">" . $situacao_container_id . ""; ?>
<?php } else { ?>
<span id="id_read_on_situacao_container_id" class="sc-ui-readonly-situacao_container_id css_situacao_container_id_line" style="<?php echo $sStyleReadLab_situacao_container_id; ?>"><?php echo $this->form_format_readonly("situacao_container_id", $this->form_encode_input($this->situacao_container_id)); ?></span><span id="id_read_off_situacao_container_id" class="css_read_off_situacao_container_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_situacao_container_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_situacao_container_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_situacao_container_id" type=text name="situacao_container_id" value="<?php echo $this->form_encode_input($situacao_container_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['situacao_container_id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['situacao_container_id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['situacao_container_id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_situacao_container_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_situacao_container_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['usuario']))
    {
        $this->nm_new_label['usuario'] = "Log Gerar Distr Custo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $usuario = $this->usuario;
   $sStyleHidden_usuario = '';
   if (isset($this->nmgp_cmp_hidden['usuario']) && $this->nmgp_cmp_hidden['usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['usuario']);
       $sStyleHidden_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_usuario = 'display: none;';
   $sStyleReadInp_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['usuario']) && $this->nmgp_cmp_readonly['usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['usuario']);
       $sStyleReadLab_usuario = '';
       $sStyleReadInp_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['usuario']) && $this->nmgp_cmp_hidden['usuario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="usuario" value="<?php echo $this->form_encode_input($usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_usuario_label" id="hidden_field_label_usuario" style="<?php echo $sStyleHidden_usuario; ?>"><span id="id_label_usuario"><?php echo $this->nm_new_label['usuario']; ?></span></TD>
    <TD class="scFormDataOdd css_usuario_line" id="hidden_field_data_usuario" style="<?php echo $sStyleHidden_usuario; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_usuario_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["usuario"]) &&  $this->nmgp_cmp_readonly["usuario"] == "on") { 

 ?>
<input type="hidden" name="usuario" value="<?php echo $this->form_encode_input($usuario) . "\">" . $usuario . ""; ?>
<?php } else { ?>
<span id="id_read_on_usuario" class="sc-ui-readonly-usuario css_usuario_line" style="<?php echo $sStyleReadLab_usuario; ?>"><?php echo $this->form_format_readonly("usuario", $this->form_encode_input($this->usuario)); ?></span><span id="id_read_off_usuario" class="css_read_off_usuario<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_usuario; ?>">
 <input class="sc-js-input scFormObjectOdd css_usuario_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_usuario" type=text name="usuario" value="<?php echo $this->form_encode_input($usuario) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=24"; } ?> maxlength=24 alt="{datatype: 'text', maxLength: 24, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_14']))
    {
        $this->nm_new_label['sc_field_14'] = "Ordem Busca Dolar Compra";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_14 = $this->sc_field_14;
   $sStyleHidden_sc_field_14 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_14']) && $this->nmgp_cmp_hidden['sc_field_14'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_14']);
       $sStyleHidden_sc_field_14 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_14 = 'display: none;';
   $sStyleReadInp_sc_field_14 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_14']) && $this->nmgp_cmp_readonly['sc_field_14'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_14']);
       $sStyleReadLab_sc_field_14 = '';
       $sStyleReadInp_sc_field_14 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_14']) && $this->nmgp_cmp_hidden['sc_field_14'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_14" value="<?php echo $this->form_encode_input($sc_field_14) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_14_label" id="hidden_field_label_sc_field_14" style="<?php echo $sStyleHidden_sc_field_14; ?>"><span id="id_label_sc_field_14"><?php echo $this->nm_new_label['sc_field_14']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_14_line" id="hidden_field_data_sc_field_14" style="<?php echo $sStyleHidden_sc_field_14; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_14_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_14"]) &&  $this->nmgp_cmp_readonly["sc_field_14"] == "on") { 

 ?>
<input type="hidden" name="sc_field_14" value="<?php echo $this->form_encode_input($sc_field_14) . "\">" . $sc_field_14 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_14" class="sc-ui-readonly-sc_field_14 css_sc_field_14_line" style="<?php echo $sStyleReadLab_sc_field_14; ?>"><?php echo $this->form_format_readonly("sc_field_14", $this->form_encode_input($this->sc_field_14)); ?></span><span id="id_read_off_sc_field_14" class="css_read_off_sc_field_14<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_14; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_14_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_14" type=text name="sc_field_14" value="<?php echo $this->form_encode_input($sc_field_14) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_14']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_14']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_14']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_14']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_14_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_14_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_15']))
    {
        $this->nm_new_label['sc_field_15'] = "Cod Tipo Proj Dolar";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sc_field_15 = $this->sc_field_15;
   $sStyleHidden_sc_field_15 = '';
   if (isset($this->nmgp_cmp_hidden['sc_field_15']) && $this->nmgp_cmp_hidden['sc_field_15'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sc_field_15']);
       $sStyleHidden_sc_field_15 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sc_field_15 = 'display: none;';
   $sStyleReadInp_sc_field_15 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sc_field_15']) && $this->nmgp_cmp_readonly['sc_field_15'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sc_field_15']);
       $sStyleReadLab_sc_field_15 = '';
       $sStyleReadInp_sc_field_15 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sc_field_15']) && $this->nmgp_cmp_hidden['sc_field_15'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sc_field_15" value="<?php echo $this->form_encode_input($sc_field_15) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_15_label" id="hidden_field_label_sc_field_15" style="<?php echo $sStyleHidden_sc_field_15; ?>"><span id="id_label_sc_field_15"><?php echo $this->nm_new_label['sc_field_15']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_15_line" id="hidden_field_data_sc_field_15" style="<?php echo $sStyleHidden_sc_field_15; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_15_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_15"]) &&  $this->nmgp_cmp_readonly["sc_field_15"] == "on") { 

 ?>
<input type="hidden" name="sc_field_15" value="<?php echo $this->form_encode_input($sc_field_15) . "\">" . $sc_field_15 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_15" class="sc-ui-readonly-sc_field_15 css_sc_field_15_line" style="<?php echo $sStyleReadLab_sc_field_15; ?>"><?php echo $this->form_format_readonly("sc_field_15", $this->form_encode_input($this->sc_field_15)); ?></span><span id="id_read_off_sc_field_15" class="css_read_off_sc_field_15<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_15; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_15_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_15" type=text name="sc_field_15" value="<?php echo $this->form_encode_input($sc_field_15) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_15']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_15']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_15']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_15']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_15_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_15_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_16']))
    {
        $this->nm_new_label['sc_field_16'] = "Vl Proj Dolar";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_16_label" id="hidden_field_label_sc_field_16" style="<?php echo $sStyleHidden_sc_field_16; ?>"><span id="id_label_sc_field_16"><?php echo $this->nm_new_label['sc_field_16']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_16_line" id="hidden_field_data_sc_field_16" style="<?php echo $sStyleHidden_sc_field_16; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_16_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_16"]) &&  $this->nmgp_cmp_readonly["sc_field_16"] == "on") { 

 ?>
<input type="hidden" name="sc_field_16" value="<?php echo $this->form_encode_input($sc_field_16) . "\">" . $sc_field_16 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_16" class="sc-ui-readonly-sc_field_16 css_sc_field_16_line" style="<?php echo $sStyleReadLab_sc_field_16; ?>"><?php echo $this->form_format_readonly("sc_field_16", $this->form_encode_input($this->sc_field_16)); ?></span><span id="id_read_off_sc_field_16" class="css_read_off_sc_field_16<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_16; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_16_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_16" type=text name="sc_field_16" value="<?php echo $this->form_encode_input($sc_field_16) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_16']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_16']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_16']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_16']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_16_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_16_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_17']))
    {
        $this->nm_new_label['sc_field_17'] = "Log Versao Custo Desatualizada";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_17_label" id="hidden_field_label_sc_field_17" style="<?php echo $sStyleHidden_sc_field_17; ?>"><span id="id_label_sc_field_17"><?php echo $this->nm_new_label['sc_field_17']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_17_line" id="hidden_field_data_sc_field_17" style="<?php echo $sStyleHidden_sc_field_17; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_17_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_17"]) &&  $this->nmgp_cmp_readonly["sc_field_17"] == "on") { 

 ?>
<input type="hidden" name="sc_field_17" value="<?php echo $this->form_encode_input($sc_field_17) . "\">" . $sc_field_17 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_17" class="sc-ui-readonly-sc_field_17 css_sc_field_17_line" style="<?php echo $sStyleReadLab_sc_field_17; ?>"><?php echo $this->form_format_readonly("sc_field_17", $this->form_encode_input($this->sc_field_17)); ?></span><span id="id_read_off_sc_field_17" class="css_read_off_sc_field_17<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_17; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_17_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_17" type=text name="sc_field_17" value="<?php echo $this->form_encode_input($sc_field_17) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_17']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_17']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_17']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_17']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_17_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_17_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sc_field_18']))
    {
        $this->nm_new_label['sc_field_18'] = "Dt Hr Ult Alt Versao Custo";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sc_field_18_label" id="hidden_field_label_sc_field_18" style="<?php echo $sStyleHidden_sc_field_18; ?>"><span id="id_label_sc_field_18"><?php echo $this->nm_new_label['sc_field_18']; ?></span></TD>
    <TD class="scFormDataOdd css_sc_field_18_line" id="hidden_field_data_sc_field_18" style="<?php echo $sStyleHidden_sc_field_18; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sc_field_18_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["sc_field_18"]) &&  $this->nmgp_cmp_readonly["sc_field_18"] == "on") { 

 ?>
<input type="hidden" name="sc_field_18" value="<?php echo $this->form_encode_input($sc_field_18) . "\">" . $sc_field_18 . ""; ?>
<?php } else { ?>
<span id="id_read_on_sc_field_18" class="sc-ui-readonly-sc_field_18 css_sc_field_18_line" style="<?php echo $sStyleReadLab_sc_field_18; ?>"><?php echo $this->form_format_readonly("sc_field_18", $this->form_encode_input($this->sc_field_18)); ?></span><span id="id_read_off_sc_field_18" class="css_read_off_sc_field_18<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_sc_field_18; ?>">
 <input class="sc-js-input scFormObjectOdd css_sc_field_18_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_sc_field_18" type=text name="sc_field_18" value="<?php echo $this->form_encode_input($sc_field_18) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_18']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['sc_field_18']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['sc_field_18']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['sc_field_18']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sc_field_18_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sc_field_18_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_dolar_di']))
    {
        $this->nm_new_label['vl_dolar_di'] = "Ptax";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_dolar_di_label" id="hidden_field_label_vl_dolar_di" style="<?php echo $sStyleHidden_vl_dolar_di; ?>"><span id="id_label_vl_dolar_di"><?php echo $this->nm_new_label['vl_dolar_di']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_dolar_di_line" id="hidden_field_data_vl_dolar_di" style="<?php echo $sStyleHidden_vl_dolar_di; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_dolar_di_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_dolar_di"]) &&  $this->nmgp_cmp_readonly["vl_dolar_di"] == "on") { 

 ?>
<input type="hidden" name="vl_dolar_di" value="<?php echo $this->form_encode_input($vl_dolar_di) . "\">" . $vl_dolar_di . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_dolar_di" class="sc-ui-readonly-vl_dolar_di css_vl_dolar_di_line" style="<?php echo $sStyleReadLab_vl_dolar_di; ?>"><?php echo $this->form_format_readonly("vl_dolar_di", $this->form_encode_input($this->vl_dolar_di)); ?></span><span id="id_read_off_vl_dolar_di" class="css_read_off_vl_dolar_di<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_dolar_di; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_dolar_di_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_dolar_di" type=text name="vl_dolar_di" value="<?php echo $this->form_encode_input($vl_dolar_di) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_di']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_dolar_di']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_dolar_di']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_dolar_di']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_dolar_di_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_dolar_di_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_proj_dolar']))
    {
        $this->nm_new_label['vl_proj_dolar'] = "Cod Depos";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_proj_dolar_label" id="hidden_field_label_vl_proj_dolar" style="<?php echo $sStyleHidden_vl_proj_dolar; ?>"><span id="id_label_vl_proj_dolar"><?php echo $this->nm_new_label['vl_proj_dolar']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_proj_dolar_line" id="hidden_field_data_vl_proj_dolar" style="<?php echo $sStyleHidden_vl_proj_dolar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_proj_dolar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_proj_dolar"]) &&  $this->nmgp_cmp_readonly["vl_proj_dolar"] == "on") { 

 ?>
<input type="hidden" name="vl_proj_dolar" value="<?php echo $this->form_encode_input($vl_proj_dolar) . "\">" . $vl_proj_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_proj_dolar" class="sc-ui-readonly-vl_proj_dolar css_vl_proj_dolar_line" style="<?php echo $sStyleReadLab_vl_proj_dolar; ?>"><?php echo $this->form_format_readonly("vl_proj_dolar", $this->form_encode_input($this->vl_proj_dolar)); ?></span><span id="id_read_off_vl_proj_dolar" class="css_read_off_vl_proj_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_proj_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_proj_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_proj_dolar" type=text name="vl_proj_dolar" value="<?php echo $this->form_encode_input($vl_proj_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'decimal', maxLength: 17, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_proj_dolar']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_proj_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_proj_dolar']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_proj_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_proj_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_proj_dolar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<?php
$requiredMessage = $this->Ini->Nm_lang['lang_othr_reqr'];
?>
<span class="scFormRequiredOddColor">* <?php echo $requiredMessage; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b"></span> 
<?php 
}
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R")
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
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_PUB_pp_container");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_PUB_pp_container");
 parent.scAjaxDetailHeight("form_PUB_pp_container", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_PUB_pp_container", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_PUB_pp_container", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['sc_modal'])
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
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-4").length && $("#sc_b_upd_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_exc() {
                if ($("#sc_b_del_t.sc-unique-btn-5").length && $("#sc_b_del_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
                         return;
                }
        }
        function scBtnFn_sys_format_reload() {
                if ($("#sc_b_reload_t.sc-unique-btn-6").length && $("#sc_b_reload_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_reload_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        scAjax_formReload();
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
                if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-8").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-9").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-10").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-11").length && $("#sc_b_sai_t.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
        }
        function scBtnFn_sys_GridPermiteSeq(btnPos) {
                if ($("#brec_b").length && $("#brec_b").is(":visible")) {
                    if ($("#brec_b").hasClass("disabled")) {
                        return;
                    }
                        if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
                         return;
                }
        }
        function scBtnFn_sys_format_ini() {
                if ($("#sc_b_ini_b.sc-unique-btn-12").length && $("#sc_b_ini_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-13").length && $("#sc_b_ret_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-14").length && $("#sc_b_avc_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-15").length && $("#sc_b_fim_b.sc-unique-btn-15").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-15").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_PUB_pp_container']['buttonStatus'] = $this->nmgp_botoes;
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
