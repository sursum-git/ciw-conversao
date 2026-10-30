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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Custo do Item - Container"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Custo do Item - Container"); } ?></TITLE>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_item_custos_container/form_item_custos_container_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_item_custos_container_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_item_custos_container_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['link_info']['remove_border']) {
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
 include_once("form_item_custos_container_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['insert_validation']; ?>">
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
<input type="hidden" name="caminho_arquivo_salva" value="<?php  echo $this->form_encode_input($this->caminho_arquivo) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_item_custos_container'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_item_custos_container'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
{
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
        $sCondStyle = ($this->nmgp_botoes['bt_voltar'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['bt_voltar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['bt_voltar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['bt_voltar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['bt_voltar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['bt_voltar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_voltar", "scBtnFn_bt_voltar()", "scBtnFn_bt_voltar()", "sc_bt_voltar_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['cod_situacao']))
   {
       $this->nmgp_cmp_hidden['cod_situacao'] = 'off';
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
<input type="hidden" name="caminho_arquivo_ul_name" id="id_sc_field_caminho_arquivo_ul_name" value="<?php echo $this->form_encode_input($this->caminho_arquivo_ul_name);?>">
<input type="hidden" name="caminho_arquivo_ul_type" id="id_sc_field_caminho_arquivo_ul_type" value="<?php echo $this->form_encode_input($this->caminho_arquivo_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['item_custo_id']))
           {
               $this->nmgp_cmp_readonly['item_custo_id'] = 'on';
           }
?>
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
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)">Principal</a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Dados Container</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
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
    if (!isset($this->nm_new_label['caminho_arquivo']))
    {
        $this->nm_new_label['caminho_arquivo'] = "Arquivo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $caminho_arquivo = $this->caminho_arquivo;
   $sStyleHidden_caminho_arquivo = '';
   if (isset($this->nmgp_cmp_hidden['caminho_arquivo']) && $this->nmgp_cmp_hidden['caminho_arquivo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['caminho_arquivo']);
       $sStyleHidden_caminho_arquivo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_caminho_arquivo = 'display: none;';
   $sStyleReadInp_caminho_arquivo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['caminho_arquivo']) && $this->nmgp_cmp_readonly['caminho_arquivo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['caminho_arquivo']);
       $sStyleReadLab_caminho_arquivo = '';
       $sStyleReadInp_caminho_arquivo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['caminho_arquivo']) && $this->nmgp_cmp_hidden['caminho_arquivo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="caminho_arquivo" value="<?php echo $this->form_encode_input($caminho_arquivo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_caminho_arquivo_label" id="hidden_field_label_caminho_arquivo" style="<?php echo $sStyleHidden_caminho_arquivo; ?>"><span id="id_label_caminho_arquivo"><?php echo $this->nm_new_label['caminho_arquivo']; ?></span></TD>
    <TD class="scFormDataOdd css_caminho_arquivo_line" id="hidden_field_data_caminho_arquivo" style="<?php echo $sStyleHidden_caminho_arquivo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_caminho_arquivo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["caminho_arquivo"]) &&  $this->nmgp_cmp_readonly["caminho_arquivo"] == "on") { 

 ?>
<input type="hidden" name="caminho_arquivo" value="<?php echo $this->form_encode_input($caminho_arquivo) . "\"><img id=\"caminho_arquivo_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_caminho_arquivo\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_caminho_arquivo, 3)) . "', 'form_item_custos_container')\">" . $caminho_arquivo . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_caminho_arquivo" class="scFormLinkOdd sc-ui-readonly-caminho_arquivo css_caminho_arquivo_line" style="<?php echo $sStyleReadLab_caminho_arquivo; ?>"><?php echo $this->form_format_readonly("caminho_arquivo", $this->caminho_arquivo) ?></span><span id="id_read_off_caminho_arquivo" class="css_read_off_caminho_arquivo" style="white-space: nowrap;<?php echo $sStyleReadInp_caminho_arquivo; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-caminho_arquivo" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_caminho_arquivo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="caminho_arquivo[]" id="id_sc_field_caminho_arquivo" ></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_caminho_arquivo"<?php if ($this->nmgp_opcao == "novo" || empty($caminho_arquivo)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="caminho_arquivo_limpa" value="<?php echo $caminho_arquivo_limpa . '" '; if ($caminho_arquivo_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="caminho_arquivo_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_caminho_arquivo"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_caminho_arquivo, 3)); ?>', 'form_item_custos_container')"><?php echo $caminho_arquivo ?></a></span><div id="id_img_loader_caminho_arquivo" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_caminho_arquivo" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('caminho_arquivo')", "nm_mostra_mens('caminho_arquivo')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span><div id="id_sc_dragdrop_caminho_arquivo" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_caminho_arquivo ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_caminho_arquivo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_caminho_arquivo_text"></span></td></tr></table></td></tr></table></TD>
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
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['Lookup_cod_tipo_custo'][] = '1'; ?>
 <option  value="2" <?php  if ($this->cod_tipo_custo == "2") { echo " selected" ;} ?>>Container</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['Lookup_cod_tipo_custo'][] = '2'; ?>
 <option  value="3" <?php  if ($this->cod_tipo_custo == "3") { echo " selected" ;} ?>>Média Entre Itens</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['Lookup_cod_tipo_custo'][] = '3'; ?>
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
    if (!isset($this->nm_new_label['desc_item']))
    {
        $this->nm_new_label['desc_item'] = "Descrição";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $desc_item = $this->desc_item;
   $sStyleHidden_desc_item = '';
   if (isset($this->nmgp_cmp_hidden['desc_item']) && $this->nmgp_cmp_hidden['desc_item'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['desc_item']);
       $sStyleHidden_desc_item = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_desc_item = 'display: none;';
   $sStyleReadInp_desc_item = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['desc_item']) && $this->nmgp_cmp_readonly['desc_item'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['desc_item']);
       $sStyleReadLab_desc_item = '';
       $sStyleReadInp_desc_item = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['desc_item']) && $this->nmgp_cmp_hidden['desc_item'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="desc_item" value="<?php echo $this->form_encode_input($desc_item) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_desc_item_label" id="hidden_field_label_desc_item" style="<?php echo $sStyleHidden_desc_item; ?>"><span id="id_label_desc_item"><?php echo $this->nm_new_label['desc_item']; ?></span></TD>
    <TD class="scFormDataOdd css_desc_item_line" id="hidden_field_data_desc_item" style="<?php echo $sStyleHidden_desc_item; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_desc_item_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["desc_item"]) &&  $this->nmgp_cmp_readonly["desc_item"] == "on") { 

 ?>
<input type="hidden" name="desc_item" value="<?php echo $this->form_encode_input($desc_item) . "\">" . $desc_item . ""; ?>
<?php } else { ?>
<span id="id_read_on_desc_item" class="sc-ui-readonly-desc_item css_desc_item_line" style="<?php echo $sStyleReadLab_desc_item; ?>"><?php echo $this->form_format_readonly("desc_item", $this->form_encode_input($this->desc_item)); ?></span><span id="id_read_off_desc_item" class="css_read_off_desc_item<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_desc_item; ?>">
 <input class="sc-js-input scFormObjectOdd css_desc_item_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_desc_item" type=text name="desc_item" value="<?php echo $this->form_encode_input($desc_item) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_desc_item_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_desc_item_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_unit_anterior']))
    {
        $this->nm_new_label['vl_unit_anterior'] = "Vl Unit Anterior";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_unit_anterior = $this->vl_unit_anterior;
   $sStyleHidden_vl_unit_anterior = '';
   if (isset($this->nmgp_cmp_hidden['vl_unit_anterior']) && $this->nmgp_cmp_hidden['vl_unit_anterior'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_unit_anterior']);
       $sStyleHidden_vl_unit_anterior = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_unit_anterior = 'display: none;';
   $sStyleReadInp_vl_unit_anterior = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_unit_anterior']) && $this->nmgp_cmp_readonly['vl_unit_anterior'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_unit_anterior']);
       $sStyleReadLab_vl_unit_anterior = '';
       $sStyleReadInp_vl_unit_anterior = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_unit_anterior']) && $this->nmgp_cmp_hidden['vl_unit_anterior'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_unit_anterior" value="<?php echo $this->form_encode_input($vl_unit_anterior) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_unit_anterior_label" id="hidden_field_label_vl_unit_anterior" style="<?php echo $sStyleHidden_vl_unit_anterior; ?>"><span id="id_label_vl_unit_anterior"><?php echo $this->nm_new_label['vl_unit_anterior']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_unit_anterior_line" id="hidden_field_data_vl_unit_anterior" style="<?php echo $sStyleHidden_vl_unit_anterior; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_unit_anterior_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_unit_anterior"]) &&  $this->nmgp_cmp_readonly["vl_unit_anterior"] == "on") { 

 ?>
<input type="hidden" name="vl_unit_anterior" value="<?php echo $this->form_encode_input($vl_unit_anterior) . "\">" . $vl_unit_anterior . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_unit_anterior" class="sc-ui-readonly-vl_unit_anterior css_vl_unit_anterior_line" style="<?php echo $sStyleReadLab_vl_unit_anterior; ?>"><?php echo $this->form_format_readonly("vl_unit_anterior", $this->form_encode_input($this->vl_unit_anterior)); ?></span><span id="id_read_off_vl_unit_anterior" class="css_read_off_vl_unit_anterior<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_unit_anterior; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_unit_anterior_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_unit_anterior" type=text name="vl_unit_anterior" value="<?php echo $this->form_encode_input($vl_unit_anterior) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_anterior']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_anterior']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_anterior']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_anterior']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_unit_anterior_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_unit_anterior_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_estoque_selecionado']))
    {
        $this->nm_new_label['qt_estoque_selecionado'] = "Qt Estoque Selecionado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_estoque_selecionado = $this->qt_estoque_selecionado;
   $sStyleHidden_qt_estoque_selecionado = '';
   if (isset($this->nmgp_cmp_hidden['qt_estoque_selecionado']) && $this->nmgp_cmp_hidden['qt_estoque_selecionado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_estoque_selecionado']);
       $sStyleHidden_qt_estoque_selecionado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_estoque_selecionado = 'display: none;';
   $sStyleReadInp_qt_estoque_selecionado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_estoque_selecionado']) && $this->nmgp_cmp_readonly['qt_estoque_selecionado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_estoque_selecionado']);
       $sStyleReadLab_qt_estoque_selecionado = '';
       $sStyleReadInp_qt_estoque_selecionado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_estoque_selecionado']) && $this->nmgp_cmp_hidden['qt_estoque_selecionado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_estoque_selecionado" value="<?php echo $this->form_encode_input($qt_estoque_selecionado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_estoque_selecionado_label" id="hidden_field_label_qt_estoque_selecionado" style="<?php echo $sStyleHidden_qt_estoque_selecionado; ?>"><span id="id_label_qt_estoque_selecionado"><?php echo $this->nm_new_label['qt_estoque_selecionado']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_estoque_selecionado_line" id="hidden_field_data_qt_estoque_selecionado" style="<?php echo $sStyleHidden_qt_estoque_selecionado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_estoque_selecionado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_estoque_selecionado"]) &&  $this->nmgp_cmp_readonly["qt_estoque_selecionado"] == "on") { 

 ?>
<input type="hidden" name="qt_estoque_selecionado" value="<?php echo $this->form_encode_input($qt_estoque_selecionado) . "\">" . $qt_estoque_selecionado . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_estoque_selecionado" class="sc-ui-readonly-qt_estoque_selecionado css_qt_estoque_selecionado_line" style="<?php echo $sStyleReadLab_qt_estoque_selecionado; ?>"><?php echo $this->form_format_readonly("qt_estoque_selecionado", $this->form_encode_input($this->qt_estoque_selecionado)); ?></span><span id="id_read_off_qt_estoque_selecionado" class="css_read_off_qt_estoque_selecionado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_estoque_selecionado; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_estoque_selecionado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_estoque_selecionado" type=text name="qt_estoque_selecionado" value="<?php echo $this->form_encode_input($qt_estoque_selecionado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque_selecionado']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_estoque_selecionado']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_estoque_selecionado']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_estoque_selecionado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_estoque_selecionado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_estoque_selecionado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_qt_sel']))
    {
        $this->nm_new_label['vl_qt_sel'] = "Vl. Estoque Selecionado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_qt_sel = $this->vl_qt_sel;
   $sStyleHidden_vl_qt_sel = '';
   if (isset($this->nmgp_cmp_hidden['vl_qt_sel']) && $this->nmgp_cmp_hidden['vl_qt_sel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_qt_sel']);
       $sStyleHidden_vl_qt_sel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_qt_sel = 'display: none;';
   $sStyleReadInp_vl_qt_sel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_qt_sel']) && $this->nmgp_cmp_readonly['vl_qt_sel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_qt_sel']);
       $sStyleReadLab_vl_qt_sel = '';
       $sStyleReadInp_vl_qt_sel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_qt_sel']) && $this->nmgp_cmp_hidden['vl_qt_sel'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_qt_sel" value="<?php echo $this->form_encode_input($vl_qt_sel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_qt_sel_label" id="hidden_field_label_vl_qt_sel" style="<?php echo $sStyleHidden_vl_qt_sel; ?>"><span id="id_label_vl_qt_sel"><?php echo $this->nm_new_label['vl_qt_sel']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_qt_sel_line" id="hidden_field_data_vl_qt_sel" style="<?php echo $sStyleHidden_vl_qt_sel; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_qt_sel_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_qt_sel"]) &&  $this->nmgp_cmp_readonly["vl_qt_sel"] == "on") { 

 ?>
<input type="hidden" name="vl_qt_sel" value="<?php echo $this->form_encode_input($vl_qt_sel) . "\">" . $vl_qt_sel . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_qt_sel" class="sc-ui-readonly-vl_qt_sel css_vl_qt_sel_line" style="<?php echo $sStyleReadLab_vl_qt_sel; ?>"><?php echo $this->form_format_readonly("vl_qt_sel", $this->form_encode_input($this->vl_qt_sel)); ?></span><span id="id_read_off_vl_qt_sel" class="css_read_off_vl_qt_sel<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_qt_sel; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_qt_sel_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_qt_sel" type=text name="vl_qt_sel" value="<?php echo $this->form_encode_input($vl_qt_sel) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_qt_sel']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_qt_sel']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_qt_sel']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_qt_sel']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_qt_sel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_qt_sel_text"></span></td></tr></table></td></tr></table></TD>
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
        $this->nm_new_label['vl_unit_novo'] = "Vl.Unit";
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_novo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_unit_novo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_unit_novo']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_unit_novo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_unit_novo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_unit_novo_text"></span></td></tr></table></td></tr></table></TD>
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
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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
    if (!isset($this->nm_new_label['qt_nf_mae']))
    {
        $this->nm_new_label['qt_nf_mae'] = "Qt Nf Mae";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_nf_mae = $this->qt_nf_mae;
   $sStyleHidden_qt_nf_mae = '';
   if (isset($this->nmgp_cmp_hidden['qt_nf_mae']) && $this->nmgp_cmp_hidden['qt_nf_mae'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_nf_mae']);
       $sStyleHidden_qt_nf_mae = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_nf_mae = 'display: none;';
   $sStyleReadInp_qt_nf_mae = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_nf_mae']) && $this->nmgp_cmp_readonly['qt_nf_mae'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_nf_mae']);
       $sStyleReadLab_qt_nf_mae = '';
       $sStyleReadInp_qt_nf_mae = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_nf_mae']) && $this->nmgp_cmp_hidden['qt_nf_mae'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_nf_mae" value="<?php echo $this->form_encode_input($qt_nf_mae) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_nf_mae_label" id="hidden_field_label_qt_nf_mae" style="<?php echo $sStyleHidden_qt_nf_mae; ?>"><span id="id_label_qt_nf_mae"><?php echo $this->nm_new_label['qt_nf_mae']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_nf_mae_line" id="hidden_field_data_qt_nf_mae" style="<?php echo $sStyleHidden_qt_nf_mae; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_nf_mae_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_nf_mae"]) &&  $this->nmgp_cmp_readonly["qt_nf_mae"] == "on") { 

 ?>
<input type="hidden" name="qt_nf_mae" value="<?php echo $this->form_encode_input($qt_nf_mae) . "\">" . $qt_nf_mae . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_nf_mae" class="sc-ui-readonly-qt_nf_mae css_qt_nf_mae_line" style="<?php echo $sStyleReadLab_qt_nf_mae; ?>"><?php echo $this->form_format_readonly("qt_nf_mae", $this->form_encode_input($this->qt_nf_mae)); ?></span><span id="id_read_off_qt_nf_mae" class="css_read_off_qt_nf_mae<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_nf_mae; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_nf_mae_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_nf_mae" type=text name="qt_nf_mae" value="<?php echo $this->form_encode_input($qt_nf_mae) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_nf_mae']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_nf_mae']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_nf_mae']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_nf_mae']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_nf_mae_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_nf_mae_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_etiq_container']))
    {
        $this->nm_new_label['qt_etiq_container'] = "Qt Etiq Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_etiq_container = $this->qt_etiq_container;
   $sStyleHidden_qt_etiq_container = '';
   if (isset($this->nmgp_cmp_hidden['qt_etiq_container']) && $this->nmgp_cmp_hidden['qt_etiq_container'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_etiq_container']);
       $sStyleHidden_qt_etiq_container = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_etiq_container = 'display: none;';
   $sStyleReadInp_qt_etiq_container = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_etiq_container']) && $this->nmgp_cmp_readonly['qt_etiq_container'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_etiq_container']);
       $sStyleReadLab_qt_etiq_container = '';
       $sStyleReadInp_qt_etiq_container = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_etiq_container']) && $this->nmgp_cmp_hidden['qt_etiq_container'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_etiq_container" value="<?php echo $this->form_encode_input($qt_etiq_container) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_etiq_container_label" id="hidden_field_label_qt_etiq_container" style="<?php echo $sStyleHidden_qt_etiq_container; ?>"><span id="id_label_qt_etiq_container"><?php echo $this->nm_new_label['qt_etiq_container']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_etiq_container_line" id="hidden_field_data_qt_etiq_container" style="<?php echo $sStyleHidden_qt_etiq_container; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_etiq_container_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_etiq_container"]) &&  $this->nmgp_cmp_readonly["qt_etiq_container"] == "on") { 

 ?>
<input type="hidden" name="qt_etiq_container" value="<?php echo $this->form_encode_input($qt_etiq_container) . "\">" . $qt_etiq_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_etiq_container" class="sc-ui-readonly-qt_etiq_container css_qt_etiq_container_line" style="<?php echo $sStyleReadLab_qt_etiq_container; ?>"><?php echo $this->form_format_readonly("qt_etiq_container", $this->form_encode_input($this->qt_etiq_container)); ?></span><span id="id_read_off_qt_etiq_container" class="css_read_off_qt_etiq_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_etiq_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_etiq_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_etiq_container" type=text name="qt_etiq_container" value="<?php echo $this->form_encode_input($qt_etiq_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_container']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_container']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_etiq_container']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_etiq_container']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_etiq_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_etiq_container_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_etiq_branco']))
    {
        $this->nm_new_label['qt_etiq_branco'] = "Qt Etiq Branco";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_etiq_branco = $this->qt_etiq_branco;
   $sStyleHidden_qt_etiq_branco = '';
   if (isset($this->nmgp_cmp_hidden['qt_etiq_branco']) && $this->nmgp_cmp_hidden['qt_etiq_branco'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_etiq_branco']);
       $sStyleHidden_qt_etiq_branco = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_etiq_branco = 'display: none;';
   $sStyleReadInp_qt_etiq_branco = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_etiq_branco']) && $this->nmgp_cmp_readonly['qt_etiq_branco'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_etiq_branco']);
       $sStyleReadLab_qt_etiq_branco = '';
       $sStyleReadInp_qt_etiq_branco = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_etiq_branco']) && $this->nmgp_cmp_hidden['qt_etiq_branco'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_etiq_branco" value="<?php echo $this->form_encode_input($qt_etiq_branco) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_etiq_branco_label" id="hidden_field_label_qt_etiq_branco" style="<?php echo $sStyleHidden_qt_etiq_branco; ?>"><span id="id_label_qt_etiq_branco"><?php echo $this->nm_new_label['qt_etiq_branco']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_etiq_branco_line" id="hidden_field_data_qt_etiq_branco" style="<?php echo $sStyleHidden_qt_etiq_branco; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_etiq_branco_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_etiq_branco"]) &&  $this->nmgp_cmp_readonly["qt_etiq_branco"] == "on") { 

 ?>
<input type="hidden" name="qt_etiq_branco" value="<?php echo $this->form_encode_input($qt_etiq_branco) . "\">" . $qt_etiq_branco . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_etiq_branco" class="sc-ui-readonly-qt_etiq_branco css_qt_etiq_branco_line" style="<?php echo $sStyleReadLab_qt_etiq_branco; ?>"><?php echo $this->form_format_readonly("qt_etiq_branco", $this->form_encode_input($this->qt_etiq_branco)); ?></span><span id="id_read_off_qt_etiq_branco" class="css_read_off_qt_etiq_branco<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_etiq_branco; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_etiq_branco_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_etiq_branco" type=text name="qt_etiq_branco" value="<?php echo $this->form_encode_input($qt_etiq_branco) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_branco']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_branco']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_etiq_branco']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_etiq_branco']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_etiq_branco_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_etiq_branco_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_etiq_outros_container']))
    {
        $this->nm_new_label['qt_etiq_outros_container'] = "Qt Etiq Outros Container";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_etiq_outros_container = $this->qt_etiq_outros_container;
   $sStyleHidden_qt_etiq_outros_container = '';
   if (isset($this->nmgp_cmp_hidden['qt_etiq_outros_container']) && $this->nmgp_cmp_hidden['qt_etiq_outros_container'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_etiq_outros_container']);
       $sStyleHidden_qt_etiq_outros_container = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_etiq_outros_container = 'display: none;';
   $sStyleReadInp_qt_etiq_outros_container = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_etiq_outros_container']) && $this->nmgp_cmp_readonly['qt_etiq_outros_container'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_etiq_outros_container']);
       $sStyleReadLab_qt_etiq_outros_container = '';
       $sStyleReadInp_qt_etiq_outros_container = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_etiq_outros_container']) && $this->nmgp_cmp_hidden['qt_etiq_outros_container'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_etiq_outros_container" value="<?php echo $this->form_encode_input($qt_etiq_outros_container) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qt_etiq_outros_container_label" id="hidden_field_label_qt_etiq_outros_container" style="<?php echo $sStyleHidden_qt_etiq_outros_container; ?>"><span id="id_label_qt_etiq_outros_container"><?php echo $this->nm_new_label['qt_etiq_outros_container']; ?></span></TD>
    <TD class="scFormDataOdd css_qt_etiq_outros_container_line" id="hidden_field_data_qt_etiq_outros_container" style="<?php echo $sStyleHidden_qt_etiq_outros_container; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_etiq_outros_container_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_etiq_outros_container"]) &&  $this->nmgp_cmp_readonly["qt_etiq_outros_container"] == "on") { 

 ?>
<input type="hidden" name="qt_etiq_outros_container" value="<?php echo $this->form_encode_input($qt_etiq_outros_container) . "\">" . $qt_etiq_outros_container . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_etiq_outros_container" class="sc-ui-readonly-qt_etiq_outros_container css_qt_etiq_outros_container_line" style="<?php echo $sStyleReadLab_qt_etiq_outros_container; ?>"><?php echo $this->form_format_readonly("qt_etiq_outros_container", $this->form_encode_input($this->qt_etiq_outros_container)); ?></span><span id="id_read_off_qt_etiq_outros_container" class="css_read_off_qt_etiq_outros_container<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_etiq_outros_container; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_etiq_outros_container_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_etiq_outros_container" type=text name="qt_etiq_outros_container" value="<?php echo $this->form_encode_input($qt_etiq_outros_container) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_outros_container']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_etiq_outros_container']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_etiq_outros_container']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_etiq_outros_container']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_etiq_outros_container_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_etiq_outros_container_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 


</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b"></span> 
<?php 
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
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai_modal()", "scBtnFn_sys_format_sai_modal()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_item_custos_container");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_item_custos_container");
 parent.scAjaxDetailHeight("form_item_custos_container", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_item_custos_container", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_item_custos_container", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['sc_modal'])
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
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-1").length && $("#sc_b_upd_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_bt_voltar() {
                if ($("#sc_bt_voltar_top").length && $("#sc_bt_voltar_top").is(":visible")) {
                    if ($("#sc_bt_voltar_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_voltar()
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
                if ($("#sc_b_ini_b.sc-unique-btn-2").length && $("#sc_b_ini_b.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-3").length && $("#sc_b_ret_b.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-4").length && $("#sc_b_avc_b.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-5").length && $("#sc_b_fim_b.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
                         return;
                }
        }
        function scBtnFn_sys_format_sai_modal() {
                if ($("#sc_b_sai_b.sc-unique-btn-6").length && $("#sc_b_sai_b.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_sai_b.sc-unique-btn-6").hasClass("disabled")) {
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
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_item_custos_container']['buttonStatus'] = $this->nmgp_botoes;
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
