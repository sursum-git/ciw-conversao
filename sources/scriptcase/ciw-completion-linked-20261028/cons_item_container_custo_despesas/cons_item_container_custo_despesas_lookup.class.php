<?php
class cons_item_container_custo_despesas_lookup
{
//  
   function lookup_despesa_id(&$conteudo , $despesa_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $despesa_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($despesa_id) === "" || trim($despesa_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.despesas where despesa_id = $despesa_id order by descricao" ; 
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
   function lookup_log_custo(&$log_custo) 
   {
      $conteudo = "" ; 
      if ($log_custo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_custo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $log_custo = $conteudo; 
      } 
   }  
//  
   function lookup_q_log_custo_log_custo(&$log_custo) 
   {
      $conteudo = "" ; 
      if ($log_custo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_custo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $log_custo = $conteudo; 
      } 
   }  
}
?>
