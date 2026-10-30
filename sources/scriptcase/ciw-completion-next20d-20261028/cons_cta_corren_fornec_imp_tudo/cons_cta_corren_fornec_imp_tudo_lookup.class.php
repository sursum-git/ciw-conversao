<?php
class cons_cta_corren_fornec_imp_tudo_lookup
{
//  
   function lookup_cod_tipo_movto(&$cod_tipo_movto) 
   {
      $conteudo = "" ; 
      if ($cod_tipo_movto == "1")
      { 
          $conteudo = "Saldo Anterior";
      } 
      if ($cod_tipo_movto == "2")
      { 
          $conteudo = "Ajuste Manual";
      } 
      if ($cod_tipo_movto == "3")
      { 
          $conteudo = "Itens Pedido";
      } 
      if ($cod_tipo_movto == "4")
      { 
          $conteudo = "Pgtos Pedido";
      } 
      if ($cod_tipo_movto == "5")
      { 
          $conteudo = "Pgtos Container";
      } 
      if ($cod_tipo_movto == "6")
      { 
          $conteudo = "Desc.Solicitado";
      } 
      if ($cod_tipo_movto == "7")
      { 
          $conteudo = "Desconto Autorizado";
      } 
      if ($cod_tipo_movto == "8")
      { 
          $conteudo = "Desconto Utilizado";
      } 
      if ($cod_tipo_movto == "9")
      { 
          $conteudo = "Rateio Entre Fornecedores";
      } 
      if ($cod_tipo_movto == "10")
      { 
          $conteudo = "Confirmação Qt. Embarcada";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_tipo_movto = $conteudo; 
      } 
   }  
//  
   function lookup_cod_acao(&$cod_acao) 
   {
      $conteudo = "" ; 
      if ($cod_acao == "1")
      { 
          $conteudo = "Inclusão";
      } 
      if ($cod_acao == "2")
      { 
          $conteudo = "Alteração";
      } 
      if ($cod_acao == "3")
      { 
          $conteudo = "Exclusão";
      } 
      if ($cod_acao == "0")
      { 
          $conteudo = "N/A";
      } 
      if (!empty($conteudo)) 
      { 
          $cod_acao = $conteudo; 
      } 
   }  
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
      $nm_comando = "select \"nome-abrev\" from PUB.emitente where \"cod-emitente\" = $fornecedor_id order by \"nome-abrev\"" ; 
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
   function lookup_q_fornecedor_fornecedor_id(&$conteudo , $fornecedor_id) 
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
      $nm_comando = "select \"nome-abrev\" from PUB.emitente where \"cod-emitente\" = $fornecedor_id order by \"nome-abrev\"" ; 
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
}
?>
