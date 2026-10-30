<?php
class cons_itens_compra_alocado_lookup
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
   function lookup_situacao_acomp(&$conteudo , $situacao_acomp) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $situacao_acomp; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = '" . substr($this->Db->qstr($situacao_acomp), 1 , -1) . "' order by descricao" ; 
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
          $conteudo = "Não Informada"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
}
?>
