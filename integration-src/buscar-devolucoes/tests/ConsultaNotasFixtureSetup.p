BLOCK-LEVEL ON ERROR UNDO,THROW.
IF NUM-DBS<>1 OR INDEX(PDBNAME(1),"consulta-notas-fixture")=0 THEN
    UNDO,THROW NEW Progress.Lang.AppError("Fixture exclusiva obrigatoria",1).
IF CAN-FIND(FIRST devolfixture.nota-fiscal) OR CAN-FIND(FIRST espec.wp) THEN
    UNDO,THROW NEW Progress.Lang.AppError("Fixture deve estar vazia",1).
DO TRANSACTION ON ERROR UNDO,THROW:
    {tests/ConsultaNotasFixtureSetup.i}
END.
