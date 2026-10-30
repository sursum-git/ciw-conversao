<?php
class cons_pedidos_por_item_ref_container_lookup
{
//  
   function lookup_sc_field_5(&$sc_field_5) 
   {
      $conteudo = "" ; 
      if ($sc_field_5 == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($sc_field_5 == "2")
      { 
          $conteudo = "Atendido Parcial";
      } 
      if ($sc_field_5 == "3")
      { 
          $conteudo = "Atendido Total";
      } 
      if ($sc_field_5 == "4")
      { 
          $conteudo = "Pendente";
      } 
      if ($sc_field_5 == "5")
      { 
          $conteudo = "Suspenso";
      } 
      if ($sc_field_5 == "6")
      { 
          $conteudo = "Cancelado";
      } 
      if ($sc_field_5 == "7")
      { 
          $conteudo = "Fatur.Balção";
      } 
      if (!empty($conteudo)) 
      { 
          $sc_field_5 = $conteudo; 
      } 
   }  
//  
   function lookup_sc_field_11(&$conteudo , $sc_field_11) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $sc_field_11; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select descricao from PUB.\"cond-pagto\" where \"cod-cond-pag\" = '" . substr($this->Db->qstr($sc_field_11), 1 , -1) . "' order by descricao" ; 
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
          $conteudo = "E S P E C I A L"; 
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_sc_field_12(&$sc_field_12) 
   {
      $conteudo = "" ; 
      if ($sc_field_12 == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($sc_field_12 == "2")
      { 
          $conteudo = "Atendido Parcial";
      } 
      if ($sc_field_12 == "3")
      { 
          $conteudo = "Atendido Total";
      } 
      if ($sc_field_12 == "4")
      { 
          $conteudo = "Pendente";
      } 
      if ($sc_field_12 == "5")
      { 
          $conteudo = "Suspenso";
      } 
      if ($sc_field_12 == "6")
      { 
          $conteudo = "Cancelado";
      } 
      if ($sc_field_12 == "7")
      { 
          $conteudo = "Fatur.Balção";
      } 
      if (!empty($conteudo)) 
      { 
          $sc_field_12 = $conteudo; 
      } 
   }  
//  
   function lookup_q_sit_ped_sc_field_12(&$sc_field_12) 
   {
      $conteudo = "" ; 
      if ($sc_field_12 == "1")
      { 
          $conteudo = "Aberto";
      } 
      if ($sc_field_12 == "2")
      { 
          $conteudo = "Atendido Parcial";
      } 
      if ($sc_field_12 == "3")
      { 
          $conteudo = "Atendido Total";
      } 
      if ($sc_field_12 == "4")
      { 
          $conteudo = "Pendente";
      } 
      if ($sc_field_12 == "5")
      { 
          $conteudo = "Suspenso";
      } 
      if ($sc_field_12 == "6")
      { 
          $conteudo = "Cancelado";
      } 
      if ($sc_field_12 == "7")
      { 
          $conteudo = "Fatur.Balção";
      } 
      if (!empty($conteudo)) 
      { 
          $sc_field_12 = $conteudo; 
      } 
   }  
}
?>
