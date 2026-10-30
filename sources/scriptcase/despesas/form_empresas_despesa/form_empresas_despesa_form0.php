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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Valores por Empresa"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " -Valores Por Empresa"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_empresas_despesa/form_empresas_despesa_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_empresas_despesa_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['last'] : 'off'); ?>";
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
 function nm_marca_check(check_obj, tem_seq)
 {
    seq = 0;
    len_check = document.F1.elements.length;
    if (document.F1.elements[check_obj + "[]"])
    {
        tem_seq = "N";
    }
    else if (document.F1.elements[check_obj + "[0]"])
    {
        tem_seq = "S";
    }
    for (i = 0; i < len_check; i++)
    {
        tst_obj = check_obj + "[]";
        if (tem_seq == "S")
        {
            tst_obj = check_obj + "[" + seq + "]";
        }
        if (document.F1.elements[ i].name == tst_obj)
        {
            document.F1.elements[ i].checked = true;
            var lcsObjects = $('input[name="' + tst_obj + '"]').parent().find(".lcs_switch");
            if (lcsObjects.length) {
                lcsObjects.lcs_on();
            }
            seq++;
        }
    }
 }
 function nm_limpa_check(check_obj, tem_seq)
 {
    seq = 0;
    len_check = document.F1.elements.length;
    if (document.F1.elements[check_obj + "[]"])
    {
        tem_seq = "N";
    }
    else if (document.F1.elements[check_obj + "[0]"])
    {
        tem_seq = "S";
    }
    for (i = 0; i < len_check; i++)
    {
        tst_obj = check_obj + "[]";
        if (tem_seq == "S")
        {
            tst_obj = check_obj + "[" + seq + "]";
        }
        if (document.F1.elements[ i].name == tst_obj)
        {
            document.F1.elements[ i].checked = false;
            var lcsObjects = $('input[name="' + tst_obj + '"]').parent().find(".lcs_switch");
            if (lcsObjects.length) {
                lcsObjects.lcs_off();
            }
            seq++;
        }
    }
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

include_once('form_empresas_despesa_jquery.php');

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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['link_info']['remove_border']) {
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
 include_once("form_empresas_despesa_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_empresas_despesa'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_empresas_despesa'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['fast_search'][2] : "";
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['bt_log'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_log", "scBtnFn_bt_log()", "scBtnFn_bt_log()", "sc_bt_log_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['bt_log'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['bt_log'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="60%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['empresa_despesa_id']))
   {
       $this->nmgp_cmp_hidden['empresa_despesa_id'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['empresa_despesa_id']))
           {
               $this->nmgp_cmp_readonly['empresa_despesa_id'] = 'on';
           }
?>
   <tr>


    <TD colspan="3" height="20" class="scFormBlock">
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
    if (!isset($this->nm_new_label['empresa_despesa_id']))
    {
        $this->nm_new_label['empresa_despesa_id'] = "Empresa Despesa Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_despesa_id = $this->empresa_despesa_id;
   if (!isset($this->nmgp_cmp_hidden['empresa_despesa_id']))
   {
       $this->nmgp_cmp_hidden['empresa_despesa_id'] = 'off';
   }
   $sStyleHidden_empresa_despesa_id = '';
   if (isset($this->nmgp_cmp_hidden['empresa_despesa_id']) && $this->nmgp_cmp_hidden['empresa_despesa_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_despesa_id']);
       $sStyleHidden_empresa_despesa_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_despesa_id = 'display: none;';
   $sStyleReadInp_empresa_despesa_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["empresa_despesa_id"]) &&  $this->nmgp_cmp_readonly["empresa_despesa_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_despesa_id']);
       $sStyleReadLab_empresa_despesa_id = '';
       $sStyleReadInp_empresa_despesa_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_despesa_id']) && $this->nmgp_cmp_hidden['empresa_despesa_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_despesa_id" value="<?php echo $this->form_encode_input($empresa_despesa_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_empresa_despesa_id" style="<?php echo $sStyleHidden_empresa_despesa_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_despesa_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_empresa_despesa_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_empresa_despesa_id"><?php echo $this->nm_new_label['empresa_despesa_id']; ?></span></td></tr><tr><td class="css_empresa_despesa_id_line" style="padding: 0px; width: 100%;">
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { 
 ?>
<span id="id_read_on_empresa_despesa_id" class="css_empresa_despesa_id_line" style="<?php echo $sStyleReadLab_empresa_despesa_id; ?>"><?php echo $this->form_format_readonly("empresa_despesa_id", $this->form_encode_input($this->empresa_despesa_id)); ?></span><span id="id_read_off_empresa_despesa_id" class="css_read_off_empresa_despesa_id" style="<?php echo $sStyleReadInp_empresa_despesa_id; ?>"><input type="hidden" name="empresa_despesa_id" value="<?php echo $this->form_encode_input($empresa_despesa_id) . "\">"?><span id="id_ajax_label_empresa_despesa_id"><?php echo nl2br($empresa_despesa_id); ?></span>
</span><?php } else { ?>
&nbsp;
<?php } ?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_despesa_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_despesa_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['despesa_id']))
   {
       $this->nm_new_label['despesa_id'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_despesa_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $despesa_id = $this->despesa_id;
   $sStyleHidden_despesa_id = '';
   if (isset($this->nmgp_cmp_hidden['despesa_id']) && $this->nmgp_cmp_hidden['despesa_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['despesa_id']);
       $sStyleHidden_despesa_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_despesa_id = 'display: none;';
   $sStyleReadInp_despesa_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['despesa_id']) && $this->nmgp_cmp_readonly['despesa_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['despesa_id']);
       $sStyleReadLab_despesa_id = '';
       $sStyleReadInp_despesa_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['despesa_id']) && $this->nmgp_cmp_hidden['despesa_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="despesa_id" value="<?php echo $this->form_encode_input($this->despesa_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_despesa_id" style="<?php echo $sStyleHidden_despesa_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_despesa_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_despesa_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_despesa_id"><?php echo $this->nm_new_label['despesa_id']; ?></span></td></tr><tr><td class="css_despesa_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["despesa_id"]) &&  $this->nmgp_cmp_readonly["despesa_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id'] = array(); 
    }

   $old_value_empresa_despesa_id = $this->empresa_despesa_id;
   $old_value_codigo_desp_erp = $this->codigo_desp_erp;
   $old_value_vl_padrao = $this->vl_padrao;
   $old_value_percentual = $this->percentual;
   $old_value_percentual_custo = $this->percentual_custo;
   $this->nm_tira_formatacao();


   $unformatted_value_empresa_despesa_id = $this->empresa_despesa_id;
   $unformatted_value_codigo_desp_erp = $this->codigo_desp_erp;
   $unformatted_value_vl_padrao = $this->vl_padrao;
   $unformatted_value_percentual = $this->percentual;
   $unformatted_value_percentual_custo = $this->percentual_custo;

   $nm_comando = "SELECT despesa_id, descricao  FROM pub.despesas  where despesa_id = " . $_SESSION['despesa_id_corrente'] . "	 ORDER BY descricao";

   $this->empresa_despesa_id = $old_value_empresa_despesa_id;
   $this->codigo_desp_erp = $old_value_codigo_desp_erp;
   $this->vl_padrao = $old_value_vl_padrao;
   $this->percentual = $old_value_percentual;
   $this->percentual_custo = $old_value_percentual_custo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_espec->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_espec->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $despesa_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->despesa_id_1))
          {
              foreach ($this->despesa_id_1 as $tmp_despesa_id)
              {
                  if (trim($tmp_despesa_id) === trim($cadaselect[1])) {$despesa_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->despesa_id) && trim($this->despesa_id) === trim($cadaselect[1])) {$despesa_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="despesa_id" value="<?php echo $this->form_encode_input($despesa_id) . "\">" . $despesa_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_despesa_id();
   $x = 0 ; 
   $despesa_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->despesa_id_1))
          {
              foreach ($this->despesa_id_1 as $tmp_despesa_id)
              {
                  if (trim($tmp_despesa_id) === trim($cadaselect[1])) {$despesa_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->despesa_id)) {
                 if (trim($this->despesa_id) == trim($cadaselect[1])) { $despesa_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->despesa_id == $cadaselect[1]) { $despesa_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($despesa_id_look))
          {
              $despesa_id_look = $this->despesa_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_despesa_id\" class=\"css_despesa_id_line\" style=\"" .  $sStyleReadLab_despesa_id . "\">" . $this->form_format_readonly("despesa_id", $this->form_encode_input($despesa_id_look)) . "</span><span id=\"id_read_off_despesa_id\" class=\"css_read_off_despesa_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_despesa_id . "\">";
   echo " <span id=\"idAjaxSelect_despesa_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_despesa_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_despesa_id\" name=\"despesa_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->despesa_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->despesa_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_despesa_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_despesa_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['empresa_id']))
   {
       $this->nm_new_label['empresa_id'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_empresa_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_id = $this->empresa_id;
   $sStyleHidden_empresa_id = '';
   if (isset($this->nmgp_cmp_hidden['empresa_id']) && $this->nmgp_cmp_hidden['empresa_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_id']);
       $sStyleHidden_empresa_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_id = 'display: none;';
   $sStyleReadInp_empresa_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_id']) && $this->nmgp_cmp_readonly['empresa_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_id']);
       $sStyleReadLab_empresa_id = '';
       $sStyleReadInp_empresa_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_id']) && $this->nmgp_cmp_hidden['empresa_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="empresa_id" value="<?php echo $this->form_encode_input($this->empresa_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_empresa_id" style="<?php echo $sStyleHidden_empresa_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_empresa_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_empresa_id"><?php echo $this->nm_new_label['empresa_id']; ?></span></td></tr><tr><td class="css_empresa_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_id"]) &&  $this->nmgp_cmp_readonly["empresa_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id'] = array(); 
    }

   $old_value_empresa_despesa_id = $this->empresa_despesa_id;
   $old_value_codigo_desp_erp = $this->codigo_desp_erp;
   $old_value_vl_padrao = $this->vl_padrao;
   $old_value_percentual = $this->percentual;
   $old_value_percentual_custo = $this->percentual_custo;
   $this->nm_tira_formatacao();


   $unformatted_value_empresa_despesa_id = $this->empresa_despesa_id;
   $unformatted_value_codigo_desp_erp = $this->codigo_desp_erp;
   $unformatted_value_vl_padrao = $this->vl_padrao;
   $unformatted_value_percentual = $this->percentual;
   $unformatted_value_percentual_custo = $this->percentual_custo;

   $nm_comando = "SELECT empresa_id, nome  FROM pub.empresas  ORDER BY nome";

   $this->empresa_despesa_id = $old_value_empresa_despesa_id;
   $this->codigo_desp_erp = $old_value_codigo_desp_erp;
   $this->vl_padrao = $old_value_vl_padrao;
   $this->percentual = $old_value_percentual;
   $this->percentual_custo = $old_value_percentual_custo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_espec->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_empresa_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_espec->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $empresa_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_id_1))
          {
              foreach ($this->empresa_id_1 as $tmp_empresa_id)
              {
                  if (trim($tmp_empresa_id) === trim($cadaselect[1])) {$empresa_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->empresa_id) && trim($this->empresa_id) === trim($cadaselect[1])) {$empresa_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="empresa_id" value="<?php echo $this->form_encode_input($empresa_id) . "\">" . $empresa_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_empresa_id();
   $x = 0 ; 
   $empresa_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_id_1))
          {
              foreach ($this->empresa_id_1 as $tmp_empresa_id)
              {
                  if (trim($tmp_empresa_id) === trim($cadaselect[1])) {$empresa_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->empresa_id)) {
                 if (trim($this->empresa_id) == trim($cadaselect[1])) { $empresa_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->empresa_id == $cadaselect[1]) { $empresa_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($empresa_id_look))
          {
              $empresa_id_look = $this->empresa_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_empresa_id\" class=\"css_empresa_id_line\" style=\"" .  $sStyleReadLab_empresa_id . "\">" . $this->form_format_readonly("empresa_id", $this->form_encode_input($empresa_id_look)) . "</span><span id=\"id_read_off_empresa_id\" class=\"css_read_off_empresa_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_empresa_id . "\">";
   echo " <span id=\"idAjaxSelect_empresa_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_empresa_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_empresa_id\" name=\"empresa_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->empresa_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->empresa_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_empresa_despesa_id_dumb = ('' == $sStyleHidden_empresa_despesa_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_empresa_despesa_id_dumb" style="<?php echo $sStyleHidden_empresa_despesa_id_dumb; ?>"></TD>
<?php $sStyleHidden_despesa_id_dumb = ('' == $sStyleHidden_despesa_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_despesa_id_dumb" style="<?php echo $sStyleHidden_despesa_id_dumb; ?>"></TD>
<?php $sStyleHidden_empresa_id_dumb = ('' == $sStyleHidden_empresa_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_empresa_id_dumb" style="<?php echo $sStyleHidden_empresa_id_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_desp_erp']))
    {
        $this->nm_new_label['codigo_desp_erp'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_codigo_desp_erp'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_desp_erp = $this->codigo_desp_erp;
   $sStyleHidden_codigo_desp_erp = '';
   if (isset($this->nmgp_cmp_hidden['codigo_desp_erp']) && $this->nmgp_cmp_hidden['codigo_desp_erp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_desp_erp']);
       $sStyleHidden_codigo_desp_erp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_desp_erp = 'display: none;';
   $sStyleReadInp_codigo_desp_erp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_desp_erp']) && $this->nmgp_cmp_readonly['codigo_desp_erp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_desp_erp']);
       $sStyleReadLab_codigo_desp_erp = '';
       $sStyleReadInp_codigo_desp_erp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_desp_erp']) && $this->nmgp_cmp_hidden['codigo_desp_erp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_desp_erp" value="<?php echo $this->form_encode_input($codigo_desp_erp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_codigo_desp_erp" style="<?php echo $sStyleHidden_codigo_desp_erp; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_desp_erp_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_codigo_desp_erp_label" style=" padding: 0px; width: 100%;"><span id="id_label_codigo_desp_erp"><?php echo $this->nm_new_label['codigo_desp_erp']; ?></span></td></tr><tr><td class="css_codigo_desp_erp_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_desp_erp"]) &&  $this->nmgp_cmp_readonly["codigo_desp_erp"] == "on") { 

 ?>
<input type="hidden" name="codigo_desp_erp" value="<?php echo $this->form_encode_input($codigo_desp_erp) . "\">" . $codigo_desp_erp . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_desp_erp" class="sc-ui-readonly-codigo_desp_erp css_codigo_desp_erp_line" style="<?php echo $sStyleReadLab_codigo_desp_erp; ?>"><?php echo $this->form_format_readonly("codigo_desp_erp", $this->form_encode_input($this->codigo_desp_erp)); ?></span><span id="id_read_off_codigo_desp_erp" class="css_read_off_codigo_desp_erp<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_desp_erp; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_desp_erp_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_desp_erp" type=text name="codigo_desp_erp" value="<?php echo $this->form_encode_input($codigo_desp_erp) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['codigo_desp_erp']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['codigo_desp_erp']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['codigo_desp_erp']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_desp_erp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_desp_erp_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['log_ativo']))
   {
       $this->nm_new_label['log_ativo'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_log_ativo'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_ativo = $this->log_ativo;
   $sStyleHidden_log_ativo = '';
   if (isset($this->nmgp_cmp_hidden['log_ativo']) && $this->nmgp_cmp_hidden['log_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_ativo']);
       $sStyleHidden_log_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_ativo = 'display: none;';
   $sStyleReadInp_log_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_ativo']) && $this->nmgp_cmp_readonly['log_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_ativo']);
       $sStyleReadLab_log_ativo = '';
       $sStyleReadInp_log_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_ativo']) && $this->nmgp_cmp_hidden['log_ativo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_ativo" value="<?php echo $this->form_encode_input($this->log_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_log_ativo" style="<?php echo $sStyleHidden_log_ativo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_ativo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_ativo_label" style=" padding: 0px; width: 100%;"><span id="id_label_log_ativo"><?php echo $this->nm_new_label['log_ativo']; ?></span></td></tr><tr><td class="css_log_ativo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_ativo"]) &&  $this->nmgp_cmp_readonly["log_ativo"] == "on") { 

$log_ativo_look = "";
 if ($this->log_ativo == "1") { $log_ativo_look .= "Sim" ;} 
 if ($this->log_ativo == "0") { $log_ativo_look .= "Não" ;} 
 if (empty($log_ativo_look)) { $log_ativo_look = $this->log_ativo; }
?>
<input type="hidden" name="log_ativo" value="<?php echo $this->form_encode_input($log_ativo) . "\">" . $log_ativo_look . ""; ?>
<?php } else { ?>
<?php

$log_ativo_look = "";
 if ($this->log_ativo == "1") { $log_ativo_look .= "Sim" ;} 
 if ($this->log_ativo == "0") { $log_ativo_look .= "Não" ;} 
 if (empty($log_ativo_look)) { $log_ativo_look = $this->log_ativo; }
?>
<span id="id_read_on_log_ativo" class="css_log_ativo_line"  style="<?php echo $sStyleReadLab_log_ativo; ?>"><?php echo $this->form_format_readonly("log_ativo", $this->form_encode_input($log_ativo_look)); ?></span><span id="id_read_off_log_ativo" class="css_read_off_log_ativo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_ativo; ?>">
 <span id="idAjaxSelect_log_ativo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_ativo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_ativo" name="log_ativo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_ativo == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_log_ativo'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_ativo == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_log_ativo'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_ativo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_padrao']))
    {
        $this->nm_new_label['vl_padrao'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_vl_padrao'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_padrao = $this->vl_padrao;
   $sStyleHidden_vl_padrao = '';
   if (isset($this->nmgp_cmp_hidden['vl_padrao']) && $this->nmgp_cmp_hidden['vl_padrao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_padrao']);
       $sStyleHidden_vl_padrao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_padrao = 'display: none;';
   $sStyleReadInp_vl_padrao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_padrao']) && $this->nmgp_cmp_readonly['vl_padrao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_padrao']);
       $sStyleReadLab_vl_padrao = '';
       $sStyleReadInp_vl_padrao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_padrao']) && $this->nmgp_cmp_hidden['vl_padrao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_padrao" value="<?php echo $this->form_encode_input($vl_padrao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_vl_padrao" style="<?php echo $sStyleHidden_vl_padrao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_padrao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_padrao_label" style=" padding: 0px; width: 100%;"><span id="id_label_vl_padrao"><?php echo $this->nm_new_label['vl_padrao']; ?></span></td></tr><tr><td class="css_vl_padrao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_padrao"]) &&  $this->nmgp_cmp_readonly["vl_padrao"] == "on") { 

 ?>
<input type="hidden" name="vl_padrao" value="<?php echo $this->form_encode_input($vl_padrao) . "\">" . $vl_padrao . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_padrao" class="sc-ui-readonly-vl_padrao css_vl_padrao_line" style="<?php echo $sStyleReadLab_vl_padrao; ?>"><?php echo $this->form_format_readonly("vl_padrao", $this->form_encode_input($this->vl_padrao)); ?></span><span id="id_read_off_vl_padrao" class="css_read_off_vl_padrao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_padrao; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_padrao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_padrao" type=text name="vl_padrao" value="<?php echo $this->form_encode_input($vl_padrao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 10, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_padrao']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_padrao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_padrao']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_padrao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_padrao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_padrao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_codigo_desp_erp_dumb = ('' == $sStyleHidden_codigo_desp_erp) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_codigo_desp_erp_dumb" style="<?php echo $sStyleHidden_codigo_desp_erp_dumb; ?>"></TD>
<?php $sStyleHidden_log_ativo_dumb = ('' == $sStyleHidden_log_ativo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_ativo_dumb" style="<?php echo $sStyleHidden_log_ativo_dumb; ?>"></TD>
<?php $sStyleHidden_vl_padrao_dumb = ('' == $sStyleHidden_vl_padrao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_padrao_dumb" style="<?php echo $sStyleHidden_vl_padrao_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['percentual']))
    {
        $this->nm_new_label['percentual'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_percentual'] . " Imposto";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $percentual = $this->percentual;
   $sStyleHidden_percentual = '';
   if (isset($this->nmgp_cmp_hidden['percentual']) && $this->nmgp_cmp_hidden['percentual'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['percentual']);
       $sStyleHidden_percentual = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_percentual = 'display: none;';
   $sStyleReadInp_percentual = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['percentual']) && $this->nmgp_cmp_readonly['percentual'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['percentual']);
       $sStyleReadLab_percentual = '';
       $sStyleReadInp_percentual = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['percentual']) && $this->nmgp_cmp_hidden['percentual'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="percentual" value="<?php echo $this->form_encode_input($percentual) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_percentual" style="<?php echo $sStyleHidden_percentual; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_percentual_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_percentual_label" style=" padding: 0px; width: 100%;"><span id="id_label_percentual"><?php echo $this->nm_new_label['percentual']; ?></span></td></tr><tr><td class="css_percentual_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["percentual"]) &&  $this->nmgp_cmp_readonly["percentual"] == "on") { 

 ?>
<input type="hidden" name="percentual" value="<?php echo $this->form_encode_input($percentual) . "\">" . $percentual . ""; ?>
<?php } else { ?>
<span id="id_read_on_percentual" class="sc-ui-readonly-percentual css_percentual_line" style="<?php echo $sStyleReadLab_percentual; ?>"><?php echo $this->form_format_readonly("percentual", $this->form_encode_input($this->percentual)); ?></span><span id="id_read_off_percentual" class="css_read_off_percentual<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_percentual; ?>">
 <input class="sc-js-input scFormObjectOdd css_percentual_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_percentual" type=text name="percentual" value="<?php echo $this->form_encode_input($percentual) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 10, precision: 4, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['percentual']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['percentual']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['percentual']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['percentual']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_percentual_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_percentual_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['cod_nat_operacao']))
    {
        $this->nm_new_label['cod_nat_operacao'] = "" . $this->Ini->Nm_lang['lang_empresas_despesa_fld_cod_nat_operacao'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_nat_operacao = $this->cod_nat_operacao;
   $sStyleHidden_cod_nat_operacao = '';
   if (isset($this->nmgp_cmp_hidden['cod_nat_operacao']) && $this->nmgp_cmp_hidden['cod_nat_operacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_nat_operacao']);
       $sStyleHidden_cod_nat_operacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_nat_operacao = 'display: none;';
   $sStyleReadInp_cod_nat_operacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_nat_operacao']) && $this->nmgp_cmp_readonly['cod_nat_operacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_nat_operacao']);
       $sStyleReadLab_cod_nat_operacao = '';
       $sStyleReadInp_cod_nat_operacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_nat_operacao']) && $this->nmgp_cmp_hidden['cod_nat_operacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_nat_operacao" value="<?php echo $this->form_encode_input($cod_nat_operacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cod_nat_operacao" style="<?php echo $sStyleHidden_cod_nat_operacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_nat_operacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cod_nat_operacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_cod_nat_operacao"><?php echo $this->nm_new_label['cod_nat_operacao']; ?></span></td></tr><tr><td class="css_cod_nat_operacao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_nat_operacao"]) &&  $this->nmgp_cmp_readonly["cod_nat_operacao"] == "on") { 

 ?>
<input type="hidden" name="cod_nat_operacao" value="<?php echo $this->form_encode_input($cod_nat_operacao) . "\">" . $cod_nat_operacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_nat_operacao" class="sc-ui-readonly-cod_nat_operacao css_cod_nat_operacao_line" style="<?php echo $sStyleReadLab_cod_nat_operacao; ?>"><?php echo $this->form_format_readonly("cod_nat_operacao", $this->form_encode_input($this->cod_nat_operacao)); ?></span><span id="id_read_off_cod_nat_operacao" class="css_read_off_cod_nat_operacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_nat_operacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_nat_operacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_nat_operacao" type=text name="cod_nat_operacao" value="<?php echo $this->form_encode_input($cod_nat_operacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=12"; } ?> maxlength=12 alt="{datatype: 'text', maxLength: 12, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_nat_operacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_nat_operacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['log_custo']))
   {
       $this->nm_new_label['log_custo'] = "Considera no Custo?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_custo = $this->log_custo;
   $sStyleHidden_log_custo = '';
   if (isset($this->nmgp_cmp_hidden['log_custo']) && $this->nmgp_cmp_hidden['log_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_custo']);
       $sStyleHidden_log_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_custo = 'display: none;';
   $sStyleReadInp_log_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_custo']) && $this->nmgp_cmp_readonly['log_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_custo']);
       $sStyleReadLab_log_custo = '';
       $sStyleReadInp_log_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_custo']) && $this->nmgp_cmp_hidden['log_custo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_custo" value="<?php echo $this->form_encode_input($this->log_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_log_custo" style="<?php echo $sStyleHidden_log_custo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_custo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_custo_label" style=" padding: 0px; width: 100%;"><span id="id_label_log_custo"><?php echo $this->nm_new_label['log_custo']; ?></span></td></tr><tr><td class="css_log_custo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_custo"]) &&  $this->nmgp_cmp_readonly["log_custo"] == "on") { 

$log_custo_look = "";
 if ($this->log_custo == "1") { $log_custo_look .= "Sim" ;} 
 if ($this->log_custo == "0") { $log_custo_look .= "Não" ;} 
 if (empty($log_custo_look)) { $log_custo_look = $this->log_custo; }
?>
<input type="hidden" name="log_custo" value="<?php echo $this->form_encode_input($log_custo) . "\">" . $log_custo_look . ""; ?>
<?php } else { ?>
<?php

$log_custo_look = "";
 if ($this->log_custo == "1") { $log_custo_look .= "Sim" ;} 
 if ($this->log_custo == "0") { $log_custo_look .= "Não" ;} 
 if (empty($log_custo_look)) { $log_custo_look = $this->log_custo; }
?>
<span id="id_read_on_log_custo" class="css_log_custo_line"  style="<?php echo $sStyleReadLab_log_custo; ?>"><?php echo $this->form_format_readonly("log_custo", $this->form_encode_input($log_custo_look)); ?></span><span id="id_read_off_log_custo" class="css_read_off_log_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_custo; ?>">
 <span id="idAjaxSelect_log_custo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_custo" name="log_custo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->log_custo == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_log_custo'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_custo == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_log_custo'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_custo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_percentual_dumb = ('' == $sStyleHidden_percentual) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_percentual_dumb" style="<?php echo $sStyleHidden_percentual_dumb; ?>"></TD>
<?php $sStyleHidden_cod_nat_operacao_dumb = ('' == $sStyleHidden_cod_nat_operacao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_cod_nat_operacao_dumb" style="<?php echo $sStyleHidden_cod_nat_operacao_dumb; ?>"></TD>
<?php $sStyleHidden_log_custo_dumb = ('' == $sStyleHidden_log_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_custo_dumb" style="<?php echo $sStyleHidden_log_custo_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['percentual_custo']))
    {
        $this->nm_new_label['percentual_custo'] = "% Custo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $percentual_custo = $this->percentual_custo;
   $sStyleHidden_percentual_custo = '';
   if (isset($this->nmgp_cmp_hidden['percentual_custo']) && $this->nmgp_cmp_hidden['percentual_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['percentual_custo']);
       $sStyleHidden_percentual_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_percentual_custo = 'display: none;';
   $sStyleReadInp_percentual_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['percentual_custo']) && $this->nmgp_cmp_readonly['percentual_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['percentual_custo']);
       $sStyleReadLab_percentual_custo = '';
       $sStyleReadInp_percentual_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['percentual_custo']) && $this->nmgp_cmp_hidden['percentual_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="percentual_custo" value="<?php echo $this->form_encode_input($percentual_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_percentual_custo" style="<?php echo $sStyleHidden_percentual_custo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_percentual_custo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_percentual_custo_label" style=" padding: 0px; width: 100%;"><span id="id_label_percentual_custo"><?php echo $this->nm_new_label['percentual_custo']; ?></span></td></tr><tr><td class="css_percentual_custo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["percentual_custo"]) &&  $this->nmgp_cmp_readonly["percentual_custo"] == "on") { 

 ?>
<input type="hidden" name="percentual_custo" value="<?php echo $this->form_encode_input($percentual_custo) . "\">" . $percentual_custo . ""; ?>
<?php } else { ?>
<span id="id_read_on_percentual_custo" class="sc-ui-readonly-percentual_custo css_percentual_custo_line" style="<?php echo $sStyleReadLab_percentual_custo; ?>"><?php echo $this->form_format_readonly("percentual_custo", $this->form_encode_input($this->percentual_custo)); ?></span><span id="id_read_off_percentual_custo" class="css_read_off_percentual_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_percentual_custo; ?>">
 <input class="sc-js-input scFormObjectOdd css_percentual_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_percentual_custo" type=text name="percentual_custo" value="<?php echo $this->form_encode_input($percentual_custo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'decimal', maxLength: 8, precision: 4, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['percentual_custo']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['percentual_custo']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['percentual_custo']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['percentual_custo']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('percentual_custo')", "nm_mostra_mens('percentual_custo')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_percentual_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_percentual_custo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['despesa_custo_id']))
   {
       $this->nm_new_label['despesa_custo_id'] = "Despesa Custo ";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $despesa_custo_id = $this->despesa_custo_id;
   $sStyleHidden_despesa_custo_id = '';
   if (isset($this->nmgp_cmp_hidden['despesa_custo_id']) && $this->nmgp_cmp_hidden['despesa_custo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['despesa_custo_id']);
       $sStyleHidden_despesa_custo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_despesa_custo_id = 'display: none;';
   $sStyleReadInp_despesa_custo_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['despesa_custo_id']) && $this->nmgp_cmp_readonly['despesa_custo_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['despesa_custo_id']);
       $sStyleReadLab_despesa_custo_id = '';
       $sStyleReadInp_despesa_custo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['despesa_custo_id']) && $this->nmgp_cmp_hidden['despesa_custo_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="despesa_custo_id" value="<?php echo $this->form_encode_input($this->despesa_custo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_despesa_custo_id" style="<?php echo $sStyleHidden_despesa_custo_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_despesa_custo_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_despesa_custo_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_despesa_custo_id"><?php echo $this->nm_new_label['despesa_custo_id']; ?></span></td></tr><tr><td class="css_despesa_custo_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["despesa_custo_id"]) &&  $this->nmgp_cmp_readonly["despesa_custo_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'] = array(); 
    }

   $old_value_empresa_despesa_id = $this->empresa_despesa_id;
   $old_value_codigo_desp_erp = $this->codigo_desp_erp;
   $old_value_vl_padrao = $this->vl_padrao;
   $old_value_percentual = $this->percentual;
   $old_value_percentual_custo = $this->percentual_custo;
   $this->nm_tira_formatacao();


   $unformatted_value_empresa_despesa_id = $this->empresa_despesa_id;
   $unformatted_value_codigo_desp_erp = $this->codigo_desp_erp;
   $unformatted_value_vl_padrao = $this->vl_padrao;
   $unformatted_value_percentual = $this->percentual;
   $unformatted_value_percentual_custo = $this->percentual_custo;

   $nm_comando = "SELECT despesa_id, descricao  FROM PUB.despesas  where log_imposto = 0 ORDER BY descricao";

   $this->empresa_despesa_id = $old_value_empresa_despesa_id;
   $this->codigo_desp_erp = $old_value_codigo_desp_erp;
   $this->vl_padrao = $old_value_vl_padrao;
   $this->percentual = $old_value_percentual;
   $this->percentual_custo = $old_value_percentual_custo;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_espec->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_espec->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $despesa_custo_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->despesa_custo_id_1))
          {
              foreach ($this->despesa_custo_id_1 as $tmp_despesa_custo_id)
              {
                  if (trim($tmp_despesa_custo_id) === trim($cadaselect[1])) {$despesa_custo_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->despesa_custo_id) && trim($this->despesa_custo_id) === trim($cadaselect[1])) {$despesa_custo_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="despesa_custo_id" value="<?php echo $this->form_encode_input($despesa_custo_id) . "\">" . $despesa_custo_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_despesa_custo_id();
   $x = 0 ; 
   $despesa_custo_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->despesa_custo_id_1))
          {
              foreach ($this->despesa_custo_id_1 as $tmp_despesa_custo_id)
              {
                  if (trim($tmp_despesa_custo_id) === trim($cadaselect[1])) {$despesa_custo_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->despesa_custo_id)) {
                 if (trim($this->despesa_custo_id) == trim($cadaselect[1])) { $despesa_custo_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->despesa_custo_id == $cadaselect[1]) { $despesa_custo_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($despesa_custo_id_look))
          {
              $despesa_custo_id_look = $this->despesa_custo_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_despesa_custo_id\" class=\"css_despesa_custo_id_line\" style=\"" .  $sStyleReadLab_despesa_custo_id . "\">" . $this->form_format_readonly("despesa_custo_id", $this->form_encode_input($despesa_custo_id_look)) . "</span><span id=\"id_read_off_despesa_custo_id\" class=\"css_read_off_despesa_custo_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_despesa_custo_id . "\">";
   echo " <span id=\"idAjaxSelect_despesa_custo_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_despesa_custo_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_despesa_custo_id\" name=\"despesa_custo_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_despesa_custo_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->despesa_custo_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->despesa_custo_id)) 
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
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('despesa_custo_id')", "nm_mostra_mens('despesa_custo_id')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_despesa_custo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_despesa_custo_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="1" >&nbsp;</TD>




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
<?php $sStyleHidden_percentual_custo_dumb = ('' == $sStyleHidden_percentual_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_percentual_custo_dumb" style="<?php echo $sStyleHidden_percentual_custo_dumb; ?>"></TD>
<?php $sStyleHidden_despesa_custo_id_dumb = ('' == $sStyleHidden_despesa_custo_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_despesa_custo_id_dumb" style="<?php echo $sStyleHidden_despesa_custo_id_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   <td width="40%" height="">
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Impostos Que utilizam esta despesa/imposto na base de calculo</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['impostos']))
   {
       $this->nm_new_label['impostos'] = "Impostos";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $impostos = $this->impostos;
   $sStyleHidden_impostos = '';
   if (isset($this->nmgp_cmp_hidden['impostos']) && $this->nmgp_cmp_hidden['impostos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['impostos']);
       $sStyleHidden_impostos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_impostos = 'display: none;';
   $sStyleReadInp_impostos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['impostos']) && $this->nmgp_cmp_readonly['impostos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['impostos']);
       $sStyleReadLab_impostos = '';
       $sStyleReadInp_impostos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['impostos']) && $this->nmgp_cmp_hidden['impostos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="impostos" value="<?php echo $this->form_encode_input($this->impostos_hidden) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php 
  $this->impostos_1 = array(); 
  if (!empty($this->impostos))
  {
      if (is_array($this->impostos)) {
          $temp = $this->impostos;
      } else {
          $temp = explode("@?@", trim($this->impostos));
      }
      foreach ($temp as $cada_entrada) 
      {
          $temp1 = explode("#?#", trim($cada_entrada));
          if (!empty($temp1))
          {
              $this->impostos_1[] = $temp1[0];
          } 
      } 
  } 
?> 

    <TD class="scFormDataOdd css_impostos_line" id="hidden_field_data_impostos" style="<?php echo $sStyleHidden_impostos; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_impostos_line" style="vertical-align: top;padding: 0px"> 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos'] = array(); 
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos'] = array(); 
    }

   $old_value_empresa_despesa_id = $this->empresa_despesa_id;
   $old_value_codigo_desp_erp = $this->codigo_desp_erp;
   $old_value_vl_padrao = $this->vl_padrao;
   $old_value_percentual = $this->percentual;
   $old_value_percentual_custo = $this->percentual_custo;
   $this->nm_tira_formatacao();


   $unformatted_value_empresa_despesa_id = $this->empresa_despesa_id;
   $unformatted_value_codigo_desp_erp = $this->codigo_desp_erp;
   $unformatted_value_vl_padrao = $this->vl_padrao;
   $unformatted_value_percentual = $this->percentual;
   $unformatted_value_percentual_custo = $this->percentual_custo;

   $nm_comando = "select despesa_id, descricao  from pub.despesas  where despesa_id <> $this->despesa_id and log_imposto = 1 order by descricao";

   $this->empresa_despesa_id = $old_value_empresa_despesa_id;
   $this->codigo_desp_erp = $old_value_codigo_desp_erp;
   $this->vl_padrao = $old_value_vl_padrao;
   $this->percentual = $old_value_percentual;
   $this->percentual_custo = $old_value_percentual_custo;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['Lookup_impostos'][] = $rs->fields[0];
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
   $impostos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->impostos_1))
          {
              foreach ($this->impostos_1 as $tmp_impostos)
              {
                  if (trim($tmp_impostos) === trim($cadaselect[1])) {$impostos_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->impostos) && trim($this->impostos) === trim($cadaselect[1])) { $impostos_look .= $cadaselect[0]; } 
          $x++; 
   }
   $x = 0; 
   echo "<span id=\"id_read_on_impostos\" class=\"css_impostos_line\" style=\"" .  $sStyleReadLab_impostos . "\">" . $this->form_format_readonly("impostos", $this->form_encode_input($impostos_look)) . "</span><span id=\"id_read_off_impostos\" class=\"css_read_off_impostos css_impostos_line\" style=\"" . $sStyleReadInp_impostos . "\">";
   echo "<TABLE style=\"border-collapse: collapse; border-width: 0\">\r\n";
   echo "<TR>\r\n";
   echo "  <TD style=\"padding: 0\">\r\n";
   echo "<div id=\"idAjaxCheckbox_impostos\" class=\"css_impostos_line\" style=\"display: inline-block\">\r\n";
   $y = 0 ; 
   echo "<table cellspacing=0 cellpadding=0 border=0>\r\n";
   echo " <tr>\r\n";
   echo "  <td class=\"scFormDataFontOdd css_impostos_line\">&nbsp;</td>\r\n";
   echo " </tr>\r\n";
   echo " <tr>\r\n";
   unset($cadacheck); 
   while (!empty($todo[$x])) 
   {
          $cadacheck = explode("?#?", $todo[$x]) ; 
          if ($y == 1)
          {
              echo " </tr>\r\n";
              echo " <tr>\r\n";
              $y = 0;
          }
          echo "  <td class=\"scFormDataFontOdd  css_impostos_line\">\r\n";
          $tempOptionId = "id-opt-impostos-" . $x;
          echo "      <input type=checkbox id=\"" . $tempOptionId . "\" class=\"sc-ui-checkbox-impostos sc-ui-checkbox-impostos\" name=\"impostos[$ind]\" value=\"$cadacheck[1]\"" ; 
          foreach ($this->impostos_1 as $Dados)
          {
              if ($Dados === $cadacheck[1])
              {
                  echo " checked" ; 
                  break;
              }
          }
          if (strtoupper($cadacheck[2]) == "S") 
          {
              if (empty($this->impostos)) 
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
          $quant_calendar_impostos = $ind;
   } 
   echo " </tr>\r\n";
   echo "</table>";
   echo "</div>\r\n";
   echo "  </TD>\r\n";
   echo "</TR>\r\n";
   echo "<TR>\r\n";
   echo "  <TD id=\"Check_All_impostos\" style=\"padding: 0\">\r\n";
   echo "   <IMG SRC=\"" . $this->Ini->path_img_global . "/img_select_all.gif\" ALIGN=\"absmiddle\" onClick=\"nm_marca_check('impostos', 'S'); return false;\">&nbsp;\r\n";
   echo "   <IMG SRC=\"" . $this->Ini->path_img_global . "/img_select_none.gif\" ALIGN=\"absmiddle\" onClick=\"nm_limpa_check('impostos', 'S');  return false;\">\r\n";
   echo "  </TD>\r\n";
   echo "</TR>\r\n";
   echo "</TABLE>\r\n";
   echo "</span>";
?> 
<?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('impostos')", "nm_mostra_mens('impostos')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_impostos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_impostos_text"></span></td></tr></table></td></tr></table> </TD>
   




<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['birpara'];
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
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['btn_label']['last'];
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
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_empresas_despesa");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_empresas_despesa");
 parent.scAjaxDetailHeight("form_empresas_despesa", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_empresas_despesa", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_empresas_despesa", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['sc_modal'])
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
                if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-12").length && $("#sc_b_ret_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-13").length && $("#sc_b_avc_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-14").length && $("#sc_b_fim_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-14").hasClass("disabled")) {
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_despesa']['buttonStatus'] = $this->nmgp_botoes;
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
