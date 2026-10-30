<?php
class cons_cta_corren_custo_distr_lookup
{
//  
   function lookup_tipo_movto(&$tipo_movto) 
   {
      $conteudo = "" ; 
      if ($tipo_movto == "1")
      { 
          $conteudo = "Saldo Anterior";
      } 
      if ($tipo_movto == "2")
      { 
          $conteudo = "Ajuste Manual";
      } 
      if ($tipo_movto == "3")
      { 
          $conteudo = "Saldo Versão do Custo";
      } 
      if ($tipo_movto == "4")
      { 
          $conteudo = "Distribuição de Custo";
      } 
      if (!empty($conteudo)) 
      { 
          $tipo_movto = $conteudo; 
      } 
   }  
//  
   function lookup_situacao_container(&$situacao_container) 
   {
      $conteudo = "" ; 
      if ($situacao_container == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($situacao_container == "2")
      { 
          $conteudo = "Suspenso";
      } 
      if ($situacao_container == "3")
      { 
          $conteudo = "Fechado";
      } 
      if (empty($conteudo))  
      { 
          $conteudo = "N/A"; 
      } 
      if (!empty($conteudo)) 
      { 
          $situacao_container = $conteudo; 
      } 
   }  
//  
   function lookup_sit_acomp_container(&$conteudo , $sit_acomp_container) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $sit_acomp_container; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($sit_acomp_container) === "" || trim($sit_acomp_container) == "&nbsp;")
      { 
          $conteudo = "N/A"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $sit_acomp_container order by descricao" ; 
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
          $conteudo = "N/A"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_cod_emit_forn(&$conteudo , $cod_emit_forn) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cod_emit_forn; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;" || trim($cod_emit_forn) === "" || trim($cod_emit_forn) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\", '-',\"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cod_emit_forn order by \"nome-abrev\", \"nome-emit\"" ; 
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
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_fornec_pi(&$conteudo , $fornec_pi) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $fornec_pi; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;" || trim($fornec_pi) === "" || trim($fornec_pi) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\", '-',\"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $fornec_pi order by \"nome-abrev\", \"nome-emit\"" ; 
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
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
