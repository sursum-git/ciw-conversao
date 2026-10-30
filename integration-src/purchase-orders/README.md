# Processos de compra MED

Cadastro publicado: `ciw.processos-compra-med`, programa `cd0108`, versão `1.0.0`. O frontend é o construtor existente; `metadata/` contém os quatro documentos JSON usados na integração. A aba Pagamentos reutiliza `ciw.proc-compra-pagamentos/op1013`.

`PurchaseOrdersApi.p` adapta a rota existente; `PurchaseOrdersService.p` controla o cadastro/transação; `PurchaseOrderIdService.p` aloca a identidade; `PurchaseOrderSnapshot.i` compartilha imagens e versão do registro. O leitor ERP e as rotinas de financeiro/runtime existentes foram estendidos para reutilização. O PHP importa auditoria com usuário e imagens anteriores/atuais pelas classes nativas.

Fontes canônicos estão nos projetos `D:/opencode/motor-progress/v2` e `D:/opencode/construtor-pg`; esta pasta conserva o pacote revisado. Os executáveis publicados foram compilados em OpenEdge12.2 no `.42`, com267checks por cultura/codepage. PHP canônico:658testes/4280asserções. Consulta, detalhe, metadados e interface reais passaram. O teste operacional autorizado passou: usuário/imagens, reconstrução financeira, bloqueios e limpeza física completa. Não repetir fixtures encerradas.

Detalhes e limites: [documentação da entrega](../../docs/ciw-processos-compra-2026-10-22.md). Retomada: [memória do projeto](../../context/RETOMADA_2026-10-16.md). Estado privado e recibos ficam em `.runtime/purchase-orders-20261022/`; nunca copiar credenciais ou dados comerciais para esta pasta.
