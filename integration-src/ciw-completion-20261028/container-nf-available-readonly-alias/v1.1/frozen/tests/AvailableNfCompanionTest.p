/* Combined isolated suite; fixed children, no connected DB or production invocation. */
BLOCK-LEVEL ON ERROR UNDO, THROW.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
RUN AvailableNfAliasTest.r.
RUN AvailableNfTimeoutTest.r.
RUN ContainerNfAvailableTest.r.
IF NUM-DBS<>0 THEN UNDO, THROW NEW Progress.Lang.AppError('Connected DB forbidden',1).
OUTPUT TO VALUE('nf-companion-' + SESSION:NUMERIC-FORMAT + '.log'). PUT UNFORMATTED 'PASS 59 checks NUMDBS=' NUM-DBS SKIP. OUTPUT CLOSE.
