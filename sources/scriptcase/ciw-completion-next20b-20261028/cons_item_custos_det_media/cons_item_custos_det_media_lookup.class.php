<?php
class cons_item_custos_det_media_lookup
{
//  
   function lookup_it_codigo(&$conteudo , $it_codigo) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $it_codigo; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select \"desc-item\" from PUB.item where \"it-codigo\" = '" . substr($this->Db->qstr($it_codigo), 1 , -1) . "' order by \"desc-item\"" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems2med->Execute($nm_comando)) 
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
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems2med->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
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
}
?>
