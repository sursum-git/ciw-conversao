<?php
class grid_despesas_lookup
{
//  
   function lookup_log_imposto(&$log_imposto) 
   {
      $conteudo = "" ; 
      if ($log_imposto == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($log_imposto == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $log_imposto = $conteudo; 
      } 
   }  
}
?>
