<?php
class grid_itens_container_bkp_lookup
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
          $nm_comando = "SELECT codigo_erp + ' ' + descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(codigo_erp, ' ',descricao)  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT codigo_erp&' '&descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT codigo_erp||' '||descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT codigo_erp + ' ' + descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT codigo_erp||' '||descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT codigo_erp||' '||descricao  FROM pub.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
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
//  
   function lookup_qt_descontos(&$conteudo , $item_container_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($item_container_id) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      $nm_comando = "select count(desconto_importacao_id) from
      pub.descontos_importacao where item_container_id = $item_container_id" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $rx->fields[0] = str_replace(',', '.', $rx->fields[0]); 
                     $nm_array_retorno_lookup[$a][0] = $rx->fields[0];
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = $rx->fields[0]; 
                     $conteudo .= $nm_tmp_form;
                 } 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
}
?>
