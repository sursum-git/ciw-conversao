
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField, sField)) {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField, sField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField, sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField, sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField, sField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["despesa_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["log_imposto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ordem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["log_calculada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["log_vl_prod_base_calculo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["perc_calculo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["log_calc_por_item" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ind_imposto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["md_relacs_desp" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["despesa_id" + iSeqRow] && scEventControl_data["despesa_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["despesa_id" + iSeqRow] && scEventControl_data["despesa_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow] && scEventControl_data["descricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descricao" + iSeqRow] && scEventControl_data["descricao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["log_imposto" + iSeqRow] && scEventControl_data["log_imposto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["log_imposto" + iSeqRow] && scEventControl_data["log_imposto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ordem" + iSeqRow] && scEventControl_data["ordem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ordem" + iSeqRow] && scEventControl_data["ordem" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["log_calculada" + iSeqRow] && scEventControl_data["log_calculada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["log_calculada" + iSeqRow] && scEventControl_data["log_calculada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["log_vl_prod_base_calculo" + iSeqRow] && scEventControl_data["log_vl_prod_base_calculo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["log_vl_prod_base_calculo" + iSeqRow] && scEventControl_data["log_vl_prod_base_calculo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["perc_calculo" + iSeqRow] && scEventControl_data["perc_calculo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["perc_calculo" + iSeqRow] && scEventControl_data["perc_calculo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["log_calc_por_item" + iSeqRow] && scEventControl_data["log_calc_por_item" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["log_calc_por_item" + iSeqRow] && scEventControl_data["log_calc_por_item" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ind_imposto" + iSeqRow] && scEventControl_data["ind_imposto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ind_imposto" + iSeqRow] && scEventControl_data["ind_imposto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["md_relacs_desp" + iSeqRow] && scEventControl_data["md_relacs_desp" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["md_relacs_desp" + iSeqRow] && scEventControl_data["md_relacs_desp" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  if ("perc_calculo" + iSeq == fieldName) {
    _scCalculatorBlurOk[fieldId] = false;
  }
  scEventControl_data[fieldName]["blur"] = true;
  if ("log_imposto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("log_calculada" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("log_vl_prod_base_calculo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("log_calc_por_item" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("ind_imposto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("log_calculada" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("log_imposto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

function scEventControl_onCalculator_perc_calculo() {
  if (!_scCalculatorControl["id_sc_field_perc_calculo"]) {
    _scCalculatorBlurOk["id_sc_field_perc_calculo"] = true;
    do_ajax_form_despesas_mob_event_perc_calculo_onblur();
  }
} // scEventControl_onCalculator_perc_calculo

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_despesa_id' + iSeqRow).bind('blur', function() { sc_form_despesas_despesa_id_onblur('#id_sc_field_despesa_id' + iSeqRow, iSeqRow) })
                                        .bind('focus', function() { sc_form_despesas_despesa_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_descricao' + iSeqRow).bind('blur', function() { sc_form_despesas_descricao_onblur('#id_sc_field_descricao' + iSeqRow, iSeqRow) })
                                       .bind('focus', function() { sc_form_despesas_descricao_onfocus(this, iSeqRow) });
  $('#id_sc_field_log_imposto' + iSeqRow).bind('blur', function() { sc_form_despesas_log_imposto_onblur('#id_sc_field_log_imposto' + iSeqRow, iSeqRow) })
                                         .bind('change', function() { sc_form_despesas_log_imposto_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_despesas_log_imposto_onfocus(this, iSeqRow) });
  $('#id_sc_field_ordem' + iSeqRow).bind('blur', function() { sc_form_despesas_ordem_onblur('#id_sc_field_ordem' + iSeqRow, iSeqRow) })
                                   .bind('focus', function() { sc_form_despesas_ordem_onfocus(this, iSeqRow) });
  $('#id_sc_field_log_calculada' + iSeqRow).bind('blur', function() { sc_form_despesas_log_calculada_onblur('#id_sc_field_log_calculada' + iSeqRow, iSeqRow) })
                                           .bind('change', function() { sc_form_despesas_log_calculada_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_despesas_log_calculada_onfocus(this, iSeqRow) });
  $('#id_sc_field_perc_calculo' + iSeqRow).bind('blur', function() { sc_form_despesas_perc_calculo_onblur('#id_sc_field_perc_calculo' + iSeqRow, iSeqRow) })
                                          .bind('focus', function() { sc_form_despesas_perc_calculo_onfocus(this, iSeqRow) });
  $('#id_sc_field_log_vl_prod_base_calculo' + iSeqRow).bind('blur', function() { sc_form_despesas_log_vl_prod_base_calculo_onblur('#id_sc_field_log_vl_prod_base_calculo' + iSeqRow, iSeqRow) })
                                                      .bind('focus', function() { sc_form_despesas_log_vl_prod_base_calculo_onfocus(this, iSeqRow) });
  $('#id_sc_field_log_calc_por_item' + iSeqRow).bind('blur', function() { sc_form_despesas_log_calc_por_item_onblur('#id_sc_field_log_calc_por_item' + iSeqRow, iSeqRow) })
                                               .bind('focus', function() { sc_form_despesas_log_calc_por_item_onfocus(this, iSeqRow) });
  $('#id_sc_field_ind_imposto' + iSeqRow).bind('blur', function() { sc_form_despesas_ind_imposto_onblur('#id_sc_field_ind_imposto' + iSeqRow, iSeqRow) })
                                         .bind('focus', function() { sc_form_despesas_ind_imposto_onfocus(this, iSeqRow) });
  $('#id_sc_field_md_relacs_desp' + iSeqRow).bind('blur', function() { sc_form_despesas_md_relacs_desp_onblur('#id_sc_field_md_relacs_desp' + iSeqRow, iSeqRow) })
                                            .bind('focus', function() { sc_form_despesas_md_relacs_desp_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_despesas_despesa_id_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_despesa_id();
  scCssBlur(oThis);
}

function sc_form_despesas_despesa_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_descricao_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_descricao();
  scCssBlur(oThis);
}

function sc_form_despesas_descricao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_log_imposto_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_log_imposto();
  scCssBlur(oThis);
}

function sc_form_despesas_log_imposto_onchange(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_event_log_imposto_onchange();
}

function sc_form_despesas_log_imposto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_ordem_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_ordem();
  scCssBlur(oThis);
}

function sc_form_despesas_ordem_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_log_calculada_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_log_calculada();
  scCssBlur(oThis);
}

function sc_form_despesas_log_calculada_onchange(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_event_log_calculada_onchange();
}

function sc_form_despesas_log_calculada_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_perc_calculo_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_perc_calculo();
  scCssBlur(oThis);
}

function sc_form_despesas_perc_calculo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_log_vl_prod_base_calculo_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_log_vl_prod_base_calculo();
  scCssBlur(oThis);
}

function sc_form_despesas_log_vl_prod_base_calculo_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_log_calc_por_item_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_log_calc_por_item();
  scCssBlur(oThis);
}

function sc_form_despesas_log_calc_por_item_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_ind_imposto_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_ind_imposto();
  scCssBlur(oThis);
}

function sc_form_despesas_ind_imposto_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_despesas_md_relacs_desp_onblur(oThis, iSeqRow) {
  do_ajax_form_despesas_mob_validate_md_relacs_desp();
  scCssBlur(oThis);
}

function sc_form_despesas_md_relacs_desp_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
        if ("1" == block) {
                displayChange_block_1(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("despesa_id", "", status);
        displayChange_field("descricao", "", status);
        displayChange_field("log_imposto", "", status);
        displayChange_field("ordem", "", status);
        displayChange_field("log_calculada", "", status);
        displayChange_field("log_vl_prod_base_calculo", "", status);
        displayChange_field("perc_calculo", "", status);
        displayChange_field("log_calc_por_item", "", status);
        displayChange_field("ind_imposto", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("md_relacs_desp", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_despesa_id(row, status);
        displayChange_field_descricao(row, status);
        displayChange_field_log_imposto(row, status);
        displayChange_field_ordem(row, status);
        displayChange_field_log_calculada(row, status);
        displayChange_field_log_vl_prod_base_calculo(row, status);
        displayChange_field_perc_calculo(row, status);
        displayChange_field_log_calc_por_item(row, status);
        displayChange_field_ind_imposto(row, status);
        displayChange_field_md_relacs_desp(row, status);
}

function displayChange_field(field, row, status) {
        if ("despesa_id" == field) {
                displayChange_field_despesa_id(row, status);
        }
        if ("descricao" == field) {
                displayChange_field_descricao(row, status);
        }
        if ("log_imposto" == field) {
                displayChange_field_log_imposto(row, status);
        }
        if ("ordem" == field) {
                displayChange_field_ordem(row, status);
        }
        if ("log_calculada" == field) {
                displayChange_field_log_calculada(row, status);
        }
        if ("log_vl_prod_base_calculo" == field) {
                displayChange_field_log_vl_prod_base_calculo(row, status);
        }
        if ("perc_calculo" == field) {
                displayChange_field_perc_calculo(row, status);
        }
        if ("log_calc_por_item" == field) {
                displayChange_field_log_calc_por_item(row, status);
        }
        if ("ind_imposto" == field) {
                displayChange_field_ind_imposto(row, status);
        }
        if ("md_relacs_desp" == field) {
                displayChange_field_md_relacs_desp(row, status);
        }
}

function displayChange_field_despesa_id(row, status) {
    var fieldId;
}

function displayChange_field_descricao(row, status) {
    var fieldId;
}

function displayChange_field_log_imposto(row, status) {
    var fieldId;
}

function displayChange_field_ordem(row, status) {
    var fieldId;
}

function displayChange_field_log_calculada(row, status) {
    var fieldId;
}

function displayChange_field_log_vl_prod_base_calculo(row, status) {
    var fieldId;
}

function displayChange_field_perc_calculo(row, status) {
    var fieldId;
}

function displayChange_field_log_calc_por_item(row, status) {
    var fieldId;
}

function displayChange_field_ind_imposto(row, status) {
    var fieldId;
}

function displayChange_field_md_relacs_desp(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_despesas_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(25);
                }
        }
}
var jqCalcMonetPos = {};
var _scCalculatorBlurOk = {};

function scJQCalculatorAdd(iSeqRow) {
  _scCalculatorBlurOk["id_sc_field_md_relacs_desp" + iSeqRow] = true;
  $("#id_sc_field_perc_calculo" + iSeqRow).calculator({
    onOpen: function(value, inst) {
      if (typeof _scCalculatorControl !== "undefined") {
        if (!_scCalculatorControl["id_sc_field_perc_calculo" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_perc_calculo" + iSeqRow] = true;
        }
      }
      value = scJQCalculatorUnformat(value, "#id_sc_field_perc_calculo" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_grp']); ?>', <?php echo $this->field_config['perc_calculo']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_dec']); ?>', '');
      $(this).val(value);
      $(".calculator-popup").css("min-width", "200px");
    },
    onClose: function(value, inst) {
      var oldValue = $(this.val);
      if (typeof _scCalculatorControl !== "undefined") {
        if (_scCalculatorControl["id_sc_field_perc_calculo" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_perc_calculo" + iSeqRow] = null;
        }
      }
      value = scJQCalculatorFormat(value, "#id_sc_field_perc_calculo" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_grp']); ?>', <?php echo $this->field_config['perc_calculo']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['perc_calculo']['symbol_dec']); ?>', 4, '');
      $(this).val(value);
      if (oldValue != value) {
        $(this).trigger('change');
      }
    },
    precision: 4,
    showOn: "button",
<?php
$miniCalculatorIcon = $this->jqueryIconFile('calculator');
$miniCalculatorFA   = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorIcon) {
?>
    buttonImage: "<?php echo $miniCalculatorIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalculatorFA) {
?>
    buttonText: "",
<?php
}
?>
  })
<?php
if ('' != $miniCalculatorFA) {
?>
    .next('button').append("<?php echo $miniCalculatorFA; ?>")
<?php
}
?>
;

} // scJQCalculatorAdd

function scJQCalculatorUnformat(fValue, sField, sThousands, sFormat, sDecimals, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue, sField, sMonetary);
  if ("" != sThousands) {
    if ("." == sThousands) {
      sThousands = "\\.";
    }
    sRegEx = eval("/" + sThousands + "/g");
    fValue = fValue.replace(sRegEx, "");
  }
  if ("." != sDecimals) {
    sRegEx = eval("/" + sDecimals + "/g");
    fValue = fValue.replace(sRegEx, ".");
  }
  if ("." == fValue.substr(0, 1) || "," == fValue.substr(0, 1)) {
    fValue = "0" + fValue;
  }
  return fValue;
} // scJQCalculatorUnformat

function scJQCalculatorFormat(fValue, sField, sThousands, sFormat, sDecimals, iPrecision, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue.toString(), sField, sMonetary);
  if (-1 < fValue.indexOf('.')) {
    var parts = fValue.split('.'),
        pref = parts[0],
        suf = parts[1];
  }
  else {
    var pref = fValue,
        suf = '';
  }
  if ('' != sThousands) {
    if (3 == sFormat) {
      if (4 <= pref.length) {
        pref_rest = pref.substr(0, pref.length - 3);
        pref = sThousands + pref.substr(pref.length - 3);
        while (2 < pref_rest.length) {
          pref = sThousands + pref_rest.substr(pref_rest.length - 2) + pref;
          pref_rest = pref_rest.substr(0, pref_rest.length - 2);
        }
        if ('' != pref_rest) {
          pref = pref_rest + pref;
        }
      }
    }
    else if (2 == sFormat) {
      if (4 <= pref.length) {
        pref = pref.substr(0, pref.length - 3) + sThousands + pref.substr(pref.length - 3);
      }
    }
    else {
      pref_rest = pref;
      pref = '';
      while (3 < pref_rest.length) {
        pref = sThousands + pref_rest.substr(pref_rest.length - 3) + pref;
        pref_rest = pref_rest.substr(0, pref_rest.length - 3);
      }
      if ('' != pref_rest) {
        pref = pref_rest + pref;
      }
    }
  }
  if ('' != iPrecision) {
    if (suf.length > iPrecision) {
      suf = '1' + suf.substr(0, iPrecision) + '.' + suf.substr(iPrecision);
      suf = Math.round(parseFloat(suf)).toString().substr(1);
    }
    else {
      while (suf.length < iPrecision) {
        suf += '0';
      }
    }
  }
  if ('' != sDecimals && '' != suf) {
    fValue = pref + sDecimals + suf;
  }
  else {
    fValue = pref;
  }
  if ('' != sMonetary) {
    fValue = 'left' == jqCalcMonetPos[sField] ? sMonetary + ' ' + fValue : fValue + ' ' + sMonetary;
  }
  return fValue;
} // scJQCalculatorFormat

function scJQCalculatorCurrency(fValue, sField, sMonetary) {
  if ("" != sMonetary) {
    if (sMonetary + ' ' == fValue.substr(0, sMonetary.length + 1)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (sMonetary == fValue.substr(0, sMonetary.length)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (' ' + sMonetary == fValue.substr(fValue.length - sMonetary.length - 1)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length - 1);
        jqCalcMonetPos[sField] = 'right';
    }
    else if (sMonetary == fValue.substr(fValue.length - sMonetary.length)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length);
        jqCalcMonetPos[sField] = 'right';
    }
  }
  if ("" == fValue) {
    fValue = "0";
  }
  return fValue;
} // scJQCalculatorCurrency

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_despesas_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalculatorAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

