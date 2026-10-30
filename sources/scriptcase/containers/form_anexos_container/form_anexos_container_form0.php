<?php
class form_anexos_container_form extends form_anexos_container_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - Anexos do Container"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - Anexos do Container"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
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
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
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
<?php
           $fixColNotFixedVisibility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $fixColNotFixedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '1' : '1';
?>
    <style type="text/css">
        .sc-col-actions {
            text-align: center !important;
        }
        .sc-op-fix-col {
            padding: 0 2px;
        }
        .sc-op-fix-col:hover {
            cursor: pointer;
        }
        .sc-op-fix-col-notfixed {
            visibility: <?php echo $fixColNotFixedVisibility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-op-fix-col-notfixed {
            visibility: visible;
            opacity: <?php echo $fixColNotFixedOpacity ?>;
        }
        #sc-fld-fix-col-0 {
            display: none;
        }
    </style>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_anexos_container/form_anexos_container_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_anexos_container_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['last'] : 'off'); ?>";
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
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
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

include_once('form_anexos_container_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {


  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['link_info']['remove_border']) {
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
 include_once("form_anexos_container_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php if (!isset($sc_check_excl)) {$sc_check_excl = array();} echo count($sc_check_excl); ?>; 
  <?php if (!isset($sc_check_incl)) {$sc_check_incl = array();}?>; 
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
<input type="hidden" name="upload_file_row" value="">
<?php
$_SESSION['scriptcase']['error_span_title']['form_anexos_container'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_anexos_container'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['fast_search'][2] : "";
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
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['exit'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
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
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
   $this->form_fixed_column_no = 0;
?>
<?php
   if (!isset($this->nmgp_cmp_hidden['anexo_container_id_']))
   {
       $this->nmgp_cmp_hidden['anexo_container_id_'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['container_id_']))
   {
       $this->nmgp_cmp_hidden['container_id_'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']))
   {
       $this->nmgp_cmp_hidden['dt_hr_arquivo_'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['item_container_id_']))
   {
       $this->nmgp_cmp_hidden['item_container_id_'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
$labelRowCount = 0;
?>
   <tr class="sc-ui-header-row" id="sc-id-fixed-headers-row-<?php echo $labelRowCount++ ?>">
<?php
$orderColName = '';
$orderColOrient = '';
$orderColRule = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>


   <?php
        $classColFld = "";
        $classColActions = "";
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
        }
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" <?php echo $Col_span ?>> <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php 
        if (!$this->Embutida_form) { $this->form_fixed_column_no++; }
 ?>
   <?php
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" > <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") { ?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" >  </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { ?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" >  </TD>
   <?php }?>
   <?php if ((!isset($this->nmgp_cmp_hidden['anexo_container_id_']) || $this->nmgp_cmp_hidden['anexo_container_id_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['anexo_container_id_'])) {
          $this->nm_new_label['anexo_container_id_'] = "Anexo Container Id"; } ?>
<?php
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;

        // label
        $label_labelContent = $this->nm_new_label['anexo_container_id_'];
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_anexo_container_id__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_anexo_container_id_" style="<?php echo $sStyleHidden_anexo_container_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php $this->form_fixed_column_no++;}?>

   <?php
    $sStyleHidden_container_id_ = '';
    if (isset($this->nmgp_cmp_hidden['container_id_']) && $this->nmgp_cmp_hidden['container_id_'] == 'off') {
        $sStyleHidden_container_id_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['container_id_']) || $this->nmgp_cmp_hidden['container_id_'] == 'on') {
        if (!isset($this->nm_new_label['container_id_'])) {
            $this->nm_new_label['container_id_'] = "Container Id";
        }
        $SC_Label = "" . $this->nm_new_label['container_id_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_container_id__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_container_id_" style="<?php echo $sStyleHidden_container_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_descricao_ = '';
    if (isset($this->nmgp_cmp_hidden['descricao_']) && $this->nmgp_cmp_hidden['descricao_'] == 'off') {
        $sStyleHidden_descricao_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['descricao_']) || $this->nmgp_cmp_hidden['descricao_'] == 'on') {
        if (!isset($this->nm_new_label['descricao_'])) {
            $this->nm_new_label['descricao_'] = "Descrição";
        }
        $SC_Label = "" . $this->nm_new_label['descricao_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_descricao__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_descricao_" style="<?php echo $sStyleHidden_descricao_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_tipos_anexo_id_ = '';
    if (isset($this->nmgp_cmp_hidden['tipos_anexo_id_']) && $this->nmgp_cmp_hidden['tipos_anexo_id_'] == 'off') {
        $sStyleHidden_tipos_anexo_id_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['tipos_anexo_id_']) || $this->nmgp_cmp_hidden['tipos_anexo_id_'] == 'on') {
        if (!isset($this->nm_new_label['tipos_anexo_id_'])) {
            $this->nm_new_label['tipos_anexo_id_'] = "Tipo";
        }
        $SC_Label = "" . $this->nm_new_label['tipos_anexo_id_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_tipos_anexo_id__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_tipos_anexo_id_" style="<?php echo $sStyleHidden_tipos_anexo_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_caminho_arquivo_ = '';
    if (isset($this->nmgp_cmp_hidden['caminho_arquivo_']) && $this->nmgp_cmp_hidden['caminho_arquivo_'] == 'off') {
        $sStyleHidden_caminho_arquivo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['caminho_arquivo_']) || $this->nmgp_cmp_hidden['caminho_arquivo_'] == 'on') {
        if (!isset($this->nm_new_label['caminho_arquivo_'])) {
            $this->nm_new_label['caminho_arquivo_'] = "Arquivo";
        }
        $SC_Label = "" . $this->nm_new_label['caminho_arquivo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_caminho_arquivo__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_caminho_arquivo_" style="<?php echo $sStyleHidden_caminho_arquivo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_dt_hr_arquivo_ = '';
    if (isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']) && $this->nmgp_cmp_hidden['dt_hr_arquivo_'] == 'off') {
        $sStyleHidden_dt_hr_arquivo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']) || $this->nmgp_cmp_hidden['dt_hr_arquivo_'] == 'on') {
        if (!isset($this->nm_new_label['dt_hr_arquivo_'])) {
            $this->nm_new_label['dt_hr_arquivo_'] = "Data/Hora ";
        }
        $SC_Label = "" . $this->nm_new_label['dt_hr_arquivo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_dt_hr_arquivo__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_dt_hr_arquivo_" style="<?php echo $sStyleHidden_dt_hr_arquivo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_item_container_id_ = '';
    if (isset($this->nmgp_cmp_hidden['item_container_id_']) && $this->nmgp_cmp_hidden['item_container_id_'] == 'off') {
        $sStyleHidden_item_container_id_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['item_container_id_']) || $this->nmgp_cmp_hidden['item_container_id_'] == 'on') {
        if (!isset($this->nm_new_label['item_container_id_'])) {
            $this->nm_new_label['item_container_id_'] = "Item Container Id";
        }
        $SC_Label = "" . $this->nm_new_label['item_container_id_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_item_container_id__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_item_container_id_" style="<?php echo $sStyleHidden_item_container_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     orderColRule = "<?php echo $orderColRule ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert, $sc_check_incl, $sc_check_excl; 
   $sc_hidden_no = 1; $sc_hidden_yes = 0;
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_anexos_container);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_anexos_container = $this->form_vert_form_anexos_container;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_anexos_container))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['anexo_container_id_']))
           {
               $this->nmgp_cmp_readonly['anexo_container_id_'] = 'on';
           }
   foreach ($this->form_vert_form_anexos_container as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['anexo_container_id_'] = true;
           $this->nmgp_cmp_readonly['container_id_'] = true;
           $this->nmgp_cmp_readonly['descricao_'] = true;
           $this->nmgp_cmp_readonly['tipos_anexo_id_'] = true;
           $this->nmgp_cmp_readonly['caminho_arquivo_'] = true;
           $this->nmgp_cmp_readonly['dt_hr_arquivo_'] = true;
           $this->nmgp_cmp_readonly['item_container_id_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['anexo_container_id_']) || $this->nmgp_cmp_readonly['anexo_container_id_'] != "on") {$this->nmgp_cmp_readonly['anexo_container_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['container_id_']) || $this->nmgp_cmp_readonly['container_id_'] != "on") {$this->nmgp_cmp_readonly['container_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['descricao_']) || $this->nmgp_cmp_readonly['descricao_'] != "on") {$this->nmgp_cmp_readonly['descricao_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tipos_anexo_id_']) || $this->nmgp_cmp_readonly['tipos_anexo_id_'] != "on") {$this->nmgp_cmp_readonly['tipos_anexo_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['caminho_arquivo_']) || $this->nmgp_cmp_readonly['caminho_arquivo_'] != "on") {$this->nmgp_cmp_readonly['caminho_arquivo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['dt_hr_arquivo_']) || $this->nmgp_cmp_readonly['dt_hr_arquivo_'] != "on") {$this->nmgp_cmp_readonly['dt_hr_arquivo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['item_container_id_']) || $this->nmgp_cmp_readonly['item_container_id_'] != "on") {$this->nmgp_cmp_readonly['item_container_id_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->anexo_container_id_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['anexo_container_id_']; 
       $anexo_container_id_ = $this->anexo_container_id_; 
       if (!isset($this->nmgp_cmp_hidden['anexo_container_id_']))
       {
           $this->nmgp_cmp_hidden['anexo_container_id_'] = 'off';
       }
       $sStyleHidden_anexo_container_id_ = '';
       if (isset($sCheckRead_anexo_container_id_))
       {
           unset($sCheckRead_anexo_container_id_);
       }
       if (isset($this->nmgp_cmp_readonly['anexo_container_id_']))
       {
           $sCheckRead_anexo_container_id_ = $this->nmgp_cmp_readonly['anexo_container_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['anexo_container_id_']) && $this->nmgp_cmp_hidden['anexo_container_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['anexo_container_id_']);
           $sStyleHidden_anexo_container_id_ = 'display: none;';
       }
       $bTestReadOnly_anexo_container_id_ = true;
       $sStyleReadLab_anexo_container_id_ = 'display: none;';
       $sStyleReadInp_anexo_container_id_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["anexo_container_id_"]) &&  $this->nmgp_cmp_readonly["anexo_container_id_"] == "on"))
       {
           $bTestReadOnly_anexo_container_id_ = false;
           unset($this->nmgp_cmp_readonly['anexo_container_id_']);
           $sStyleReadLab_anexo_container_id_ = '';
           $sStyleReadInp_anexo_container_id_ = 'display: none;';
       }
       $this->container_id_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['container_id_']; 
       $container_id_ = $this->container_id_; 
       if (!isset($this->nmgp_cmp_hidden['container_id_']))
       {
           $this->nmgp_cmp_hidden['container_id_'] = 'off';
       }
       $sStyleHidden_container_id_ = '';
       if (isset($sCheckRead_container_id_))
       {
           unset($sCheckRead_container_id_);
       }
       if (isset($this->nmgp_cmp_readonly['container_id_']))
       {
           $sCheckRead_container_id_ = $this->nmgp_cmp_readonly['container_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['container_id_']) && $this->nmgp_cmp_hidden['container_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['container_id_']);
           $sStyleHidden_container_id_ = 'display: none;';
       }
       $bTestReadOnly_container_id_ = true;
       $sStyleReadLab_container_id_ = 'display: none;';
       $sStyleReadInp_container_id_ = '';
       if (isset($this->nmgp_cmp_readonly['container_id_']) && $this->nmgp_cmp_readonly['container_id_'] == 'on')
       {
           $bTestReadOnly_container_id_ = false;
           unset($this->nmgp_cmp_readonly['container_id_']);
           $sStyleReadLab_container_id_ = '';
           $sStyleReadInp_container_id_ = 'display: none;';
       }
       $this->descricao_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['descricao_']; 
       $descricao_ = $this->descricao_; 
       $sStyleHidden_descricao_ = '';
       if (isset($sCheckRead_descricao_))
       {
           unset($sCheckRead_descricao_);
       }
       if (isset($this->nmgp_cmp_readonly['descricao_']))
       {
           $sCheckRead_descricao_ = $this->nmgp_cmp_readonly['descricao_'];
       }
       if (isset($this->nmgp_cmp_hidden['descricao_']) && $this->nmgp_cmp_hidden['descricao_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['descricao_']);
           $sStyleHidden_descricao_ = 'display: none;';
       }
       $bTestReadOnly_descricao_ = true;
       $sStyleReadLab_descricao_ = 'display: none;';
       $sStyleReadInp_descricao_ = '';
       if (isset($this->nmgp_cmp_readonly['descricao_']) && $this->nmgp_cmp_readonly['descricao_'] == 'on')
       {
           $bTestReadOnly_descricao_ = false;
           unset($this->nmgp_cmp_readonly['descricao_']);
           $sStyleReadLab_descricao_ = '';
           $sStyleReadInp_descricao_ = 'display: none;';
       }
       $this->tipos_anexo_id_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['tipos_anexo_id_']; 
       $tipos_anexo_id_ = $this->tipos_anexo_id_; 
       $sStyleHidden_tipos_anexo_id_ = '';
       if (isset($sCheckRead_tipos_anexo_id_))
       {
           unset($sCheckRead_tipos_anexo_id_);
       }
       if (isset($this->nmgp_cmp_readonly['tipos_anexo_id_']))
       {
           $sCheckRead_tipos_anexo_id_ = $this->nmgp_cmp_readonly['tipos_anexo_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['tipos_anexo_id_']) && $this->nmgp_cmp_hidden['tipos_anexo_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tipos_anexo_id_']);
           $sStyleHidden_tipos_anexo_id_ = 'display: none;';
       }
       $bTestReadOnly_tipos_anexo_id_ = true;
       $sStyleReadLab_tipos_anexo_id_ = 'display: none;';
       $sStyleReadInp_tipos_anexo_id_ = '';
       if (isset($this->nmgp_cmp_readonly['tipos_anexo_id_']) && $this->nmgp_cmp_readonly['tipos_anexo_id_'] == 'on')
       {
           $bTestReadOnly_tipos_anexo_id_ = false;
           unset($this->nmgp_cmp_readonly['tipos_anexo_id_']);
           $sStyleReadLab_tipos_anexo_id_ = '';
           $sStyleReadInp_tipos_anexo_id_ = 'display: none;';
       }
       $this->caminho_arquivo_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['caminho_arquivo_']; 
       $caminho_arquivo_ = $this->caminho_arquivo_; 
       $this->caminho_arquivo__limpa = $this->form_vert_form_anexos_container[$sc_seq_vert]['caminho_arquivo__limpa']; 
       $caminho_arquivo__limpa = $this->caminho_arquivo__limpa; 
       $sTmpFile_caminho_arquivo_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['caminho_arquivo__download_filename'];
       $sStyleHidden_caminho_arquivo_ = '';
       if (isset($sCheckRead_caminho_arquivo_))
       {
           unset($sCheckRead_caminho_arquivo_);
       }
       if (isset($this->nmgp_cmp_readonly['caminho_arquivo_']))
       {
           $sCheckRead_caminho_arquivo_ = $this->nmgp_cmp_readonly['caminho_arquivo_'];
       }
       if (isset($this->nmgp_cmp_hidden['caminho_arquivo_']) && $this->nmgp_cmp_hidden['caminho_arquivo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['caminho_arquivo_']);
           $sStyleHidden_caminho_arquivo_ = 'display: none;';
       }
       $bTestReadOnly_caminho_arquivo_ = true;
       $sStyleReadLab_caminho_arquivo_ = 'display: none;';
       $sStyleReadInp_caminho_arquivo_ = '';
       if (isset($this->nmgp_cmp_readonly['caminho_arquivo_']) && $this->nmgp_cmp_readonly['caminho_arquivo_'] == 'on')
       {
           $bTestReadOnly_caminho_arquivo_ = false;
           unset($this->nmgp_cmp_readonly['caminho_arquivo_']);
           $sStyleReadLab_caminho_arquivo_ = '';
           $sStyleReadInp_caminho_arquivo_ = 'display: none;';
       }
       $this->dt_hr_arquivo_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['dt_hr_arquivo_']; 
       $dt_hr_arquivo_ = $this->dt_hr_arquivo_; 
       if (!isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']))
       {
           $this->nmgp_cmp_hidden['dt_hr_arquivo_'] = 'off';
       }
       $sStyleHidden_dt_hr_arquivo_ = '';
       if (isset($sCheckRead_dt_hr_arquivo_))
       {
           unset($sCheckRead_dt_hr_arquivo_);
       }
       if (isset($this->nmgp_cmp_readonly['dt_hr_arquivo_']))
       {
           $sCheckRead_dt_hr_arquivo_ = $this->nmgp_cmp_readonly['dt_hr_arquivo_'];
       }
       if (isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']) && $this->nmgp_cmp_hidden['dt_hr_arquivo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['dt_hr_arquivo_']);
           $sStyleHidden_dt_hr_arquivo_ = 'display: none;';
       }
       $bTestReadOnly_dt_hr_arquivo_ = true;
       $sStyleReadLab_dt_hr_arquivo_ = 'display: none;';
       $sStyleReadInp_dt_hr_arquivo_ = '';
       if (isset($this->nmgp_cmp_readonly['dt_hr_arquivo_']) && $this->nmgp_cmp_readonly['dt_hr_arquivo_'] == 'on')
       {
           $bTestReadOnly_dt_hr_arquivo_ = false;
           unset($this->nmgp_cmp_readonly['dt_hr_arquivo_']);
           $sStyleReadLab_dt_hr_arquivo_ = '';
           $sStyleReadInp_dt_hr_arquivo_ = 'display: none;';
       }
       $this->item_container_id_ = $this->form_vert_form_anexos_container[$sc_seq_vert]['item_container_id_']; 
       $item_container_id_ = $this->item_container_id_; 
       if (!isset($this->nmgp_cmp_hidden['item_container_id_']))
       {
           $this->nmgp_cmp_hidden['item_container_id_'] = 'off';
       }
       $sStyleHidden_item_container_id_ = '';
       if (isset($sCheckRead_item_container_id_))
       {
           unset($sCheckRead_item_container_id_);
       }
       if (isset($this->nmgp_cmp_readonly['item_container_id_']))
       {
           $sCheckRead_item_container_id_ = $this->nmgp_cmp_readonly['item_container_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['item_container_id_']) && $this->nmgp_cmp_hidden['item_container_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['item_container_id_']);
           $sStyleHidden_item_container_id_ = 'display: none;';
       }
       $bTestReadOnly_item_container_id_ = true;
       $sStyleReadLab_item_container_id_ = 'display: none;';
       $sStyleReadInp_item_container_id_ = '';
       if (isset($this->nmgp_cmp_readonly['item_container_id_']) && $this->nmgp_cmp_readonly['item_container_id_'] == 'on')
       {
           $bTestReadOnly_item_container_id_ = false;
           unset($this->nmgp_cmp_readonly['item_container_id_']);
           $sStyleReadLab_item_container_id_ = '';
           $sStyleReadInp_item_container_id_ = 'display: none;';
       }

       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">
<input type="hidden" name="caminho_arquivo__ul_name<?php echo $sc_seq_vert; ?>" id="id_sc_field_caminho_arquivo__ul_name<?php echo $sc_seq_vert; ?>" value="<?php echo $this->form_encode_input($this->caminho_arquivo__ul_name);?>">
<input type="hidden" name="caminho_arquivo__ul_type<?php echo $sc_seq_vert; ?>" id="id_sc_field_caminho_arquivo__ul_type<?php echo $sc_seq_vert; ?>" value="<?php echo $this->form_encode_input($this->caminho_arquivo__ul_type);?>">


   <?php
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form) {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_anexos_container_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_anexos_container_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_anexos_container_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_anexos_container_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_anexos_container_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_anexos_container_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
 </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (isset($this->nmgp_cmp_hidden['anexo_container_id_']) && $this->nmgp_cmp_hidden['anexo_container_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="anexo_container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($anexo_container_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_anexo_container_id__line <?php echo $classColFld ?>" id="hidden_field_data_anexo_container_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_anexo_container_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_anexo_container_id__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_anexo_container_id_<?php echo $sc_seq_vert ?>" class="css_anexo_container_id__line" style="<?php echo $sStyleReadLab_anexo_container_id_; ?>"><?php echo $this->form_format_readonly("anexo_container_id_", $this->form_encode_input($this->anexo_container_id_)); ?></span><span id="id_read_off_anexo_container_id_<?php echo $sc_seq_vert ?>" class="css_read_off_anexo_container_id_" style="<?php echo $sStyleReadInp_anexo_container_id_; ?>"><input type="hidden" id="id_sc_field_anexo_container_id_<?php echo $sc_seq_vert ?>" name="anexo_container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($anexo_container_id_) . "\">"?>
<span id="id_ajax_label_anexo_container_id_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($anexo_container_id_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_anexo_container_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_anexo_container_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['container_id_']) && $this->nmgp_cmp_hidden['container_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($container_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_container_id__line <?php echo $classColFld ?>" id="hidden_field_data_container_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_container_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_container_id__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_container_id_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["container_id_"]) &&  $this->nmgp_cmp_readonly["container_id_"] == "on") { 

 ?>
<input type="hidden" name="container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($container_id_) . "\">" . $container_id_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_container_id_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-container_id_<?php echo $sc_seq_vert ?> css_container_id__line" style="<?php echo $sStyleReadLab_container_id_; ?>"><?php echo $this->form_format_readonly("container_id_", $this->form_encode_input($this->container_id_)); ?></span><span id="id_read_off_container_id_<?php echo $sc_seq_vert ?>" class="css_read_off_container_id_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_container_id_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_container_id__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_container_id_<?php echo $sc_seq_vert ?>" type=text name="container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($container_id_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['container_id_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['container_id_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['container_id_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_container_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_container_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['descricao_']) && $this->nmgp_cmp_hidden['descricao_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descricao_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descricao_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_descricao__line <?php echo $classColFld ?>" id="hidden_field_data_descricao_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_descricao_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_descricao__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_descricao_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao_"]) &&  $this->nmgp_cmp_readonly["descricao_"] == "on") { 

 ?>
<input type="hidden" name="descricao_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descricao_) . "\">" . $descricao_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-descricao_<?php echo $sc_seq_vert ?> css_descricao__line" style="<?php echo $sStyleReadLab_descricao_; ?>"><?php echo $this->form_format_readonly("descricao_", $this->form_encode_input($this->descricao_)); ?></span><span id="id_read_off_descricao_<?php echo $sc_seq_vert ?>" class="css_read_off_descricao_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_descricao__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao_<?php echo $sc_seq_vert ?>" type=text name="descricao_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($descricao_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=800 alt="{datatype: 'text', maxLength: 800, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tipos_anexo_id_']) && $this->nmgp_cmp_hidden['tipos_anexo_id_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tipos_anexo_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->tipos_anexo_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_tipos_anexo_id__line <?php echo $classColFld ?>" id="hidden_field_data_tipos_anexo_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tipos_anexo_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tipos_anexo_id__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tipos_anexo_id_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipos_anexo_id_"]) &&  $this->nmgp_cmp_readonly["tipos_anexo_id_"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'] = array(); 
    }

   $old_value_anexo_container_id_ = $this->anexo_container_id_;
   $old_value_container_id_ = $this->container_id_;
   $old_value_dt_hr_arquivo_ = $this->dt_hr_arquivo_;
   $old_value_item_container_id_ = $this->item_container_id_;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_anexo_container_id_ = $this->anexo_container_id_;
   $unformatted_value_container_id_ = $this->container_id_;
   $unformatted_value_dt_hr_arquivo_ = $this->dt_hr_arquivo_;
   $unformatted_value_item_container_id_ = $this->item_container_id_;

   $nm_comando = "SELECT tipo_anexo_id, descricao  FROM PUB.tipos_anexo  ORDER BY descricao";

   $this->anexo_container_id_ = $old_value_anexo_container_id_;
   $this->container_id_ = $old_value_container_id_;
   $this->dt_hr_arquivo_ = $old_value_dt_hr_arquivo_;
   $this->item_container_id_ = $old_value_item_container_id_;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'][] = $rs->fields[0];
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
   $tipos_anexo_id__look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipos_anexo_id__1))
          {
              foreach ($this->tipos_anexo_id__1 as $tmp_tipos_anexo_id_)
              {
                  if (trim($tmp_tipos_anexo_id_) === trim($cadaselect[1])) {$tipos_anexo_id__look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tipos_anexo_id_) && trim($this->tipos_anexo_id_) === trim($cadaselect[1])) {$tipos_anexo_id__look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="tipos_anexo_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tipos_anexo_id_) . "\">" . $tipos_anexo_id__look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tipos_anexo_id_();
   $x = 0 ; 
   $tipos_anexo_id__look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tipos_anexo_id__1))
          {
              foreach ($this->tipos_anexo_id__1 as $tmp_tipos_anexo_id_)
              {
                  if (trim($tmp_tipos_anexo_id_) === trim($cadaselect[1])) {$tipos_anexo_id__look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tipos_anexo_id_)) {
                 if (trim($this->tipos_anexo_id_) == trim($cadaselect[1])) { $tipos_anexo_id__look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->tipos_anexo_id_ == $cadaselect[1]) { $tipos_anexo_id__look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($tipos_anexo_id__look))
          {
              $tipos_anexo_id__look = $this->tipos_anexo_id_;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tipos_anexo_id_" . $sc_seq_vert . "\" class=\"css_tipos_anexo_id__line\" style=\"" .  $sStyleReadLab_tipos_anexo_id_ . "\">" . $this->form_format_readonly("tipos_anexo_id_", $this->form_encode_input($tipos_anexo_id__look)) . "</span><span id=\"id_read_off_tipos_anexo_id_" . $sc_seq_vert . "\" class=\"css_read_off_tipos_anexo_id_" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_tipos_anexo_id_ . "\">";
   echo " <span id=\"idAjaxSelect_tipos_anexo_id_" .  $sc_seq_vert . "\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOddMult css_tipos_anexo_id__obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_tipos_anexo_id_" . $sc_seq_vert . "\" name=\"tipos_anexo_id_" . $sc_seq_vert . "\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lookup_tipos_anexo_id_'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tipos_anexo_id_) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tipos_anexo_id_)) 
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
   if (isset($this->Ini->sc_lig_md5["form_tipos_anexo"]) && $this->Ini->sc_lig_md5["form_tipos_anexo"] == "S") {
       $Parms_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_anexos_container_lkpedt_refresh_tipos_anexo_id_*scoutnmgp_url_saida*scin*scoutnm_evt_ret_row*scin" . $sc_seq_vert . "*scoutsc_redir_atualiz*scinok*scout";
       $Md5_Lig    = "@SC_par@" . $this->form_encode_input($this->Ini->sc_page) . "@SC_par@form_anexos_container@SC_par@" . md5($Parms_Lig);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
   } else {
       $Md5_Lig  = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutnm_evt_ret_edit*scindo_ajax_form_anexos_container_lkpedt_refresh_tipos_anexo_id_*scoutnmgp_url_saida*scin*scoutnm_evt_ret_row*scin" . $sc_seq_vert . "*scoutsc_redir_atualiz*scinok*scout";
   }
 ?><?php echo nmButtonOutput($this->arr_buttons, "bform_lookuplink", "nm_submit_cap('" . $this->Ini->link_form_tipos_anexo_edit. "', '" . $Md5_Lig . "')", "nm_submit_cap('" . $this->Ini->link_form_tipos_anexo_edit. "', '" . $Md5_Lig . "')", "fldedt_tipos_anexo_id_" . $sc_seq_vert . "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php    echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipos_anexo_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipos_anexo_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['caminho_arquivo_']) && $this->nmgp_cmp_hidden['caminho_arquivo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="caminho_arquivo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($caminho_arquivo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_caminho_arquivo__line <?php echo $classColFld ?>" id="hidden_field_data_caminho_arquivo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_caminho_arquivo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_caminho_arquivo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_caminho_arquivo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["caminho_arquivo_"]) &&  $this->nmgp_cmp_readonly["caminho_arquivo_"] == "on") { 

 ?>
<input type="hidden" name="caminho_arquivo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($caminho_arquivo_) . "\"><img id=\"caminho_arquivo_<?php echo $sc_seq_vert ?><?php echo $sc_seq_vert; ?>_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_caminho_arquivo_<?php echo $sc_seq_vert; ?>\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_caminho_arquivo_, 3)) . "', 'form_anexos_container')\">" . $caminho_arquivo_ . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_caminho_arquivo_<?php echo $sc_seq_vert ?>" class="scFormLinkOddMult sc-ui-readonly-caminho_arquivo_<?php echo $sc_seq_vert ?> css_caminho_arquivo__line" style="<?php echo $sStyleReadLab_caminho_arquivo_; ?>"><?php echo $this->form_format_readonly("caminho_arquivo_", $this->caminho_arquivo_) ?></span><span id="id_read_off_caminho_arquivo_<?php echo $sc_seq_vert ?>" class="css_read_off_caminho_arquivo_" style="white-space: nowrap;<?php echo $sStyleReadInp_caminho_arquivo_; ?>">
 <input type="hidden" name="caminho_arquivo_<?php echo $sc_seq_vert ?>_salva" value="<?php echo $this->form_encode_input($this->caminho_arquivo_) ?>"><span style="display:inline-block"><span id="sc-id-upload-select-caminho_arquivo_<?php echo $sc_seq_vert ?><?php echo $sc_seq_vert ?>" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOddMult css_caminho_arquivo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="caminho_arquivo_<?php echo $sc_seq_vert ?>[]" id="id_sc_field_caminho_arquivo_<?php echo $sc_seq_vert ?>"  onchange="nm_check_insert(<?php echo $sc_seq_vert ?>);" ></span></span>
<?php
   $sCheckInsert = "";
   if ('novo' == $this->nmgp_opcao)
   {
      $sCheckInsert = "nm_check_insert(" . $sc_seq_vert . ");";
   }
?>
<span id="chk_ajax_img_caminho_arquivo_<?php echo $sc_seq_vert; ?>"<?php if ($this->nmgp_opcao == "novo" || empty($caminho_arquivo_)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="caminho_arquivo__limpa<?php echo $sc_seq_vert ?>" value="<?php echo $caminho_arquivo__limpa . '" '; if ($caminho_arquivo__limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="caminho_arquivo_<?php echo $sc_seq_vert ?><?php echo $sc_seq_vert; ?>_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_caminho_arquivo_<?php echo $sc_seq_vert; ?>"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_caminho_arquivo_, 3)); ?>', 'form_anexos_container')"><?php echo $caminho_arquivo_ ?></a></span><div id="id_img_loader_caminho_arquivo_<?php echo $sc_seq_vert; ?>" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_caminho_arquivo_<?php echo $sc_seq_vert; ?>" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_caminho_arquivo_<?php echo $sc_seq_vert; ?>" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_caminho_arquivo_ ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragfile'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_caminho_arquivo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_caminho_arquivo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['dt_hr_arquivo_']) && $this->nmgp_cmp_hidden['dt_hr_arquivo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dt_hr_arquivo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($dt_hr_arquivo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_dt_hr_arquivo__line <?php echo $classColFld ?>" id="hidden_field_data_dt_hr_arquivo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_dt_hr_arquivo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_dt_hr_arquivo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_dt_hr_arquivo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dt_hr_arquivo_"]) &&  $this->nmgp_cmp_readonly["dt_hr_arquivo_"] == "on") { 

 ?>
<input type="hidden" name="dt_hr_arquivo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($dt_hr_arquivo_) . "\">" . $dt_hr_arquivo_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_dt_hr_arquivo_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-dt_hr_arquivo_<?php echo $sc_seq_vert ?> css_dt_hr_arquivo__line" style="<?php echo $sStyleReadLab_dt_hr_arquivo_; ?>"><?php echo $this->form_format_readonly("dt_hr_arquivo_", $this->form_encode_input($this->dt_hr_arquivo_)); ?></span><span id="id_read_off_dt_hr_arquivo_<?php echo $sc_seq_vert ?>" class="css_read_off_dt_hr_arquivo_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dt_hr_arquivo_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_dt_hr_arquivo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_dt_hr_arquivo_<?php echo $sc_seq_vert ?>" type=text name="dt_hr_arquivo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($dt_hr_arquivo_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> maxlength=16 alt="{datatype: 'text', maxLength: 16, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dt_hr_arquivo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dt_hr_arquivo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['item_container_id_']) && $this->nmgp_cmp_hidden['item_container_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="item_container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($item_container_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_item_container_id__line <?php echo $classColFld ?>" id="hidden_field_data_item_container_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_item_container_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_item_container_id__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_item_container_id_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["item_container_id_"]) &&  $this->nmgp_cmp_readonly["item_container_id_"] == "on") { 

 ?>
<input type="hidden" name="item_container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($item_container_id_) . "\">" . $item_container_id_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_item_container_id_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-item_container_id_<?php echo $sc_seq_vert ?> css_item_container_id__line" style="<?php echo $sStyleReadLab_item_container_id_; ?>"><?php echo $this->form_format_readonly("item_container_id_", $this->form_encode_input($this->item_container_id_)); ?></span><span id="id_read_off_item_container_id_<?php echo $sc_seq_vert ?>" class="css_read_off_item_container_id_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_item_container_id_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_item_container_id__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_item_container_id_<?php echo $sc_seq_vert ?>" type=text name="item_container_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($item_container_id_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['item_container_id_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['item_container_id_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['item_container_id_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_item_container_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_item_container_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_anexo_container_id_))
       {
           $this->nmgp_cmp_readonly['anexo_container_id_'] = $sCheckRead_anexo_container_id_;
       }
       if ('display: none;' == $sStyleHidden_anexo_container_id_)
       {
           $this->nmgp_cmp_hidden['anexo_container_id_'] = 'off';
       }
       if (isset($sCheckRead_container_id_))
       {
           $this->nmgp_cmp_readonly['container_id_'] = $sCheckRead_container_id_;
       }
       if ('display: none;' == $sStyleHidden_container_id_)
       {
           $this->nmgp_cmp_hidden['container_id_'] = 'off';
       }
       if (isset($sCheckRead_descricao_))
       {
           $this->nmgp_cmp_readonly['descricao_'] = $sCheckRead_descricao_;
       }
       if ('display: none;' == $sStyleHidden_descricao_)
       {
           $this->nmgp_cmp_hidden['descricao_'] = 'off';
       }
       if (isset($sCheckRead_tipos_anexo_id_))
       {
           $this->nmgp_cmp_readonly['tipos_anexo_id_'] = $sCheckRead_tipos_anexo_id_;
       }
       if ('display: none;' == $sStyleHidden_tipos_anexo_id_)
       {
           $this->nmgp_cmp_hidden['tipos_anexo_id_'] = 'off';
       }
       if (isset($sCheckRead_caminho_arquivo_))
       {
           $this->nmgp_cmp_readonly['caminho_arquivo_'] = $sCheckRead_caminho_arquivo_;
       }
       if ('display: none;' == $sStyleHidden_caminho_arquivo_)
       {
           $this->nmgp_cmp_hidden['caminho_arquivo_'] = 'off';
       }
       if (isset($sCheckRead_dt_hr_arquivo_))
       {
           $this->nmgp_cmp_readonly['dt_hr_arquivo_'] = $sCheckRead_dt_hr_arquivo_;
       }
       if ('display: none;' == $sStyleHidden_dt_hr_arquivo_)
       {
           $this->nmgp_cmp_hidden['dt_hr_arquivo_'] = 'off';
       }
       if (isset($sCheckRead_item_container_id_))
       {
           $this->nmgp_cmp_readonly['item_container_id_'] = $sCheckRead_item_container_id_;
       }
       if ('display: none;' == $sStyleHidden_item_container_id_)
       {
           $this->nmgp_cmp_hidden['item_container_id_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_anexos_container = $guarda_form_vert_form_anexos_container;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div>
 <div id="sc-id-fixedheaders-placeholder" style="display: none; position: fixed; top: 0; z-index: 500"></div>
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '30') ? " selected" : "";
?> 
           <option value="30" <?php echo $obj_sel ?>>30</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['back'];
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
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

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
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_anexos_container");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_anexos_container");
 parent.scAjaxDetailHeight("form_anexos_container", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_anexos_container", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_anexos_container", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['sc_modal'])
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
                        do_ajax_form_anexos_container_add_new_line(); return false;
                         return;
                }
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
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_anexos_container']['buttonStatus'] = $this->nmgp_botoes;
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
<?php 
 } 
} 
?> 
