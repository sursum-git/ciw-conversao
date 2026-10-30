# Associação de NFs do container — design

## Objetivo

Converter a associação e a desassociação em lote de notas fiscais do Scriptcase para uma API Progress transacional, consumida pelo construtor, preservando a leitura já publicada.

## Decisão

Criar um writer ABL separado para `PUB.nfs_container`. Ele recebe somente a operação fixa (`associar` ou `desassociar`), `container_id`, o stamp de concorrência e uma coleção de chaves completas. O leitor `ContainersPainelFinanceReadService` continua sendo a única origem de projeção, filtros e paginação.

## Regras

- A chave do vínculo inclui documento, série, estabelecimento, natureza e emitente; a exclusão não pode omitir natureza/emitente como no Scriptcase.
- O lote inteiro confirma ou desfaz junto, sob lock do container e dos vínculos.
- Associação rejeita vínculo já existente; desassociação rejeita vínculo ausente.
- Logs retornam ator autenticado e snapshots antes/depois por vínculo, no mesmo contrato dos processos de container.
- Não há cálculo de custo/rateio no writer: efeitos de custo continuam nos serviços centrais já reutilizados.

## Fora de escopo

Não altera documento ERP, pagamento, estoque, custos, versões, permissões humanas ou anexos. O teste operacional só ocorrerá em novo cenário autorizado, nunca em `2147000100` ou em dados existentes.
