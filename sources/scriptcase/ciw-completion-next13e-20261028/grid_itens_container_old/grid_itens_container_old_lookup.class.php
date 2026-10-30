<?php
class grid_itens_container_old_lookup
{
//  
   function lookup_item_proc_compra_id(&$conteudo , $item_proc_compra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $item_proc_compra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(descricao, ' ', codigo_erp)  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT descricao&' '&codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
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
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
