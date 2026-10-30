# Formatos de amostra — conversão em 27/10/2026

Estado: **COMPLETED_CLEANED**. Publicação, sequência, acesso humano, cenário operacional e limpeza concluídos após as três autorizações específicas. Controles continua como pendência final.

## Origem e tela publicada

- Scriptcase: `root@192.168.0.170:22`, diretório `/var/www/clients/client1/web2/web/ciw`, aplicações `grid_pub_formatos_amostra` e `form_pub_formatos_amostra`; chamadas por `form_itens_proc_compra`.
- Fontes sanitizados: `sources/scriptcase/purchase-sample-formats`; manifesto em `integration-src/ciw-inventory/purchase-sample-formats-source-manifest.json`.
- Tela: `http://127.0.0.1:8765/production/app.html?screenId=ciw.formatos-amostra`, programa `cd0109/1.0.0`, entidade `formatos_amostra_progress`.
- Itens: `ciw.proc-compra-itens/op1014/1.0.4`, nove abas, oito anteriores preservadas. Novo link/aba Formatos de amostra. Painel principal `ciw.processos-compra-med/cd0108/1.0.6` permanece idêntico.
- Cadastro compartilhado entre empresas: `espec.formatos_amostra`, três campos: ID inteiro, descrição até 40 caracteres e Inativo. Não aplicar filtro MED a esse catálogo global.

## Reutilização e regras

`CiwCadastroCrudService.p` mantém a assinatura de seis parâmetros usada pelos consumidores anteriores e delega ao corpo único extraído para `CiwCadastroCoreService.p`. O núcleo recebe um provider privado; `CiwCadastroSequenceIdentity.p` fixa a identidade deste recurso em `seq_formatos_amostra`. Não aceita tabela, programa ou sequência vindos do navegador. Formatos não usa maior ID + 1 como fallback. Os quatro cadastros anteriores preservam seus contratos e geração de IDs.

O recurso utiliza a rota existente `/SursumPrograms/ciw-cadastros`, com seis operações read/get/create/update/delete/batch e definição fixa em `CiwCadastroDefinition.p`. Inclusão aplica Inativo=false, como no PHP original, mesmo com default físico TRUE. Descrição vazia é permitida; novos textos aceitam letras ASCII, dígitos, espaço, ponto, vírgula e CR/LF, conforme o original. A validação de caracteres novos não impede imagens históricas com acentos.

Alteração/exclusão exigem original completo e conferência sob lock. Lote desfaz integralmente em falha. Exclusão verifica vínculos em `itens_proc_compra` de qualquer empresa; não apaga vínculos. GET aceita o alias da PK somente quando igual ao id canônico. Colisão de identidade falha sem sobrescrever registro.

PHP amplia somente os catálogos fechados de `RuntimeCiwCadastroAudit` e `RuntimeApiEntityActionService`. Transação e importação dos logs continuam nas classes existentes: usuário autenticado, imagem anterior e atual tipadas e completas. Logs da linha mostram eventos do registro; Logs Exclusão mantém as imagens anteriores dos excluídos. O cenário real de gravação/auditoria persistida foi executado e reconciliado fisicamente.

## Evidência observada

- Compilação oficial .42/OpenEdge12.2, build2: 12 entradas; 108 verificações em cada combinação UTF-8/ISO8859-1 × AMERICAN/EUROPEAN, NUM-DBS=0. São 38 novas, 60 de regressão CRUD e dez de definições.
- Suíte PHP canônica: 878 testes/5806 asserções, sem falhas. Revisão independente final sem P1/P2; quatro testes novos/26 asserções repetidos pelo revisor.
- Quinze arquivos canônicos integrados por hashes e backups. Dez artefatos p/r publicados na .137 via .111; dependências primeiro e dispatcher por último. Fixtures não publicadas.
- Recarga apenas das sessões MED ociosas 92/93, na instância `sursum-api`; nenhuma alteração de handler, autenticação ou política DynamicQuery. HTTPS oficial9911; túnel local19910 para9910 da mesma instância, restabelecido após constatar que estava fechado.
- PASOE e runtime nativo: sete registros existentes, read/get conferidos integralmente; cinco rejeições sem escrita e leitura de três cadastros anteriores do mesmo núcleo passaram.
- Fonte `motor_progress_ciw_cadastros`: 97→103 operações, anteriores preservadas. Dois programas publicados pela governança nativa, locks liberados e grants temporários de autoria revogados. Não concedido acesso humano.
- Definições publicadas comprovam preservação das oito abas e dos modos Logs/Logs Exclusão. Nenhum registro operacional foi criado/alterado/excluído neste recorte.

As primeiras tentativas do harness enviaram paginação ao contrato CRUD simples, esperaram total no envelope PASOE e escolheram recursos de outro dispatcher. Foram corrigidas apenas nas ferramentas de verificação: o contrato simples retorna a lista completa, e o runtime PHP aplica paginação. Não houve correção de produção nem gravação decorrente dessas tentativas.

## Autorizações recebidas e consumidas

O usuário autorizou expressamente os três itens no `call_d72ca2b5688149d68a4df8d3cf91663b`. O escopo abaixo foi aplicado e encerrado; não repetir DDL, grants ou cenário usando essa autorização.

Em inspeção somente leitura de 27/10, há sete formatos, maior ID13 e nenhuma sequência correspondente entre as sequências do banco. Não reutilizar sequências de apontamento/envio de amostras ou formação de preço.

1. Criar somente `seq_formatos_amostra` em `espec`, após reconferir dicionário, IDs e identidades históricas dos logs. Contador não cíclico, incremento1, limite INTEGER2147483647, início acima das identidades já utilizadas. Não resetar/reseed de sequência existente nem alterar tabelas/registros. Caso apareça uma sequência concorrente, parar e verificar seu uso/estado.
2. Liberar para `tadeu.parreiras` somente `formatos_amostra_progress.read`, `.create`, `.edit` e `.delete`, preservando demais permissões e snapshots LDAP. Esse cadastro é global compartilhado; acesso não se limita às linhas MED.
3. Executar somente cenário novo `SC_TEST_PROC_FORMATOS_20261027`: um processo novo com previsão financeira desativada, um item novo e três formatos novos com IDs gerados pelas APIs. Ler fornecedor existente sem alterá-lo. Descrições novas dos formatos usam `SC TEST PROC FORMATOS 20261027 A/B/C` (uma letra final por registro, sem barras), até40 caracteres e sem underscore.

O cenário deve validar inclusão/default, alteração, lote/rollback, bloqueio de exclusão referenciada, ID não reutilizado e logs com ator LDAP e imagens completas; depois excluir apenas registros novos por manifesto/IDs/imagens, preservando logs e avanço do contador. Não associar títulos, containers, notas ou estoque nem alterar formato/fornecedor existente. Nunca executar esse cenário usando autorizações consumidas de recortes anteriores.

Recibos privados: `.runtime/purchase-sample-formats-20261027/{ACTIVE_WORK.json,progress.md,official-compile-verification.json,review-final.json,canonical-manifest.json,active-manifest.json,metadata-publication.json,pasoe-read-proof.json,native-read-proof.json,php-canonical-full.xml}`. Somente caminhos devem entrar no contexto; nunca conteúdo de arquivos de acesso.

## Resultado operacional confirmado

O ensaio oficial12.2 em banco privado confirmou propriedades da sequência e lacuna preservada após rollback. O loader oficial criou somente `seq_formatos_amostra`, CURRENT inicial81: maior ID físico13 nas duas referências e limite conservador81 obtido dos IDs de consultas históricas de Formatos nas transações. Não houve consumo de NEXT na criação, alteração de tabelas ou reset de qualquer sequência existente. As quatro permissões foram aplicadas e verificadas independentemente com integridade nativa, demais acessos e snapshots das quatro sessões LDAP existentes preservados.

O cenário autorizado criou processo1688, item3211 e formatos82/83/84. Toda gravação utilizou sessão LDAP real de `tadeu.parreiras`, sem impersonação administrativa. Formato82 incluiu com Inativo=false, foi alterado e teve exclusão bloqueada enquanto referenciado pelo item3211. Original desatualizado foi recusado409. Após desvincular o item, o formato82 foi excluído; o novo formato recebeu84, sem reutilização do82. Lote com alteração do83 seguida de exclusão do82 já ausente falhou404 e desfez integralmente a alteração. Lote válido posterior alterou83/84 e gerou dois eventos na mesma transação30169.

Foram reconciliados 14 eventos de negócio distintos, nove de Formatos (três inclusões, três alterações e três exclusões) e cinco do processo/item, todos com ator LDAP e imagens completas. Imagens finais dos formatos têm três campos; as do item46 e do processo14 campos físicos. Os três snapshots oficiais12.2 before/maintained/after confirmam sete formatos antigos integralmente idênticos, fornecedor consultado preservado, e nenhum movimento financeiro, alocação ou envio. Nenhum título, container, nota ou estoque foi associado ou alterado.

Limpeza pelas APIs: excluídos83/84→item3211→processo1688;82 já estava excluído na etapa de manutenção. O snapshot físico final deixou vazios os cinco grupos do escopo, preservou os sete formatos originais e manteve CURRENT84. Todos os logs congelados antes da limpeza permaneceram idênticos; exclusões finais possuem ator e imagem anterior. Recibos `exercise/confirmed-{audit,final}.json`, `physical-{before,maintained,after}/probe.json`, `access/{applied,verified}.json`, `sequence-applied.json`, `authorizations-used.json`. Todos os gates foram consumidos.

O cadastro nativo é de edição em grade: inclusões, alterações e exclusões usam **Salvar lote**/endpoint batch. Não publica create/update/delete avulsos de formulário. A primeira chamada de teste ao create avulso foi recusada404 antes de executar; a retomada guardada preservou o pai já confirmado e usou batch. Um texto de teste acima40 foi recusado422 e outro cortado pela guarda local antes do POST; apenas os estágios ainda não executados foram retomados, com recibos anteriores preservados. Esses ajustes ocorreram nas ferramentas de teste; nenhum fonte de produção foi alterado durante o cenário.

Na interface, Logs do registro83 mostrou evento65036/tx30169, usuário Tadeu Parreiras e descrição anterior/atual. Depois da limpeza, Logs Exclusão mostrou somente os três eventos de exclusão, com usuário e dados anteriores disponíveis. A consulta principal voltou aos sete registros originais e exibe IDs inteiros sem casas decimais. Imagens em `ui-update-65036.jpg`, `ui-final-seven-originals.jpg` e demais recibos privados do recorte.
