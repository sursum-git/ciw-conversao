PROPATH='C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison,C:/Users/tadeu.parreiras/codex-ciw-completion-20261028-build13-comparison/sursum-api/programs,' + OS-GETENV('CIW_COMPILE_NETLIB') + ',' + PROPATH.
IF NUM-DBS<>0 THEN QUIT.
SESSION:NUMERIC-FORMAT=ENTRY(1,SESSION:PARAMETER).
RUN VALUE(ENTRY(2,SESSION:PARAMETER)).
QUIT.
