# Nota fiscal: desconsiderar por usuario

`FiltroTipoUsuarioNF.p` recebe o usuario e o **ROWID de `ems2med.nota-fiscal`** e retorna `LOGICAL`: `TRUE` desconsidera a nota, `FALSE` mantem quanto a esta regra. Usa consultas estaticas `NO-LOCK`, sem cache, sem filtro textual e sem escrita fisica. O fonte e independente, sem includes/programas auxiliares em runtime, e mantem as definicoes alinhadas solicitadas para a rotina de pedidos.

```abl
DEFINE VARIABLE cUsuario       AS CHARACTER NO-UNDO.
DEFINE VARIABLE lDesconsiderar AS LOGICAL   NO-UNDO.

cUsuario = "login-do-usuario".

FOR EACH ems2med.nota-fiscal NO-LOCK:
    RUN FiltroTipoUsuarioNF.p (
        INPUT cUsuario,
        INPUT ROWID(ems2med.nota-fiscal),
        OUTPUT lDesconsiderar
    ).
    IF lDesconsiderar THEN NEXT.

    /* Continuar os demais filtros e o processamento da consulta existente. */
END.
```

O programa usa buffers proprios, preservando a nota corrente do chamador. O ROWID identifica exatamente a nota, mesmo quando numero/serie se repetem em estabelecimentos diferentes. Todos os bancos referenciados devem estar conectados com os nomes logicos do fonte.

## Regra aplicada

A logica de tipos/grupos/hierarquia corresponde ao ramo `nota-fiscal` de `aplicarFiltroTipoUsuarioPV`, sem `$lExcecao`/grupo16, conforme o escopo vigente. O tipo e obtido de `espec.user-web.tp-usuario`. O escopo de nomes e reconstituido a partir dos cadastros usados por `setarVarsLogin`, sem depender da sessao PHP ou de parametros extras.

| Tipo | Escopo |
|---|---|
| 1 | Sem restricao adicional de representante |
| 2 | Login do usuario |
| 5 | Representante vinculado em `user-web.usuario` |
| 3 | Lista gerencial/hierarquia ou restricoes do usuario; grupos5/6 e faixas conforme o legado |
| 4 | Lista explicita da restricao ativa3, quando preenchida |

Mantida a precedencia da lista derivada do login sobre os ajustes posteriores de hierarquia: hierarquia3 gera dependentes diretos, restricao ativa3 substitui essa lista; somente sem lista prioritaria sao aplicados diretoria, ativo1 e gerencia. Listas vazias seguem os mesmos fallbacks documentados na rotina de pedidos. Usuario/nota ausente ou invalido retorna TRUE; referencia inconsistente de representante gera erro que o chamador deve tratar/propagar.

**Representante avaliado:** `nota-fiscal.no-ab-reppri`, seguindo o ajuste solicitado pelo usuario para considerar o principal. A funcao PHP recebida referencia o alias `ped_rep`; a rotina estatica avalia o nome principal da propria nota, preservando as regras de usuario sobre esse nome. Nao depende de localizar o pedido de origem. A rotina existente `FiltroTipoUsuarioPV.p` permanece inalterada.

Os demais criterios fiscais e comerciais continuam no chamador. A decisao desta rotina se limita ao escopo de usuario/representante.

## Estado e verificacao — 19/10/2026

Programa completo e testes compilados sem erro em **OpenEdge12.8 local**, verificacao auxiliar: **35 checks por cultura AMERICAN/EUROPEAN**, banco fisico sintetico e limpeza das fixtures. Cenarios incluem representante da nota sem pedido, numero igual em estabelecimentos diferentes, tipo5, hierarquia3, prioridades, grupos5/6/16, restricoes, mudancas sem cache e nota eliminada. Evidencias `.runtime/nota-fiscal-20261019/{red,green}/`.

Fonte **salvo e conferido** as10:31BRT em `\\192.168.0.137\erp\especificos\ems2\ima\esapi\FiltroTipoUsuarioNF.p`, SHA-256 remoto/local `DA072DCE354A7C7492A947884E6150947A99498BEF745B112FB678E94D5CF1CA`. Nao havia arquivo anterior. Recibo `.runtime/nota-fiscal-source-copy-20261019/copy-receipt.json`. Autenticacao por entrada protegida, sem persistir credencial.

Somente o `.p` foi copiado. Compilacao oficial12.2/.42, `.r` e validacao PASOE sursum-api/med continuam pendentes do acesso ao compilador registrado no contexto. Nenhuma rota, schema ou dado real foi alterado. `FixtureFiltroNF.df`, loader, runner e testes sao exclusivos do banco sintetico local e **nao devem ser carregados/publicados no ERP/PASOE**.
