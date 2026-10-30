<?php
class cons_cta_corren_fornec_imp_embarcado_lookup
{
//  
   function lookup_cta_fornecedor_id(&$conteudo , $cta_fornecedor_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cta_fornecedor_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\",'-', \"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
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
   function lookup_item_proc_compra_id(&$conteudo , $item_proc_compra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $item_proc_compra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(descricao,' ', codigo_erp)  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT descricao&' '&codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
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
   function lookup_cta_cod_tipo_movto(&$cta_cod_tipo_movto) 
   {
      $conteudo = "" ; 
      if ($cta_cod_tipo_movto == "1")
      { 
          $conteudo = "Saldo Anterior";
      } 
      if ($cta_cod_tipo_movto == "2")
      { 
          $conteudo = "Ajuste Manual";
      } 
      if ($cta_cod_tipo_movto == "3")
      { 
          $conteudo = "Itens Pedido";
      } 
      if ($cta_cod_tipo_movto == "4")
      { 
          $conteudo = "Pgtos Pedido";
      } 
      if ($cta_cod_tipo_movto == "5")
      { 
          $conteudo = "Pgtos Container";
      } 
      if ($cta_cod_tipo_movto == "6")
      { 
          $conteudo = "Desc.Solicitado";
      } 
      if ($cta_cod_tipo_movto == "7")
      { 
          $conteudo = "Desconto Autorizado";
      } 
      if ($cta_cod_tipo_movto == "8")
      { 
          $conteudo = "Desconto Utilizado";
      } 
      if ($cta_cod_tipo_movto == "9")
      { 
          $conteudo = "Rateio Entre Fornecedores";
      } 
      if ($cta_cod_tipo_movto == "10")
      { 
          $conteudo = "Confirmação Qt. Embarcada";
      } 
      if (!empty($conteudo)) 
      { 
          $cta_cod_tipo_movto = $conteudo; 
      } 
   }  
//  
   function lookup_cta_cod_acao(&$cta_cod_acao) 
   {
      $conteudo = "" ; 
      if ($cta_cod_acao == "1")
      { 
          $conteudo = "Inclusão";
      } 
      if ($cta_cod_acao == "2")
      { 
          $conteudo = "Alteração";
      } 
      if ($cta_cod_acao == "3")
      { 
          $conteudo = "Exclusão";
      } 
      if (!empty($conteudo)) 
      { 
          $cta_cod_acao = $conteudo; 
      } 
   }  
//  
   function lookup_cta_num_id_tit_ap(&$conteudo , $cta_num_id_tit_ap) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cta_num_id_tit_ap; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;" || trim($cta_num_id_tit_ap) === "" || trim($cta_num_id_tit_ap) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT cod_tit_ap + '-' + cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(cod_tit_ap, '-', cod_parcela)  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT cod_tit_ap&'-'&cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT cod_tit_ap||'-'||cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT cod_tit_ap + '-' + cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_ems5['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT cod_tit_ap||'-'||cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT cod_tit_ap||'-'||cod_parcela  FROM PUB.tit_ap where num_id_tit_ap = $cta_num_id_tit_ap order by cod_tit_ap, cod_parcela" ; 
      } 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Ini->nm_db_ems5->Execute($nm_comando)) 
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
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Ini->nm_db_ems5->ErrorMsg()); 
          exit; 
      } 
      if ($conteudo === "") 
      { 
          $conteudo = "&nbsp;";
          $save_conteudo1 = $conteudo ; 
      } 
   }  
//  
   function lookup_container_situacao_container_id(&$conteudo , $container_situacao_container_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $container_situacao_container_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($container_situacao_container_id) === "" || trim($container_situacao_container_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      $nm_comando = "select descricao from PUB.situacoes_container where situacao_container_id = $container_situacao_container_id order by descricao" ; 
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
   function lookup_itens_ped_proc_compra_id(&$conteudo , $itens_ped_proc_compra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $itens_ped_proc_compra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select cod_proc_fornec from PUB.procs_compra where proc_compra_id = '" . substr($this->Db->qstr($itens_ped_proc_compra_id), 1 , -1) . "' order by cod_proc_fornec" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
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
   function lookup_q_fornec_cta_fornecedor_id(&$conteudo , $cta_fornecedor_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $cta_fornecedor_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;" || trim($cta_fornecedor_id) === "" || trim($cta_fornecedor_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(\"nome-abrev\",'-', \"nome-emit\")  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT \"nome-abrev\"&'-'&\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT \"nome-abrev\" + '-' + \"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_con_comum['tpbanco']), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT \"nome-abrev\"||'-'||\"nome-emit\"  FROM PUB.emitente where \"cod-emitente\" = $cta_fornecedor_id order by \"nome-abrev\", \"nome-emit\"" ; 
      } 
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
   function lookup_q_fornec_item_proc_compra_id(&$conteudo , $item_proc_compra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $item_proc_compra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      if (trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;" || trim($item_proc_compra_id) === "" || trim($item_proc_compra_id) == "&nbsp;")
      { 
          $conteudo = "&nbsp;";
          $save_conteudo  = ""; 
          $save_conteudo1 = ""; 
          return ; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(descricao,' ', codigo_erp)  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT descricao&' '&codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT descricao + ' ' + codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT descricao||' '||codigo_erp  FROM PUB.itens_proc_compra where item_proc_compra_id = $item_proc_compra_id order by descricao, codigo_erp" ; 
      } 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
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
   function lookup_q_fornec_itens_ped_proc_compra_id(&$conteudo , $itens_ped_proc_compra_id) 
   {   
      static $save_conteudo = "" ; 
      static $save_conteudo1 = "" ; 
      $tst_cache = $itens_ped_proc_compra_id; 
      if ($tst_cache === $save_conteudo && $conteudo != "&nbsp;") 
      { 
          $conteudo = $save_conteudo1 ; 
          return ; 
      } 
      $save_conteudo = $tst_cache ; 
      $nm_comando = "select cod_proc_fornec from PUB.procs_compra where proc_compra_id = '" . substr($this->Db->qstr($itens_ped_proc_compra_id), 1 , -1) . "' order by cod_proc_fornec" ; 
      $conteudo = "" ; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rx = $this->Db->Execute($nm_comando)) 
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
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
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
