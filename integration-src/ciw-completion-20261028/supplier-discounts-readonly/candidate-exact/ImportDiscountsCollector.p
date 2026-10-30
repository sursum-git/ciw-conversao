/* One read-only aggregate for the legacy global list, detail and owned ledger. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
{sursum-api/includes/ImportDiscountsReadTables.i}
DEFINE INPUT PARAMETER phDiscounts AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER phLedger AS HANDLE NO-UNDO.
DEFINE INPUT PARAMETER piSelectedId AS INTEGER NO-UNDO.
DEFINE INPUT PARAMETER piStarted AS INTEGER NO-UNDO.
DEFINE INPUT PARAMETER piMaxRows AS INTEGER NO-UNDO.
DEFINE INPUT-OUTPUT PARAMETER piRowsRead AS INTEGER NO-UNDO.
DEFINE OUTPUT PARAMETER TABLE FOR ttImportDiscountsRead.
DEFINE OUTPUT PARAMETER TABLE FOR ttImportDiscountLedgerRead.
DEFINE VARIABLE piSupplierId AS INTEGER NO-UNDO INITIAL ?.
{sursum-api/includes/ImportDiscountsCollectorBody.i}
