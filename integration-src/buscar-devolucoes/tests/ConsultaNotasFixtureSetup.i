    CREATE devolfixture.user-web.
    ASSIGN devolfixture.user-web.Login="SC_TEST_API_NF" devolfixture.user-web.tp-usuario=2
           devolfixture.user-web.nome-ab-cli="REP TESTE".
    VALIDATE devolfixture.user-web.
    CREATE devolfixture.repres.
    ASSIGN devolfixture.repres.nome-abrev="REP TESTE" devolfixture.repres.cod-rep=7.
    VALIDATE devolfixture.repres.
    CREATE devolfixture.natur-oper.
    ASSIGN devolfixture.natur-oper.nat-operacao="V" devolfixture.natur-oper.tipo-compra=1 devolfixture.natur-oper.tp-rec-desp=1.
    CREATE devolfixture.natur-oper.
    ASSIGN devolfixture.natur-oper.nat-operacao="D" devolfixture.natur-oper.tipo-compra=3 devolfixture.natur-oper.tp-rec-desp=1.
    /* Pedido correspondente sem representante nao pode esconder o elegivel. */
    CREATE devolfixture.ped-venda.
    ASSIGN devolfixture.ped-venda.nome-abrev="CLIENTE" devolfixture.ped-venda.nr-pedcli="123"
           devolfixture.ped-venda.nr-pedido=600 devolfixture.ped-venda.cod-priori=18.
    VALIDATE devolfixture.ped-venda.
    CREATE devolfixture.ped-venda.
    ASSIGN devolfixture.ped-venda.nome-abrev="CLIENTE" devolfixture.ped-venda.nr-pedcli="123"
           devolfixture.ped-venda.nr-pedido=700 devolfixture.ped-venda.cod-priori=18.
    CREATE devolfixture.ped-repre.
    ASSIGN devolfixture.ped-repre.nr-pedido=700 devolfixture.ped-repre.nome-ab-rep="REP TESTE" devolfixture.ped-repre.perc-comis=5.
    CREATE devolfixture.ped-venda-ext.
    ASSIGN devolfixture.ped-venda-ext.cod-estabel="5" devolfixture.ped-venda-ext.nr-pedido=700 devolfixture.ped-venda-ext.preposto="PREPOSTO".
    CREATE devolfixture.nota-fiscal.
    ASSIGN devolfixture.nota-fiscal.cod-estabel="5" devolfixture.nota-fiscal.cod-emitente=100
           devolfixture.nota-fiscal.serie="V" devolfixture.nota-fiscal.nr-nota-fis="000900"
           devolfixture.nota-fiscal.nr-pedcli="123" devolfixture.nota-fiscal.nome-ab-cli="CLIENTE"
           devolfixture.nota-fiscal.cod-rep=7 devolfixture.nota-fiscal.no-ab-reppri="REP TESTE"
           devolfixture.nota-fiscal.nat-operacao="V" devolfixture.nota-fiscal.esp-docto=22
           devolfixture.nota-fiscal.dt-emis-nota=DATE(1,10,2026) devolfixture.nota-fiscal.dt-cancela=?
           devolfixture.nota-fiscal.idi-sit-nf-eletro=1 devolfixture.nota-fiscal.vl-tot-nota=200
           devolfixture.nota-fiscal.cidade="TESTE" devolfixture.nota-fiscal.estado="SC".
    CREATE devolfixture.it-nota-fisc.
    ASSIGN devolfixture.it-nota-fisc.cod-estabel="5" devolfixture.it-nota-fisc.serie="V"
           devolfixture.it-nota-fisc.nr-nota-fis="000900" devolfixture.it-nota-fisc.char-2=FILL(" ",1499) + "10,00".
    CREATE devolfixture.it-nota-fisc.
    ASSIGN devolfixture.it-nota-fisc.cod-estabel="5" devolfixture.it-nota-fisc.serie="V"
           devolfixture.it-nota-fisc.nr-nota-fis="000900" devolfixture.it-nota-fisc.char-2=FILL(" ",1499) + "15,00".
    CREATE devolfixture.docum-est.
    ASSIGN devolfixture.docum-est.cod-estabel="5" devolfixture.docum-est.cod-emitente=100
           devolfixture.docum-est.nro-docto="000010" devolfixture.docum-est.serie-docto="D"
           devolfixture.docum-est.nat-operacao="D" devolfixture.docum-est.esp-docto=20
           devolfixture.docum-est.tot-valor=100 devolfixture.docum-est.dt-emissao=DATE(1,15,2026)
           devolfixture.docum-est.dt-trans=DATE(1,16,2026) devolfixture.docum-est.cidade="TESTE" devolfixture.docum-est.uf="SC".
    CREATE devolfixture.devol-cli.
    ASSIGN devolfixture.devol-cli.cod-estabel="5" devolfixture.devol-cli.cod-emitente=100
           devolfixture.devol-cli.nro-docto="000010" devolfixture.devol-cli.serie-docto="D"
           devolfixture.devol-cli.nat-operacao="D" devolfixture.devol-cli.nr-nota-fis="000900"
           devolfixture.devol-cli.serie="V" devolfixture.devol-cli.codigo-rejei=1.
    CREATE devolfixture.cod-rejeicao.
    ASSIGN devolfixture.cod-rejeicao.codigo-rejei=1 devolfixture.cod-rejeicao.descricao="TESTE".
    VALIDATE devolfixture.natur-oper. VALIDATE devolfixture.ped-venda. VALIDATE devolfixture.ped-repre.
    VALIDATE devolfixture.ped-venda-ext. VALIDATE devolfixture.nota-fiscal. VALIDATE devolfixture.it-nota-fisc.
    VALIDATE devolfixture.docum-est. VALIDATE devolfixture.devol-cli. VALIDATE devolfixture.cod-rejeicao.
