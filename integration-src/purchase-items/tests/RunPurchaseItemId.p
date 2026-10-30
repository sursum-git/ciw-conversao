BLOCK-LEVEL ON ERROR UNDO, THROW.
PROPATH='D:/opencode/conversao-sc/integration-src/purchase-items/tests,D:/opencode/conversao-sc/integration-src/purchase-items,D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=IF SESSION:PARAMETER='' THEN 'AMERICAN' ELSE SESSION:PARAMETER.
RUN PurchaseItemIdTest.p.
QUIT.
