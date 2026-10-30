from pathlib import Path
import json
r=Path(__file__).resolve().parents[2];c=r/'integration-src/purchase-quantity-periods';motor=Path('D:/opencode/motor-progress/v2')
assert 'FAIL RED missing period projection' in (r/'.runtime/purchase-quantity-periods-20261028/build5/compiled122/quantity-period-service-UTF-8-AMERICAN.log').read_text()
(c/'includes').mkdir(exist_ok=True);(c/'abl').mkdir(exist_ok=True)
s=(motor/'sursum-api/programs/PurchaseImportQuantitiesService.p').read_text(encoding='utf-8-sig')
a=s.index('DEFINE TEMP-TABLE ttQuantityRead');z=s.index('DEFINE VARIABLE purchaseContextCode')
schema=s[a:z].replace(' INDEX pk IS PRIMARY UNIQUE', ' FIELD dt_termino_producao AS DATE FIELD dt_prev_termino_producao AS DATE FIELD dt_maxima_producao AS DATE\n INDEX pk IS PRIMARY UNIQUE')
(c/'includes/PurchaseImportQuantitiesTable.i').write_text(schema,encoding='utf-8')
s=s[:a]+'{sursum-api/includes/PurchaseImportQuantitiesTable.i}\nDEFINE OUTPUT PARAMETER TABLE FOR ttQuantityRead.\nDEFINE OUTPUT PARAMETER piCompanyId AS INTEGER NO-UNDO.\n'+s[z:]
optional='''FUNCTION ItemDate RETURNS DATE(fieldName AS CHARACTER):
 DEFINE VARIABLE h AS HANDLE NO-UNDO.
 h=phItems:BUFFER-FIELD(fieldName) NO-ERROR.
 IF NOT VALID-HANDLE(h) THEN RETURN ?.
 IF h:DATA-TYPE<>'DATE' THEN RUN Fail('PURCHASE_QUANTITY_CONFIGURATION',503,'Campo de data invalido.').
 RETURN h:BUFFER-VALUE.
END FUNCTION.
'''
s=s.replace('PROCEDURE AppendRow:',optional+'PROCEDURE AppendRow:',1)
s=s.replace("ttQuantityRead.dt_registro=phOrders:BUFFER-FIELD('dt_registro'):BUFFER-VALUE", "ttQuantityRead.dt_termino_producao=ItemDate('dt_termino_producao') ttQuantityRead.dt_prev_termino_producao=ItemDate('dt_prev_termino_producao') ttQuantityRead.dt_maxima_producao=ItemDate('dt_maxima_producao')\n  ttQuantityRead.dt_registro=phOrders:BUFFER-FIELD('dt_registro'):BUFFER-VALUE",1)
s=s.replace(" readPath=SEARCH('sursum-api/programs/CiwErpReadService.r').",'')
s=s.replace(' OR readPath=?','')
start=s.index(' requestCopy=CAST(poRequest:Clone(),JsonObject).')
end=s.index(' CATCH e AS Progress.Lang.Error:',start)
s=s[:start]+" piCompanyId=companyId. poResponse=NEW JsonObject(). poResponse:Add('success',TRUE).\n"+s[end:]
s=s.replace('  poResponse=NEW JsonObject(). poResponse:Add(\'success\',FALSE).',"  EMPTY TEMP-TABLE ttQuantityRead.\n  poResponse=NEW JsonObject(). poResponse:Add('success',FALSE).",1)
(c/'abl/PurchaseImportQuantitiesCollector.p').write_text(s,encoding='utf-8')
header=s[:s.index('{sursum-api/includes/PurchaseImportQuantitiesTable.i}')]
wrapper=header+'''{sursum-api/includes/PurchaseImportQuantitiesTable.i}
DEFINE VARIABLE collectorPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE readerPath AS CHARACTER NO-UNDO.
DEFINE VARIABLE companyId AS INTEGER NO-UNDO.
DEFINE VARIABLE clean AS JsonObject NO-UNDO.
DEFINE VARIABLE err AS JsonObject NO-UNDO.
DO ON ERROR UNDO, THROW:
 collectorPath=SEARCH('sursum-api/programs/PurchaseImportQuantitiesCollector.r'). readerPath=SEARCH('sursum-api/programs/CiwErpReadService.r').
 IF collectorPath=? OR readerPath=? THEN UNDO,THROW NEW Progress.Lang.AppError('Coletor indisponivel.',1).
 RUN VALUE(collectorPath)(phOrders,phCompanies,phItems,phAllocations,phContainers,phSituations,poRequest,OUTPUT poResponse,OUTPUT TABLE ttQuantityRead,OUTPUT companyId).
 IF NOT poResponse:GetLogical('success') THEN RETURN.
 clean=CAST(poRequest:Clone(),JsonObject). IF clean:Has('proc_compra_id') THEN clean:Remove('proc_compra_id').
 RUN VALUE(readerPath)(INPUT BUFFER ttQuantityRead:HANDLE,'proc_compra_quantidades',TRIM(STRING(companyId,'->>>>>>>>>9')),clean,OUTPUT poResponse).
 CATCH e AS Progress.Lang.Error:
  poResponse=NEW JsonObject(). poResponse:Add('success',FALSE). err=NEW JsonObject(). err:Add('code','PURCHASE_QUANTITY_CONFIGURATION'). err:Add('status',503). err:Add('message','Consulta de quantidades indisponivel.'). poResponse:Add('error',err).
 END CATCH.
END.
'''
(c/'abl/PurchaseImportQuantitiesService.p').write_text(wrapper,encoding='utf-8')
rule=c/'abl/PurchaseQuantityPeriodRules.p';text=rule.read_text();a=text.index('FUNCTION ReadDate RETURNS DATE');z=text.index('FUNCTION InRange RETURNS LOGICAL',a);text=text[:a]+'{sursum-api/includes/PurchaseQuantityPeriodDates.i}\n'+text[z:];text=text.replace('ReadDate(', 'PurchasePeriodDate(');rule.write_text(text,encoding='utf-8')
reader=(motor/'sursum-api/programs/CiwErpReadService.p').read_text(encoding='utf-8-sig')
columns='row_key,empresa_id,cod_situacao,pedido_fornec,vl_negociado,qt_comprada,qt_confirmada_embarque,qt_recbto_fisico,qt_rec_final,vl_rec_final,qt_comprada_final,vl_comprada_final,nr_container,situacao_container,dt_registro,dt_recebimento,dt_prev_chegada,codigo_erp,desc_item_fornec,desc_situacao_container'
branch="""  WHEN 'proc_compra_quantidades_periodo_med' THEN DO:
   IF pcCompany=? OR pcCompany='' THEN RUN Fail('CIW_ERP_COMPANY_UNAVAILABLE',503).
   ASSIGN cFieldList='COLUMNS' cAliasList=cFieldList cKeyList='row_key'
    baseWhere=b:NAME + '.empresa_id = ' + NumText(DECIMAL(pcCompany)).
  END.
""".replace('COLUMNS',columns)
reader=reader.replace("  WHEN 'proc_compra_quantidades' THEN DO:",branch+"  WHEN 'proc_compra_quantidades' THEN DO:",1)
(c/'abl/CiwErpReadService.p').write_text(reader,encoding='utf-8')
dispatcher=(motor/'sursum-api/programs/CiwCadastrosCrud.p').read_text(encoding='utf-8-sig')
branch='''  WHEN "proc_compra_quantidades_periodo_med" THEN DO:
   cService=SEARCH("sursum-api/programs/PurchaseQuantityPeriodsApi.r").
   IF cService=? THEN UNDO,THROW NEW Progress.Lang.AppError("Consulta por periodo indisponivel",0).
   RUN VALUE(cService)(poRequest,OUTPUT poResponse). RETURN.
  END.
'''
dispatcher=dispatcher.replace('  WHEN "proc_compra_quantidades" THEN DO:',branch+'  WHEN "proc_compra_quantidades" THEN DO:',1)
(c/'abl/CiwCadastrosCrud.p').write_text(dispatcher,encoding='utf-8')
print('Prepared single shared collector/schema,compatible base adapter,closed reader/dispatcher additions;canonicals unchanged')
