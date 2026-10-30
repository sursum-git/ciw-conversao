# Pendências finais da conversão

## Controles dos processos de compra — adiado pelo usuário em23/10/2026

- Aplicações: `grid_controles_proc_compra` e `form_controles_proc_compra`.
- Decisão expressa: “pule esse e coloque como pendencia final”. Continuar as outras conversões; não tratar esta informação como bloqueio nem perguntar novamente por sua origem enquanto não houver retomada específica.
- Motivo técnico registrado: tabela `controles_proc_compra` ausente no dicionário de `espec`. Formulário publicado tem campos de container e não possui `proc_compra_id`; usa conexão dinâmica `glo_banco`.
- Para retomar no final: confirmar se ainda é utilizado, localizar banco/tabela e vínculo correto com o processo. Não criar schema nem atribuir identidade de container a processo por suposição.
- Fontes sanitizados: `sources/scriptcase/purchase-remaining`; manifesto `integration-src/ciw-inventory/purchase-remaining-source-manifest.json`.

Esta postergação não autoriza mudanças em tabelas, registros ou permissões.
