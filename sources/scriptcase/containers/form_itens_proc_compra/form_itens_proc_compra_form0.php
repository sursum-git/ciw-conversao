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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Itens Pedido de Importação"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Itens Pedido de Importação"); } ?></TITLE>
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
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<?php
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
?>
 <link rel="stylesheet" href="<?php echo $tippyThemeInfo['file'] ?>" />
<?php
}
?>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/popper.min.js"></script>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/tippy-bundle.umd.min.js"></script>
 <script>
  $(function() {
  });
 </script>
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
.css_read_off_dt_prev_envio_desenhos button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_real_envio_desenhos button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_recbto_laudo button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_recbto_embalagem button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_cheg_amostras_emb button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_mostruario button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_prev_recbto_so_ld button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_prev_aprov_so_ld button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_real_aprov_so_ld button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_real_recbto_so_ld button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_termino_producao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_prev_termino_producao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_dt_it_certif button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_itens_proc_compra/form_itens_proc_compra_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_itens_proc_compra_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_itens_proc_compra_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

<?php
if (!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName)
{
?>
  scFocusField('descricao');

<?php
}
?>
  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['recarga'];
}
if ('' != $this->proc_compra_id)
{
    $this->lookup_proc_compra_id($look_rpc_proc_compra_id);
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['link_info']['remove_border']) {
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
 include_once("form_itens_proc_compra_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_itens_proc_compra'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_itens_proc_compra'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['fast_search'][2] : "";
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
        $sCondStyle = ($this->nmgp_botoes['copy'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['copy']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['copy']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['copy']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['copy']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['copy'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcopy", "scBtnFn_sys_format_copy()", "scBtnFn_sys_format_copy()", "sc_b_copy_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['new'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "I", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bcancelar'];
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
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "S", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['exit'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bt_log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['bt_log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['bt_log'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
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
      if ("hidden_bloco_4" == sTabId) {
        if ($("#nmsc_iframe_liga_grid_PUB_envios_amostras_repres")[0].contentWindow.window.location.href.indexOf("/grid_PUB_envios_amostras_repres/") > -1)
        {
            scAjaxDetailHeight("grid_PUB_envios_amostras_repres", "400");
        }
      }
    }
    else {
      document.getElementById("div_" + sTabId).style.width = "1px";
      document.getElementById("div_" + sTabId).style.height = "0px";
      document.getElementById("div_" + sTabId).style.display = "none";
      document.getElementById("div_" + sTabId).style.overflow = "scroll";
      document.getElementById(sTabParts).className = "scTabInactive";
    }
    nm_field_disabled("proc_compra_id=disabled", "");
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
  sc_change_tabs(iTabIndex == 8, 'hidden_bloco_8', 'id_tabs_0_8');
  if (iTabIndex == 8) {
    displayChange_block("8", "on");
  }
  sc_change_tabs(iTabIndex == 9, 'hidden_bloco_9', 'id_tabs_0_9');
  if (iTabIndex == 9) {
    displayChange_block("9", "on");
  }
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)">Principal</a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Especificações</a></li>
<li id="id_tabs_0_2" class="scTabInactive"><a href="javascript: sc_control_tabs_0(2)">Perguntas</a></li>
<li id="id_tabs_0_3" class="scTabInactive"><a href="javascript: sc_control_tabs_0(3)">Datas</a></li>
<li id="id_tabs_0_4" class="scTabInactive"><a href="javascript: sc_control_tabs_0(4)">Envio de Amostras</a></li>
<li id="id_tabs_0_5" class="scTabInactive"><a href="javascript: sc_control_tabs_0(5)">Observações</a></li>
<li id="id_tabs_0_6" class="scTabInactive"><a href="javascript: sc_control_tabs_0(6)">Datas SO e LD</a></li>
<li id="id_tabs_0_7" class="scTabInactive"><a href="javascript: sc_control_tabs_0(7)">Datas Produção</a></li>
<li id="id_tabs_0_8" class="scTabInactive"><a href="javascript: sc_control_tabs_0(8)">Distribuição do Custo</a></li>
<li id="id_tabs_0_9" class="scTabInactive"><a href="javascript: sc_control_tabs_0(9)">dt_it_certif</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['item_proc_compra_id']))
           {
               $this->nmgp_cmp_readonly['item_proc_compra_id'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['proc_compra_id']))
    {
        $this->nm_new_label['proc_compra_id'] = "Pedido Importação";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $proc_compra_id = $this->proc_compra_id;
   $sStyleHidden_proc_compra_id = '';
   if (isset($this->nmgp_cmp_hidden['proc_compra_id']) && $this->nmgp_cmp_hidden['proc_compra_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['proc_compra_id']);
       $sStyleHidden_proc_compra_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_proc_compra_id = 'display: none;';
   $sStyleReadInp_proc_compra_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['proc_compra_id']) && $this->nmgp_cmp_readonly['proc_compra_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['proc_compra_id']);
       $sStyleReadLab_proc_compra_id = '';
       $sStyleReadInp_proc_compra_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['proc_compra_id']) && $this->nmgp_cmp_hidden['proc_compra_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="proc_compra_id" value="<?php echo $this->form_encode_input($proc_compra_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_proc_compra_id" style="<?php echo $sStyleHidden_proc_compra_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_proc_compra_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_proc_compra_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_proc_compra_id"><?php echo $this->nm_new_label['proc_compra_id']; ?></span></td></tr><tr><td class="css_proc_compra_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["proc_compra_id"]) &&  $this->nmgp_cmp_readonly["proc_compra_id"] == "on") { 

 ?>
<input type="hidden" name="proc_compra_id" value="<?php echo $this->form_encode_input($proc_compra_id) . "\">" . $proc_compra_id . ""; ?>
<?php } else { ?>
<span id="id_read_on_proc_compra_id" class="sc-ui-readonly-proc_compra_id css_proc_compra_id_line" style="<?php echo $sStyleReadLab_proc_compra_id; ?>"><?php echo $this->form_format_readonly("proc_compra_id", $this->form_encode_input($this->proc_compra_id)); ?></span><span id="id_read_off_proc_compra_id" class="css_read_off_proc_compra_id<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_proc_compra_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_proc_compra_id_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_proc_compra_id" type=text name="proc_compra_id" value="<?php echo $this->form_encode_input($proc_compra_id) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['proc_compra_id']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['proc_compra_id']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['proc_compra_id']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 <SPAN id="id_lookup_proc_compra_id"><?php echo $look_rpc_proc_compra_id; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_proc_compra_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_proc_compra_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['item_proc_compra_id']))
    {
        $this->nm_new_label['item_proc_compra_id'] = "ID Item Pedido";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $item_proc_compra_id = $this->item_proc_compra_id;
   $sStyleHidden_item_proc_compra_id = '';
   if (isset($this->nmgp_cmp_hidden['item_proc_compra_id']) && $this->nmgp_cmp_hidden['item_proc_compra_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['item_proc_compra_id']);
       $sStyleHidden_item_proc_compra_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_item_proc_compra_id = 'display: none;';
   $sStyleReadInp_item_proc_compra_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["item_proc_compra_id"]) &&  $this->nmgp_cmp_readonly["item_proc_compra_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['item_proc_compra_id']);
       $sStyleReadLab_item_proc_compra_id = '';
       $sStyleReadInp_item_proc_compra_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['item_proc_compra_id']) && $this->nmgp_cmp_hidden['item_proc_compra_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="item_proc_compra_id" value="<?php echo $this->form_encode_input($item_proc_compra_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_item_proc_compra_id" style="<?php echo $sStyleHidden_item_proc_compra_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_item_proc_compra_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_item_proc_compra_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_item_proc_compra_id"><?php echo $this->nm_new_label['item_proc_compra_id']; ?></span></td></tr><tr><td class="css_item_proc_compra_id_line" style="padding: 0px; width: 100%;">
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { 
 ?>
<span id="id_read_on_item_proc_compra_id" class="css_item_proc_compra_id_line" style="<?php echo $sStyleReadLab_item_proc_compra_id; ?>"><?php echo $this->form_format_readonly("item_proc_compra_id", $this->form_encode_input($this->item_proc_compra_id)); ?></span><span id="id_read_off_item_proc_compra_id" class="css_read_off_item_proc_compra_id" style="<?php echo $sStyleReadInp_item_proc_compra_id; ?>"><input type="hidden" name="item_proc_compra_id" value="<?php echo $this->form_encode_input($item_proc_compra_id) . "\">"?><span id="id_ajax_label_item_proc_compra_id"><?php echo nl2br($item_proc_compra_id); ?></span>
</span><?php } else { ?>
&nbsp;
<?php } ?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_item_proc_compra_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_item_proc_compra_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

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

    <TD class="scFormDataOdd" id="hidden_field_data_descricao" style="<?php echo $sStyleHidden_descricao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_descricao_label" style=" padding: 0px; width: 100%;"><span id="id_label_descricao"><?php echo $this->nm_new_label['descricao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['php_cmp_required']['descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['php_cmp_required']['descricao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_descricao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao"]) &&  $this->nmgp_cmp_readonly["descricao"] == "on") { 

 ?>
<input type="hidden" name="descricao" value="<?php echo $this->form_encode_input($descricao) . "\">" . $descricao . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao" class="sc-ui-readonly-descricao css_descricao_line" style="<?php echo $sStyleReadLab_descricao; ?>"><?php echo $this->form_format_readonly("descricao", $this->form_encode_input($this->descricao)); ?></span><span id="id_read_off_descricao" class="css_read_off_descricao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao; ?>">
 <input class="sc-js-input scFormObjectOdd css_descricao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao" type=text name="descricao" value="<?php echo $this->form_encode_input($descricao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_proc_compra_id_dumb = ('' == $sStyleHidden_proc_compra_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_proc_compra_id_dumb" style="<?php echo $sStyleHidden_proc_compra_id_dumb; ?>"></TD>
<?php $sStyleHidden_item_proc_compra_id_dumb = ('' == $sStyleHidden_item_proc_compra_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_item_proc_compra_id_dumb" style="<?php echo $sStyleHidden_item_proc_compra_id_dumb; ?>"></TD>
<?php $sStyleHidden_descricao_dumb = ('' == $sStyleHidden_descricao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_descricao_dumb" style="<?php echo $sStyleHidden_descricao_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_erp']))
    {
        $this->nm_new_label['codigo_erp'] = "Código ERP";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_erp = $this->codigo_erp;
   $sStyleHidden_codigo_erp = '';
   if (isset($this->nmgp_cmp_hidden['codigo_erp']) && $this->nmgp_cmp_hidden['codigo_erp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_erp']);
       $sStyleHidden_codigo_erp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_erp = 'display: none;';
   $sStyleReadInp_codigo_erp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_erp']) && $this->nmgp_cmp_readonly['codigo_erp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_erp']);
       $sStyleReadLab_codigo_erp = '';
       $sStyleReadInp_codigo_erp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_erp']) && $this->nmgp_cmp_hidden['codigo_erp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_erp" value="<?php echo $this->form_encode_input($codigo_erp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_codigo_erp" style="<?php echo $sStyleHidden_codigo_erp; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_erp_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_codigo_erp_label" style=" padding: 0px; width: 100%;"><span id="id_label_codigo_erp"><?php echo $this->nm_new_label['codigo_erp']; ?></span></td></tr><tr><td class="css_codigo_erp_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_erp"]) &&  $this->nmgp_cmp_readonly["codigo_erp"] == "on") { 

 ?>
<input type="hidden" name="codigo_erp" value="<?php echo $this->form_encode_input($codigo_erp) . "\">" . $codigo_erp . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_erp" class="sc-ui-readonly-codigo_erp css_codigo_erp_line" style="<?php echo $sStyleReadLab_codigo_erp; ?>"><?php echo $this->form_format_readonly("codigo_erp", $this->form_encode_input($this->codigo_erp)); ?></span><span id="id_read_off_codigo_erp" class="css_read_off_codigo_erp<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_erp; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_erp_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_erp" type=text name="codigo_erp" value="<?php echo $this->form_encode_input($codigo_erp) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_erp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_erp_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['desc_item']))
    {
        $this->nm_new_label['desc_item'] = "Descrição ERP";
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

    <TD class="scFormDataOdd" id="hidden_field_data_desc_item" style="<?php echo $sStyleHidden_desc_item; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_desc_item_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_desc_item_label" style=" padding: 0px; width: 100%;"><span id="id_label_desc_item"><?php echo $this->nm_new_label['desc_item']; ?></span></td></tr><tr><td class="css_desc_item_line" style="padding: 0px; width: 100%;"><input type="hidden" name="desc_item" value="<?php echo $this->form_encode_input($desc_item); ?>"><span id="id_ajax_label_desc_item"><?php echo nl2br($desc_item); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_desc_item_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_desc_item_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_custo_dolar']))
    {
        $this->nm_new_label['vl_custo_dolar'] = "Vl .Unit.Registro(Dólar)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_custo_dolar = $this->vl_custo_dolar;
   $sStyleHidden_vl_custo_dolar = '';
   if (isset($this->nmgp_cmp_hidden['vl_custo_dolar']) && $this->nmgp_cmp_hidden['vl_custo_dolar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_custo_dolar']);
       $sStyleHidden_vl_custo_dolar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_custo_dolar = 'display: none;';
   $sStyleReadInp_vl_custo_dolar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_custo_dolar']) && $this->nmgp_cmp_readonly['vl_custo_dolar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_custo_dolar']);
       $sStyleReadLab_vl_custo_dolar = '';
       $sStyleReadInp_vl_custo_dolar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_custo_dolar']) && $this->nmgp_cmp_hidden['vl_custo_dolar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_custo_dolar" value="<?php echo $this->form_encode_input($vl_custo_dolar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_vl_custo_dolar" style="<?php echo $sStyleHidden_vl_custo_dolar; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_custo_dolar_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_custo_dolar_label" style=" padding: 0px; width: 100%;"><span id="id_label_vl_custo_dolar"><?php echo $this->nm_new_label['vl_custo_dolar']; ?></span></td></tr><tr><td class="css_vl_custo_dolar_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_custo_dolar"]) &&  $this->nmgp_cmp_readonly["vl_custo_dolar"] == "on") { 

 ?>
<input type="hidden" name="vl_custo_dolar" value="<?php echo $this->form_encode_input($vl_custo_dolar) . "\">" . $vl_custo_dolar . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_custo_dolar" class="sc-ui-readonly-vl_custo_dolar css_vl_custo_dolar_line" style="<?php echo $sStyleReadLab_vl_custo_dolar; ?>"><?php echo $this->form_format_readonly("vl_custo_dolar", $this->form_encode_input($this->vl_custo_dolar)); ?></span><span id="id_read_off_vl_custo_dolar" class="css_read_off_vl_custo_dolar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_custo_dolar; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_custo_dolar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_custo_dolar" type=text name="vl_custo_dolar" value="<?php echo $this->form_encode_input($vl_custo_dolar) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 10, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_custo_dolar']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_custo_dolar']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_custo_dolar']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_custo_dolar']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_custo_dolar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_custo_dolar_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_codigo_erp_dumb = ('' == $sStyleHidden_codigo_erp) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_codigo_erp_dumb" style="<?php echo $sStyleHidden_codigo_erp_dumb; ?>"></TD>
<?php $sStyleHidden_desc_item_dumb = ('' == $sStyleHidden_desc_item) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_desc_item_dumb" style="<?php echo $sStyleHidden_desc_item_dumb; ?>"></TD>
<?php $sStyleHidden_vl_custo_dolar_dumb = ('' == $sStyleHidden_vl_custo_dolar) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_custo_dolar_dumb" style="<?php echo $sStyleHidden_vl_custo_dolar_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_base_tributacao']))
    {
        $this->nm_new_label['vl_base_tributacao'] = "Vl.Unit.Base Tributação + Anti Dumping(Dólar)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_base_tributacao = $this->vl_base_tributacao;
   $sStyleHidden_vl_base_tributacao = '';
   if (isset($this->nmgp_cmp_hidden['vl_base_tributacao']) && $this->nmgp_cmp_hidden['vl_base_tributacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_base_tributacao']);
       $sStyleHidden_vl_base_tributacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_base_tributacao = 'display: none;';
   $sStyleReadInp_vl_base_tributacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_base_tributacao']) && $this->nmgp_cmp_readonly['vl_base_tributacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_base_tributacao']);
       $sStyleReadLab_vl_base_tributacao = '';
       $sStyleReadInp_vl_base_tributacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_base_tributacao']) && $this->nmgp_cmp_hidden['vl_base_tributacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_base_tributacao" value="<?php echo $this->form_encode_input($vl_base_tributacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_vl_base_tributacao" style="<?php echo $sStyleHidden_vl_base_tributacao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_base_tributacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_base_tributacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_vl_base_tributacao"><?php echo $this->nm_new_label['vl_base_tributacao']; ?></span></td></tr><tr><td class="css_vl_base_tributacao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_base_tributacao"]) &&  $this->nmgp_cmp_readonly["vl_base_tributacao"] == "on") { 

 ?>
<input type="hidden" name="vl_base_tributacao" value="<?php echo $this->form_encode_input($vl_base_tributacao) . "\">" . $vl_base_tributacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_base_tributacao" class="sc-ui-readonly-vl_base_tributacao css_vl_base_tributacao_line" style="<?php echo $sStyleReadLab_vl_base_tributacao; ?>"><?php echo $this->form_format_readonly("vl_base_tributacao", $this->form_encode_input($this->vl_base_tributacao)); ?></span><span id="id_read_off_vl_base_tributacao" class="css_read_off_vl_base_tributacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_base_tributacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_base_tributacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_base_tributacao" type=text name="vl_base_tributacao" value="<?php echo $this->form_encode_input($vl_base_tributacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 10, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_base_tributacao']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_base_tributacao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_base_tributacao']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_base_tributacao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_base_tributacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_base_tributacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['unid_medida']))
   {
       $this->nm_new_label['unid_medida'] = "Unid.Medida";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $unid_medida = $this->unid_medida;
   $sStyleHidden_unid_medida = '';
   if (isset($this->nmgp_cmp_hidden['unid_medida']) && $this->nmgp_cmp_hidden['unid_medida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['unid_medida']);
       $sStyleHidden_unid_medida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_unid_medida = 'display: none;';
   $sStyleReadInp_unid_medida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['unid_medida']) && $this->nmgp_cmp_readonly['unid_medida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['unid_medida']);
       $sStyleReadLab_unid_medida = '';
       $sStyleReadInp_unid_medida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['unid_medida']) && $this->nmgp_cmp_hidden['unid_medida'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="unid_medida" value="<?php echo $this->form_encode_input($this->unid_medida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_unid_medida" style="<?php echo $sStyleHidden_unid_medida; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_unid_medida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_unid_medida_label" style=" padding: 0px; width: 100%;"><span id="id_label_unid_medida"><?php echo $this->nm_new_label['unid_medida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['php_cmp_required']['unid_medida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['php_cmp_required']['unid_medida'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_unid_medida_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["unid_medida"]) &&  $this->nmgp_cmp_readonly["unid_medida"] == "on") { 

$unid_medida_look = "";
 if ($this->unid_medida == "MT") { $unid_medida_look .= "Metro" ;} 
 if ($this->unid_medida == "KG") { $unid_medida_look .= "Quilo" ;} 
 if (empty($unid_medida_look)) { $unid_medida_look = $this->unid_medida; }
?>
<input type="hidden" name="unid_medida" value="<?php echo $this->form_encode_input($unid_medida) . "\">" . $unid_medida_look . ""; ?>
<?php } else { ?>
<?php

$unid_medida_look = "";
 if ($this->unid_medida == "MT") { $unid_medida_look .= "Metro" ;} 
 if ($this->unid_medida == "KG") { $unid_medida_look .= "Quilo" ;} 
 if (empty($unid_medida_look)) { $unid_medida_look = $this->unid_medida; }
?>
<span id="id_read_on_unid_medida" class="css_unid_medida_line"  style="<?php echo $sStyleReadLab_unid_medida; ?>"><?php echo $this->form_format_readonly("unid_medida", $this->form_encode_input($unid_medida_look)); ?></span><span id="id_read_off_unid_medida" class="css_read_off_unid_medida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_unid_medida; ?>">
 <span id="idAjaxSelect_unid_medida" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_unid_medida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_unid_medida" name="unid_medida" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="MT" <?php  if ($this->unid_medida == "MT") { echo " selected" ;} ?>>Metro</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_unid_medida'][] = 'MT'; ?>
 <option  value="KG" <?php  if ($this->unid_medida == "KG") { echo " selected" ;} ?>>Quilo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_unid_medida'][] = 'KG'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_unid_medida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_unid_medida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['qt_comprada']))
    {
        $this->nm_new_label['qt_comprada'] = "Qt.Comprada";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_comprada = $this->qt_comprada;
   $sStyleHidden_qt_comprada = '';
   if (isset($this->nmgp_cmp_hidden['qt_comprada']) && $this->nmgp_cmp_hidden['qt_comprada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_comprada']);
       $sStyleHidden_qt_comprada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_comprada = 'display: none;';
   $sStyleReadInp_qt_comprada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_comprada']) && $this->nmgp_cmp_readonly['qt_comprada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_comprada']);
       $sStyleReadLab_qt_comprada = '';
       $sStyleReadInp_qt_comprada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_comprada']) && $this->nmgp_cmp_hidden['qt_comprada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_comprada" value="<?php echo $this->form_encode_input($qt_comprada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_qt_comprada" style="<?php echo $sStyleHidden_qt_comprada; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_comprada_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_qt_comprada_label" style=" padding: 0px; width: 100%;"><span id="id_label_qt_comprada"><?php echo $this->nm_new_label['qt_comprada']; ?></span></td></tr><tr><td class="css_qt_comprada_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_comprada"]) &&  $this->nmgp_cmp_readonly["qt_comprada"] == "on") { 

 ?>
<input type="hidden" name="qt_comprada" value="<?php echo $this->form_encode_input($qt_comprada) . "\">" . $qt_comprada . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_comprada" class="sc-ui-readonly-qt_comprada css_qt_comprada_line" style="<?php echo $sStyleReadLab_qt_comprada; ?>"><?php echo $this->form_format_readonly("qt_comprada", $this->form_encode_input($this->qt_comprada)); ?></span><span id="id_read_off_qt_comprada" class="css_read_off_qt_comprada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_comprada; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_comprada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_comprada" type=text name="qt_comprada" value="<?php echo $this->form_encode_input($qt_comprada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 10, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_comprada']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_comprada']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_comprada']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_comprada']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_comprada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_comprada_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_vl_base_tributacao_dumb = ('' == $sStyleHidden_vl_base_tributacao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_base_tributacao_dumb" style="<?php echo $sStyleHidden_vl_base_tributacao_dumb; ?>"></TD>
<?php $sStyleHidden_unid_medida_dumb = ('' == $sStyleHidden_unid_medida) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_unid_medida_dumb" style="<?php echo $sStyleHidden_unid_medida_dumb; ?>"></TD>
<?php $sStyleHidden_qt_comprada_dumb = ('' == $sStyleHidden_qt_comprada) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_qt_comprada_dumb" style="<?php echo $sStyleHidden_qt_comprada_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_cubagem']))
    {
        $this->nm_new_label['vl_cubagem'] = "Vl. Cubagem";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_cubagem = $this->vl_cubagem;
   $sStyleHidden_vl_cubagem = '';
   if (isset($this->nmgp_cmp_hidden['vl_cubagem']) && $this->nmgp_cmp_hidden['vl_cubagem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_cubagem']);
       $sStyleHidden_vl_cubagem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_cubagem = 'display: none;';
   $sStyleReadInp_vl_cubagem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_cubagem']) && $this->nmgp_cmp_readonly['vl_cubagem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_cubagem']);
       $sStyleReadLab_vl_cubagem = '';
       $sStyleReadInp_vl_cubagem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_cubagem']) && $this->nmgp_cmp_hidden['vl_cubagem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_cubagem" value="<?php echo $this->form_encode_input($vl_cubagem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_vl_cubagem" style="<?php echo $sStyleHidden_vl_cubagem; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_cubagem_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_cubagem_label" style=" padding: 0px; width: 100%;"><span id="id_label_vl_cubagem"><?php echo $this->nm_new_label['vl_cubagem']; ?></span></td></tr><tr><td class="css_vl_cubagem_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_cubagem"]) &&  $this->nmgp_cmp_readonly["vl_cubagem"] == "on") { 

 ?>
<input type="hidden" name="vl_cubagem" value="<?php echo $this->form_encode_input($vl_cubagem) . "\">" . $vl_cubagem . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_cubagem" class="sc-ui-readonly-vl_cubagem css_vl_cubagem_line" style="<?php echo $sStyleReadLab_vl_cubagem; ?>"><?php echo $this->form_format_readonly("vl_cubagem", $this->form_encode_input($this->vl_cubagem)); ?></span><span id="id_read_off_vl_cubagem" class="css_read_off_vl_cubagem<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_cubagem; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_cubagem_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_cubagem" type=text name="vl_cubagem" value="<?php echo $this->form_encode_input($vl_cubagem) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_cubagem']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_cubagem']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_cubagem']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_cubagem']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_cubagem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_cubagem_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="2" >&nbsp;</TD>




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
<?php $sStyleHidden_vl_cubagem_dumb = ('' == $sStyleHidden_vl_cubagem) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_cubagem_dumb" style="<?php echo $sStyleHidden_vl_cubagem_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['composicao']))
    {
        $this->nm_new_label['composicao'] = "Composição";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $composicao = $this->composicao;
   $sStyleHidden_composicao = '';
   if (isset($this->nmgp_cmp_hidden['composicao']) && $this->nmgp_cmp_hidden['composicao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['composicao']);
       $sStyleHidden_composicao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_composicao = 'display: none;';
   $sStyleReadInp_composicao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['composicao']) && $this->nmgp_cmp_readonly['composicao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['composicao']);
       $sStyleReadLab_composicao = '';
       $sStyleReadInp_composicao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['composicao']) && $this->nmgp_cmp_hidden['composicao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="composicao" value="<?php echo $this->form_encode_input($composicao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_composicao" style="<?php echo $sStyleHidden_composicao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_composicao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_composicao_label" style=" padding: 0px; width: 100%;"><span id="id_label_composicao"><?php echo $this->nm_new_label['composicao']; ?></span></td></tr><tr><td class="css_composicao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["composicao"]) &&  $this->nmgp_cmp_readonly["composicao"] == "on") { 

 ?>
<input type="hidden" name="composicao" value="<?php echo $this->form_encode_input($composicao) . "\">" . $composicao . ""; ?>
<?php } else { ?>
<span id="id_read_on_composicao" class="sc-ui-readonly-composicao css_composicao_line" style="<?php echo $sStyleReadLab_composicao; ?>"><?php echo $this->form_format_readonly("composicao", $this->form_encode_input($this->composicao)); ?></span><span id="id_read_off_composicao" class="css_read_off_composicao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_composicao; ?>">
 <input class="sc-js-input scFormObjectOdd css_composicao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_composicao" type=text name="composicao" value="<?php echo $this->form_encode_input($composicao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_composicao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_composicao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['shrinkage']))
    {
        $this->nm_new_label['shrinkage'] = "Shrinkage";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $shrinkage = $this->shrinkage;
   $sStyleHidden_shrinkage = '';
   if (isset($this->nmgp_cmp_hidden['shrinkage']) && $this->nmgp_cmp_hidden['shrinkage'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['shrinkage']);
       $sStyleHidden_shrinkage = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_shrinkage = 'display: none;';
   $sStyleReadInp_shrinkage = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['shrinkage']) && $this->nmgp_cmp_readonly['shrinkage'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['shrinkage']);
       $sStyleReadLab_shrinkage = '';
       $sStyleReadInp_shrinkage = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['shrinkage']) && $this->nmgp_cmp_hidden['shrinkage'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="shrinkage" value="<?php echo $this->form_encode_input($shrinkage) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_shrinkage" style="<?php echo $sStyleHidden_shrinkage; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_shrinkage_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_shrinkage_label" style=" padding: 0px; width: 100%;"><span id="id_label_shrinkage"><?php echo $this->nm_new_label['shrinkage']; ?></span></td></tr><tr><td class="css_shrinkage_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["shrinkage"]) &&  $this->nmgp_cmp_readonly["shrinkage"] == "on") { 

 ?>
<input type="hidden" name="shrinkage" value="<?php echo $this->form_encode_input($shrinkage) . "\">" . $shrinkage . ""; ?>
<?php } else { ?>
<span id="id_read_on_shrinkage" class="sc-ui-readonly-shrinkage css_shrinkage_line" style="<?php echo $sStyleReadLab_shrinkage; ?>"><?php echo $this->form_format_readonly("shrinkage", $this->form_encode_input($this->shrinkage)); ?></span><span id="id_read_off_shrinkage" class="css_read_off_shrinkage<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_shrinkage; ?>">
 <input class="sc-js-input scFormObjectOdd css_shrinkage_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_shrinkage" type=text name="shrinkage" value="<?php echo $this->form_encode_input($shrinkage) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_shrinkage_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_shrinkage_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['peso']))
    {
        $this->nm_new_label['peso'] = "Peso (GSM)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $peso = $this->peso;
   $sStyleHidden_peso = '';
   if (isset($this->nmgp_cmp_hidden['peso']) && $this->nmgp_cmp_hidden['peso'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['peso']);
       $sStyleHidden_peso = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_peso = 'display: none;';
   $sStyleReadInp_peso = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['peso']) && $this->nmgp_cmp_readonly['peso'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['peso']);
       $sStyleReadLab_peso = '';
       $sStyleReadInp_peso = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['peso']) && $this->nmgp_cmp_hidden['peso'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="peso" value="<?php echo $this->form_encode_input($peso) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_peso" style="<?php echo $sStyleHidden_peso; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_peso_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_peso_label" style=" padding: 0px; width: 100%;"><span id="id_label_peso"><?php echo $this->nm_new_label['peso']; ?></span></td></tr><tr><td class="css_peso_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["peso"]) &&  $this->nmgp_cmp_readonly["peso"] == "on") { 

 ?>
<input type="hidden" name="peso" value="<?php echo $this->form_encode_input($peso) . "\">" . $peso . ""; ?>
<?php } else { ?>
<span id="id_read_on_peso" class="sc-ui-readonly-peso css_peso_line" style="<?php echo $sStyleReadLab_peso; ?>"><?php echo $this->form_format_readonly("peso", $this->form_encode_input($this->peso)); ?></span><span id="id_read_off_peso" class="css_read_off_peso<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_peso; ?>">
 <input class="sc-js-input scFormObjectOdd css_peso_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_peso" type=text name="peso" value="<?php echo $this->form_encode_input($peso) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_peso_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_peso_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['largura']))
    {
        $this->nm_new_label['largura'] = "Largura (CM)";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $largura = $this->largura;
   $sStyleHidden_largura = '';
   if (isset($this->nmgp_cmp_hidden['largura']) && $this->nmgp_cmp_hidden['largura'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['largura']);
       $sStyleHidden_largura = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_largura = 'display: none;';
   $sStyleReadInp_largura = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['largura']) && $this->nmgp_cmp_readonly['largura'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['largura']);
       $sStyleReadLab_largura = '';
       $sStyleReadInp_largura = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['largura']) && $this->nmgp_cmp_hidden['largura'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="largura" value="<?php echo $this->form_encode_input($largura) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_largura" style="<?php echo $sStyleHidden_largura; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_largura_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_largura_label" style=" padding: 0px; width: 100%;"><span id="id_label_largura"><?php echo $this->nm_new_label['largura']; ?></span></td></tr><tr><td class="css_largura_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["largura"]) &&  $this->nmgp_cmp_readonly["largura"] == "on") { 

 ?>
<input type="hidden" name="largura" value="<?php echo $this->form_encode_input($largura) . "\">" . $largura . ""; ?>
<?php } else { ?>
<span id="id_read_on_largura" class="sc-ui-readonly-largura css_largura_line" style="<?php echo $sStyleReadLab_largura; ?>"><?php echo $this->form_format_readonly("largura", $this->form_encode_input($this->largura)); ?></span><span id="id_read_off_largura" class="css_read_off_largura<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_largura; ?>">
 <input class="sc-js-input scFormObjectOdd css_largura_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_largura" type=text name="largura" value="<?php echo $this->form_encode_input($largura) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789,") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_largura_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_largura_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['calc_gm']))
    {
        $this->nm_new_label['calc_gm'] = "G/M";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $calc_gm = $this->calc_gm;
   $sStyleHidden_calc_gm = '';
   if (isset($this->nmgp_cmp_hidden['calc_gm']) && $this->nmgp_cmp_hidden['calc_gm'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['calc_gm']);
       $sStyleHidden_calc_gm = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_calc_gm = 'display: none;';
   $sStyleReadInp_calc_gm = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['calc_gm']) && $this->nmgp_cmp_readonly['calc_gm'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['calc_gm']);
       $sStyleReadLab_calc_gm = '';
       $sStyleReadInp_calc_gm = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['calc_gm']) && $this->nmgp_cmp_hidden['calc_gm'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="calc_gm" value="<?php echo $this->form_encode_input($calc_gm) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_calc_gm" style="<?php echo $sStyleHidden_calc_gm; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_calc_gm_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_calc_gm_label" style=" padding: 0px; width: 100%;"><span id="id_label_calc_gm"><?php echo $this->nm_new_label['calc_gm']; ?></span></td></tr><tr><td class="css_calc_gm_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["calc_gm"]) &&  $this->nmgp_cmp_readonly["calc_gm"] == "on") { 

 ?>
<input type="hidden" name="calc_gm" value="<?php echo $this->form_encode_input($calc_gm) . "\">" . $calc_gm . ""; ?>
<?php } else { ?>
<span id="id_read_on_calc_gm" class="sc-ui-readonly-calc_gm css_calc_gm_line" style="<?php echo $sStyleReadLab_calc_gm; ?>"><?php echo $this->form_format_readonly("calc_gm", $this->form_encode_input($this->calc_gm)); ?></span><span id="id_read_off_calc_gm" class="css_read_off_calc_gm<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_calc_gm; ?>">
 <input class="sc-js-input scFormObjectOdd css_calc_gm_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_calc_gm" type=text name="calc_gm" value="<?php echo $this->form_encode_input($calc_gm) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'decimal', maxLength: 20, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['calc_gm']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['calc_gm']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['calc_gm']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['calc_gm']['format_neg'] ? "'suffix'" : "'prefix'") ?>, enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_calc_gm_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_calc_gm_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['rolo']))
    {
        $this->nm_new_label['rolo'] = "Tamanho Rolo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $rolo = $this->rolo;
   $sStyleHidden_rolo = '';
   if (isset($this->nmgp_cmp_hidden['rolo']) && $this->nmgp_cmp_hidden['rolo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['rolo']);
       $sStyleHidden_rolo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_rolo = 'display: none;';
   $sStyleReadInp_rolo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['rolo']) && $this->nmgp_cmp_readonly['rolo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['rolo']);
       $sStyleReadLab_rolo = '';
       $sStyleReadInp_rolo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['rolo']) && $this->nmgp_cmp_hidden['rolo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="rolo" value="<?php echo $this->form_encode_input($rolo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_rolo" style="<?php echo $sStyleHidden_rolo; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_rolo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_rolo_label" style=" padding: 0px; width: 100%;"><span id="id_label_rolo"><?php echo $this->nm_new_label['rolo']; ?></span></td></tr><tr><td class="css_rolo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["rolo"]) &&  $this->nmgp_cmp_readonly["rolo"] == "on") { 

 ?>
<input type="hidden" name="rolo" value="<?php echo $this->form_encode_input($rolo) . "\">" . $rolo . ""; ?>
<?php } else { ?>
<span id="id_read_on_rolo" class="sc-ui-readonly-rolo css_rolo_line" style="<?php echo $sStyleReadLab_rolo; ?>"><?php echo $this->form_format_readonly("rolo", $this->form_encode_input($this->rolo)); ?></span><span id="id_read_off_rolo" class="css_read_off_rolo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_rolo; ?>">
 <input class="sc-js-input scFormObjectOdd css_rolo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_rolo" type=text name="rolo" value="<?php echo $this->form_encode_input($rolo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_rolo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_rolo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['coloracao_id']))
   {
       $this->nm_new_label['coloracao_id'] = "Coloração";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $coloracao_id = $this->coloracao_id;
   $sStyleHidden_coloracao_id = '';
   if (isset($this->nmgp_cmp_hidden['coloracao_id']) && $this->nmgp_cmp_hidden['coloracao_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['coloracao_id']);
       $sStyleHidden_coloracao_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_coloracao_id = 'display: none;';
   $sStyleReadInp_coloracao_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['coloracao_id']) && $this->nmgp_cmp_readonly['coloracao_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['coloracao_id']);
       $sStyleReadLab_coloracao_id = '';
       $sStyleReadInp_coloracao_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['coloracao_id']) && $this->nmgp_cmp_hidden['coloracao_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="coloracao_id" value="<?php echo $this->form_encode_input($this->coloracao_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_coloracao_id" style="<?php echo $sStyleHidden_coloracao_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_coloracao_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_coloracao_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_coloracao_id"><?php echo $this->nm_new_label['coloracao_id']; ?></span></td></tr><tr><td class="css_coloracao_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["coloracao_id"]) &&  $this->nmgp_cmp_readonly["coloracao_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'] = array(); 
    }

   $old_value_proc_compra_id = $this->proc_compra_id;
   $old_value_item_proc_compra_id = $this->item_proc_compra_id;
   $old_value_vl_custo_dolar = $this->vl_custo_dolar;
   $old_value_vl_base_tributacao = $this->vl_base_tributacao;
   $old_value_qt_comprada = $this->qt_comprada;
   $old_value_vl_cubagem = $this->vl_cubagem;
   $old_value_calc_gm = $this->calc_gm;
   $old_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $old_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $old_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $old_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $old_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $old_value_dt_mostruario = $this->dt_mostruario;
   $old_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $old_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $old_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $old_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $old_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $old_value_qt_dias_producao = $this->qt_dias_producao;
   $old_value_dt_maxima_producao = $this->dt_maxima_producao;
   $old_value_dt_termino_producao = $this->dt_termino_producao;
   $old_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $old_value_vl_negociado = $this->vl_negociado;
   $old_value_dt_it_certif = $this->dt_it_certif;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_proc_compra_id = $this->proc_compra_id;
   $unformatted_value_item_proc_compra_id = $this->item_proc_compra_id;
   $unformatted_value_vl_custo_dolar = $this->vl_custo_dolar;
   $unformatted_value_vl_base_tributacao = $this->vl_base_tributacao;
   $unformatted_value_qt_comprada = $this->qt_comprada;
   $unformatted_value_vl_cubagem = $this->vl_cubagem;
   $unformatted_value_calc_gm = $this->calc_gm;
   $unformatted_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $unformatted_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $unformatted_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $unformatted_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $unformatted_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $unformatted_value_dt_mostruario = $this->dt_mostruario;
   $unformatted_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $unformatted_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $unformatted_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $unformatted_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $unformatted_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $unformatted_value_qt_dias_producao = $this->qt_dias_producao;
   $unformatted_value_dt_maxima_producao = $this->dt_maxima_producao;
   $unformatted_value_dt_termino_producao = $this->dt_termino_producao;
   $unformatted_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $unformatted_value_vl_negociado = $this->vl_negociado;
   $unformatted_value_dt_it_certif = $this->dt_it_certif;

   $nm_comando = "SELECT coloracao_id, descricao  FROM PUB.coloracoes  ORDER BY descricao";

   $this->proc_compra_id = $old_value_proc_compra_id;
   $this->item_proc_compra_id = $old_value_item_proc_compra_id;
   $this->vl_custo_dolar = $old_value_vl_custo_dolar;
   $this->vl_base_tributacao = $old_value_vl_base_tributacao;
   $this->qt_comprada = $old_value_qt_comprada;
   $this->vl_cubagem = $old_value_vl_cubagem;
   $this->calc_gm = $old_value_calc_gm;
   $this->dt_prev_envio_desenhos = $old_value_dt_prev_envio_desenhos;
   $this->dt_real_envio_desenhos = $old_value_dt_real_envio_desenhos;
   $this->dt_recbto_laudo = $old_value_dt_recbto_laudo;
   $this->dt_recbto_embalagem = $old_value_dt_recbto_embalagem;
   $this->dt_cheg_amostras_emb = $old_value_dt_cheg_amostras_emb;
   $this->dt_mostruario = $old_value_dt_mostruario;
   $this->dt_prev_recbto_so_ld = $old_value_dt_prev_recbto_so_ld;
   $this->dt_prev_aprov_so_ld = $old_value_dt_prev_aprov_so_ld;
   $this->dt_real_aprov_so_ld = $old_value_dt_real_aprov_so_ld;
   $this->qt_dias_calc_so_ld = $old_value_qt_dias_calc_so_ld;
   $this->dt_real_recbto_so_ld = $old_value_dt_real_recbto_so_ld;
   $this->qt_dias_producao = $old_value_qt_dias_producao;
   $this->dt_maxima_producao = $old_value_dt_maxima_producao;
   $this->dt_termino_producao = $old_value_dt_termino_producao;
   $this->dt_prev_termino_producao = $old_value_dt_prev_termino_producao;
   $this->vl_negociado = $old_value_vl_negociado;
   $this->dt_it_certif = $old_value_dt_it_certif;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'][] = $rs->fields[0];
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
   $coloracao_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->coloracao_id_1))
          {
              foreach ($this->coloracao_id_1 as $tmp_coloracao_id)
              {
                  if (trim($tmp_coloracao_id) === trim($cadaselect[1])) {$coloracao_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->coloracao_id) && trim($this->coloracao_id) === trim($cadaselect[1])) {$coloracao_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="coloracao_id" value="<?php echo $this->form_encode_input($coloracao_id) . "\">" . $coloracao_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_coloracao_id();
   $x = 0 ; 
   $coloracao_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->coloracao_id_1))
          {
              foreach ($this->coloracao_id_1 as $tmp_coloracao_id)
              {
                  if (trim($tmp_coloracao_id) === trim($cadaselect[1])) {$coloracao_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->coloracao_id)) {
                 if (trim($this->coloracao_id) == trim($cadaselect[1])) { $coloracao_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->coloracao_id == $cadaselect[1]) { $coloracao_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($coloracao_id_look))
          {
              $coloracao_id_look = $this->coloracao_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_coloracao_id\" class=\"css_coloracao_id_line\" style=\"" .  $sStyleReadLab_coloracao_id . "\">" . $this->form_format_readonly("coloracao_id", $this->form_encode_input($coloracao_id_look)) . "</span><span id=\"id_read_off_coloracao_id\" class=\"css_read_off_coloracao_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_coloracao_id . "\">";
   echo " <span id=\"idAjaxSelect_coloracao_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_coloracao_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_coloracao_id\" name=\"coloracao_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_coloracao_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->coloracao_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->coloracao_id)) 
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
   if (isset($this->Ini->sc_lig_md5["form_pub_coloracoes"]) && $this->Ini->sc_lig_md5["form_pub_coloracoes"] == "S") {
       $Parms_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_itens_proc_compra@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "nm_submit_cap('" . $this->Ini->link_form_pub_coloracoes_edit. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_form_pub_coloracoes_edit. "', '" . $Md5_Lig . "')", "fldedt_coloracao_id", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_coloracao_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_coloracao_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['item_estacao']))
   {
       $this->nm_new_label['item_estacao'] = "Estação Item/Container";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $item_estacao = $this->item_estacao;
   $sStyleHidden_item_estacao = '';
   if (isset($this->nmgp_cmp_hidden['item_estacao']) && $this->nmgp_cmp_hidden['item_estacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['item_estacao']);
       $sStyleHidden_item_estacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_item_estacao = 'display: none;';
   $sStyleReadInp_item_estacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['item_estacao']) && $this->nmgp_cmp_readonly['item_estacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['item_estacao']);
       $sStyleReadLab_item_estacao = '';
       $sStyleReadInp_item_estacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['item_estacao']) && $this->nmgp_cmp_hidden['item_estacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="item_estacao" value="<?php echo $this->form_encode_input($this->item_estacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_item_estacao" style="<?php echo $sStyleHidden_item_estacao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_item_estacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_item_estacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_item_estacao"><?php echo $this->nm_new_label['item_estacao']; ?></span></td></tr><tr><td class="css_item_estacao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["item_estacao"]) &&  $this->nmgp_cmp_readonly["item_estacao"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'] = array(); 
    }

   $old_value_proc_compra_id = $this->proc_compra_id;
   $old_value_item_proc_compra_id = $this->item_proc_compra_id;
   $old_value_vl_custo_dolar = $this->vl_custo_dolar;
   $old_value_vl_base_tributacao = $this->vl_base_tributacao;
   $old_value_qt_comprada = $this->qt_comprada;
   $old_value_vl_cubagem = $this->vl_cubagem;
   $old_value_calc_gm = $this->calc_gm;
   $old_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $old_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $old_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $old_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $old_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $old_value_dt_mostruario = $this->dt_mostruario;
   $old_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $old_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $old_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $old_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $old_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $old_value_qt_dias_producao = $this->qt_dias_producao;
   $old_value_dt_maxima_producao = $this->dt_maxima_producao;
   $old_value_dt_termino_producao = $this->dt_termino_producao;
   $old_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $old_value_vl_negociado = $this->vl_negociado;
   $old_value_dt_it_certif = $this->dt_it_certif;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_proc_compra_id = $this->proc_compra_id;
   $unformatted_value_item_proc_compra_id = $this->item_proc_compra_id;
   $unformatted_value_vl_custo_dolar = $this->vl_custo_dolar;
   $unformatted_value_vl_base_tributacao = $this->vl_base_tributacao;
   $unformatted_value_qt_comprada = $this->qt_comprada;
   $unformatted_value_vl_cubagem = $this->vl_cubagem;
   $unformatted_value_calc_gm = $this->calc_gm;
   $unformatted_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $unformatted_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $unformatted_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $unformatted_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $unformatted_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $unformatted_value_dt_mostruario = $this->dt_mostruario;
   $unformatted_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $unformatted_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $unformatted_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $unformatted_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $unformatted_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $unformatted_value_qt_dias_producao = $this->qt_dias_producao;
   $unformatted_value_dt_maxima_producao = $this->dt_maxima_producao;
   $unformatted_value_dt_termino_producao = $this->dt_termino_producao;
   $unformatted_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $unformatted_value_vl_negociado = $this->vl_negociado;
   $unformatted_value_dt_it_certif = $this->dt_it_certif;

   $nm_comando = "SELECT cod_opcao, desc_opcao  FROM PUB.opcoes_lista WHERE PUB.opcoes_lista.lista_id = 15  ORDER BY desc_opcao";

   $this->proc_compra_id = $old_value_proc_compra_id;
   $this->item_proc_compra_id = $old_value_item_proc_compra_id;
   $this->vl_custo_dolar = $old_value_vl_custo_dolar;
   $this->vl_base_tributacao = $old_value_vl_base_tributacao;
   $this->qt_comprada = $old_value_qt_comprada;
   $this->vl_cubagem = $old_value_vl_cubagem;
   $this->calc_gm = $old_value_calc_gm;
   $this->dt_prev_envio_desenhos = $old_value_dt_prev_envio_desenhos;
   $this->dt_real_envio_desenhos = $old_value_dt_real_envio_desenhos;
   $this->dt_recbto_laudo = $old_value_dt_recbto_laudo;
   $this->dt_recbto_embalagem = $old_value_dt_recbto_embalagem;
   $this->dt_cheg_amostras_emb = $old_value_dt_cheg_amostras_emb;
   $this->dt_mostruario = $old_value_dt_mostruario;
   $this->dt_prev_recbto_so_ld = $old_value_dt_prev_recbto_so_ld;
   $this->dt_prev_aprov_so_ld = $old_value_dt_prev_aprov_so_ld;
   $this->dt_real_aprov_so_ld = $old_value_dt_real_aprov_so_ld;
   $this->qt_dias_calc_so_ld = $old_value_qt_dias_calc_so_ld;
   $this->dt_real_recbto_so_ld = $old_value_dt_real_recbto_so_ld;
   $this->qt_dias_producao = $old_value_qt_dias_producao;
   $this->dt_maxima_producao = $old_value_dt_maxima_producao;
   $this->dt_termino_producao = $old_value_dt_termino_producao;
   $this->dt_prev_termino_producao = $old_value_dt_prev_termino_producao;
   $this->vl_negociado = $old_value_vl_negociado;
   $this->dt_it_certif = $old_value_dt_it_certif;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Ini->nm_db_espec->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'][] = $rs->fields[0];
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
   $item_estacao_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->item_estacao_1))
          {
              foreach ($this->item_estacao_1 as $tmp_item_estacao)
              {
                  if (trim($tmp_item_estacao) === trim($cadaselect[1])) {$item_estacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->item_estacao) && trim($this->item_estacao) === trim($cadaselect[1])) {$item_estacao_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="item_estacao" value="<?php echo $this->form_encode_input($item_estacao) . "\">" . $item_estacao_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_item_estacao();
   $x = 0 ; 
   $item_estacao_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->item_estacao_1))
          {
              foreach ($this->item_estacao_1 as $tmp_item_estacao)
              {
                  if (trim($tmp_item_estacao) === trim($cadaselect[1])) {$item_estacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->item_estacao)) {
                 if (trim($this->item_estacao) == trim($cadaselect[1])) { $item_estacao_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->item_estacao == $cadaselect[1]) { $item_estacao_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($item_estacao_look))
          {
              $item_estacao_look = $this->item_estacao;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_item_estacao\" class=\"css_item_estacao_line\" style=\"" .  $sStyleReadLab_item_estacao . "\">" . $this->form_format_readonly("item_estacao", $this->form_encode_input($item_estacao_look)) . "</span><span id=\"id_read_off_item_estacao\" class=\"css_read_off_item_estacao" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_item_estacao . "\">";
   echo " <span id=\"idAjaxSelect_item_estacao\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_item_estacao_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_item_estacao\" name=\"item_estacao\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_item_estacao'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","--Selecione--") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->item_estacao) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->item_estacao)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_item_estacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_item_estacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['formato_amostra_id']))
   {
       $this->nm_new_label['formato_amostra_id'] = "Formato Amostra ";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $formato_amostra_id = $this->formato_amostra_id;
   $sStyleHidden_formato_amostra_id = '';
   if (isset($this->nmgp_cmp_hidden['formato_amostra_id']) && $this->nmgp_cmp_hidden['formato_amostra_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['formato_amostra_id']);
       $sStyleHidden_formato_amostra_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_formato_amostra_id = 'display: none;';
   $sStyleReadInp_formato_amostra_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['formato_amostra_id']) && $this->nmgp_cmp_readonly['formato_amostra_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['formato_amostra_id']);
       $sStyleReadLab_formato_amostra_id = '';
       $sStyleReadInp_formato_amostra_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['formato_amostra_id']) && $this->nmgp_cmp_hidden['formato_amostra_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="formato_amostra_id" value="<?php echo $this->form_encode_input($this->formato_amostra_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_formato_amostra_id" style="<?php echo $sStyleHidden_formato_amostra_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_formato_amostra_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_formato_amostra_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_formato_amostra_id"><?php echo $this->nm_new_label['formato_amostra_id']; ?></span></td></tr><tr><td class="css_formato_amostra_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["formato_amostra_id"]) &&  $this->nmgp_cmp_readonly["formato_amostra_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_con_espec['tpbanco']), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'] = array(); 
    }

   $old_value_proc_compra_id = $this->proc_compra_id;
   $old_value_item_proc_compra_id = $this->item_proc_compra_id;
   $old_value_vl_custo_dolar = $this->vl_custo_dolar;
   $old_value_vl_base_tributacao = $this->vl_base_tributacao;
   $old_value_qt_comprada = $this->qt_comprada;
   $old_value_vl_cubagem = $this->vl_cubagem;
   $old_value_calc_gm = $this->calc_gm;
   $old_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $old_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $old_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $old_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $old_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $old_value_dt_mostruario = $this->dt_mostruario;
   $old_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $old_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $old_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $old_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $old_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $old_value_qt_dias_producao = $this->qt_dias_producao;
   $old_value_dt_maxima_producao = $this->dt_maxima_producao;
   $old_value_dt_termino_producao = $this->dt_termino_producao;
   $old_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $old_value_vl_negociado = $this->vl_negociado;
   $old_value_dt_it_certif = $this->dt_it_certif;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_proc_compra_id = $this->proc_compra_id;
   $unformatted_value_item_proc_compra_id = $this->item_proc_compra_id;
   $unformatted_value_vl_custo_dolar = $this->vl_custo_dolar;
   $unformatted_value_vl_base_tributacao = $this->vl_base_tributacao;
   $unformatted_value_qt_comprada = $this->qt_comprada;
   $unformatted_value_vl_cubagem = $this->vl_cubagem;
   $unformatted_value_calc_gm = $this->calc_gm;
   $unformatted_value_dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $unformatted_value_dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $unformatted_value_dt_recbto_laudo = $this->dt_recbto_laudo;
   $unformatted_value_dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $unformatted_value_dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $unformatted_value_dt_mostruario = $this->dt_mostruario;
   $unformatted_value_dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $unformatted_value_dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $unformatted_value_dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $unformatted_value_qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $unformatted_value_dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $unformatted_value_qt_dias_producao = $this->qt_dias_producao;
   $unformatted_value_dt_maxima_producao = $this->dt_maxima_producao;
   $unformatted_value_dt_termino_producao = $this->dt_termino_producao;
   $unformatted_value_dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $unformatted_value_vl_negociado = $this->vl_negociado;
   $unformatted_value_dt_it_certif = $this->dt_it_certif;

   $nm_comando = "SELECT formato_amostra_id, descricao  FROM PUB.formatos_amostra  ORDER BY descricao";

   $this->proc_compra_id = $old_value_proc_compra_id;
   $this->item_proc_compra_id = $old_value_item_proc_compra_id;
   $this->vl_custo_dolar = $old_value_vl_custo_dolar;
   $this->vl_base_tributacao = $old_value_vl_base_tributacao;
   $this->qt_comprada = $old_value_qt_comprada;
   $this->vl_cubagem = $old_value_vl_cubagem;
   $this->calc_gm = $old_value_calc_gm;
   $this->dt_prev_envio_desenhos = $old_value_dt_prev_envio_desenhos;
   $this->dt_real_envio_desenhos = $old_value_dt_real_envio_desenhos;
   $this->dt_recbto_laudo = $old_value_dt_recbto_laudo;
   $this->dt_recbto_embalagem = $old_value_dt_recbto_embalagem;
   $this->dt_cheg_amostras_emb = $old_value_dt_cheg_amostras_emb;
   $this->dt_mostruario = $old_value_dt_mostruario;
   $this->dt_prev_recbto_so_ld = $old_value_dt_prev_recbto_so_ld;
   $this->dt_prev_aprov_so_ld = $old_value_dt_prev_aprov_so_ld;
   $this->dt_real_aprov_so_ld = $old_value_dt_real_aprov_so_ld;
   $this->qt_dias_calc_so_ld = $old_value_qt_dias_calc_so_ld;
   $this->dt_real_recbto_so_ld = $old_value_dt_real_recbto_so_ld;
   $this->qt_dias_producao = $old_value_qt_dias_producao;
   $this->dt_maxima_producao = $old_value_dt_maxima_producao;
   $this->dt_termino_producao = $old_value_dt_termino_producao;
   $this->dt_prev_termino_producao = $old_value_dt_prev_termino_producao;
   $this->vl_negociado = $old_value_vl_negociado;
   $this->dt_it_certif = $old_value_dt_it_certif;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'][] = $rs->fields[0];
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
   $formato_amostra_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->formato_amostra_id_1))
          {
              foreach ($this->formato_amostra_id_1 as $tmp_formato_amostra_id)
              {
                  if (trim($tmp_formato_amostra_id) === trim($cadaselect[1])) {$formato_amostra_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->formato_amostra_id) && trim($this->formato_amostra_id) === trim($cadaselect[1])) {$formato_amostra_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="formato_amostra_id" value="<?php echo $this->form_encode_input($formato_amostra_id) . "\">" . $formato_amostra_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_formato_amostra_id();
   $x = 0 ; 
   $formato_amostra_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->formato_amostra_id_1))
          {
              foreach ($this->formato_amostra_id_1 as $tmp_formato_amostra_id)
              {
                  if (trim($tmp_formato_amostra_id) === trim($cadaselect[1])) {$formato_amostra_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->formato_amostra_id)) {
                 if (trim($this->formato_amostra_id) == trim($cadaselect[1])) { $formato_amostra_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->formato_amostra_id == $cadaselect[1]) { $formato_amostra_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($formato_amostra_id_look))
          {
              $formato_amostra_id_look = $this->formato_amostra_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_formato_amostra_id\" class=\"css_formato_amostra_id_line\" style=\"" .  $sStyleReadLab_formato_amostra_id . "\">" . $this->form_format_readonly("formato_amostra_id", $this->form_encode_input($formato_amostra_id_look)) . "</span><span id=\"id_read_off_formato_amostra_id\" class=\"css_read_off_formato_amostra_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_formato_amostra_id . "\">";
   echo " <span id=\"idAjaxSelect_formato_amostra_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_formato_amostra_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_formato_amostra_id\" name=\"formato_amostra_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_formato_amostra_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->formato_amostra_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->formato_amostra_id)) 
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
   if (isset($this->Ini->sc_lig_md5["form_pub_formatos_amostra"]) && $this->Ini->sc_lig_md5["form_pub_formatos_amostra"] == "S") {
       $Parms_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_itens_proc_compra@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id*scoutnmgp_url_saida*scin*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "nm_submit_cap('" . $this->Ini->link_form_pub_formatos_amostra_edit. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_form_pub_formatos_amostra_edit. "', '" . $Md5_Lig . "')", "fldedt_formato_amostra_id", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_formato_amostra_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_formato_amostra_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_formato_amostra_id_dumb = ('' == $sStyleHidden_formato_amostra_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_formato_amostra_id_dumb" style="<?php echo $sStyleHidden_formato_amostra_id_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_mostruario']))
   {
       $this->nm_new_label['log_mostruario'] = "Controla Data Mostruário?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_mostruario = $this->log_mostruario;
   $sStyleHidden_log_mostruario = '';
   if (isset($this->nmgp_cmp_hidden['log_mostruario']) && $this->nmgp_cmp_hidden['log_mostruario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_mostruario']);
       $sStyleHidden_log_mostruario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_mostruario = 'display: none;';
   $sStyleReadInp_log_mostruario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_mostruario']) && $this->nmgp_cmp_readonly['log_mostruario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_mostruario']);
       $sStyleReadLab_log_mostruario = '';
       $sStyleReadInp_log_mostruario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_mostruario']) && $this->nmgp_cmp_hidden['log_mostruario'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_mostruario" value="<?php echo $this->form_encode_input($this->log_mostruario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_log_mostruario" style="<?php echo $sStyleHidden_log_mostruario; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_mostruario_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_mostruario_label" style=" padding: 0px; width: 100%;"><span id="id_label_log_mostruario"><?php echo $this->nm_new_label['log_mostruario']; ?></span></td></tr><tr><td class="css_log_mostruario_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_mostruario"]) &&  $this->nmgp_cmp_readonly["log_mostruario"] == "on") { 

$log_mostruario_look = "";
 if ($this->log_mostruario == "1") { $log_mostruario_look .= "Sim" ;} 
 if ($this->log_mostruario == "0") { $log_mostruario_look .= "Não" ;} 
 if (empty($log_mostruario_look)) { $log_mostruario_look = $this->log_mostruario; }
?>
<input type="hidden" name="log_mostruario" value="<?php echo $this->form_encode_input($log_mostruario) . "\">" . $log_mostruario_look . ""; ?>
<?php } else { ?>
<?php

$log_mostruario_look = "";
 if ($this->log_mostruario == "1") { $log_mostruario_look .= "Sim" ;} 
 if ($this->log_mostruario == "0") { $log_mostruario_look .= "Não" ;} 
 if (empty($log_mostruario_look)) { $log_mostruario_look = $this->log_mostruario; }
?>
<span id="id_read_on_log_mostruario" class="css_log_mostruario_line"  style="<?php echo $sStyleReadLab_log_mostruario; ?>"><?php echo $this->form_format_readonly("log_mostruario", $this->form_encode_input($log_mostruario_look)); ?></span><span id="id_read_off_log_mostruario" class="css_read_off_log_mostruario<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_mostruario; ?>">
 <span id="idAjaxSelect_log_mostruario" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_mostruario_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_mostruario" name="log_mostruario" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_mostruario'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->log_mostruario == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_mostruario'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_mostruario == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_mostruario'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_mostruario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_mostruario_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['ind_laudo_antes_embarque']))
   {
       $this->nm_new_label['ind_laudo_antes_embarque'] = "Envio de Laudo Antes do Embarque?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_laudo_antes_embarque = $this->ind_laudo_antes_embarque;
   $sStyleHidden_ind_laudo_antes_embarque = '';
   if (isset($this->nmgp_cmp_hidden['ind_laudo_antes_embarque']) && $this->nmgp_cmp_hidden['ind_laudo_antes_embarque'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_laudo_antes_embarque']);
       $sStyleHidden_ind_laudo_antes_embarque = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_laudo_antes_embarque = 'display: none;';
   $sStyleReadInp_ind_laudo_antes_embarque = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_laudo_antes_embarque']) && $this->nmgp_cmp_readonly['ind_laudo_antes_embarque'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_laudo_antes_embarque']);
       $sStyleReadLab_ind_laudo_antes_embarque = '';
       $sStyleReadInp_ind_laudo_antes_embarque = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_laudo_antes_embarque']) && $this->nmgp_cmp_hidden['ind_laudo_antes_embarque'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_laudo_antes_embarque" value="<?php echo $this->form_encode_input($this->ind_laudo_antes_embarque) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_laudo_antes_embarque" style="<?php echo $sStyleHidden_ind_laudo_antes_embarque; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_laudo_antes_embarque_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_laudo_antes_embarque_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_laudo_antes_embarque"><?php echo $this->nm_new_label['ind_laudo_antes_embarque']; ?></span></td></tr><tr><td class="css_ind_laudo_antes_embarque_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_laudo_antes_embarque"]) &&  $this->nmgp_cmp_readonly["ind_laudo_antes_embarque"] == "on") { 

$ind_laudo_antes_embarque_look = "";
 if ($this->ind_laudo_antes_embarque == "0") { $ind_laudo_antes_embarque_look .= "Não Informado" ;} 
 if ($this->ind_laudo_antes_embarque == "1") { $ind_laudo_antes_embarque_look .= "Sim" ;} 
 if ($this->ind_laudo_antes_embarque == "2") { $ind_laudo_antes_embarque_look .= "Não" ;} 
 if (empty($ind_laudo_antes_embarque_look)) { $ind_laudo_antes_embarque_look = $this->ind_laudo_antes_embarque; }
?>
<input type="hidden" name="ind_laudo_antes_embarque" value="<?php echo $this->form_encode_input($ind_laudo_antes_embarque) . "\">" . $ind_laudo_antes_embarque_look . ""; ?>
<?php } else { ?>
<?php

$ind_laudo_antes_embarque_look = "";
 if ($this->ind_laudo_antes_embarque == "0") { $ind_laudo_antes_embarque_look .= "Não Informado" ;} 
 if ($this->ind_laudo_antes_embarque == "1") { $ind_laudo_antes_embarque_look .= "Sim" ;} 
 if ($this->ind_laudo_antes_embarque == "2") { $ind_laudo_antes_embarque_look .= "Não" ;} 
 if (empty($ind_laudo_antes_embarque_look)) { $ind_laudo_antes_embarque_look = $this->ind_laudo_antes_embarque; }
?>
<span id="id_read_on_ind_laudo_antes_embarque" class="css_ind_laudo_antes_embarque_line"  style="<?php echo $sStyleReadLab_ind_laudo_antes_embarque; ?>"><?php echo $this->form_format_readonly("ind_laudo_antes_embarque", $this->form_encode_input($ind_laudo_antes_embarque_look)); ?></span><span id="id_read_off_ind_laudo_antes_embarque" class="css_read_off_ind_laudo_antes_embarque<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_laudo_antes_embarque; ?>">
 <span id="idAjaxSelect_ind_laudo_antes_embarque" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_laudo_antes_embarque_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_laudo_antes_embarque" name="ind_laudo_antes_embarque" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_laudo_antes_embarque == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_laudo_antes_embarque'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_laudo_antes_embarque == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_laudo_antes_embarque'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_laudo_antes_embarque == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_laudo_antes_embarque'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_laudo_antes_embarque_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_laudo_antes_embarque_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_log_mostruario_dumb = ('' == $sStyleHidden_log_mostruario) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_mostruario_dumb" style="<?php echo $sStyleHidden_log_mostruario_dumb; ?>"></TD>
<?php $sStyleHidden_ind_laudo_antes_embarque_dumb = ('' == $sStyleHidden_ind_laudo_antes_embarque) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_laudo_antes_embarque_dumb" style="<?php echo $sStyleHidden_ind_laudo_antes_embarque_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_qualid_emb']))
   {
       $this->nm_new_label['ind_qualid_emb'] = "Recbto da  Embalagem Conforme  nossa qualidade padrão ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_qualid_emb = $this->ind_qualid_emb;
   $sStyleHidden_ind_qualid_emb = '';
   if (isset($this->nmgp_cmp_hidden['ind_qualid_emb']) && $this->nmgp_cmp_hidden['ind_qualid_emb'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_qualid_emb']);
       $sStyleHidden_ind_qualid_emb = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_qualid_emb = 'display: none;';
   $sStyleReadInp_ind_qualid_emb = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_qualid_emb']) && $this->nmgp_cmp_readonly['ind_qualid_emb'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_qualid_emb']);
       $sStyleReadLab_ind_qualid_emb = '';
       $sStyleReadInp_ind_qualid_emb = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_qualid_emb']) && $this->nmgp_cmp_hidden['ind_qualid_emb'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_qualid_emb" value="<?php echo $this->form_encode_input($this->ind_qualid_emb) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_qualid_emb" style="<?php echo $sStyleHidden_ind_qualid_emb; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_qualid_emb_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_qualid_emb_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_qualid_emb"><?php echo $this->nm_new_label['ind_qualid_emb']; ?></span></td></tr><tr><td class="css_ind_qualid_emb_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_qualid_emb"]) &&  $this->nmgp_cmp_readonly["ind_qualid_emb"] == "on") { 

$ind_qualid_emb_look = "";
 if ($this->ind_qualid_emb == "0") { $ind_qualid_emb_look .= "Não Informado" ;} 
 if ($this->ind_qualid_emb == "1") { $ind_qualid_emb_look .= "Sim" ;} 
 if ($this->ind_qualid_emb == "2") { $ind_qualid_emb_look .= "Não" ;} 
 if (empty($ind_qualid_emb_look)) { $ind_qualid_emb_look = $this->ind_qualid_emb; }
?>
<input type="hidden" name="ind_qualid_emb" value="<?php echo $this->form_encode_input($ind_qualid_emb) . "\">" . $ind_qualid_emb_look . ""; ?>
<?php } else { ?>
<?php

$ind_qualid_emb_look = "";
 if ($this->ind_qualid_emb == "0") { $ind_qualid_emb_look .= "Não Informado" ;} 
 if ($this->ind_qualid_emb == "1") { $ind_qualid_emb_look .= "Sim" ;} 
 if ($this->ind_qualid_emb == "2") { $ind_qualid_emb_look .= "Não" ;} 
 if (empty($ind_qualid_emb_look)) { $ind_qualid_emb_look = $this->ind_qualid_emb; }
?>
<span id="id_read_on_ind_qualid_emb" class="css_ind_qualid_emb_line"  style="<?php echo $sStyleReadLab_ind_qualid_emb; ?>"><?php echo $this->form_format_readonly("ind_qualid_emb", $this->form_encode_input($ind_qualid_emb_look)); ?></span><span id="id_read_off_ind_qualid_emb" class="css_read_off_ind_qualid_emb<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_qualid_emb; ?>">
 <span id="idAjaxSelect_ind_qualid_emb" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_qualid_emb_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_qualid_emb" name="ind_qualid_emb" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_qualid_emb == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qualid_emb'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_qualid_emb == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qualid_emb'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_qualid_emb == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qualid_emb'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_qualid_emb_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_qualid_emb_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['ind_prod_conf_pi']))
   {
       $this->nm_new_label['ind_prod_conf_pi'] = "Produção Conforme PL(Laudo)?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_prod_conf_pi = $this->ind_prod_conf_pi;
   $sStyleHidden_ind_prod_conf_pi = '';
   if (isset($this->nmgp_cmp_hidden['ind_prod_conf_pi']) && $this->nmgp_cmp_hidden['ind_prod_conf_pi'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_prod_conf_pi']);
       $sStyleHidden_ind_prod_conf_pi = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_prod_conf_pi = 'display: none;';
   $sStyleReadInp_ind_prod_conf_pi = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_prod_conf_pi']) && $this->nmgp_cmp_readonly['ind_prod_conf_pi'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_prod_conf_pi']);
       $sStyleReadLab_ind_prod_conf_pi = '';
       $sStyleReadInp_ind_prod_conf_pi = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_prod_conf_pi']) && $this->nmgp_cmp_hidden['ind_prod_conf_pi'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_prod_conf_pi" value="<?php echo $this->form_encode_input($this->ind_prod_conf_pi) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_prod_conf_pi" style="<?php echo $sStyleHidden_ind_prod_conf_pi; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_prod_conf_pi_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_prod_conf_pi_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_prod_conf_pi"><?php echo $this->nm_new_label['ind_prod_conf_pi']; ?></span></td></tr><tr><td class="css_ind_prod_conf_pi_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_prod_conf_pi"]) &&  $this->nmgp_cmp_readonly["ind_prod_conf_pi"] == "on") { 

$ind_prod_conf_pi_look = "";
 if ($this->ind_prod_conf_pi == "0") { $ind_prod_conf_pi_look .= "Não Informado" ;} 
 if ($this->ind_prod_conf_pi == "1") { $ind_prod_conf_pi_look .= "Sim" ;} 
 if ($this->ind_prod_conf_pi == "2") { $ind_prod_conf_pi_look .= "Não" ;} 
 if (empty($ind_prod_conf_pi_look)) { $ind_prod_conf_pi_look = $this->ind_prod_conf_pi; }
?>
<input type="hidden" name="ind_prod_conf_pi" value="<?php echo $this->form_encode_input($ind_prod_conf_pi) . "\">" . $ind_prod_conf_pi_look . ""; ?>
<?php } else { ?>
<?php

$ind_prod_conf_pi_look = "";
 if ($this->ind_prod_conf_pi == "0") { $ind_prod_conf_pi_look .= "Não Informado" ;} 
 if ($this->ind_prod_conf_pi == "1") { $ind_prod_conf_pi_look .= "Sim" ;} 
 if ($this->ind_prod_conf_pi == "2") { $ind_prod_conf_pi_look .= "Não" ;} 
 if (empty($ind_prod_conf_pi_look)) { $ind_prod_conf_pi_look = $this->ind_prod_conf_pi; }
?>
<span id="id_read_on_ind_prod_conf_pi" class="css_ind_prod_conf_pi_line"  style="<?php echo $sStyleReadLab_ind_prod_conf_pi; ?>"><?php echo $this->form_format_readonly("ind_prod_conf_pi", $this->form_encode_input($ind_prod_conf_pi_look)); ?></span><span id="id_read_off_ind_prod_conf_pi" class="css_read_off_ind_prod_conf_pi<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_prod_conf_pi; ?>">
 <span id="idAjaxSelect_ind_prod_conf_pi" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_prod_conf_pi_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_prod_conf_pi" name="ind_prod_conf_pi" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_prod_conf_pi == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_prod_conf_pi'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_prod_conf_pi == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_prod_conf_pi'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_prod_conf_pi == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_prod_conf_pi'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_prod_conf_pi_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_prod_conf_pi_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_ind_qualid_emb_dumb = ('' == $sStyleHidden_ind_qualid_emb) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_qualid_emb_dumb" style="<?php echo $sStyleHidden_ind_qualid_emb_dumb; ?>"></TD>
<?php $sStyleHidden_ind_prod_conf_pi_dumb = ('' == $sStyleHidden_ind_prod_conf_pi) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_prod_conf_pi_dumb" style="<?php echo $sStyleHidden_ind_prod_conf_pi_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_rec_amostra_antes_emb']))
   {
       $this->nm_new_label['ind_rec_amostra_antes_emb'] = "Recbto Amostras Antes do Embarque?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_rec_amostra_antes_emb = $this->ind_rec_amostra_antes_emb;
   $sStyleHidden_ind_rec_amostra_antes_emb = '';
   if (isset($this->nmgp_cmp_hidden['ind_rec_amostra_antes_emb']) && $this->nmgp_cmp_hidden['ind_rec_amostra_antes_emb'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_rec_amostra_antes_emb']);
       $sStyleHidden_ind_rec_amostra_antes_emb = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_rec_amostra_antes_emb = 'display: none;';
   $sStyleReadInp_ind_rec_amostra_antes_emb = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_rec_amostra_antes_emb']) && $this->nmgp_cmp_readonly['ind_rec_amostra_antes_emb'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_rec_amostra_antes_emb']);
       $sStyleReadLab_ind_rec_amostra_antes_emb = '';
       $sStyleReadInp_ind_rec_amostra_antes_emb = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_rec_amostra_antes_emb']) && $this->nmgp_cmp_hidden['ind_rec_amostra_antes_emb'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_rec_amostra_antes_emb" value="<?php echo $this->form_encode_input($this->ind_rec_amostra_antes_emb) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_rec_amostra_antes_emb" style="<?php echo $sStyleHidden_ind_rec_amostra_antes_emb; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_rec_amostra_antes_emb_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_rec_amostra_antes_emb_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_rec_amostra_antes_emb"><?php echo $this->nm_new_label['ind_rec_amostra_antes_emb']; ?></span></td></tr><tr><td class="css_ind_rec_amostra_antes_emb_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_rec_amostra_antes_emb"]) &&  $this->nmgp_cmp_readonly["ind_rec_amostra_antes_emb"] == "on") { 

$ind_rec_amostra_antes_emb_look = "";
 if ($this->ind_rec_amostra_antes_emb == "0") { $ind_rec_amostra_antes_emb_look .= "Não Informado" ;} 
 if ($this->ind_rec_amostra_antes_emb == "1") { $ind_rec_amostra_antes_emb_look .= "Sim" ;} 
 if ($this->ind_rec_amostra_antes_emb == "2") { $ind_rec_amostra_antes_emb_look .= "Não" ;} 
 if (empty($ind_rec_amostra_antes_emb_look)) { $ind_rec_amostra_antes_emb_look = $this->ind_rec_amostra_antes_emb; }
?>
<input type="hidden" name="ind_rec_amostra_antes_emb" value="<?php echo $this->form_encode_input($ind_rec_amostra_antes_emb) . "\">" . $ind_rec_amostra_antes_emb_look . ""; ?>
<?php } else { ?>
<?php

$ind_rec_amostra_antes_emb_look = "";
 if ($this->ind_rec_amostra_antes_emb == "0") { $ind_rec_amostra_antes_emb_look .= "Não Informado" ;} 
 if ($this->ind_rec_amostra_antes_emb == "1") { $ind_rec_amostra_antes_emb_look .= "Sim" ;} 
 if ($this->ind_rec_amostra_antes_emb == "2") { $ind_rec_amostra_antes_emb_look .= "Não" ;} 
 if (empty($ind_rec_amostra_antes_emb_look)) { $ind_rec_amostra_antes_emb_look = $this->ind_rec_amostra_antes_emb; }
?>
<span id="id_read_on_ind_rec_amostra_antes_emb" class="css_ind_rec_amostra_antes_emb_line"  style="<?php echo $sStyleReadLab_ind_rec_amostra_antes_emb; ?>"><?php echo $this->form_format_readonly("ind_rec_amostra_antes_emb", $this->form_encode_input($ind_rec_amostra_antes_emb_look)); ?></span><span id="id_read_off_ind_rec_amostra_antes_emb" class="css_read_off_ind_rec_amostra_antes_emb<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_rec_amostra_antes_emb; ?>">
 <span id="idAjaxSelect_ind_rec_amostra_antes_emb" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_rec_amostra_antes_emb_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_rec_amostra_antes_emb" name="ind_rec_amostra_antes_emb" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_rec_amostra_antes_emb == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_rec_amostra_antes_emb'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_rec_amostra_antes_emb == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_rec_amostra_antes_emb'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_rec_amostra_antes_emb == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_rec_amostra_antes_emb'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_rec_amostra_antes_emb_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_rec_amostra_antes_emb_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['ind_qt_conf_proforma']))
   {
       $this->nm_new_label['ind_qt_conf_proforma'] = "Quantidade Conforme Pró-forma ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_qt_conf_proforma = $this->ind_qt_conf_proforma;
   $sStyleHidden_ind_qt_conf_proforma = '';
   if (isset($this->nmgp_cmp_hidden['ind_qt_conf_proforma']) && $this->nmgp_cmp_hidden['ind_qt_conf_proforma'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_qt_conf_proforma']);
       $sStyleHidden_ind_qt_conf_proforma = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_qt_conf_proforma = 'display: none;';
   $sStyleReadInp_ind_qt_conf_proforma = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_qt_conf_proforma']) && $this->nmgp_cmp_readonly['ind_qt_conf_proforma'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_qt_conf_proforma']);
       $sStyleReadLab_ind_qt_conf_proforma = '';
       $sStyleReadInp_ind_qt_conf_proforma = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_qt_conf_proforma']) && $this->nmgp_cmp_hidden['ind_qt_conf_proforma'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_qt_conf_proforma" value="<?php echo $this->form_encode_input($this->ind_qt_conf_proforma) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_qt_conf_proforma" style="<?php echo $sStyleHidden_ind_qt_conf_proforma; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_qt_conf_proforma_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_qt_conf_proforma_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_qt_conf_proforma"><?php echo $this->nm_new_label['ind_qt_conf_proforma']; ?></span></td></tr><tr><td class="css_ind_qt_conf_proforma_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_qt_conf_proforma"]) &&  $this->nmgp_cmp_readonly["ind_qt_conf_proforma"] == "on") { 

$ind_qt_conf_proforma_look = "";
 if ($this->ind_qt_conf_proforma == "0") { $ind_qt_conf_proforma_look .= "Não Informado" ;} 
 if ($this->ind_qt_conf_proforma == "1") { $ind_qt_conf_proforma_look .= "Sim" ;} 
 if ($this->ind_qt_conf_proforma == "2") { $ind_qt_conf_proforma_look .= "Não" ;} 
 if (empty($ind_qt_conf_proforma_look)) { $ind_qt_conf_proforma_look = $this->ind_qt_conf_proforma; }
?>
<input type="hidden" name="ind_qt_conf_proforma" value="<?php echo $this->form_encode_input($ind_qt_conf_proforma) . "\">" . $ind_qt_conf_proforma_look . ""; ?>
<?php } else { ?>
<?php

$ind_qt_conf_proforma_look = "";
 if ($this->ind_qt_conf_proforma == "0") { $ind_qt_conf_proforma_look .= "Não Informado" ;} 
 if ($this->ind_qt_conf_proforma == "1") { $ind_qt_conf_proforma_look .= "Sim" ;} 
 if ($this->ind_qt_conf_proforma == "2") { $ind_qt_conf_proforma_look .= "Não" ;} 
 if (empty($ind_qt_conf_proforma_look)) { $ind_qt_conf_proforma_look = $this->ind_qt_conf_proforma; }
?>
<span id="id_read_on_ind_qt_conf_proforma" class="css_ind_qt_conf_proforma_line"  style="<?php echo $sStyleReadLab_ind_qt_conf_proforma; ?>"><?php echo $this->form_format_readonly("ind_qt_conf_proforma", $this->form_encode_input($ind_qt_conf_proforma_look)); ?></span><span id="id_read_off_ind_qt_conf_proforma" class="css_read_off_ind_qt_conf_proforma<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_qt_conf_proforma; ?>">
 <span id="idAjaxSelect_ind_qt_conf_proforma" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_qt_conf_proforma_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_qt_conf_proforma" name="ind_qt_conf_proforma" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_qt_conf_proforma == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qt_conf_proforma'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_qt_conf_proforma == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qt_conf_proforma'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_qt_conf_proforma == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_qt_conf_proforma'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_qt_conf_proforma_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_qt_conf_proforma_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_ind_rec_amostra_antes_emb_dumb = ('' == $sStyleHidden_ind_rec_amostra_antes_emb) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_rec_amostra_antes_emb_dumb" style="<?php echo $sStyleHidden_ind_rec_amostra_antes_emb_dumb; ?>"></TD>
<?php $sStyleHidden_ind_qt_conf_proforma_dumb = ('' == $sStyleHidden_ind_qt_conf_proforma) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_qt_conf_proforma_dumb" style="<?php echo $sStyleHidden_ind_qt_conf_proforma_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_tamanho_pecas_correto']))
   {
       $this->nm_new_label['ind_tamanho_pecas_correto'] = "Tamanho de Peças De acordo com o Solicitado?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_tamanho_pecas_correto = $this->ind_tamanho_pecas_correto;
   $sStyleHidden_ind_tamanho_pecas_correto = '';
   if (isset($this->nmgp_cmp_hidden['ind_tamanho_pecas_correto']) && $this->nmgp_cmp_hidden['ind_tamanho_pecas_correto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_tamanho_pecas_correto']);
       $sStyleHidden_ind_tamanho_pecas_correto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_tamanho_pecas_correto = 'display: none;';
   $sStyleReadInp_ind_tamanho_pecas_correto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_tamanho_pecas_correto']) && $this->nmgp_cmp_readonly['ind_tamanho_pecas_correto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_tamanho_pecas_correto']);
       $sStyleReadLab_ind_tamanho_pecas_correto = '';
       $sStyleReadInp_ind_tamanho_pecas_correto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_tamanho_pecas_correto']) && $this->nmgp_cmp_hidden['ind_tamanho_pecas_correto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_tamanho_pecas_correto" value="<?php echo $this->form_encode_input($this->ind_tamanho_pecas_correto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_tamanho_pecas_correto" style="<?php echo $sStyleHidden_ind_tamanho_pecas_correto; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_tamanho_pecas_correto_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_tamanho_pecas_correto_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_tamanho_pecas_correto"><?php echo $this->nm_new_label['ind_tamanho_pecas_correto']; ?></span></td></tr><tr><td class="css_ind_tamanho_pecas_correto_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_tamanho_pecas_correto"]) &&  $this->nmgp_cmp_readonly["ind_tamanho_pecas_correto"] == "on") { 

$ind_tamanho_pecas_correto_look = "";
 if ($this->ind_tamanho_pecas_correto == "0") { $ind_tamanho_pecas_correto_look .= "Não Informado" ;} 
 if ($this->ind_tamanho_pecas_correto == "1") { $ind_tamanho_pecas_correto_look .= "Sim" ;} 
 if ($this->ind_tamanho_pecas_correto == "2") { $ind_tamanho_pecas_correto_look .= "Não" ;} 
 if (empty($ind_tamanho_pecas_correto_look)) { $ind_tamanho_pecas_correto_look = $this->ind_tamanho_pecas_correto; }
?>
<input type="hidden" name="ind_tamanho_pecas_correto" value="<?php echo $this->form_encode_input($ind_tamanho_pecas_correto) . "\">" . $ind_tamanho_pecas_correto_look . ""; ?>
<?php } else { ?>
<?php

$ind_tamanho_pecas_correto_look = "";
 if ($this->ind_tamanho_pecas_correto == "0") { $ind_tamanho_pecas_correto_look .= "Não Informado" ;} 
 if ($this->ind_tamanho_pecas_correto == "1") { $ind_tamanho_pecas_correto_look .= "Sim" ;} 
 if ($this->ind_tamanho_pecas_correto == "2") { $ind_tamanho_pecas_correto_look .= "Não" ;} 
 if (empty($ind_tamanho_pecas_correto_look)) { $ind_tamanho_pecas_correto_look = $this->ind_tamanho_pecas_correto; }
?>
<span id="id_read_on_ind_tamanho_pecas_correto" class="css_ind_tamanho_pecas_correto_line"  style="<?php echo $sStyleReadLab_ind_tamanho_pecas_correto; ?>"><?php echo $this->form_format_readonly("ind_tamanho_pecas_correto", $this->form_encode_input($ind_tamanho_pecas_correto_look)); ?></span><span id="id_read_off_ind_tamanho_pecas_correto" class="css_read_off_ind_tamanho_pecas_correto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_tamanho_pecas_correto; ?>">
 <span id="idAjaxSelect_ind_tamanho_pecas_correto" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_tamanho_pecas_correto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_tamanho_pecas_correto" name="ind_tamanho_pecas_correto" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_tamanho_pecas_correto == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_tamanho_pecas_correto'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_tamanho_pecas_correto == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_tamanho_pecas_correto'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_tamanho_pecas_correto == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_tamanho_pecas_correto'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_tamanho_pecas_correto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_tamanho_pecas_correto_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

    <TD class="scFormDataOdd" colspan="1" >&nbsp;</TD>




<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } ?>
<?php $sStyleHidden_ind_tamanho_pecas_correto_dumb = ('' == $sStyleHidden_ind_tamanho_pecas_correto) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_tamanho_pecas_correto_dumb" style="<?php echo $sStyleHidden_ind_tamanho_pecas_correto_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_3"></a>
<div id="div_hidden_bloco_3" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_prev_envio_desenhos']))
    {
        $this->nm_new_label['dt_prev_envio_desenhos'] = "Dt. Prev. Envio Desenhos";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_envio_desenhos = $this->dt_prev_envio_desenhos;
   $sStyleHidden_dt_prev_envio_desenhos = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_envio_desenhos']) && $this->nmgp_cmp_hidden['dt_prev_envio_desenhos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_envio_desenhos']);
       $sStyleHidden_dt_prev_envio_desenhos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_envio_desenhos = 'display: none;';
   $sStyleReadInp_dt_prev_envio_desenhos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_envio_desenhos']) && $this->nmgp_cmp_readonly['dt_prev_envio_desenhos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_envio_desenhos']);
       $sStyleReadLab_dt_prev_envio_desenhos = '';
       $sStyleReadInp_dt_prev_envio_desenhos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_envio_desenhos']) && $this->nmgp_cmp_hidden['dt_prev_envio_desenhos'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_envio_desenhos" value="<?php echo $this->form_encode_input($dt_prev_envio_desenhos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_envio_desenhos" style="<?php echo $sStyleHidden_dt_prev_envio_desenhos; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_envio_desenhos_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_envio_desenhos_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_prev_envio_desenhos"><?php echo $this->nm_new_label['dt_prev_envio_desenhos']; ?></span></td></tr><tr><td class="css_dt_prev_envio_desenhos_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_envio_desenhos"]) &&  $this->nmgp_cmp_readonly["dt_prev_envio_desenhos"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_envio_desenhos" value="<?php echo $this->form_encode_input($dt_prev_envio_desenhos) . "\">" . $dt_prev_envio_desenhos . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_envio_desenhos" class="sc-ui-readonly-dt_prev_envio_desenhos css_dt_prev_envio_desenhos_line" style="<?php echo $sStyleReadLab_dt_prev_envio_desenhos; ?>"><?php echo $this->form_format_readonly("dt_prev_envio_desenhos", $this->form_encode_input($dt_prev_envio_desenhos)); ?></span><span id="id_read_off_dt_prev_envio_desenhos" class="css_read_off_dt_prev_envio_desenhos<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_envio_desenhos; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_envio_desenhos']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_envio_desenhos_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_envio_desenhos" type=text name="dt_prev_envio_desenhos" value="<?php echo $this->form_encode_input($dt_prev_envio_desenhos) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_envio_desenhos']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_envio_desenhos']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_envio_desenhos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_envio_desenhos_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_real_envio_desenhos']))
    {
        $this->nm_new_label['dt_real_envio_desenhos'] = "Dt. Real Envio Desenhos";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_real_envio_desenhos = $this->dt_real_envio_desenhos;
   $sStyleHidden_dt_real_envio_desenhos = '';
   if (isset($this->nmgp_cmp_hidden['dt_real_envio_desenhos']) && $this->nmgp_cmp_hidden['dt_real_envio_desenhos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_real_envio_desenhos']);
       $sStyleHidden_dt_real_envio_desenhos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_real_envio_desenhos = 'display: none;';
   $sStyleReadInp_dt_real_envio_desenhos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_real_envio_desenhos']) && $this->nmgp_cmp_readonly['dt_real_envio_desenhos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_real_envio_desenhos']);
       $sStyleReadLab_dt_real_envio_desenhos = '';
       $sStyleReadInp_dt_real_envio_desenhos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_real_envio_desenhos']) && $this->nmgp_cmp_hidden['dt_real_envio_desenhos'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_real_envio_desenhos" value="<?php echo $this->form_encode_input($dt_real_envio_desenhos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_envio_desenhos" style="<?php echo $sStyleHidden_dt_real_envio_desenhos; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_real_envio_desenhos_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_real_envio_desenhos_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_real_envio_desenhos"><?php echo $this->nm_new_label['dt_real_envio_desenhos']; ?></span></td></tr><tr><td class="css_dt_real_envio_desenhos_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_real_envio_desenhos"]) &&  $this->nmgp_cmp_readonly["dt_real_envio_desenhos"] == "on") { 

 ?>
<input type="hidden" name="dt_real_envio_desenhos" value="<?php echo $this->form_encode_input($dt_real_envio_desenhos) . "\">" . $dt_real_envio_desenhos . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_real_envio_desenhos" class="sc-ui-readonly-dt_real_envio_desenhos css_dt_real_envio_desenhos_line" style="<?php echo $sStyleReadLab_dt_real_envio_desenhos; ?>"><?php echo $this->form_format_readonly("dt_real_envio_desenhos", $this->form_encode_input($dt_real_envio_desenhos)); ?></span><span id="id_read_off_dt_real_envio_desenhos" class="css_read_off_dt_real_envio_desenhos<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_real_envio_desenhos; ?>"><?php
$tmp_form_data = $this->field_config['dt_real_envio_desenhos']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_real_envio_desenhos_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_real_envio_desenhos" type=text name="dt_real_envio_desenhos" value="<?php echo $this->form_encode_input($dt_real_envio_desenhos) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_real_envio_desenhos']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_real_envio_desenhos']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_real_envio_desenhos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_real_envio_desenhos_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_recbto_laudo']))
    {
        $this->nm_new_label['dt_recbto_laudo'] = "Dt Recbto Laudo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_recbto_laudo = $this->dt_recbto_laudo;
   $sStyleHidden_dt_recbto_laudo = '';
   if (isset($this->nmgp_cmp_hidden['dt_recbto_laudo']) && $this->nmgp_cmp_hidden['dt_recbto_laudo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_recbto_laudo']);
       $sStyleHidden_dt_recbto_laudo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_recbto_laudo = 'display: none;';
   $sStyleReadInp_dt_recbto_laudo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_recbto_laudo']) && $this->nmgp_cmp_readonly['dt_recbto_laudo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_recbto_laudo']);
       $sStyleReadLab_dt_recbto_laudo = '';
       $sStyleReadInp_dt_recbto_laudo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_recbto_laudo']) && $this->nmgp_cmp_hidden['dt_recbto_laudo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_recbto_laudo" value="<?php echo $this->form_encode_input($dt_recbto_laudo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_recbto_laudo" style="<?php echo $sStyleHidden_dt_recbto_laudo; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_recbto_laudo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_recbto_laudo_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_recbto_laudo"><?php echo $this->nm_new_label['dt_recbto_laudo']; ?></span></td></tr><tr><td class="css_dt_recbto_laudo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_recbto_laudo"]) &&  $this->nmgp_cmp_readonly["dt_recbto_laudo"] == "on") { 

 ?>
<input type="hidden" name="dt_recbto_laudo" value="<?php echo $this->form_encode_input($dt_recbto_laudo) . "\">" . $dt_recbto_laudo . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_recbto_laudo" class="sc-ui-readonly-dt_recbto_laudo css_dt_recbto_laudo_line" style="<?php echo $sStyleReadLab_dt_recbto_laudo; ?>"><?php echo $this->form_format_readonly("dt_recbto_laudo", $this->form_encode_input($dt_recbto_laudo)); ?></span><span id="id_read_off_dt_recbto_laudo" class="css_read_off_dt_recbto_laudo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_recbto_laudo; ?>"><?php
$tmp_form_data = $this->field_config['dt_recbto_laudo']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_recbto_laudo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_recbto_laudo" type=text name="dt_recbto_laudo" value="<?php echo $this->form_encode_input($dt_recbto_laudo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_recbto_laudo']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_recbto_laudo']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_recbto_laudo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_recbto_laudo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_dt_prev_envio_desenhos_dumb = ('' == $sStyleHidden_dt_prev_envio_desenhos) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_envio_desenhos_dumb" style="<?php echo $sStyleHidden_dt_prev_envio_desenhos_dumb; ?>"></TD>
<?php $sStyleHidden_dt_real_envio_desenhos_dumb = ('' == $sStyleHidden_dt_real_envio_desenhos) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_envio_desenhos_dumb" style="<?php echo $sStyleHidden_dt_real_envio_desenhos_dumb; ?>"></TD>
<?php $sStyleHidden_dt_recbto_laudo_dumb = ('' == $sStyleHidden_dt_recbto_laudo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_recbto_laudo_dumb" style="<?php echo $sStyleHidden_dt_recbto_laudo_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_recbto_embalagem']))
    {
        $this->nm_new_label['dt_recbto_embalagem'] = "Dt Recbto Embalagem";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_recbto_embalagem = $this->dt_recbto_embalagem;
   $sStyleHidden_dt_recbto_embalagem = '';
   if (isset($this->nmgp_cmp_hidden['dt_recbto_embalagem']) && $this->nmgp_cmp_hidden['dt_recbto_embalagem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_recbto_embalagem']);
       $sStyleHidden_dt_recbto_embalagem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_recbto_embalagem = 'display: none;';
   $sStyleReadInp_dt_recbto_embalagem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_recbto_embalagem']) && $this->nmgp_cmp_readonly['dt_recbto_embalagem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_recbto_embalagem']);
       $sStyleReadLab_dt_recbto_embalagem = '';
       $sStyleReadInp_dt_recbto_embalagem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_recbto_embalagem']) && $this->nmgp_cmp_hidden['dt_recbto_embalagem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_recbto_embalagem" value="<?php echo $this->form_encode_input($dt_recbto_embalagem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_recbto_embalagem" style="<?php echo $sStyleHidden_dt_recbto_embalagem; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_recbto_embalagem_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_recbto_embalagem_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_recbto_embalagem"><?php echo $this->nm_new_label['dt_recbto_embalagem']; ?></span></td></tr><tr><td class="css_dt_recbto_embalagem_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_recbto_embalagem"]) &&  $this->nmgp_cmp_readonly["dt_recbto_embalagem"] == "on") { 

 ?>
<input type="hidden" name="dt_recbto_embalagem" value="<?php echo $this->form_encode_input($dt_recbto_embalagem) . "\">" . $dt_recbto_embalagem . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_recbto_embalagem" class="sc-ui-readonly-dt_recbto_embalagem css_dt_recbto_embalagem_line" style="<?php echo $sStyleReadLab_dt_recbto_embalagem; ?>"><?php echo $this->form_format_readonly("dt_recbto_embalagem", $this->form_encode_input($dt_recbto_embalagem)); ?></span><span id="id_read_off_dt_recbto_embalagem" class="css_read_off_dt_recbto_embalagem<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_recbto_embalagem; ?>"><?php
$tmp_form_data = $this->field_config['dt_recbto_embalagem']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_recbto_embalagem_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_recbto_embalagem" type=text name="dt_recbto_embalagem" value="<?php echo $this->form_encode_input($dt_recbto_embalagem) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_recbto_embalagem']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_recbto_embalagem']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_recbto_embalagem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_recbto_embalagem_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_cheg_amostras_emb']))
    {
        $this->nm_new_label['dt_cheg_amostras_emb'] = "Dt. Cheg. Amostras Embarque";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_cheg_amostras_emb = $this->dt_cheg_amostras_emb;
   $sStyleHidden_dt_cheg_amostras_emb = '';
   if (isset($this->nmgp_cmp_hidden['dt_cheg_amostras_emb']) && $this->nmgp_cmp_hidden['dt_cheg_amostras_emb'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_cheg_amostras_emb']);
       $sStyleHidden_dt_cheg_amostras_emb = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_cheg_amostras_emb = 'display: none;';
   $sStyleReadInp_dt_cheg_amostras_emb = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_cheg_amostras_emb']) && $this->nmgp_cmp_readonly['dt_cheg_amostras_emb'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_cheg_amostras_emb']);
       $sStyleReadLab_dt_cheg_amostras_emb = '';
       $sStyleReadInp_dt_cheg_amostras_emb = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_cheg_amostras_emb']) && $this->nmgp_cmp_hidden['dt_cheg_amostras_emb'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_cheg_amostras_emb" value="<?php echo $this->form_encode_input($dt_cheg_amostras_emb) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_cheg_amostras_emb" style="<?php echo $sStyleHidden_dt_cheg_amostras_emb; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_cheg_amostras_emb_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_cheg_amostras_emb_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_cheg_amostras_emb"><?php echo $this->nm_new_label['dt_cheg_amostras_emb']; ?></span></td></tr><tr><td class="css_dt_cheg_amostras_emb_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_cheg_amostras_emb"]) &&  $this->nmgp_cmp_readonly["dt_cheg_amostras_emb"] == "on") { 

 ?>
<input type="hidden" name="dt_cheg_amostras_emb" value="<?php echo $this->form_encode_input($dt_cheg_amostras_emb) . "\">" . $dt_cheg_amostras_emb . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_cheg_amostras_emb" class="sc-ui-readonly-dt_cheg_amostras_emb css_dt_cheg_amostras_emb_line" style="<?php echo $sStyleReadLab_dt_cheg_amostras_emb; ?>"><?php echo $this->form_format_readonly("dt_cheg_amostras_emb", $this->form_encode_input($dt_cheg_amostras_emb)); ?></span><span id="id_read_off_dt_cheg_amostras_emb" class="css_read_off_dt_cheg_amostras_emb<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_cheg_amostras_emb; ?>"><?php
$tmp_form_data = $this->field_config['dt_cheg_amostras_emb']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_cheg_amostras_emb_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_cheg_amostras_emb" type=text name="dt_cheg_amostras_emb" value="<?php echo $this->form_encode_input($dt_cheg_amostras_emb) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_cheg_amostras_emb']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_cheg_amostras_emb']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_cheg_amostras_emb_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_cheg_amostras_emb_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_mostruario']))
    {
        $this->nm_new_label['dt_mostruario'] = "Dt. do Mostruário";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_mostruario = $this->dt_mostruario;
   $sStyleHidden_dt_mostruario = '';
   if (isset($this->nmgp_cmp_hidden['dt_mostruario']) && $this->nmgp_cmp_hidden['dt_mostruario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_mostruario']);
       $sStyleHidden_dt_mostruario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_mostruario = 'display: none;';
   $sStyleReadInp_dt_mostruario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_mostruario']) && $this->nmgp_cmp_readonly['dt_mostruario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_mostruario']);
       $sStyleReadLab_dt_mostruario = '';
       $sStyleReadInp_dt_mostruario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_mostruario']) && $this->nmgp_cmp_hidden['dt_mostruario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_mostruario" value="<?php echo $this->form_encode_input($dt_mostruario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_mostruario" style="<?php echo $sStyleHidden_dt_mostruario; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_mostruario_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_mostruario_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_mostruario"><?php echo $this->nm_new_label['dt_mostruario']; ?></span></td></tr><tr><td class="css_dt_mostruario_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_mostruario"]) &&  $this->nmgp_cmp_readonly["dt_mostruario"] == "on") { 

 ?>
<input type="hidden" name="dt_mostruario" value="<?php echo $this->form_encode_input($dt_mostruario) . "\">" . $dt_mostruario . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_mostruario" class="sc-ui-readonly-dt_mostruario css_dt_mostruario_line" style="<?php echo $sStyleReadLab_dt_mostruario; ?>"><?php echo $this->form_format_readonly("dt_mostruario", $this->form_encode_input($dt_mostruario)); ?></span><span id="id_read_off_dt_mostruario" class="css_read_off_dt_mostruario<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_mostruario; ?>"><?php
$tmp_form_data = $this->field_config['dt_mostruario']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_mostruario_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_mostruario" type=text name="dt_mostruario" value="<?php echo $this->form_encode_input($dt_mostruario) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_mostruario']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_mostruario']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_mostruario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_mostruario_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_dt_recbto_embalagem_dumb = ('' == $sStyleHidden_dt_recbto_embalagem) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_recbto_embalagem_dumb" style="<?php echo $sStyleHidden_dt_recbto_embalagem_dumb; ?>"></TD>
<?php $sStyleHidden_dt_cheg_amostras_emb_dumb = ('' == $sStyleHidden_dt_cheg_amostras_emb) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_cheg_amostras_emb_dumb" style="<?php echo $sStyleHidden_dt_cheg_amostras_emb_dumb; ?>"></TD>
<?php $sStyleHidden_dt_mostruario_dumb = ('' == $sStyleHidden_dt_mostruario) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_mostruario_dumb" style="<?php echo $sStyleHidden_dt_mostruario_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_4"></a>
<div id="div_hidden_bloco_4" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['envios_amostra']))
    {
        $this->nm_new_label['envios_amostra'] = "Envios de Amostra";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $envios_amostra = $this->envios_amostra;
   $sStyleHidden_envios_amostra = '';
   if (isset($this->nmgp_cmp_hidden['envios_amostra']) && $this->nmgp_cmp_hidden['envios_amostra'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['envios_amostra']);
       $sStyleHidden_envios_amostra = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_envios_amostra = 'display: none;';
   $sStyleReadInp_envios_amostra = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['envios_amostra']) && $this->nmgp_cmp_readonly['envios_amostra'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['envios_amostra']);
       $sStyleReadLab_envios_amostra = '';
       $sStyleReadInp_envios_amostra = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['envios_amostra']) && $this->nmgp_cmp_hidden['envios_amostra'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="envios_amostra" value="<?php echo $this->form_encode_input($envios_amostra) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_envios_amostra_line" id="hidden_field_data_envios_amostra" style="<?php echo $sStyleHidden_envios_amostra; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td width="100%" class="scFormDataFontOdd css_envios_amostra_line" style="vertical-align: top;padding: 0px">
<?php
 if (isset($_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_envios_amostra'] ]) && '' != $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_envios_amostra'] ]) {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] = $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_envios_amostra'] ];
 }
 else {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] = $this->Ini->sc_page;
 }
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] ]['grid_PUB_envios_amostras_repres']['embutida_form_full']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] ]['grid_PUB_envios_amostras_repres']['embutida_form']       = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] ]['grid_PUB_envios_amostras_repres']['embutida_pai']        = "form_itens_proc_compra";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init'] ]['grid_PUB_envios_amostras_repres']['embutida_form_parms'] = "item_proc_compra_id_corrente*scin" . $this->nmgp_dados_form['item_proc_compra_id'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
 if (isset($this->Ini->sc_lig_md5["grid_PUB_envios_amostras_repres"]) && $this->Ini->sc_lig_md5["grid_PUB_envios_amostras_repres"] == "S") {
     $Parms_Lig  = "item_proc_compra_id_corrente*scin" . $this->nmgp_dados_form['item_proc_compra_id'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
     $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_itens_proc_compra@SC_par@" . md5($Parms_Lig);
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
 } else {
     $Md5_Lig  = "item_proc_compra_id_corrente*scin" . $this->nmgp_dados_form['item_proc_compra_id'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
 }
 $parms_lig_cons = "&nmgp_parms=" . $Md5_Lig;
 $sDetailSrc = ('novo' == $this->nmgp_opcao) ? 'form_itens_proc_compra_empty.htm' : $this->Ini->link_grid_PUB_envios_amostras_repres_cons . '?script_case_init=' . $this->form_encode_input($this->Ini->sc_page) . '&script_case_detail=Y&sc_ifr_height=400' . $parms_lig_cons;
if (isset($this->Ini->sc_lig_target['C_@scinf_envios_amostra']) && 'nmsc_iframe_liga_grid_PUB_envios_amostras_repres' != $this->Ini->sc_lig_target['C_@scinf_envios_amostra'])
{
    if ('novo' != $this->nmgp_opcao)
    {
        $sDetailSrc .= '&under_dashboard=1&dashboard_app=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['dashboard_app'] . '&own_widget=' . $this->Ini->sc_lig_target['C_@scinf_envios_amostra'] . '&parent_widget=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['own_widget'];
        $sDetailSrc  = $this->addUrlParam($sDetailSrc, 'script_case_init', $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['grid_PUB_envios_amostras_repres_script_case_init']);
    }
?>
<script type="text/javascript">
$(function() {
    scOpenMasterDetail("<?php echo $this->Ini->sc_lig_target['C_@scinf_envios_amostra'] ?>", "<?php echo $sDetailSrc; ?>");
});
</script>
<?php
}
else
{
?>
<iframe border="0" id="nmsc_iframe_liga_grid_PUB_envios_amostras_repres"  marginWidth="0" marginHeight="0" frameborder="0" valign="top" height="400px" width="1000px" name="nmsc_iframe_liga_grid_PUB_envios_amostras_repres"  scrolling="auto" style="max-height: 400px;" src="<?php echo $sDetailSrc; ?>"></iframe>
<?php
}
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_envios_amostra_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_envios_amostra_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_envios_amostra_dumb = ('' == $sStyleHidden_envios_amostra) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_envios_amostra_dumb" style="<?php echo $sStyleHidden_envios_amostra_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_5"></a>
<div id="div_hidden_bloco_5" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['observacao']))
    {
        $this->nm_new_label['observacao'] = "Observações";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observacao = $this->observacao;
   $sStyleHidden_observacao = '';
   if (isset($this->nmgp_cmp_hidden['observacao']) && $this->nmgp_cmp_hidden['observacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observacao']);
       $sStyleHidden_observacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observacao = 'display: none;';
   $sStyleReadInp_observacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observacao']) && $this->nmgp_cmp_readonly['observacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observacao']);
       $sStyleReadLab_observacao = '';
       $sStyleReadInp_observacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observacao']) && $this->nmgp_cmp_hidden['observacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observacao" value="<?php echo $this->form_encode_input($observacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_observacao_line" id="hidden_field_data_observacao" style="<?php echo $sStyleHidden_observacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observacao_line" style="vertical-align: top;padding: 0px">
<?php
$observacao_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observacao));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observacao"]) &&  $this->nmgp_cmp_readonly["observacao"] == "on") { 

 ?>
<input type="hidden" name="observacao" value="<?php echo $this->form_encode_input($observacao) . "\">" . $observacao_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observacao" class="sc-ui-readonly-observacao css_observacao_line" style="<?php echo $sStyleReadLab_observacao; ?>"><?php echo $this->form_format_readonly("observacao", $this->form_encode_input($observacao_val)); ?></span><span id="id_read_off_observacao" class="css_read_off_observacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observacao; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observacao" id="id_sc_field_observacao" rows="5" cols="100"
 alt="{datatype: 'text', maxLength: 8000, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observacao; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observacao_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_6"></a>
<div id="div_hidden_bloco_6" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_6" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['log_aprov_so_ld']))
   {
       $this->nm_new_label['log_aprov_so_ld'] = "Aprova Strike Offs e Lab Dips?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $log_aprov_so_ld = $this->log_aprov_so_ld;
   $sStyleHidden_log_aprov_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['log_aprov_so_ld']) && $this->nmgp_cmp_hidden['log_aprov_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['log_aprov_so_ld']);
       $sStyleHidden_log_aprov_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_log_aprov_so_ld = 'display: none;';
   $sStyleReadInp_log_aprov_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['log_aprov_so_ld']) && $this->nmgp_cmp_readonly['log_aprov_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['log_aprov_so_ld']);
       $sStyleReadLab_log_aprov_so_ld = '';
       $sStyleReadInp_log_aprov_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['log_aprov_so_ld']) && $this->nmgp_cmp_hidden['log_aprov_so_ld'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="log_aprov_so_ld" value="<?php echo $this->form_encode_input($this->log_aprov_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_log_aprov_so_ld" style="<?php echo $sStyleHidden_log_aprov_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_log_aprov_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_log_aprov_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_log_aprov_so_ld"><?php echo $this->nm_new_label['log_aprov_so_ld']; ?></span></td></tr><tr><td class="css_log_aprov_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["log_aprov_so_ld"]) &&  $this->nmgp_cmp_readonly["log_aprov_so_ld"] == "on") { 

$log_aprov_so_ld_look = "";
 if ($this->log_aprov_so_ld == "1") { $log_aprov_so_ld_look .= "Sim" ;} 
 if ($this->log_aprov_so_ld == "0") { $log_aprov_so_ld_look .= "Não" ;} 
 if (empty($log_aprov_so_ld_look)) { $log_aprov_so_ld_look = $this->log_aprov_so_ld; }
?>
<input type="hidden" name="log_aprov_so_ld" value="<?php echo $this->form_encode_input($log_aprov_so_ld) . "\">" . $log_aprov_so_ld_look . ""; ?>
<?php } else { ?>
<?php

$log_aprov_so_ld_look = "";
 if ($this->log_aprov_so_ld == "1") { $log_aprov_so_ld_look .= "Sim" ;} 
 if ($this->log_aprov_so_ld == "0") { $log_aprov_so_ld_look .= "Não" ;} 
 if (empty($log_aprov_so_ld_look)) { $log_aprov_so_ld_look = $this->log_aprov_so_ld; }
?>
<span id="id_read_on_log_aprov_so_ld" class="css_log_aprov_so_ld_line"  style="<?php echo $sStyleReadLab_log_aprov_so_ld; ?>"><?php echo $this->form_format_readonly("log_aprov_so_ld", $this->form_encode_input($log_aprov_so_ld_look)); ?></span><span id="id_read_off_log_aprov_so_ld" class="css_read_off_log_aprov_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_log_aprov_so_ld; ?>">
 <span id="idAjaxSelect_log_aprov_so_ld" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_log_aprov_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_log_aprov_so_ld" name="log_aprov_so_ld" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_aprov_so_ld'][] = ''; ?>
 <option value=""></option>
 <option  value="1" <?php  if ($this->log_aprov_so_ld == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_aprov_so_ld'][] = '1'; ?>
 <option  value="0" <?php  if ($this->log_aprov_so_ld == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_log_aprov_so_ld'][] = '0'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_log_aprov_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_log_aprov_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_prev_recbto_so_ld']))
    {
        $this->nm_new_label['dt_prev_recbto_so_ld'] = "Dt.Prev.Recbto Strike Offs e Labs Dips";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_recbto_so_ld = $this->dt_prev_recbto_so_ld;
   $sStyleHidden_dt_prev_recbto_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_recbto_so_ld']) && $this->nmgp_cmp_hidden['dt_prev_recbto_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_recbto_so_ld']);
       $sStyleHidden_dt_prev_recbto_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_recbto_so_ld = 'display: none;';
   $sStyleReadInp_dt_prev_recbto_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_recbto_so_ld']) && $this->nmgp_cmp_readonly['dt_prev_recbto_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_recbto_so_ld']);
       $sStyleReadLab_dt_prev_recbto_so_ld = '';
       $sStyleReadInp_dt_prev_recbto_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_recbto_so_ld']) && $this->nmgp_cmp_hidden['dt_prev_recbto_so_ld'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_prev_recbto_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_recbto_so_ld" style="<?php echo $sStyleHidden_dt_prev_recbto_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_recbto_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_recbto_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_prev_recbto_so_ld"><?php echo $this->nm_new_label['dt_prev_recbto_so_ld']; ?></span></td></tr><tr><td class="css_dt_prev_recbto_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_recbto_so_ld"]) &&  $this->nmgp_cmp_readonly["dt_prev_recbto_so_ld"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_prev_recbto_so_ld) . "\">" . $dt_prev_recbto_so_ld . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_recbto_so_ld" class="sc-ui-readonly-dt_prev_recbto_so_ld css_dt_prev_recbto_so_ld_line" style="<?php echo $sStyleReadLab_dt_prev_recbto_so_ld; ?>"><?php echo $this->form_format_readonly("dt_prev_recbto_so_ld", $this->form_encode_input($dt_prev_recbto_so_ld)); ?></span><span id="id_read_off_dt_prev_recbto_so_ld" class="css_read_off_dt_prev_recbto_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_recbto_so_ld; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_recbto_so_ld']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_recbto_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_recbto_so_ld" type=text name="dt_prev_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_prev_recbto_so_ld) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_recbto_so_ld']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_recbto_so_ld']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_recbto_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_recbto_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_log_aprov_so_ld_dumb = ('' == $sStyleHidden_log_aprov_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_log_aprov_so_ld_dumb" style="<?php echo $sStyleHidden_log_aprov_so_ld_dumb; ?>"></TD>
<?php $sStyleHidden_dt_prev_recbto_so_ld_dumb = ('' == $sStyleHidden_dt_prev_recbto_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_recbto_so_ld_dumb" style="<?php echo $sStyleHidden_dt_prev_recbto_so_ld_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_prev_aprov_so_ld']))
    {
        $this->nm_new_label['dt_prev_aprov_so_ld'] = "Dt. Prev. Aprov. Strike Offs e Labs Dips";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_aprov_so_ld = $this->dt_prev_aprov_so_ld;
   $sStyleHidden_dt_prev_aprov_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_aprov_so_ld']) && $this->nmgp_cmp_hidden['dt_prev_aprov_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_aprov_so_ld']);
       $sStyleHidden_dt_prev_aprov_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_aprov_so_ld = 'display: none;';
   $sStyleReadInp_dt_prev_aprov_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_aprov_so_ld']) && $this->nmgp_cmp_readonly['dt_prev_aprov_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_aprov_so_ld']);
       $sStyleReadLab_dt_prev_aprov_so_ld = '';
       $sStyleReadInp_dt_prev_aprov_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_aprov_so_ld']) && $this->nmgp_cmp_hidden['dt_prev_aprov_so_ld'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_prev_aprov_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_aprov_so_ld" style="<?php echo $sStyleHidden_dt_prev_aprov_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_aprov_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_aprov_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_prev_aprov_so_ld"><?php echo $this->nm_new_label['dt_prev_aprov_so_ld']; ?></span></td></tr><tr><td class="css_dt_prev_aprov_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_aprov_so_ld"]) &&  $this->nmgp_cmp_readonly["dt_prev_aprov_so_ld"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_prev_aprov_so_ld) . "\">" . $dt_prev_aprov_so_ld . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_aprov_so_ld" class="sc-ui-readonly-dt_prev_aprov_so_ld css_dt_prev_aprov_so_ld_line" style="<?php echo $sStyleReadLab_dt_prev_aprov_so_ld; ?>"><?php echo $this->form_format_readonly("dt_prev_aprov_so_ld", $this->form_encode_input($dt_prev_aprov_so_ld)); ?></span><span id="id_read_off_dt_prev_aprov_so_ld" class="css_read_off_dt_prev_aprov_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_aprov_so_ld; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_aprov_so_ld']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_aprov_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_aprov_so_ld" type=text name="dt_prev_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_prev_aprov_so_ld) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_aprov_so_ld']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_aprov_so_ld']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_aprov_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_aprov_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_real_aprov_so_ld']))
    {
        $this->nm_new_label['dt_real_aprov_so_ld'] = "Dt. Real Aprov. Strike Offs e Labs Dips";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_real_aprov_so_ld = $this->dt_real_aprov_so_ld;
   $sStyleHidden_dt_real_aprov_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['dt_real_aprov_so_ld']) && $this->nmgp_cmp_hidden['dt_real_aprov_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_real_aprov_so_ld']);
       $sStyleHidden_dt_real_aprov_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_real_aprov_so_ld = 'display: none;';
   $sStyleReadInp_dt_real_aprov_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_real_aprov_so_ld']) && $this->nmgp_cmp_readonly['dt_real_aprov_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_real_aprov_so_ld']);
       $sStyleReadLab_dt_real_aprov_so_ld = '';
       $sStyleReadInp_dt_real_aprov_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_real_aprov_so_ld']) && $this->nmgp_cmp_hidden['dt_real_aprov_so_ld'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_real_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_real_aprov_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_aprov_so_ld" style="<?php echo $sStyleHidden_dt_real_aprov_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_real_aprov_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_real_aprov_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_real_aprov_so_ld"><?php echo $this->nm_new_label['dt_real_aprov_so_ld']; ?></span></td></tr><tr><td class="css_dt_real_aprov_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_real_aprov_so_ld"]) &&  $this->nmgp_cmp_readonly["dt_real_aprov_so_ld"] == "on") { 

 ?>
<input type="hidden" name="dt_real_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_real_aprov_so_ld) . "\">" . $dt_real_aprov_so_ld . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_real_aprov_so_ld" class="sc-ui-readonly-dt_real_aprov_so_ld css_dt_real_aprov_so_ld_line" style="<?php echo $sStyleReadLab_dt_real_aprov_so_ld; ?>"><?php echo $this->form_format_readonly("dt_real_aprov_so_ld", $this->form_encode_input($dt_real_aprov_so_ld)); ?></span><span id="id_read_off_dt_real_aprov_so_ld" class="css_read_off_dt_real_aprov_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_real_aprov_so_ld; ?>"><?php
$tmp_form_data = $this->field_config['dt_real_aprov_so_ld']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_real_aprov_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_real_aprov_so_ld" type=text name="dt_real_aprov_so_ld" value="<?php echo $this->form_encode_input($dt_real_aprov_so_ld) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_real_aprov_so_ld']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_real_aprov_so_ld']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_real_aprov_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_real_aprov_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_dt_prev_aprov_so_ld_dumb = ('' == $sStyleHidden_dt_prev_aprov_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_aprov_so_ld_dumb" style="<?php echo $sStyleHidden_dt_prev_aprov_so_ld_dumb; ?>"></TD>
<?php $sStyleHidden_dt_real_aprov_so_ld_dumb = ('' == $sStyleHidden_dt_real_aprov_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_aprov_so_ld_dumb" style="<?php echo $sStyleHidden_dt_real_aprov_so_ld_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qt_dias_calc_so_ld']))
    {
        $this->nm_new_label['qt_dias_calc_so_ld'] = "Qt Dias Calc So Ld";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_dias_calc_so_ld = $this->qt_dias_calc_so_ld;
   $sStyleHidden_qt_dias_calc_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['qt_dias_calc_so_ld']) && $this->nmgp_cmp_hidden['qt_dias_calc_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_dias_calc_so_ld']);
       $sStyleHidden_qt_dias_calc_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_dias_calc_so_ld = 'display: none;';
   $sStyleReadInp_qt_dias_calc_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_dias_calc_so_ld']) && $this->nmgp_cmp_readonly['qt_dias_calc_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_dias_calc_so_ld']);
       $sStyleReadLab_qt_dias_calc_so_ld = '';
       $sStyleReadInp_qt_dias_calc_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_dias_calc_so_ld']) && $this->nmgp_cmp_hidden['qt_dias_calc_so_ld'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_dias_calc_so_ld" value="<?php echo $this->form_encode_input($qt_dias_calc_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_qt_dias_calc_so_ld" style="<?php echo $sStyleHidden_qt_dias_calc_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_dias_calc_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_qt_dias_calc_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_qt_dias_calc_so_ld"><?php echo $this->nm_new_label['qt_dias_calc_so_ld']; ?></span></td></tr><tr><td class="css_qt_dias_calc_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_dias_calc_so_ld"]) &&  $this->nmgp_cmp_readonly["qt_dias_calc_so_ld"] == "on") { 

 ?>
<input type="hidden" name="qt_dias_calc_so_ld" value="<?php echo $this->form_encode_input($qt_dias_calc_so_ld) . "\">" . $qt_dias_calc_so_ld . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_dias_calc_so_ld" class="sc-ui-readonly-qt_dias_calc_so_ld css_qt_dias_calc_so_ld_line" style="<?php echo $sStyleReadLab_qt_dias_calc_so_ld; ?>"><?php echo $this->form_format_readonly("qt_dias_calc_so_ld", $this->form_encode_input($this->qt_dias_calc_so_ld)); ?></span><span id="id_read_off_qt_dias_calc_so_ld" class="css_read_off_qt_dias_calc_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_dias_calc_so_ld; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_dias_calc_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_dias_calc_so_ld" type=text name="qt_dias_calc_so_ld" value="<?php echo $this->form_encode_input($qt_dias_calc_so_ld) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_dias_calc_so_ld']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_dias_calc_so_ld']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_dias_calc_so_ld']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_dias_calc_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_dias_calc_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_real_recbto_so_ld']))
    {
        $this->nm_new_label['dt_real_recbto_so_ld'] = "Dt Real Recbto So Ld";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_real_recbto_so_ld = $this->dt_real_recbto_so_ld;
   $sStyleHidden_dt_real_recbto_so_ld = '';
   if (isset($this->nmgp_cmp_hidden['dt_real_recbto_so_ld']) && $this->nmgp_cmp_hidden['dt_real_recbto_so_ld'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_real_recbto_so_ld']);
       $sStyleHidden_dt_real_recbto_so_ld = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_real_recbto_so_ld = 'display: none;';
   $sStyleReadInp_dt_real_recbto_so_ld = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_real_recbto_so_ld']) && $this->nmgp_cmp_readonly['dt_real_recbto_so_ld'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_real_recbto_so_ld']);
       $sStyleReadLab_dt_real_recbto_so_ld = '';
       $sStyleReadInp_dt_real_recbto_so_ld = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_real_recbto_so_ld']) && $this->nmgp_cmp_hidden['dt_real_recbto_so_ld'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_real_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_real_recbto_so_ld) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_recbto_so_ld" style="<?php echo $sStyleHidden_dt_real_recbto_so_ld; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_real_recbto_so_ld_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_real_recbto_so_ld_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_real_recbto_so_ld"><?php echo $this->nm_new_label['dt_real_recbto_so_ld']; ?></span></td></tr><tr><td class="css_dt_real_recbto_so_ld_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_real_recbto_so_ld"]) &&  $this->nmgp_cmp_readonly["dt_real_recbto_so_ld"] == "on") { 

 ?>
<input type="hidden" name="dt_real_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_real_recbto_so_ld) . "\">" . $dt_real_recbto_so_ld . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_real_recbto_so_ld" class="sc-ui-readonly-dt_real_recbto_so_ld css_dt_real_recbto_so_ld_line" style="<?php echo $sStyleReadLab_dt_real_recbto_so_ld; ?>"><?php echo $this->form_format_readonly("dt_real_recbto_so_ld", $this->form_encode_input($dt_real_recbto_so_ld)); ?></span><span id="id_read_off_dt_real_recbto_so_ld" class="css_read_off_dt_real_recbto_so_ld<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_real_recbto_so_ld; ?>"><?php
$tmp_form_data = $this->field_config['dt_real_recbto_so_ld']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_real_recbto_so_ld_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_real_recbto_so_ld" type=text name="dt_real_recbto_so_ld" value="<?php echo $this->form_encode_input($dt_real_recbto_so_ld) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_real_recbto_so_ld']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_real_recbto_so_ld']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_real_recbto_so_ld_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_real_recbto_so_ld_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_qt_dias_calc_so_ld_dumb = ('' == $sStyleHidden_qt_dias_calc_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_qt_dias_calc_so_ld_dumb" style="<?php echo $sStyleHidden_qt_dias_calc_so_ld_dumb; ?>"></TD>
<?php $sStyleHidden_dt_real_recbto_so_ld_dumb = ('' == $sStyleHidden_dt_real_recbto_so_ld) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_real_recbto_so_ld_dumb" style="<?php echo $sStyleHidden_dt_real_recbto_so_ld_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_7"></a>
<div id="div_hidden_bloco_7" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_7" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_producao_no_prazo']))
   {
       $this->nm_new_label['ind_producao_no_prazo'] = "Produção no prazo esperado?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_producao_no_prazo = $this->ind_producao_no_prazo;
   $sStyleHidden_ind_producao_no_prazo = '';
   if (isset($this->nmgp_cmp_hidden['ind_producao_no_prazo']) && $this->nmgp_cmp_hidden['ind_producao_no_prazo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_producao_no_prazo']);
       $sStyleHidden_ind_producao_no_prazo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_producao_no_prazo = 'display: none;';
   $sStyleReadInp_ind_producao_no_prazo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_producao_no_prazo']) && $this->nmgp_cmp_readonly['ind_producao_no_prazo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_producao_no_prazo']);
       $sStyleReadLab_ind_producao_no_prazo = '';
       $sStyleReadInp_ind_producao_no_prazo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_producao_no_prazo']) && $this->nmgp_cmp_hidden['ind_producao_no_prazo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_producao_no_prazo" value="<?php echo $this->form_encode_input($this->ind_producao_no_prazo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_producao_no_prazo" style="<?php echo $sStyleHidden_ind_producao_no_prazo; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_producao_no_prazo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_producao_no_prazo_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_producao_no_prazo"><?php echo $this->nm_new_label['ind_producao_no_prazo']; ?></span></td></tr><tr><td class="css_ind_producao_no_prazo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_producao_no_prazo"]) &&  $this->nmgp_cmp_readonly["ind_producao_no_prazo"] == "on") { 

$ind_producao_no_prazo_look = "";
 if ($this->ind_producao_no_prazo == "0") { $ind_producao_no_prazo_look .= "Não Informado" ;} 
 if ($this->ind_producao_no_prazo == "1") { $ind_producao_no_prazo_look .= "Sim" ;} 
 if ($this->ind_producao_no_prazo == "2") { $ind_producao_no_prazo_look .= "Não" ;} 
 if (empty($ind_producao_no_prazo_look)) { $ind_producao_no_prazo_look = $this->ind_producao_no_prazo; }
?>
<input type="hidden" name="ind_producao_no_prazo" value="<?php echo $this->form_encode_input($ind_producao_no_prazo) . "\">" . $ind_producao_no_prazo_look . ""; ?>
<?php } else { ?>
<?php

$ind_producao_no_prazo_look = "";
 if ($this->ind_producao_no_prazo == "0") { $ind_producao_no_prazo_look .= "Não Informado" ;} 
 if ($this->ind_producao_no_prazo == "1") { $ind_producao_no_prazo_look .= "Sim" ;} 
 if ($this->ind_producao_no_prazo == "2") { $ind_producao_no_prazo_look .= "Não" ;} 
 if (empty($ind_producao_no_prazo_look)) { $ind_producao_no_prazo_look = $this->ind_producao_no_prazo; }
?>
<span id="id_read_on_ind_producao_no_prazo" class="css_ind_producao_no_prazo_line"  style="<?php echo $sStyleReadLab_ind_producao_no_prazo; ?>"><?php echo $this->form_format_readonly("ind_producao_no_prazo", $this->form_encode_input($ind_producao_no_prazo_look)); ?></span><span id="id_read_off_ind_producao_no_prazo" class="css_read_off_ind_producao_no_prazo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_producao_no_prazo; ?>">
 <span id="idAjaxSelect_ind_producao_no_prazo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_producao_no_prazo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_producao_no_prazo" name="ind_producao_no_prazo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_producao_no_prazo == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_producao_no_prazo'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_producao_no_prazo == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_producao_no_prazo'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_producao_no_prazo == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_producao_no_prazo'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_producao_no_prazo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_producao_no_prazo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['qt_dias_producao']))
    {
        $this->nm_new_label['qt_dias_producao'] = "Qt Dias Produção";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qt_dias_producao = $this->qt_dias_producao;
   $sStyleHidden_qt_dias_producao = '';
   if (isset($this->nmgp_cmp_hidden['qt_dias_producao']) && $this->nmgp_cmp_hidden['qt_dias_producao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qt_dias_producao']);
       $sStyleHidden_qt_dias_producao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qt_dias_producao = 'display: none;';
   $sStyleReadInp_qt_dias_producao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qt_dias_producao']) && $this->nmgp_cmp_readonly['qt_dias_producao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qt_dias_producao']);
       $sStyleReadLab_qt_dias_producao = '';
       $sStyleReadInp_qt_dias_producao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qt_dias_producao']) && $this->nmgp_cmp_hidden['qt_dias_producao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qt_dias_producao" value="<?php echo $this->form_encode_input($qt_dias_producao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_qt_dias_producao" style="<?php echo $sStyleHidden_qt_dias_producao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qt_dias_producao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_qt_dias_producao_label" style=" padding: 0px; width: 100%;"><span id="id_label_qt_dias_producao"><?php echo $this->nm_new_label['qt_dias_producao']; ?></span></td></tr><tr><td class="css_qt_dias_producao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qt_dias_producao"]) &&  $this->nmgp_cmp_readonly["qt_dias_producao"] == "on") { 

 ?>
<input type="hidden" name="qt_dias_producao" value="<?php echo $this->form_encode_input($qt_dias_producao) . "\">" . $qt_dias_producao . ""; ?>
<?php } else { ?>
<span id="id_read_on_qt_dias_producao" class="sc-ui-readonly-qt_dias_producao css_qt_dias_producao_line" style="<?php echo $sStyleReadLab_qt_dias_producao; ?>"><?php echo $this->form_format_readonly("qt_dias_producao", $this->form_encode_input($this->qt_dias_producao)); ?></span><span id="id_read_off_qt_dias_producao" class="css_read_off_qt_dias_producao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qt_dias_producao; ?>">
 <input class="sc-js-input scFormObjectOdd css_qt_dias_producao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qt_dias_producao" type=text name="qt_dias_producao" value="<?php echo $this->form_encode_input($qt_dias_producao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['qt_dias_producao']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['qt_dias_producao']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['qt_dias_producao']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qt_dias_producao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qt_dias_producao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_ind_producao_no_prazo_dumb = ('' == $sStyleHidden_ind_producao_no_prazo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_producao_no_prazo_dumb" style="<?php echo $sStyleHidden_ind_producao_no_prazo_dumb; ?>"></TD>
<?php $sStyleHidden_qt_dias_producao_dumb = ('' == $sStyleHidden_qt_dias_producao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_qt_dias_producao_dumb" style="<?php echo $sStyleHidden_qt_dias_producao_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_relat_semanal_producao']))
   {
       $this->nm_new_label['ind_relat_semanal_producao'] = "Envio Relat. Semanal de Produção?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_relat_semanal_producao = $this->ind_relat_semanal_producao;
   $sStyleHidden_ind_relat_semanal_producao = '';
   if (isset($this->nmgp_cmp_hidden['ind_relat_semanal_producao']) && $this->nmgp_cmp_hidden['ind_relat_semanal_producao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_relat_semanal_producao']);
       $sStyleHidden_ind_relat_semanal_producao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_relat_semanal_producao = 'display: none;';
   $sStyleReadInp_ind_relat_semanal_producao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_relat_semanal_producao']) && $this->nmgp_cmp_readonly['ind_relat_semanal_producao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_relat_semanal_producao']);
       $sStyleReadLab_ind_relat_semanal_producao = '';
       $sStyleReadInp_ind_relat_semanal_producao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_relat_semanal_producao']) && $this->nmgp_cmp_hidden['ind_relat_semanal_producao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_relat_semanal_producao" value="<?php echo $this->form_encode_input($this->ind_relat_semanal_producao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_relat_semanal_producao" style="<?php echo $sStyleHidden_ind_relat_semanal_producao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_relat_semanal_producao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_relat_semanal_producao_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_relat_semanal_producao"><?php echo $this->nm_new_label['ind_relat_semanal_producao']; ?></span></td></tr><tr><td class="css_ind_relat_semanal_producao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_relat_semanal_producao"]) &&  $this->nmgp_cmp_readonly["ind_relat_semanal_producao"] == "on") { 

$ind_relat_semanal_producao_look = "";
 if ($this->ind_relat_semanal_producao == "0") { $ind_relat_semanal_producao_look .= "Não Informado" ;} 
 if ($this->ind_relat_semanal_producao == "1") { $ind_relat_semanal_producao_look .= "Sim" ;} 
 if ($this->ind_relat_semanal_producao == "2") { $ind_relat_semanal_producao_look .= "Não" ;} 
 if (empty($ind_relat_semanal_producao_look)) { $ind_relat_semanal_producao_look = $this->ind_relat_semanal_producao; }
?>
<input type="hidden" name="ind_relat_semanal_producao" value="<?php echo $this->form_encode_input($ind_relat_semanal_producao) . "\">" . $ind_relat_semanal_producao_look . ""; ?>
<?php } else { ?>
<?php

$ind_relat_semanal_producao_look = "";
 if ($this->ind_relat_semanal_producao == "0") { $ind_relat_semanal_producao_look .= "Não Informado" ;} 
 if ($this->ind_relat_semanal_producao == "1") { $ind_relat_semanal_producao_look .= "Sim" ;} 
 if ($this->ind_relat_semanal_producao == "2") { $ind_relat_semanal_producao_look .= "Não" ;} 
 if (empty($ind_relat_semanal_producao_look)) { $ind_relat_semanal_producao_look = $this->ind_relat_semanal_producao; }
?>
<span id="id_read_on_ind_relat_semanal_producao" class="css_ind_relat_semanal_producao_line"  style="<?php echo $sStyleReadLab_ind_relat_semanal_producao; ?>"><?php echo $this->form_format_readonly("ind_relat_semanal_producao", $this->form_encode_input($ind_relat_semanal_producao_look)); ?></span><span id="id_read_off_ind_relat_semanal_producao" class="css_read_off_ind_relat_semanal_producao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_relat_semanal_producao; ?>">
 <span id="idAjaxSelect_ind_relat_semanal_producao" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_relat_semanal_producao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_relat_semanal_producao" name="ind_relat_semanal_producao" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="0" <?php  if ($this->ind_relat_semanal_producao == "0") { echo " selected" ;} ?>>Não Informado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_relat_semanal_producao'][] = '0'; ?>
 <option  value="1" <?php  if ($this->ind_relat_semanal_producao == "1") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_relat_semanal_producao'][] = '1'; ?>
 <option  value="2" <?php  if ($this->ind_relat_semanal_producao == "2") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_relat_semanal_producao'][] = '2'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_relat_semanal_producao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_relat_semanal_producao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_maxima_producao']))
    {
        $this->nm_new_label['dt_maxima_producao'] = "Dt. Máxima Produção";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_maxima_producao = $this->dt_maxima_producao;
   $sStyleHidden_dt_maxima_producao = '';
   if (isset($this->nmgp_cmp_hidden['dt_maxima_producao']) && $this->nmgp_cmp_hidden['dt_maxima_producao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_maxima_producao']);
       $sStyleHidden_dt_maxima_producao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_maxima_producao = 'display: none;';
   $sStyleReadInp_dt_maxima_producao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_maxima_producao']) && $this->nmgp_cmp_readonly['dt_maxima_producao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_maxima_producao']);
       $sStyleReadLab_dt_maxima_producao = '';
       $sStyleReadInp_dt_maxima_producao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_maxima_producao']) && $this->nmgp_cmp_hidden['dt_maxima_producao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_maxima_producao" value="<?php echo $this->form_encode_input($dt_maxima_producao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_maxima_producao" style="<?php echo $sStyleHidden_dt_maxima_producao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_maxima_producao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_maxima_producao_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_maxima_producao"><?php echo $this->nm_new_label['dt_maxima_producao']; ?></span></td></tr><tr><td class="css_dt_maxima_producao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_maxima_producao"]) &&  $this->nmgp_cmp_readonly["dt_maxima_producao"] == "on") { 

 ?>
<input type="hidden" name="dt_maxima_producao" value="<?php echo $this->form_encode_input($dt_maxima_producao) . "\">" . $dt_maxima_producao . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_maxima_producao" class="sc-ui-readonly-dt_maxima_producao css_dt_maxima_producao_line" style="<?php echo $sStyleReadLab_dt_maxima_producao; ?>"><?php echo $this->form_format_readonly("dt_maxima_producao", $this->form_encode_input($dt_maxima_producao)); ?></span><span id="id_read_off_dt_maxima_producao" class="css_read_off_dt_maxima_producao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_maxima_producao; ?>"><?php
$tmp_form_data = $this->field_config['dt_maxima_producao']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_dt_maxima_producao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_maxima_producao" type=text name="dt_maxima_producao" value="<?php echo $this->form_encode_input($dt_maxima_producao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_maxima_producao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_maxima_producao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_maxima_producao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_maxima_producao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_ind_relat_semanal_producao_dumb = ('' == $sStyleHidden_ind_relat_semanal_producao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_relat_semanal_producao_dumb" style="<?php echo $sStyleHidden_ind_relat_semanal_producao_dumb; ?>"></TD>
<?php $sStyleHidden_dt_maxima_producao_dumb = ('' == $sStyleHidden_dt_maxima_producao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_maxima_producao_dumb" style="<?php echo $sStyleHidden_dt_maxima_producao_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_termino_producao']))
    {
        $this->nm_new_label['dt_termino_producao'] = "Dt Termino Producao";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_termino_producao = $this->dt_termino_producao;
   $sStyleHidden_dt_termino_producao = '';
   if (isset($this->nmgp_cmp_hidden['dt_termino_producao']) && $this->nmgp_cmp_hidden['dt_termino_producao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_termino_producao']);
       $sStyleHidden_dt_termino_producao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_termino_producao = 'display: none;';
   $sStyleReadInp_dt_termino_producao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_termino_producao']) && $this->nmgp_cmp_readonly['dt_termino_producao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_termino_producao']);
       $sStyleReadLab_dt_termino_producao = '';
       $sStyleReadInp_dt_termino_producao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_termino_producao']) && $this->nmgp_cmp_hidden['dt_termino_producao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_termino_producao" value="<?php echo $this->form_encode_input($dt_termino_producao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_termino_producao" style="<?php echo $sStyleHidden_dt_termino_producao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_termino_producao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_termino_producao_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_termino_producao"><?php echo $this->nm_new_label['dt_termino_producao']; ?></span></td></tr><tr><td class="css_dt_termino_producao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_termino_producao"]) &&  $this->nmgp_cmp_readonly["dt_termino_producao"] == "on") { 

 ?>
<input type="hidden" name="dt_termino_producao" value="<?php echo $this->form_encode_input($dt_termino_producao) . "\">" . $dt_termino_producao . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_termino_producao" class="sc-ui-readonly-dt_termino_producao css_dt_termino_producao_line" style="<?php echo $sStyleReadLab_dt_termino_producao; ?>"><?php echo $this->form_format_readonly("dt_termino_producao", $this->form_encode_input($dt_termino_producao)); ?></span><span id="id_read_off_dt_termino_producao" class="css_read_off_dt_termino_producao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_termino_producao; ?>"><?php
$tmp_form_data = $this->field_config['dt_termino_producao']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_termino_producao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_termino_producao" type=text name="dt_termino_producao" value="<?php echo $this->form_encode_input($dt_termino_producao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_termino_producao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_termino_producao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_termino_producao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_termino_producao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['dt_prev_termino_producao']))
    {
        $this->nm_new_label['dt_prev_termino_producao'] = "Dt.Prev.Término Produção";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_prev_termino_producao = $this->dt_prev_termino_producao;
   $sStyleHidden_dt_prev_termino_producao = '';
   if (isset($this->nmgp_cmp_hidden['dt_prev_termino_producao']) && $this->nmgp_cmp_hidden['dt_prev_termino_producao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_prev_termino_producao']);
       $sStyleHidden_dt_prev_termino_producao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_prev_termino_producao = 'display: none;';
   $sStyleReadInp_dt_prev_termino_producao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_prev_termino_producao']) && $this->nmgp_cmp_readonly['dt_prev_termino_producao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_prev_termino_producao']);
       $sStyleReadLab_dt_prev_termino_producao = '';
       $sStyleReadInp_dt_prev_termino_producao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_prev_termino_producao']) && $this->nmgp_cmp_hidden['dt_prev_termino_producao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_prev_termino_producao" value="<?php echo $this->form_encode_input($dt_prev_termino_producao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_termino_producao" style="<?php echo $sStyleHidden_dt_prev_termino_producao; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_prev_termino_producao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dt_prev_termino_producao_label" style=" padding: 0px; width: 100%;"><span id="id_label_dt_prev_termino_producao"><?php echo $this->nm_new_label['dt_prev_termino_producao']; ?></span></td></tr><tr><td class="css_dt_prev_termino_producao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_prev_termino_producao"]) &&  $this->nmgp_cmp_readonly["dt_prev_termino_producao"] == "on") { 

 ?>
<input type="hidden" name="dt_prev_termino_producao" value="<?php echo $this->form_encode_input($dt_prev_termino_producao) . "\">" . $dt_prev_termino_producao . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_prev_termino_producao" class="sc-ui-readonly-dt_prev_termino_producao css_dt_prev_termino_producao_line" style="<?php echo $sStyleReadLab_dt_prev_termino_producao; ?>"><?php echo $this->form_format_readonly("dt_prev_termino_producao", $this->form_encode_input($dt_prev_termino_producao)); ?></span><span id="id_read_off_dt_prev_termino_producao" class="css_read_off_dt_prev_termino_producao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_prev_termino_producao; ?>"><?php
$tmp_form_data = $this->field_config['dt_prev_termino_producao']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_prev_termino_producao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_prev_termino_producao" type=text name="dt_prev_termino_producao" value="<?php echo $this->form_encode_input($dt_prev_termino_producao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_prev_termino_producao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_prev_termino_producao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_prev_termino_producao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_prev_termino_producao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_dt_termino_producao_dumb = ('' == $sStyleHidden_dt_termino_producao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_termino_producao_dumb" style="<?php echo $sStyleHidden_dt_termino_producao_dumb; ?>"></TD>
<?php $sStyleHidden_dt_prev_termino_producao_dumb = ('' == $sStyleHidden_dt_prev_termino_producao) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_dt_prev_termino_producao_dumb" style="<?php echo $sStyleHidden_dt_prev_termino_producao_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_8"></a>
<div id="div_hidden_bloco_8" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_8" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ind_distr_custo']))
   {
       $this->nm_new_label['ind_distr_custo'] = "Distr.Custo ?";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ind_distr_custo = $this->ind_distr_custo;
   $sStyleHidden_ind_distr_custo = '';
   if (isset($this->nmgp_cmp_hidden['ind_distr_custo']) && $this->nmgp_cmp_hidden['ind_distr_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ind_distr_custo']);
       $sStyleHidden_ind_distr_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ind_distr_custo = 'display: none;';
   $sStyleReadInp_ind_distr_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ind_distr_custo']) && $this->nmgp_cmp_readonly['ind_distr_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ind_distr_custo']);
       $sStyleReadLab_ind_distr_custo = '';
       $sStyleReadInp_ind_distr_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ind_distr_custo']) && $this->nmgp_cmp_hidden['ind_distr_custo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ind_distr_custo" value="<?php echo $this->form_encode_input($this->ind_distr_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ind_distr_custo" style="<?php echo $sStyleHidden_ind_distr_custo; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ind_distr_custo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ind_distr_custo_label" style=" padding: 0px; width: 100%;"><span id="id_label_ind_distr_custo"><?php echo $this->nm_new_label['ind_distr_custo']; ?></span></td></tr><tr><td class="css_ind_distr_custo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ind_distr_custo"]) &&  $this->nmgp_cmp_readonly["ind_distr_custo"] == "on") { 

$ind_distr_custo_look = "";
 if ($this->ind_distr_custo == "1") { $ind_distr_custo_look .= "Sim" ;} 
 if ($this->ind_distr_custo == "0") { $ind_distr_custo_look .= "Não" ;} 
 if (empty($ind_distr_custo_look)) { $ind_distr_custo_look = $this->ind_distr_custo; }
?>
<input type="hidden" name="ind_distr_custo" value="<?php echo $this->form_encode_input($ind_distr_custo) . "\">" . $ind_distr_custo_look . ""; ?>
<?php } else { ?>
<?php

$ind_distr_custo_look = "";
 if ($this->ind_distr_custo == "1") { $ind_distr_custo_look .= "Sim" ;} 
 if ($this->ind_distr_custo == "0") { $ind_distr_custo_look .= "Não" ;} 
 if (empty($ind_distr_custo_look)) { $ind_distr_custo_look = $this->ind_distr_custo; }
?>
<span id="id_read_on_ind_distr_custo" class="css_ind_distr_custo_line"  style="<?php echo $sStyleReadLab_ind_distr_custo; ?>"><?php echo $this->form_format_readonly("ind_distr_custo", $this->form_encode_input($ind_distr_custo_look)); ?></span><span id="id_read_off_ind_distr_custo" class="css_read_off_ind_distr_custo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_ind_distr_custo; ?>">
 <span id="idAjaxSelect_ind_distr_custo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_ind_distr_custo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_ind_distr_custo" name="ind_distr_custo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->ind_distr_custo == "1") { echo " selected" ;} ?><?php  if (empty($this->ind_distr_custo)) { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_distr_custo'][] = '1'; ?>
 <option  value="0" <?php  if ($this->ind_distr_custo == "0") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['Lookup_ind_distr_custo'][] = '0'; ?>
 </select></span>
</span><?php  }?>
<span style="display: inline-block"><?php echo nmButtonOutput($this->arr_buttons, "bfieldhelp", "nm_mostra_mens('ind_distr_custo')", "nm_mostra_mens('ind_distr_custo')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ind_distr_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ind_distr_custo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['vl_negociado']))
    {
        $this->nm_new_label['vl_negociado'] = "Vl.Negociado";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_negociado = $this->vl_negociado;
   $sStyleHidden_vl_negociado = '';
   if (isset($this->nmgp_cmp_hidden['vl_negociado']) && $this->nmgp_cmp_hidden['vl_negociado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_negociado']);
       $sStyleHidden_vl_negociado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_negociado = 'display: none;';
   $sStyleReadInp_vl_negociado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_negociado']) && $this->nmgp_cmp_readonly['vl_negociado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_negociado']);
       $sStyleReadLab_vl_negociado = '';
       $sStyleReadInp_vl_negociado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_negociado']) && $this->nmgp_cmp_hidden['vl_negociado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_negociado" value="<?php echo $this->form_encode_input($vl_negociado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_vl_negociado" style="<?php echo $sStyleHidden_vl_negociado; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_negociado_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_vl_negociado_label" style=" padding: 0px; width: 100%;"><span id="id_label_vl_negociado"><?php echo $this->nm_new_label['vl_negociado']; ?></span></td></tr><tr><td class="css_vl_negociado_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_negociado"]) &&  $this->nmgp_cmp_readonly["vl_negociado"] == "on") { 

 ?>
<input type="hidden" name="vl_negociado" value="<?php echo $this->form_encode_input($vl_negociado) . "\">" . $vl_negociado . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_negociado" class="sc-ui-readonly-vl_negociado css_vl_negociado_line" style="<?php echo $sStyleReadLab_vl_negociado; ?>"><?php echo $this->form_format_readonly("vl_negociado", $this->form_encode_input($this->vl_negociado)); ?></span><span id="id_read_off_vl_negociado" class="css_read_off_vl_negociado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_negociado; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_negociado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_negociado" type=text name="vl_negociado" value="<?php echo $this->form_encode_input($vl_negociado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 5, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_negociado']['symbol_dec']); ?>', thousandsSep: '', thousandsFormat: <?php echo $this->field_config['vl_negociado']['symbol_fmt']; ?>, manualDecimals: true, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_negociado']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_negociado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_negociado_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_ind_distr_custo_dumb = ('' == $sStyleHidden_ind_distr_custo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ind_distr_custo_dumb" style="<?php echo $sStyleHidden_ind_distr_custo_dumb; ?>"></TD>
<?php $sStyleHidden_vl_negociado_dumb = ('' == $sStyleHidden_vl_negociado) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_vl_negociado_dumb" style="<?php echo $sStyleHidden_vl_negociado_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_9"></a>
<div id="div_hidden_bloco_9" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_9" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dt_it_certif']))
    {
        $this->nm_new_label['dt_it_certif'] = "Data Item Certificação";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_it_certif = $this->dt_it_certif;
   $sStyleHidden_dt_it_certif = '';
   if (isset($this->nmgp_cmp_hidden['dt_it_certif']) && $this->nmgp_cmp_hidden['dt_it_certif'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_it_certif']);
       $sStyleHidden_dt_it_certif = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_it_certif = 'display: none;';
   $sStyleReadInp_dt_it_certif = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_it_certif']) && $this->nmgp_cmp_readonly['dt_it_certif'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_it_certif']);
       $sStyleReadLab_dt_it_certif = '';
       $sStyleReadInp_dt_it_certif = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_it_certif']) && $this->nmgp_cmp_hidden['dt_it_certif'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_it_certif" value="<?php echo $this->form_encode_input($dt_it_certif) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_dt_it_certif_line" id="hidden_field_data_dt_it_certif" style="<?php echo $sStyleHidden_dt_it_certif; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_it_certif_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_it_certif"]) &&  $this->nmgp_cmp_readonly["dt_it_certif"] == "on") { 

 ?>
<input type="hidden" name="dt_it_certif" value="<?php echo $this->form_encode_input($dt_it_certif) . "\">" . $dt_it_certif . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_it_certif" class="sc-ui-readonly-dt_it_certif css_dt_it_certif_line" style="<?php echo $sStyleReadLab_dt_it_certif; ?>"><?php echo $this->form_format_readonly("dt_it_certif", $this->form_encode_input($dt_it_certif)); ?></span><span id="id_read_off_dt_it_certif" class="css_read_off_dt_it_certif<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_it_certif; ?>"><?php
$tmp_form_data = $this->field_config['dt_it_certif']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_dt_it_certif_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_it_certif" type=text name="dt_it_certif" value="<?php echo $this->form_encode_input($dt_it_certif) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_it_certif']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_it_certif']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_it_certif_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_it_certif_text"></span></td></tr></table></td></tr></table> </TD>
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
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
{
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "S", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['birpara'];
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
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-16';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5,6,7,8,9);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0,5 => 0,6 => 0,7 => 0,8 => 0,9 => 0);
  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = 'hidden';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
$(window).bind("load", function() {
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5,6,7,8,9);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0,5 => 0,6 => 0,7 => 0,8 => 0,9 => 0);
  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = '';";
      }
  }
?>
});
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_itens_proc_compra");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_itens_proc_compra");
 parent.scAjaxDetailHeight("form_itens_proc_compra", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_itens_proc_compra", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_itens_proc_compra", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['sc_modal'])
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
        function scBtnFn_sys_format_copy() {
                if ($("#sc_b_copy_t.sc-unique-btn-1").length && $("#sc_b_copy_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_copy_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('clone');
                         return;
                }
        }
        function scBtnFn_sys_format_inc() {
                if ($("#sc_b_new_t.sc-unique-btn-2").length && $("#sc_b_new_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-3").length && $("#sc_b_ins_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-4").length && $("#sc_b_sai_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-5").length && $("#sc_b_upd_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
                if ($("#sc_b_upd_b.sc-unique-btn-12").length && $("#sc_b_upd_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_upd_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_exc() {
                if ($("#sc_b_del_t.sc-unique-btn-6").length && $("#sc_b_del_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-6").hasClass("disabled")) {
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
                if ($("#sc_b_ini_b.sc-unique-btn-13").length && $("#sc_b_ini_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-14").length && $("#sc_b_ret_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-15").length && $("#sc_b_avc_b.sc-unique-btn-15").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-15").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-16").length && $("#sc_b_fim_b.sc-unique-btn-16").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-16").hasClass("disabled")) {
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['buttonStatus'] = $this->nmgp_botoes;
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
