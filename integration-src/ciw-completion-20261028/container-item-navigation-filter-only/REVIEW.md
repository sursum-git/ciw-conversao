# Revisão do candidato de navegação por item

Produto preparado/testado localmente, sem integração ou publicação. O descritor `filterOnly: true` exige contexto inteiro, opcional, readonly, filtro ativo e createDefault=false explícitos. Builder/normalizador omitem false; sem propriedade, os requests e as três definições regeneradas são byte iguais aos do Builder205 anterior. Processo mantém schema fechado e recusa a propriedade. Nenhuma alteração em ApiRequestContext, RuntimePurchaseItemAudit, fontes, fórmulas ou coletores.

O CrudEngine mantém o ID em contextValues/withContextFilters, mas injeta somente o pai nos renderers e no GET. O formulário também exclui o seletor do contexto de opções/download quando chamado diretamente. Campo presente vazio/null/zero/fracionário/inválido falha; campo ausente mantém a listagem normal dos callers antigos. RowLink sem PK ou com PK NULL não gera navegação. Limpar filtros não remove a PK fixa. A PK física continua no registro e nas ações de manutenção, nos locks e nos logs; o valor técnico não vira default de criação.

## Metadados sobre export fresco d4f647

*1008/ciw.container-custos-itens1.0.0→1.0.1*: dois links, para pedido1014 (proc_compra_id/item_proc_compra_id) e manutenção1002 (container_id/item_container_id). Três deltas na definição inteira, todos intencionais: versão e dois rowLinks.

*1002/ciw.container-itens1.0.1→1.0.2*: link para pedido1014 e contexto PK opcional filterOnly. Três deltas inteiros: versão, rowLink e contexto.

*1014/ciw.proc-compra-itens1.0.4→1.0.5*: contexto PK opcional filterOnly. Doze deltas inteiros: versão/contexto mais DEZ deltas de regeneração205, enumerados abaixo. Nenhum caminho ignorado. As permissões, entidades, fontes, abas e links antigos permanecem iguais nos testes de geração real; não se alteram allowCreate/Update/Delete.

| Campo1014 | Caminhos adicionais da definição | Publicado→regenerado205 |
|---|---|---|
| vl_custo_dolar | /crud/filter/fields/5/type e /operator | text/contains→decimal/eq |
| vl_negociado | /crud/filter/fields/6/type e /operator | text/contains→decimal/eq |
| qt_comprada | /crud/filter/fields/7/type e /operator | text/contains→decimal/eq |
| qt_alocada | /crud/filter/fields/8/type e /operator | text/contains→decimal/eq |
| qt_saldo | /crud/filter/fields/9/type e /operator | text/contains→decimal/eq |

`whole-preview-local.json` compara TODOS os caminhos dos três programas publicados com os resultados locais reais. A autoria ainda exige o root conferir os owners e um WHOLE preview fresco sob o Builder integrado, com revisão explícita desses dez deltas; o teste local não é prova de publicação nem de freshness remota.

## Verificação

RED: GET nativo repassava PK e o helper externo canônico real recusava422; descritor novo era recusado por Builder/validator/schema. GREEN:22 testes dos protótipos reais/normalizer/validator/AJV completo; PHP completo892 testes/5.916 asserções,277 classes App carregadas100% do estágio (409 fontes PHP copiadas, somente Builder sobreposto). ReadCiwErpPage real envia filtroPK tipado antes de skip/take/total; o leitor genérico de itens aplica PK antes de total/página local, preservando seu ABI externo só container. Os dois testes de transporte usam clientes sintéticos, não chamam ERP/DB. Rastros sintéticos capturam read/get/save/delete/batch/export/opções/download e os dois pontos de injeção dos renderers.

O primeiro teste AJV leu permissões de autoria (strings), quando o schema runtime exige booleanos. Corrigido apenas o harness para resolução sintética explícita de shape, sem relaxar schema ou conceder permissão. O teste inicial de comparação PHP confundiu 0/0.0 após JSON; passou a comparar os bytes serializados exatos do baseline205. Recibos iniciais preservados. Não atribuir essas falhas a produto legado.

## Limites/gates exatos

O exemplo reutiliza a definição JSON gerada pelo Builder e o motor nativo, sem novo frontend, JS de produto paralelo, alteração Kendo, mock em produção ou dados de negócio. As chamadas de protótipo usam stubs de HTTP/UI somente nos testes; não são validação de tela publicada/LDAP ou escrita real. A skill local de paridade não existe nesta instalação (limitação também registrada no contexto canônico); o checklist de docs/paridade-demo-producao.md foi aplicado e há delta documental candidato para o root.

Exportação mantém o comportamento anterior: loadAllRowsForExport emite take>=1000 com o filtroPK preservado e sem contexto técnico. O endpoint ERP limita200 e pode recusar esse export; esta entrega não anuncia export seguro ou corrige o contrato geral de exportação. Moeda USD/BRL, colunas realizadas condicionais e diferenças de descrição/resumo continuam separados. Não houve chamadas de rede, negócio, grants, DDL, compilação ABL ou edição canônica. Root centraliza composição/autoria/publicação e prova nativa real; baselines divergentes exigem rebase, nunca aplicação fuzzy.
