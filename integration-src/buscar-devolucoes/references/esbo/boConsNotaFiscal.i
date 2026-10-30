/*Tipo Nota / Empresa / Nota Fiscal/ Data/ pedido /Cliente / Nome Abrev./Representante
Repres Venda / Comiss∆o / Cidade / Estado / Vl.Bruto / Vl.Nota / Vl.Desconto / Motivos Devol.*/

DEFINE TEMP-TABLE tt-NF NO-UNDO
    FIELD cod-estabel       AS CHAR
    FIELD serie             AS CHAR
    FIELD nf                AS CHAR
    FIELD data              AS DATE
    FIELD nr-Pedido         AS INT
    FIELD nome-abrev        AS CHAR
    FIELD nome-ab-reppri    AS CHAR
    FIELD perc-comis        AS DECIMAL
    FIELD cidade            AS CHAR
    FIELD estado            AS CHAR
    FIELD vl-bruto          AS DECIMAL
    FIELD vl-nota           AS DECIMAL
    FIELD vl-desconto       AS DECIMAL
    FIELD descr-mot-dev     AS CHAR
    .
