IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "devolucao-fixture") = 0 THEN QUIT.
RUN prodict/load_df.p ("FixtureFiltroDevol.df").
QUIT.
