IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "nota-fiscal-fixture") = 0 THEN QUIT.
RUN prodict/load_df.p ("FixtureFiltroNF.df").
QUIT.
