# Conversão de descontos contextuais — desenho

## Intenção

Converter `grid_descontos_importacao` e `form_descontos_importacao` para uma tela contextual do item de container, usando a tabela `PUB.descontos_importacao`, sem duplicar os cálculos de crédito, saldo e distribuição de custo já centralizados no Progress.

## Escopo

- A tela exige `item_container_id` como contexto obrigatório e imutável.
- O CRUD manipula somente descontos desse item, com lock, transação única, concorrência e auditoria de usuário/imagens antes/depois.
- A leitura dos lançamentos de utilização reutiliza `ImportDiscountsCollector`/`ImportDiscountsReadService`; o writer não recalcula custo nem distribui crédito.
- A exclusão deve ser recusada enquanto houver `cta_corren_desconto` ou referências de custo que dependam do desconto.
- `cons_tit_ap_associados_pedido` é absorvida por `ciw.proc-compra-pagamentos`: ambos usam títulos antecipados, não estornados, e o mesmo conjunto de campos. O inventário deve refletir essa equivalência, sem nova tela.

## Fora de escopo

- `grid_descontos_importacao_itens`, `form_descontos_importacao_item`, estorno/cancelamento e manutenção de lançamentos são fluxos próprios e não serão inferidos como concluídos.
- Nenhuma alteração em registros existentes; validação operacional usa somente registros novos e removidos ao final.

## Abordagens consideradas

1. Criar outro leitor de saldo/crédito no writer: rejeitada, pois duplicaria regra já publicada.
2. Reutilizar somente as consultas gerais 1045/1046: rejeitada, pois elas não têm o contexto obrigatório do item nem permitem manutenção.
3. Criar serviço contextual de escrita e reutilizar o coletor/leitor existentes: escolhida. Mantém uma fonte de cálculo e separa leitura, escrita e auditoria.

