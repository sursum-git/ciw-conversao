PROCEDURE Fixture:
 DEFINE OUTPUT PARAMETER oFixture AS JsonObject NO-UNDO.
 DEFINE VARIABLE oParser AS ObjectModelParser NO-UNDO.
 DEFINE VARIABLE lcJson AS LONGCHAR NO-UNDO.
 FIX-CODEPAGE(lcJson)='UTF-8'.
 lcJson='~{"mode":"itens","currency":"real","calculationBasis":"current",' +
 '"container":~{"nr-container":123,"ordem_busca_dolar_compra":"2,1","ordem_busca_dolar_di":"4,1","cod_tipo_proj_dolar":1,"vl_proj_dolar":0,"vl-dolar-compra":5,"vl_dolar_di":4.8,"log_versao_custo_desatualizada":false},' +
 '"quotation":~{"valor":4.9,"data":"2026-10-16"},"payments":~{"real":1000,"dolar":200},' +
 '"discounts":~{"credito_real":0,"credito_dolar":0,"total_real":0,"total_dolar":0},' +
 '"expenses":~{"tributado":100,"proforma":150,"negociado":200},"items":[' +
 '~{"item_container_id":1,"qt_alocada":10,"qt_confirm_emb":0,"qt_recbto_fisico":0,"vl_base_tributacao":100,"vl_custo_dolar":90,"vl_negociado":80,"despesa_item":~{"tributado":30,"proforma":30,"negociado":40},"distribuicao_real":100,"desconto_real":20,"desconto_dolar":10,"erp_real":~{"vl_custo":1000,"vl_desp":200,"perc_rateio":0.6}},' +
 '~{"item_container_id":2,"qt_alocada":20,"qt_confirm_emb":0,"qt_recbto_fisico":0,"vl_base_tributacao":50,"vl_custo_dolar":45,"vl_negociado":40,"despesa_item":~{"tributado":20,"proforma":20,"negociado":10},"distribuicao_real":0,"desconto_real":0,"desconto_dolar":0,"erp_real":null}]}'.
 oParser=NEW ObjectModelParser(). oFixture=CAST(oParser:Parse(lcJson),JsonObject).
 DELETE OBJECT oParser.
END PROCEDURE.
