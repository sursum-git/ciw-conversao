<?php
class cons_proc_compra_sinaliz_lookup
{
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
      $nm_comando = "select \"nome-emit\" from PUB.emitente where \"cod-emitente\" = $fornecedor_id order by \"nome-emit\"" ; 
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
   function lookup_cod_situacao(&$cod_situacao) 
   {
      $conteudo = "" ; 
      if ($cod_situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($cod_situacao == "2")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_situacao = $conteudo; 
      } 
   }  
//  
   function lookup_q_sit_cod_situacao(&$cod_situacao) 
   {
      $conteudo = "" ; 
      if ($cod_situacao == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($cod_situacao == "2")
      { 
          $conteudo = "Fechado";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_situacao = $conteudo; 
      } 
   }  
}
?>
