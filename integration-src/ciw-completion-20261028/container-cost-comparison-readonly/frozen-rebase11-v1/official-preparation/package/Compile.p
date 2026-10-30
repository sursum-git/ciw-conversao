DEFINE VARIABLE n AS INTEGER NO-UNDO.
DEFINE VARIABLE failed AS LOGICAL NO-UNDO.
PROPATH='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison,C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs,' + OS-GETENV('CIW_COMPILE_NETLIB') + ',' + PROPATH.
OUTPUT TO 'compile.log'.
PUT UNFORMATTED 'OpenEdge ' PROVERSION ' NUM-DBS=' NUM-DBS SKIP.
IF NUM-DBS<>1 OR NOT (PROVERSION BEGINS '12.2') THEN DO: PUT UNFORMATTED 'FAIL ENVIRONMENT' SKIP. OUTPUT CLOSE. QUIT. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CiwErpReadService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CiwErpReadService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CiwCadastrosCrud.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CiwCadastrosCrud.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionHistoryLabels.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionHistoryLabels.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionHistoryService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionHistoryService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionAuxHistoryService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionAuxHistoryService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ImportDiscountsCollector.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ImportDiscountsCollector.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ImportDiscountsReadService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ImportDiscountsReadService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CostDistributionEligibleCollector.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CostDistributionEligibleCollector.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CostDistributionEligibleReadService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CostDistributionEligibleReadService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CostDistributionLedgerCollector.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CostDistributionLedgerCollector.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/CostDistributionLedgerReadService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/CostDistributionLedgerReadService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/SampleContainerItemsCollector.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/SampleContainerItemsCollector.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/SampleContainerItemsReadService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/SampleContainerItemsReadService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionComparisonProjection.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionComparisonProjection.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionComparisonMaterializer.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionComparisonMaterializer.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionComparisonService.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionComparisonService.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersVersionComparisonApi.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersVersionComparisonApi.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs/ContainersCustoCalculator.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs' NO-ERROR.
PUT UNFORMATTED 'sursum-api/programs/ContainersCustoCalculator.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonProjectionTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonProjectionTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonRoundingEvidenceTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonRoundingEvidenceTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonItemJoinTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonItemJoinTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonMaterializerTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonMaterializerTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonReaderTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonReaderTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonSqlObservedTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonSqlObservedTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ComparisonServiceTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ComparisonServiceTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ContainersVersionHistoryTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ContainersVersionHistoryTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ContainersVersionTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ContainersVersionTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/CiwErpReadTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'CiwErpReadTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/PurchaseItemsReadTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'PurchaseItemsReadTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ContainersVersionAuxHistoryTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ContainersVersionAuxHistoryTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ImportDiscountsLabelsTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ImportDiscountsLabelsTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ImportDiscountsReadTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ImportDiscountsReadTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/CostDistributionEligibleTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'CostDistributionEligibleTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/CostDistributionLedgerTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'CostDistributionLedgerTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ItemCostManualReadTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ItemCostManualReadTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/SampleContainerItemsTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'SampleContainerItemsTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ExpenseTaxRelationsReadTest.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ExpenseTaxRelationsReadTest.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
COMPILE 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/ContainersVersionFixture.p' SAVE INTO 'C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison' NO-ERROR.
PUT UNFORMATTED 'ContainersVersionFixture.p ERROR=' COMPILER:ERROR SKIP.
IF COMPILER:ERROR THEN failed=TRUE.
DO n=1 TO ERROR-STATUS:NUM-MESSAGES: PUT UNFORMATTED 'CODE=' ERROR-STATUS:GET-NUMBER(n) SKIP. END.
IF failed THEN PUT UNFORMATTED 'FAIL COMPILE' SKIP. ELSE PUT UNFORMATTED 'PASS COMPILE ALL 39' SKIP.
OUTPUT CLOSE. QUIT.
