<?php
class cons_item_custos_lookup
{
//  
   function lookup_cod_tipo_custo(&$cod_tipo_custo) 
   {
      $conteudo = "" ; 
      if ($cod_tipo_custo == "1")
      { 
          $conteudo = "Manual";
      } 
      if ($cod_tipo_custo == "2")
      { 
          $conteudo = "Container";
      } 
      if ($cod_tipo_custo == "3")
      { 
          $conteudo = "Média Entre Itens";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_tipo_custo = $conteudo; 
      } 
   }  
//  
   function lookup_cod_situacao(&$cod_situacao) 
   {
      $conteudo = "" ; 
      if ($cod_situacao == "1")
      { 
          $conteudo = "Incompleto";
      } 
      if ($cod_situacao == "2")
      { 
          $conteudo = "Completo";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_situacao = $conteudo; 
      } 
   }  
}
?>
