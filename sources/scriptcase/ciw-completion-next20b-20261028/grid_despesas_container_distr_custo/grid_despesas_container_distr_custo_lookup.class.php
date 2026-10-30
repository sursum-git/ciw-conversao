<?php
class grid_despesas_container_distr_custo_lookup
{
//  
   function lookup_desp_despesa_id(&$conteudo , $desp_despesa_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $desp_despesa_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($desp_despesa_id) === "" || trim($desp_despesa_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.despesas where despesa_id = $desp_despesa_id order by descricao" ; 
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
   function lookup_emp_desp_log_custo(&$emp_desp_log_custo) 
   {
      $conteudo = "" ; 
      if ($emp_desp_log_custo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($emp_desp_log_custo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $emp_desp_log_custo = $conteudo; 
      } 
   }  
//  
   function lookup_q_log_custo_emp_desp_log_custo(&$emp_desp_log_custo) 
   {
      $conteudo = "" ; 
      if ($emp_desp_log_custo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($emp_desp_log_custo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $emp_desp_log_custo = $conteudo; 
      } 
   }  
}
?>
