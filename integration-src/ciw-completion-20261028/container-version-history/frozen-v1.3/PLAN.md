# Histórico persistido de versões do container — candidato 28/10/2026

Escopo autorizado: consulta e detalhe somente leitura; integração, compilação oficial,
publicação e acessos pertencem ao responsável principal. Não é uma entrega publicada.

1. Reconciliar lista, ponte e writer sanitizados contra op1005 e os serviços canônicos.
2. Obter o destino comprovado `cons_det_versoes_item_custo_container`; não inventar campos
   nem extrapolar a consulta para geração/fechamento. Usar os schemas oficiais existentes.
3. Reutilizar `ContainersVersionService.consultar` para ler snapshots persistidos;
   impor orçamento compartilhado de 50 mil registros e 10 segundos no ramo de consulta,
   preservando a assinatura e os caminhos de escrita. Propor patch com hash de baseline.
4. Adaptar os itens históricos para TT tipada com contexto obrigatório de container e
   versão, chave completa e valores desconhecidos preservados. Usar `CiwErpReadService`
   para filtros, ordenação, página de até 200 e get com alias estrito.
5. Preparar metadados nativos op1035 e link de op1005 por patch; nenhuma alteração Kendo,
   frontend novo, cálculo, DDL ou escrita de negócio. Não usar op1036 sem necessidade.
6. Provar localmente transporte/metadata e preparar testes ABL com TT para o root executar
   em OpenEdge 12.2/.42, incluindo regressão dos writers centrais. Revisar e registrar gates.

Gate de produto: o detalhe ainda depende da cópia sanitizada do destino de origem.
Gate final: compilação 12.2 em quatro combinações, PASOE sursum-api/med/9911 e runtime
nativo, todos coordenados pelo root. Nenhum `.r` local é artefato de publicação.
