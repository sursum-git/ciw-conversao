<?php
class cons_pp_container_filtro_fornecedor_lookup
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
   function lookup_exclusivo(&$exclusivo) 
   {
      $conteudo = "" ; 
      if ($exclusivo == "1")
      { 
          $conteudo = "Sim";
      } 
      if ($exclusivo == "0")
      { 
          $conteudo = "Não";
      } 
      if (!empty($conteudo)) 
      { 
          $exclusivo = $conteudo; 
      } 
   }  
//  
   function lookup_sit_situacao(&$situacao) 
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
}
?>
