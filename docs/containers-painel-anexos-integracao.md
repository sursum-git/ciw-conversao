# Anexos do Container: acervo e integração

Análise de fontes locais em 16/10/2026, sem acessar ou modificar o filesystem remoto, executar upload/download de negócio, alterar runtime ou preparar novos patches de processos. A aba publicada entrega **metadados somente leitura**. Arquivos autenticados e manutenção ainda exigem extensão genérica do construtor e serviço específico de integração.

## Acervo legado identificado

O formulário é `sources/scriptcase/containers/form_anexos_container/`. O arquivo `form_anexos_container.php` apenas inclui `index.php`. Este inicializa os caminhos vazios (`index.php:42–47`), deriva a raiz de publicação do caminho do script (`:63–79`) e define:

| Uso | Caminho derivado pelo fonte | Implantação registrada neste projeto |
|---|---|---|
| Documentos definitivos | `<raiz ciw>/_lib/file/doc` (`index.php:101–103`) | `/var/www/clients/client1/web2/web/ciw/_lib/file/doc`, servidor Scriptcase `.170` |
| Temporários | `<URL ciw>/_lib/tmp`, convertido com `root` em caminho físico | `/var/www/clients/client1/web2/web/ciw/_lib/tmp` |
| Cache | `<raiz ciw>/_lib/file/cache` | `/var/www/clients/client1/web2/web/ciw/_lib/file/cache` |

O caminho absoluto acima é **derivado do código e da implantação registrada**, não um diretório inspecionado nesta análise. Existência física, symlinks, montagem, ACL, volume e disponibilidade atual ainda não foram comprovados. O fonte não cria subdiretório por container: os documentos dividem a pasta global `_lib/file/doc` com outras aplicações que utilizem essa configuração.

O destino final é `path_doc + "/" + nome`, sem prefixo adicional de container (`form_anexos_container_apl.php:3835`, `:5351`, `:5436–5445`). O valor persistido em `caminho_arquivo` é o nome do arquivo escolhido/renomeado, normalmente basename, não o caminho absoluto do diretório. A leitura futura precisa resolver o nome existente **a partir do registro autorizado**, sem receber um caminho do navegador.

O formulário usa `PUB.anexos_container` (`index.php:5623`), corresponde a `espec.anexos_container` no schema coletado `integration-src/container-panel/schema/schema-anexos_container.json`:

| Campo | Tipo físico e evidência | Regra observada |
|---|---|---|
| `anexo_container_id` | INTEGER, índice primário único | Legado calcula `MAX + 1` (`apl.php:5289–5302`); não reutilizar esta concorrência insegura na API nova. |
| `container_id` | INTEGER | Lista filtrada por sessão `container_corrente` (`:5953`); inclusão assume o contexto quando vazio (`:4936`). Público: mesmo número `nr-container`, denominado `container_id`. |
| `item_container_id` | INTEGER | Persistido pelo formulário; não há prova local de validação de pertencimento ao container. |
| `descricao` | CHARACTER, formato `x(400)` | Validação e input do legado permitem 800 caracteres (`:3597`, `form0.php:1789`). Formato Progress não prova limite de armazenamento; definir limite de API sem truncar o acervo. |
| `tipos_anexo_id` | INTEGER | Lookup em `PUB.tipos_anexo`, chave singular `tipo_anexo_id`, descrição ordenada (`apl.php:9136`); seleção fora do lookup é recusada quando não vazia (`:3624`). |
| `caminho_arquivo` | CHARACTER, formato `x(200)` | Referência de arquivo; somente o servidor novo poderá definir seu valor. Formato não é limite físico comprovado. |
| `dt_hr_arquivo` | DATETIME | Inclusão define hora local do PHP (`:5304–5305`); edição inclui o valor do formulário no UPDATE. Não há timezone gravado. |

Todos os campos aparecem sem obrigatoriedade física/triggers no schema coletado. Isso não equivale a autorizar registros vazios no novo fluxo. O formulário tampouco evidencia arquivo obrigatório; há linhas com referência vazia possíveis. Uma validação nova não deve impedir a leitura dessas linhas antigas.

## Comportamento real de arquivo no legado

- Upload de um arquivo por campo, temporário em `_lib/tmp`, expressão permitida `/.+$/i` e `upload_max_size: null` (`apl.php:527–538`). A validação de extensão passa uma lista vazia (`:3671`). Portanto, **não existe allowlist ou limite numérico configurado neste app**. `upload_max_filesize`, `post_max_size` e limite do servidor web não vieram nos fontes e não foram consultados.
- A rotina `fetchUniqueUploadName` (`:4739–4804`) lista a pasta, preserva o nome quando livre e tenta `nome(1).ext`, `nome(2).ext` quando já existe. O cache dessa lista é de sessão, sem reserva atômica; não usar este mecanismo como garantia de concorrência para novos uploads.
- Inclusão grava o registro SQL e depois escreve os bytes no destino (`:5360`, `:5436–5445`). Edição de arquivo escreve o novo destino durante a preparação (`:3835–3849`). Não há transação atômica entre disco e banco comprovada.
- Limpar o arquivo limpa a referência no UPDATE (`:5094–5110`). Os únicos `unlink` encontrados no arquivo de aplicação são de imagem gerada/cache e exportação temporária (`:2267`, `:2935`, `:2998`), não do documento em `path_doc`. O caminho de exclusão remove a linha por ID (`:5782–5803`); não há evidência de apagar o arquivo físico. Não converter esse comportamento em remoção física automática.
- O botão de download abre `form_anexos_container_doc.php` com `nm_cod_doc`, nome e aplicação (`form_anexos_container_js0.php:517`). Esse handler, `form_anexos_container_doc_name.php`, o handler de upload e a sessão/bibliotecas Scriptcase não estão entre os fontes locais baixados. Não foi possível comprovar como o handler autoriza a leitura ou protege nomes; não reutilizar essa URL como API autenticada do novo Painel.
- `nm_proc_onload_record` está vazio e `nm_proc_onload` só guarda/formata campos (`apl.php:4810–4818`). Nenhuma escrita de documento ao abrir foi evidenciada neste formulário.

## O que já existe no construtor

Referências abaixo relativas a `D:/opencode/construtor-pg`:

| Recurso existente | O que pode ser reaproveitado | Gap para anexos |
|---|---|---|
| `src/crud-engine/CrudKendoFormRenderer.js:2264` | Formulários, campos escalares e botões/abas existentes; Kendo local. | O seletor de editores não tem upload/arquivo; tipo desconhecido termina como TextBox. Declarar `file` no JSON não entrega upload. |
| `src/crud-engine/CrudHttpClient.js:16` | Cabeçalhos de autenticação/sessão/tenant, tratamento de sessão expirada. | O transporte serializa JSON e lê JSON. Não implementa `FormData`, progresso ou retorno Blob. |
| `backend/src/Controller/RuntimeController.php:42` | Rota por tela/endpoint e dispatcher existentes. | POST faz `json_decode` do corpo e retorna JsonResponse; GET desse caminho é SSE, não download binário. Multipart não cabe sem contrato aditivo próprio. |
| `backend/src/Runtime/RuntimeEndpointDispatcher.php:39`, `:219–225` | Sessão ativa, permissão por endpoint e integridade estrutural. | Novo transporte de arquivos deve executar os mesmos gates, sem bypass por controller/URL direta. |
| `backend/src/Runtime/RuntimeExternalJsonClient.php:84` | Autenticação server-side, correlação e logs Progress. | Codifica entrada como JSON e exige resposta JSON/array; não transmite multipart nem streaming binário. A arquitetura documenta explicitamente ausência de upload (`docs/arquitetura-crud-engine.md:375`). |
| `src/printing/PrintingBridgeClient.js:13`, `backend/src/Printing/Delivery/DownloadArtifactDelivery.php` | Download de payload `fileName/contentType/contentBase64` gerado pelo servidor para Blob e link temporário. | É entrega de relatórios/documentos já produzidos, não armazenamento/ownership de anexos. Base64 copia o arquivo em memória e aumenta o payload; não assumir adequado para acervo sem limite. |
| `backend/src/Controller/SubscriberProvisioningController.php:166` | Exemplo real de BinaryFileResponse autenticado de pacote gerado pelo servidor, com hash. | Restrito a provisionamento central; não autoriza arquivo do usuário nem um caminho livre. Serve de referência de transporte, não endpoint de anexos. |
| Import/export XML/CSV e exportações JSON | Serialização de dados e download de saída. | Não são serviço genérico de arquivo persistente vinculado a registro/container. |

A API publicada do Painel lê `anexo_container_id`, `container_id`, `item_container_id`, `descricao`, `tipos_anexo_id`, `dt_hr_arquivo` e adiciona descrição do tipo e `tem_arquivo` (`integration-src/container-panel/ContainersPainelReadService.p:147–153`, `:218–219`). **`tem_arquivo` indica referência não vazia**, não existência dos bytes: o serviço não acessa a pasta do Scriptcase. O caminho físico não é exposto no JSON da grade. A entidade/tela atual é `container_anexos_progress` / `ciw.container-anexos`, programa `op1004`, fonte `motor_progress_container_painel`.

## Contrato mínimo proposto, ainda não implementado

Manter os metadados na API Progress e colocar um adaptador de armazenamento próximo do acervo. PASOE está no `.111`; o acervo derivado está no `.170`; não há montagem ou acesso compartilhado comprovado. Não configurar caminhos/credenciais no JSON público nem presumir que o PHP local, o PASOE e o Scriptcase enxerguem a mesma pasta.

O motor de formulário deve ganhar uma seção declarativa fechada de anexos, reutilizando Kendo e o transporte autenticado do construtor. Os endpoints da seção seriam cadastrados e assinados por tela, com `contextFields` exigindo `container_id` e operações explicitamente permitidas. Nome público de endpoint não é um caminho de arquivo. Contrato de negócio sugerido:

| Operação | Entrada do cliente | Validação/resultado |
|---|---|---|
| Listar/detalhar | `context.container_id`, `anexo_container_id` opcional | Reutilizar consulta RO, sempre confirmando vínculo. Acrescentar disponibilidade real somente se houver resposta do adaptador, distinguindo ausente/indisponível. |
| Baixar | `context.container_id`, `anexo_container_id` | Backend relê registro e vínculo, resolve referência server-side, verifica confinamento na raiz configurada e devolve bytes autenticados com nome seguro, MIME detectado, `Content-Disposition: attachment`, `nosniff` e sem cache compartilhado. Não receber URL, path ou nome como autoridade. |
| Incluir | Multipart com um arquivo e metadados fechados `descricao`, `tipos_anexo_id`, `item_container_id` opcional, contexto | Sessão/permissão/contexto antes de aceitar bytes persistentes; validar tipo cadastrado e item pertencente ao container. ID/data/referência/hash/tamanho definidos no servidor. Sucesso só depois de arquivo durável e registro confirmado. |
| Alterar metadados | ID, contexto e campos permitidos | Sem editar `caminho_arquivo`, container, autoria, hash ou data de criação. Aplicar concorrência/lock e auditoria anterior/atual. |
| Substituir arquivo | ID/contexto + novo arquivo, ação explícita | Novo objeto e nova referência; nunca sobrescrever o arquivo antigo. Preservar bytes anteriores para rastreabilidade. |
| Excluir vínculo | ID/contexto e confirmação explícita | Excluir/desativar registro segundo regra a validar. Não apagar bytes antigos automaticamente: o legado não comprova ownership exclusivo e a pasta é compartilhada. |

O contrato de transporte final precisa ser uma extensão genérica aditiva: métodos autenticados de upload e download, endpoint/controller apropriado para multipart/binário e schema fechado para a seção de formulário. O transporte de leitura não deve executar operação de manutenção. A referência de armazenamento para arquivos novos deve ser opaca, gerada no servidor, confinada à raiz e reservada atomicamente. Acervo antigo continua lido pelo nome salvo, sem renomear ou regravar linhas durante a abertura. Se uma referência legada contiver separadores, URL, symlink de saída ou caminho fora da raiz, retornar indisponibilidade e registrar a inconsistência para tratamento; nunca normalizar silenciosamente para outro documento.

Como banco e disco não compartilham transação, usar estágio privado e confirmação idempotente: receber/validar arquivo, reservar nome único, confirmar armazenamento, gravar vínculo em transação e somente então responder sucesso. Falha entre etapas precisa de compensação do objeto novo sem excluir objeto prévio e de estado reconciliável; retry não pode duplicar registro. Não manter lock de banco durante envio lento. Registrar usuário/sessão/tenant/container/anexo, tamanho/hash e resultado; não registrar conteúdo, token ou caminho sensível na UI.

## Limites e decisões pendentes

São limites **comprovados**: um arquivo por campo no legado; nenhuma allowlist numérica/limite de tamanho no app; descrição 800 na validação Scriptcase; limites de upload de PHP/webserver desconhecidos; nenhuma API de armazenamento autenticado pronta no construtor. O schema Progress coletado contém formatos de exibição, não uma política de tamanho dos arquivos.

Para novos uploads, a configuração do servidor deve exigir `maxBytes` positivo e lista explícita de extensões/MIME permitidos, com o menor limite aplicado também no proxy/PHP/adaptador e durante a leitura incremental. Não fixar um valor arbitrário como se fosse regra aprovada do cliente. Inventariar tipos/tamanhos do acervo antes de propor valores; leitura histórica pode continuar como attachment mesmo para extensões não aceitas em novos uploads. Não executar HTML/scripts/SVG do acervo inline. Nome original é metadado de apresentação, jamais chave autorizadora. Upload vazio, corpo maior que o limite, conteúdo incompatível, extensão dupla/traversal, MIME falsificado, colisão e arquivo incompleto precisam de erro fechado.

Antes de implementar/publicar, faltam evidências concretas:

1. Inventário RO autorizado do diretório derivado: existência/canonicalização, symlinks, ACL, quantidade/tamanhos/tipos, arquivos faltantes e nomes repetidos por registro; hashes para amostra e plano de preservação. Nenhum inventário remoto foi feito nesta análise.
2. Obter handlers legados de download/upload e sessão citados nos fontes; mapear autenticação atual sem copiar segredos. O diretório encontrado no código não comprova proteção HTTP do acervo.
3. Escolher onde roda o adaptador de armazenamento e seu acesso autenticado ao acervo. Essa decisão depende da topologia real; não há transporte entre `.111`, `.170` e o backend comprovado.
4. Definir limite de bytes, tipos permitidos novos, retenção, política de substituição/exclusão e eventual inspeção de conteúdo; validar descrição 800 versus metadado atual, sem truncamento.
5. Implementar gerador de ID concorrente na API Progress, transação/vínculos/tipo e item, storage staging/compensação/idempotência e testes de falha entre banco/disco. Não copiar `MAX + 1`.
6. TDD genérico do transporte e da seção de formulário: sessão inválida, permissão/contexto cruzado, path/URL forjado, conflito de item/container, limite exato e excedido, cancelamento/retry, colisão, erro de escrita e leitura de acervo sem alteração de hash. Testes reais de manutenção somente em registros/arquivos novos marcados para teste e com limpeza autorizada.

Esta análise não muda o status da entrega: listar metadados funciona; acessar bytes legados e fazer upload permanecem pendências explícitas do Painel completo.
