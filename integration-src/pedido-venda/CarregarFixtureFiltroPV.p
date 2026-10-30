/* Carregar somente no banco sintetico recem-criado pelo runner. */
IF NUM-DBS <> 1 OR INDEX(PDBNAME(1), "pedido-venda-fixture") = 0 THEN QUIT.
RUN prodict/load_df.p ("FixtureFiltroPV.df").
QUIT.
