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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . ""); } else { echo strip_tags("Distribuição de Custo - " . $_SESSION['desc_item'] . ""); } ?></TITLE>
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
                       'mobileSimpleToolbar' => false,
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['embutida_pdf']))
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
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>ctrl_simul_distr_custo/ctrl_simul_distr_custo_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("ctrl_simul_distr_custo_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('ctrl_simul_distr_custo_jquery.php');

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
    $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['link_info']['remove_border']) {
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
<body class="scFormPage sc-app-contr" style="<?php echo $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
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
 include_once("ctrl_simul_distr_custo_js0.php");
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
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['ctrl_simul_distr_custo'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['ctrl_simul_distr_custo'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="3" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Saldos</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_saldo_atual']))
    {
        $this->nm_new_label['vl_saldo_atual'] = "Vl. Saldo Atual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_saldo_atual = $this->vl_saldo_atual;
   $sStyleHidden_vl_saldo_atual = '';
   if (isset($this->nmgp_cmp_hidden['vl_saldo_atual']) && $this->nmgp_cmp_hidden['vl_saldo_atual'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_saldo_atual']);
       $sStyleHidden_vl_saldo_atual = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_saldo_atual = 'display: none;';
   $sStyleReadInp_vl_saldo_atual = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_saldo_atual']) && $this->nmgp_cmp_readonly['vl_saldo_atual'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_saldo_atual']);
       $sStyleReadLab_vl_saldo_atual = '';
       $sStyleReadInp_vl_saldo_atual = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_saldo_atual']) && $this->nmgp_cmp_hidden['vl_saldo_atual'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_saldo_atual" value="<?php echo $this->form_encode_input($vl_saldo_atual) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_saldo_atual_line" id="hidden_field_data_vl_saldo_atual" style="<?php echo $sStyleHidden_vl_saldo_atual; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_saldo_atual_label" style=""><span id="id_label_vl_saldo_atual"><?php echo $this->nm_new_label['vl_saldo_atual']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_saldo_atual"]) &&  $this->nmgp_cmp_readonly["vl_saldo_atual"] == "on") { 

 ?>
<input type="hidden" name="vl_saldo_atual" value="<?php echo $this->form_encode_input($vl_saldo_atual) . "\">" . $vl_saldo_atual . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_saldo_atual" class="sc-ui-readonly-vl_saldo_atual css_vl_saldo_atual_line" style="<?php echo $sStyleReadLab_vl_saldo_atual; ?>"><?php echo $this->form_format_readonly("vl_saldo_atual", $this->form_encode_input($this->vl_saldo_atual)); ?></span><span id="id_read_off_vl_saldo_atual" class="css_read_off_vl_saldo_atual<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_saldo_atual; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_saldo_atual_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_saldo_atual" type=text name="vl_saldo_atual" value="<?php echo $this->form_encode_input($vl_saldo_atual) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_saldo_atual']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_saldo_atual']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_saldo_atual']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_saldo_atual']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_distr_real']))
    {
        $this->nm_new_label['vl_distr_real'] = "Vl.Distr. Em Real";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_distr_real = $this->vl_distr_real;
   $sStyleHidden_vl_distr_real = '';
   if (isset($this->nmgp_cmp_hidden['vl_distr_real']) && $this->nmgp_cmp_hidden['vl_distr_real'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_distr_real']);
       $sStyleHidden_vl_distr_real = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_distr_real = 'display: none;';
   $sStyleReadInp_vl_distr_real = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_distr_real']) && $this->nmgp_cmp_readonly['vl_distr_real'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_distr_real']);
       $sStyleReadLab_vl_distr_real = '';
       $sStyleReadInp_vl_distr_real = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_distr_real']) && $this->nmgp_cmp_hidden['vl_distr_real'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_distr_real" value="<?php echo $this->form_encode_input($vl_distr_real) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_distr_real_line" id="hidden_field_data_vl_distr_real" style="<?php echo $sStyleHidden_vl_distr_real; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_distr_real_label" style=""><span id="id_label_vl_distr_real"><?php echo $this->nm_new_label['vl_distr_real']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_distr_real"]) &&  $this->nmgp_cmp_readonly["vl_distr_real"] == "on") { 

 ?>
<input type="hidden" name="vl_distr_real" value="<?php echo $this->form_encode_input($vl_distr_real) . "\">" . $vl_distr_real . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_distr_real" class="sc-ui-readonly-vl_distr_real css_vl_distr_real_line" style="<?php echo $sStyleReadLab_vl_distr_real; ?>"><?php echo $this->form_format_readonly("vl_distr_real", $this->form_encode_input($this->vl_distr_real)); ?></span><span id="id_read_off_vl_distr_real" class="css_read_off_vl_distr_real<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_distr_real; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_distr_real_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_distr_real" type=text name="vl_distr_real" value="<?php echo $this->form_encode_input($vl_distr_real) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_distr_real']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_distr_real']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_distr_real']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_distr_real']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_saldo_simulado']))
    {
        $this->nm_new_label['vl_saldo_simulado'] = "Vl. Saldo Slimulado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_saldo_simulado = $this->vl_saldo_simulado;
   $sStyleHidden_vl_saldo_simulado = '';
   if (isset($this->nmgp_cmp_hidden['vl_saldo_simulado']) && $this->nmgp_cmp_hidden['vl_saldo_simulado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_saldo_simulado']);
       $sStyleHidden_vl_saldo_simulado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_saldo_simulado = 'display: none;';
   $sStyleReadInp_vl_saldo_simulado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_saldo_simulado']) && $this->nmgp_cmp_readonly['vl_saldo_simulado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_saldo_simulado']);
       $sStyleReadLab_vl_saldo_simulado = '';
       $sStyleReadInp_vl_saldo_simulado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_saldo_simulado']) && $this->nmgp_cmp_hidden['vl_saldo_simulado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_saldo_simulado" value="<?php echo $this->form_encode_input($vl_saldo_simulado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_saldo_simulado_line" id="hidden_field_data_vl_saldo_simulado" style="<?php echo $sStyleHidden_vl_saldo_simulado; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_saldo_simulado_label" style=""><span id="id_label_vl_saldo_simulado"><?php echo $this->nm_new_label['vl_saldo_simulado']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_saldo_simulado"]) &&  $this->nmgp_cmp_readonly["vl_saldo_simulado"] == "on") { 

 ?>
<input type="hidden" name="vl_saldo_simulado" value="<?php echo $this->form_encode_input($vl_saldo_simulado) . "\">" . $vl_saldo_simulado . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_saldo_simulado" class="sc-ui-readonly-vl_saldo_simulado css_vl_saldo_simulado_line" style="<?php echo $sStyleReadLab_vl_saldo_simulado; ?>"><?php echo $this->form_format_readonly("vl_saldo_simulado", $this->form_encode_input($this->vl_saldo_simulado)); ?></span><span id="id_read_off_vl_saldo_simulado" class="css_read_off_vl_saldo_simulado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_saldo_simulado; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_saldo_simulado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_saldo_simulado" type=text name="vl_saldo_simulado" value="<?php echo $this->form_encode_input($vl_saldo_simulado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_saldo_simulado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_saldo_simulado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_saldo_simulado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: true, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_saldo_simulado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_vl_saldo_atual_dumb = ('' == $sStyleHidden_vl_saldo_atual) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_saldo_atual_dumb" style="<?php echo $sStyleHidden_vl_saldo_atual_dumb; ?>"></TD>
<?php $sStyleHidden_vl_distr_real_dumb = ('' == $sStyleHidden_vl_distr_real) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_distr_real_dumb" style="<?php echo $sStyleHidden_vl_distr_real_dumb; ?>"></TD>
<?php $sStyleHidden_vl_saldo_simulado_dumb = ('' == $sStyleHidden_vl_saldo_simulado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_saldo_simulado_dumb" style="<?php echo $sStyleHidden_vl_saldo_simulado_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="3" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Tipo Simulação</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tipo_simulacao']))
   {
       $this->nm_new_label['tipo_simulacao'] = "Tipo Simulação";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_simulacao = $this->tipo_simulacao;
   $sStyleHidden_tipo_simulacao = '';
   if (isset($this->nmgp_cmp_hidden['tipo_simulacao']) && $this->nmgp_cmp_hidden['tipo_simulacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_simulacao']);
       $sStyleHidden_tipo_simulacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_simulacao = 'display: none;';
   $sStyleReadInp_tipo_simulacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_simulacao']) && $this->nmgp_cmp_readonly['tipo_simulacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_simulacao']);
       $sStyleReadLab_tipo_simulacao = '';
       $sStyleReadInp_tipo_simulacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_simulacao']) && $this->nmgp_cmp_hidden['tipo_simulacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tipo_simulacao" value="<?php echo $this->form_encode_input($this->tipo_simulacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tipo_simulacao_line" id="hidden_field_data_tipo_simulacao" style="<?php echo $sStyleHidden_tipo_simulacao; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_simulacao_label" style=""><span id="id_label_tipo_simulacao"><?php echo $this->nm_new_label['tipo_simulacao']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_simulacao"]) &&  $this->nmgp_cmp_readonly["tipo_simulacao"] == "on") { 

$tipo_simulacao_look = "";
 if ($this->tipo_simulacao == "1") { $tipo_simulacao_look .= "Vl.Distribuido" ;} 
 if ($this->tipo_simulacao == "2") { $tipo_simulacao_look .= "Vl.Unit.Simulado" ;} 
 if ($this->tipo_simulacao == "3") { $tipo_simulacao_look .= "Percentual" ;} 
 if (empty($tipo_simulacao_look)) { $tipo_simulacao_look = $this->tipo_simulacao; }
?>
<input type="hidden" name="tipo_simulacao" value="<?php echo $this->form_encode_input($tipo_simulacao) . "\">" . $tipo_simulacao_look . ""; ?>
<?php } else { ?>
<?php

$tipo_simulacao_look = "";
 if ($this->tipo_simulacao == "1") { $tipo_simulacao_look .= "Vl.Distribuido" ;} 
 if ($this->tipo_simulacao == "2") { $tipo_simulacao_look .= "Vl.Unit.Simulado" ;} 
 if ($this->tipo_simulacao == "3") { $tipo_simulacao_look .= "Percentual" ;} 
 if (empty($tipo_simulacao_look)) { $tipo_simulacao_look = $this->tipo_simulacao; }
?>
<span id="id_read_on_tipo_simulacao" class="css_tipo_simulacao_line"  style="<?php echo $sStyleReadLab_tipo_simulacao; ?>"><?php echo $this->form_format_readonly("tipo_simulacao", $this->form_encode_input($tipo_simulacao_look)); ?></span><span id="id_read_off_tipo_simulacao" class="css_read_off_tipo_simulacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tipo_simulacao; ?>">
 <span id="idAjaxSelect_tipo_simulacao" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tipo_simulacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tipo_simulacao" name="tipo_simulacao" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->tipo_simulacao == "1") { echo " selected" ;} ?><?php  if (empty($this->tipo_simulacao)) { echo " selected" ;} ?>>Vl.Distribuido</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['Lookup_tipo_simulacao'][] = '1'; ?>
 <option  value="2" <?php  if ($this->tipo_simulacao == "2") { echo " selected" ;} ?>>Vl.Unit.Simulado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['Lookup_tipo_simulacao'][] = '2'; ?>
 <option  value="3" <?php  if ($this->tipo_simulacao == "3") { echo " selected" ;} ?>>Percentual</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['Lookup_tipo_simulacao'][] = '3'; ?>
 </select></span>
</span><?php  }?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['moeda']))
    {
        $this->nm_new_label['moeda'] = "Moeda";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $moeda = $this->moeda;
   $sStyleHidden_moeda = '';
   if (isset($this->nmgp_cmp_hidden['moeda']) && $this->nmgp_cmp_hidden['moeda'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['moeda']);
       $sStyleHidden_moeda = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_moeda = 'display: none;';
   $sStyleReadInp_moeda = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['moeda']) && $this->nmgp_cmp_readonly['moeda'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['moeda']);
       $sStyleReadLab_moeda = '';
       $sStyleReadInp_moeda = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['moeda']) && $this->nmgp_cmp_hidden['moeda'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="moeda" value="<?php echo $this->form_encode_input($moeda) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_moeda_line" id="hidden_field_data_moeda" style="<?php echo $sStyleHidden_moeda; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_moeda_label" style=""><span id="id_label_moeda"><?php echo $this->nm_new_label['moeda']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["moeda"]) &&  $this->nmgp_cmp_readonly["moeda"] == "on") { 

 ?>
<input type="hidden" name="moeda" value="<?php echo $this->form_encode_input($moeda) . "\">" . $moeda . ""; ?>
<?php } else { ?>
<span id="id_read_on_moeda" class="sc-ui-readonly-moeda css_moeda_line" style="<?php echo $sStyleReadLab_moeda; ?>"><?php echo $this->form_format_readonly("moeda", $this->form_encode_input($this->moeda)); ?></span><span id="id_read_off_moeda" class="css_read_off_moeda<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_moeda; ?>">
 <input class="sc-js-input scFormObjectOdd css_moeda_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_moeda" type=text name="moeda" value="<?php echo $this->form_encode_input($moeda) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dolar_medio']))
    {
        $this->nm_new_label['dolar_medio'] = "Dólar Medio";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dolar_medio = $this->dolar_medio;
   $sStyleHidden_dolar_medio = '';
   if (isset($this->nmgp_cmp_hidden['dolar_medio']) && $this->nmgp_cmp_hidden['dolar_medio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dolar_medio']);
       $sStyleHidden_dolar_medio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dolar_medio = 'display: none;';
   $sStyleReadInp_dolar_medio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dolar_medio']) && $this->nmgp_cmp_readonly['dolar_medio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dolar_medio']);
       $sStyleReadLab_dolar_medio = '';
       $sStyleReadInp_dolar_medio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dolar_medio']) && $this->nmgp_cmp_hidden['dolar_medio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dolar_medio" value="<?php echo $this->form_encode_input($dolar_medio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dolar_medio_line" id="hidden_field_data_dolar_medio" style="<?php echo $sStyleHidden_dolar_medio; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dolar_medio_label" style=""><span id="id_label_dolar_medio"><?php echo $this->nm_new_label['dolar_medio']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dolar_medio"]) &&  $this->nmgp_cmp_readonly["dolar_medio"] == "on") { 

 ?>
<input type="hidden" name="dolar_medio" value="<?php echo $this->form_encode_input($dolar_medio) . "\">" . $dolar_medio . ""; ?>
<?php } else { ?>
<span id="id_read_on_dolar_medio" class="sc-ui-readonly-dolar_medio css_dolar_medio_line" style="<?php echo $sStyleReadLab_dolar_medio; ?>"><?php echo $this->form_format_readonly("dolar_medio", $this->form_encode_input($this->dolar_medio)); ?></span><span id="id_read_off_dolar_medio" class="css_read_off_dolar_medio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dolar_medio; ?>">
 <input class="sc-js-input scFormObjectOdd css_dolar_medio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dolar_medio" type=text name="dolar_medio" value="<?php echo $this->form_encode_input($dolar_medio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['dolar_medio']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['dolar_medio']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['dolar_medio']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['dolar_medio']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tipo_simulacao_dumb = ('' == $sStyleHidden_tipo_simulacao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tipo_simulacao_dumb" style="<?php echo $sStyleHidden_tipo_simulacao_dumb; ?>"></TD>
<?php $sStyleHidden_moeda_dumb = ('' == $sStyleHidden_moeda) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_moeda_dumb" style="<?php echo $sStyleHidden_moeda_dumb; ?>"></TD>
<?php $sStyleHidden_dolar_medio_dumb = ('' == $sStyleHidden_dolar_medio) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dolar_medio_dumb" style="<?php echo $sStyleHidden_dolar_medio_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="7" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Simulação e Distribuição</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qte']))
    {
        $this->nm_new_label['qte'] = "Qte.";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qte = $this->qte;
   $sStyleHidden_qte = '';
   if (isset($this->nmgp_cmp_hidden['qte']) && $this->nmgp_cmp_hidden['qte'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qte']);
       $sStyleHidden_qte = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qte = 'display: none;';
   $sStyleReadInp_qte = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qte']) && $this->nmgp_cmp_readonly['qte'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qte']);
       $sStyleReadLab_qte = '';
       $sStyleReadInp_qte = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qte']) && $this->nmgp_cmp_hidden['qte'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qte" value="<?php echo $this->form_encode_input($qte) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_qte_line" id="hidden_field_data_qte" style="<?php echo $sStyleHidden_qte; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_qte_label" style=""><span id="id_label_qte"><?php echo $this->nm_new_label['qte']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qte"]) &&  $this->nmgp_cmp_readonly["qte"] == "on") { 

 ?>
<input type="hidden" name="qte" value="<?php echo $this->form_encode_input($qte) . "\">" . $qte . ""; ?>
<?php } else { ?>
<span id="id_read_on_qte" class="sc-ui-readonly-qte css_qte_line" style="<?php echo $sStyleReadLab_qte; ?>"><?php echo $this->form_format_readonly("qte", $this->form_encode_input($this->qte)); ?></span><span id="id_read_off_qte" class="css_read_off_qte<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qte; ?>">
 <input class="sc-js-input scFormObjectOdd css_qte_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qte" type=text name="qte" value="<?php echo $this->form_encode_input($qte) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qte']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qte']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qte']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qte']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_neg']))
    {
        $this->nm_new_label['vl_neg'] = "Vl.Negociado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_neg = $this->vl_neg;
   $sStyleHidden_vl_neg = '';
   if (isset($this->nmgp_cmp_hidden['vl_neg']) && $this->nmgp_cmp_hidden['vl_neg'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_neg']);
       $sStyleHidden_vl_neg = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_neg = 'display: none;';
   $sStyleReadInp_vl_neg = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_neg']) && $this->nmgp_cmp_readonly['vl_neg'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_neg']);
       $sStyleReadLab_vl_neg = '';
       $sStyleReadInp_vl_neg = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_neg']) && $this->nmgp_cmp_hidden['vl_neg'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_neg" value="<?php echo $this->form_encode_input($vl_neg) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_neg_line" id="hidden_field_data_vl_neg" style="<?php echo $sStyleHidden_vl_neg; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_neg_label" style=""><span id="id_label_vl_neg"><?php echo $this->nm_new_label['vl_neg']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_neg"]) &&  $this->nmgp_cmp_readonly["vl_neg"] == "on") { 

 ?>
<input type="hidden" name="vl_neg" value="<?php echo $this->form_encode_input($vl_neg) . "\">" . $vl_neg . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_neg" class="sc-ui-readonly-vl_neg css_vl_neg_line" style="<?php echo $sStyleReadLab_vl_neg; ?>"><?php echo $this->form_format_readonly("vl_neg", $this->form_encode_input($this->vl_neg)); ?></span><span id="id_read_off_vl_neg" class="css_read_off_vl_neg<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_neg; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_neg_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_neg" type=text name="vl_neg" value="<?php echo $this->form_encode_input($vl_neg) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_neg']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_neg']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_neg']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_neg']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_desp']))
    {
        $this->nm_new_label['vl_desp'] = "Vl.Despesa";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_desp = $this->vl_desp;
   $sStyleHidden_vl_desp = '';
   if (isset($this->nmgp_cmp_hidden['vl_desp']) && $this->nmgp_cmp_hidden['vl_desp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_desp']);
       $sStyleHidden_vl_desp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_desp = 'display: none;';
   $sStyleReadInp_vl_desp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_desp']) && $this->nmgp_cmp_readonly['vl_desp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_desp']);
       $sStyleReadLab_vl_desp = '';
       $sStyleReadInp_vl_desp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_desp']) && $this->nmgp_cmp_hidden['vl_desp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_desp" value="<?php echo $this->form_encode_input($vl_desp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_desp_line" id="hidden_field_data_vl_desp" style="<?php echo $sStyleHidden_vl_desp; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_desp_label" style=""><span id="id_label_vl_desp"><?php echo $this->nm_new_label['vl_desp']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_desp"]) &&  $this->nmgp_cmp_readonly["vl_desp"] == "on") { 

 ?>
<input type="hidden" name="vl_desp" value="<?php echo $this->form_encode_input($vl_desp) . "\">" . $vl_desp . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_desp" class="sc-ui-readonly-vl_desp css_vl_desp_line" style="<?php echo $sStyleReadLab_vl_desp; ?>"><?php echo $this->form_format_readonly("vl_desp", $this->form_encode_input($this->vl_desp)); ?></span><span id="id_read_off_vl_desp" class="css_read_off_vl_desp<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_desp; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_desp_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_desp" type=text name="vl_desp" value="<?php echo $this->form_encode_input($vl_desp) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_desp']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_desp']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_desp']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_desp']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_unit']))
    {
        $this->nm_new_label['vl_unit'] = "Vl.Unitário Atual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit = $this->vl_unit;
   $sStyleHidden_vl_unit = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit']) && $this->nmgp_cmp_hidden['vl_unit'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit']);
       $sStyleHidden_vl_unit = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit = 'display: none;';
   $sStyleReadInp_vl_unit = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit']) && $this->nmgp_cmp_readonly['vl_unit'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit']);
       $sStyleReadLab_vl_unit = '';
       $sStyleReadInp_vl_unit = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit']) && $this->nmgp_cmp_hidden['vl_unit'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit" value="<?php echo $this->form_encode_input($vl_unit) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_unit_line" id="hidden_field_data_vl_unit" style="<?php echo $sStyleHidden_vl_unit; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_unit_label" style=""><span id="id_label_vl_unit"><?php echo $this->nm_new_label['vl_unit']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit"]) &&  $this->nmgp_cmp_readonly["vl_unit"] == "on") { 

 ?>
<input type="hidden" name="vl_unit" value="<?php echo $this->form_encode_input($vl_unit) . "\">" . $vl_unit . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit" class="sc-ui-readonly-vl_unit css_vl_unit_line" style="<?php echo $sStyleReadLab_vl_unit; ?>"><?php echo $this->form_format_readonly("vl_unit", $this->form_encode_input($this->vl_unit)); ?></span><span id="id_read_off_vl_unit" class="css_read_off_vl_unit<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit" type=text name="vl_unit" value="<?php echo $this->form_encode_input($vl_unit) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_distr']))
    {
        $this->nm_new_label['vl_distr'] = "Vl. a Distribuir";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_distr = $this->vl_distr;
   $sStyleHidden_vl_distr = '';
   if (isset($this->nmgp_cmp_hidden['vl_distr']) && $this->nmgp_cmp_hidden['vl_distr'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_distr']);
       $sStyleHidden_vl_distr = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_distr = 'display: none;';
   $sStyleReadInp_vl_distr = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_distr']) && $this->nmgp_cmp_readonly['vl_distr'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_distr']);
       $sStyleReadLab_vl_distr = '';
       $sStyleReadInp_vl_distr = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_distr']) && $this->nmgp_cmp_hidden['vl_distr'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_distr" value="<?php echo $this->form_encode_input($vl_distr) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_distr_line" id="hidden_field_data_vl_distr" style="<?php echo $sStyleHidden_vl_distr; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_distr_label" style=""><span id="id_label_vl_distr"><?php echo $this->nm_new_label['vl_distr']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_distr"]) &&  $this->nmgp_cmp_readonly["vl_distr"] == "on") { 

 ?>
<input type="hidden" name="vl_distr" value="<?php echo $this->form_encode_input($vl_distr) . "\">" . $vl_distr . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_distr" class="sc-ui-readonly-vl_distr css_vl_distr_line" style="<?php echo $sStyleReadLab_vl_distr; ?>"><?php echo $this->form_format_readonly("vl_distr", $this->form_encode_input($this->vl_distr)); ?></span><span id="id_read_off_vl_distr" class="css_read_off_vl_distr<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_distr; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_distr_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_distr" type=text name="vl_distr" value="<?php echo $this->form_encode_input($vl_distr) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_distr']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_distr']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_distr']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_distr']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_unit_simulado']))
    {
        $this->nm_new_label['vl_unit_simulado'] = "Vl.Unit.Simulado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit_simulado = $this->vl_unit_simulado;
   $sStyleHidden_vl_unit_simulado = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit_simulado']) && $this->nmgp_cmp_hidden['vl_unit_simulado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit_simulado']);
       $sStyleHidden_vl_unit_simulado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit_simulado = 'display: none;';
   $sStyleReadInp_vl_unit_simulado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit_simulado']) && $this->nmgp_cmp_readonly['vl_unit_simulado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit_simulado']);
       $sStyleReadLab_vl_unit_simulado = '';
       $sStyleReadInp_vl_unit_simulado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit_simulado']) && $this->nmgp_cmp_hidden['vl_unit_simulado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit_simulado" value="<?php echo $this->form_encode_input($vl_unit_simulado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_vl_unit_simulado_line" id="hidden_field_data_vl_unit_simulado" style="<?php echo $sStyleHidden_vl_unit_simulado; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_unit_simulado_label" style=""><span id="id_label_vl_unit_simulado"><?php echo $this->nm_new_label['vl_unit_simulado']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit_simulado"]) &&  $this->nmgp_cmp_readonly["vl_unit_simulado"] == "on") { 

 ?>
<input type="hidden" name="vl_unit_simulado" value="<?php echo $this->form_encode_input($vl_unit_simulado) . "\">" . $vl_unit_simulado . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit_simulado" class="sc-ui-readonly-vl_unit_simulado css_vl_unit_simulado_line" style="<?php echo $sStyleReadLab_vl_unit_simulado; ?>"><?php echo $this->form_format_readonly("vl_unit_simulado", $this->form_encode_input($this->vl_unit_simulado)); ?></span><span id="id_read_off_vl_unit_simulado" class="css_read_off_vl_unit_simulado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit_simulado; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_simulado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit_simulado" type=text name="vl_unit_simulado" value="<?php echo $this->form_encode_input($vl_unit_simulado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_simulado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_simulado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_simulado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_simulado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['perc']))
    {
        $this->nm_new_label['perc'] = "Percentual";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $perc = $this->perc;
   $sStyleHidden_perc = '';
   if (isset($this->nmgp_cmp_hidden['perc']) && $this->nmgp_cmp_hidden['perc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['perc']);
       $sStyleHidden_perc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_perc = 'display: none;';
   $sStyleReadInp_perc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['perc']) && $this->nmgp_cmp_readonly['perc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['perc']);
       $sStyleReadLab_perc = '';
       $sStyleReadInp_perc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['perc']) && $this->nmgp_cmp_hidden['perc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="perc" value="<?php echo $this->form_encode_input($perc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_perc_line" id="hidden_field_data_perc" style="<?php echo $sStyleHidden_perc; ?>"> <span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_perc_label" style=""><span id="id_label_perc"><?php echo $this->nm_new_label['perc']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["perc"]) &&  $this->nmgp_cmp_readonly["perc"] == "on") { 

 ?>
<input type="hidden" name="perc" value="<?php echo $this->form_encode_input($perc) . "\">" . $perc . ""; ?>
<?php } else { ?>
<span id="id_read_on_perc" class="sc-ui-readonly-perc css_perc_line" style="<?php echo $sStyleReadLab_perc; ?>"><?php echo $this->form_format_readonly("perc", $this->form_encode_input($this->perc)); ?></span><span id="id_read_off_perc" class="css_read_off_perc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_perc; ?>">
 <input class="sc-js-input scFormObjectOdd css_perc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_perc" type=text name="perc" value="<?php echo $this->form_encode_input($perc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['perc']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['perc']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['perc']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['perc']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_qte_dumb = ('' == $sStyleHidden_qte) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_qte_dumb" style="<?php echo $sStyleHidden_qte_dumb; ?>"></TD>
<?php $sStyleHidden_vl_neg_dumb = ('' == $sStyleHidden_vl_neg) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_neg_dumb" style="<?php echo $sStyleHidden_vl_neg_dumb; ?>"></TD>
<?php $sStyleHidden_vl_desp_dumb = ('' == $sStyleHidden_vl_desp) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_desp_dumb" style="<?php echo $sStyleHidden_vl_desp_dumb; ?>"></TD>
<?php $sStyleHidden_vl_unit_dumb = ('' == $sStyleHidden_vl_unit) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_unit_dumb" style="<?php echo $sStyleHidden_vl_unit_dumb; ?>"></TD>
<?php $sStyleHidden_vl_distr_dumb = ('' == $sStyleHidden_vl_distr) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_distr_dumb" style="<?php echo $sStyleHidden_vl_distr_dumb; ?>"></TD>
<?php $sStyleHidden_vl_unit_simulado_dumb = ('' == $sStyleHidden_vl_unit_simulado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_unit_simulado_dumb" style="<?php echo $sStyleHidden_vl_unit_simulado_dumb; ?>"></TD>
<?php $sStyleHidden_perc_dumb = ('' == $sStyleHidden_perc) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_perc_dumb" style="<?php echo $sStyleHidden_perc_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['historico']))
    {
        $this->nm_new_label['historico'] = "Histórico";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $historico = $this->historico;
   $sStyleHidden_historico = '';
   if (isset($this->nmgp_cmp_hidden['historico']) && $this->nmgp_cmp_hidden['historico'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['historico']);
       $sStyleHidden_historico = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_historico = 'display: none;';
   $sStyleReadInp_historico = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['historico']) && $this->nmgp_cmp_readonly['historico'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['historico']);
       $sStyleReadLab_historico = '';
       $sStyleReadInp_historico = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['historico']) && $this->nmgp_cmp_hidden['historico'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="historico" value="<?php echo $this->form_encode_input($historico) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_historico_label" id="hidden_field_label_historico" style="<?php echo $sStyleHidden_historico; ?>"><span id="id_label_historico"><?php echo $this->nm_new_label['historico']; ?></span></TD>
    <TD class="scFormDataOdd css_historico_line" id="hidden_field_data_historico" style="<?php echo $sStyleHidden_historico; ?>">
<?php
$historico_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($historico));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["historico"]) &&  $this->nmgp_cmp_readonly["historico"] == "on") { 

 ?>
<input type="hidden" name="historico" value="<?php echo $this->form_encode_input($historico) . "\">" . $historico_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_historico" class="sc-ui-readonly-historico css_historico_line" style="<?php echo $sStyleReadLab_historico; ?>"><?php echo $this->form_format_readonly("historico", $this->form_encode_input($historico_val)); ?></span><span id="id_read_off_historico" class="css_read_off_historico<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_historico; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_historico_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="historico" id="id_sc_field_historico" rows="1" cols="100"
 alt="{datatype: 'text', maxLength: 2000, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $historico; ?>
</textarea>
</span><?php } ?>
<span class="scFormPopupBubble" style="display: inline-block"><span class="scFormPopupTrigger"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "return false;", "return false;", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span><table class="scFormPopup"><tbody><?php
if (isset($_SESSION['scriptcase']['reg_conf']['html_dir']) && $_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'") {
?>
<tr><td class="scFormPopupTopRight scFormPopupCorner"></td><td class="scFormPopupTop"></td><td class="scFormPopupTopLeft scFormPopupCorner"></td></tr><tr><td class="scFormPopupRight"></td><td class="scFormPopupContent">Informe um histórico a ser adicionado na criação da distribuição de custo.</td><td class="scFormPopupLeft"></td></tr><tr><td class="scFormPopupBottomRight scFormPopupCorner"></td><td class="scFormPopupBottom"><img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Bubble_tail; ?>" /></td><td class="scFormPopupBottomLeft scFormPopupCorner"></td></tr><?php
} else {
?>
<tr><td class="scFormPopupTopLeft scFormPopupCorner"></td><td class="scFormPopupTop"></td><td class="scFormPopupTopRight scFormPopupCorner"></td></tr><tr><td class="scFormPopupLeft"></td><td class="scFormPopupContent">Informe um histórico a ser adicionado na criação da distribuição de custo.</td><td class="scFormPopupRight"></td></tr><tr><td class="scFormPopupBottomLeft scFormPopupCorner"></td><td class="scFormPopupBottom"><img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Bubble_tail; ?>" /></td><td class="scFormPopupBottomRight scFormPopupCorner"></td></tr><?php
}
?>
</tbody></table></span></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
    $NM_btn = false;
?>
<?php
        $sCondStyle = ($this->nmgp_botoes['ok'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "Distribuir Custo";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['ok']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['ok']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['ok']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['ok']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['ok'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bok", "scBtnFn_sys_format_ok()", "scBtnFn_sys_format_ok()", "sub_form_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
?>
       
<?php
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if (($nm_apl_dependente != 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard'])) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['nm_run_menu']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['nm_run_menu'] != 1))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "Bsair_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if (($nm_apl_dependente == 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "Bsair_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_bot", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_1'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['sc_btn_1']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_disabled']['sc_btn_1']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_1']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_1']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['btn_label']['sc_btn_1'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_1", "scBtnFn_sc_btn_1()", "scBtnFn_sc_btn_1()", "sc_sc_btn_1_bot", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?>
            </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("ctrl_simul_distr_custo");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("ctrl_simul_distr_custo");
 parent.scAjaxDetailHeight("ctrl_simul_distr_custo", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("ctrl_simul_distr_custo", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("ctrl_simul_distr_custo", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['sc_modal'])
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
        function scBtnFn_sys_format_ok() {
                if ($("#sub_form_b.sc-unique-btn-1").length && $("#sub_form_b.sc-unique-btn-1").is(":visible")) {
                    if ($("#sub_form_b.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_b").length && $("#sc_b_hlp_b").is(":visible")) {
                    if ($("#sc_b_hlp_b").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                         return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#Bsair_b.sc-unique-btn-2").length && $("#Bsair_b.sc-unique-btn-2").is(":visible")) {
                    if ($("#Bsair_b.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_saida_glo(); return false;
                         return;
                }
                if ($("#Bsair_b.sc-unique-btn-3").length && $("#Bsair_b.sc-unique-btn-3").is(":visible")) {
                    if ($("#Bsair_b.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_saida_glo(); return false;
                         return;
                }
        }
        function scBtnFn_sc_btn_0() {
                if ($("#sc_sc_btn_0_bot").length && $("#sc_sc_btn_0_bot").is(":visible")) {
                    if ($("#sc_sc_btn_0_bot").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
        }
        function scBtnFn_sc_btn_1() {
                if ($("#sc_sc_btn_1_bot").length && $("#sc_sc_btn_1_bot").is(":visible")) {
                    if ($("#sc_sc_btn_1_bot").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_1()
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
$_SESSION['sc_session'][$this->Ini->sc_page]['ctrl_simul_distr_custo']['buttonStatus'] = $this->nmgp_botoes;
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
