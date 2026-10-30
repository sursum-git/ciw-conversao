# Pagamentos de processos de compra

Implementação integrada e publicada em 22/10/2026 na `sursum-api/med`. Estado de validação operacional, contratos e continuidade na [documentação](../../docs/ciw-processos-compra-pagamentos-2026-10-22.md).

- ABL: extensão do financeiro/runtime existente e writer contextual.
- `backend/`: snapshots PHP/testes integrados ao canônico com guardas e recibos privados.
- `metadata/`: telas publicadas `cd0107/1.0.0`, `op1013/1.0.1` e sete operações aditivas na fonte existente.
- Recibos/runners privados: `.runtime/purchase-payments-20261022/` na raiz do workspace.

Compilação oficial 12.2 e runtime real validados. Não publicar compilados 12.8 nem repetir testes operacionais sem conferir os recibos de execução e limpeza.
