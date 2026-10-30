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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Custo do Item - Média"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Custo do Item - Média"); } ?></TITLE>
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
.css_read_off_dt_referencia button {
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
.css_read_off_vl_unit_novo button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_vl_unit_media button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_item_custos_media_01/form_item_custos_media_01_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_item_custos_media_01_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_item_custos_media_01_jquery.php');

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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['link_info']['remove_border']) {
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
 include_once("form_item_custos_media_01_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_item_custos_media_01'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_item_custos_media_01'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="80%">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['cod_situacao']))
   {
       $this->nmgp_cmp_hidden['cod_situacao'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['cod_usuario']))
   {
       $this->nmgp_cmp_hidden['cod_usuario'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['item_custo_id']))
           {
               $this->nmgp_cmp_readonly['item_custo_id'] = 'on';
           }
?>
   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Principal</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['item_custo_id']))
    {
        $this->nm_new_label['item_custo_id'] = "ID Custo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $item_custo_id = $this->item_custo_id;
   $sStyleHidden_item_custo_id = '';
   if (isset($this->nmgp_cmp_hidden['item_custo_id']) && $this->nmgp_cmp_hidden['item_custo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['item_custo_id']);
       $sStyleHidden_item_custo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_item_custo_id = 'display: none;';
   $sStyleReadInp_item_custo_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["item_custo_id"]) &&  $this->nmgp_cmp_readonly["item_custo_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['item_custo_id']);
       $sStyleReadLab_item_custo_id = '';
       $sStyleReadInp_item_custo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['item_custo_id']) && $this->nmgp_cmp_hidden['item_custo_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="item_custo_id" value="<?php echo $this->form_encode_input($item_custo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_item_custo_id_label" id="hidden_field_label_item_custo_id" style="<?php echo $sStyleHidden_item_custo_id; ?>"><span id="id_label_item_custo_id"><?php echo $this->nm_new_label['item_custo_id']; ?></span></TD>
    <TD class="scFormDataOdd css_item_custo_id_line" id="hidden_field_data_item_custo_id" style="<?php echo $sStyleHidden_item_custo_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_item_custo_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_item_custo_id" class="css_item_custo_id_line" style="<?php echo $sStyleReadLab_item_custo_id; ?>"><?php echo $this->form_format_readonly("item_custo_id", $this->form_encode_input($this->item_custo_id)); ?></span><span id="id_read_off_item_custo_id" class="css_read_off_item_custo_id" style="<?php echo $sStyleReadInp_item_custo_id; ?>"><input type="hidden" name="item_custo_id" value="<?php echo $this->form_encode_input($item_custo_id) . "\">"?><span id="id_ajax_label_item_custo_id"><?php echo nl2br($item_custo_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_item_custo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_item_custo_id_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['dt_hr_custo']))
    {
        $this->nm_new_label['dt_hr_custo'] = "Data/Hora";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_hr_custo = $this->dt_hr_custo;
   $dt_hr_custo_hora = $this->dt_hr_custo_hora;
   $guarda_datahora = $this->field_config['dt_hr_custo']['date_format'];
   $this->field_config['dt_hr_custo']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
   $sStyleHidden_dt_hr_custo = '';
   if (isset($this->nmgp_cmp_hidden['dt_hr_custo']) && $this->nmgp_cmp_hidden['dt_hr_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_hr_custo']);
       $sStyleHidden_dt_hr_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_hr_custo = 'display: none;';
   $sStyleReadInp_dt_hr_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_hr_custo']) && $this->nmgp_cmp_readonly['dt_hr_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_hr_custo']);
       $sStyleReadLab_dt_hr_custo = '';
       $sStyleReadInp_dt_hr_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_hr_custo']) && $this->nmgp_cmp_hidden['dt_hr_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_hr_custo" value="<?php echo $this->form_encode_input($dt_hr_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_hr_custo_hora_label" id="hidden_field_label_dt_hr_custo" style="<?php echo $sStyleHidden_dt_hr_custo; ?>"><span id="id_label_dt_hr_custo"><?php echo $this->nm_new_label['dt_hr_custo']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_hr_custo_hora_line" id="hidden_field_data_dt_hr_custo" style="<?php echo $sStyleHidden_dt_hr_custo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_hr_custo_hora_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_custo"]) &&  $this->nmgp_cmp_readonly["dt_hr_custo"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_custo" value="<?php echo $this->form_encode_input($dt_hr_custo) . "\">" . $dt_hr_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_custo" class="sc-ui-readonly-dt_hr_custo css_dt_hr_custo_line" style="<?php echo $sStyleReadLab_dt_hr_custo; ?>"><?php echo $this->form_format_readonly("dt_hr_custo", $this->form_encode_input($dt_hr_custo)); ?></span><span id="id_read_off_dt_hr_custo" class="css_read_off_dt_hr_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_custo; ?>"><?php
$tmp_form_data = $this->field_config['dt_hr_custo']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_dt_hr_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_custo" type=text name="dt_hr_custo" value="<?php echo $this->form_encode_input($dt_hr_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_hr_custo']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_hr_custo']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>


<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_custo_hora"]) &&  $this->nmgp_cmp_readonly["dt_hr_custo_hora"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_custo_hora" value="<?php echo $this->form_encode_input($dt_hr_custo_hora) . "\">" . $dt_hr_custo_hora . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_custo_hora" class="sc-ui-readonly-dt_hr_custo_hora css_dt_hr_custo_hora_line" style="<?php echo $sStyleReadLab_dt_hr_custo; ?>"><?php echo $this->form_format_readonly("dt_hr_custo_hora", $this->form_encode_input($dt_hr_custo_hora)); ?></span><span id="id_read_off_dt_hr_custo_hora" class="css_read_off_dt_hr_custo_hora<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_custo; ?>"><?php
$tmp_form_data = $this->field_config['dt_hr_custo_hora']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_dt_hr_custo_hora_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_custo_hora" type=text name="dt_hr_custo_hora" value="<?php echo $this->form_encode_input($dt_hr_custo_hora) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> alt="{datatype: 'time', dateSep: '<?php echo $this->field_config['dt_hr_custo']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_hr_custo']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ ', timeSep: '<?php echo $this->field_config['dt_hr_custo_hora']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['dt_hr_custo_hora']['date_format']; ?>'}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_hr_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_hr_custo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_referencia']))
    {
        $this->nm_new_label['dt_referencia'] = "Dt.Referência";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_referencia = $this->dt_referencia;
   $sStyleHidden_dt_referencia = '';
   if (isset($this->nmgp_cmp_hidden['dt_referencia']) && $this->nmgp_cmp_hidden['dt_referencia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_referencia']);
       $sStyleHidden_dt_referencia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_referencia = 'display: none;';
   $sStyleReadInp_dt_referencia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_referencia']) && $this->nmgp_cmp_readonly['dt_referencia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_referencia']);
       $sStyleReadLab_dt_referencia = '';
       $sStyleReadInp_dt_referencia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_referencia']) && $this->nmgp_cmp_hidden['dt_referencia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_referencia" value="<?php echo $this->form_encode_input($dt_referencia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_referencia_label" id="hidden_field_label_dt_referencia" style="<?php echo $sStyleHidden_dt_referencia; ?>"><span id="id_label_dt_referencia"><?php echo $this->nm_new_label['dt_referencia']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_referencia_line" id="hidden_field_data_dt_referencia" style="<?php echo $sStyleHidden_dt_referencia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_referencia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_referencia"]) &&  $this->nmgp_cmp_readonly["dt_referencia"] == "on") { 

 ?>
<input type="hidden" name="dt_referencia" value="<?php echo $this->form_encode_input($dt_referencia) . "\">" . $dt_referencia . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_referencia" class="sc-ui-readonly-dt_referencia css_dt_referencia_line" style="<?php echo $sStyleReadLab_dt_referencia; ?>"><?php echo $this->form_format_readonly("dt_referencia", $this->form_encode_input($dt_referencia)); ?></span><span id="id_read_off_dt_referencia" class="css_read_off_dt_referencia<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_referencia; ?>"><?php
$tmp_form_data = $this->field_config['dt_referencia']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_referencia_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_referencia" type=text name="dt_referencia" value="<?php echo $this->form_encode_input($dt_referencia) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_referencia']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_referencia']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_referencia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_referencia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['cod_tipo_custo']))
   {
       $this->nm_new_label['cod_tipo_custo'] = "Tipo de Custo";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_tipo_custo = $this->cod_tipo_custo;
   $sStyleHidden_cod_tipo_custo = '';
   if (isset($this->nmgp_cmp_hidden['cod_tipo_custo']) && $this->nmgp_cmp_hidden['cod_tipo_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_tipo_custo']);
       $sStyleHidden_cod_tipo_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_tipo_custo = 'display: none;';
   $sStyleReadInp_cod_tipo_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_tipo_custo']) && $this->nmgp_cmp_readonly['cod_tipo_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_tipo_custo']);
       $sStyleReadLab_cod_tipo_custo = '';
       $sStyleReadInp_cod_tipo_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_tipo_custo']) && $this->nmgp_cmp_hidden['cod_tipo_custo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="cod_tipo_custo" value="<?php echo $this->form_encode_input($this->cod_tipo_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_tipo_custo_label" id="hidden_field_label_cod_tipo_custo" style="<?php echo $sStyleHidden_cod_tipo_custo; ?>"><span id="id_label_cod_tipo_custo"><?php echo $this->nm_new_label['cod_tipo_custo']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_tipo_custo_line" id="hidden_field_data_cod_tipo_custo" style="<?php echo $sStyleHidden_cod_tipo_custo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_tipo_custo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_tipo_custo"]) &&  $this->nmgp_cmp_readonly["cod_tipo_custo"] == "on") { 

$cod_tipo_custo_look = "";
 if ($this->cod_tipo_custo == "1") { $cod_tipo_custo_look .= "Manual" ;} 
 if ($this->cod_tipo_custo == "2") { $cod_tipo_custo_look .= "Container" ;} 
 if ($this->cod_tipo_custo == "3") { $cod_tipo_custo_look .= "Média Entre Itens" ;} 
 if (empty($cod_tipo_custo_look)) { $cod_tipo_custo_look = $this->cod_tipo_custo; }
?>
<input type="hidden" name="cod_tipo_custo" value="<?php echo $this->form_encode_input($cod_tipo_custo) . "\">" . $cod_tipo_custo_look . ""; ?>
<?php } else { ?>
<?php

$cod_tipo_custo_look = "";
 if ($this->cod_tipo_custo == "1") { $cod_tipo_custo_look .= "Manual" ;} 
 if ($this->cod_tipo_custo == "2") { $cod_tipo_custo_look .= "Container" ;} 
 if ($this->cod_tipo_custo == "3") { $cod_tipo_custo_look .= "Média Entre Itens" ;} 
 if (empty($cod_tipo_custo_look)) { $cod_tipo_custo_look = $this->cod_tipo_custo; }
?>
<span id="id_read_on_cod_tipo_custo" class="css_cod_tipo_custo_line"  style="<?php echo $sStyleReadLab_cod_tipo_custo; ?>"><?php echo $this->form_format_readonly("cod_tipo_custo", $this->form_encode_input($cod_tipo_custo_look)); ?></span><span id="id_read_off_cod_tipo_custo" class="css_read_off_cod_tipo_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_cod_tipo_custo; ?>">
 <span id="idAjaxSelect_cod_tipo_custo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_cod_tipo_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_tipo_custo" name="cod_tipo_custo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->cod_tipo_custo == "1") { echo " selected" ;} ?>>Manual</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['Lookup_cod_tipo_custo'][] = '1'; ?>
 <option  value="2" <?php  if ($this->cod_tipo_custo == "2") { echo " selected" ;} ?>>Container</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['Lookup_cod_tipo_custo'][] = '2'; ?>
 <option  value="3" <?php  if ($this->cod_tipo_custo == "3") { echo " selected" ;} ?>>Média Entre Itens</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['Lookup_cod_tipo_custo'][] = '3'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_tipo_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_tipo_custo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_usuario']))
    {
        $this->nm_new_label['cod_usuario'] = "Cod Usuario";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_usuario = $this->cod_usuario;
   if (!isset($this->nmgp_cmp_hidden['cod_usuario']))
   {
       $this->nmgp_cmp_hidden['cod_usuario'] = 'off';
   }
   $sStyleHidden_cod_usuario = '';
   if (isset($this->nmgp_cmp_hidden['cod_usuario']) && $this->nmgp_cmp_hidden['cod_usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_usuario']);
       $sStyleHidden_cod_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_usuario = 'display: none;';
   $sStyleReadInp_cod_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_usuario']) && $this->nmgp_cmp_readonly['cod_usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_usuario']);
       $sStyleReadLab_cod_usuario = '';
       $sStyleReadInp_cod_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_usuario']) && $this->nmgp_cmp_hidden['cod_usuario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_usuario" value="<?php echo $this->form_encode_input($cod_usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_usuario_label" id="hidden_field_label_cod_usuario" style="<?php echo $sStyleHidden_cod_usuario; ?>"><span id="id_label_cod_usuario"><?php echo $this->nm_new_label['cod_usuario']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_usuario_line" id="hidden_field_data_cod_usuario" style="<?php echo $sStyleHidden_cod_usuario; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_usuario_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_usuario"]) &&  $this->nmgp_cmp_readonly["cod_usuario"] == "on") { 

 ?>
<input type="hidden" name="cod_usuario" value="<?php echo $this->form_encode_input($cod_usuario) . "\">" . $cod_usuario . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_usuario" class="sc-ui-readonly-cod_usuario css_cod_usuario_line" style="<?php echo $sStyleReadLab_cod_usuario; ?>"><?php echo $this->form_format_readonly("cod_usuario", $this->form_encode_input($this->cod_usuario)); ?></span><span id="id_read_off_cod_usuario" class="css_read_off_cod_usuario<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_usuario; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_usuario_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_usuario" type=text name="cod_usuario" value="<?php echo $this->form_encode_input($cod_usuario) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_situacao']))
    {
        $this->nm_new_label['cod_situacao'] = "Cod Situacao";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_situacao = $this->cod_situacao;
   if (!isset($this->nmgp_cmp_hidden['cod_situacao']))
   {
       $this->nmgp_cmp_hidden['cod_situacao'] = 'off';
   }
   $sStyleHidden_cod_situacao = '';
   if (isset($this->nmgp_cmp_hidden['cod_situacao']) && $this->nmgp_cmp_hidden['cod_situacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_situacao']);
       $sStyleHidden_cod_situacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_situacao = 'display: none;';
   $sStyleReadInp_cod_situacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_situacao']) && $this->nmgp_cmp_readonly['cod_situacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_situacao']);
       $sStyleReadLab_cod_situacao = '';
       $sStyleReadInp_cod_situacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_situacao']) && $this->nmgp_cmp_hidden['cod_situacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_situacao" value="<?php echo $this->form_encode_input($cod_situacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_situacao_label" id="hidden_field_label_cod_situacao" style="<?php echo $sStyleHidden_cod_situacao; ?>"><span id="id_label_cod_situacao"><?php echo $this->nm_new_label['cod_situacao']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_situacao_line" id="hidden_field_data_cod_situacao" style="<?php echo $sStyleHidden_cod_situacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_situacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_situacao"]) &&  $this->nmgp_cmp_readonly["cod_situacao"] == "on") { 

 ?>
<input type="hidden" name="cod_situacao" value="<?php echo $this->form_encode_input($cod_situacao) . "\">" . $cod_situacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_situacao" class="sc-ui-readonly-cod_situacao css_cod_situacao_line" style="<?php echo $sStyleReadLab_cod_situacao; ?>"><?php echo $this->form_format_readonly("cod_situacao", $this->form_encode_input($this->cod_situacao)); ?></span><span id="id_read_off_cod_situacao" class="css_read_off_cod_situacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_situacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_situacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_situacao" type=text name="cod_situacao" value="<?php echo $this->form_encode_input($cod_situacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['cod_situacao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['cod_situacao']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['cod_situacao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_situacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_situacao_text"></span></td></tr></table></td></tr></table></TD>
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
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="50%" height="">
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Primeiro Item</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['it_codigo']))
    {
        $this->nm_new_label['it_codigo'] = "Item";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $it_codigo = $this->it_codigo;
   $sStyleHidden_it_codigo = '';
   if (isset($this->nmgp_cmp_hidden['it_codigo']) && $this->nmgp_cmp_hidden['it_codigo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['it_codigo']);
       $sStyleHidden_it_codigo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_it_codigo = 'display: none;';
   $sStyleReadInp_it_codigo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['it_codigo']) && $this->nmgp_cmp_readonly['it_codigo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['it_codigo']);
       $sStyleReadLab_it_codigo = '';
       $sStyleReadInp_it_codigo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['it_codigo']) && $this->nmgp_cmp_hidden['it_codigo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="it_codigo" value="<?php echo $this->form_encode_input($it_codigo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_it_codigo_label" id="hidden_field_label_it_codigo" style="<?php echo $sStyleHidden_it_codigo; ?>"><span id="id_label_it_codigo"><?php echo $this->nm_new_label['it_codigo']; ?></span></TD>
    <TD class="scFormDataOdd css_it_codigo_line" id="hidden_field_data_it_codigo" style="<?php echo $sStyleHidden_it_codigo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_it_codigo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["it_codigo"]) &&  $this->nmgp_cmp_readonly["it_codigo"] == "on") { 

 ?>
<input type="hidden" name="it_codigo" value="<?php echo $this->form_encode_input($it_codigo) . "\">" . $it_codigo . ""; ?>
<?php } else { ?>
<span id="id_read_on_it_codigo" class="sc-ui-readonly-it_codigo css_it_codigo_line" style="<?php echo $sStyleReadLab_it_codigo; ?>"><?php echo $this->form_format_readonly("it_codigo", $this->form_encode_input($this->it_codigo)); ?></span><span id="id_read_off_it_codigo" class="css_read_off_it_codigo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_it_codigo; ?>">
 <input class="sc-js-input scFormObjectOdd css_it_codigo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_it_codigo" type=text name="it_codigo" value="<?php echo $this->form_encode_input($it_codigo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_it_codigo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_it_codigo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['desc_it_codigo']))
    {
        $this->nm_new_label['desc_it_codigo'] = "Descrição Item";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $desc_it_codigo = $this->desc_it_codigo;
   $sStyleHidden_desc_it_codigo = '';
   if (isset($this->nmgp_cmp_hidden['desc_it_codigo']) && $this->nmgp_cmp_hidden['desc_it_codigo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['desc_it_codigo']);
       $sStyleHidden_desc_it_codigo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_desc_it_codigo = 'display: none;';
   $sStyleReadInp_desc_it_codigo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['desc_it_codigo']) && $this->nmgp_cmp_readonly['desc_it_codigo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['desc_it_codigo']);
       $sStyleReadLab_desc_it_codigo = '';
       $sStyleReadInp_desc_it_codigo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['desc_it_codigo']) && $this->nmgp_cmp_hidden['desc_it_codigo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="desc_it_codigo" value="<?php echo $this->form_encode_input($desc_it_codigo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_desc_it_codigo_label" id="hidden_field_label_desc_it_codigo" style="<?php echo $sStyleHidden_desc_it_codigo; ?>"><span id="id_label_desc_it_codigo"><?php echo $this->nm_new_label['desc_it_codigo']; ?></span></TD>
    <TD class="scFormDataOdd css_desc_it_codigo_line" id="hidden_field_data_desc_it_codigo" style="<?php echo $sStyleHidden_desc_it_codigo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_desc_it_codigo_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="desc_it_codigo" value="<?php echo $this->form_encode_input($desc_it_codigo); ?>"><span id="id_ajax_label_desc_it_codigo"><?php echo nl2br($desc_it_codigo); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_desc_it_codigo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_desc_it_codigo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_estoque']))
    {
        $this->nm_new_label['qt_estoque'] = "Qt.Estoque";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_estoque = $this->qt_estoque;
   $sStyleHidden_qt_estoque = '';
   if (isset($this->nmgp_cmp_hidden['qt_estoque']) && $this->nmgp_cmp_hidden['qt_estoque'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_estoque']);
       $sStyleHidden_qt_estoque = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_estoque = 'display: none;';
   $sStyleReadInp_qt_estoque = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_estoque']) && $this->nmgp_cmp_readonly['qt_estoque'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_estoque']);
       $sStyleReadLab_qt_estoque = '';
       $sStyleReadInp_qt_estoque = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_estoque']) && $this->nmgp_cmp_hidden['qt_estoque'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_estoque" value="<?php echo $this->form_encode_input($qt_estoque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_estoque_label" id="hidden_field_label_qt_estoque" style="<?php echo $sStyleHidden_qt_estoque; ?>"><span id="id_label_qt_estoque"><?php echo $this->nm_new_label['qt_estoque']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_estoque_line" id="hidden_field_data_qt_estoque" style="<?php echo $sStyleHidden_qt_estoque; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_estoque_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_estoque"]) &&  $this->nmgp_cmp_readonly["qt_estoque"] == "on") { 

 ?>
<input type="hidden" name="qt_estoque" value="<?php echo $this->form_encode_input($qt_estoque) . "\">" . $qt_estoque . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_estoque" class="sc-ui-readonly-qt_estoque css_qt_estoque_line" style="<?php echo $sStyleReadLab_qt_estoque; ?>"><?php echo $this->form_format_readonly("qt_estoque", $this->form_encode_input($this->qt_estoque)); ?></span><span id="id_read_off_qt_estoque" class="css_read_off_qt_estoque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_estoque; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_estoque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_estoque" type=text name="qt_estoque" value="<?php echo $this->form_encode_input($qt_estoque) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_estoque']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_estoque']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_estoque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_estoque_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_unit_novo']))
    {
        $this->nm_new_label['vl_unit_novo'] = "Vl.Unit Atual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit_novo = $this->vl_unit_novo;
   $sStyleHidden_vl_unit_novo = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit_novo']) && $this->nmgp_cmp_hidden['vl_unit_novo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit_novo']);
       $sStyleHidden_vl_unit_novo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit_novo = 'display: none;';
   $sStyleReadInp_vl_unit_novo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit_novo']) && $this->nmgp_cmp_readonly['vl_unit_novo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit_novo']);
       $sStyleReadLab_vl_unit_novo = '';
       $sStyleReadInp_vl_unit_novo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit_novo']) && $this->nmgp_cmp_hidden['vl_unit_novo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit_novo" value="<?php echo $this->form_encode_input($vl_unit_novo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_unit_novo_label" id="hidden_field_label_vl_unit_novo" style="<?php echo $sStyleHidden_vl_unit_novo; ?>"><span id="id_label_vl_unit_novo"><?php echo $this->nm_new_label['vl_unit_novo']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_unit_novo_line" id="hidden_field_data_vl_unit_novo" style="<?php echo $sStyleHidden_vl_unit_novo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_unit_novo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit_novo"]) &&  $this->nmgp_cmp_readonly["vl_unit_novo"] == "on") { 

 ?>
<input type="hidden" name="vl_unit_novo" value="<?php echo $this->form_encode_input($vl_unit_novo) . "\">" . $vl_unit_novo . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit_novo" class="sc-ui-readonly-vl_unit_novo css_vl_unit_novo_line" style="<?php echo $sStyleReadLab_vl_unit_novo; ?>"><?php echo $this->form_format_readonly("vl_unit_novo", $this->form_encode_input($this->vl_unit_novo)); ?></span><span id="id_read_off_vl_unit_novo" class="css_read_off_vl_unit_novo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit_novo; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_novo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit_novo" type=text name="vl_unit_novo" value="<?php echo $this->form_encode_input($vl_unit_novo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_novo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_novo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_novo']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_novo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_unit_novo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_unit_novo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="50%" height="">
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Segundo Item</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['it_codigo_media']))
    {
        $this->nm_new_label['it_codigo_media'] = "Item";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $it_codigo_media = $this->it_codigo_media;
   $sStyleHidden_it_codigo_media = '';
   if (isset($this->nmgp_cmp_hidden['it_codigo_media']) && $this->nmgp_cmp_hidden['it_codigo_media'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['it_codigo_media']);
       $sStyleHidden_it_codigo_media = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_it_codigo_media = 'display: none;';
   $sStyleReadInp_it_codigo_media = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['it_codigo_media']) && $this->nmgp_cmp_readonly['it_codigo_media'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['it_codigo_media']);
       $sStyleReadLab_it_codigo_media = '';
       $sStyleReadInp_it_codigo_media = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['it_codigo_media']) && $this->nmgp_cmp_hidden['it_codigo_media'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="it_codigo_media" value="<?php echo $this->form_encode_input($it_codigo_media) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_it_codigo_media_label" id="hidden_field_label_it_codigo_media" style="<?php echo $sStyleHidden_it_codigo_media; ?>"><span id="id_label_it_codigo_media"><?php echo $this->nm_new_label['it_codigo_media']; ?></span></TD>
    <TD class="scFormDataOdd css_it_codigo_media_line" id="hidden_field_data_it_codigo_media" style="<?php echo $sStyleHidden_it_codigo_media; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_it_codigo_media_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["it_codigo_media"]) &&  $this->nmgp_cmp_readonly["it_codigo_media"] == "on") { 

 ?>
<input type="hidden" name="it_codigo_media" value="<?php echo $this->form_encode_input($it_codigo_media) . "\">" . $it_codigo_media . ""; ?>
<?php } else { ?>
<span id="id_read_on_it_codigo_media" class="sc-ui-readonly-it_codigo_media css_it_codigo_media_line" style="<?php echo $sStyleReadLab_it_codigo_media; ?>"><?php echo $this->form_format_readonly("it_codigo_media", $this->form_encode_input($this->it_codigo_media)); ?></span><span id="id_read_off_it_codigo_media" class="css_read_off_it_codigo_media<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_it_codigo_media; ?>">
 <input class="sc-js-input scFormObjectOdd css_it_codigo_media_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_it_codigo_media" type=text name="it_codigo_media" value="<?php echo $this->form_encode_input($it_codigo_media) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_it_codigo_media_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_it_codigo_media_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['media_desc_item']))
    {
        $this->nm_new_label['media_desc_item'] = "Descrição";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $media_desc_item = $this->media_desc_item;
   $sStyleHidden_media_desc_item = '';
   if (isset($this->nmgp_cmp_hidden['media_desc_item']) && $this->nmgp_cmp_hidden['media_desc_item'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['media_desc_item']);
       $sStyleHidden_media_desc_item = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_media_desc_item = 'display: none;';
   $sStyleReadInp_media_desc_item = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['media_desc_item']) && $this->nmgp_cmp_readonly['media_desc_item'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['media_desc_item']);
       $sStyleReadLab_media_desc_item = '';
       $sStyleReadInp_media_desc_item = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['media_desc_item']) && $this->nmgp_cmp_hidden['media_desc_item'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="media_desc_item" value="<?php echo $this->form_encode_input($media_desc_item) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_media_desc_item_label" id="hidden_field_label_media_desc_item" style="<?php echo $sStyleHidden_media_desc_item; ?>"><span id="id_label_media_desc_item"><?php echo $this->nm_new_label['media_desc_item']; ?></span></TD>
    <TD class="scFormDataOdd css_media_desc_item_line" id="hidden_field_data_media_desc_item" style="<?php echo $sStyleHidden_media_desc_item; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_media_desc_item_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="media_desc_item" value="<?php echo $this->form_encode_input($media_desc_item); ?>"><span id="id_ajax_label_media_desc_item"><?php echo nl2br($media_desc_item); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_media_desc_item_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_media_desc_item_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_estoque_media']))
    {
        $this->nm_new_label['qt_estoque_media'] = "Qt.Estoque";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_estoque_media = $this->qt_estoque_media;
   $sStyleHidden_qt_estoque_media = '';
   if (isset($this->nmgp_cmp_hidden['qt_estoque_media']) && $this->nmgp_cmp_hidden['qt_estoque_media'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_estoque_media']);
       $sStyleHidden_qt_estoque_media = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_estoque_media = 'display: none;';
   $sStyleReadInp_qt_estoque_media = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_estoque_media']) && $this->nmgp_cmp_readonly['qt_estoque_media'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_estoque_media']);
       $sStyleReadLab_qt_estoque_media = '';
       $sStyleReadInp_qt_estoque_media = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_estoque_media']) && $this->nmgp_cmp_hidden['qt_estoque_media'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_estoque_media" value="<?php echo $this->form_encode_input($qt_estoque_media) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_estoque_media_label" id="hidden_field_label_qt_estoque_media" style="<?php echo $sStyleHidden_qt_estoque_media; ?>"><span id="id_label_qt_estoque_media"><?php echo $this->nm_new_label['qt_estoque_media']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_estoque_media_line" id="hidden_field_data_qt_estoque_media" style="<?php echo $sStyleHidden_qt_estoque_media; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_estoque_media_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_estoque_media"]) &&  $this->nmgp_cmp_readonly["qt_estoque_media"] == "on") { 

 ?>
<input type="hidden" name="qt_estoque_media" value="<?php echo $this->form_encode_input($qt_estoque_media) . "\">" . $qt_estoque_media . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_estoque_media" class="sc-ui-readonly-qt_estoque_media css_qt_estoque_media_line" style="<?php echo $sStyleReadLab_qt_estoque_media; ?>"><?php echo $this->form_format_readonly("qt_estoque_media", $this->form_encode_input($this->qt_estoque_media)); ?></span><span id="id_read_off_qt_estoque_media" class="css_read_off_qt_estoque_media<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_estoque_media; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_estoque_media_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_estoque_media" type=text name="qt_estoque_media" value="<?php echo $this->form_encode_input($qt_estoque_media) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque_media']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque_media']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_estoque_media']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_estoque_media']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_estoque_media_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_estoque_media_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_unit_media']))
    {
        $this->nm_new_label['vl_unit_media'] = "Vl.Unit Atual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit_media = $this->vl_unit_media;
   $sStyleHidden_vl_unit_media = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit_media']) && $this->nmgp_cmp_hidden['vl_unit_media'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit_media']);
       $sStyleHidden_vl_unit_media = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit_media = 'display: none;';
   $sStyleReadInp_vl_unit_media = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit_media']) && $this->nmgp_cmp_readonly['vl_unit_media'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit_media']);
       $sStyleReadLab_vl_unit_media = '';
       $sStyleReadInp_vl_unit_media = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit_media']) && $this->nmgp_cmp_hidden['vl_unit_media'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit_media" value="<?php echo $this->form_encode_input($vl_unit_media) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_unit_media_label" id="hidden_field_label_vl_unit_media" style="<?php echo $sStyleHidden_vl_unit_media; ?>"><span id="id_label_vl_unit_media"><?php echo $this->nm_new_label['vl_unit_media']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_unit_media_line" id="hidden_field_data_vl_unit_media" style="<?php echo $sStyleHidden_vl_unit_media; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_unit_media_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit_media"]) &&  $this->nmgp_cmp_readonly["vl_unit_media"] == "on") { 

 ?>
<input type="hidden" name="vl_unit_media" value="<?php echo $this->form_encode_input($vl_unit_media) . "\">" . $vl_unit_media . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit_media" class="sc-ui-readonly-vl_unit_media css_vl_unit_media_line" style="<?php echo $sStyleReadLab_vl_unit_media; ?>"><?php echo $this->form_format_readonly("vl_unit_media", $this->form_encode_input($this->vl_unit_media)); ?></span><span id="id_read_off_vl_unit_media" class="css_read_off_vl_unit_media<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit_media; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_media_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit_media" type=text name="vl_unit_media" value="<?php echo $this->form_encode_input($vl_unit_media) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_media']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_media']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_media']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_media']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_unit_media_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_unit_media_text"></span></td></tr></table></td></tr></table></TD>
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
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="2" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Novo Valor - Média dos Itens</TD>
       
      </TR>
     </TABLE>
    </TD>

   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_media_itens']))
    {
        $this->nm_new_label['vl_media_itens'] = "Vl.Média Itens";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_media_itens = $this->vl_media_itens;
   $sStyleHidden_vl_media_itens = '';
   if (isset($this->nmgp_cmp_hidden['vl_media_itens']) && $this->nmgp_cmp_hidden['vl_media_itens'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_media_itens']);
       $sStyleHidden_vl_media_itens = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_media_itens = 'display: none;';
   $sStyleReadInp_vl_media_itens = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_media_itens']) && $this->nmgp_cmp_readonly['vl_media_itens'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_media_itens']);
       $sStyleReadLab_vl_media_itens = '';
       $sStyleReadInp_vl_media_itens = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_media_itens']) && $this->nmgp_cmp_hidden['vl_media_itens'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_media_itens" value="<?php echo $this->form_encode_input($vl_media_itens) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_media_itens_label" id="hidden_field_label_vl_media_itens" style="<?php echo $sStyleHidden_vl_media_itens; ?>"><span id="id_label_vl_media_itens"><?php echo $this->nm_new_label['vl_media_itens']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_media_itens_line" id="hidden_field_data_vl_media_itens" style="<?php echo $sStyleHidden_vl_media_itens; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_media_itens_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_media_itens"]) &&  $this->nmgp_cmp_readonly["vl_media_itens"] == "on") { 

 ?>
<input type="hidden" name="vl_media_itens" value="<?php echo $this->form_encode_input($vl_media_itens) . "\">" . $vl_media_itens . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_media_itens" class="sc-ui-readonly-vl_media_itens css_vl_media_itens_line" style="<?php echo $sStyleReadLab_vl_media_itens; ?>"><?php echo $this->form_format_readonly("vl_media_itens", $this->form_encode_input($this->vl_media_itens)); ?></span><span id="id_read_off_vl_media_itens" class="css_read_off_vl_media_itens<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_media_itens; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_media_itens_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_media_itens" type=text name="vl_media_itens" value="<?php echo $this->form_encode_input($vl_media_itens) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_media_itens']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_media_itens']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_media_itens']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_media_itens']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_media_itens_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_media_itens_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['desc_valid_item']))
    {
        $this->nm_new_label['desc_valid_item'] = "Validação Itens";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $desc_valid_item = $this->desc_valid_item;
   $sStyleHidden_desc_valid_item = '';
   if (isset($this->nmgp_cmp_hidden['desc_valid_item']) && $this->nmgp_cmp_hidden['desc_valid_item'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['desc_valid_item']);
       $sStyleHidden_desc_valid_item = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_desc_valid_item = 'display: none;';
   $sStyleReadInp_desc_valid_item = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['desc_valid_item']) && $this->nmgp_cmp_readonly['desc_valid_item'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['desc_valid_item']);
       $sStyleReadLab_desc_valid_item = '';
       $sStyleReadInp_desc_valid_item = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['desc_valid_item']) && $this->nmgp_cmp_hidden['desc_valid_item'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="desc_valid_item" value="<?php echo $this->form_encode_input($desc_valid_item) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_desc_valid_item_label" id="hidden_field_label_desc_valid_item" style="<?php echo $sStyleHidden_desc_valid_item; ?>"><span id="id_label_desc_valid_item"><?php echo $this->nm_new_label['desc_valid_item']; ?></span></TD>
    <TD class="scFormDataOdd css_desc_valid_item_line" id="hidden_field_data_desc_valid_item" style="<?php echo $sStyleHidden_desc_valid_item; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_desc_valid_item_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="desc_valid_item" value="<?php echo $this->form_encode_input($desc_valid_item); ?>"><span id="id_ajax_label_desc_valid_item"><?php echo nl2br($desc_valid_item); ?></span>

<?php
$desc_valid_item_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($desc_valid_item));

?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_desc_valid_item_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_desc_valid_item_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_unit_container']))
    {
        $this->nm_new_label['vl_unit_container'] = "Vl Unit Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit_container = $this->vl_unit_container;
   $sStyleHidden_vl_unit_container = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit_container']) && $this->nmgp_cmp_hidden['vl_unit_container'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit_container']);
       $sStyleHidden_vl_unit_container = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit_container = 'display: none;';
   $sStyleReadInp_vl_unit_container = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit_container']) && $this->nmgp_cmp_readonly['vl_unit_container'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit_container']);
       $sStyleReadLab_vl_unit_container = '';
       $sStyleReadInp_vl_unit_container = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit_container']) && $this->nmgp_cmp_hidden['vl_unit_container'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit_container" value="<?php echo $this->form_encode_input($vl_unit_container) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_unit_container_label" id="hidden_field_label_vl_unit_container" style="<?php echo $sStyleHidden_vl_unit_container; ?>"><span id="id_label_vl_unit_container"><?php echo $this->nm_new_label['vl_unit_container']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_unit_container_line" id="hidden_field_data_vl_unit_container" style="<?php echo $sStyleHidden_vl_unit_container; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_unit_container_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit_container"]) &&  $this->nmgp_cmp_readonly["vl_unit_container"] == "on") { 

 ?>
<input type="hidden" name="vl_unit_container" value="<?php echo $this->form_encode_input($vl_unit_container) . "\">" . $vl_unit_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit_container" class="sc-ui-readonly-vl_unit_container css_vl_unit_container_line" style="<?php echo $sStyleReadLab_vl_unit_container; ?>"><?php echo $this->form_format_readonly("vl_unit_container", $this->form_encode_input($this->vl_unit_container)); ?></span><span id="id_read_off_vl_unit_container" class="css_read_off_vl_unit_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit_container" type=text name="vl_unit_container" value="<?php echo $this->form_encode_input($vl_unit_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_container']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_container']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_container']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_container']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_unit_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_unit_container_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_container']))
    {
        $this->nm_new_label['qt_container'] = "Qt Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_container = $this->qt_container;
   $sStyleHidden_qt_container = '';
   if (isset($this->nmgp_cmp_hidden['qt_container']) && $this->nmgp_cmp_hidden['qt_container'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_container']);
       $sStyleHidden_qt_container = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_container = 'display: none;';
   $sStyleReadInp_qt_container = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_container']) && $this->nmgp_cmp_readonly['qt_container'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_container']);
       $sStyleReadLab_qt_container = '';
       $sStyleReadInp_qt_container = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_container']) && $this->nmgp_cmp_hidden['qt_container'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_container" value="<?php echo $this->form_encode_input($qt_container) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_container_label" id="hidden_field_label_qt_container" style="<?php echo $sStyleHidden_qt_container; ?>"><span id="id_label_qt_container"><?php echo $this->nm_new_label['qt_container']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_container_line" id="hidden_field_data_qt_container" style="<?php echo $sStyleHidden_qt_container; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_container_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_container"]) &&  $this->nmgp_cmp_readonly["qt_container"] == "on") { 

 ?>
<input type="hidden" name="qt_container" value="<?php echo $this->form_encode_input($qt_container) . "\">" . $qt_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_container" class="sc-ui-readonly-qt_container css_qt_container_line" style="<?php echo $sStyleReadLab_qt_container; ?>"><?php echo $this->form_format_readonly("qt_container", $this->form_encode_input($this->qt_container)); ?></span><span id="id_read_off_qt_container" class="css_read_off_qt_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_container" type=text name="qt_container" value="<?php echo $this->form_encode_input($qt_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_container']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_container']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_container']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_container']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_container_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "R")
{
        $sCondStyle = ($this->nmgp_botoes['bt_voltar'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['bt_voltar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['bt_voltar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_voltar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_voltar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_voltar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_voltar", "scBtnFn_bt_voltar()", "scBtnFn_bt_voltar()", "sc_bt_voltar_bot", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
        $sCondStyle = ($this->nmgp_botoes['bt_validar_itens'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['bt_validar_itens']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['bt_validar_itens']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_validar_itens']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_validar_itens']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['bt_validar_itens'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_validar_itens", "scBtnFn_bt_validar_itens()", "scBtnFn_bt_validar_itens()", "sc_bt_validar_itens_bot", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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
    if (isset($this->NMSC_modal) && $this->NMSC_modal == "ok") {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai_modal()", "scBtnFn_sys_format_sai_modal()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['run_iframe'] != "R")
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
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage({title: '', message: "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", isModal: false, timeout: 0, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: true, showBodyIcon: false, isToast: false, toastPos: ""});
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_item_custos_media_01");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_item_custos_media_01");
 parent.scAjaxDetailHeight("form_item_custos_media_01", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_item_custos_media_01", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_item_custos_media_01", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['sc_modal'])
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
        function scBtnFn_bt_voltar() {
                if ($("#sc_bt_voltar_bot").length && $("#sc_bt_voltar_bot").is(":visible")) {
                    if ($("#sc_bt_voltar_bot").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_voltar()
                         return;
                }
        }
        function scBtnFn_bt_validar_itens() {
                if ($("#sc_bt_validar_itens_bot").length && $("#sc_bt_validar_itens_bot").is(":visible")) {
                    if ($("#sc_bt_validar_itens_bot").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_validar_itens()
                         return;
                }
        }
        function scBtnFn_sys_format_inc() {
                if ($("#sc_b_new_b.sc-unique-btn-1").length && $("#sc_b_new_b.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_new_b.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_b.sc-unique-btn-2").length && $("#sc_b_ins_b.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_ins_b.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_sai_modal() {
                if ($("#sc_b_sai_b.sc-unique-btn-3").length && $("#sc_b_sai_b.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_sai_b.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_media_01']['buttonStatus'] = $this->nmgp_botoes;
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
