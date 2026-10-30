# Download readonly de anexos do container

Reutilizar op1004/ciw.container-anexos/container_anexos_progress, fonte motor_progress_container_painel e handler autenticado containers-painel. Não criar código/tela/reader redundantes. Nova operação detail POST fixa anexos_arquivo_get/resource anexos-arquivo, get-only, reaproveita mestre e chave contextual do painel; exige prefixo5 antes de ler referência. ABI dos11buffers e2objetos preservada.

Novo adapter PHP RuntimeContainerAttachmentDownload confere binding/contexto/PK/tipos raw/MED antes do mapper/storage. Action reutiliza o mesmo BinaryFileResponse/AttachmentStorageClient/Broker/FilePolicy/RuntimeFileTransferContext já existentes, com owner da sessão e IDs confirmados. O broker e suas políticas históricas não serão alterados. Escritas/upload recusados, mesmo com metadados forjados.

Builder só reconhece download no perfil novo fechado; editor file nativo readonly em caminho_arquivo, contexto obrigatório; definição antiga sem perfil conserva contrato. Propostas de metadata partem do draft histórico para testes, aguardando exports vivos op1004/entity/source para rebase antes de publicar. Root centraliza integração/12.2/publicação; nenhum canônico, rede, negócio, grant ou DDL neste pacote.

Provas: RED recurso inexistente; TT mestre/filho/MED/aliases/NULL/shape + regressão painel; PHP read/get/download reais com transporte mockado e broker real local; IDOR/contexto/binding/ator/freepath/upload negados antes storage; Builder/normalizador real da fonte, JSONSchema/validador e botão nativo readonly. Prova complementar1051_get/detail sem tocar freeze1051. Política storage/root real pendente de preflight readonly do root.
