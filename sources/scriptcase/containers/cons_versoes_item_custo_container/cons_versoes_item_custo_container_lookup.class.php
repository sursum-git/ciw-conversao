<?php
class cons_versoes_item_custo_container_lookup
{
//  
   function lookup_tipo_versao_id(&$conteudo , $tipo_versao_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $tipo_versao_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($tipo_versao_id) === "" || trim($tipo_versao_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.tipos_versao_custo where tipo_versao_custo_id = $tipo_versao_id order by descricao" ; 
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
   function lookup_ind_sit_versao(&$ind_sit_versao) 
   {
      $conteudo = "" ; 
      if ($ind_sit_versao == "1")
      { 
          $conteudo = "Incompleto";
      } 
      if ($ind_sit_versao == "2")
      { 
          $conteudo = "Completo";
      } 
      if (!empty($conteudo)) 
      { 
          $ind_sit_versao = $conteudo; 
      } 
   }  
}
?>
