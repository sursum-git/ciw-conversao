/* Execute original canonical TT suites against the candidate shared service. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
DEFINE VARIABLE suiteName AS CHARACTER NO-UNDO.
PROPATH='D:/opencode/conversao-sc/integration-src/purchase-items,D:/opencode/motor-progress/v2/tests/abl/purchase-orders,D:/opencode/motor-progress/v2/tests/abl/purchase-payments,D:/opencode/motor-progress/v2/tests/abl/container-panel,D:/opencode/motor-progress/v2/sursum-api/programs,D:/opencode/motor-progress/v2,' + PROPATH.
SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER). suiteName=ENTRY(2,SESSION:PARAMETER).
IF LOOKUP(suiteName,'PurchaseOrdersFinanceTest.p,PurchasePaymentsTest.p')=0 THEN QUIT.
RUN VALUE(suiteName).
QUIT.
