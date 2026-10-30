<?php
//__NM____NM__FUNCTION__NM__//
/**
 * Created by PhpStorm.
 * User: sursum_corda
 * Date: 08/08/2018
 * Time: 17:38
 */

function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
    //echo "<h1>tipo de Custo: $tipo</h1>";
    $vl = 0;
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_real';
            break;
        case 'tributado':
            $campo = 'pub.itens_proc_compra.vl_base_tributacao';
            break;
    }
    $aRetorno = retornoSimplesTb01('pub.itens_proc_compra', $campo ,
                                   " item_proc_compra_id = $itemProcCompraId","espec");
    if(is_array($aRetorno)){
        $vl =  $aRetorno[0][$campo];
    }
    return $vl;
}

function buscarItensContainerProcCompra($codProcFornec='', $container='')
{
    $tabela = 'PUB.procs_compra pc
        left outer join PUB.itens_proc_compra ipc
            on ipc.proc_compra_id = pc.proc_compra_id
        left outer join pub.itens_container ic
            on ipc.item_proc_compra_id = ic.item_proc_compra_id
        left outer join PUB."pp-container" c
            on ic.container_id = c."nr-container"';

    $campos = 'pc.proc_compra_id as pc_proc_compra_id,
        pc.empresa_id as pc_empresa_id,
        pc.qt_container as pc_qt_container,
        pc.cod_situacao as pc_cod_situacao,
        pc.cod_proc_fornec as pc_cod_proc_fornec,
        pc.qt_dias_translado as pc_qt_dias_translado,
        pc.cotacao_prevista as pc_cotacao_prevista,
        pc.observacao as pc_observacao,
        pc.dt_registro as pc_dt_registro,
        pc.fornecedor_id as pc_fornecedor_id,
        pc.dt_limite as pc_dt_limite,
        pc.log_facilid_contato_fornec as pc_log_facilid_contato_fornec,
        pc.nr_container_original as pc_nr_container_original,
        ipc.item_proc_compra_id as ipc_item_proc_compra_id,
        ipc.descricao as ipc_descricao,
        ipc.codigo_erp as ipc_codigo_erp,
        ipc.qt_dias_producao as ipc_qt_dias_producao,
        ipc.vl_base_tributacao as ipc_vl_base_tributacao,
        ipc.unid_medida as ipc_unid_medida,
        ipc.proc_compra_id as ipc_proc_compra_id,
        ipc.qt_comprada as ipc_qt_comprada,
        ipc.vl_custo_dolar as ipc_vl_custo_dolar,
        ipc.composicao as ipc_composicao,
        ipc.peso as ipc_peso,
        ipc.largura as ipc_largura,
        ipc.rolo as ipc_rolo,
        ipc.dt_prev_envio_desenhos as ipc_dt_prev_envio_desenhos,
        ipc.dt_real_envio_desenhos as ipc_dt_real_envio_desenhos,
        ipc.log_aprov_so_ld as ipc_log_aprov_so_ld,
        ipc.dt_prev_aprov_so_ld as ipc_dt_prev_aprov_so_ld,
        ipc.dt_real_aprov_so_ld as ipc_dt_real_aprov_so_ld,
        ipc.coloracao_id as ipc_coloracao_id,
        ipc.dt_maxima_producao as ipc_dt_maxima_producao,
        ipc.dt_mostruario as ipc_dt_mostruario,
        ipc.log_mostruario as ipc_log_mostruario,
        ipc.formato_amostra_id as ipc_formato_amostra_id,
        ipc.observacao as ipc_observacao,
        ipc.dt_cheg_amostras_emb as ipc_dt_cheg_amostras_emb,
        ipc.dt_prev_recbto_so_ld as ipc_dt_prev_recbto_so_ld,
        ipc.vl_cubagem as ipc_vl_cubagem,
        ipc.dt_recbto_laudo as ipc_dt_recbto_laudo,
        ipc.dt_recbto_embalagem as ipc_dt_recbto_embalagem,
        ipc.ind_producao_no_prazo as ipc_ind_producao_no_prazo,
        ipc.ind_relat_semanal_producao as ipc_ind_relat_semanal_producao,
        ipc.ind_laudo_antes_embarque as ipc_ind_laudo_antes_embarque,
        ipc.ind_qualid_emb as ipc_ind_qualid_emb,
        ipc.ind_prod_conf_pi as ipc_ind_prod_conf_pi,
        ipc.ind_rec_amostra_antes_emb as ipc_ind_rec_amostra_antes_emb,
        ipc.ind_qt_conf_proforma as ipc_ind_qt_conf_proforma,
        ipc.ind_tamanho_pecas_correto as ipc_ind_tamanho_pecas_correto,
        ipc.dt_real_recbto_so_ld as ipc_dt_real_recbto_so_ld,
        ipc.dt_termino_producao as ipc_dt_termino_producao,
        ic.container_id as ic_container_id,
        ic.item_proc_compra_id as ic_item_proc_compra_id,
        ic.qt_alocada as ic_qt_alocada,
        ic.item_container_id as ic_item_container_id,
        ic.qt_confirm_emb as ic_qt_confirm_emb,
        ic.qt_recbto_fisico as ic_qt_recbto_fisico,
        ic.log_rec_doc_prazo_emb as ic_log_rec_doc_prazo_emb,
        ic.observacao as ic_observacao,
        c."cod-estabel" as c_cod_estabel,
        c."nome-ab-forn" as c_nome_ab_forn,
        c."cod-emit-forn" as c_cod_emit_forn,
        c."dt-compra" as c_dt_compra,
        c."nr-container" as c_nr_container,
        c."dt-recebimento" as c_dt_recebimento,
        c."dt-prev-chegada" as c_dt_prev_chegada,
        c.situacao as c_situacao,
        c."vl-dolar-venda" as c_vl_dolar_venda,
        c."vl-dolar-compra" as c_vl_dolar_compra,
        c.medidas_container as c_medidas_container,
        c.dt_prev_embarque as c_dt_prev_embarque,
        c.dt_real_embarque as c_dt_real_embarque,
        c.situacao_container_id as c_situacao_container_id,
        c.ind_dt_embarque as c_ind_dt_embarque,
        c.ind_dt_prev_chegada as c_ind_dt_prev_chegada,
        c.log_pagto_final as c_log_pagto_final,
        c.cod_agente_cargas as c_cod_agente_cargas,
        c.cod_armador as c_cod_armador,
        c.exclusivo as c_exclusivo';

    $condicao = '1 = 1';

    if($codProcFornec <> ''){
        $codProcFornec = sc_sql_injection($codProcFornec);
        $condicao .= " and pc.cod_proc_fornec = $codProcFornec";
    }

    if($container <> ''){
        $container = sc_sql_injection($container);
        $condicao .= " and c.\"nr-container\" = $container";
    }

    $aRetorno = getDados('multi',$tabela,$campos,$condicao,'espec');
    return $aRetorno;
}



function buscarFornecItemProcCompra($itemProcCompra)
{
    $fornec = 0;
    $tabelas = "pub.itens_proc_compra, pub.procs_compra";
    $campos  = "fornecedor_id";
    $condicao = "pub.itens_proc_compra.item_proc_compra_id = $itemProcCompra and pub.itens_proc_compra.proc_compra_id = procs_compra.proc_compra_id ";
    $aRetorno = retornoSimplesTb01($tabelas,$campos, $condicao,"espec");
    if(is_array($aRetorno)){
        $fornec = $aRetorno[0]['fornecedor_id'];
    }
    if($fornec == ''){
        $fornec = 0;
    }
    return $fornec;
}
function buscarCustoItens($proc_compra_id,$tipo="negociado")
{
    $valor = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'pub.itens_proc_compra.vl_negociado';
            break;
        case 'proforma':
            $campo = 'pub.itens_proc_compra.vl_custo_real';
            break;
        case 'tributado':
            $campo = 'pub.itens_proc_compra.vl_base_tributacao';
            break;

    }
    $aRetorno = retornoSimplesTb01("pub.itens_proc_compra, pub.procs_compra",
                                   "sum(pub.procs_compra.cotacao_prevista * pub.itens_proc_compra.qt_comprada 
	  * $campo) as tot " , "  pub.procs_compra.proc_compra_id = pub.itens_proc_compra.proc_compra_id
	  and pub.procs_compra.proc_compra_id = $proc_compra_id","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    if($valor == ''){
        $valor = 0;
    }
    return $valor;
}

function buscarVlTribItens($proc_compra_id)
{
    $valor = 0;
    $aRetorno = retornoSimplesTb01("pub.itens_proc_compra", "sum(pub.itens_proc_compra.vl_base_tributacao * pub.itens_proc_compra.qt_comprada) as tot " , " pub.itens_proc_compra.proc_compra_id = $proc_compra_id ","espec");
    if(is_array($aRetorno)){
        $valor = $aRetorno[0]['tot'];
    }
    return $valor;

}
function buscarQtAlocItemProc($item_id)
{
    $qt = 0;
    //echo "valor do item dentro da função:$item_id<br>";
    $aRetorno = retornoSimplesTb01('pub.itens_container', 'sum(qt_alocada) as qt', " item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
        if($qt == ''){
            $qt = 0;
        }

    }
    else{
        $qt = 0;
    }
    return $qt;
}
function buscarQtSaldoItemProc($itemProcCompraId)
{
    $qtAlocada  = buscarQtAlocItemProc($itemProcCompraId);
    $qtComprada = buscarQtCompradaItemProc($itemProcCompraId);
    $qtSaldo = $qtComprada  - $qtAlocada ;
    return $qtSaldo;

}
function buscarQtCompradaItemProc($itemProcCompraId)
{
    $qt = 0;
    $aRetorno = retornoSimplesTb01('pub.itens_proc_compra', 'qt_comprada', " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt_comprada'];
    }
    return $qt;
}
function buscarItemAlocado($container_id,$item_id)
{
    $log = false;
    $aRetorno = retornoSimplesTb01('pub.itens_container', 'item_container_id', " container_id = $container_id and item_proc_compra_id = $item_id ","espec");
    if(is_array($aRetorno)){
        $log = true;
    }
    return $log;
}
function buscarPonderacaoItensProcCompra($procCompraID,$tipo='negociado',$itemProcCompraId=0)
{
    $vlTot = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_dolar';
            break;
    }
    if($itemProcCompraId <> 0){
       $condItem = " and item_proc_compra_id = $itemProcCompraId ";
    }else{
        $condItem = '';
    }
    $aRetorno = retornoSimplesTb01('pub.itens_proc_compra',
        "sum($campo * qt_comprada) as tot",
        " proc_compra_id = $procCompraID $condItem","espec");
    if(is_array($aRetorno)){
        $vlTot =  $aRetorno[0]['tot'];
    }
    return $vlTot;
}
function buscarVlProcCompraAtu($procCompraID,$tipo='negociado')
{
    $vlTot = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_dolar';
            break;
    }
    $aRetorno = retornoMultReg('pub.itens_proc_compra ipc',
                               "ipc.item_proc_compra_id, ipc.vl_negociado * ipc.qt_comprada as vl_comprada, 
                  ipc.vl_negociado * coalesce(ic.qt_confirm_emb,0) as vl_embarcada ",
                               " proc_compra_id = $procCompraID ",
                               "espec",
                               "left outer join pub.itens_container ic on ic.item_proc_compra_id = ipc.item_proc_compra_id ");
    if(is_array($aRetorno)){
        $qt = count($aRetorno);
        $vlTot = 0;
        for($i=0;$i < $qt; $i++){
            $vlComprada  = $aRetorno[$i]['vl_comprada'];
            $vlEmbarcada = $aRetorno[$i]['vl_embarcada'];
            if($vlEmbarcada <> 0){
                $vlTot += $vlEmbarcada;
            }else{
                $vlTot += $vlComprada;
            }
        }
    }
    return $vlTot;
}

/*function buscarVlItemProcCompra($itemProcCompraId,$tipo='negociado')
{
    $vl = 0;
    $campo = '';
    switch($tipo){
        case 'negociado':
            $campo = 'vl_negociado';
            break;
        case 'proforma':
            $campo = 'vl_custo_dolar';
            break;
    }
    $aRetorno = retornoSimplesTb01('pub.itens_proc_compra', $campo,
        " item_proc_compra_id = $itemProcCompraId","espec");
    if(is_array($aRetorno)){
        $vl =  $aRetorno[0][$campo];
    }
    return $vl;
}*/
function buscarProcCompraItem($itemProcCompraId)
{
    //echo "itemProcCompraId:$itemProcCompraId<br>";
    $procCompra = 0;
    $campo   = 'proc_compra_id';
    $aRetorno = retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $procCompra = $aRetorno[0][$campo];
    }
    return $procCompra;
}
function buscarCodItemERP($itemProcCompraId)
{
    $item = '';
    $campo   = 'codigo_erp';
    $aRetorno = retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $item = $aRetorno[0][$campo];
    }
    return $item;

}

function buscarDescItemProcCompra($itemProcCompraId)
{
    $descricao = '';
    $campo   = 'descricao';
    $aRetorno = retornoSimplesTb01(" pub.itens_proc_compra ",  $campo , " item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $descricao = $aRetorno[0][$campo];
    }
    return $descricao;

}

function buscarContainersItemProcCompra($item_id)
{
    $aRetorno = retornoSimplesTb01('pub.itens_container', 'container_id', "  item_proc_compra_id = $item_id ","espec");

    return $aRetorno;
}

function buscarQtAlocadaItemProcCompra($itemProcCompraId)
{
    $qt = 0;
    $aRetorno = retornoSimplesTb01(' pub.itens_container ', ' sum(qt_alocada) as qt ', "  item_proc_compra_id = $itemProcCompraId ","espec");
    if(is_array($aRetorno)){
        $qt = $aRetorno[0]['qt'];
    }
    if($qt == ''){
        $qt = 0;
    }
    return $qt;
}

/*
function sugerirDtPrevAprovacao($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
	$dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;
	//$qtDias = buscarParametroIma('QT_DIAS_PREV_CHEG_AMOSTRA_SO');

	if($qtDias <> 0 and $qtDias <> ''){
		$dtPrevRecbtoAmostras = sc_date($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0);
	}
	return 	$dtPrevRecbtoAmostras;
}
*/

function sugerirDtPrevRecbtoSoLd($dtRealEnvioDesenhos,$qtDiasCalcSoLd)
{
    $dtPrevRecbtoAmostras = $dtRealEnvioDesenhos;
    //$qtDias = buscarParametroIma('QT_DIAS_PREV_CHEG_AMOSTRA_SO');

    if($qtDiasCalcSoLd <> 0 and $qtDiasCalcSoLd <> ''){
        $dtPrevRecbtoAmostras = sc_date($dtRealEnvioDesenhos, "yyyy-mm-dd", "+", $qtDiasCalcSoLd,0, 0);
    }
    return 	$dtPrevRecbtoAmostras;
}

function sugerirDtMaximaProducao($dtRealAprovSoLd,$qtDiasProd)
{

    $dtMaximaProducao = $dtRealAprovSoLd;
    if($qtDiasProd <> 0 and $qtDiasProd <> ''){
        $dtMaximaProducao = sc_date($dtRealAprovSoLd,"yyyy-mm-dd","+",$qtDiasProd,0,0);
    }
    return $dtMaximaProducao;
}

function sugerirDtPrevEmbarque($dtFinalProducao)
{
    $dtPrevEmbarque = $dtFinalProducao;
    $qtDias = buscarParametroIma('QT_DIAS_PREV_EMBARQUE');
    if($qtDias <> 0 and $qtDias <> ''){
        $dtPrevEmbarque = sc_date($dtFinalProducao,"yyyy-mm-dd","+",$qtDias,0,0);
    }
    return $dtPrevEmbarque;
}


function retornarCampoItemProcCompra($itemProcCompraId,$campos='')
{
    if($campos == ''){
        $aCampos = getCpsTbSessao('espec','itens_proc_compra');
        $campos = $aCampos['campos'];
        //echo "$campos<br>";
    }
    $aRetorno = retornoSimplesTb01(' pub.itens_proc_compra ', $campos , "  item_proc_compra_id = $itemProcCompraId ","espec");
    return $aRetorno;
}

function getIDItensProcCompra($procCompra)
{
    $aRetorno = retornoMultReg(' pub.itens_proc_compra ', 'item_proc_compra_id' ,
        "  proc_compra_id = $procCompra ","espec");
    return $aRetorno;

}
function validarItemMesmoCodigoPrecoDif($idCorrente,$itCodigo,$procCompraId,$vlCustoDolar,$vlBaseTributacao,$vlNegociado)
{
    $msg = '';
    $aRet = getDados('unico','pub.itens_proc_compra',
        'top 1 item_proc_compra_id as item_proc_compra_id,vl_custo_dolar,vl_base_tributacao,vl_negociado',
    "proc_compra_id =$procCompraId and codigo_erp = '$itCodigo' and item_proc_compra_id <> $idCorrente and codigo_erp <> ''
    ");
    if(is_array($aRet)){
        $aRet = $aRet[0];
        $idItemProcCompra = $aRet['item_proc_compra_id'];
        if($aRet['vl_custo_dolar'] <> $vlCustoDolar and $aRet['vl_custo_dolar'] <> 0 ){
            //echo "<h1>custo dolar ant.".$aRet['vl_custo_dolar']." - custo dolar item alterado/criado:$vlCustoDolar</h1>";
            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de custo de dolar diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_base_tributacao'] <> $vlBaseTributacao and $aRet['vl_base_tributacao'] <> 0){

            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor de base de tributação diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");

        }
        if($aRet['vl_negociado'] <> $vlNegociado and $aRet['vl_negociado'] <> 0){

            $msg = util_incr_valor($msg,
                "Já existe um item com o mesmo CÓDIGO para este pedido de importação(item ID $idItemProcCompra) com o valor negociado diferente.
                 Itens com o mesmo código não podem ter valores unitários diferentes. ","<br>");
        }

    }
    return $msg;
}

function updateDtCertificacaoItem($idItemProcCompra,$data){


	$dateTime = new \DateTime($data);
    $dateTime->setTimezone(new \DateTimeZone('America/Sao_Paulo'));

    $dataFormatada = $dateTime->format('Y-m-d H:i:s');
	
	/*$dataFormatada = DateTime::createFromFormat('Ymd', $data)
                    ->format('d/m/Y');*/

	$cmd = "update pub.itens_proc_compra set dt_item_certificacao = '$dataFormatada' 
            where item_proc_compra_id = $idItemProcCompra ";
    sc_exec_sql($cmd,"especw");
}

?>
