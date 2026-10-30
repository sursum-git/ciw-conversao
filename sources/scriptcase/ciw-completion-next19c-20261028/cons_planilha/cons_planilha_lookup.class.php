<?php
class cons_planilha_lookup
{
//  
   function lookup_pc_fornecedor_id(&$conteudo , $pc_fornecedor_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $pc_fornecedor_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($pc_fornecedor_id) === "" || trim($pc_fornecedor_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select distinct nom_pessoa from PUB.fornecedor where cdn_fornecedor = $pc_fornecedor_id order by nom_pessoa" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems5->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $conteudo = $save_conteudo . " - " . $conteudo ; 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_pc_cod_situacao(&$pc_cod_situacao) 
   {
      $conteudo = "" ; 
      if ($pc_cod_situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($pc_cod_situacao == "2")
      { 
          $conteudo = "Fechado";
      } 
      if ($pc_cod_situacao == "3")
      { 
          $conteudo = "Cancelado";
      } 
      if (!empty($conteudo)) 
      { 
          $pc_cod_situacao = $conteudo; 
      } 
   }  
//  
   function lookup_pc_log_facilid_contato_fornec(&$pc_log_facilid_contato_fornec) 
   {
      $conteudo = "" ; 
      if ($pc_log_facilid_contato_fornec == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($pc_log_facilid_contato_fornec == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $pc_log_facilid_contato_fornec = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_coloracao_id(&$conteudo , $ipc_coloracao_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $ipc_coloracao_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($ipc_coloracao_id) === "" || trim($ipc_coloracao_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.coloracoes where coloracao_id = $ipc_coloracao_id order by descricao" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_ipc_log_mostruario(&$ipc_log_mostruario) 
   {
      $conteudo = "" ; 
      if ($ipc_log_mostruario == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_log_mostruario == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_log_mostruario = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_formato_amostra_id(&$conteudo , $ipc_formato_amostra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $ipc_formato_amostra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($ipc_formato_amostra_id) === "" || trim($ipc_formato_amostra_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.formatos_amostra where formato_amostra_id = $ipc_formato_amostra_id order by descricao" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_ipc_ind_producao_no_prazo(&$ipc_ind_producao_no_prazo) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_producao_no_prazo == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_producao_no_prazo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_producao_no_prazo == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_producao_no_prazo = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_relat_semanal_producao(&$ipc_ind_relat_semanal_producao) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_relat_semanal_producao == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_relat_semanal_producao == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_relat_semanal_producao == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_relat_semanal_producao = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_laudo_antes_embarque(&$ipc_ind_laudo_antes_embarque) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_laudo_antes_embarque == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_laudo_antes_embarque == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_laudo_antes_embarque == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_laudo_antes_embarque = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_qualid_emb(&$ipc_ind_qualid_emb) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_qualid_emb == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_qualid_emb == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_qualid_emb == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_qualid_emb = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_prod_conf_pi(&$ipc_ind_prod_conf_pi) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_prod_conf_pi == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_prod_conf_pi == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_prod_conf_pi == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_prod_conf_pi = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_rec_amostra_antes_emb(&$ipc_ind_rec_amostra_antes_emb) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_rec_amostra_antes_emb == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_rec_amostra_antes_emb == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_rec_amostra_antes_emb == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_rec_amostra_antes_emb = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_qt_conf_proforma(&$ipc_ind_qt_conf_proforma) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_qt_conf_proforma == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_qt_conf_proforma == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_qt_conf_proforma == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_qt_conf_proforma = $conteudo; 
      } 
   }  
//  
   function lookup_ipc_ind_tamanho_pecas_correto(&$ipc_ind_tamanho_pecas_correto) 
   {
      $conteudo = "" ; 
      if ($ipc_ind_tamanho_pecas_correto == "0")
      { 
          $conteudo = "Não Informado";
      } 
      if ($ipc_ind_tamanho_pecas_correto == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ipc_ind_tamanho_pecas_correto == "2")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ipc_ind_tamanho_pecas_correto = $conteudo; 
      } 
   }  
//  
   function lookup_sc_field_2(&$conteudo , $sc_field_2) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $sc_field_2; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($sc_field_2) === "" || trim($sc_field_2) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select distinct nom_pessoa from PUB.fornecedor where cdn_fornecedor = $sc_field_2 order by nom_pessoa" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems5->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $conteudo = $save_conteudo . " - " . $conteudo ; 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_c_situacao(&$c_situacao) 
   {
      $conteudo = "" ; 
      if ($c_situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($c_situacao == "2")
      { 
          $conteudo = "Suspenso";
      } 
      if ($c_situacao == "3")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $c_situacao = $conteudo; 
      } 
   }  
//  
   function lookup_c_exclusivo(&$c_exclusivo) 
   {
      $conteudo = "" ; 
      if ($c_exclusivo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($c_exclusivo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $c_exclusivo = $conteudo; 
      } 
   }  
//  
   function lookup_c_cod_armador(&$conteudo , $c_cod_armador) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $c_cod_armador; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($c_cod_armador) === "" || trim($c_cod_armador) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select distinct nom_pessoa from PUB.fornecedor where cdn_fornecedor = $c_cod_armador order by nom_pessoa" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems5->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $conteudo = $save_conteudo . " - " . $conteudo ; 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_c_cod_agente_cargas(&$conteudo , $c_cod_agente_cargas) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $c_cod_agente_cargas; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($c_cod_agente_cargas) === "" || trim($c_cod_agente_cargas) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select distinct nom_pessoa from PUB.fornecedor where cdn_fornecedor = $c_cod_agente_cargas order by nom_pessoa" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems5->Execute($nm_comando)) 
      { 
          if (isset($rx->fields[0]))  
          { 
              $conteudo = $rx->fields[0]; 
          } 
          $save_conteudo1 = $conteudo ; 
          $rx->Close(); 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_c_ind_dt_prev_chegada(&$c_ind_dt_prev_chegada) 
   {
      $conteudo = "" ; 
      if ($c_ind_dt_prev_chegada == "1")
      { 
          $conteudo = "Previsão Inicial";
      } 
      if ($c_ind_dt_prev_chegada == "2")
      { 
          $conteudo = "Após Informação Agende de Cargas";
      } 
      if ($c_ind_dt_prev_chegada == "3")
      { 
          $conteudo = "Data Confirmada pelo Agente de Cargas";
      } 
      if (!empty($conteudo)) 
      { 
          $c_ind_dt_prev_chegada = $conteudo; 
      } 
   }  
//  
   function lookup_c_ind_dt_embarque(&$c_ind_dt_embarque) 
   {
      $conteudo = "" ; 
      if ($c_ind_dt_embarque == "1")
      { 
          $conteudo = "Previsão Inicial";
      } 
      if ($c_ind_dt_embarque == "2")
      { 
          $conteudo = "Após Informação do Fornecedor";
      } 
      if ($c_ind_dt_embarque == "3")
      { 
          $conteudo = "Confirmada Pelo Agente de Cargas";
      } 
      if (!empty($conteudo)) 
      { 
          $c_ind_dt_embarque = $conteudo; 
      } 
   }  
//  
   function lookup_ic_log_rec_doc_prazo_emb(&$ic_log_rec_doc_prazo_emb) 
   {
      $conteudo = "" ; 
      if ($ic_log_rec_doc_prazo_emb == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($ic_log_rec_doc_prazo_emb == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $ic_log_rec_doc_prazo_emb = $conteudo; 
      } 
   }  
}
?>
