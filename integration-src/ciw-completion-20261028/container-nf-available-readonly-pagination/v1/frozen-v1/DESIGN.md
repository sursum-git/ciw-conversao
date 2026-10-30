# NFs disponíveis: paginação completa dentro dos limites existentes

Estado: desenho preparado para revisão; nenhum limite ou fonte canônica alterado.

O diagnóstico oficial de runtime10 comprovou que quatro consultas recusam pelo limite de **candidatos 200**, enquanto o container positivo contém 104 linhas. Não há prova de estouro de fonte 50 mil ou de tempo nesses quatro casos. A solução muda o significado de 200 para tamanho máximo de página e mantém a leitura limitada de fonte. Não promete que qualquer corpus maior que o orçamento possa ser consultado.

## Caminho escolhido

1. Manter o wrapper autenticado `ContainersPainelFinanceRead.p`, sua ABI de dez handles e seu parent MED antes do ERP. Nenhuma rota, token, empresa ou origem escolhida pelo cliente.
2. Manter `AvailableNfs` como único coletor, a exclusão por documento somente, os gates NULL/collation, `NfRow`, `NfKey` e `AcceptRow`. Para `read`, `AcceptRow` materializa apenas o recurso novo em uma TT privada tipada, copiando genericamente os valores do JSON já produzido por `NfRow` e conservando esse JSON original em um campo privado. Não há segunda projeção de negócio nem novo cálculo.
3. Consumir a TT no `CiwErpReadService.p` por um recurso interno fixo. Seus `FilterExpr`, `Literal`, ordenação, `skip`, `take` e cálculo de `total` continuam únicos. Somente a saída desse recurso retorna o JSON original já produzido por `NfRow`, sem criar `record_key` ou recalcular a chave opaca. A entrada pública não pode fornecer handles, payloads de linha, políticas ou nomes de tabelas.
4. Completar a coleta e validar limites antes de responder. O contador existente continua contando links e documentos percorridos, inclusive os excluídos. O orçamento de 10 segundos começa antes da coleta e envolve também projeção e paginação, por um bloco externo único e verificação final. O limite de fonte continua 50 mil; nenhuma resposta parcial é liberada em falha.
5. `read` responde `{success:true,data:[...],total:N}` com no máximo 200 linhas e total após filtros. `skip` segue o contrato ERP fechado; página além do total retorna lista vazia com o mesmo total. A ordem explícita nativa continua documento/série/natureza, com `nf_key` como desempate estável. Sem ordenação recebida, o servidor mantém aquela mesma ordem padrão. NO-LOCK não representa snapshot entre requisições: alterações concorrentes podem mudar total e posição, limitação declarada.
6. `get` mantém a busca contextual e os guards de alias byte exato do runtime10. Retirar o limite de candidatos somente deste fluxo novo permite encontrar um registro depois da posição 200, ainda sob o contador de fonte e prazo existentes. Os outros recursos não aceitam os novos parâmetros.
7. `RuntimeCiwErpQuery` reconhece a entidade NF por binding fechado diferente do dispatcher de cadastros. Depois desse binding, reutiliza o mesmo parser de filtro/sort/página. `RuntimeApiEntityActionService::readCiwErpPage` valida o envelope paginado e chama o helper NF para validar os 18 campos e o container antes de mapear. O helper continua responsável por GET e passa a validar a página e seu total no caminho de leitura.
8. O grid nativo já usa `serverPaging`, `serverSorting` e `serverFiltering`; não precisa mudança de frontend. Metadados continuam no op1053, com contexto obrigatório e permissões readonly. A exportação nativa de todas as linhas pede pelo menos 1000 em uma única requisição: deve ficar desabilitada apenas neste programa por metadados, com teste da ausência de botões. Nenhuma exportação parcial será apresentada como completa.

## Alternativas avaliadas

- Aumentar o cap do conjunto completo conserva a transferência e filtro local e apenas desloca a falha. Não resolve a fronteira de página e não foi escolhido.
- Implementar outro parser ou outro mapper financeiro multiplica contratos e regras. A TT privada permite usar o leitor existente sem esse desvio.
- Paginar somente o SELECT de documentos antes da exclusão produziria total incorreto e páginas incompletas. Não foi escolhido.

## Superfície prevista

Patches isolados sobre bytes atuais: `ContainersPainelFinanceReadService.p` (baseline obrigatório runtime10 `614795f3af80f29a51c467e8170f954540a76a8902034b9cf6186b1c328ac7b5`), `CiwErpReadService.p`, `RuntimeCiwErpQuery.php`, `RuntimeApiEntityActionService.php` e `RuntimeContainerNfAvailableRead.php`. Wrapper e Builder permanecem sem alteração prevista. Os hunks do reader/Query/Action precisam compor com 1055 congelado por anchors; nunca substituir pela cópia inteira de outro pacote. Metadados são nova proposta separada sobre as entradas anteriores ainda retidas, com novo export real exigido somente se a fonte/pai vivo mudar.

## Evidência exigida antes de candidate-ready

- RED real do Service com 201 candidatos e da fronteira PHP que atualmente não encaminha página/filtro/sort.
- TT 201, 401 e 1001 linhas, travessia de todas as páginas sem perda, ordem inversa, filtro alterando o total antes do recorte, página vazia além do total, NULL e decimais 10 casas.
- GET do último registro, aliases exatos e inválidos, contexto obrigatório, MED antes do ERP, parent 565 e nenhum bypass por filtros.
- Fonte 50 mil inclusiva e 50001 recusada sem data em qualquer página; timeout total incluindo a etapa de paginação. Fixture de timeout identificada e nunca publicável.
- Regressões financeiras e dos demais recursos byte preservadas; equivalência de `NfRow`, `NfKey`, seleção e parser existentes. Códigos de causa fonte/tempo mantidos.
- PHP usando `handle`/transporte real e `readCiwErpPage`, não apenas helper. Resposta cruzada, shape/total inconsistente e fonte incorreta recusam antes de mapper/log de sucesso.
- Normalizador real, `validateExternalDraft`, AJV2020 e renderer nativo com duas páginas e `total`, filtros e ordenação encaminhados, sem exportação/writers.
- Quatro combinações locais CP/cultura NUMDBS0 são diagnóstico; compilação oficial12.2 e validação dos cinco containers continuam responsabilidade do root e não são substituídas por testes locais.

## Limites de escopo preservados

MED somente; origem também tinha IMA e não fica integralmente convertida. Associação/desassociação e correção de DELETE legado seguem fora deste pacote. Collation SQL real ainda não foi comprovada: o gate explícito existente continua. Não criar grants, sequências, DDL, escritores, caches IMA ou persistência de credenciais. Freezes 1053, aliases v1.1/v1.2, official9/10 e 1055 permanecem imutáveis.
