# Associação de notas fiscais ao container

## Regra extraída do Scriptcase

A aplicação `cons_docum_est_importacao` mantém uma seleção temporária de notas e executa a associação em lote ao container corrente. A linha de origem contém:

- `nro-docto` → `documento`;
- `serie-docto` → `serie`;
- `cod-estabel` → `estab`;
- `nat-operacao` → `nat_operacao`;
- `cod-emitente` → `cod_emitente`.

A inclusão histórica grava esses seis valores, incluindo `container_id`, em `PUB.nfs_container`. A tela de desassociação exibe somente documentos já associados. A seleção de NFs disponíveis restringe fornecedor e estabelecimento do container e situação eletrônica igual a 3.

## Correção obrigatória na API

O Scriptcase exclui por documento, série, estabelecimento e container, omitindo natureza e emitente. A nova API não pode reproduzir essa ambiguidade: a identidade do vínculo será sempre a tupla completa
`container_id, documento, serie, estab, nat_operacao, cod_emitente`.

Cada lote deve:

1. validar `container_id` e a lista não vazia de chaves completas;
2. bloquear o container e os vínculos envolvidos em uma única transação;
3. recusar duplicidade na associação e ausência na desassociação, sem sucesso parcial;
4. manter a leitura de NFs disponíveis reutilizando `ContainersPainelFinanceReadService` e `CiwErpReadService`;
5. registrar ator autenticado, transação e imagens antes/depois de cada vínculo;
6. devolver erro de concorrência em vez de repetir automaticamente a escrita.

O writer deve ficar separado do leitor financeiro: a regra de filtros, paginação e projeção da consulta já publicada não será copiada. A implementação prevista é um serviço de vínculos de NF chamado pelo recurso de processos do container, seguido de metadado de processo com confirmação Kendo. O teste operacional exigirá cenário novo específico e limpeza canônica; não reutilizar `2147000100` nem registros já limpos.
