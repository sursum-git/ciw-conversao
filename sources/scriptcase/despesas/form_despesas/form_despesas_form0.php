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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Despesas"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Despesas"); } ?></TITLE>
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
$miniCalculatorFA = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorFA) {
?>
<style type="text/css">
.css_read_off_perc_calculo button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_despesas/form_despesas_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_despesas_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['last'] : 'off'); ?>";
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
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_t")) document.getElementById("sc_b_navpage_t").innerHTML = str_navpage;
}
<?php

include_once('form_despesas_jquery.php');

?>

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
$str_iframe_body = 'margin-left: 0px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px;';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['link_info']['remove_border']) {
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
 include_once("form_despesas_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_despesas'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_despesas'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['fast_search'][2] : "";
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('t')", "scBtnFn_sys_GridPermiteSeq('t')", "brec_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_t" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_t"></span> 
<?php 
}
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_log'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_log", "scBtnFn_bt_log()", "scBtnFn_bt_log()", "sc_bt_log_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes == "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_log'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['btn_label']['bt_log'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['despesa_id']))
   {
       $this->nmgp_cmp_hidden['despesa_id'] = 'off';
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
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['despesa_id']))
           {
               $this->nmgp_cmp_readonly['despesa_id'] = 'on';
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
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Despesas Base Calculo</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['despesa_id']))
    {
        $this->nm_new_label['despesa_id'] = "" . $this->Ini->Nm_lang['lang_despesas_fld_despesa_id'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $despesa_id = $this->despesa_id;
   if (!isset($this->nmgp_cmp_hidden['despesa_id']))
   {
       $this->nmgp_cmp_hidden['despesa_id'] = 'off';
   }
   $sStyleHidden_despesa_id = '';
   if (isset($this->nmgp_cmp_hidden['despesa_id']) && $this->nmgp_cmp_hidden['despesa_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['despesa_id']);
       $sStyleHidden_despesa_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_despesa_id = 'display: none;';
   $sStyleReadInp_despesa_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["despesa_id"]) &&  $this->nmgp_cmp_readonly["despesa_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['despesa_id']);
       $sStyleReadLab_despesa_id = '';
       $sStyleReadInp_despesa_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['despesa_id']) && $this->nmgp_cmp_hidden['despesa_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="despesa_id" value="<?php echo $this->form_encode_input($despesa_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd css_despesa_id_line" id="hidden_field_data_despesa_id" style="<?php echo $sStyleHidden_despesa_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_despesa_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_despesa_id_label" style=""><span id="id_label_despesa_id"><?php echo $this->nm_new_label['despesa_id']; ?></span></span><br><span id="id_read_on_despesa_id" class="css_despesa_id_line" style="<?php echo $sStyleReadLab_despesa_id; ?>"><?php echo $this->form_format_readonly("despesa_id", $this->form_encode_input($this->despesa_id)); ?></span><span id="id_read_off_despesa_id" class="css_read_off_despesa_id" style="<?php echo $sStyleReadInp_despesa_id; ?>"><input type="hidden" name="despesa_id" value="<?php echo $this->form_encode_input($despesa_id) . "\">"?><span id="id_ajax_label_despesa_id"><?php echo nl2br($despesa_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_despesa_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_despesa_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['descricao']))
    {
        $this->nm_new_label['descricao'] = "" . $this->Ini->Nm_lang['lang_despesas_fld_descricao'] . "";
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

    <TD class="scFormDataOdd css_descricao_line" id="hidden_field_data_descricao" style="<?php echo $sStyleHidden_descricao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_descricao_label" style=""><span id="id_label_descricao"><?php echo $this->nm_new_label['descricao']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao"]) &&  $this->nmgp_cmp_readonly["descricao"] == "on") { 

 ?>
<input type="hidden" name="descricao" value="<?php echo $this->form_encode_input($descricao) . "\">" . $descricao . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao" class="sc-ui-readonly-descricao css_descricao_line" style="<?php echo $sStyleReadLab_descricao; ?>"><?php echo $this->form_format_readonly("descricao", $this->form_encode_input($this->descricao)); ?></span><span id="id_read_off_descricao" class="css_read_off_descricao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao; ?>">
 <input class="sc-js-input scFormObjectOdd css_descricao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao" type=text name="descricao" value="<?php echo $this->form_encode_input($descricao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_imposto']))
   {
       $this->nm_new_label['log_imposto'] = "" . $this->Ini->Nm_lang['lang_despesas_fld_log_imposto'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_imposto = $this->log_imposto;
   $sStyleHidden_log_imposto = '';
   if (isset($this->nmgp_cmp_hidden['log_imposto']) && $this->nmgp_cmp_hidden['log_imposto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_imposto']);
       $sStyleHidden_log_imposto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_imposto = 'display: none;';
   $sStyleReadInp_log_imposto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_imposto']) && $this->nmgp_cmp_readonly['log_imposto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_imposto']);
       $sStyleReadLab_log_imposto = '';
       $sStyleReadInp_log_imposto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_imposto']) && $this->nmgp_cmp_hidden['log_imposto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_imposto" value="<?php echo $this->form_encode_input($this->log_imposto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_imposto_line" id="hidden_field_data_log_imposto" style="<?php echo $sStyleHidden_log_imposto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_imposto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_imposto_label" style=""><span id="id_label_log_imposto"><?php echo $this->nm_new_label['log_imposto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_imposto"]) &&  $this->nmgp_cmp_readonly["log_imposto"] == "on") { 

$log_imposto_look = "";
 if ($this->log_imposto == "1") { $log_imposto_look .= "Sim" ;} 
 if ($this->log_imposto == "0") { $log_imposto_look .= "Não" ;} 
 if (empty($log_imposto_look)) { $log_imposto_look = $this->log_imposto; }
?>
<input type="hidden" name="log_imposto" value="<?php echo $this->form_encode_input($log_imposto) . "\">" . $log_imposto_look . ""; ?>
<?php } else { ?>
<?php

$log_imposto_look = "";
 if ($this->log_imposto == "1") { $log_imposto_look .= "Sim" ;} 
 if ($this->log_imposto == "0") { $log_imposto_look .= "Não" ;} 
 if (empty($log_imposto_look)) { $log_imposto_look = $this->log_imposto; }
?>
<span id="id_read_on_log_imposto" class="css_log_imposto_line"  style="<?php echo $sStyleReadLab_log_imposto; ?>"><?php echo $this->form_format_readonly("log_imposto", $this->form_encode_input($log_imposto_look)); ?></span><span id="id_read_off_log_imposto" class="css_read_off_log_imposto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_imposto; ?>">
 <span id="idAjaxSelect_log_imposto" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_imposto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_imposto" name="log_imposto" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_imposto == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_imposto'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_imposto == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_imposto'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_imposto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_imposto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ordem']))
    {
        $this->nm_new_label['ordem'] = "Ordem";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ordem = $this->ordem;
   $sStyleHidden_ordem = '';
   if (isset($this->nmgp_cmp_hidden['ordem']) && $this->nmgp_cmp_hidden['ordem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ordem']);
       $sStyleHidden_ordem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ordem = 'display: none;';
   $sStyleReadInp_ordem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ordem']) && $this->nmgp_cmp_readonly['ordem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ordem']);
       $sStyleReadLab_ordem = '';
       $sStyleReadInp_ordem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ordem']) && $this->nmgp_cmp_hidden['ordem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ordem" value="<?php echo $this->form_encode_input($ordem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ordem_line" id="hidden_field_data_ordem" style="<?php echo $sStyleHidden_ordem; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ordem_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ordem_label" style=""><span id="id_label_ordem"><?php echo $this->nm_new_label['ordem']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ordem"]) &&  $this->nmgp_cmp_readonly["ordem"] == "on") { 

 ?>
<input type="hidden" name="ordem" value="<?php echo $this->form_encode_input($ordem) . "\">" . $ordem . ""; ?>
<?php } else { ?>
<span id="id_read_on_ordem" class="sc-ui-readonly-ordem css_ordem_line" style="<?php echo $sStyleReadLab_ordem; ?>"><?php echo $this->form_format_readonly("ordem", $this->form_encode_input($this->ordem)); ?></span><span id="id_read_off_ordem" class="css_read_off_ordem<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_ordem; ?>">
 <input class="sc-js-input scFormObjectOdd css_ordem_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ordem" type=text name="ordem" value="<?php echo $this->form_encode_input($ordem) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ordem']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ordem']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['ordem']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('ordem')", "nm_mostra_mens('ordem')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ordem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ordem_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_calculada']))
   {
       $this->nm_new_label['log_calculada'] = "Calculada?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_calculada = $this->log_calculada;
   $sStyleHidden_log_calculada = '';
   if (isset($this->nmgp_cmp_hidden['log_calculada']) && $this->nmgp_cmp_hidden['log_calculada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_calculada']);
       $sStyleHidden_log_calculada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_calculada = 'display: none;';
   $sStyleReadInp_log_calculada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_calculada']) && $this->nmgp_cmp_readonly['log_calculada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_calculada']);
       $sStyleReadLab_log_calculada = '';
       $sStyleReadInp_log_calculada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_calculada']) && $this->nmgp_cmp_hidden['log_calculada'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_calculada" value="<?php echo $this->form_encode_input($this->log_calculada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_calculada_line" id="hidden_field_data_log_calculada" style="<?php echo $sStyleHidden_log_calculada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_calculada_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_calculada_label" style=""><span id="id_label_log_calculada"><?php echo $this->nm_new_label['log_calculada']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_calculada"]) &&  $this->nmgp_cmp_readonly["log_calculada"] == "on") { 

$log_calculada_look = "";
 if ($this->log_calculada == "1") { $log_calculada_look .= "Sim" ;} 
 if ($this->log_calculada == "0") { $log_calculada_look .= "Não" ;} 
 if (empty($log_calculada_look)) { $log_calculada_look = $this->log_calculada; }
?>
<input type="hidden" name="log_calculada" value="<?php echo $this->form_encode_input($log_calculada) . "\">" . $log_calculada_look . ""; ?>
<?php } else { ?>
<?php

$log_calculada_look = "";
 if ($this->log_calculada == "1") { $log_calculada_look .= "Sim" ;} 
 if ($this->log_calculada == "0") { $log_calculada_look .= "Não" ;} 
 if (empty($log_calculada_look)) { $log_calculada_look = $this->log_calculada; }
?>
<span id="id_read_on_log_calculada" class="css_log_calculada_line"  style="<?php echo $sStyleReadLab_log_calculada; ?>"><?php echo $this->form_format_readonly("log_calculada", $this->form_encode_input($log_calculada_look)); ?></span><span id="id_read_off_log_calculada" class="css_read_off_log_calculada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_calculada; ?>">
 <span id="idAjaxSelect_log_calculada" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_calculada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_calculada" name="log_calculada" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_calculada == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_calculada'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_calculada == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_calculada'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_calculada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_calculada_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_vl_prod_base_calculo']))
   {
       $this->nm_new_label['log_vl_prod_base_calculo'] = "Vl.Produto Faz Parte da Base de Cálculo ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_vl_prod_base_calculo = $this->log_vl_prod_base_calculo;
   $sStyleHidden_log_vl_prod_base_calculo = '';
   if (isset($this->nmgp_cmp_hidden['log_vl_prod_base_calculo']) && $this->nmgp_cmp_hidden['log_vl_prod_base_calculo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_vl_prod_base_calculo']);
       $sStyleHidden_log_vl_prod_base_calculo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_vl_prod_base_calculo = 'display: none;';
   $sStyleReadInp_log_vl_prod_base_calculo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_vl_prod_base_calculo']) && $this->nmgp_cmp_readonly['log_vl_prod_base_calculo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_vl_prod_base_calculo']);
       $sStyleReadLab_log_vl_prod_base_calculo = '';
       $sStyleReadInp_log_vl_prod_base_calculo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_vl_prod_base_calculo']) && $this->nmgp_cmp_hidden['log_vl_prod_base_calculo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_vl_prod_base_calculo" value="<?php echo $this->form_encode_input($this->log_vl_prod_base_calculo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_vl_prod_base_calculo_line" id="hidden_field_data_log_vl_prod_base_calculo" style="<?php echo $sStyleHidden_log_vl_prod_base_calculo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_vl_prod_base_calculo_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_vl_prod_base_calculo_label" style=""><span id="id_label_log_vl_prod_base_calculo"><?php echo $this->nm_new_label['log_vl_prod_base_calculo']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_vl_prod_base_calculo"]) &&  $this->nmgp_cmp_readonly["log_vl_prod_base_calculo"] == "on") { 

$log_vl_prod_base_calculo_look = "";
 if ($this->log_vl_prod_base_calculo == "1") { $log_vl_prod_base_calculo_look .= "Sim" ;} 
 if ($this->log_vl_prod_base_calculo == "0") { $log_vl_prod_base_calculo_look .= "Não" ;} 
 if (empty($log_vl_prod_base_calculo_look)) { $log_vl_prod_base_calculo_look = $this->log_vl_prod_base_calculo; }
?>
<input type="hidden" name="log_vl_prod_base_calculo" value="<?php echo $this->form_encode_input($log_vl_prod_base_calculo) . "\">" . $log_vl_prod_base_calculo_look . ""; ?>
<?php } else { ?>
<?php

$log_vl_prod_base_calculo_look = "";
 if ($this->log_vl_prod_base_calculo == "1") { $log_vl_prod_base_calculo_look .= "Sim" ;} 
 if ($this->log_vl_prod_base_calculo == "0") { $log_vl_prod_base_calculo_look .= "Não" ;} 
 if (empty($log_vl_prod_base_calculo_look)) { $log_vl_prod_base_calculo_look = $this->log_vl_prod_base_calculo; }
?>
<span id="id_read_on_log_vl_prod_base_calculo" class="css_log_vl_prod_base_calculo_line"  style="<?php echo $sStyleReadLab_log_vl_prod_base_calculo; ?>"><?php echo $this->form_format_readonly("log_vl_prod_base_calculo", $this->form_encode_input($log_vl_prod_base_calculo_look)); ?></span><span id="id_read_off_log_vl_prod_base_calculo" class="css_read_off_log_vl_prod_base_calculo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_vl_prod_base_calculo; ?>">
 <span id="idAjaxSelect_log_vl_prod_base_calculo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_vl_prod_base_calculo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_vl_prod_base_calculo" name="log_vl_prod_base_calculo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_vl_prod_base_calculo == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_vl_prod_base_calculo'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_vl_prod_base_calculo == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_vl_prod_base_calculo'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_vl_prod_base_calculo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_vl_prod_base_calculo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['perc_calculo']))
    {
        $this->nm_new_label['perc_calculo'] = "% Cálculo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $perc_calculo = $this->perc_calculo;
   $sStyleHidden_perc_calculo = '';
   if (isset($this->nmgp_cmp_hidden['perc_calculo']) && $this->nmgp_cmp_hidden['perc_calculo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['perc_calculo']);
       $sStyleHidden_perc_calculo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_perc_calculo = 'display: none;';
   $sStyleReadInp_perc_calculo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['perc_calculo']) && $this->nmgp_cmp_readonly['perc_calculo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['perc_calculo']);
       $sStyleReadLab_perc_calculo = '';
       $sStyleReadInp_perc_calculo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['perc_calculo']) && $this->nmgp_cmp_hidden['perc_calculo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="perc_calculo" value="<?php echo $this->form_encode_input($perc_calculo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_perc_calculo_line" id="hidden_field_data_perc_calculo" style="<?php echo $sStyleHidden_perc_calculo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_perc_calculo_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_perc_calculo_label" style=""><span id="id_label_perc_calculo"><?php echo $this->nm_new_label['perc_calculo']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["perc_calculo"]) &&  $this->nmgp_cmp_readonly["perc_calculo"] == "on") { 

 ?>
<input type="hidden" name="perc_calculo" value="<?php echo $this->form_encode_input($perc_calculo) . "\">" . $perc_calculo . ""; ?>
<?php } else { ?>
<span id="id_read_on_perc_calculo" class="sc-ui-readonly-perc_calculo css_perc_calculo_line" style="<?php echo $sStyleReadLab_perc_calculo; ?>"><?php echo $this->form_format_readonly("perc_calculo", $this->form_encode_input($this->perc_calculo)); ?></span><span id="id_read_off_perc_calculo" class="css_read_off_perc_calculo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_perc_calculo; ?>">
 <input class="sc-js-input scFormObjectOdd css_perc_calculo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_perc_calculo" type=text name="perc_calculo" value="<?php echo $this->form_encode_input($perc_calculo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 4, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['perc_calculo']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['perc_calculo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('perc_calculo')", "nm_mostra_mens('perc_calculo')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_perc_calculo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_perc_calculo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_calc_por_item']))
   {
       $this->nm_new_label['log_calc_por_item'] = "Calculada Por Item?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_calc_por_item = $this->log_calc_por_item;
   $sStyleHidden_log_calc_por_item = '';
   if (isset($this->nmgp_cmp_hidden['log_calc_por_item']) && $this->nmgp_cmp_hidden['log_calc_por_item'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_calc_por_item']);
       $sStyleHidden_log_calc_por_item = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_calc_por_item = 'display: none;';
   $sStyleReadInp_log_calc_por_item = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_calc_por_item']) && $this->nmgp_cmp_readonly['log_calc_por_item'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_calc_por_item']);
       $sStyleReadLab_log_calc_por_item = '';
       $sStyleReadInp_log_calc_por_item = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_calc_por_item']) && $this->nmgp_cmp_hidden['log_calc_por_item'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_calc_por_item" value="<?php echo $this->form_encode_input($this->log_calc_por_item) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_log_calc_por_item_line" id="hidden_field_data_log_calc_por_item" style="<?php echo $sStyleHidden_log_calc_por_item; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_calc_por_item_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_calc_por_item_label" style=""><span id="id_label_log_calc_por_item"><?php echo $this->nm_new_label['log_calc_por_item']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_calc_por_item"]) &&  $this->nmgp_cmp_readonly["log_calc_por_item"] == "on") { 

$log_calc_por_item_look = "";
 if ($this->log_calc_por_item == "1") { $log_calc_por_item_look .= "Sim" ;} 
 if ($this->log_calc_por_item == "0") { $log_calc_por_item_look .= "Não" ;} 
 if (empty($log_calc_por_item_look)) { $log_calc_por_item_look = $this->log_calc_por_item; }
?>
<input type="hidden" name="log_calc_por_item" value="<?php echo $this->form_encode_input($log_calc_por_item) . "\">" . $log_calc_por_item_look . ""; ?>
<?php } else { ?>
<?php

$log_calc_por_item_look = "";
 if ($this->log_calc_por_item == "1") { $log_calc_por_item_look .= "Sim" ;} 
 if ($this->log_calc_por_item == "0") { $log_calc_por_item_look .= "Não" ;} 
 if (empty($log_calc_por_item_look)) { $log_calc_por_item_look = $this->log_calc_por_item; }
?>
<span id="id_read_on_log_calc_por_item" class="css_log_calc_por_item_line"  style="<?php echo $sStyleReadLab_log_calc_por_item; ?>"><?php echo $this->form_format_readonly("log_calc_por_item", $this->form_encode_input($log_calc_por_item_look)); ?></span><span id="id_read_off_log_calc_por_item" class="css_read_off_log_calc_por_item<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_calc_por_item; ?>">
 <span id="idAjaxSelect_log_calc_por_item" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_calc_por_item_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_calc_por_item" name="log_calc_por_item" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_calc_por_item == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_calc_por_item'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_calc_por_item == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_log_calc_por_item'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_calc_por_item_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_calc_por_item_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_imposto']))
   {
       $this->nm_new_label['ind_imposto'] = "Imposto";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_imposto = $this->ind_imposto;
   $sStyleHidden_ind_imposto = '';
   if (isset($this->nmgp_cmp_hidden['ind_imposto']) && $this->nmgp_cmp_hidden['ind_imposto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_imposto']);
       $sStyleHidden_ind_imposto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_imposto = 'display: none;';
   $sStyleReadInp_ind_imposto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_imposto']) && $this->nmgp_cmp_readonly['ind_imposto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_imposto']);
       $sStyleReadLab_ind_imposto = '';
       $sStyleReadInp_ind_imposto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_imposto']) && $this->nmgp_cmp_hidden['ind_imposto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_imposto" value="<?php echo $this->form_encode_input($this->ind_imposto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ind_imposto_line" id="hidden_field_data_ind_imposto" style="<?php echo $sStyleHidden_ind_imposto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_imposto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_imposto_label" style=""><span id="id_label_ind_imposto"><?php echo $this->nm_new_label['ind_imposto']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_imposto"]) &&  $this->nmgp_cmp_readonly["ind_imposto"] == "on") { 

$ind_imposto_look = "";
 if ($this->ind_imposto == "1") { $ind_imposto_look .= "II" ;} 
 if ($this->ind_imposto == "2") { $ind_imposto_look .= "ICMS" ;} 
 if ($this->ind_imposto == "3") { $ind_imposto_look .= "IPI" ;} 
 if ($this->ind_imposto == "4") { $ind_imposto_look .= "PIS" ;} 
 if ($this->ind_imposto == "5") { $ind_imposto_look .= "COFINS" ;} 
 if (empty($ind_imposto_look)) { $ind_imposto_look = $this->ind_imposto; }
?>
<input type="hidden" name="ind_imposto" value="<?php echo $this->form_encode_input($ind_imposto) . "\">" . $ind_imposto_look . ""; ?>
<?php } else { ?>
<?php

$ind_imposto_look = "";
 if ($this->ind_imposto == "1") { $ind_imposto_look .= "II" ;} 
 if ($this->ind_imposto == "2") { $ind_imposto_look .= "ICMS" ;} 
 if ($this->ind_imposto == "3") { $ind_imposto_look .= "IPI" ;} 
 if ($this->ind_imposto == "4") { $ind_imposto_look .= "PIS" ;} 
 if ($this->ind_imposto == "5") { $ind_imposto_look .= "COFINS" ;} 
 if (empty($ind_imposto_look)) { $ind_imposto_look = $this->ind_imposto; }
?>
<span id="id_read_on_ind_imposto" class="css_ind_imposto_line"  style="<?php echo $sStyleReadLab_ind_imposto; ?>"><?php echo $this->form_format_readonly("ind_imposto", $this->form_encode_input($ind_imposto_look)); ?></span><span id="id_read_off_ind_imposto" class="css_read_off_ind_imposto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_imposto; ?>">
 <span id="idAjaxSelect_ind_imposto" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_imposto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_imposto" name="ind_imposto" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->ind_imposto == "1") { echo " selected" ;} ?>>II</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_imposto == "2") { echo " selected" ;} ?>>ICMS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = '2'; ?>
 <option  value="3" <?php  if ($this->ind_imposto == "3") { echo " selected" ;} ?>>IPI</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = '3'; ?>
 <option  value="4" <?php  if ($this->ind_imposto == "4") { echo " selected" ;} ?>>PIS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = '4'; ?>
 <option  value="5" <?php  if ($this->ind_imposto == "5") { echo " selected" ;} ?>>COFINS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_ind_imposto'][] = '5'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_imposto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_imposto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_ind_imposto_dumb = ('' == $sStyleHidden_ind_imposto) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_imposto_dumb" style="<?php echo $sStyleHidden_ind_imposto_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['md_relacs_desp']))
   {
       $this->nm_new_label['md_relacs_desp'] = "Desp. Base Calculo";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $md_relacs_desp = $this->md_relacs_desp;
   $sStyleHidden_md_relacs_desp = '';
   if (isset($this->nmgp_cmp_hidden['md_relacs_desp']) && $this->nmgp_cmp_hidden['md_relacs_desp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['md_relacs_desp']);
       $sStyleHidden_md_relacs_desp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_md_relacs_desp = 'display: none;';
   $sStyleReadInp_md_relacs_desp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['md_relacs_desp']) && $this->nmgp_cmp_readonly['md_relacs_desp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['md_relacs_desp']);
       $sStyleReadLab_md_relacs_desp = '';
       $sStyleReadInp_md_relacs_desp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['md_relacs_desp']) && $this->nmgp_cmp_hidden['md_relacs_desp'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="md_relacs_desp" value="<?php echo $this->form_encode_input($this->md_relacs_desp_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  $this->md_relacs_desp_1 = array(); 
  if (!empty($this->md_relacs_desp))
  {
      if (is_array($this->md_relacs_desp)) {
          $temp = $this->md_relacs_desp;
      } else {
          $temp = explode("@?@", trim($this->md_relacs_desp));
      }
      foreach ($temp as $cada_entrada) 
      {
          $temp1 = explode("#?#", trim($cada_entrada));
          if (!empty($temp1))
          {
              $this->md_relacs_desp_1[] = $temp1[0];
          } 
      } 
  } 
?> 

    <TD class="scFormDataOdd css_md_relacs_desp_line" id="hidden_field_data_md_relacs_desp" style="<?php echo $sStyleHidden_md_relacs_desp; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_md_relacs_desp_line" style="vertical-align: top;padding: 0px"> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp'] = array(); 
}
if ($this->despesa_id != "")
{ 
   $this->nm_clear_val("despesa_id");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp'] = array(); 
    }

   $old_value_despesa_id = $this->despesa_id;
   $old_value_ordem = $this->ordem;
   $old_value_perc_calculo = $this->perc_calculo;
   $this->nm_tira_formatacao();


   $unformatted_value_despesa_id = $this->despesa_id;
   $unformatted_value_ordem = $this->ordem;
   $unformatted_value_perc_calculo = $this->perc_calculo;

   $nm_comando = "select despesa_id, descricao from PUB.despesas  where despesa_id <> $this->despesa_id order by descricao";

   $this->despesa_id = $old_value_despesa_id;
   $this->ordem = $old_value_ordem;
   $this->perc_calculo = $old_value_perc_calculo;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['Lookup_md_relacs_desp'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $ind = 0 ; 
   $x = 0 ; 
   $md_relacs_desp_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->md_relacs_desp_1))
          {
              foreach ($this->md_relacs_desp_1 as $tmp_md_relacs_desp)
              {
                  if (trim($tmp_md_relacs_desp) === trim($cadaselect[1])) {$md_relacs_desp_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->md_relacs_desp) && trim($this->md_relacs_desp) === trim($cadaselect[1])) { $md_relacs_desp_look .= $cadaselect[0]; } 
          $x++; 
   }
   $x = 0; 
   echo "<span id=\"id_read_on_md_relacs_desp\" class=\"css_md_relacs_desp_line\" style=\"" .  $sStyleReadLab_md_relacs_desp . "\">" . $this->form_format_readonly("md_relacs_desp", $this->form_encode_input($md_relacs_desp_look)) . "</span><span id=\"id_read_off_md_relacs_desp\" class=\"css_read_off_md_relacs_desp css_md_relacs_desp_line\" style=\"" . $sStyleReadInp_md_relacs_desp . "\">";
   echo "<div id=\"idAjaxCheckbox_md_relacs_desp\" class=\"css_md_relacs_desp_line\" style=\"display: inline-block\">\r\n";
   $y = 0 ; 
   echo "<table cellspacing=0 cellpadding=0 border=0>\r\n";
   echo " <tr>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_md_relacs_desp_line\">&nbsp;</td>\r\n";
   echo " </tr>\r\n";
   echo " <tr>\r\n";
   unset($cadacheck); 
   while (!empty($todo[$x])) 
   {
          $cadacheck = explode("?#?", $todo[$x]) ; 
          if ($y == 7)
          {
              echo " </tr>\r\n";
              echo " <tr>\r\n";
              $y = 0;
          }
          echo "  <td class=\"scFormDataFontOdd  css_md_relacs_desp_line\">\r\n";
          $tempOptionId = "id-opt-md_relacs_desp-" . $x;
          echo "      <input type=checkbox id=\"" . $tempOptionId . "\" class=\"sc-ui-checkbox-md_relacs_desp sc-ui-checkbox-md_relacs_desp\" name=\"md_relacs_desp[$ind]\" value=\"$cadacheck[1]\"" ; 
          foreach ($this->md_relacs_desp_1 as $Dados)
          {
              if ($Dados === $cadacheck[1])
              {
                  echo " checked" ; 
                  break;
              }
          }
          if (strtoupper($cadacheck[2]) == "S") 
          {
              if (empty($this->md_relacs_desp)) 
              {
                  echo " checked" ; 
              } 
          } 
          echo "  onClick=\"\" >" ; 
          echo "<label for=\"" . $tempOptionId . "\">" . $cadacheck[0] . "</label>";
          $x++ ; 
          $y++ ; 
          echo "  </td>\r\n";
?>          
<?php 
          $ind++; 
          $quant_calendar_md_relacs_desp = $ind;
   } 
   echo " </tr>\r\n";
   echo "</table>";
   echo "</div>\r\n";
   echo "</span>";
?> 
<?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('md_relacs_desp')", "nm_mostra_mens('md_relacs_desp')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_md_relacs_desp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_md_relacs_desp_text"></span></td></tr></table></td></tr></table> </TD>
   




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
</TABLE></div><!-- bloco_f -->
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_despesas");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_despesas");
 parent.scAjaxDetailHeight("form_despesas", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_despesas", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_despesas", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['sc_modal'])
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
                if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
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
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
        }
        function scBtnFn_sys_GridPermiteSeq(btnPos) {
                if ($("#brec_t").length && $("#brec_t").is(":visible")) {
                    if ($("#brec_t").hasClass("disabled")) {
                        return;
                    }
                        if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
                         return;
                }
        }
        function scBtnFn_sys_format_ini() {
                if ($("#sc_b_ini_t.sc-unique-btn-11").length && $("#sc_b_ini_t.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_ini_t.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_t.sc-unique-btn-12").length && $("#sc_b_ret_t.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ret_t.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_t.sc-unique-btn-13").length && $("#sc_b_avc_t.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_avc_t.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_t.sc-unique-btn-14").length && $("#sc_b_fim_t.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_fim_t.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_despesas']['buttonStatus'] = $this->nmgp_botoes;
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
