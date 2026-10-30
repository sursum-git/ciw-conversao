# Integração de empresas com o construtor

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Publicar o cadastro de `espec.empresas` no frontend existente do construtor-pg, com metadados JSON e CRUD Progress consumido pelo PHP.

**Architecture:** A entidade `empresas_progress` usa o handler existente `entity.api.crud`; os JSONs são cadastrados pelo fluxo autenticado do Program Builder. Uma API ABL fechada atende as cinco operações. O PHP reconhece o contrato de erros Sursum somente quando a fonte está explicitamente configurada para esse contrato.

**Tech Stack:** Frontend Kendo/jQuery existente, PHP 8.4/Symfony 8, PostgreSQL local apenas para metadados, OpenEdge 12.2 e PASOE.

**Spec:** `../specs/2026-10-14-empresas-construtor-design.md`, aprovada pelo usuário em 14/10/2026 com a instrução “faça”.

## Global Constraints

- Não criar uma segunda interface nem alterar a biblioteca `kendo/`.
- Cultura e mensagens permanecem pt-BR.
- O JSON da tela contém somente `endpointId`; URLs e autenticação das APIs ficam no backend.
- O banco de negócio continua sendo `espec`, tabela `empresas`.
- `nome`: texto de até 50 caracteres, incluindo acentos; preservar a possibilidade de vazio.
- `empresa_id`: identificador inteiro gerado no servidor, somente leitura no formulário.
- Não criar tabela física PostgreSQL para empresas nem copiar seus dados.
- Compilar ABL no OpenEdge 12.2.12, publicar e validar no PASOE padrão `sursum-api`, contexto `med`, HTTPS 9911.
- Preservar a correção prévia de `SeedRuntimeMetadataCommand.php` e os serviços locais instalados.
- Verificar schema, índices, triggers e dependências antes de implementar as gravações; não alterar o schema implicitamente.

## Review Focus

1. Erro de negócio em HTTP 200 não pode produzir confirmação de gravação.
2. ID enviado na inclusão não pode escolher a chave; IDs conflitantes em alteração devem ser rejeitados.
3. Nome com 50 caracteres Unicode deve passar; 51 devem falhar sem gravação.
4. Filtros precisam atualizar o total e alcançar toda a lista, sem dupla paginação.
5. Inclusões concorrentes precisam preservar unicidade; conflito deve ser explícito, com rollback.

## Task 1: Confirmar o contrato físico e preparar a publicação

**Files:** documentação operacional existente em `D:/opencode/motor-progress/v2/context/`; registrar evidências sem credenciais em `D:/opencode/conversao-sc/docs/integracao-empresas-validacao.md`.

**Interfaces:** produz tipos físicos, índice único do ID, triggers, dependências de exclusão, versão do compilador, caminho do catálogo efetivo e configuração TLS/PASOE a consumir nas demais tarefas.

- [x] Autenticar com acesso já autorizado nos hosts `192.168.0.111` e `192.168.0.42`. Preservar verificação de host e certificado.
- [x] Ler os metadados de `espec.empresas`, índices e triggers; não consultar dados sensíveis desnecessários.
- [x] Confirmar o roteador `/SursumPrograms`, o catálogo efetivo, PROPATH e o caminho de publicação da nova API.
- [ ] Definir massa isolada para os testes de gravação conforme o schema/triggers encontrados. Se não houver cenário seguro, deixar a validação operacional de escrita explicitamente pendente.

**Preflight já realizado:** SSH de ambos os hosts respondeu, mas `BatchMode` não encontrou autenticação autorizada disponível. A porta 9911 e o SMB/445 não responderam dentro do prazo inicial; SSH permite investigar a instância e usar o caminho de publicação documentado. O usuário foi consultado sobre o acesso SSH; nenhuma senha de outro host foi reutilizada.

## Task 2: Fazer o PHP reconhecer erros do contrato Sursum

**Files, relativos a `D:/opencode/construtor-pg`:**

- Modify: `backend/src/Builder/ProgramBuilderService.php`
- Modify: `backend/src/Runtime/RuntimeApiEntityActionService.php`
- Modify: `backend/src/Runtime/RuntimeExternalJsonClient.php`
- Create: `backend/tests/Runtime/RuntimeExternalJsonClientTest.php`
- Modify: `backend/tests/Runtime/RuntimeApiEntityActionServiceTest.php`

**Interfaces:** configuração backend `apiSource.responseContract = "sursum-programs"`, com padrão `generic`. O cadastro reutilizável e sua resolução precisam preservar esse campo. `RuntimeExternalJsonClient::request(..., array $context)` recebe o contrato pelo contexto; o frontend não recebe URLs ou segredos.

- [x] Criar testes que comprovem: contrato opt-in com HTTP 200 + `error` lança `RuntimeHttpException`; fonte genérica conserva o comportamento anterior; HTTP de falha e JSON inválido continuam falhando; código, mensagem e status seguros do erro Sursum chegam ao runtime.
- [x] Executar os testes e confirmar a falha específica de erro de negócio ainda aceito como sucesso.
- [x] Implementar normalização do contrato em fonte inline, catálogo reutilizável e resolução do vínculo. Aceitar somente `generic` e `sursum-programs`.
- [x] Propagar a configuração pelo contexto da chamada HTTP e rejeitar envelope `error` no contrato opt-in, sem registrar autenticação ou expor corpo bruto sensível.
- [x] Executar `php vendor/phpunit/phpunit/phpunit --no-coverage tests/Runtime/RuntimeExternalJsonClientTest.php tests/Runtime/RuntimeApiEntityActionServiceTest.php` e os testes do builder relacionados à normalização.

## Task 3: Implementar e compilar a API Progress

**Files, relativos a `D:/opencode/motor-progress/v2`:**

- Create: `sursum-api/programs/EmpresasCrud.p`
- Create: `sursum-api/programs/EmpresasCrudService.p`
- Create: `tests/abl/RunEmpresasCrudTests.p`
- Modify: `conf-web-handler/program-routes.json`, acrescentando somente a nova rota ao catálogo local; mesclar com o catálogo efetivo na publicação.

**Interfaces:** `EmpresasCrud.p` recebe INPUT JsonObject e devolve OUTPUT JsonObject. O destino é fixo `espec.empresas`. O serviço interno recebe o buffer autorizado pelo wrapper; testes podem usar buffer de temp-table. Nenhum nome de tabela ou programa vem do JSON HTTP.

| `operation` | Entrada | Saída |
| --- | --- | --- |
| `read` | objeto com a operação | `{"data":[...]}`: lista completa, ordenada pelo ID |
| `get` | `id` e/ou `empresa_id`, consistentes | `{"data":{...}}` |
| `create` | `nome`, `cod_emp_ems2`, `cod_emp_ems5` | `{"data":{...}}`, com ID gerado |
| `update` | ID do alvo e campos graváveis | `{"data":{...}}`, sem alterar a chave |
| `delete` | ID do alvo | `{"success":true}` |
| falha | qualquer operação | `{"error":{"code":"...","message":"...","status":422}}`, com status adequado ao caso |

- [x] Criar testes ABL com temp-table isolada para leitura, ausência, acentos, nome de 50/51 caracteres, inteiros inválidos, vazio para zero e proteção do ID; confirmar falhas antes da implementação.
- [x] Implementar validação dos quatro campos e das cinco operações, rejeitando campos/operações desconhecidos.
- [x] Implementar leitura NO-LOCK e escrita em transação curta com lock exclusivo sem espera indefinida. A geração de ID depende do índice único confirmado na tarefa 1; conflito gera rollback e erro explícito, sem schema novo.
- [x] Compilar o serviço, wrapper e testes no compilador 12.2, sem depender de conexão de negócio para compilar quando o uso de buffers dinâmicos permitir. Exigir `COMPILER:ERROR=false` e logs novos sem erros.
- [ ] Executar os testes ABL, incluindo concorrência com fixture isolada quando aplicável. Confirmar que nenhum registro operacional foi usado como massa descartável.

## Task 4: Cadastrar metadados, publicar e validar a tela

**Files:**

- Create em `D:/opencode/construtor-pg/integrations/ciw-empresas/`: `api-source.json`, `builder-draft.json`, `README.md`.
- Create em `D:/opencode/conversao-sc/tools/construtor-local/`: `import-empresas.ps1`, `verify-empresas.cjs`.
- Update: especificação aprovada e `docs/implantacao-local-construtor.md`, com o resultado real da entrega.

**Interfaces:** fonte API `motor_progress_empresas`, entidade `empresas_progress`, programa `cd0090`, `screenId=ciw.empresas`, módulo existente `cadastros`, assinante local Principal. `builder-draft.json` contém `entityDraft` e `programDraft`, no formato aceito por `validateExternalDraft`. O formulário e o grid são gerados pelo builder existente.

- [x] Criar JSONs com `responseContract=sursum-programs`; cinco operações POST na rota fechada, com `bodyTemplate.operation` estático; `itemsPath=data`, `itemPath=data`, sem `totalPath` para contar a lista filtrada no PHP.
- [x] Incluir os quatro campos, ID readonly, limite de 50 caracteres do nome, inteiros e opções de exibição/filtro por `apiJsonPath`. Não tornar o nome obrigatório por uma regra inventada.
- [x] Validar o rascunho com o backend real antes de cadastrar. Testar rejeição de JSON inválido/URL inline na tela.
- [x] Cadastrar fonte, entidade e rascunho pelos endpoints oficiais autenticados do builder; adquirir os locks de edição exigidos, preservar integridade e publicar pelo fluxo autorizado de governança. Não inserir metadados diretamente por SQL para contornar o builder.
- [x] Publicar os compilados novos, fontes pertinentes e a rota mesclada, mantendo backup e verificando hashes. Recarregar somente o necessário da instância alvo.
- [ ] Testar HTTP real: read, get, registro ausente, validação e erros; testar escrita apenas com a massa isolada definida na tarefa 1. Registrar separadamente o que foi compilado, publicado e validado.
- [x] Abrir `http://127.0.0.1:8765/production/app.html?screenId=ciw.empresas`; verificar grid, filtros, paginação, abertura do formulário e preservação dos quatro campos com o frontend original. Não alterar demonstrações, mocks ou a biblioteca Kendo.
- [x] Executar a suíte PHP relacionada, o teste ABL pertinente, o teste de integração da tela e `app:integrity:monitor --fail-on-invalid`. Rever o diff e registrar limitações reais antes de afirmar conclusão.

## Revisão do plano

O plano cobre a especificação e usa a instalação local já validada. Os principais riscos estão explicitados nos testes: erros HTTP 200, ID imutável, Unicode, dupla paginação e concorrência. O teste de escrita real depende dos metadados e do cenário isolado; não será substituído por sucesso de echo. A execução recomendada é nativa, nesta conversa, pela dependência sequencial entre schema, API e metadados.

## Resultado da execução

Consulta/formulário publicados e verificados. Programa final `cd0090`; `ciw.empresas` é o screenId. Transporte efetivo por SSH loopback até 9910 da mesma instância sursum-api/med; HTTPS 9911 não foi validado. Credencial privada em cabeçalho X-Empresas-Token, rotacionada após revisão. Recusas incluem success=false. Testes de escrita operacional e concorrência dependem de autorização explícita solicitada após rejeição da revisão automática; 33 verificações CRUD passaram em temp-table. As pendências acima permanecem abertas por esse motivo. Ver docs/integracao-empresas-validacao.md e ledger.

## Validação operacional concluída em 15/10/2026

Autorização explícita recebida do usuário. Testes CRUD pelo PHP e quatro inclusões simultâneas no PASOE aprovados; IDs distintos; registros de teste removidos; empresas preexistentes preservadas. As pendências de autorização/escrita acima são históricas e foram resolvidas. Não foi provocado conflito mantendo um lock em outra sessão. Relatório atualizado em docs/integracao-empresas-validacao.md.
