
 <form name="form_ajax_redir_1" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_outra_jan">

 </form>
 <form name="form_ajax_redir_2" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_url_saida">
  <input type="hidden" name="script_case_init">

 </form>

 <SCRIPT>
<?php
sajax_show_javascript();
?>

  function scCenterElement(oElem)
  {
    var $oElem    = $(oElem),
        $oWindow  = $(this),
        iElemTop  = Math.round(($oWindow.height() - $oElem.height()) / 2),
        iElemLeft = Math.round(($oWindow.width()  - $oElem.width())  / 2);

    $oElem.offset({top: iElemTop, left: iElemLeft});
  } // scCenterElement

  function scAjaxHideAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "none";
    }
  } // scAjaxHideAutocomp

  function scAjaxShowAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "";
      document.getElementById("id_ac_" + sFrameId).focus();
    }
  } // scAjaxShowAutocomp

  function scAjaxHideDebug()
  {
    if (document.getElementById("id_debug_window"))
    {
      document.getElementById("id_debug_window").style.display = "none";
      document.getElementById("id_debug_text").innerHTML = "";
    }
  } // scAjaxHideDebug

  function scAjaxShowDebug(oTemp)
  {
    if (!document.getElementById("id_debug_window"))
    {
      return;
    }
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["htmOutput"] && "" != oResp["htmOutput"])
    {
      document.getElementById("id_debug_window").style.display = "";
      document.getElementById("id_debug_text").innerHTML = scAjaxFormatDebug(oResp["htmOutput"]) + document.getElementById("id_debug_text").innerHTML;
      //scCenterElement(document.getElementById("id_debug_window"));
    }
  } // scAjaxShowDebug

  function scAjaxFormatDebug(sDebugMsg)
  {
    return "<table class=\"scFormMessageTable\" style=\"margin: 1px; width: 100%\"><tr><td class=\"scFormMessageMessage\">" + scAjaxSpecCharParser(sDebugMsg) + "</td></tr></table>";
  } // scAjaxFormatDebug

  function scAjaxHideErrorDisplay_default(sErrorId, bForce)
  {
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
        document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "none";
        document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = "";
        if (null == bForce)
        {
            bForce = true;
        }
        if (bForce)
        {
            var $oField = $('#id_sc_field_' + sErrorId);
            if (0 < $oField.length)
            {
                scAjax_removeFieldErrorStyle($oField);
            }
        }
    }
    if (document.getElementById("id_error_display_fixed"))
    {
        document.getElementById("id_error_display_fixed").style.display = "none";
    }
  } // scAjaxHideErrorDisplay_default

  function scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg)
  {
    if (oResp && oResp['redirExitInfo'])
    {
      sErrorMsg += "<br /><input type=\"button\" onClick=\"window.location='" + oResp['redirExitInfo']['action'] + "'\" value=\"Ok\">";
    }
    sErrorMsg = scAjaxErrorSql(sErrorMsg);
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
      document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "";
      document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = sErrorMsg;
      if ("table" == sErrorId)
      {
        scCenterElement(document.getElementById("id_error_display_" + sErrorId + "_frame"));
      }
      var $oField = $('#id_sc_field_' + sErrorId);
      if (0 < $oField.length)
      {
        scAjax_applyFieldErrorStyle($oField);
      }
    }
    if (ajax_error_list && ajax_error_list[sErrorId] && ajax_error_list[sErrorId]["timeout"] && 0 < ajax_error_list[sErrorId]["timeout"])
    {
      setTimeout("scAjaxHideErrorDisplay('" + sErrorId + "', false)", ajax_error_list[sErrorId]["timeout"] * 1000);
    }
  } // scAjaxShowErrorDisplay_default

  var iErrorSqlId = 1;

  function scAjaxErrorSql(sErrorMsg)
  {
    var iTmpPos = sErrorMsg.indexOf("{SC_DB_ERROR_INI}"),
        sTmpId;
    while (-1 < iTmpPos)
    {
      sTmpId    = "sc_id_error_sql_" + iErrorSqlId;
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><span style=\"text-decoration: underline\" onClick=\"$('#" + sTmpId + "').show(); scCenterElement(document.getElementById('" + sTmpId + "'))\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_MID}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span><table class=\"scFormErrorTable\" id=\"" + sTmpId + "\" style=\"display: none; position: absolute\"><tr><td>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_CLS}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><br /><span onClick=\"$('#" + sTmpId + "').hide()\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_END}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span></td></tr></table>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_INI}");
      iErrorSqlId++;
    }
    return sErrorMsg;
  } // scAjaxErrorSql

  function scAjaxHideMessage_default()
  {
    if (document.getElementById("id_message_display_frame"))
    {
      document.getElementById("id_message_display_frame").style.display = "none";
      document.getElementById("id_message_display_text").innerHTML = "";
    }
  } // scAjaxHideMessage

  function scAjaxShowMessage_default()
  {
    if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"])
    {
      return;
    }
    _scAjaxShowMessage_default({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: false, toastPos: ""});
  } // scAjaxShowMessage

  var scMsgDefClose = "";

  function _scAjaxShowMessage_default(params) {
        var sTitle = params["title"],
                sMessage = params["message"],
                bModal = params["isModal"],
                iTimeout = params["timeout"],
                bButton = params["showButton"],
                sButton = params["buttonLabel"],
                iTop = params["topPos"],
                iLeft = params["leftPos"],
                iWidth = params["width"],
                iHeight = params["height"],
                sRedir = params["redirUrl"],
                sTarget = params["redirTarget"],
                sParam = params["redirParam"],
                bClose = params["showClose"],
                bBodyIcon = params["showBodyIcon"],
                bToast = params["isToast"],
                sToastPos = params["toastPos"];
    if ("" == sMessage) {
      if (bModal) {
        scMsgDefClick = "close_modal";
      }
      else {
        scMsgDefClick = "close";
      }
      _scAjaxMessageBtnClick();
      document.getElementById("id_message_display_title").innerHTML = scMsgDefTitle;
      document.getElementById("id_message_display_text").innerHTML = "";
      document.getElementById("id_message_display_buttone").value = scMsgDefButton;
      document.getElementById("id_message_display_buttond").style.display = "none";
    }
    else {
      document.getElementById("id_message_display_title").innerHTML = scAjaxSpecCharParser(sTitle);
      document.getElementById("id_message_display_text").innerHTML = scAjaxSpecCharParser(sMessage);
      document.getElementById("id_message_display_buttone").value = sButton;
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_title_line").style.display = (bClose || "" != sTitle) ? "" : "none";
      document.getElementById("id_message_display_close_icon").style.display = bClose ? "" : "none";
      if (document.getElementById("id_message_display_body_icon")) {
        document.getElementById("id_message_display_body_icon").style.display = bBodyIcon ? "" : "none";
      }
      $("#id_message_display_content").css('width', (0 < iWidth ? iWidth + 'px' : ''));
      $("#id_message_display_content").css('height', (0 < iHeight ? iHeight + 'px' : ''));
      if (bModal) {
        iWidth = iWidth || 250;
        iHeight = iHeight || 200;
        scMsgDefClose = "close_modal";
        tb_show('', '#TB_inline?height=' + (iHeight + 6) + '&width=' + (iWidth + 4) + '&inlineId=id_message_display_frame&modal=true', '');
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2_modal";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close_modal";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close_modal";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
      else
      {
        scMsgDefClose = "close";
        $("#id_message_display_frame").css('top', (0 < iTop ? iTop + 'px' : ''));
        $("#id_message_display_frame").css('left', (0 < iLeft ? iLeft + 'px' : ''));
        document.getElementById("id_message_display_frame").style.display = "";
        if (0 == iTop && 0 == iLeft) {
          scCenterElement(document.getElementById("id_message_display_frame"));
        }
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
    }
  } // _scAjaxShowMessage_default

  function _scAjaxMessageBtnClose() {
    switch (scMsgDefClose) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function _scAjaxMessageBtnClick() {
    switch (scMsgDefClick) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
      case "dismiss":
        scAjaxHideMessage();
        break;
      case "redir1":
        document.form_ajax_redir_1.submit();
        break;
      case "redir2":
        document.form_ajax_redir_2.submit();
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "redir2_modal":
        document.form_ajax_redir_2.submit();
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function scAjaxHasError()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "ERROR" == oResp["result"];
  } // scAjaxHasError

  function scAjaxIsOk()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "OK" == oResp["result"] || "SET" == oResp["result"];
  } // scAjaxIsOk

  function scAjaxIsSet()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "SET" == oResp["result"];
  } // scAjaxIsSet

  function scAjaxCalendarReload()
  {
    if (oResp["calendarReload"] && "OK" == oResp["calendarReload"] && typeof self.parent.calendar_reload == "function")
    {
<?php
if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && isset($_SESSION['scriptcase']['display_mobile']) && $_SESSION['scriptcase']['display_mobile']) {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
} else {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
}
?>
      return true;
    }
    return false;
  } // scCalendarReload

  function scAjaxUpdateErrors(sType)
  {
    ajax_error_geral = "";
    oFieldErrors     = {};
    if (oResp["errList"])
    {
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if ("geral_form_itens_proc_compra" == sTestField)
        {
          if (ajax_error_geral != '') { ajax_error_geral += '<br>';}
          ajax_error_geral += scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
        else
        {
          if (scFocusFirstErrorField && '' == scFocusFirstErrorName)
          {
            scFocusFirstErrorName = sTestField;
          }
          if (oResp["errList"][iFieldErrors]["numLinha"])
          {
            sTestField += oResp["errList"][iFieldErrors]["numLinha"];
          }
          if (!oFieldErrors[sTestField])
          {
            oFieldErrors[sTestField] = new Array();
          }
          oFieldErrors[sTestField][oFieldErrors[sTestField].length] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
      }
    }
    for (iUpdateErrors = 0; iUpdateErrors < ajax_field_list.length; iUpdateErrors++)
    {
      sTestField = ajax_field_list[iUpdateErrors];
      if (oFieldErrors[sTestField])
      {
        ajax_error_list[sTestField][sType] = oFieldErrors[sTestField];
      }
    }
  } // scAjaxUpdateErrors

  function scAjaxUpdateFieldErrors(sField, sType)
  {
    aFieldErrors = new Array();
    if (oResp["errList"])
    {
      iErrorPos  = 0;
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if (oResp["errList"][iFieldErrors]["numLinha"])
        {
          sTestField += oResp["errList"][iFieldErrors]["numLinha"];
        }
        if (sField == sTestField)
        {
          aFieldErrors[iErrorPos] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
          iErrorPos++;
        }
      }
    }
        if (ajax_error_list[sField])
        {
        ajax_error_list[sField][sType] = aFieldErrors;
        }
  } // scAjaxUpdateFieldErrors

  function scAjaxListErrors(bLabel)
  {
    bFirst        = false;
    sAppErrorText = "";
    if ("" != ajax_error_geral)
    {
      bFirst         = true;
      sAppErrorText += ajax_error_geral;
    }
    for (iFieldList = 0; iFieldList < ajax_field_list.length; iFieldList++)
    {
      sFieldError = scAjaxListFieldErrors(ajax_field_list[iFieldList], bLabel);
      if ("" != sFieldError)
      {
        if (bFirst)
        {
          bFirst         = false
          sAppErrorText += "<hr size=\"1\" width=\"80%\" />";
        }
        sAppErrorText += sFieldError;
      }
    }
    return sAppErrorText;
  } // scAjaxListErrors

  function scAjaxListFieldErrors(sField, bLabel)
  {
    sErrorText = "";
    for (iErrorType = 0; iErrorType < ajax_error_type.length; iErrorType++)
    {
      if (ajax_error_list[sField])
      {
        for (iListErrors = 0; iListErrors < ajax_error_list[sField][ajax_error_type[iErrorType]].length; iListErrors++)
        {
          if (bLabel)
          {
            sErrorText += ajax_error_list[sField]["label"] + ": ";
          }
          sErrorText += ajax_error_list[sField][ajax_error_type[iErrorType]][iListErrors] + "<br />";
        }
      }
    }
    return sErrorText;
  } // scAjaxListFieldErrors

  function scAjaxClearErrors() {
    var fieldName;
    for (fieldName in ajax_error_list) {
         if (null != ajax_error_list[fieldName]) {
             ajax_error_list[fieldName]["valid"] = new Array();
             ajax_error_list[fieldName]["onblur"] = new Array();
             ajax_error_list[fieldName]["onchange"] = new Array();
             ajax_error_list[fieldName]["onclick"] = new Array();
             ajax_error_list[fieldName]["onfocus"] = new Array();
         }
    }
    ajax_error_geral = "";
  } // scAjaxClearErrors

  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
          if(typeof oResp["varList"][iVarFields] === 'object' && oResp["varList"][iVarFields] !== null)
          {
              var sVarName  = oResp["varList"][iVarFields].index;
              var sVarValue = oResp["varList"][iVarFields].value;
          }
          else
          {
              var sVarName  = oResp["varList"][iVarFields]["index"];
              var sVarValue = oResp["varList"][iVarFields]["value"];
          }

          if (sVarValue == 'new Array()') {
            eval(sVarName + " = new Array();");
          } else {
            eval(sVarName + " = \"" + sVarValue + "\";");
          }
    }
  } // scAjaxSetVariables
/*
  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
      var sVarName  = oResp["varList"][iVarFields]["index"];
      var sVarValue = oResp["varList"][iVarFields]["value"];
              if (sVarValue.indexOf('new Array') > -1) {
                        eval(sVarName + " = sVarValue;");
                  } else {
                        eval(sVarName + " = \"" + sVarValue + "\";");
                  }
        }
  } // scAjaxSetVariables
*/
  function scAjaxSetSummaryLine()
  {
    if (!oResp["navSummary"] || !oResp["navSummary"]["summary_line"])
    {
      return true;
    }
    $("#sc-summary-line").html(oResp["navSummary"]["summary_line"]);
  } // scAjaxSetSummaryLine

  function scAjaxSetFields()
  {
    if (!oResp["fldList"])
    {
      return true;
    }
    for (iSetFields = 0; iSetFields < oResp["fldList"].length; iSetFields++)
    {
      var sFieldName = oResp["fldList"][iSetFields]["fldName"];
      var sFieldType = oResp["fldList"][iSetFields]["fldType"];

      if ("selectdd" == sFieldType)
      {
        var bSelectDD = true;
        sFieldType = "select";
      }
      else
      {
        var bSelectDD = false;
      }
      if ("select2_ac" == sFieldType)
      {
        var bSelect2AC = true;
        sFieldType = "select";
      }
      else
      {
        var bSelect2AC = false;
      }
      if (oResp["fldList"][iSetFields]["valList"])
      {
        var oFieldValues = oResp["fldList"][iSetFields]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (oResp["fldList"][iSetFields]["optList"])
      {
        var oFieldOptions = oResp["fldList"][iSetFields]["optList"];
      }
      else
      {
        var oFieldOptions = null;
      }
/*
      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)) &&
          oFieldValues[0]['value'])
      {
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = oFieldValues[0]['value'];
      }
*/

      if ("corhtml" == sFieldType)
      {
        sFieldType = 'text';

        /*sCor = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
        setaCorPaleta(sFieldName, sCor);*/
      }

      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)))
      {
          sLabel_auto_Comp = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = sLabel_auto_Comp;
      }


      if (oResp["fldList"][iSetFields]["colNum"])
      {
        var iColNum = oResp["fldList"][iSetFields]["colNum"];
      }
      else
      {
        var iColNum = 1;
      }
      if (oResp["fldList"][iSetFields]["row"])
      {
        var iRow = oResp["fldList"][iSetFields]["row"];
                var thisRow = oResp["fldList"][iSetFields]["row"];
      }
      else
      {
        var iRow = 1;
                var thisRow = "";
      }
      if (oResp["fldList"][iSetFields]["htmComp"])
      {
        var sHtmComp = oResp["fldList"][iSetFields]["htmComp"];
        sHtmComp     = sHtmComp.replace(/__AD__/gi, '"');
        sHtmComp     = sHtmComp.replace(/__AS__/gi, "'");
      }
      else
      {
        var sHtmComp = null;
      }
      if (oResp["fldList"][iSetFields]["imgFile"])
      {
        var sImgFile = oResp["fldList"][iSetFields]["imgFile"];
      }
      else
      {
        var sImgFile = "";
      }
      if (oResp["fldList"][iSetFields]["imgOrig"])
      {
        var sImgOrig = oResp["fldList"][iSetFields]["imgOrig"];
      }
      else
      {
        var sImgOrig = "";
      }
      if (oResp["fldList"][iSetFields]["keepImg"])
      {
        var sKeepImg = oResp["fldList"][iSetFields]["keepImg"];
      }
      else
      {
        var sKeepImg = "N";
      }
      if (oResp["fldList"][iSetFields]["hideName"])
      {
        var sHideName = oResp["fldList"][iSetFields]["hideName"];
      }
      else
      {
        var sHideName = "N";
      }
      if (oResp["fldList"][iSetFields]["imgLink"])
      {
        var sImgLink = oResp["fldList"][iSetFields]["imgLink"];
      }
      else
      {
        var sImgLink = null;
      }
      if (oResp["fldList"][iSetFields]["docLink"])
      {
        var sDocLink = oResp["fldList"][iSetFields]["docLink"];
      }
      else
      {
        var sDocLink = "";
      }
      if (oResp["fldList"][iSetFields]["docIcon"])
      {
        var sDocIcon = oResp["fldList"][iSetFields]["docIcon"];
      }
      else
      {
        var sDocIcon = "";
      }

      if (oResp["fldList"][iSetFields]["docReadonly"])
      {
        var sDocReadonly = oResp["fldList"][iSetFields]["docReadonly"];
      }
      else
      {
        var sDocReadonly = "";
      }

      if (oResp["fldList"][iSetFields]["optComp"])
      {
        var sOptComp = oResp["fldList"][iSetFields]["optComp"];
      }
      else
      {
        var sOptComp = "";
      }
      if (oResp["fldList"][iSetFields]["optClass"])
      {
        var sOptClass = oResp["fldList"][iSetFields]["optClass"];
      }
      else
      {
        var sOptClass = "";
      }
      if (oResp["fldList"][iSetFields]["optMulti"])
      {
        var sOptMulti = oResp["fldList"][iSetFields]["optMulti"];
      }
      else
      {
        var sOptMulti = "";
      }
      if (oResp["fldList"][iSetFields]["imgHtml"])
      {
        var sImgHtml = oResp["fldList"][iSetFields]["imgHtml"];
      }
      else
      {
        var sImgHtml = "";
      }
      if (oResp["fldList"][iSetFields]["mulHtml"])
      {
        var sMULHtml = oResp["fldList"][iSetFields]["mulHtml"];
      }
      else
      {
        var sMULHtml = "";
      }
      if (oResp["fldList"][iSetFields]["updInnerHtml"])
      {
        var sInnerHtml = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["updInnerHtml"]);
      }
      else
      {
        var sInnerHtml = null;
      }
      if (oResp["fldList"][iSetFields]["lookupCons"])
      {
        var sLookupCons = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["lookupCons"]);
      }
      else
      {
        var sLookupCons = "";
      }
      if (oResp["clearUpload"])
      {
        var sClearUpload = scAjaxSpecCharParser(oResp["clearUpload"]);
      }
      else
      {
        var sClearUpload = "N";
      }
      if (oResp["eventField"])
      {
        var sEventField = scAjaxSpecCharParser(oResp["eventField"]);
      }
      else
      {
        var sEventField = "__SC_NO_FIELD";
      }
      if (oResp["fldList"][iSetFields]["switch"])
      {
        var bSwitch = true == oResp["fldList"][iSetFields]["switch"];
      }
      else
      {
        var bSwitch = false;
      }
      if ("checkbox" == sFieldType)
      {
        scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField);
      }
      else if ("duplosel" == sFieldType)
      {
        scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions);
      }
      else if ("imagem" == sFieldType)
      {
        scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName);
      }
      else if ("documento" == sFieldType)
      {
        scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly);
      }
      else if ("label" == sFieldType)
      {
        scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons);
      }
      else if ("radio" == sFieldType)
      {
        scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField);
      }
      else if ("select" == sFieldType)
      {
        scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow);
      }
      else if ("text" == sFieldType)
      {
        scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField);
      }
      else if ("color_palette" == sFieldType)
      {
        scAjaxSetFieldColorPalette(sFieldName, oFieldValues);
      }
      else if ("editor_html" == sFieldType)
      {
        scAjaxSetFieldEditorHtml(sFieldName, oFieldValues);
      }
      else if ("imagehtml" == sFieldType)
      {
        scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml);
      }
      else if ("innerhtml" == sFieldType)
      {
        scAjaxSetFieldInnerHtml(sFieldName, oFieldValues);
      }
      else if ("multi_upload" == sFieldType)
      {
        scAjaxSetFieldMultiUpload(sFieldName, sMULHtml);
      }
      else if ("recur_info" == sFieldType)
      {
        scAjaxSetFieldRecurInfo(sFieldName, sMULHtml);
      }
      else if ("signature" == sFieldType)
      {
        scAjaxSetFieldSignature(sFieldName, oFieldValues);
      }
      else if ("rating" == sFieldType)
      {
        scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingstar" == sFieldType)
      {
        scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingsmile" == sFieldType)
      {
        scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingthumb" == sFieldType)
      {
        scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow);
      }
      scAjaxUpdateHeaderFooter(sFieldName, oFieldValues);
    }
  } // scAjaxSetFields

  function scAjaxUpdateHeaderFooter(sFieldName, oFieldValues)
  {
    if (self.updateHeaderFooter)
    {
      if (null == oFieldValues)
      {
        sNewValue = '';
      }
      else if (oFieldValues[0]["label"])
      {
        sNewValue = oFieldValues[0]["label"];
      }
      else
      {
        sNewValue = oFieldValues[0]["value"];
      }
      updateHeaderFooter(sFieldName, scAjaxSpecCharParser(sNewValue));
    }
  } // scAjaxUpdateHeaderFooter

  function scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField)
  {
    if (document.F1.elements[sFieldName])
    {
      var jqField = $("#id_sc_field_" + sFieldName),
          Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
      if (jqField.length)
      {
        jqField.val(Temp_text);
        if (sEventField != sFieldName && sEventField != "__SC_NO_FIELD" && sEventField != "")
        {
          //jqField.trigger("change");
        }
      }
      else
      {
        eval("document.F1." + sFieldName + ".value = Temp_text");
      }
      if (scEventControl_data[sFieldName]) {
        scEventControl_data[sFieldName]["calculated"] = Temp_text;
      }
    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
        scAjaxSetSliderValue(sFieldName, thisRow);
  } // scAjaxSetFieldText

  function scAjaxSetSliderValue(fieldName, thisRow)
  {
          var sliderObject = $("#sc-ui-slide-" + fieldName);
          if (!sliderObject.length) {
                  return;
          }
          scJQSlideValue(fieldName, thisRow);
  } // scAjaxSetSliderValue

  function scAjaxSetFieldColorPalette(sFieldName, oFieldValues)
  {
    if (document.F1.elements[sFieldName])
    {
        var Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
        eval ("document.F1." + sFieldName + ".value = Temp_text");
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
          setaCorPaleta(sFieldName, oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
  } // scAjaxSetFieldColorPalette

  function scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if (bSelectDD)
    {
        $("#id_sc_field_" + sFieldName).dropdownchecklist("destroy");
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      scAjaxSetFieldText(sFieldNameHtml, oFieldValues, "", "", sEventField);
      return;
    }

    if (null != oFieldOptions)
    {
      $("#id_sc_field_" + sFieldName).children().remove()
      if ("<select" != oFieldOptions.substr(0, 7))
      {
        var $oField = $("#id_sc_field_" + sFieldName);
        if (0 < $oField.length)
        {
          $oField.html(oFieldOptions);
        }
        else
        {
          document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
        }
      }
      else
      {
        document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
      }
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    var oFormField = $("#id_sc_field_" + sFieldName);
    for (iFieldSelect = 0; iFieldSelect < oFormField[0].length; iFieldSelect++)
    {
      if (scAjaxInArray(oFormField[0].options[iFieldSelect].value, aValues))
      {
        oFormField[0].options[iFieldSelect].selected = true;
      }
      else
      {
        oFormField[0].options[iFieldSelect].selected = false;
      }
    }
        scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
    if (bSelectDD)
    {
        scJQDDCheckBoxAdd(thisRow, true);
    }
        if (bSelect2AC)
        {
                var newOption = new Option(oFieldValues[0]["label"], oFieldValues[0]["value"], true, true);
                $("#id_ac_" + sFieldName).append(newOption);
                $("#id_sc_field_" + sFieldName).val(oFieldValues[0]["value"]);
        }
        else if (oFormField.hasClass("select2-hidden-accessible"))
        {
        $("#id_sc_field_" + sFieldName).select2("destroy");
                var select2Field = sFieldName;
                if ("" != thisRow) {
                        select2Field = select2Field.substr(0, select2Field.length - thisRow.toString().length);
                }
        scJQSelect2Add(thisRow, select2Field);
        }
  } // scAjaxSetFieldSelect

  function scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions)
  {
    var sFieldNameOrig = sFieldName + "_orig";
    var sFieldNameDest = sFieldName + "_dest";
    var oFormFieldOrig = document.F1.elements[sFieldNameOrig];
    var oFormFieldDest = document.F1.elements[sFieldNameDest];

    if (null != oFieldOptions)
    {
      scAjaxClearSelect(sFieldNameOrig);
      for (iFieldSelect = 0; iFieldSelect < oFieldOptions.length; iFieldSelect++)
      {
        oFormFieldOrig.options[iFieldSelect] = new Option(scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["label"]), scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["value"]));
      }
    }
    while (oFormFieldDest.length > 0)
    {
      oFormFieldDest.options[0] = null;
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        sNewOptionLabel = oFieldValues[iFieldSelect]["label"] ? scAjaxSpecCharParser(oFieldValues[iFieldSelect]["label"]) : scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        sNewOptionValue = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        if (sNewOptionValue.substr(0, 8) == "@NMorder")
        {
           sNewOptionValue                      = sNewOptionValue.substr(8);
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
           sNewOptionValue                      = sNewOptionValue.substr(1);
           aValues[iFieldSelect]                = sNewOptionValue;
        }
        else
        {
           aValues[iFieldSelect]                = sNewOptionValue;
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
        }
      }
    }
    for (iFieldSelect = 0; iFieldSelect < oFormFieldOrig.length; iFieldSelect++)
    {
      oFormFieldOrig.options[iFieldSelect].selected = false;
      if (scAjaxInArray(oFormFieldOrig.options[iFieldSelect].value, aValues))
      {
        oFormFieldOrig.options[iFieldSelect].disabled    = true;
        oFormFieldOrig.options[iFieldSelect].style.color = "#A0A0A0";
      }
      else
      {
        oFormFieldOrig.options[iFieldSelect].disabled = false;
      }
    }
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldDuplosel

  function scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.getElementById("idAjaxCheckbox_" + sFieldName) && null != sInnerHtml)
    {
      document.getElementById("idAjaxCheckbox_" + sFieldName).innerHTML = sInnerHtml;
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearCheckbox(sFieldName);
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearCheckbox(sFieldName); */
      scAjaxRecreateOptions("Checkbox", "checkbox", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch);
    }
    else
    {
      scAjaxSetCheckboxOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "checkbox");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldCheckbox

  function scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearRadio(sFieldName);
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearRadio(sFieldName); */
      scAjaxRecreateOptions("Radio", "radio", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, "", "", bSwitch);
    }
    else
    {
      scAjaxSetRadioOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "radio");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldRadio

  function scAjaxSetSwitchOptions(fieldName, fieldType)
  {
        var fieldOptions = $(".sc-ui-" + fieldType + "-" + fieldName + ".lc-switch");
        if (!fieldOptions.length) {
                return;
        }
        for (var i = 0; i < fieldOptions.length; i++) {
                if ($(fieldOptions[i]).prop("checked")) {
                        $(fieldOptions[i]).lcs_on();
                }
                else {
                        $(fieldOptions[i]).lcs_off();
                }
        }
  }

  function scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons)
  {
    sFieldValue = oFieldValues[0]["value"];
    if ("undefined" == typeof oFieldValues[0]["label"]) {
      sFieldLabel = oFieldValues[0]["value"];
    } else {
      sFieldLabel = oFieldValues[0]["label"];
    }
    sFieldLabel = scAjaxBreakLine(sFieldLabel);
    if (null != oFieldOptions)
    {
      for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
      {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        if (sFieldValue == sOptText)
        {
          sFieldLabel = sOptValue;
        }
      }
    }
    if (document.getElementById("id_ajax_label_" + sFieldName))
    {
      document.getElementById("id_ajax_label_" + sFieldName).innerHTML = scAjaxSpecCharParser(sFieldLabel);
    }
    if (document.F1.elements[sFieldName])
    {
//      document.F1.elements[sFieldName].value = scAjaxSpecCharParser(sFieldValue);
        Temp_text = scAjaxProtectBreakLine(sFieldValue);
        Temp_text = scAjaxSpecCharParser(Temp_text);
        document.F1.elements[sFieldName].value = scAjaxReturnBreakLine(Temp_text);

    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(sFieldLabel));
  } // scAjaxSetFieldLabel

  function scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if ("N" == sKeepImg && document.getElementById("id_ajax_img_"  + sFieldName))
    {
      document.getElementById("id_ajax_img_"  + sFieldName).src           = scAjaxSpecCharParser(sImgFile);
      document.getElementById("id_ajax_img_"  + sFieldName).style.display = ("" == sImgFile) ? "none" : "";
    }
    if (document.getElementById("id_ajax_link_" + sFieldName) && null != sImgLink)
    {
      document.getElementById("id_ajax_link_" + sFieldName).innerHTML = oFieldValues[0]["value"];
      document.getElementById("id_ajax_link_" + sFieldName).href      = scAjaxSpecCharParser(sImgLink);
    }
    if (document.getElementById("chk_ajax_img_" + sFieldName))
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"]) ? "none" : "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("N" == sKeepImg && document.getElementById("txt_ajax_img_" + sFieldName))
    {
      document.getElementById("txt_ajax_img_" + sFieldName).innerHTML     = oFieldValues[0]["value"];
      document.getElementById("txt_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"] || "S" == sHideName) ? "none" : "";
    }
    if ("" != sImgOrig)
    {
      eval("if (var_ajax_img_" + sFieldName + ") var_ajax_img_" + sFieldName + " = '" + sImgOrig + "';");
      if (document.F1.elements["temp_out1_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgFile;
        document.F1.elements["temp_out1_" + sFieldName].value = sImgOrig;
      }
      else if (document.F1.elements["temp_out_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgOrig;
      }
    }
    if ("" != oFieldValues[0]["value"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = oFieldValues[0]["value"];
    }
    else if (oResp && oResp["ajaxRequest"] && "navigate_form" == oResp["ajaxRequest"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = "";
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldImage

  function scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    document.getElementById("id_ajax_doc_"  + sFieldName).innerHTML = scAjaxSpecCharParser(sDocLink);
    if (document.getElementById("id_ajax_doc_icon_"  + sFieldName))
    {
      document.getElementById("id_ajax_doc_icon_"  + sFieldName).src = scAjaxSpecCharParser(sDocIcon);
    }
    if ("" == oFieldValues[0]["value"])
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "none";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "none";
    }
    else
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("S" == sClearUpload && document.F1.elements[sFieldName + "_ul_name"])
    {
      document.F1.elements[sFieldName + "_ul_name"].value = "";
    }
    if ("" != sDocLink && sDocReadonly == "S")
    {
      scAjaxSetReadonlyValue(sFieldName, sDocLink);
    }
    else
    {
      scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
    }
  } // scAjaxSetFieldDocument

  function scAjaxSetFieldInnerHtml(sFieldName, oFieldValues)
  {
    if (document.getElementById(sFieldName))
    {
      document.getElementById(sFieldName).innerHTML = scAjaxSpecCharParser(oFieldValues[0]["value"]);
    }
  } // scAjaxSetFieldInnerHtml

  function scAjaxSetFieldMultiUpload(sFieldName, sMULHtml)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    $("#id_sc_loaded_" + sFieldName).html(scAjaxSpecCharParser(sMULHtml));
  } // scAjaxSetFieldMultiUpload

  function scAjaxExecFieldEditorHtml(strOption, bolUI, oField)
  {
                  if(tinymce.majorVersion > 3)
                {
                        if(strOption == 'mceAddControl')
                        {
                                if (typeof(scJQHtmlEditorData) === 'function') {
                                    var data = scJQHtmlEditorData('#' + oField);
                                    if (data && typeof(data) === 'object') {
                                        data.selector = '#' + oField;
                                        tinymce.init(data);
                                    } else {
                                        tinymce.execCommand('mceAddEditor', bolUI, oField);
                                    }
                                } else {
                                    tinymce.execCommand('mceAddEditor', bolUI, oField);
                                }
                        }else
                        if(strOption == 'mceRemoveControl')
                        {
                                tinymce.execCommand('mceRemoveEditor', bolUI, oField);
                        }
                }
                else
                {
                        tinyMCE.execCommand(strOption, bolUI, oField);
                }
  }

  function scAjaxSetFieldEditorHtml(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent(scAjaxSpecCharParser(oFieldValues[0]["value"]));
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml)
  {
    if (document.getElementById("id_imghtml_" + sFieldName))
    {
      document.getElementById("id_imghtml_" + sFieldName).innerHTML = scAjaxSpecCharParser(sImgHtml);
    }
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldRecurInfo(sFieldName, oFieldValues)
  {
          var jsonData = "" != oFieldValues[0]["value"]
                       ? JSON.parse(oFieldValues[0]["value"])
                                   : { repeat: "1", endon: "E", endafter: "", endin: ""};
          $("#id_rinf_repeat_" + sFieldName).val(jsonData.repeat);
          $(".cl_rinf_endon_" + sFieldName).filter(function(index) {return $(this).val() == jsonData.endon}).prop("checked", true),
          $("#id_rinf_endafter_" + sFieldName).val(jsonData.endafter);
          $("#id_rinf_endin_" + sFieldName).val(jsonData.endin);
          scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldRecurInfo

  function scAjaxSetFieldSignature(sFieldName, oFieldValues)
  {
        var fieldValue = scAjaxSpecCharParser(oFieldValues[0]['value']);
        if ("data:image/png;base64," != fieldValue.substr(0, 22) && "data:image/jsignature;base30," != fieldValue.substr(0, 29))
        {
                scJQSignatureClear(sFieldName);
                return;
        }
        $("#id_sc_field_" + sFieldName).val(fieldValue);
        scJQSignatureRedraw(sFieldName);
         scFormHasChanged = false; // mantis 0020638
  } // scAjaxSetFieldSignature

  function scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingStarRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingSmileRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingThumbRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetCheckboxOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return;
    }
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheckbox = 0; iFieldCheckbox < oFormField.length; iFieldCheckbox++)
        {
          if (scAjaxInArray(oFormField[iFieldCheckbox].value, aValues))
          {
            oFormField[iFieldCheckbox].checked = true;
          }
          else
          {
            oFormField[iFieldCheckbox].checked = false;
          }
        }
      }
      else
      {
        if (scAjaxInArray(oFormField.value, aValues))
        {
          oFormField.checked = true;
        }
        else
        {
          oFormField.checked = false;
        }
      }
    }
    else if (document.F1.elements[sFieldName + "[0]"])
    {
      for (iFieldCheckbox = 0; iFieldCheckbox < document.F1.elements.length; iFieldCheckbox++)
      {
        oFormElement = document.F1.elements[iFieldCheckbox];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && scAjaxInArray(oFormElement.value, aValues))
        {
          oFormElement.checked = true;
        }
        else if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1))
        {
          oFormElement.checked = false;
        }
      }
    }
    else
    {
      oFormElement = document.F1.elements[sFieldName];
      if (scAjaxInArray(oFormElement.value, aValues))
      {
        oFormElement.checked = true;
      }
      else
      {
        oFormElement.checked = false;
      }
    }
  } // scAjaxSetCheckboxOptions

  function scAjaxSetRadioOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
    var oFormField = document.F1.elements[sFieldName];
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      oFormField[iFieldRadio].checked = false;
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      if (scAjaxInArray(oFormField[iFieldRadio].value, aValues))
      {
        oFormField[iFieldRadio].checked = true;
      }
    }
  } // scAjaxSetRadioOptions

  function scAjaxSetReadonlyValue(sFieldName, sFieldValue)
  {
    if (document.getElementById("id_read_on_" + sFieldName))
    {
      document.getElementById("id_read_on_" + sFieldName).innerHTML = sFieldValue;
    }
  } // scAjaxSetReadonlyValue

  function scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, sDelim)
  {
    if (null == oFieldValues)
    {
      return;
    }
    if (null == sDelim)
    {
      sDelim = " ";
    }
    sReadLabel = "";
    for (iReadArray = 0; iReadArray < oFieldValues.length; iReadArray++)
    {
      if (oFieldValues[iReadArray]["label"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["label"];
      }
      else if (oFieldValues[iReadArray]["value"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["value"];
      }
    }
    scAjaxSetReadonlyValue(sFieldName, sReadLabel);
  } // scAjaxSetReadonlyArrayValue

  function scAjaxGetFieldValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        if (1 == oFieldValues.length)
        {
          sValue = scAjaxSpecCharParser(oFieldValues[0]["value"]);
        }
        else
        {
          sValue = new Array();
          for (jFieldValue = 0; jFieldValue < oFieldValues.length; jFieldValue++)
          {
            sValue[jFieldValue] = scAjaxSpecCharParser(oFieldValues[jFieldValue]["value"]);
          }
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldValue

  function scAjaxGetKeyValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iKeyValue = 0; iKeyValue < oResp["fldList"].length; iKeyValue++)
    {
      var sFieldName = oResp["fldList"][iKeyValue]["fldName"];
      if (sFieldGet == sFieldName)
      {
        if (oResp["fldList"][iKeyValue]["keyVal"])
        {
          return scAjaxSpecCharParser(oResp["fldList"][iKeyValue]["keyVal"]);
        }
        else
        {
          return scAjaxGetFieldValue(sFieldGet);
        }
      }
    }
    return sValue;
  } // scAjaxGetKeyValue

  function scAjaxGetLineNumber()
  {
    sLineNumber = "";
    if (oResp["errList"])
    {
      for (iLineNumber = 0; iLineNumber < oResp["errList"].length; iLineNumber++)
      {
        if (oResp["errList"][iLineNumber]["numLinha"])
        {
          sLineNumber = oResp["errList"][iLineNumber]["numLinha"];
        }
      }
      return sLineNumber;
    }
    if (oResp["fldList"])
    {
      return oResp["fldList"][0]["numLinha"];
    }
    if (oResp["msgDisplay"])
    {
      return oResp["msgDisplay"]["numLinha"];
    }
    return sLineNumber;
  } // scAjaxGetLineNumber

  function scAjaxFieldExists(sFieldGet)
  {
    bExists = false;
    if (!oResp["fldList"])
    {
      return bExists;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        bExists = true;
      }
    }
    return bExists;
  } // scAjaxFieldExists

  function scAjaxGetFieldText(sFieldName)
  {
    $oHidden = $("input[name='" + sFieldName + "']");
    if (!$oHidden.length)
    {
      $oHidden = $("input[name='" + sFieldName + "_']");
    }
    if ($oHidden.length)
    {
      for (var i = 0; i < $oHidden.length; i++)
      {
        if ("hidden" == $oHidden[i].type && $oHidden[i].form && $oHidden[i].form.name && "F1" == $oHidden[i].form.name)
        {
          return scAjaxSpecCharProtect($oHidden[i].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    $oField = $("#id_sc_field_" + sFieldName);
    if(!$oField.length)
    {
      $oField = $("#id_sc_field_" + sFieldName + "_");
    }
    if ($oField.length && "select" != $oField[0].type.substr(0, 6))
    {
      return scAjaxSpecCharProtect($oField.val());//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName + '_'])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName + '_'].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return '';
    }
  } // scAjaxGetFieldText

  function scAjaxGetFieldHidden(sFieldName)
  {
    for( i= 0; i < document.F1.elements.length; i++)
    {
       if (document.F1.elements[i].name == sFieldName)
       {
          return scAjaxSpecCharProtect(document.F1.elements[i].value);//.replace(/[+]/g, "__NM_PLUS__");
       }
    }
//    return document.F1.elements[sFieldName].value.replace(/[+]/g, "__NM_PLUS__");
  } // scAjaxGetFieldHidden

  function scAjaxGetFieldSelect(sFieldName)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return "";
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var iSelected  = oFormField.selectedIndex;
    if (-1 < iSelected)
    {
      return scAjaxSpecCharProtect(oFormField.options[iSelected].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return "";
    }
  } // scAjaxGetFieldSelect

  function scAjaxGetFieldSelectMult(sFieldName, sFieldDelim)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var sFieldVals = "";
    for (iFieldSelect = 0; iFieldSelect < oFormField.length; iFieldSelect++)
    {
      if (oFormField[iFieldSelect].selected)
      {
        if ("" != sFieldVals)
        {
          sFieldVals += sFieldDelim;
        }
        sFieldVals += scAjaxSpecCharProtect(oFormField[iFieldSelect].value);//.replace(/[+]/g, "__NM_PLUS__");
      }
    }
    return sFieldVals;
  } // scAjaxGetFieldSelectMult

  function scAjaxGetFieldCheckbox(sFieldName, sDelim)
  {
    var aValues = new Array();
    var sValue  = "";
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return sValue;
    }
    if (document.F1.elements[sFieldName + "[]"] && "hidden" == document.F1.elements[sFieldName + "[]"].type)
    {
      return scAjaxGetFieldHidden(sFieldName + "[]");
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheck = 0; iFieldCheck < oFormField.length; iFieldCheck++)
        {
          if (oFormField[iFieldCheck].checked)
          {
            aValues[aValues.length] = oFormField[iFieldCheck].value;
          }
        }
      }
      else
      {
        if (oFormField.checked)
        {
          aValues[aValues.length] = oFormField.value;
        }
      }
    }
    else
    {
      for (iFieldCheck = 0; iFieldCheck < document.F1.elements.length; iFieldCheck++)
      {
        oFormElement = document.F1.elements[iFieldCheck];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
        else if (sFieldName == oFormElement.name && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
      }
    }
    for (iFieldCheck = 0; iFieldCheck < aValues.length; iFieldCheck++)
    {
      sValue += scAjaxSpecCharProtect(aValues[iFieldCheck]);//.replace(/[+]/g, "__NM_PLUS__");
      if (iFieldCheck + 1 != aValues.length)
      {
        sValue += sDelim;
      }
    }
    return sValue;
  } // scAjaxGetFieldCheckbox

  function scAjaxGetFieldRadio(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }
    var oFormField = document.F1.elements[sFieldName];
    if (!oFormField.length)
    {
        var sc_cmp_radio = eval("document.F1." + sFieldName);
        if (sc_cmp_radio.checked)
        {
           sValue = scAjaxSpecCharProtect(sc_cmp_radio.value);//.replace(/[+]/g, "__NM_PLUS__");
        }
    }
    else
    {
      for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
      {
        if (oFormField[iFieldRadio].checked)
        {
          sValue = scAjaxSpecCharProtect(oFormField[iFieldRadio].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldRadio

  function scAjaxGetFieldEditorHtml(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }

        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    return scAjaxSpecCharParser(scAjaxSpecCharProtect(oFormField.getContent()));//.replace(/[+]/g, "__NM_PLUS__"));
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldSignature(sFieldName)
  {
    var signatureData = $("#sc-id-sign-" + sFieldName).jSignature("getData", "base30");
        $("#id_sc_field_" + sFieldName).val("data:" + signatureData[0] + "," + signatureData[1]);
        return $("#id_sc_field_" + sFieldName).val();
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldRecurInfo(sFieldName)
  {
          var repeatInList = $(".cl_rinf_repeatin_" + sFieldName).filter(":checked"), repeatInValues = [], jsonData, i;
          for (i = 0; i < repeatInList.length; i++) {
                  repeatInValues.push($(repeatInList[i]).val());
          }
          jsonData = {
                  repeat: $("#id_rinf_repeat_" + sFieldName).val(),
                  repeatin: repeatInValues.join(";"),
                  endon: $(".cl_rinf_endon_" + sFieldName).filter(":checked").val(),
                  endafter: $("#id_rinf_endafter_" + sFieldName).val(),
                  endin: $("#id_rinf_endin_" + sFieldName).val()
          };
          return JSON.stringify(jsonData);
  } // scAjaxGetFieldRecurInfo

  function scAjaxDoNothing(e)
  {
  } // scAjaxDoNothing

  function scAjaxInArray(mVal, aList)
  {
    for (iInArray = 0; iInArray < aList.length; iInArray++)
    {
      if (aList[iInArray] == mVal)
      {
        return true;
      }
    }
    return false;
  } // scAjaxInArray

  function scAjaxSpecCharParser(sParseString)
  {
    if (null == sParseString) {
      return "";
    }
    var ta = document.createElement("textarea");
    ta.innerHTML = sParseString.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    return ta.value;
  } // scAjaxSpecCharParser

  function scAjaxSpecCharProtect(sOriginal)
  {
        var sProtected;
        sProtected = sOriginal.replace(/[+]/g, "__NM_PLUS__");
        sProtected = sProtected.replace(/[%]/g, "__NM_PERC__");
        return sProtected;
  } // scAjaxSpecCharProtect

  function scAjaxRecreateOptions(sFieldType, sHtmlType, sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch)
  {
    var sSuffix  = ("checkbox" == sHtmlType) ? "[]" : "";
    var sDivName = "idAjax" + sFieldType + "_" + sFieldName;
    var sDivText = "";
    var iCntLine = 0;
    var aValues  = new Array();
    var sClass;
    var markChangedClass;
    if (null != oFieldValues)
    {
      for (iRecreate = 0; iRecreate < oFieldValues.length; iRecreate++)
      {
        aValues[iRecreate] = scAjaxSpecCharParser(oFieldValues[iRecreate]["value"]);
      }
    }
    sDivText += "<table border=0>";
    if ("checkbox" == sHtmlType)
    {
        markChangedClass = "sc-ui-checkbox-" + sFieldName;
    }
    if ("radio" == sHtmlType)
    {
        markChangedClass = "sc-ui-radio-" + sFieldName;
    }
    for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
    {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        if (0 == iCntLine)
        {
            sDivText += "<tr>";
        }
        iCntLine++;
        if ("" != sOptClass)
        {
            sClass = " class=\"" + sOptClass;
            if ("" != sOptMulti)
            {
                sClass += " " + sOptClass + sOptMulti;
            }
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        else
        {
            sClass = " class=\"";
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        if (sHtmComp == null)
        {
            sHtmComp = "";
        }
        sChecked  = (scAjaxInArray(sOptValue, aValues)) ? " checked" : "";
        sDivText += "<td class=\"scFormDataFontOdd css_" + sFieldName + "_line\">";
                if (bSwitch)
                {
                        sDivText += "<div class=\"sc ";
                        if ("Checkbox" == sFieldType)
                        {
                                sDivText += "switch";
                        }
                        else
                        {
                                sDivText += "radio";
                        }
                        sDivText += "\">";
                }
        sDivText += "<input id=\"id-opt-" + sFieldName + "-"  + iRecreate + "\" type=\"" + sHtmlType + "\" name=\"" + sFieldName + sSuffix + "\" value=\"" + sOptValue + "\"" + sChecked + " " + sHtmComp + " " + sOptComp + sClass + ">";
                if (bSwitch)
                {
                        sDivText += "<span></span>";
                }
        sDivText += "<label for=\"id-opt-" + sFieldName + "-"  + iRecreate + "\">" + sOptText + "</label>";
                if (bSwitch)
                {
                        sDivText += "</div>";
                }
        sDivText += "</td>";
        if (iColNum == iCntLine)
        {
            sDivText += "</tr>";
            iCntLine  = 0;
        }
    }
    sDivText += "</table>";
    document.getElementById(sDivName).innerHTML = sDivText;
    if ("" != markChangedClass)
    {
      $("." + markChangedClass).on("click", function() { scMarkFormAsChanged(); });
    }
  } // scAjaxRecreateOptions

  function scAjaxProcOn(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.blockUI && !bForce)
      {
        $.blockUI({
          message: $("#id_div_process_block"),
          overlayCSS: { backgroundColor: sc_ajaxBg },
          css: {
            borderColor: sc_ajaxBordC,
            borderStyle: sc_ajaxBordS,
            borderWidth: sc_ajaxBordW
          }
        });
      }
      else
      {
        document.getElementById("id_div_process").style.display = "";
        document.getElementById("id_fatal_error").style.display = "none";
        if (null != scCenterElement)
        {
          scCenterElement(document.getElementById("id_div_process"));
        }
      }
    }
  } // scAjaxProcOn

  function scAjaxProcOff(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.unblockUI && !bForce)
      {
        $.unblockUI();
      }
      else
      {
        document.getElementById("id_div_process").style.display = "none";
      }
    }
  } // scAjaxProcOff

  function scAjaxSetMaster()
  {
    if (!oResp["masterValue"])
    {
      return;
    }
        if (scMasterDetailParentIframe && "" != scMasterDetailParentIframe)
        {
      var dbParentFrame = $(parent.document).find("[name='" + scMasterDetailParentIframe + "']");
          if (!dbParentFrame || !dbParentFrame[0] || !dbParentFrame[0].contentWindow.scAjaxDetailValue)
          {
                return;
          }
      for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
      {
        dbParentFrame[0].contentWindow.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
      }
        }
    if (!parent || !parent.scAjaxDetailValue)
    {
      return;
    }
    for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
    {
      parent.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
    }
  } // scAjaxSetMaster

  function scAjaxSetFocus()
  {
    if (!oResp["setFocus"] && '' == scFocusFirstErrorName)
    {
      return;
    }
    sFieldName = oResp["setFocus"];
    if (document.F1.elements[sFieldName])
    {
        scFocusField(sFieldName);
    }
    scAjaxFocusError();
  } // scAjaxSetFocus

  function scAjaxFocusError()
  {
    if ('' != scFocusFirstErrorName)
    {
      scFocusField(scFocusFirstErrorName);
      scFocusFirstErrorName = '';
    }
  } // scAjaxFocusError

  function scAjaxSetNavStatus(sBarPos)
  {
    if (!oResp["navStatus"])
    {
      return;
    }
    sNavRet = "S";
    sNavAva = "S";
    if (oResp["navStatus"]["ret"])
    {
      sNavRet = oResp["navStatus"]["ret"];
    }
    if (oResp["navStatus"]["ava"])
    {
      sNavAva = oResp["navStatus"]["ava"];
    }
    if ("S" != sNavRet && "N" != sNavRet)
    {
      sNavRet = "S";
    }
    if ("S" != sNavAva && "N" != sNavAva)
    {
      sNavAva = "S";
    }
    Nav_permite_ret = sNavRet;
    Nav_permite_ava = sNavAva;
    nav_atualiza(Nav_permite_ret, Nav_permite_ava, sBarPos);
  } // scAjaxSetNavStatus

  function scAjaxSetSummary()
  {
    if (!oResp["navSummary"])
    {
      return;
    }
    sreg_ini = oResp["navSummary"].reg_ini;
    sreg_qtd = oResp["navSummary"].reg_qtd;
    sreg_tot = oResp["navSummary"].reg_tot;
    summary_atualiza(sreg_ini, sreg_qtd, sreg_tot);
  } // scAjaxSetSummary

  function scAjaxSetNavpage()
  {
    navpage_atualiza(oResp["navPage"]);
  } // scAjaxSetNavpage


  function scAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"])
    {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo)
    {
      if ("parent.parent" == oResp["redirInfo"]["target"])
      {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"])
      {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"])
      {
        window.open(sAction, "_blank");
      }
      else
      {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo)
    {
        document.write(scAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else
    {
      if (oResp["redirInfo"]["target"] == "modal")
      {

          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');

          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir)
      {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else
      {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  } // scAjaxRedir

  function scAjaxSetDisplay(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    var aDispData = new Array();
    var aDispCont = {};
    var vertButton;
    if (bReset)
    {
      for (iDisplay = 0; iDisplay < ajax_block_list.length; iDisplay++)
      {
        aDispCont[ajax_block_list[iDisplay]] = aDispData.length;
        aDispData[aDispData.length] = new Array(ajax_block_id[ajax_block_list[iDisplay]], "on");
      }
      for (iDisplay = 0; iDisplay < ajax_field_list.length; iDisplay++)
      {
        if (ajax_field_id[ajax_field_list[iDisplay]])
        {
          aFieldIds = ajax_field_id[ajax_field_list[iDisplay]];
          for (iDisplay2 = 0; iDisplay2 < aFieldIds.length; iDisplay2++)
          {
            aDispCont[aFieldIds[iDisplay2]] = aDispData.length;
            aDispData[aDispData.length] = new Array(aFieldIds[iDisplay2], "on");
          }
        }
      }
    }
        var blockDisplay = {};
    if (oResp["blockDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["blockDisplay"].length; iDisplay++)
      {
        if (bReset)
        {
          aDispData[ aDispCont[ oResp["blockDisplay"][iDisplay][0] ] ][1] = oResp["blockDisplay"][iDisplay][1];
        }
        else
        {
          aDispData[aDispData.length] = new Array(ajax_block_id[ oResp["blockDisplay"][iDisplay][0] ], oResp["blockDisplay"][iDisplay][1]);
        }
                blockDisplay[ oResp["blockDisplay"][iDisplay][0] ] = oResp["blockDisplay"][iDisplay][1];
      }
          //scCheckPagesWithoutBlock();
    }
        var fieldDisplay = {}, controlHtmlHideField = [], controlHtmlShowField = [];
    if (oResp["fieldDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["fieldDisplay"].length; iDisplay++)
      {
        if (typeof scHideUserField === "function" && "off" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlHideField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        if (typeof scShowUserField === "function" && "on" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlShowField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        for (iDisplay2 = 1; iDisplay2 < ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ].length; iDisplay2++)
        {
          aFieldIds = ajax_field_id[ ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ][iDisplay2] ];
          for (iDisplay3 = 0; iDisplay3 < aFieldIds.length; iDisplay3++)
          {
            if (bReset)
            {
              aDispData[ aDispCont[ aFieldIds[iDisplay3] ] ][1] = oResp["fieldDisplay"][iDisplay][1];
            }
            else
            {
              aDispData[aDispData.length] = new Array(aFieldIds[iDisplay3], oResp["fieldDisplay"][iDisplay][1]);
            }
                        if ("hidden_field_data_" == aFieldIds[iDisplay3].substr(0, 18)) {
                          fieldDisplay[ aFieldIds[iDisplay3].substr(18) ] = oResp["fieldDisplay"][iDisplay][1];
                        }
          }
        }
      }
    }
    if (oResp["buttonDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplay"].length; iDisplay++)
      {
        var sBtnName2 = "";
        var sBtnName3 = "";
        switch (oResp["buttonDisplay"][iDisplay][0])
        {
          case "first": var sBtnName = "sc_b_ini"; break;
          case "back": var sBtnName = "sc_b_ret"; break;
          case "forward": var sBtnName = "sc_b_avc"; break;
          case "last": var sBtnName = "sc_b_fim"; break;
          case "insert": var sBtnName = "sc_b_ins"; break;
          case "update": var sBtnName = "sc_b_upd"; break;
          case "delete": var sBtnName = "sc_b_del"; break;
          default: var sBtnName = "sc_b_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName2 = "sc_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName3 = "gbl_sc_" + oResp["buttonDisplay"][iDisplay][0]; break;
        }
        aDispData[aDispData.length] = new Array(sBtnName, oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_t", oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_b", oResp["buttonDisplay"][iDisplay][1]);
        if ("" != sBtnName2)
        {
          aDispData[aDispData.length] = new Array(sBtnName2, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
        if ("" != sBtnName3)
        {
          aDispData[aDispData.length] = new Array(sBtnName3, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
      }
    }
    if (oResp["buttonDisplayVert"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplayVert"].length; iDisplay++)
      {
        vertButton = oResp["buttonDisplayVert"][iDisplay];
        aDispData[aDispData.length] = new Array("sc_exc_line_" + vertButton.seq, vertButton.delete);
        if (vertButton.gridView)
        {
          aDispData[aDispData.length] = new Array("sc_open_line_" + vertButton.seq, vertButton.update);
        }
        else
        {
          aDispData[aDispData.length] = new Array("sc_upd_line_" + vertButton.seq, vertButton.update);
        }
      }
    }
    for (iDisplay = 0; iDisplay < aDispData.length; iDisplay++)
    {
      scAjaxElementDisplay(aDispData[iDisplay][0], aDispData[iDisplay][1]);
    }
        for (var blockId in blockDisplay) {
                displayChange_block(blockId, blockDisplay[blockId]);
        }
        for (var fieldId in fieldDisplay) {
                displayChange_field(fieldId, "", fieldDisplay[fieldId]);
        }
        if (controlHtmlHideField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlHideField.length; iDisplay++) {
            scHideUserField(controlHtmlHideField[iDisplay]);
          }
        }
        if (controlHtmlShowField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlShowField.length; iDisplay++) {
            scShowUserField(controlHtmlShowField[iDisplay]);
          }
        }
  } // scAjaxSetDisplay

  function scAjaxNavigateButtonDisplay(sButton, sStatus)
  {
    sButton2 = sButton + "_off";

    if ("off" == sStatus)
    {
      sStatus2 = "off";
    }
    else
    {
      if ("sc_b_ini" == sButton || "sc_b_ret" == sButton)
      {
        if ("S" == Nav_permite_ret)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
      else
      {
        if ("S" == Nav_permite_ava)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
    }

    scAjaxElementDisplay(sButton        , sStatus);
    scAjaxElementDisplay(sButton + "_t" , sStatus);
    scAjaxElementDisplay(sButton + "_b" , sStatus);
    scAjaxElementDisplay(sButton2       , sStatus2);
    scAjaxElementDisplay(sButton2 + "_t", sStatus2);
    scAjaxElementDisplay(sButton2 + "_b", sStatus2);
  } // scAjaxNavigateButtonDisplay

  function scAjaxElementDisplay(sElement, sAction)
  {
    if (ajax_block_tab && ajax_block_tab[sElement] && "" != ajax_block_tab[sElement])
    {
      scAjaxElementDisplay(ajax_block_tab[sElement], sAction);
    }
    if (document.getElementById(sElement))
    {

      if("off" == sAction)
      {
        $('#' + sElement).hide();
      }
      else
      {
        $('#' + sElement).show();
        if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
          $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
        }
      }
      if (document.getElementById(sElement + "_dumb"))
      {
        if("off" == sAction)
        {
          $('#' + sElement + "_dumb").show();
          if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
            $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
          }
        }
        else
        {
          $('#' + sElement + "_dumb").hide();
        }
      }
    }
  } // scAjaxElementDisplay

  function scAjaxSetLabel(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iLabel = 0; iLabel < ajax_field_list.length; iLabel++)
      {
        if (ajax_field_list[iLabel] && ajax_error_list[ajax_field_list[iLabel]])
        {
          scAjaxFieldLabel(ajax_field_list[iLabel], ajax_error_list[ajax_field_list[iLabel]]["label"]);
        }
      }
    }
    if (oResp["fieldLabel"])
    {
      for (iLabel = 0; iLabel < oResp["fieldLabel"].length; iLabel++)
      {
        scAjaxFieldLabel(oResp["fieldLabel"][iLabel][0], scAjaxSpecCharParser(oResp["fieldLabel"][iLabel][1]));
      }
    }
  } // scAjaxSetLabel

  function scAjaxFieldLabel(sField, sLabel)
  {
    if (document.getElementById("id_label_" + sField))
    {
      if (document.getElementById("id_label_" + sField).innerHTML != sLabel)
      {
        document.getElementById("id_label_" + sField).innerHTML = sLabel;
      }
    }
    else if (document.getElementById("hidden_field_label_" + sField) && document.getElementById("hidden_field_label_" + sField).innerHTML != sLabel)
    {
      document.getElementById("hidden_field_label_" + sField).innerHTML = sLabel;
    }
  } // scAjaxFieldLabel

  function scAjaxSetReadonly(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iRead = 0; iRead < ajax_field_list.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_list[iRead], ajax_read_only[ajax_field_list[iRead]]);
      }
      for (iRead = 0; iRead < ajax_field_Dt_Hr.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_Dt_Hr[iRead], ajax_read_only[ajax_field_Dt_Hr[iRead]]);
      }
    }
    if (oResp["readOnly"])
    {
      for (iRead = 0; iRead < oResp["readOnly"].length; iRead++)
      {
        if (ajax_read_only[ oResp["readOnly"][iRead][0] ])
        {
          scAjaxFieldRead(oResp["readOnly"][iRead][0], oResp["readOnly"][iRead][1]);
        }
        else if (oResp["rsSize"])
        {
          for (var i = 0; i <= oResp["rsSize"]; i++)
          {
            if (ajax_read_only[ oResp["readOnly"][iRead][0] + i ])
            {
              scAjaxFieldRead(oResp["readOnly"][iRead][0] + i, oResp["readOnly"][iRead][1]);
            }
          }
        }
      }
    }
  } // scAjaxSetReadonly

  function scAjaxFieldRead(sField, sStatus)
  {
    if ("on" == sStatus)
    {
      var sDisplayOff = "none";
      var sDisplayOn  = "";
    }
    else
    {
      var sDisplayOff = "";
      var sDisplayOn  = "none";
    }
    if (document.getElementById("id_read_off_" + sField))
    {
      document.getElementById("id_read_off_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_sc_dragdrop_" + sField))
    {
      document.getElementById("id_sc_dragdrop_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_read_on_" + sField))
    {
      document.getElementById("id_read_on_" + sField).style.display = sDisplayOn;
    }
  } // scAjaxFieldRead

  function scAjaxSetBtnVars()
  {
    if (oResp["btnVars"])
    {
      for (iBtn = 0; iBtn < oResp["btnVars"].length; iBtn++)
      {
        eval(oResp["btnVars"][iBtn][0] + " = scAjaxSpecCharParser('" + oResp["btnVars"][iBtn][1] + "');");
      }
    }
  } // scAjaxSetBtnVars

  function scAjaxClearText(sFormField)
  {
    document.F1.elements[sFormField].value = "";
  } // scAjaxClearText

  function scAjaxClearLabel(sFormField)
  {
    document.getElementById("id_ajax_label_" + sFormField).innerHTML = "";
  } // scAjaxClearLabel

  function scAjaxClearSelect(sFormField)
  {
    document.F1.elements[sFormField].length = 0;
  } // scAjaxClearSelect

  function scAjaxClearCheckbox(sFormField)
  {
    document.getElementById("idAjaxCheckbox_" + sFormField).innerHTML = "";
  } // scAjaxClearCheckbox

  function scAjaxClearRadio(sFormField)
  {
    document.getElementById("idAjaxRadio_" + sFormField).innerHTML = "";
  } // scAjaxClearRadio

  function scAjaxClearEditorHtml(sFormField)
  {
    if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent("");
  } // scAjaxClearEditorHtml

  function scCheckPagesWithoutBlock()
  {
        var page_id, block_id, has_block_shown;
    for (page_id in ajax_page_blocks) {
          has_block_shown = false;
      for (block_id in ajax_page_blocks[page_id]) {
                console.log(page_id + ' ' + ajax_page_blocks[page_id][block_id]);
                console.log($("#div_" + ajax_block_id[ajax_page_blocks[page_id][block_id]]).css('display'));
        //$("#div_" + ajax_block_id[block_id]);
      }
    }
  }

  function scAjaxJavascript()
  {
    if (oResp["ajaxJavascript"])
    {
      var sJsFunc = "";
      for (var i = 0; i < oResp["ajaxJavascript"].length; i++)
      {
        sJsFunc = scAjaxSpecCharParser(oResp["ajaxJavascript"][i][0]);
        if ("" != sJsFunc)
        {
          var aParam = new Array();
          if (oResp["ajaxJavascript"][i][1] && 0 < oResp["ajaxJavascript"][i][1].length)
          {
            for (var j = 0; j < oResp["ajaxJavascript"][i][1].length; j++)
            {
              aParam.push("'" + oResp["ajaxJavascript"][i][1][j] + "'");
            }
          }
          eval("if (" + sJsFunc + ") { " + sJsFunc + "(" + aParam.join(", ") + ") }");
        }
      }
    }
  } // scAjaxJavascript

  function scAjaxAlert(callbackOk)
  {
    if (oResp["ajaxAlert"] && oResp["ajaxAlert"]["message"] && "" != oResp["ajaxAlert"]["message"])
    {
      scJs_alert(oResp["ajaxAlert"]["message"], callbackOk, oResp["ajaxAlert"]["params"]);
    }
    else
    {
      callbackOk();
    }
  } // scAjaxAlert

        function scJs_alert_default(message, callbackOk) {
                alert(message);
                if (typeof callbackOk == "function") {
                        callbackOk();
                }
        } // scJs_alert_default

        function scJs_confirm_default(message, callbackOk, callbackCancel) {
                if (confirm(message)) {
                        callbackOk();
                }
                else {
                        callbackCancel();
                }
        } // scJs_confirm_default

  function scAjaxMessage(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["ajaxMessage"] && oResp["ajaxMessage"]["message"] && "" != oResp["ajaxMessage"]["message"])
    {
      var sTitle    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["title"])        ? oResp["ajaxMessage"]["title"]               : scMsgDefTitle,
          bModal    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["modal"])        ? ("Y" == oResp["ajaxMessage"]["modal"])      : false,
          iTimeout  = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["timeout"])      ? parseInt(oResp["ajaxMessage"]["timeout"])   : 0,
          bButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button"])       ? ("Y" == oResp["ajaxMessage"]["button"])     : false,
          sButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button_label"]) ? oResp["ajaxMessage"]["button_label"]        : "Ok",
          iTop      = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["top"])          ? parseInt(oResp["ajaxMessage"]["top"])       : 0,
          iLeft     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["left"])         ? parseInt(oResp["ajaxMessage"]["left"])      : 0,
          iWidth    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["width"])        ? parseInt(oResp["ajaxMessage"]["width"])     : 0,
          iHeight   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["height"])       ? parseInt(oResp["ajaxMessage"]["height"])    : 0,
          bClose    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["show_close"])   ? ("Y" == oResp["ajaxMessage"]["show_close"]) : true,
          bBodyIcon = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["body_icon"])    ? ("Y" == oResp["ajaxMessage"]["body_icon"])  : true,
          sRedir    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir"])        ? oResp["ajaxMessage"]["redir"]               : "",
          sTarget   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_target"]) ? oResp["ajaxMessage"]["redir_target"]        : "",
          sParam    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_par"])    ? oResp["ajaxMessage"]["redir_par"]           : "",
          bToast    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast"])        ? ("Y" == oResp["ajaxMessage"]["toast"])      : false,
          sToastPos = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast_pos"])    ? oResp["ajaxMessage"]["toast_pos"]           : "",
          sType     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["type"])         ? oResp["ajaxMessage"]["type"]                : "";
      if (typeof scDisplayUserMessage == "function") {
        scDisplayUserMessage(oResp["ajaxMessage"]["message"]);
      }
      else {
                  var params = {
                          title: sTitle,
                          message: oResp["ajaxMessage"]["message"],
                          isModal: bModal,
                          timeout: iTimeout,
                          showButton: bButton,
                          buttonLabel: sButton,
                          topPos: iTop,
                          leftPos: iLeft,
                          width: iWidth,
                          height: iHeight,
                          redirUrl: sRedir,
                          redirTarget: sTarget,
                          redirParams: sParam,
                          showClose: bClose,
                          showBodyIcon: bBodyIcon,
                          isToast: bToast,
                          toastPos: sToastPos,
                          type: sType
                  };
        _scAjaxShowMessage(params);
      }
    }
  } // scAjaxMessage

  function scAjaxResponse(sResp)
  {
    eval("var oResp = " + sResp);
    return oResp;
  } // scAjaxResponse

  function scAjaxBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      input += "";
      if(!/<[^>]+>/.test(input)){
        while (input.lastIndexOf(String.fromCharCode(10)) > -1)
        {
          input = input.replace(String.fromCharCode(10), '<br>');
        }
      }
      return input;
  } // scAjaxBreakLine

  function scAjaxProtectBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      var input1 = input + "";
      while (input1.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input1 = input1.replace(String.fromCharCode(10), '#@NM#@');
      }
      return input1;
  } // scAjaxProtectBreakLine

  function scAjaxReturnBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      while (input.lastIndexOf('#@NM#@') > -1)
      {
         input = input.replace('#@NM#@', String.fromCharCode(10));
      }
      return input;
  } // scAjaxReturnBreakLine

  function scOpenMasterDetail(widget, url)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe.attr("src", url);
  } // scOpenMasterDetail

  function scMoveMasterDetail(widget)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe[0].contentWindow.nm_move("apl_detalhe", true);
  } // scMoveMasterDetail

        function scAjaxError_markList() {
            if ('undefined' == typeof oResp.errList) {
                return;
            }
                var i, fieldName, fieldList = new Array();
                for (i = 0; i < oResp.errList.length; i++) {
                        fieldName = oResp.errList[i]["fldName"];
                        if (oResp.errList[i]["numLinha"]) {
                                fieldName += oResp.errList[i]["numLinha"];
                        }
            fieldList.push(fieldName);
                }
                scAjaxError_markFieldList(fieldList);
        } // scAjaxError_markList

        function scAjaxError_markFieldList(fieldList) {
                var i;
                for (i = 0; i < fieldList.length; i++) {
            scAjaxError_markField(fieldList[i]);
                }
        } // scAjaxError_markFieldList

        function scAjaxError_unmarkList() {
                var i;
                for (i = 0; i < ajax_field_list.length; i++) {
            scAjaxError_unmarkField(ajax_field_list[i]);
                }
        } // scAjaxError_unmarkList

        function scAjaxError_markField(fieldName) {
                var $oField  = $("#id_sc_field_" + fieldName);
                var $S2Field = $("#select2-id_sc_field_" + fieldName + '-container');
                if (0 < $oField.length) {
                        scAjax_applyFieldErrorStyle($oField);
                        if ($S2Field) {
                            scAjax_applyFieldErrorStyle($S2Field);
                        }
                }
        } // scAjaxError_markField

        function scAjaxError_unmarkField(fieldName) {
                var $oField = $("#id_sc_field_" + fieldName);
                var $S2Field = $("#select2-id_sc_field_" + fieldName + '-container');
                if (0 < $oField.length) {
                        scAjax_removeFieldErrorStyle($oField);
                        if ($S2Field) {
                            scAjax_removeFieldErrorStyle($S2Field);
                        }
                }
        } // scAjaxError_unmarkField

        function scAjax_displayEmptyForm() {
        $("#sc-ui-empty-form").show();
        $(".sc-ui-page-tab-line").hide();
        $("#sc-id-required-row").hide();
        sc_hide_form_itens_proc_compra_form();
        }

  function scAjax_applyFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.addClass(sc_css_status_pwd_text);
        fieldObj.parent().addClass(sc_css_status_pwd_box);
      } else {
        fieldObj.addClass(sc_css_status);
        
        if(fieldObj.attr('data-select2-id') && fieldObj.attr('data-select2-id').length && $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').length)
        {
            $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').addClass(sc_css_status);
        }
      }
  }

  function scAjax_removeFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.removeClass(sc_css_status_pwd_text);
        fieldObj.parent().removeClass(sc_css_status_pwd_box);
      } else {
        fieldObj.removeClass(sc_css_status);
        
        if(fieldObj.attr('data-select2-id') && fieldObj.attr('data-select2-id').length && $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').length)
        {
            $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').removeClass(sc_css_status);
        }
      }
  }

  function scAjax_formReload() {
<?php
    if ($this->nmgp_opcao == 'novo') {
        echo "      nm_move('reload_novo');";
    } else {
        echo "      nm_move('igual');";
    }
?>
  }

  function scBtnDisabled()
  {
    var btnNameNav, hasNavButton = false;

    if (typeof oResp.btnDisabled != undefined) {
      for (var btnName in oResp.btnDisabled) {
        btnNameNav = btnName.substring(0, 9);

        if ("on" == oResp.btnDisabled[btnName]) {
          $("#" + btnName).addClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "on";
            hasNavButton = true;
          }
        } else {
          $("#" + btnName).removeClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "off";
            hasNavButton = true;
          }
        }
      }
    }

    if (hasNavButton) {
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');
    }
  }

  function scBtnLabel()
  {
    if (typeof oResp.btnLabel != undefined) {
      for (var btnName in oResp.btnLabel) {
        $("#" + btnName).find(".btn-label").html(oResp.btnLabel[btnName]);
      }
    }
  }

  var scFormHasChanged = false;

  function scMarkFormAsChanged() {
    scFormHasChanged = true;
  }

  function scResetFormChanges() {
    scFormHasChanged = false;
  }

  var isRunning_scFormClose_F5 = false;
  function scFormClose_F5(exitUrl) {
    if (isRunning_scFormClose_F5) {
      return;
    }
    isRunning_scFormClose_F5 = true;
    setTimeout(function() { isRunning_scFormClose_F5 = false; }, 3000);

    document.F5.action = exitUrl;
    document.F5.submit();

  }

  var isRunning_scFormClose_F6 = false;
  function scFormClose_F6(exitUrl) {
    if (isRunning_scFormClose_F6) {
      return;
    }
    isRunning_scFormClose_F6 = true;
    setTimeout(function() { isRunning_scFormClose_F6 = false; }, 3000);

    document.F6.action = exitUrl;
    document.F6.submit();

  }

  // ---------- Validate proc_compra_id
  function do_ajax_form_itens_proc_compra_validate_proc_compra_id()
  {
    var nomeCampo_proc_compra_id = "proc_compra_id";
    var var_proc_compra_id = scAjaxGetFieldText(nomeCampo_proc_compra_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_proc_compra_id(var_proc_compra_id, var_script_case_init, do_ajax_form_itens_proc_compra_validate_proc_compra_id_cb);
  } // do_ajax_form_itens_proc_compra_validate_proc_compra_id

  function do_ajax_form_itens_proc_compra_validate_proc_compra_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "proc_compra_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_proc_compra_id_cb

  // ---------- Validate item_proc_compra_id
  function do_ajax_form_itens_proc_compra_validate_item_proc_compra_id()
  {
    var nomeCampo_item_proc_compra_id = "item_proc_compra_id";
    var var_item_proc_compra_id = scAjaxGetFieldHidden(nomeCampo_item_proc_compra_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_item_proc_compra_id(var_item_proc_compra_id, var_script_case_init, do_ajax_form_itens_proc_compra_validate_item_proc_compra_id_cb);
  } // do_ajax_form_itens_proc_compra_validate_item_proc_compra_id

  function do_ajax_form_itens_proc_compra_validate_item_proc_compra_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "item_proc_compra_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_item_proc_compra_id_cb

  // ---------- Validate descricao
  function do_ajax_form_itens_proc_compra_validate_descricao()
  {
    var nomeCampo_descricao = "descricao";
    var var_descricao = scAjaxGetFieldText(nomeCampo_descricao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_descricao(var_descricao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_descricao_cb);
  } // do_ajax_form_itens_proc_compra_validate_descricao

  function do_ajax_form_itens_proc_compra_validate_descricao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "descricao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_descricao_cb

  // ---------- Validate codigo_erp
  function do_ajax_form_itens_proc_compra_validate_codigo_erp()
  {
    var nomeCampo_codigo_erp = "codigo_erp";
    var var_codigo_erp = scAjaxGetFieldText(nomeCampo_codigo_erp);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_codigo_erp(var_codigo_erp, var_script_case_init, do_ajax_form_itens_proc_compra_validate_codigo_erp_cb);
  } // do_ajax_form_itens_proc_compra_validate_codigo_erp

  function do_ajax_form_itens_proc_compra_validate_codigo_erp_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "codigo_erp";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_codigo_erp_cb

  // ---------- Validate desc_item
  function do_ajax_form_itens_proc_compra_validate_desc_item()
  {
    var nomeCampo_desc_item = "desc_item";
    var var_desc_item = scAjaxGetFieldHidden(nomeCampo_desc_item);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_desc_item(var_desc_item, var_script_case_init, do_ajax_form_itens_proc_compra_validate_desc_item_cb);
  } // do_ajax_form_itens_proc_compra_validate_desc_item

  function do_ajax_form_itens_proc_compra_validate_desc_item_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "desc_item";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_desc_item_cb

  // ---------- Validate vl_custo_dolar
  function do_ajax_form_itens_proc_compra_validate_vl_custo_dolar()
  {
    var nomeCampo_vl_custo_dolar = "vl_custo_dolar";
    var var_vl_custo_dolar = scAjaxGetFieldText(nomeCampo_vl_custo_dolar);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_vl_custo_dolar(var_vl_custo_dolar, var_script_case_init, do_ajax_form_itens_proc_compra_validate_vl_custo_dolar_cb);
  } // do_ajax_form_itens_proc_compra_validate_vl_custo_dolar

  function do_ajax_form_itens_proc_compra_validate_vl_custo_dolar_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "vl_custo_dolar";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_vl_custo_dolar_cb

  // ---------- Validate vl_base_tributacao
  function do_ajax_form_itens_proc_compra_validate_vl_base_tributacao()
  {
    var nomeCampo_vl_base_tributacao = "vl_base_tributacao";
    var var_vl_base_tributacao = scAjaxGetFieldText(nomeCampo_vl_base_tributacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_vl_base_tributacao(var_vl_base_tributacao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_vl_base_tributacao_cb);
  } // do_ajax_form_itens_proc_compra_validate_vl_base_tributacao

  function do_ajax_form_itens_proc_compra_validate_vl_base_tributacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "vl_base_tributacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_vl_base_tributacao_cb

  // ---------- Validate unid_medida
  function do_ajax_form_itens_proc_compra_validate_unid_medida()
  {
    var nomeCampo_unid_medida = "unid_medida";
    var var_unid_medida = scAjaxGetFieldSelect(nomeCampo_unid_medida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_unid_medida(var_unid_medida, var_script_case_init, do_ajax_form_itens_proc_compra_validate_unid_medida_cb);
  } // do_ajax_form_itens_proc_compra_validate_unid_medida

  function do_ajax_form_itens_proc_compra_validate_unid_medida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "unid_medida";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_unid_medida_cb

  // ---------- Validate qt_comprada
  function do_ajax_form_itens_proc_compra_validate_qt_comprada()
  {
    var nomeCampo_qt_comprada = "qt_comprada";
    var var_qt_comprada = scAjaxGetFieldText(nomeCampo_qt_comprada);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_qt_comprada(var_qt_comprada, var_script_case_init, do_ajax_form_itens_proc_compra_validate_qt_comprada_cb);
  } // do_ajax_form_itens_proc_compra_validate_qt_comprada

  function do_ajax_form_itens_proc_compra_validate_qt_comprada_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "qt_comprada";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_qt_comprada_cb

  // ---------- Validate vl_cubagem
  function do_ajax_form_itens_proc_compra_validate_vl_cubagem()
  {
    var nomeCampo_vl_cubagem = "vl_cubagem";
    var var_vl_cubagem = scAjaxGetFieldText(nomeCampo_vl_cubagem);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_vl_cubagem(var_vl_cubagem, var_script_case_init, do_ajax_form_itens_proc_compra_validate_vl_cubagem_cb);
  } // do_ajax_form_itens_proc_compra_validate_vl_cubagem

  function do_ajax_form_itens_proc_compra_validate_vl_cubagem_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "vl_cubagem";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_vl_cubagem_cb

  // ---------- Validate composicao
  function do_ajax_form_itens_proc_compra_validate_composicao()
  {
    var nomeCampo_composicao = "composicao";
    var var_composicao = scAjaxGetFieldText(nomeCampo_composicao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_composicao(var_composicao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_composicao_cb);
  } // do_ajax_form_itens_proc_compra_validate_composicao

  function do_ajax_form_itens_proc_compra_validate_composicao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "composicao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_composicao_cb

  // ---------- Validate shrinkage
  function do_ajax_form_itens_proc_compra_validate_shrinkage()
  {
    var nomeCampo_shrinkage = "shrinkage";
    var var_shrinkage = scAjaxGetFieldText(nomeCampo_shrinkage);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_shrinkage(var_shrinkage, var_script_case_init, do_ajax_form_itens_proc_compra_validate_shrinkage_cb);
  } // do_ajax_form_itens_proc_compra_validate_shrinkage

  function do_ajax_form_itens_proc_compra_validate_shrinkage_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "shrinkage";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_shrinkage_cb

  // ---------- Validate peso
  function do_ajax_form_itens_proc_compra_validate_peso()
  {
    var nomeCampo_peso = "peso";
    var var_peso = scAjaxGetFieldText(nomeCampo_peso);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_peso(var_peso, var_script_case_init, do_ajax_form_itens_proc_compra_validate_peso_cb);
  } // do_ajax_form_itens_proc_compra_validate_peso

  function do_ajax_form_itens_proc_compra_validate_peso_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "peso";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_peso_cb

  // ---------- Validate largura
  function do_ajax_form_itens_proc_compra_validate_largura()
  {
    var nomeCampo_largura = "largura";
    var var_largura = scAjaxGetFieldText(nomeCampo_largura);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_largura(var_largura, var_script_case_init, do_ajax_form_itens_proc_compra_validate_largura_cb);
  } // do_ajax_form_itens_proc_compra_validate_largura

  function do_ajax_form_itens_proc_compra_validate_largura_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "largura";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_largura_cb

  // ---------- Validate calc_gm
  function do_ajax_form_itens_proc_compra_validate_calc_gm()
  {
    var nomeCampo_calc_gm = "calc_gm";
    var var_calc_gm = scAjaxGetFieldText(nomeCampo_calc_gm);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_calc_gm(var_calc_gm, var_script_case_init, do_ajax_form_itens_proc_compra_validate_calc_gm_cb);
  } // do_ajax_form_itens_proc_compra_validate_calc_gm

  function do_ajax_form_itens_proc_compra_validate_calc_gm_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "calc_gm";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_calc_gm_cb

  // ---------- Validate rolo
  function do_ajax_form_itens_proc_compra_validate_rolo()
  {
    var nomeCampo_rolo = "rolo";
    var var_rolo = scAjaxGetFieldText(nomeCampo_rolo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_rolo(var_rolo, var_script_case_init, do_ajax_form_itens_proc_compra_validate_rolo_cb);
  } // do_ajax_form_itens_proc_compra_validate_rolo

  function do_ajax_form_itens_proc_compra_validate_rolo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "rolo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_rolo_cb

  // ---------- Validate coloracao_id
  function do_ajax_form_itens_proc_compra_validate_coloracao_id()
  {
    var nomeCampo_coloracao_id = "coloracao_id";
    var var_coloracao_id = scAjaxGetFieldSelect(nomeCampo_coloracao_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_coloracao_id(var_coloracao_id, var_script_case_init, do_ajax_form_itens_proc_compra_validate_coloracao_id_cb);
  } // do_ajax_form_itens_proc_compra_validate_coloracao_id

  function do_ajax_form_itens_proc_compra_validate_coloracao_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "coloracao_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_coloracao_id_cb

  // ---------- Validate item_estacao
  function do_ajax_form_itens_proc_compra_validate_item_estacao()
  {
    var nomeCampo_item_estacao = "item_estacao";
    var var_item_estacao = scAjaxGetFieldSelect(nomeCampo_item_estacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_item_estacao(var_item_estacao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_item_estacao_cb);
  } // do_ajax_form_itens_proc_compra_validate_item_estacao

  function do_ajax_form_itens_proc_compra_validate_item_estacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "item_estacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_item_estacao_cb

  // ---------- Validate formato_amostra_id
  function do_ajax_form_itens_proc_compra_validate_formato_amostra_id()
  {
    var nomeCampo_formato_amostra_id = "formato_amostra_id";
    var var_formato_amostra_id = scAjaxGetFieldSelect(nomeCampo_formato_amostra_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_formato_amostra_id(var_formato_amostra_id, var_script_case_init, do_ajax_form_itens_proc_compra_validate_formato_amostra_id_cb);
  } // do_ajax_form_itens_proc_compra_validate_formato_amostra_id

  function do_ajax_form_itens_proc_compra_validate_formato_amostra_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "formato_amostra_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_formato_amostra_id_cb

  // ---------- Validate log_mostruario
  function do_ajax_form_itens_proc_compra_validate_log_mostruario()
  {
    var nomeCampo_log_mostruario = "log_mostruario";
    var var_log_mostruario = scAjaxGetFieldSelect(nomeCampo_log_mostruario);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_log_mostruario(var_log_mostruario, var_script_case_init, do_ajax_form_itens_proc_compra_validate_log_mostruario_cb);
  } // do_ajax_form_itens_proc_compra_validate_log_mostruario

  function do_ajax_form_itens_proc_compra_validate_log_mostruario_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "log_mostruario";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_log_mostruario_cb

  // ---------- Validate ind_laudo_antes_embarque
  function do_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque()
  {
    var nomeCampo_ind_laudo_antes_embarque = "ind_laudo_antes_embarque";
    var var_ind_laudo_antes_embarque = scAjaxGetFieldSelect(nomeCampo_ind_laudo_antes_embarque);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque(var_ind_laudo_antes_embarque, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque

  function do_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_laudo_antes_embarque";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_laudo_antes_embarque_cb

  // ---------- Validate ind_qualid_emb
  function do_ajax_form_itens_proc_compra_validate_ind_qualid_emb()
  {
    var nomeCampo_ind_qualid_emb = "ind_qualid_emb";
    var var_ind_qualid_emb = scAjaxGetFieldSelect(nomeCampo_ind_qualid_emb);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_qualid_emb(var_ind_qualid_emb, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_qualid_emb_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_qualid_emb

  function do_ajax_form_itens_proc_compra_validate_ind_qualid_emb_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_qualid_emb";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_qualid_emb_cb

  // ---------- Validate ind_prod_conf_pi
  function do_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi()
  {
    var nomeCampo_ind_prod_conf_pi = "ind_prod_conf_pi";
    var var_ind_prod_conf_pi = scAjaxGetFieldSelect(nomeCampo_ind_prod_conf_pi);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi(var_ind_prod_conf_pi, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi

  function do_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_prod_conf_pi";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_prod_conf_pi_cb

  // ---------- Validate ind_rec_amostra_antes_emb
  function do_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb()
  {
    var nomeCampo_ind_rec_amostra_antes_emb = "ind_rec_amostra_antes_emb";
    var var_ind_rec_amostra_antes_emb = scAjaxGetFieldSelect(nomeCampo_ind_rec_amostra_antes_emb);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb(var_ind_rec_amostra_antes_emb, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb

  function do_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_rec_amostra_antes_emb";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_rec_amostra_antes_emb_cb

  // ---------- Validate ind_qt_conf_proforma
  function do_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma()
  {
    var nomeCampo_ind_qt_conf_proforma = "ind_qt_conf_proforma";
    var var_ind_qt_conf_proforma = scAjaxGetFieldSelect(nomeCampo_ind_qt_conf_proforma);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma(var_ind_qt_conf_proforma, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma

  function do_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_qt_conf_proforma";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_qt_conf_proforma_cb

  // ---------- Validate ind_tamanho_pecas_correto
  function do_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto()
  {
    var nomeCampo_ind_tamanho_pecas_correto = "ind_tamanho_pecas_correto";
    var var_ind_tamanho_pecas_correto = scAjaxGetFieldSelect(nomeCampo_ind_tamanho_pecas_correto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto(var_ind_tamanho_pecas_correto, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto

  function do_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_tamanho_pecas_correto";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_tamanho_pecas_correto_cb

  // ---------- Validate dt_prev_envio_desenhos
  function do_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos()
  {
    var nomeCampo_dt_prev_envio_desenhos = "dt_prev_envio_desenhos";
    var var_dt_prev_envio_desenhos = scAjaxGetFieldText(nomeCampo_dt_prev_envio_desenhos);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos(var_dt_prev_envio_desenhos, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos

  function do_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_prev_envio_desenhos";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_envio_desenhos_cb

  // ---------- Validate dt_real_envio_desenhos
  function do_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos()
  {
    var nomeCampo_dt_real_envio_desenhos = "dt_real_envio_desenhos";
    var var_dt_real_envio_desenhos = scAjaxGetFieldText(nomeCampo_dt_real_envio_desenhos);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos(var_dt_real_envio_desenhos, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos

  function do_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_real_envio_desenhos";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_real_envio_desenhos_cb

  // ---------- Validate dt_recbto_laudo
  function do_ajax_form_itens_proc_compra_validate_dt_recbto_laudo()
  {
    var nomeCampo_dt_recbto_laudo = "dt_recbto_laudo";
    var var_dt_recbto_laudo = scAjaxGetFieldText(nomeCampo_dt_recbto_laudo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_recbto_laudo(var_dt_recbto_laudo, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_recbto_laudo_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_recbto_laudo

  function do_ajax_form_itens_proc_compra_validate_dt_recbto_laudo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_recbto_laudo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_recbto_laudo_cb

  // ---------- Validate dt_recbto_embalagem
  function do_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem()
  {
    var nomeCampo_dt_recbto_embalagem = "dt_recbto_embalagem";
    var var_dt_recbto_embalagem = scAjaxGetFieldText(nomeCampo_dt_recbto_embalagem);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem(var_dt_recbto_embalagem, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem

  function do_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_recbto_embalagem";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_recbto_embalagem_cb

  // ---------- Validate dt_cheg_amostras_emb
  function do_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb()
  {
    var nomeCampo_dt_cheg_amostras_emb = "dt_cheg_amostras_emb";
    var var_dt_cheg_amostras_emb = scAjaxGetFieldText(nomeCampo_dt_cheg_amostras_emb);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb(var_dt_cheg_amostras_emb, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb

  function do_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_cheg_amostras_emb";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_cheg_amostras_emb_cb

  // ---------- Validate dt_mostruario
  function do_ajax_form_itens_proc_compra_validate_dt_mostruario()
  {
    var nomeCampo_dt_mostruario = "dt_mostruario";
    var var_dt_mostruario = scAjaxGetFieldText(nomeCampo_dt_mostruario);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_mostruario(var_dt_mostruario, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_mostruario_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_mostruario

  function do_ajax_form_itens_proc_compra_validate_dt_mostruario_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_mostruario";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_mostruario_cb

  // ---------- Validate envios_amostra
  function do_ajax_form_itens_proc_compra_validate_envios_amostra()
  {
    var nomeCampo_envios_amostra = "envios_amostra";
    var var_envios_amostra = scAjaxGetFieldText(nomeCampo_envios_amostra);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_envios_amostra(var_envios_amostra, var_script_case_init, do_ajax_form_itens_proc_compra_validate_envios_amostra_cb);
  } // do_ajax_form_itens_proc_compra_validate_envios_amostra

  function do_ajax_form_itens_proc_compra_validate_envios_amostra_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "envios_amostra";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_envios_amostra_cb

  // ---------- Validate observacao
  function do_ajax_form_itens_proc_compra_validate_observacao()
  {
    var nomeCampo_observacao = "observacao";
    var var_observacao = scAjaxGetFieldText(nomeCampo_observacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_observacao(var_observacao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_observacao_cb);
  } // do_ajax_form_itens_proc_compra_validate_observacao

  function do_ajax_form_itens_proc_compra_validate_observacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "observacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_observacao_cb

  // ---------- Validate log_aprov_so_ld
  function do_ajax_form_itens_proc_compra_validate_log_aprov_so_ld()
  {
    var nomeCampo_log_aprov_so_ld = "log_aprov_so_ld";
    var var_log_aprov_so_ld = scAjaxGetFieldSelect(nomeCampo_log_aprov_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_log_aprov_so_ld(var_log_aprov_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_log_aprov_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_log_aprov_so_ld

  function do_ajax_form_itens_proc_compra_validate_log_aprov_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "log_aprov_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_log_aprov_so_ld_cb

  // ---------- Validate dt_prev_recbto_so_ld
  function do_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld()
  {
    var nomeCampo_dt_prev_recbto_so_ld = "dt_prev_recbto_so_ld";
    var var_dt_prev_recbto_so_ld = scAjaxGetFieldText(nomeCampo_dt_prev_recbto_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld(var_dt_prev_recbto_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld

  function do_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_prev_recbto_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_recbto_so_ld_cb

  // ---------- Validate dt_prev_aprov_so_ld
  function do_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld()
  {
    var nomeCampo_dt_prev_aprov_so_ld = "dt_prev_aprov_so_ld";
    var var_dt_prev_aprov_so_ld = scAjaxGetFieldText(nomeCampo_dt_prev_aprov_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld(var_dt_prev_aprov_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld

  function do_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_prev_aprov_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_aprov_so_ld_cb

  // ---------- Validate dt_real_aprov_so_ld
  function do_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld()
  {
    var nomeCampo_dt_real_aprov_so_ld = "dt_real_aprov_so_ld";
    var var_dt_real_aprov_so_ld = scAjaxGetFieldText(nomeCampo_dt_real_aprov_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld(var_dt_real_aprov_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld

  function do_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_real_aprov_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_real_aprov_so_ld_cb

  // ---------- Validate qt_dias_calc_so_ld
  function do_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld()
  {
    var nomeCampo_qt_dias_calc_so_ld = "qt_dias_calc_so_ld";
    var var_qt_dias_calc_so_ld = scAjaxGetFieldText(nomeCampo_qt_dias_calc_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld(var_qt_dias_calc_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld

  function do_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "qt_dias_calc_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_qt_dias_calc_so_ld_cb

  // ---------- Validate dt_real_recbto_so_ld
  function do_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld()
  {
    var nomeCampo_dt_real_recbto_so_ld = "dt_real_recbto_so_ld";
    var var_dt_real_recbto_so_ld = scAjaxGetFieldText(nomeCampo_dt_real_recbto_so_ld);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld(var_dt_real_recbto_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld

  function do_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_real_recbto_so_ld";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_real_recbto_so_ld_cb

  // ---------- Validate ind_producao_no_prazo
  function do_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo()
  {
    var nomeCampo_ind_producao_no_prazo = "ind_producao_no_prazo";
    var var_ind_producao_no_prazo = scAjaxGetFieldSelect(nomeCampo_ind_producao_no_prazo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo(var_ind_producao_no_prazo, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo

  function do_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_producao_no_prazo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_producao_no_prazo_cb

  // ---------- Validate qt_dias_producao
  function do_ajax_form_itens_proc_compra_validate_qt_dias_producao()
  {
    var nomeCampo_qt_dias_producao = "qt_dias_producao";
    var var_qt_dias_producao = scAjaxGetFieldText(nomeCampo_qt_dias_producao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_qt_dias_producao(var_qt_dias_producao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_qt_dias_producao_cb);
  } // do_ajax_form_itens_proc_compra_validate_qt_dias_producao

  function do_ajax_form_itens_proc_compra_validate_qt_dias_producao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "qt_dias_producao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_qt_dias_producao_cb

  // ---------- Validate ind_relat_semanal_producao
  function do_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao()
  {
    var nomeCampo_ind_relat_semanal_producao = "ind_relat_semanal_producao";
    var var_ind_relat_semanal_producao = scAjaxGetFieldSelect(nomeCampo_ind_relat_semanal_producao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao(var_ind_relat_semanal_producao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao

  function do_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_relat_semanal_producao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_relat_semanal_producao_cb

  // ---------- Validate dt_maxima_producao
  function do_ajax_form_itens_proc_compra_validate_dt_maxima_producao()
  {
    var nomeCampo_dt_maxima_producao = "dt_maxima_producao";
    var var_dt_maxima_producao = scAjaxGetFieldText(nomeCampo_dt_maxima_producao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_maxima_producao(var_dt_maxima_producao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_maxima_producao_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_maxima_producao

  function do_ajax_form_itens_proc_compra_validate_dt_maxima_producao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_maxima_producao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_maxima_producao_cb

  // ---------- Validate dt_termino_producao
  function do_ajax_form_itens_proc_compra_validate_dt_termino_producao()
  {
    var nomeCampo_dt_termino_producao = "dt_termino_producao";
    var var_dt_termino_producao = scAjaxGetFieldText(nomeCampo_dt_termino_producao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_termino_producao(var_dt_termino_producao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_termino_producao_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_termino_producao

  function do_ajax_form_itens_proc_compra_validate_dt_termino_producao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_termino_producao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_termino_producao_cb

  // ---------- Validate dt_prev_termino_producao
  function do_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao()
  {
    var nomeCampo_dt_prev_termino_producao = "dt_prev_termino_producao";
    var var_dt_prev_termino_producao = scAjaxGetFieldText(nomeCampo_dt_prev_termino_producao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao(var_dt_prev_termino_producao, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao

  function do_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_prev_termino_producao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_prev_termino_producao_cb

  // ---------- Validate ind_distr_custo
  function do_ajax_form_itens_proc_compra_validate_ind_distr_custo()
  {
    var nomeCampo_ind_distr_custo = "ind_distr_custo";
    var var_ind_distr_custo = scAjaxGetFieldSelect(nomeCampo_ind_distr_custo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_ind_distr_custo(var_ind_distr_custo, var_script_case_init, do_ajax_form_itens_proc_compra_validate_ind_distr_custo_cb);
  } // do_ajax_form_itens_proc_compra_validate_ind_distr_custo

  function do_ajax_form_itens_proc_compra_validate_ind_distr_custo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ind_distr_custo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_ind_distr_custo_cb

  // ---------- Validate vl_negociado
  function do_ajax_form_itens_proc_compra_validate_vl_negociado()
  {
    var nomeCampo_vl_negociado = "vl_negociado";
    var var_vl_negociado = scAjaxGetFieldText(nomeCampo_vl_negociado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_vl_negociado(var_vl_negociado, var_script_case_init, do_ajax_form_itens_proc_compra_validate_vl_negociado_cb);
  } // do_ajax_form_itens_proc_compra_validate_vl_negociado

  function do_ajax_form_itens_proc_compra_validate_vl_negociado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "vl_negociado";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_vl_negociado_cb

  // ---------- Validate dt_it_certif
  function do_ajax_form_itens_proc_compra_validate_dt_it_certif()
  {
    var nomeCampo_dt_it_certif = "dt_it_certif";
    var var_dt_it_certif = scAjaxGetFieldText(nomeCampo_dt_it_certif);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_itens_proc_compra_validate_dt_it_certif(var_dt_it_certif, var_script_case_init, do_ajax_form_itens_proc_compra_validate_dt_it_certif_cb);
  } // do_ajax_form_itens_proc_compra_validate_dt_it_certif

  function do_ajax_form_itens_proc_compra_validate_dt_it_certif_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dt_it_certif";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_itens_proc_compra_validate_dt_it_certif_cb

  // ---------- Event onblur codigo_erp
  function do_ajax_form_itens_proc_compra_event_codigo_erp_onblur()
  {
    var var_codigo_erp = scAjaxGetFieldText("codigo_erp");
    var var_desc_item = scAjaxGetFieldHidden("desc_item");
    var var_descricao = scAjaxGetFieldText("descricao");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_codigo_erp_onblur(var_codigo_erp, var_desc_item, var_descricao, var_script_case_init, do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_codigo_erp_onblur

  function do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "codigo_erp";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb
  function do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_codigo_erp_onblur_cb_after_alert

  // ---------- Event onblur dt_real_aprov_so_ld
  function do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur()
  {
    var var_dt_real_aprov_so_ld = scAjaxGetFieldText("dt_real_aprov_so_ld");
    var var_qt_dias_producao = scAjaxGetFieldText("qt_dias_producao");
    var var_dt_maxima_producao = scAjaxGetFieldText("dt_maxima_producao");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur(var_dt_real_aprov_so_ld, var_qt_dias_producao, var_dt_maxima_producao, var_script_case_init, do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur

  function do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "dt_real_aprov_so_ld";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb
  function do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_dt_real_aprov_so_ld_onblur_cb_after_alert

  // ---------- Event onblur dt_real_envio_desenhos
  function do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur()
  {
    var var_dt_real_envio_desenhos = scAjaxGetFieldText("dt_real_envio_desenhos");
    var var_qt_dias_calc_so_ld = scAjaxGetFieldText("qt_dias_calc_so_ld");
    var var_dt_prev_recbto_so_ld = scAjaxGetFieldText("dt_prev_recbto_so_ld");
    var var_dt_prev_envio_desenhos = scAjaxGetFieldText("dt_prev_envio_desenhos");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur(var_dt_real_envio_desenhos, var_qt_dias_calc_so_ld, var_dt_prev_recbto_so_ld, var_dt_prev_envio_desenhos, var_script_case_init, do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur

  function do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "dt_real_envio_desenhos";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb
  function do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_dt_real_envio_desenhos_onblur_cb_after_alert

  // ---------- Event onblur largura
  function do_ajax_form_itens_proc_compra_event_largura_onblur()
  {
    var var_calc_gm = scAjaxGetFieldText("calc_gm");
    var var_peso = scAjaxGetFieldText("peso");
    var var_largura = scAjaxGetFieldText("largura");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_largura_onblur(var_calc_gm, var_peso, var_largura, var_script_case_init, do_ajax_form_itens_proc_compra_event_largura_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_largura_onblur

  function do_ajax_form_itens_proc_compra_event_largura_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "largura";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_largura_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_largura_onblur_cb
  function do_ajax_form_itens_proc_compra_event_largura_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_largura_onblur_cb_after_alert

  // ---------- Event onblur qt_dias_calc_so_ld
  function do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur()
  {
    var var_dt_real_envio_desenhos = scAjaxGetFieldText("dt_real_envio_desenhos");
    var var_qt_dias_calc_so_ld = scAjaxGetFieldText("qt_dias_calc_so_ld");
    var var_dt_prev_recbto_so_ld = scAjaxGetFieldText("dt_prev_recbto_so_ld");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur(var_dt_real_envio_desenhos, var_qt_dias_calc_so_ld, var_dt_prev_recbto_so_ld, var_script_case_init, do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur

  function do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "qt_dias_calc_so_ld";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb
  function do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_qt_dias_calc_so_ld_onblur_cb_after_alert

  // ---------- Event onblur qt_dias_producao
  function do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur()
  {
    var var_dt_real_aprov_so_ld = scAjaxGetFieldText("dt_real_aprov_so_ld");
    var var_qt_dias_producao = scAjaxGetFieldText("qt_dias_producao");
    var var_dt_maxima_producao = scAjaxGetFieldText("dt_maxima_producao");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur(var_dt_real_aprov_so_ld, var_qt_dias_producao, var_dt_maxima_producao, var_script_case_init, do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur

  function do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "qt_dias_producao";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb
  function do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_qt_dias_producao_onblur_cb_after_alert

  // ---------- Event onblur vl_custo_dolar
  function do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur()
  {
    var var_vl_custo_dolar = scAjaxGetFieldText("vl_custo_dolar");
    var var_vl_base_tributacao = scAjaxGetFieldText("vl_base_tributacao");
    var var_vl_negociado = scAjaxGetFieldText("vl_negociado");
    var var_ind_distr_custo = scAjaxGetFieldSelect("ind_distr_custo");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur(var_vl_custo_dolar, var_vl_base_tributacao, var_vl_negociado, var_ind_distr_custo, var_script_case_init, do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur

  function do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "vl_custo_dolar";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb
  function do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_vl_custo_dolar_onblur_cb_after_alert

  // ---------- Event onblur vl_negociado
  function do_ajax_form_itens_proc_compra_event_vl_negociado_onblur()
  {
    var var_vl_negociado = scAjaxGetFieldText("vl_negociado");
    var var_vl_custo_dolar = scAjaxGetFieldText("vl_custo_dolar");
    var var_ind_distr_custo = scAjaxGetFieldSelect("ind_distr_custo");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_itens_proc_compra_event_vl_negociado_onblur(var_vl_negociado, var_vl_custo_dolar, var_ind_distr_custo, var_script_case_init, do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb);
  } // do_ajax_form_itens_proc_compra_event_vl_negociado_onblur

  function do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "vl_negociado";
    scAjaxUpdateFieldErrors(sFieldValid, "onblur");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb
  function do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_itens_proc_compra_event_vl_negociado_onblur_cb_after_alert
function scAjaxShowErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxShowErrorDisplay

function scAjaxHideErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxHideErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxHideErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxHideErrorDisplay

function scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg) {
        params = {type: 'error'};
        params['title'] = '<?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?>';
        scJs_alert_sweetalert(sErrorMsg, function() { scAjaxHideErrorDisplay(sErrorId, sErrorMsg); }, scJs_sweetalert_params(params));
} // scAjaxShowErrorDisplay_toast

function scAjaxHideErrorDisplay_toast(sErrorId, bForce) {
        if (document.getElementById("id_error_display_" + sErrorId + "_frame")) {
                if (null == bForce) {
                        bForce = true;
                }
                if (bForce) {
                        var $oField = $('#id_sc_field_' + sErrorId);
                        if (0 < $oField.length) {
                                $oField.removeClass(sc_css_status);
                        }
                }
        }
} // scAjaxHideErrorDisplay_toast

function scAjaxShowMessage(messageType) {
        scAjaxShowMessage_toast(true, messageType);
} // scAjaxShowMessage_toast

function scAjaxHideMessage() {
} // scAjaxHideMessage_toast

function scAjaxShowMessage_toast(isToast, messageType) {
        if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"]) {
                return;
        }

        if (oResp["msgDisplay"]["toast"] || isToast) {
                _scAjaxShowMessageToast({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, toastPos: "", type: messageType});
        }
        else {
                scJs_alert(oResp["msgDisplay"]["msgText"], scForm_cancel, {});
        }
} // scAjaxShowMessage_toast

function _scAjaxShowMessageToast(params) {
        var sweetAlertParams = {toast: true, showConfirmButton: false};

        if ("" != params["type"]) {
                sweetAlertParams["type"] = params["type"];
        }

        if ("" != params["title"]) {
                sweetAlertParams["title"] = scAjaxSpecCharParser(params["title"]);
        }

        if ("" != params["toastPos"]) {
                sweetAlertParams["position"] = params["toastPos"];
        }

        if (null == sweetAlertParams["position"]) {
                sweetAlertParams["position"] = "top-end";
        }

        if (null == sweetAlertParams["timer"]) {
                sweetAlertParams["timer"] = 3000;
        }

        scJs_alert_sweetalert(scAjaxSpecCharParser(params["message"]), scForm_cancel, scJs_sweetalert_params(sweetAlertParams));
} // _scAjaxShowMessageToast

function _scAjaxShowMessage(params) {
        if (params["isToast"]) {
                _scAjaxShowMessageToast(params);
        }
        else {
                if ("" != params["redirUrl"] && "" != params["redirTarget"]) {
            document.form_ajax_redir_2.action = params["redirUrl"];
            document.form_ajax_redir_2.target = params["redirTarget"];
            document.form_ajax_redir_2.nmgp_parms.value = params["redirParams"];
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
                        callbackOk = function() { document.form_ajax_redir_2.submit(); };
                }
                else if ("" != params["redirUrl"] && "" == params["redirTarget"]) {
            document.form_ajax_redir_1.action = params["redirUrl"];
            document.form_ajax_redir_1.nmgp_parms.value = params["redirParams"];
                        callbackOk = function() { document.form_ajax_redir_1.submit(); };
                }
                else {
                        callbackOk = scForm_cancel;
                }

                var alertParams = {title: params["title"]};
                if (0 < params["width"]) {
                        alertParams["width"] = params["width"];
                }
                if (0 < params["timeout"]) {
                        alertParams["timer"] = params["timeout"] * 1000;
                }
                if (!params["showButton"]) {
                        alertParams["showConfirmButton"] = false;
                }
                if ("" != params["buttonLabel"]) {
                        alertParams["confirmButtonText"] = params["buttonLabel"];
                }
                if ("" != params["type"]) {
                        alertParams["type"] = params["type"];
                }

                scJs_alert_sweetalert(params["message"], callbackOk, scJs_sweetalert_params(alertParams));
        }
} // _scAjaxShowMessage

<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
        $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
        $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
        $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
        $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
        $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
        $cancelButtonFAPos = 'text_right';
}
?>
function scJs_alert(message, callbackOk, params) {
    message = message.replace(/<!--SC_NL-->/gi, "<br />");
        scJs_alert_sweetalert(message, callbackOk, scJs_sweetalert_params(params));
} // scJs_alert

function scJs_confirm(message, callbackOk, callbackCancel) {
        scJs_confirm_sweetalert(message, callbackOk, callbackCancel);
} // scJs_confirm

function scJs_alert_sweetalert(message, callbackOk, params) {
    var sweetAlertConfig;

    if (Swal.isVisible()) {
        return;
    }

    if (null == params) {
        params = {};
    }

    params['html'] = message;

    sweetAlertConfig = params;

    Swal.fire(sweetAlertConfig).then(function (result) {
        if (result.value) {
            if (typeof callbackOk == "function") {
                callbackOk();
            }
        } else if (result.dismiss == Swal.DismissReason.timer || result.dismiss == Swal.DismissReason.close) {
            Swal.close();
            $(".swal2-container.swal2-shown").remove();
        } else {
            console.log(result.dismiss);
        }
    });
} // scJs_alert_sweetalert

function scJs_confirm_sweetalert(message, callbackOk, callbackCancel) {
        var sweetAlertConfig, params = {};

        params['html'] = message;
        params['type'] = 'question';
        params['showCancelButton'] = true;

        sweetAlertConfig = scJs_sweetalert_params(params);

        Swal.fire(sweetAlertConfig).then(function (result) {
                if (result.value) {
                        callbackOk();
                }
                else if (result.dismiss === Swal.DismissReason.backdrop || result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.esc) {
                        callbackCancel();
                }
        });
} // scJs_confirm_sweetalert

function scJs_sweetalert_params(params) {
        var parName, confirmText, confirmFA, confirmPos, cancelText, cancelFA, cancelPos, sweetAlertConfig;

        sweetAlertConfig = {
                customClass: {
                        popup: 'scSweetAlertPopup',
                        header: 'scSweetAlertHeader',
                        content: 'scSweetAlertMessage',
                        confirmButton: '<?php echo $confirmButtonClass; ?>',
                        cancelButton: '<?php echo $cancelButtonClass; ?>'
                }
        };

        confirmText = '<?php echo isset($this->arr_buttons['bsweetalert_ok']['value']) ? $this->arr_buttons['bsweetalert_ok']['value'] : $this->Ini->Nm_lang['lang_btns_cfrm'] ?>';
        confirmFA = '<?php echo $confirmButtonFA ?>';
        confirmPos = '<?php echo $confirmButtonFAPos ?>';
        cancelText = '<?php echo isset($this->arr_buttons['bsweetalert_cancel']['value']) ? $this->arr_buttons['bsweetalert_cancel']['value'] : $this->Ini->Nm_lang['lang_btns_cncl'] ?>';
        cancelFA = '<?php echo $cancelButtonFA ?>';
        cancelPos = '<?php echo $cancelButtonFAPos ?>';

        for (parName in params) {
                if ('confirmButtonText' == parName) {
                        confirmText = params[parName];
                }
                else if ('confirmButtonFA' == parName) {
                        confirmFA = params[parName];
                }
                else if ('confirmButtonFAPos' == parName) {
                        confirmPos = params[parName];
                }
                else if ('cancelButtonText' == parName) {
                        cancelText = params[parName];
                }
                else if ('cancelButtonFA' == parName) {
                        cancelFA = params[parName];
                }
                else if ('cancelButtonFAPos' == parName) {
                        cancelPos = params[parName];
                }
                else {
                        sweetAlertConfig[parName] = params[parName];
                }
        }

        if ('' != confirmFA) {
                if ('text_right' == confirmPos) {
                        confirmText = '<i class="fas ' + confirmFA + '"></i> ' + confirmText;
                }
                else {
                        confirmText += ' <i class="fas ' + confirmFA + '"></i>';
                }
        }
        if ('' != cancelFA) {
                if ('text_right' == cancelPos) {
                        cancelText = '<i class="fas ' + cancelFA + '"></i> ' + cancelText;
                }
                else {
                        cancelText += ' <i class="fas ' + cancelFA + '"></i>';
                }
        }

        sweetAlertConfig['confirmButtonText'] = confirmText;
        sweetAlertConfig['cancelButtonText'] = cancelText;

        if (sweetAlertConfig['toast']) {
                sweetAlertConfig['showConfirmButton'] = false;
                sweetAlertConfig['showCancelButton'] = false;
                sweetAlertConfig['customClass']['popup'] = 'scToastPopup';
                sweetAlertConfig['customClass']['header'] = 'scToastHeader';
                sweetAlertConfig['customClass']['content'] = 'scToastMessage';
                if (null == sweetAlertConfig['timer']) {
                        sweetAlertConfig['timer'] = 3000;
                }
                if (null == sweetAlertConfig["position"]) {
                        sweetAlertConfig["position"] = "top-end";
                }
        }

        return sweetAlertConfig;
} // scJs_sweetalert_params

  // ---------- Form
  function do_ajax_form_itens_proc_compra_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_itens_proc_compra_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_proc_compra_id = scAjaxGetFieldText("proc_compra_id");
    var var_item_proc_compra_id = scAjaxGetFieldHidden("item_proc_compra_id");
    var var_descricao = scAjaxGetFieldText("descricao");
    var var_codigo_erp = scAjaxGetFieldText("codigo_erp");
    var var_desc_item = scAjaxGetFieldHidden("desc_item");
    var var_vl_custo_dolar = scAjaxGetFieldText("vl_custo_dolar");
    var var_vl_base_tributacao = scAjaxGetFieldText("vl_base_tributacao");
    var var_unid_medida = scAjaxGetFieldSelect("unid_medida");
    var var_qt_comprada = scAjaxGetFieldText("qt_comprada");
    var var_vl_cubagem = scAjaxGetFieldText("vl_cubagem");
    var var_composicao = scAjaxGetFieldText("composicao");
    var var_shrinkage = scAjaxGetFieldText("shrinkage");
    var var_peso = scAjaxGetFieldText("peso");
    var var_largura = scAjaxGetFieldText("largura");
    var var_calc_gm = scAjaxGetFieldText("calc_gm");
    var var_rolo = scAjaxGetFieldText("rolo");
    var var_coloracao_id = scAjaxGetFieldSelect("coloracao_id");
    var var_item_estacao = scAjaxGetFieldSelect("item_estacao");
    var var_formato_amostra_id = scAjaxGetFieldSelect("formato_amostra_id");
    var var_log_mostruario = scAjaxGetFieldSelect("log_mostruario");
    var var_ind_laudo_antes_embarque = scAjaxGetFieldSelect("ind_laudo_antes_embarque");
    var var_ind_qualid_emb = scAjaxGetFieldSelect("ind_qualid_emb");
    var var_ind_prod_conf_pi = scAjaxGetFieldSelect("ind_prod_conf_pi");
    var var_ind_rec_amostra_antes_emb = scAjaxGetFieldSelect("ind_rec_amostra_antes_emb");
    var var_ind_qt_conf_proforma = scAjaxGetFieldSelect("ind_qt_conf_proforma");
    var var_ind_tamanho_pecas_correto = scAjaxGetFieldSelect("ind_tamanho_pecas_correto");
    var var_dt_prev_envio_desenhos = scAjaxGetFieldText("dt_prev_envio_desenhos");
    var var_dt_real_envio_desenhos = scAjaxGetFieldText("dt_real_envio_desenhos");
    var var_dt_recbto_laudo = scAjaxGetFieldText("dt_recbto_laudo");
    var var_dt_recbto_embalagem = scAjaxGetFieldText("dt_recbto_embalagem");
    var var_dt_cheg_amostras_emb = scAjaxGetFieldText("dt_cheg_amostras_emb");
    var var_dt_mostruario = scAjaxGetFieldText("dt_mostruario");
    var var_observacao = scAjaxGetFieldText("observacao");
    var var_log_aprov_so_ld = scAjaxGetFieldSelect("log_aprov_so_ld");
    var var_dt_prev_recbto_so_ld = scAjaxGetFieldText("dt_prev_recbto_so_ld");
    var var_dt_prev_aprov_so_ld = scAjaxGetFieldText("dt_prev_aprov_so_ld");
    var var_dt_real_aprov_so_ld = scAjaxGetFieldText("dt_real_aprov_so_ld");
    var var_qt_dias_calc_so_ld = scAjaxGetFieldText("qt_dias_calc_so_ld");
    var var_dt_real_recbto_so_ld = scAjaxGetFieldText("dt_real_recbto_so_ld");
    var var_ind_producao_no_prazo = scAjaxGetFieldSelect("ind_producao_no_prazo");
    var var_qt_dias_producao = scAjaxGetFieldText("qt_dias_producao");
    var var_ind_relat_semanal_producao = scAjaxGetFieldSelect("ind_relat_semanal_producao");
    var var_dt_maxima_producao = scAjaxGetFieldText("dt_maxima_producao");
    var var_dt_termino_producao = scAjaxGetFieldText("dt_termino_producao");
    var var_dt_prev_termino_producao = scAjaxGetFieldText("dt_prev_termino_producao");
    var var_ind_distr_custo = scAjaxGetFieldSelect("ind_distr_custo");
    var var_vl_negociado = scAjaxGetFieldText("vl_negociado");
    var var_dt_it_certif = scAjaxGetFieldText("dt_it_certif");
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_itens_proc_compra_submit_form(var_proc_compra_id, var_item_proc_compra_id, var_descricao, var_codigo_erp, var_desc_item, var_vl_custo_dolar, var_vl_base_tributacao, var_unid_medida, var_qt_comprada, var_vl_cubagem, var_composicao, var_shrinkage, var_peso, var_largura, var_calc_gm, var_rolo, var_coloracao_id, var_item_estacao, var_formato_amostra_id, var_log_mostruario, var_ind_laudo_antes_embarque, var_ind_qualid_emb, var_ind_prod_conf_pi, var_ind_rec_amostra_antes_emb, var_ind_qt_conf_proforma, var_ind_tamanho_pecas_correto, var_dt_prev_envio_desenhos, var_dt_real_envio_desenhos, var_dt_recbto_laudo, var_dt_recbto_embalagem, var_dt_cheg_amostras_emb, var_dt_mostruario, var_observacao, var_log_aprov_so_ld, var_dt_prev_recbto_so_ld, var_dt_prev_aprov_so_ld, var_dt_real_aprov_so_ld, var_qt_dias_calc_so_ld, var_dt_real_recbto_so_ld, var_ind_producao_no_prazo, var_qt_dias_producao, var_ind_relat_semanal_producao, var_dt_maxima_producao, var_dt_termino_producao, var_dt_prev_termino_producao, var_ind_distr_custo, var_vl_negociado, var_dt_it_certif, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, do_ajax_form_itens_proc_compra_submit_form_cb);
  } // do_ajax_form_itens_proc_compra_submit_form

  function do_ajax_form_itens_proc_compra_submit_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    scAjaxUpdateErrors("valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors || "menu_link" == document.F1.nmgp_opcao.value)
    {
      $('.sc-js-ui-statusimg').css('display', 'none');
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxError_markList();
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (scAjaxIsOk())
    {
      scResetFormChanges();
      scAjaxShowMessage("success");
      scAjaxHideErrorDisplay("table");
      scAjaxHideErrorDisplay("proc_compra_id");
      scAjaxHideErrorDisplay("item_proc_compra_id");
      scAjaxHideErrorDisplay("descricao");
      scAjaxHideErrorDisplay("codigo_erp");
      scAjaxHideErrorDisplay("desc_item");
      scAjaxHideErrorDisplay("vl_custo_dolar");
      scAjaxHideErrorDisplay("vl_base_tributacao");
      scAjaxHideErrorDisplay("unid_medida");
      scAjaxHideErrorDisplay("qt_comprada");
      scAjaxHideErrorDisplay("vl_cubagem");
      scAjaxHideErrorDisplay("composicao");
      scAjaxHideErrorDisplay("shrinkage");
      scAjaxHideErrorDisplay("peso");
      scAjaxHideErrorDisplay("largura");
      scAjaxHideErrorDisplay("calc_gm");
      scAjaxHideErrorDisplay("rolo");
      scAjaxHideErrorDisplay("coloracao_id");
      scAjaxHideErrorDisplay("item_estacao");
      scAjaxHideErrorDisplay("formato_amostra_id");
      scAjaxHideErrorDisplay("log_mostruario");
      scAjaxHideErrorDisplay("ind_laudo_antes_embarque");
      scAjaxHideErrorDisplay("ind_qualid_emb");
      scAjaxHideErrorDisplay("ind_prod_conf_pi");
      scAjaxHideErrorDisplay("ind_rec_amostra_antes_emb");
      scAjaxHideErrorDisplay("ind_qt_conf_proforma");
      scAjaxHideErrorDisplay("ind_tamanho_pecas_correto");
      scAjaxHideErrorDisplay("dt_prev_envio_desenhos");
      scAjaxHideErrorDisplay("dt_real_envio_desenhos");
      scAjaxHideErrorDisplay("dt_recbto_laudo");
      scAjaxHideErrorDisplay("dt_recbto_embalagem");
      scAjaxHideErrorDisplay("dt_cheg_amostras_emb");
      scAjaxHideErrorDisplay("dt_mostruario");
      scAjaxHideErrorDisplay("envios_amostra");
      scAjaxHideErrorDisplay("observacao");
      scAjaxHideErrorDisplay("log_aprov_so_ld");
      scAjaxHideErrorDisplay("dt_prev_recbto_so_ld");
      scAjaxHideErrorDisplay("dt_prev_aprov_so_ld");
      scAjaxHideErrorDisplay("dt_real_aprov_so_ld");
      scAjaxHideErrorDisplay("qt_dias_calc_so_ld");
      scAjaxHideErrorDisplay("dt_real_recbto_so_ld");
      scAjaxHideErrorDisplay("ind_producao_no_prazo");
      scAjaxHideErrorDisplay("qt_dias_producao");
      scAjaxHideErrorDisplay("ind_relat_semanal_producao");
      scAjaxHideErrorDisplay("dt_maxima_producao");
      scAjaxHideErrorDisplay("dt_termino_producao");
      scAjaxHideErrorDisplay("dt_prev_termino_producao");
      scAjaxHideErrorDisplay("ind_distr_custo");
      scAjaxHideErrorDisplay("vl_negociado");
      scAjaxHideErrorDisplay("dt_it_certif");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['parent_widget']; ?>']");
      if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.nm_gp_move) {
        dbParentFrame[0].contentWindow.nm_gp_move("igual");
      }
<?php
}
?>
    }
    Nm_Proc_Atualiz = false;
    if (!scAjaxHasError())
    {
      scAjaxSetFields(false);
      scAjaxSetVariables();
      scAjaxSetMaster();
      if (scInlineFormSend())
      {
        self.parent.tb_remove();
        return;
      }
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_form_itens_proc_compra_submit_form_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_submit_form_cb
  function do_ajax_form_itens_proc_compra_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_itens_proc_compra_submit_form_cb_after_alert

  var scStatusDetail = {};
  scStatusDetail["grid_PUB_envios_amostras_repres"] = "off";

  function do_ajax_form_itens_proc_compra_navigate_form()
  {
    perform_ajax_form_itens_proc_compra_navigate_form();
  }

  function perform_ajax_form_itens_proc_compra_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("proc_compra_id");
    scAjaxHideErrorDisplay("item_proc_compra_id");
    scAjaxHideErrorDisplay("descricao");
    scAjaxHideErrorDisplay("codigo_erp");
    scAjaxHideErrorDisplay("desc_item");
    scAjaxHideErrorDisplay("vl_custo_dolar");
    scAjaxHideErrorDisplay("vl_base_tributacao");
    scAjaxHideErrorDisplay("unid_medida");
    scAjaxHideErrorDisplay("qt_comprada");
    scAjaxHideErrorDisplay("vl_cubagem");
    scAjaxHideErrorDisplay("composicao");
    scAjaxHideErrorDisplay("shrinkage");
    scAjaxHideErrorDisplay("peso");
    scAjaxHideErrorDisplay("largura");
    scAjaxHideErrorDisplay("calc_gm");
    scAjaxHideErrorDisplay("rolo");
    scAjaxHideErrorDisplay("coloracao_id");
    scAjaxHideErrorDisplay("item_estacao");
    scAjaxHideErrorDisplay("formato_amostra_id");
    scAjaxHideErrorDisplay("log_mostruario");
    scAjaxHideErrorDisplay("ind_laudo_antes_embarque");
    scAjaxHideErrorDisplay("ind_qualid_emb");
    scAjaxHideErrorDisplay("ind_prod_conf_pi");
    scAjaxHideErrorDisplay("ind_rec_amostra_antes_emb");
    scAjaxHideErrorDisplay("ind_qt_conf_proforma");
    scAjaxHideErrorDisplay("ind_tamanho_pecas_correto");
    scAjaxHideErrorDisplay("dt_prev_envio_desenhos");
    scAjaxHideErrorDisplay("dt_real_envio_desenhos");
    scAjaxHideErrorDisplay("dt_recbto_laudo");
    scAjaxHideErrorDisplay("dt_recbto_embalagem");
    scAjaxHideErrorDisplay("dt_cheg_amostras_emb");
    scAjaxHideErrorDisplay("dt_mostruario");
    scAjaxHideErrorDisplay("envios_amostra");
    scAjaxHideErrorDisplay("observacao");
    scAjaxHideErrorDisplay("log_aprov_so_ld");
    scAjaxHideErrorDisplay("dt_prev_recbto_so_ld");
    scAjaxHideErrorDisplay("dt_prev_aprov_so_ld");
    scAjaxHideErrorDisplay("dt_real_aprov_so_ld");
    scAjaxHideErrorDisplay("qt_dias_calc_so_ld");
    scAjaxHideErrorDisplay("dt_real_recbto_so_ld");
    scAjaxHideErrorDisplay("ind_producao_no_prazo");
    scAjaxHideErrorDisplay("qt_dias_producao");
    scAjaxHideErrorDisplay("ind_relat_semanal_producao");
    scAjaxHideErrorDisplay("dt_maxima_producao");
    scAjaxHideErrorDisplay("dt_termino_producao");
    scAjaxHideErrorDisplay("dt_prev_termino_producao");
    scAjaxHideErrorDisplay("ind_distr_custo");
    scAjaxHideErrorDisplay("vl_negociado");
    scAjaxHideErrorDisplay("dt_it_certif");
    var var_item_proc_compra_id = document.F2.item_proc_compra_id.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    scStatusDetail["grid_PUB_envios_amostras_repres"] = "on";
    x_ajax_form_itens_proc_compra_navigate_form(var_item_proc_compra_id, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_itens_proc_compra_navigate_form_cb);
  } // do_ajax_form_itens_proc_compra_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_itens_proc_compra']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_itens_proc_compra_navigate_form_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    scAjaxRedir();
    if (oResp['empty_filter'] && oResp['empty_filter'] == "ok")
    {
        document.F5.nmgp_opcao.value = "inicio";
        document.F5.nmgp_parms.value = "";
        document.F5.submit();
    }
    if ("ERROR" == oResp.result)
    {
        scAjaxShowErrorDisplay("table", oResp.errList[0].msgText);
        scAjaxProcOff();
        return;
    }
    else if (oResp["navSummary"] && oResp["navSummary"].reg_tot == 0)
    {
       scAjax_displayEmptyForm();
    }
    scAjaxClearErrors();
    scResetFormChanges();
    sc_mupload_ok = true;
    scAjaxSetFields(false);
    scAjaxSetVariables();
    scAjaxSetSummaryLine();
    document.F2.item_proc_compra_id.value = scAjaxGetKeyValue("item_proc_compra_id");
    scAjaxSetSummary();
    scAjaxSetNavpage();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("t");
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    if (scMasterDetailIframe && scMasterDetailIframe["nmsc_iframe_liga_grid_PUB_envios_amostras_repres"] && "nmsc_iframe_liga_grid_PUB_envios_amostras_repres" != scMasterDetailIframe["nmsc_iframe_liga_grid_PUB_envios_amostras_repres"]) {
        scMoveMasterDetail(scMasterDetailIframe["nmsc_iframe_liga_grid_PUB_envios_amostras_repres"]);
    }
    else {
        if (oResp["navSummary"].reg_tot != 0) {
            document.getElementById('nmsc_iframe_liga_grid_PUB_envios_amostras_repres').contentWindow.nm_move('apl_detalhe', true, '400');
        }
    }
    scAjaxSetBtnVars();
    sc_change_tabs(true, 'hidden_bloco_0', 'id_tabs_0_0');
    sc_change_tabs(false, 'hidden_bloco_1', 'id_tabs_0_1');
    sc_change_tabs(false, 'hidden_bloco_2', 'id_tabs_0_2');
    sc_change_tabs(false, 'hidden_bloco_3', 'id_tabs_0_3');
    sc_change_tabs(false, 'hidden_bloco_4', 'id_tabs_0_4');
    sc_change_tabs(false, 'hidden_bloco_5', 'id_tabs_0_5');
    sc_change_tabs(false, 'hidden_bloco_6', 'id_tabs_0_6');
    sc_change_tabs(false, 'hidden_bloco_7', 'id_tabs_0_7');
    sc_change_tabs(false, 'hidden_bloco_8', 'id_tabs_0_8');
    sc_change_tabs(false, 'hidden_bloco_9', 'id_tabs_0_9');
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_itens_proc_compra_navigate_form_cb_after_alert);
  } // do_ajax_form_itens_proc_compra_navigate_form_cb
  function do_ajax_form_itens_proc_compra_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scFocusField('descricao');

    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_itens_proc_compra_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
    scAjaxProcOff();
  } // do_ajax_form_itens_proc_compra_navigate_form_cb_after_alert

  function sc_hide_form_itens_proc_compra_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_itens_proc_compra_form


  function do_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id()
  {
    var var_coloracao_id = scAjaxGetFieldSelect("coloracao_id");
    var var_script_case_init = document.F1.script_case_init.value;
    var nmgp_refresh_fields = "coloracao_id";
    x_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id(var_coloracao_id, nmgp_refresh_fields, var_script_case_init, do_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id_cb);
  } // do_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id

  function do_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    scAjaxSetFields(false);
    scAjaxSetVariables();
  } // do_ajax_form_itens_proc_compra_lkpedt_refresh_coloracao_id_cb

  function do_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id()
  {
    var var_formato_amostra_id = scAjaxGetFieldSelect("formato_amostra_id");
    var var_script_case_init = document.F1.script_case_init.value;
    var nmgp_refresh_fields = "formato_amostra_id";
    x_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id(var_formato_amostra_id, nmgp_refresh_fields, var_script_case_init, do_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id_cb);
  } // do_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id

  function do_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    scAjaxSetFields(false);
    scAjaxSetVariables();
  } // do_ajax_form_itens_proc_compra_lkpedt_refresh_formato_amostra_id_cb

  function scAjaxDetailStatus(sDetailApp)
  {
    if (scStatusDetail[sDetailApp])
    {
      scStatusDetail[sDetailApp] = "off";
      if (document.getElementById("nmsc_iframe_liga_" + sDetailApp)) {
        document.getElementById("nmsc_iframe_liga_" + sDetailApp).style.display = "";
      }
    }
    if (scAjaxDetailProc())
    {
      scAjaxProcOff();
    }
  } // scAjaxDetailStatus

  function scAjaxDetailHeight(sDetailApp, iDetailHeight)
  {
    $("#nmsc_iframe_liga_" + sDetailApp).css("height", iDetailHeight + "px");
  } // scAjaxDetailHeight

  function scAjaxDetailProc()
  {
    if ("off" == scStatusDetail["grid_PUB_envios_amostras_repres"])
    {
      return true;
    }
    return false;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "proc_compra_id";
  ajax_field_list[1] = "item_proc_compra_id";
  ajax_field_list[2] = "descricao";
  ajax_field_list[3] = "codigo_erp";
  ajax_field_list[4] = "desc_item";
  ajax_field_list[5] = "vl_custo_dolar";
  ajax_field_list[6] = "vl_base_tributacao";
  ajax_field_list[7] = "unid_medida";
  ajax_field_list[8] = "qt_comprada";
  ajax_field_list[9] = "vl_cubagem";
  ajax_field_list[10] = "composicao";
  ajax_field_list[11] = "shrinkage";
  ajax_field_list[12] = "peso";
  ajax_field_list[13] = "largura";
  ajax_field_list[14] = "calc_gm";
  ajax_field_list[15] = "rolo";
  ajax_field_list[16] = "coloracao_id";
  ajax_field_list[17] = "item_estacao";
  ajax_field_list[18] = "formato_amostra_id";
  ajax_field_list[19] = "log_mostruario";
  ajax_field_list[20] = "ind_laudo_antes_embarque";
  ajax_field_list[21] = "ind_qualid_emb";
  ajax_field_list[22] = "ind_prod_conf_pi";
  ajax_field_list[23] = "ind_rec_amostra_antes_emb";
  ajax_field_list[24] = "ind_qt_conf_proforma";
  ajax_field_list[25] = "ind_tamanho_pecas_correto";
  ajax_field_list[26] = "dt_prev_envio_desenhos";
  ajax_field_list[27] = "dt_real_envio_desenhos";
  ajax_field_list[28] = "dt_recbto_laudo";
  ajax_field_list[29] = "dt_recbto_embalagem";
  ajax_field_list[30] = "dt_cheg_amostras_emb";
  ajax_field_list[31] = "dt_mostruario";
  ajax_field_list[32] = "envios_amostra";
  ajax_field_list[33] = "observacao";
  ajax_field_list[34] = "log_aprov_so_ld";
  ajax_field_list[35] = "dt_prev_recbto_so_ld";
  ajax_field_list[36] = "dt_prev_aprov_so_ld";
  ajax_field_list[37] = "dt_real_aprov_so_ld";
  ajax_field_list[38] = "qt_dias_calc_so_ld";
  ajax_field_list[39] = "dt_real_recbto_so_ld";
  ajax_field_list[40] = "ind_producao_no_prazo";
  ajax_field_list[41] = "qt_dias_producao";
  ajax_field_list[42] = "ind_relat_semanal_producao";
  ajax_field_list[43] = "dt_maxima_producao";
  ajax_field_list[44] = "dt_termino_producao";
  ajax_field_list[45] = "dt_prev_termino_producao";
  ajax_field_list[46] = "ind_distr_custo";
  ajax_field_list[47] = "vl_negociado";
  ajax_field_list[48] = "dt_it_certif";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";
  ajax_block_list[5] = "5";
  ajax_block_list[6] = "6";
  ajax_block_list[7] = "7";
  ajax_block_list[8] = "8";
  ajax_block_list[9] = "9";

  var ajax_error_list = {
    "proc_compra_id": {"label": "Pedido Importação", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "item_proc_compra_id": {"label": "ID Item Pedido", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "descricao": {"label": "Descrição", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "codigo_erp": {"label": "Código ERP", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "desc_item": {"label": "Descrição ERP", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "vl_custo_dolar": {"label": "Vl .Unit.Registro(Dólar)", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "vl_base_tributacao": {"label": "Vl.Unit.Base Tributação + Anti Dumping(Dólar)", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "unid_medida": {"label": "Unid.Medida", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "qt_comprada": {"label": "Qt.Comprada", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "vl_cubagem": {"label": "Vl. Cubagem", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "composicao": {"label": "Composição", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "shrinkage": {"label": "Shrinkage", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "peso": {"label": "Peso (GSM)", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "largura": {"label": "Largura (CM)", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "calc_gm": {"label": "G/M", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "rolo": {"label": "Tamanho Rolo", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "coloracao_id": {"label": "Coloração", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "item_estacao": {"label": "Estação Item/Container", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "formato_amostra_id": {"label": "Formato Amostra ", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "log_mostruario": {"label": "Controla Data Mostruário?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_laudo_antes_embarque": {"label": "Envio de Laudo Antes do Embarque?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_qualid_emb": {"label": "Recbto da  Embalagem Conforme  nossa qualidade padrão ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_prod_conf_pi": {"label": "Produção Conforme PL(Laudo)?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_rec_amostra_antes_emb": {"label": "Recbto Amostras Antes do Embarque?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_qt_conf_proforma": {"label": "Quantidade Conforme Pró-forma ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_tamanho_pecas_correto": {"label": "Tamanho de Peças De acordo com o Solicitado?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_prev_envio_desenhos": {"label": "Dt. Prev. Envio Desenhos", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_real_envio_desenhos": {"label": "Dt. Real Envio Desenhos", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_recbto_laudo": {"label": "Dt Recbto Laudo", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_recbto_embalagem": {"label": "Dt Recbto Embalagem", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_cheg_amostras_emb": {"label": "Dt. Cheg. Amostras Embarque", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_mostruario": {"label": "Dt. do Mostruário", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "envios_amostra": {"label": "Envios de Amostra", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "observacao": {"label": "Observações", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "log_aprov_so_ld": {"label": "Aprova Strike Offs e Lab Dips?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_prev_recbto_so_ld": {"label": "Dt.Prev.Recbto Strike Offs e Labs Dips", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_prev_aprov_so_ld": {"label": "Dt. Prev. Aprov. Strike Offs e Labs Dips", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_real_aprov_so_ld": {"label": "Dt. Real Aprov. Strike Offs e Labs Dips", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "qt_dias_calc_so_ld": {"label": "Qt Dias Calc So Ld", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_real_recbto_so_ld": {"label": "Dt Real Recbto So Ld", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_producao_no_prazo": {"label": "Produção no prazo esperado?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "qt_dias_producao": {"label": "Qt Dias Produção", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_relat_semanal_producao": {"label": "Envio Relat. Semanal de Produção?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_maxima_producao": {"label": "Dt. Máxima Produção", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_termino_producao": {"label": "Dt Termino Producao", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_prev_termino_producao": {"label": "Dt.Prev.Término Produção", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "ind_distr_custo": {"label": "Distr.Custo ?", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "vl_negociado": {"label": "Vl.Negociado", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "dt_it_certif": {"label": "Data Item Certificação", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5}
  };
  var ajax_error_timeout = 5;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3",
    "4": "hidden_bloco_4",
    "5": "hidden_bloco_5",
    "6": "hidden_bloco_6",
    "7": "hidden_bloco_7",
    "8": "hidden_bloco_8",
    "9": "hidden_bloco_9"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "id_tabs_0_0",
    "hidden_bloco_1": "id_tabs_0_1",
    "hidden_bloco_2": "id_tabs_0_2",
    "hidden_bloco_3": "id_tabs_0_3",
    "hidden_bloco_4": "id_tabs_0_4",
    "hidden_bloco_5": "id_tabs_0_5",
    "hidden_bloco_6": "id_tabs_0_6",
    "hidden_bloco_7": "id_tabs_0_7",
    "hidden_bloco_8": "id_tabs_0_8",
    "hidden_bloco_9": "id_tabs_0_9"
  };

  var ajax_field_mult = {
    "proc_compra_id": new Array(),
    "item_proc_compra_id": new Array(),
    "descricao": new Array(),
    "codigo_erp": new Array(),
    "desc_item": new Array(),
    "vl_custo_dolar": new Array(),
    "vl_base_tributacao": new Array(),
    "unid_medida": new Array(),
    "qt_comprada": new Array(),
    "vl_cubagem": new Array(),
    "composicao": new Array(),
    "shrinkage": new Array(),
    "peso": new Array(),
    "largura": new Array(),
    "calc_gm": new Array(),
    "rolo": new Array(),
    "coloracao_id": new Array(),
    "item_estacao": new Array(),
    "formato_amostra_id": new Array(),
    "log_mostruario": new Array(),
    "ind_laudo_antes_embarque": new Array(),
    "ind_qualid_emb": new Array(),
    "ind_prod_conf_pi": new Array(),
    "ind_rec_amostra_antes_emb": new Array(),
    "ind_qt_conf_proforma": new Array(),
    "ind_tamanho_pecas_correto": new Array(),
    "dt_prev_envio_desenhos": new Array(),
    "dt_real_envio_desenhos": new Array(),
    "dt_recbto_laudo": new Array(),
    "dt_recbto_embalagem": new Array(),
    "dt_cheg_amostras_emb": new Array(),
    "dt_mostruario": new Array(),
    "envios_amostra": new Array(),
    "observacao": new Array(),
    "log_aprov_so_ld": new Array(),
    "dt_prev_recbto_so_ld": new Array(),
    "dt_prev_aprov_so_ld": new Array(),
    "dt_real_aprov_so_ld": new Array(),
    "qt_dias_calc_so_ld": new Array(),
    "dt_real_recbto_so_ld": new Array(),
    "ind_producao_no_prazo": new Array(),
    "qt_dias_producao": new Array(),
    "ind_relat_semanal_producao": new Array(),
    "dt_maxima_producao": new Array(),
    "dt_termino_producao": new Array(),
    "dt_prev_termino_producao": new Array(),
    "ind_distr_custo": new Array(),
    "vl_negociado": new Array(),
    "dt_it_certif": new Array()
  };
  ajax_field_mult["proc_compra_id"][1] = "proc_compra_id";
  ajax_field_mult["item_proc_compra_id"][1] = "item_proc_compra_id";
  ajax_field_mult["descricao"][1] = "descricao";
  ajax_field_mult["codigo_erp"][1] = "codigo_erp";
  ajax_field_mult["desc_item"][1] = "desc_item";
  ajax_field_mult["vl_custo_dolar"][1] = "vl_custo_dolar";
  ajax_field_mult["vl_base_tributacao"][1] = "vl_base_tributacao";
  ajax_field_mult["unid_medida"][1] = "unid_medida";
  ajax_field_mult["qt_comprada"][1] = "qt_comprada";
  ajax_field_mult["vl_cubagem"][1] = "vl_cubagem";
  ajax_field_mult["composicao"][1] = "composicao";
  ajax_field_mult["shrinkage"][1] = "shrinkage";
  ajax_field_mult["peso"][1] = "peso";
  ajax_field_mult["largura"][1] = "largura";
  ajax_field_mult["calc_gm"][1] = "calc_gm";
  ajax_field_mult["rolo"][1] = "rolo";
  ajax_field_mult["coloracao_id"][1] = "coloracao_id";
  ajax_field_mult["item_estacao"][1] = "item_estacao";
  ajax_field_mult["formato_amostra_id"][1] = "formato_amostra_id";
  ajax_field_mult["log_mostruario"][1] = "log_mostruario";
  ajax_field_mult["ind_laudo_antes_embarque"][1] = "ind_laudo_antes_embarque";
  ajax_field_mult["ind_qualid_emb"][1] = "ind_qualid_emb";
  ajax_field_mult["ind_prod_conf_pi"][1] = "ind_prod_conf_pi";
  ajax_field_mult["ind_rec_amostra_antes_emb"][1] = "ind_rec_amostra_antes_emb";
  ajax_field_mult["ind_qt_conf_proforma"][1] = "ind_qt_conf_proforma";
  ajax_field_mult["ind_tamanho_pecas_correto"][1] = "ind_tamanho_pecas_correto";
  ajax_field_mult["dt_prev_envio_desenhos"][1] = "dt_prev_envio_desenhos";
  ajax_field_mult["dt_real_envio_desenhos"][1] = "dt_real_envio_desenhos";
  ajax_field_mult["dt_recbto_laudo"][1] = "dt_recbto_laudo";
  ajax_field_mult["dt_recbto_embalagem"][1] = "dt_recbto_embalagem";
  ajax_field_mult["dt_cheg_amostras_emb"][1] = "dt_cheg_amostras_emb";
  ajax_field_mult["dt_mostruario"][1] = "dt_mostruario";
  ajax_field_mult["envios_amostra"][1] = "envios_amostra";
  ajax_field_mult["observacao"][1] = "observacao";
  ajax_field_mult["log_aprov_so_ld"][1] = "log_aprov_so_ld";
  ajax_field_mult["dt_prev_recbto_so_ld"][1] = "dt_prev_recbto_so_ld";
  ajax_field_mult["dt_prev_aprov_so_ld"][1] = "dt_prev_aprov_so_ld";
  ajax_field_mult["dt_real_aprov_so_ld"][1] = "dt_real_aprov_so_ld";
  ajax_field_mult["qt_dias_calc_so_ld"][1] = "qt_dias_calc_so_ld";
  ajax_field_mult["dt_real_recbto_so_ld"][1] = "dt_real_recbto_so_ld";
  ajax_field_mult["ind_producao_no_prazo"][1] = "ind_producao_no_prazo";
  ajax_field_mult["qt_dias_producao"][1] = "qt_dias_producao";
  ajax_field_mult["ind_relat_semanal_producao"][1] = "ind_relat_semanal_producao";
  ajax_field_mult["dt_maxima_producao"][1] = "dt_maxima_producao";
  ajax_field_mult["dt_termino_producao"][1] = "dt_termino_producao";
  ajax_field_mult["dt_prev_termino_producao"][1] = "dt_prev_termino_producao";
  ajax_field_mult["ind_distr_custo"][1] = "ind_distr_custo";
  ajax_field_mult["vl_negociado"][1] = "vl_negociado";
  ajax_field_mult["dt_it_certif"][1] = "dt_it_certif";

  var ajax_field_id = {
    "proc_compra_id": new Array("hidden_field_label_proc_compra_id", "hidden_field_data_proc_compra_id"),
    "item_proc_compra_id": new Array("hidden_field_label_item_proc_compra_id", "hidden_field_data_item_proc_compra_id"),
    "descricao": new Array("hidden_field_label_descricao", "hidden_field_data_descricao"),
    "codigo_erp": new Array("hidden_field_label_codigo_erp", "hidden_field_data_codigo_erp"),
    "desc_item": new Array("hidden_field_label_desc_item", "hidden_field_data_desc_item"),
    "vl_custo_dolar": new Array("hidden_field_label_vl_custo_dolar", "hidden_field_data_vl_custo_dolar"),
    "vl_base_tributacao": new Array("hidden_field_label_vl_base_tributacao", "hidden_field_data_vl_base_tributacao"),
    "unid_medida": new Array("hidden_field_label_unid_medida", "hidden_field_data_unid_medida"),
    "qt_comprada": new Array("hidden_field_label_qt_comprada", "hidden_field_data_qt_comprada"),
    "vl_cubagem": new Array("hidden_field_label_vl_cubagem", "hidden_field_data_vl_cubagem"),
    "composicao": new Array("hidden_field_label_composicao", "hidden_field_data_composicao"),
    "shrinkage": new Array("hidden_field_label_shrinkage", "hidden_field_data_shrinkage"),
    "peso": new Array("hidden_field_label_peso", "hidden_field_data_peso"),
    "largura": new Array("hidden_field_label_largura", "hidden_field_data_largura"),
    "calc_gm": new Array("hidden_field_label_calc_gm", "hidden_field_data_calc_gm"),
    "rolo": new Array("hidden_field_label_rolo", "hidden_field_data_rolo"),
    "coloracao_id": new Array("hidden_field_label_coloracao_id", "hidden_field_data_coloracao_id"),
    "item_estacao": new Array("hidden_field_label_item_estacao", "hidden_field_data_item_estacao"),
    "formato_amostra_id": new Array("hidden_field_label_formato_amostra_id", "hidden_field_data_formato_amostra_id"),
    "log_mostruario": new Array("hidden_field_label_log_mostruario", "hidden_field_data_log_mostruario"),
    "ind_laudo_antes_embarque": new Array("hidden_field_label_ind_laudo_antes_embarque", "hidden_field_data_ind_laudo_antes_embarque"),
    "ind_qualid_emb": new Array("hidden_field_label_ind_qualid_emb", "hidden_field_data_ind_qualid_emb"),
    "ind_prod_conf_pi": new Array("hidden_field_label_ind_prod_conf_pi", "hidden_field_data_ind_prod_conf_pi"),
    "ind_rec_amostra_antes_emb": new Array("hidden_field_label_ind_rec_amostra_antes_emb", "hidden_field_data_ind_rec_amostra_antes_emb"),
    "ind_qt_conf_proforma": new Array("hidden_field_label_ind_qt_conf_proforma", "hidden_field_data_ind_qt_conf_proforma"),
    "ind_tamanho_pecas_correto": new Array("hidden_field_label_ind_tamanho_pecas_correto", "hidden_field_data_ind_tamanho_pecas_correto"),
    "dt_prev_envio_desenhos": new Array("hidden_field_label_dt_prev_envio_desenhos", "hidden_field_data_dt_prev_envio_desenhos"),
    "dt_real_envio_desenhos": new Array("hidden_field_label_dt_real_envio_desenhos", "hidden_field_data_dt_real_envio_desenhos"),
    "dt_recbto_laudo": new Array("hidden_field_label_dt_recbto_laudo", "hidden_field_data_dt_recbto_laudo"),
    "dt_recbto_embalagem": new Array("hidden_field_label_dt_recbto_embalagem", "hidden_field_data_dt_recbto_embalagem"),
    "dt_cheg_amostras_emb": new Array("hidden_field_label_dt_cheg_amostras_emb", "hidden_field_data_dt_cheg_amostras_emb"),
    "dt_mostruario": new Array("hidden_field_label_dt_mostruario", "hidden_field_data_dt_mostruario"),
    "envios_amostra": new Array("hidden_field_label_envios_amostra", "hidden_field_data_envios_amostra"),
    "observacao": new Array("hidden_field_label_observacao", "hidden_field_data_observacao"),
    "log_aprov_so_ld": new Array("hidden_field_label_log_aprov_so_ld", "hidden_field_data_log_aprov_so_ld"),
    "dt_prev_recbto_so_ld": new Array("hidden_field_label_dt_prev_recbto_so_ld", "hidden_field_data_dt_prev_recbto_so_ld"),
    "dt_prev_aprov_so_ld": new Array("hidden_field_label_dt_prev_aprov_so_ld", "hidden_field_data_dt_prev_aprov_so_ld"),
    "dt_real_aprov_so_ld": new Array("hidden_field_label_dt_real_aprov_so_ld", "hidden_field_data_dt_real_aprov_so_ld"),
    "qt_dias_calc_so_ld": new Array("hidden_field_label_qt_dias_calc_so_ld", "hidden_field_data_qt_dias_calc_so_ld"),
    "dt_real_recbto_so_ld": new Array("hidden_field_label_dt_real_recbto_so_ld", "hidden_field_data_dt_real_recbto_so_ld"),
    "ind_producao_no_prazo": new Array("hidden_field_label_ind_producao_no_prazo", "hidden_field_data_ind_producao_no_prazo"),
    "qt_dias_producao": new Array("hidden_field_label_qt_dias_producao", "hidden_field_data_qt_dias_producao"),
    "ind_relat_semanal_producao": new Array("hidden_field_label_ind_relat_semanal_producao", "hidden_field_data_ind_relat_semanal_producao"),
    "dt_maxima_producao": new Array("hidden_field_label_dt_maxima_producao", "hidden_field_data_dt_maxima_producao"),
    "dt_termino_producao": new Array("hidden_field_label_dt_termino_producao", "hidden_field_data_dt_termino_producao"),
    "dt_prev_termino_producao": new Array("hidden_field_label_dt_prev_termino_producao", "hidden_field_data_dt_prev_termino_producao"),
    "ind_distr_custo": new Array("hidden_field_label_ind_distr_custo", "hidden_field_data_ind_distr_custo"),
    "vl_negociado": new Array("hidden_field_label_vl_negociado", "hidden_field_data_vl_negociado"),
    "dt_it_certif": new Array("hidden_field_label_dt_it_certif", "hidden_field_data_dt_it_certif")
  };

  var ajax_read_only = {
    "proc_compra_id": "off",
    "item_proc_compra_id": "on",
    "descricao": "off",
    "codigo_erp": "off",
    "desc_item": "off",
    "vl_custo_dolar": "off",
    "vl_base_tributacao": "off",
    "unid_medida": "off",
    "qt_comprada": "off",
    "vl_cubagem": "off",
    "composicao": "off",
    "shrinkage": "off",
    "peso": "off",
    "largura": "off",
    "calc_gm": "off",
    "rolo": "off",
    "coloracao_id": "off",
    "item_estacao": "off",
    "formato_amostra_id": "off",
    "log_mostruario": "off",
    "ind_laudo_antes_embarque": "off",
    "ind_qualid_emb": "off",
    "ind_prod_conf_pi": "off",
    "ind_rec_amostra_antes_emb": "off",
    "ind_qt_conf_proforma": "off",
    "ind_tamanho_pecas_correto": "off",
    "dt_prev_envio_desenhos": "off",
    "dt_real_envio_desenhos": "off",
    "dt_recbto_laudo": "off",
    "dt_recbto_embalagem": "off",
    "dt_cheg_amostras_emb": "off",
    "dt_mostruario": "off",
    "envios_amostra": "off",
    "observacao": "off",
    "log_aprov_so_ld": "off",
    "dt_prev_recbto_so_ld": "off",
    "dt_prev_aprov_so_ld": "off",
    "dt_real_aprov_so_ld": "off",
    "qt_dias_calc_so_ld": "off",
    "dt_real_recbto_so_ld": "off",
    "ind_producao_no_prazo": "off",
    "qt_dias_producao": "off",
    "ind_relat_semanal_producao": "off",
    "dt_maxima_producao": "off",
    "dt_termino_producao": "off",
    "dt_prev_termino_producao": "off",
    "ind_distr_custo": "off",
    "vl_negociado": "off",
    "dt_it_certif": "off"
  };
  var bRefreshTable = false;
  function scRefreshTable()
  {
    return false;
  }

  function scAjaxDetailValue(sIndex, sValue)
  {
    var aValue = new Array();
    aValue[0] = {"value" : sValue};
    if ("proc_compra_id" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("item_proc_compra_id" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("descricao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("codigo_erp" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("desc_item" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("vl_custo_dolar" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("vl_base_tributacao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("unid_medida" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("qt_comprada" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("vl_cubagem" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("composicao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("shrinkage" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("peso" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("largura" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("calc_gm" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("rolo" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("coloracao_id" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("item_estacao" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("formato_amostra_id" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("log_mostruario" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_laudo_antes_embarque" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_qualid_emb" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_prod_conf_pi" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_rec_amostra_antes_emb" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_qt_conf_proforma" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_tamanho_pecas_correto" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_prev_envio_desenhos" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_real_envio_desenhos" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_recbto_laudo" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_recbto_embalagem" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_cheg_amostras_emb" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_mostruario" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("envios_amostra" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("observacao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("log_aprov_so_ld" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_prev_recbto_so_ld" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_prev_aprov_so_ld" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_real_aprov_so_ld" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("qt_dias_calc_so_ld" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_real_recbto_so_ld" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_producao_no_prazo" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("qt_dias_producao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_relat_semanal_producao" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_maxima_producao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_termino_producao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_prev_termino_producao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("ind_distr_custo" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("vl_negociado" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("dt_it_certif" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
