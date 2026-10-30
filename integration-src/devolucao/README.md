# Devolucao: desconsiderar por usuario

`FiltroTipoUsuarioDevol.p` recebe o usuario e o **ROWID de `ems2med.devol-cli`**, retornando `LOGICAL`: `TRUE` desconsidera a devolucao, `FALSE` mantem quanto a esta regra. Fonte independente, com definicoes alinhadas, consultas estaticas `NO-LOCK`, sem filtro textual, sem cache e sem escrita fisica. Usa buffers proprios para preservar o registro corrente do chamador.

```abl
DEFINE VARIABLE cUsuario       AS CHARACTER NO-UNDO.
DEFINE VARIABLE lDesconsiderar AS LOGICAL   NO-UNDO.

cUsuario = "login-do-usuario".

FOR EACH ems2med.devol-cli NO-LOCK:
    RUN FiltroTipoUsuarioDevol.p (
        INPUT cUsuario,
        INPUT ROWID(ems2med.devol-cli),
        OUTPUT lDesconsiderar
    ).
    IF lDesconsiderar THEN NEXT.

    /* Continuar os demais filtros e o processamento da consulta existente. */
END.
```

## Regra original e vinculo fiscal

No ramo `devol-cli` de `aplicarFiltroTipoUsuarioPV`, somente os tipos2/5 exigem `cod-rep = codRepIni`. `devol-cli` nao possui `cod-rep` no dicionario real disponivel. O metodo legado `getTotDevNf()` chama a funcao com `aplicarFiltroTipoUsuarioPV('devol-cli', 'venda')`, sendo **`venda` o alias de `nota-fiscal`**. Portanto, a comparacao correta e com o codigo da nota de venda original.

A rotina localiza `user-web` pelo login e obtem `tp-usuario`:

| Tipo | Resultado da regra de representante |
|---|---|
| 2 | Busca `repres.nome-abrev = user-web.Login`; compara o codigo com `nota-fiscal.cod-rep` |
| 5 | Busca `repres.nome-abrev = user-web.usuario`; compara o codigo com `nota-fiscal.cod-rep` |
| 1, 3 e 4 | Sem restricao adicional, retornando FALSE para usuario/devolucao validos |

Para2/5, a nota e localizada pela mesma juncao do legado: **`cod-estabel`, `serie` e `nr-nota-fis` da devolucao**. Nota ausente ou codigo diferente/desconhecido resulta em TRUE. Nao se usam as regras gerenciais/listas dos ramos de pedido e nota, nem se compara pelo nome principal: este ramo original utiliza o codigo numerico `cod-rep`.

Usuario ausente/inativo, tipo desconhecido/fora de1..5, ROWID/devolucao inexistente ou representante obrigatorio ausente/desconhecido retorna TRUE. Nos tipos livres, a existencia da nota nao e exigida por esta rotina de escopo; os joins e demais criterios da consulta permanecem sob responsabilidade do chamador.

Referencia: `sources/scriptcase/iol/bl_pag_ini_ger/index.php`, funcoes `aplicarFiltroTipoUsuarioPV`, `setarVarsLogin` e `getTotDevNf`. O dicionario e `integration-src/iol-pagina-inicial-gerencial/schema/iol-schema.json`.

## Estado em19/10/2026

Programa completo e testes compilaram sem erro no **OpenEdge12.8 local**, verificacao auxiliar: **27 checks em cada cultura AMERICAN/EUROPEAN**, banco fisico sintetico com limpeza. Cenarios incluem tipos1..5, preposto, chave fiscal completa, ROWID de outra tabela, usuario/devolucao inexistente, nota ausente, codigos desconhecidos e mudancas sem cache. Evidencias `.runtime/devolucao-20261019/{red,green}/`.

Fonte salvo e conferido as11:22BRT em **`\\192.168.0.137\erp\especificos\ems2\ima\esapi\FiltroTipoUsuarioDevol.p`**, SHA-256 remoto/local `BFBFBFEFEDA4D1DF4E70980B3095E381631320C8BFFEABEDA749F6A1C1788F8D`. Nao havia arquivo anterior. Recibo privado `.runtime/devolucao-source-copy-20261019/copy-receipt.json`; autenticacao protegida, sem persistir credencial.

Somente `.p` copiado. Compilacao oficial12.2/.42 e validacao PASOE sursum-api/med pendentes conforme bloqueio de acesso ja registrado. Nenhuma rota, schema ou dado real alterado. `FixtureFiltroDevol.df`, loader, runner e testes sao exclusivos do banco sintetico e nunca devem ser carregados/publicados no ERP/PASOE. Os fontes de PV e NF permanecem inalterados.
