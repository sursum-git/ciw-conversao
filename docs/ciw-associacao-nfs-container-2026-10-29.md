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


## Associação e desassociação de NFs — publicada e validada em 17/11/2026

As grades `ciw.container-nfs` **1.0.2** e `ciw.container-nfs-disponiveis-med` **1.0.1** estão publicadas na extranet. A fonte `motor_progress_container_financeiro` contém `associar_nfs` e `desassociar_nfs`. As duas grades geram um endpoint de escrita próprio e `nfLinkSnapshot`. As assinaturas das duas telas e dos quatro endpoints foram verificadas pelo serviço de integridade. A escrita exige a permissão `.process` da respectiva entidade. A consulta do selo exige `container_nfs_progress.read`.

O Builder envia as cinco partes da chave, o contexto fixo `container_id` e `expected_nf_stamp`, obtido da consulta de vínculos. O backend valida a lista, rejeita duplicatas e confere imagens de auditoria, ator autenticado e confirmação de commit. Na composição ABL, o recurso `nfs` deve permanecer na chamada ao writer e o buffer usado somente nesse comando deve receber `hCollector[16]` (nfs_container). Essas falhas de integração foram corrigidas.

Os quatro programas compilaram no OpenEdge **12.2.12** local com `COMPILER:ERROR=no` e foram publicados pelo `T:\sursum`. O lote final foi ativado com transporte MED pausado, recarga somente de sessões MED ociosas e restauração do transporte. IMA foi preservado. Hashes conferidos na montagem Linux. Testes passaram 13 verificações ABL do roteador com `NUM-DBS=0`, 11 verificações PHP e o teste JavaScript das duas ações, incluindo chave completa, zeros, selo, duplo envio e selo ausente.

A validação real final passou **30 verificações** pelos endpoints publicados do Builder e PASOE MED. Cobriu associação, desassociação, chave incompleta, natureza divergente, selo obsoleto (HTTP 409), mudança de selo e auditoria disponível. Foram usados somente container novo e vínculos sintéticos novos. Não foram criados documentos fiscais ERP. O container final `2147013110` e seus vínculos foram removidos. Consulta direta posterior em `espec.pp-container` e `espec.nfs_container` confirmou zero registros. Os logs persistidos mantêm um evento de criação e um de exclusão de vínculo, com imagens antes/depois e origem `progress-transaction`.

As contas temporárias de autoria/teste e seus vínculos foram desativados. Consulta independente confirmou zero contas temporárias ativas e zero vínculos temporários habilitados. Home e assinantes mantiveram hashes `4d9a91eac77da29b42b11d41f38410b9` e `494b974da2e37ed576e9157af64275c6`. CSS, temas e bibliotecas Kendo foram preservados. Não houve revisão visual no navegador. Evidências e backups privados em `.runtime/nf-link-builder/` e `.runtime/nf-link-oe122/`. Nunca versionar credenciais desses diretórios.
