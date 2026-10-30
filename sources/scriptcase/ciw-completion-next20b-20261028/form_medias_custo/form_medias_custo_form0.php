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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Médias Custo"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Médias Custo"); } ?></TITLE>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_medias_custo/form_medias_custo_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_medias_custo_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_medias_custo_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['link_info']['remove_border']) {
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
 include_once("form_medias_custo_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_medias_custo'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_medias_custo'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['fast_search'][2] : "";
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_calc'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_calc']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_calc']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_calc']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_calc']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_calc'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_calc", "scBtnFn_bt_calc()", "scBtnFn_bt_calc()", "sc_bt_calc_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_gerar_lanc'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_gerar_lanc']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_gerar_lanc']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_gerar_lanc']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_gerar_lanc']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_gerar_lanc'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_gerar_lanc", "scBtnFn_bt_gerar_lanc()", "scBtnFn_bt_gerar_lanc()", "sc_bt_gerar_lanc_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['bt_cancelar'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_cancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_disabled']['bt_cancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_cancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_cancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['btn_label']['bt_cancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bt_cancelar", "scBtnFn_bt_cancelar()", "scBtnFn_bt_cancelar()", "sc_bt_cancelar_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['empty_filter'] = true;
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
      if ("hidden_bloco_1" == sTabId) {
        scAjaxDetailHeight("cons_itens_media_custo", "800");
      }
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['media_custo_id']))
           {
               $this->nmgp_cmp_readonly['media_custo_id'] = 'on';
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
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Itens</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['media_custo_id']))
    {
        $this->nm_new_label['media_custo_id'] = "ID";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $media_custo_id = $this->media_custo_id;
   $sStyleHidden_media_custo_id = '';
   if (isset($this->nmgp_cmp_hidden['media_custo_id']) && $this->nmgp_cmp_hidden['media_custo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['media_custo_id']);
       $sStyleHidden_media_custo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_media_custo_id = 'display: none;';
   $sStyleReadInp_media_custo_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["media_custo_id"]) &&  $this->nmgp_cmp_readonly["media_custo_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['media_custo_id']);
       $sStyleReadLab_media_custo_id = '';
       $sStyleReadInp_media_custo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['media_custo_id']) && $this->nmgp_cmp_hidden['media_custo_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="media_custo_id" value="<?php echo $this->form_encode_input($media_custo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_media_custo_id_label" id="hidden_field_label_media_custo_id" style="<?php echo $sStyleHidden_media_custo_id; ?>"><span id="id_label_media_custo_id"><?php echo $this->nm_new_label['media_custo_id']; ?></span></TD>
    <TD class="scFormDataOdd css_media_custo_id_line" id="hidden_field_data_media_custo_id" style="<?php echo $sStyleHidden_media_custo_id; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_media_custo_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_media_custo_id" class="css_media_custo_id_line" style="<?php echo $sStyleReadLab_media_custo_id; ?>"><?php echo $this->form_format_readonly("media_custo_id", $this->form_encode_input($this->media_custo_id)); ?></span><span id="id_read_off_media_custo_id" class="css_read_off_media_custo_id" style="<?php echo $sStyleReadInp_media_custo_id; ?>"><input type="hidden" name="media_custo_id" value="<?php echo $this->form_encode_input($media_custo_id) . "\">"?><span id="id_ajax_label_media_custo_id"><?php echo nl2br($media_custo_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_media_custo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_media_custo_id_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['dt_hr_registro']))
    {
        $this->nm_new_label['dt_hr_registro'] = "Dt.Hr.Registro";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dt_hr_registro = $this->dt_hr_registro;
   $dt_hr_registro_hora = $this->dt_hr_registro_hora;
   $guarda_datahora = $this->field_config['dt_hr_registro']['date_format'];
   $this->field_config['dt_hr_registro']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
   $sStyleHidden_dt_hr_registro = '';
   if (isset($this->nmgp_cmp_hidden['dt_hr_registro']) && $this->nmgp_cmp_hidden['dt_hr_registro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dt_hr_registro']);
       $sStyleHidden_dt_hr_registro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dt_hr_registro = 'display: none;';
   $sStyleReadInp_dt_hr_registro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dt_hr_registro']) && $this->nmgp_cmp_readonly['dt_hr_registro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dt_hr_registro']);
       $sStyleReadLab_dt_hr_registro = '';
       $sStyleReadInp_dt_hr_registro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dt_hr_registro']) && $this->nmgp_cmp_hidden['dt_hr_registro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_hr_registro" value="<?php echo $this->form_encode_input($dt_hr_registro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dt_hr_registro_hora_label" id="hidden_field_label_dt_hr_registro" style="<?php echo $sStyleHidden_dt_hr_registro; ?>"><span id="id_label_dt_hr_registro"><?php echo $this->nm_new_label['dt_hr_registro']; ?></span></TD>
    <TD class="scFormDataOdd css_dt_hr_registro_hora_line" id="hidden_field_data_dt_hr_registro" style="<?php echo $sStyleHidden_dt_hr_registro; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dt_hr_registro_hora_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_registro"]) &&  $this->nmgp_cmp_readonly["dt_hr_registro"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_registro" value="<?php echo $this->form_encode_input($dt_hr_registro) . "\">" . $dt_hr_registro . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_registro" class="sc-ui-readonly-dt_hr_registro css_dt_hr_registro_line" style="<?php echo $sStyleReadLab_dt_hr_registro; ?>"><?php echo $this->form_format_readonly("dt_hr_registro", $this->form_encode_input($dt_hr_registro)); ?></span><span id="id_read_off_dt_hr_registro" class="css_read_off_dt_hr_registro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_registro; ?>"><?php
$tmp_form_data = $this->field_config['dt_hr_registro']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_dt_hr_registro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_registro" type=text name="dt_hr_registro" value="<?php echo $this->form_encode_input($dt_hr_registro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['dt_hr_registro']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_hr_registro']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>


<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_registro_hora"]) &&  $this->nmgp_cmp_readonly["dt_hr_registro_hora"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_registro_hora" value="<?php echo $this->form_encode_input($dt_hr_registro_hora) . "\">" . $dt_hr_registro_hora . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_registro_hora" class="sc-ui-readonly-dt_hr_registro_hora css_dt_hr_registro_hora_line" style="<?php echo $sStyleReadLab_dt_hr_registro; ?>"><?php echo $this->form_format_readonly("dt_hr_registro_hora", $this->form_encode_input($dt_hr_registro_hora)); ?></span><span id="id_read_off_dt_hr_registro_hora" class="css_read_off_dt_hr_registro_hora<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_registro; ?>"><?php
$tmp_form_data = $this->field_config['dt_hr_registro_hora']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_dt_hr_registro_hora_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_registro_hora" type=text name="dt_hr_registro_hora" value="<?php echo $this->form_encode_input($dt_hr_registro_hora) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> alt="{datatype: 'time', dateSep: '<?php echo $this->field_config['dt_hr_registro']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['dt_hr_registro']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ ', timeSep: '<?php echo $this->field_config['dt_hr_registro_hora']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['dt_hr_registro_hora']['date_format']; ?>'}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_hr_registro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_hr_registro_text"></span></td></tr></table></td></tr></table></TD>
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
        $this->nm_new_label['cod_usuario'] = "Usuário";
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
    <TD class="scFormDataOdd css_cod_usuario_line" id="hidden_field_data_cod_usuario" style="<?php echo $sStyleHidden_cod_usuario; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_usuario_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_usuario"]) &&  $this->nmgp_cmp_readonly["cod_usuario"] == "on") { 

 ?>
<input type="hidden" name="cod_usuario" value="<?php echo $this->form_encode_input($cod_usuario) . "\">" . $cod_usuario . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_usuario" class="sc-ui-readonly-cod_usuario css_cod_usuario_line" style="<?php echo $sStyleReadLab_cod_usuario; ?>"><?php echo $this->form_format_readonly("cod_usuario", $this->form_encode_input($this->cod_usuario)); ?></span><span id="id_read_off_cod_usuario" class="css_read_off_cod_usuario<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_usuario; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_usuario_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_usuario" type=text name="cod_usuario" value="<?php echo $this->form_encode_input($cod_usuario) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['motivo']))
    {
        $this->nm_new_label['motivo'] = "Motivo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $motivo = $this->motivo;
   $sStyleHidden_motivo = '';
   if (isset($this->nmgp_cmp_hidden['motivo']) && $this->nmgp_cmp_hidden['motivo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['motivo']);
       $sStyleHidden_motivo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_motivo = 'display: none;';
   $sStyleReadInp_motivo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['motivo']) && $this->nmgp_cmp_readonly['motivo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['motivo']);
       $sStyleReadLab_motivo = '';
       $sStyleReadInp_motivo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['motivo']) && $this->nmgp_cmp_hidden['motivo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="motivo" value="<?php echo $this->form_encode_input($motivo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_motivo_label" id="hidden_field_label_motivo" style="<?php echo $sStyleHidden_motivo; ?>"><span id="id_label_motivo"><?php echo $this->nm_new_label['motivo']; ?></span></TD>
    <TD class="scFormDataOdd css_motivo_line" id="hidden_field_data_motivo" style="<?php echo $sStyleHidden_motivo; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_motivo_line" style="vertical-align: top;padding: 0px">
<?php
$motivo_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($motivo));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["motivo"]) &&  $this->nmgp_cmp_readonly["motivo"] == "on") { 

 ?>
<input type="hidden" name="motivo" value="<?php echo $this->form_encode_input($motivo) . "\">" . $motivo_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_motivo" class="sc-ui-readonly-motivo css_motivo_line" style="<?php echo $sStyleReadLab_motivo; ?>"><?php echo $this->form_format_readonly("motivo", $this->form_encode_input($motivo_val)); ?></span><span id="id_read_off_motivo" class="css_read_off_motivo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_motivo; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_motivo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="motivo" id="id_sc_field_motivo" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 400, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $motivo; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_motivo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_motivo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['vl_media']))
    {
        $this->nm_new_label['vl_media'] = "Vl Media";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $vl_media = $this->vl_media;
   $sStyleHidden_vl_media = '';
   if (isset($this->nmgp_cmp_hidden['vl_media']) && $this->nmgp_cmp_hidden['vl_media'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['vl_media']);
       $sStyleHidden_vl_media = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_vl_media = 'display: none;';
   $sStyleReadInp_vl_media = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['vl_media']) && $this->nmgp_cmp_readonly['vl_media'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['vl_media']);
       $sStyleReadLab_vl_media = '';
       $sStyleReadInp_vl_media = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['vl_media']) && $this->nmgp_cmp_hidden['vl_media'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="vl_media" value="<?php echo $this->form_encode_input($vl_media) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_vl_media_label" id="hidden_field_label_vl_media" style="<?php echo $sStyleHidden_vl_media; ?>"><span id="id_label_vl_media"><?php echo $this->nm_new_label['vl_media']; ?></span></TD>
    <TD class="scFormDataOdd css_vl_media_line" id="hidden_field_data_vl_media" style="<?php echo $sStyleHidden_vl_media; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_vl_media_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["vl_media"]) &&  $this->nmgp_cmp_readonly["vl_media"] == "on") { 

 ?>
<input type="hidden" name="vl_media" value="<?php echo $this->form_encode_input($vl_media) . "\">" . $vl_media . ""; ?>
<?php } else { ?>
<span id="id_read_on_vl_media" class="sc-ui-readonly-vl_media css_vl_media_line" style="<?php echo $sStyleReadLab_vl_media; ?>"><?php echo $this->form_format_readonly("vl_media", $this->form_encode_input($this->vl_media)); ?></span><span id="id_read_off_vl_media" class="css_read_off_vl_media<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_vl_media; ?>">
 <input class="sc-js-input scFormObjectOdd css_vl_media_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_vl_media" type=text name="vl_media" value="<?php echo $this->form_encode_input($vl_media) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=19"; } ?> alt="{datatype: 'decimal', maxLength: 19, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_media']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['vl_media']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['vl_media']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['vl_media']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_vl_media_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_vl_media_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>


<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>

<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['num_situacao']))
   {
       $this->nm_new_label['num_situacao'] = "Situação";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $num_situacao = $this->num_situacao;
   $sStyleHidden_num_situacao = '';
   if (isset($this->nmgp_cmp_hidden['num_situacao']) && $this->nmgp_cmp_hidden['num_situacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['num_situacao']);
       $sStyleHidden_num_situacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_num_situacao = 'display: none;';
   $sStyleReadInp_num_situacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['num_situacao']) && $this->nmgp_cmp_readonly['num_situacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['num_situacao']);
       $sStyleReadLab_num_situacao = '';
       $sStyleReadInp_num_situacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['num_situacao']) && $this->nmgp_cmp_hidden['num_situacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="num_situacao" value="<?php echo $this->form_encode_input($this->num_situacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_num_situacao_label" id="hidden_field_label_num_situacao" style="<?php echo $sStyleHidden_num_situacao; ?>"><span id="id_label_num_situacao"><?php echo $this->nm_new_label['num_situacao']; ?></span></TD>
    <TD class="scFormDataOdd css_num_situacao_line" id="hidden_field_data_num_situacao" style="<?php echo $sStyleHidden_num_situacao; ?>vertical-align: top;"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_num_situacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["num_situacao"]) &&  $this->nmgp_cmp_readonly["num_situacao"] == "on") { 

$num_situacao_look = "";
 if ($this->num_situacao == "1") { $num_situacao_look .= "Pendente" ;} 
 if ($this->num_situacao == "2") { $num_situacao_look .= "Calculado" ;} 
 if ($this->num_situacao == "3") { $num_situacao_look .= "Cancelado" ;} 
 if (empty($num_situacao_look)) { $num_situacao_look = $this->num_situacao; }
?>
<input type="hidden" name="num_situacao" value="<?php echo $this->form_encode_input($num_situacao) . "\">" . $num_situacao_look . ""; ?>
<?php } else { ?>
<?php

$num_situacao_look = "";
 if ($this->num_situacao == "1") { $num_situacao_look .= "Pendente" ;} 
 if ($this->num_situacao == "2") { $num_situacao_look .= "Calculado" ;} 
 if ($this->num_situacao == "3") { $num_situacao_look .= "Cancelado" ;} 
 if (empty($num_situacao_look)) { $num_situacao_look = $this->num_situacao; }
?>
<span id="id_read_on_num_situacao" class="css_num_situacao_line"  style="<?php echo $sStyleReadLab_num_situacao; ?>"><?php echo $this->form_format_readonly("num_situacao", $this->form_encode_input($num_situacao_look)); ?></span><span id="id_read_off_num_situacao" class="css_read_off_num_situacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_num_situacao; ?>">
 <span id="idAjaxSelect_num_situacao" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_num_situacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_num_situacao" name="num_situacao" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="1" <?php  if ($this->num_situacao == "1") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['Lookup_num_situacao'][] = '1'; ?>
 <option  value="2" <?php  if ($this->num_situacao == "2") { echo " selected" ;} ?>>Calculado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['Lookup_num_situacao'][] = '2'; ?>
 <option  value="3" <?php  if ($this->num_situacao == "3") { echo " selected" ;} ?>>Cancelado</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['Lookup_num_situacao'][] = '3'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_num_situacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_num_situacao_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['md_itens_media_custo']))
    {
        $this->nm_new_label['md_itens_media_custo'] = "Itens Média";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $md_itens_media_custo = $this->md_itens_media_custo;
   $sStyleHidden_md_itens_media_custo = '';
   if (isset($this->nmgp_cmp_hidden['md_itens_media_custo']) && $this->nmgp_cmp_hidden['md_itens_media_custo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['md_itens_media_custo']);
       $sStyleHidden_md_itens_media_custo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_md_itens_media_custo = 'display: none;';
   $sStyleReadInp_md_itens_media_custo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['md_itens_media_custo']) && $this->nmgp_cmp_readonly['md_itens_media_custo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['md_itens_media_custo']);
       $sStyleReadLab_md_itens_media_custo = '';
       $sStyleReadInp_md_itens_media_custo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['md_itens_media_custo']) && $this->nmgp_cmp_hidden['md_itens_media_custo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="md_itens_media_custo" value="<?php echo $this->form_encode_input($md_itens_media_custo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_md_itens_media_custo_line" id="hidden_field_data_md_itens_media_custo" style="<?php echo $sStyleHidden_md_itens_media_custo; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td width="100%" class="scFormDataFontOdd css_md_itens_media_custo_line" style="vertical-align: top;padding: 0px">
<?php
 if (isset($_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'] ]) && '' != $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'] ]) {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] = $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'] ];
 }
 else {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] = $this->Ini->sc_page;
 }
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] ]['cons_itens_media_custo']['embutida_form_full']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] ]['cons_itens_media_custo']['embutida_form']       = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] ]['cons_itens_media_custo']['embutida_pai']        = "form_medias_custo";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init'] ]['cons_itens_media_custo']['embutida_form_parms'] = "media_custo_corrente*scin" . $this->nmgp_dados_form['media_custo_id'] . "*scoutNMSC_inicial*scininicio*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
 if (isset($this->Ini->sc_lig_md5["cons_itens_media_custo"]) && $this->Ini->sc_lig_md5["cons_itens_media_custo"] == "S") {
     $Parms_Lig  = "media_custo_corrente*scin" . $this->nmgp_dados_form['media_custo_id'] . "*scoutNMSC_inicial*scininicio*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
     $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_medias_custo@SC_par@" . md5($Parms_Lig);
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
 } else {
     $Md5_Lig  = "media_custo_corrente*scin" . $this->nmgp_dados_form['media_custo_id'] . "*scoutNMSC_inicial*scininicio*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
 }
 $parms_lig_cons = "&nmgp_parms=" . $Md5_Lig;
 $sDetailSrc = ('novo' == $this->nmgp_opcao) ? 'form_medias_custo_empty.htm' : $this->Ini->link_cons_itens_media_custo_cons . '?script_case_init=' . $this->form_encode_input($this->Ini->sc_page) . '&script_case_detail=Y&sc_ifr_height=800' . $parms_lig_cons;
if (isset($this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo']) && 'nmsc_iframe_liga_cons_itens_media_custo' != $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'])
{
    if ('novo' != $this->nmgp_opcao)
    {
        $sDetailSrc .= '&under_dashboard=1&dashboard_app=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['dashboard_app'] . '&own_widget=' . $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'] . '&parent_widget=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['own_widget'];
        $sDetailSrc  = $this->addUrlParam($sDetailSrc, 'script_case_init', $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['cons_itens_media_custo_script_case_init']);
    }
?>
<script type="text/javascript">
$(function() {
    scOpenMasterDetail("<?php echo $this->Ini->sc_lig_target['C_@scinf_md_itens_media_custo'] ?>", "<?php echo $sDetailSrc; ?>");
});
</script>
<?php
}
else
{
?>
<iframe border="0" id="nmsc_iframe_liga_cons_itens_media_custo"  marginWidth="0" marginHeight="0" frameborder="0" valign="top" height="800" width="100%" name="nmsc_iframe_liga_cons_itens_media_custo"  scrolling="auto" src="<?php echo $sDetailSrc; ?>"></iframe>
<?php
}
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_md_itens_media_custo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_md_itens_media_custo_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>






<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>





<?php } 
?> 






</TABLE></div><!-- bloco_f -->
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
  $nm_sc_blocos_da_pag = array(0,1);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_medias_custo");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_medias_custo");
 parent.scAjaxDetailHeight("form_medias_custo", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_medias_custo", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_medias_custo", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['sc_modal'])
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
        function scBtnFn_bt_calc() {
                if ($("#sc_bt_calc_top").length && $("#sc_bt_calc_top").is(":visible")) {
                    if ($("#sc_bt_calc_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_calc()
                         return;
                }
        }
        function scBtnFn_bt_gerar_lanc() {
                if ($("#sc_bt_gerar_lanc_top").length && $("#sc_bt_gerar_lanc_top").is(":visible")) {
                    if ($("#sc_bt_gerar_lanc_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_gerar_lanc()
                         return;
                }
        }
        function scBtnFn_bt_cancelar() {
                if ($("#sc_bt_cancelar_top").length && $("#sc_bt_cancelar_top").is(":visible")) {
                    if ($("#sc_bt_cancelar_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_bt_cancelar()
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_medias_custo']['buttonStatus'] = $this->nmgp_botoes;
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
