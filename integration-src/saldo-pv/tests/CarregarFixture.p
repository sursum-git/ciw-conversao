IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "saldo-pv-fixture") = 0 THEN QUIT.
RUN prodict/load_df.p ("tests/FixtureSaldoPV.df").
RUN prodict/load_df.p ("tests/FixtureEstoqueTermos.df").
QUIT.
