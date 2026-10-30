<?php
class grid_pp_container_lookup
{
//  
   function lookup_situacao(&$situacao) 
   {
      $conteudo = "" ; 
      if ($situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($situacao == "2")
      { 
          $conteudo = "Suspenso";
      } 
      if ($situacao == "3")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $situacao = $conteudo; 
      } 
   }  
//  
   function lookup_situacao_container_id(&$conteudo , $situacao_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $situacao_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($situacao_container_id) === "" || trim($situacao_container_id) == "&nbsp;")
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $situacao_container_id order by descricao" ; 
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
      if ($conteudo == "")  
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_exclusivo(&$exclusivo) 
   {
      $conteudo = "" ; 
      if ($exclusivo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($exclusivo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $exclusivo = $conteudo; 
      } 
   }  
//  
   function lookup_ind_dt_embarque(&$ind_dt_embarque) 
   {
      $conteudo = "" ; 
      if ($ind_dt_embarque == "1")
      { 
          $conteudo = "Previsão Inicial";
      } 
      if ($ind_dt_embarque == "2")
      { 
          $conteudo = "Após Informação do Fornecedor";
      } 
      if ($ind_dt_embarque == "3")
      { 
          $conteudo = "Confirmada Pelo Agente de Cargas";
      } 
      if (empty($conteudo))  
      { 
          $conteudo = "Não Informado"; 
      } 
      if (!empty($conteudo)) 
      { 
          $ind_dt_embarque = $conteudo; 
      } 
   }  
//  
   function lookup_ind_dt_prev_chegada(&$ind_dt_prev_chegada) 
   {
      $conteudo = "" ; 
      if ($ind_dt_prev_chegada == "1")
      { 
          $conteudo = "Previsão Inicial";
      } 
      if ($ind_dt_prev_chegada == "")
      { 
          $conteudo = "Após Informação Agende de Cargas";
      } 
      if ($ind_dt_prev_chegada == "3")
      { 
          $conteudo = "Data Confirmada pelo Agente de Cargas";
      } 
      if (empty($conteudo))  
      { 
          $conteudo = "Não Informado"; 
      } 
      if (!empty($conteudo)) 
      { 
          $ind_dt_prev_chegada = $conteudo; 
      } 
   }  
//  
   function lookup_log_pagto_final(&$log_pagto_final) 
   {
      $conteudo = "" ; 
      if ($log_pagto_final == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_pagto_final == "0")
      { 
          $conteudo = "Não";
      } 
      if (empty($conteudo))  
      { 
          $conteudo = "Não Informado"; 
      } 
      if (!empty($conteudo)) 
      { 
          $log_pagto_final = $conteudo; 
      } 
   }  
//  
   function lookup_cod_agente_cargas(&$conteudo , $cod_agente_cargas) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cod_agente_cargas; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;" || trim($cod_agente_cargas) === "" || trim($cod_agente_cargas) == "&nbsp;")
      { 
          $conteudo = "Agente de Cargas Não Encontrado"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\",'-', \"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_agente_cargas order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_comum->Execute($nm_comando)) 
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
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comum->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo == "")  
      { 
          $conteudo = "Agente de Cargas Não Encontrado"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_cod_armador(&$conteudo , $cod_armador) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cod_armador; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;" || trim($cod_armador) === "" || trim($cod_armador) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\",'-', \"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_armador order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_comum->Execute($nm_comando)) 
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
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_comum->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_sit_situacao(&$situacao) 
   {
      $conteudo = "" ; 
      if ($situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($situacao == "2")
      { 
          $conteudo = "Suspenso";
      } 
      if ($situacao == "3")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $situacao = $conteudo; 
      } 
   }  
//  
   function lookup_sit_situacao_container_id(&$conteudo , $situacao_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $situacao_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($situacao_container_id) === "" || trim($situacao_container_id) == "&nbsp;")
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $situacao_container_id order by descricao" ; 
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
      if ($conteudo == "")  
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_sc_free_group_by_situacao(&$situacao) 
   {
      $conteudo = "" ; 
      if ($situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($situacao == "2")
      { 
          $conteudo = "Suspenso";
      } 
      if ($situacao == "3")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $situacao = $conteudo; 
      } 
   }  
//  
   function lookup_sc_free_group_by_situacao_container_id(&$conteudo , $situacao_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $situacao_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($situacao_container_id) === "" || trim($situacao_container_id) == "&nbsp;")
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $situacao_container_id order by descricao" ; 
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
      if ($conteudo == "")  
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_q_sit_acomp_situacao_container_id(&$conteudo , $situacao_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $situacao_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($situacao_container_id) === "" || trim($situacao_container_id) == "&nbsp;")
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $situacao_container_id order by descricao" ; 
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
      if ($conteudo == "")  
      { 
          $conteudo = "Não Informado"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
