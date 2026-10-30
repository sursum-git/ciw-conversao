<?php
class cons_descontos_imp_geral_lookup
{
//  
   function lookup_di_motivo_desconto_id(&$conteudo , $di_motivo_desconto_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $di_motivo_desconto_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($di_motivo_desconto_id) === "" || trim($di_motivo_desconto_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.motivos_desconto where motivo_desconto_id = $di_motivo_desconto_id order by descricao" ; 
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
   function lookup_valor_utilizado(&$conteudo , $di_desconto_importacao_id, &$nm_array_retorno_lookup) 
   {
      $nm_array_retorno_lookup = array();
      if (trim($di_desconto_importacao_id) === "")
      { 
          $conteudo = "&nbsp;";
          return ; 
      } 
      $conteudo = "";
      $nm_comando = "select sum(valor_utilizado) from
pub.cta_corren_desconto
where desconto_importacao_id = $di_desconto_importacao_id" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
      { 
          $y = 0; 
          $a = 0; 
          while (!$rx->EOF) 
          { 
                 if (isset($rx->fields[0]))
                 { 
                     $rx->fields[0] = str_replace(',', '.', $rx->fields[0]); 
                     $nm_array_retorno_lookup[$a][0] = $rx->fields[0];
                     $a++; 
                     if ($y == 1)
                     { 
                          $conteudo .= "<br>";
                          $y = 0; 
                     } 
                     if ($y != 0)
                     { 
                          $conteudo .= "";
                     } 
                     $y++; 
                     $nm_tmp_form = $rx->fields[0]; 
                     $conteudo .= $nm_tmp_form;
                 } 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
   } 
}
?>
