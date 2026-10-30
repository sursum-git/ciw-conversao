<?php
class cons_selec_despesas_lookup
{
//  
   function lookup_log_calculada(&$log_calculada) 
   {
      $conteudo = "" ; 
      if ($log_calculada == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_calculada == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $log_calculada = $conteudo; 
      } 
   }  
}
?>
