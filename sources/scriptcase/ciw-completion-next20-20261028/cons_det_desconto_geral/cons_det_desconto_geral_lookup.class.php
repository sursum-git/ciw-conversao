<?php
class cons_det_desconto_geral_lookup
{
//  
   function lookup_item_container_id(&$conteudo , $item_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $item_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;")
      { 
          $conteudo = "N/A"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp + ' ' + item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(item_proc_compra.codigo_erp, ' ',item_proc_compra.descricao)  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp&' '&item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp + ' ' + item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
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
   function lookup_fornecedor_id(&$conteudo , $fornecedor_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $fornecedor_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($fornecedor_id) === "" || trim($fornecedor_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select \"nome-abrev\" from PUB.emitente where \"cod-emitente\" = $fornecedor_id order by \"nome-abrev\"" ; 
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
   function lookup_motivo_desconto_id(&$conteudo , $motivo_desconto_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $motivo_desconto_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($motivo_desconto_id) === "" || trim($motivo_desconto_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.motivos_desconto where motivo_desconto_id = $motivo_desconto_id order by descricao" ; 
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
   function lookup_log_credito(&$log_credito) 
   {
      $conteudo = "" ; 
      if ($log_credito == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_credito == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $log_credito = $conteudo; 
      } 
   }  
//  
   function lookup_cod_tipo(&$cod_tipo) 
   {
      $conteudo = "" ; 
      if ($cod_tipo == "2")
      { 
          $conteudo = "Vinculado ao item do Container";
      } 
      if ($cod_tipo == "1")
      { 
          $conteudo = "Avulso";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_tipo = $conteudo; 
      } 
   }  
//  
   function lookup_q_motivo_motivo_desconto_id(&$conteudo , $motivo_desconto_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $motivo_desconto_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($motivo_desconto_id) === "" || trim($motivo_desconto_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.motivos_desconto where motivo_desconto_id = $motivo_desconto_id order by descricao" ; 
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
   function lookup_q_item_item_container_id(&$conteudo , $item_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $item_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;" || trim($item_container_id) === "" || trim($item_container_id) == "&nbsp;")
      { 
          $conteudo = "N/A"; 
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp + ' ' + item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(item_proc_compra.codigo_erp, ' ',item_proc_compra.descricao)  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp&' '&item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp + ' ' + item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT item_proc_compra.codigo_erp||' '||item_proc_compra.descricao  FROM PUB.itens_container item_container, pub.itens_proc_compra item_proc_compra where item_container.item_container_id = '$item_container_id' and   item_container.item_proc_compra_id = item_proc_compra.item_proc_compra_id order by item_proc_compra.codigo_erp" ; 
      } 
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
   function lookup_q_fornec_fornecedor_id(&$conteudo , $fornecedor_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $fornecedor_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($fornecedor_id) === "" || trim($fornecedor_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select \"nome-abrev\" from PUB.emitente where \"cod-emitente\" = $fornecedor_id order by \"nome-abrev\"" ; 
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
