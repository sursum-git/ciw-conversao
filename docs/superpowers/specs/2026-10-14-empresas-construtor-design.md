# Empresas do Scriptcase no construtor-pg

## Objetivo e decisões

Converter `grid_empresas` e `form_empresas` do CIW em um programa CRUD renderizado pelo frontend existente do `construtor-pg`, usando exclusivamente metadados JSON para a interface. O banco de negócio continua sendo `espec`, tabela `empresas` (qualificação SQL original `PUB.empresas`). PHP intermedeia as APIs Progress do projeto motor-progress.

O clone está em `D:/opencode/construtor-pg`, revisão inicial `5940682`. Não criar uma segunda interface nem alterar a biblioteca `kendo/`. Cultura e mensagens permanecem pt-BR. O JSON da tela contém somente `endpointId`; URLs e autenticação das APIs ficam no backend.

## Evidência das telas originais

Os fontes analisados estão em `D:/opencode/conversao-sc/sources/scriptcase/`, copiados do servidor `192.168.0.170`, pasta `/var/www/clients/client1/web2/web/ciw`.

| Campo | Comportamento a preservar |
| --- | --- |
| `empresa_id` | Identificador inteiro gerado no servidor; somente leitura no formulário. O original usa máximo existente + 1. |
| `nome` | Texto de até 50 caracteres, incluindo acentos. A validação analisada não exige preenchimento. |
| `cod_emp_ems2` | Inteiro; o original transforma campo vazio em zero. |
| `cod_emp_ems5` | Inteiro; o original transforma campo vazio em zero. |

A geração do ID precisa preservar a unicidade com inclusões concorrentes, sem acrescentar uma sequência ou alterar o schema implicitamente. Antes de implementar a gravação, verificar índice único, triggers, dependências de exclusão e tipos físicos da tabela no ambiente real. O botão de logs do Scriptcase usa `sc_log`; a integração deverá usar a auditoria já existente no runtime do construtor, sem supor que isso migra o histórico antigo.

## Metadados e construção do programa

Usar `entityType=api`, já suportado pelo Program Builder, em vez de uma entidade PostgreSQL persistente. O builder conhece os campos por `apiJsonPath` e publica `entity.api.crud`. Não criar tabela física PostgreSQL para empresas nem copiar seus dados.

Preparar os cadastros JSON de fonte API, entidade e rascunho de programa. O fluxo de importação externa existente aceita `entityDraft` e `programDraft`; o backend valida o rascunho antes da carga no editor. Salvar e publicar pelo fluxo normal do builder conserva versionamento, permissões e governança.

Tela proposta: `ciw.empresas`, título Empresas, com os quatro campos no grid, busca pelo nome e filtros exatos pelos códigos. Formulário Kendo existente em janela com inclusão, consulta, alteração e exclusão. `empresa_id` não pode ser alterado pelo cliente. Ações seguem as permissões reais de backend; flags na definição não concedem acesso.

`empresas-screen-proposta.json` acompanha esta especificação como amostra de desenho da tela, para validação pelo normalizador e validador reais do frontend. Não é uma tela publicada nem substitui o cadastro do programa no builder.

## Contrato da integração

| endpointId do runtime | Operação Progress | Retorno de negócio |
| --- | --- | --- |
| `read` | `read` | `{ "data": [ empresas ] }` |
| `get` | `get`, ID obrigatório | `{ "data": empresa }` |
| `create` | `create`, campos graváveis | `{ "data": empresaComIdGerado }` |
| `update` | `update`, ID obrigatório e campos graváveis | `{ "data": empresaAtualizada }` |
| `delete` | `delete`, ID obrigatório | `{ "success": true }` |

Uma rota fechada POST `/SursumPrograms/empresas` pode receber a operação por `bodyTemplate` estático e os campos do registro no nível raiz. O cadastro da fonte usa `itemsPath=data` para lista e `itemPath=data` para detalhe/gravação. Nenhum SQL, ABL ou nome livre de tabela é enviado pelo cliente.

O runtime API existente carrega a lista externa e faz filtro, ordenação e paginação no PHP. Para este cadastro pequeno, retornar a lista completa e deixar `totalPath` vazio para contar a lista filtrada. Não combinar uma página Progress com uma segunda paginação PHP: isso ocultaria registros. Incluir ordenação determinística pelo ID. Paginação remota para grandes cadastros fica fora desta entrega.

O roteador JSON do motor-progress devolve HTTP 200 para um JsonObject retornado pelo programa, inclusive quando o objeto descreve um erro de negócio. O cliente genérico `RuntimeExternalJsonClient` atualmente verifica status HTTP, mas não rejeita automaticamente um envelope `error` dentro de HTTP 200. A ponte PHP deverá traduzir os erros de negócio para HTTP de falha antes de devolver a resposta ao runtime, ou a integração deverá incluir um tratamento explícito e restrito para esse contrato no backend. Não permitir que create/update/delete retornem sucesso com uma resposta de erro. O desenho final da ponte depende do endereço de instalação do backend do construtor.

Consultas Progress usam NO-LOCK. Gravações usam transações curtas, lock exclusivo sem espera indefinida e erro explícito em conflito, registro ausente, validação ou dependência. Não manter uma transação Progress aberta durante a edição do formulário. Não anunciar lock de sessão na entidade API: o builder atual não o oferece.

## Validação e publicação

1. Validar a amostra de tela pelo `PageDefinitionNormalizer` e `CrudDefinitionValidator` existentes, em política de produção sem URLs inline.
2. Validar os JSONs de cadastro pelo backend do builder e conferir o preview gerado.
3. Testar chamadas PHP/Progress: leitura, registro ausente, acentos, nome acima de 50 caracteres, inteiros inválidos, IDs imutáveis e erro de negócio dentro de HTTP 200.
4. Testar inclusão concorrente e conflito de alteração/exclusão com massa isolada autorizada. Não usar registros operacionais desconhecidos para testes destrutivos.
5. Compilar ABL no OpenEdge 12.2.12 (`192.168.0.42`), publicar somente os artefatos pertinentes e validar no PASOE padrão `sursum-api`, contexto `med`, HTTPS 9911, conforme as instruções atuais do motor-progress.
6. Abrir `production/app.html?screenId=ciw.empresas` no construtor instalado e verificar consulta, abertura de formulário e CRUD. Testes de contrato locais não comprovam publicação.

## Estado após execução

O usuário autorizou a execução com “faça”. Instalação local realizada, API compilada em 12.2 e publicada na instância sursum-api/med; fonte, entidade e programa cd0090 publicados pelo builder. Consulta e formulário com dados reais passaram. O transporte local usa túnel SSH até o conector HTTP9910 da mesma instância; HTTPS9911 não foi validado. A autenticação usa cabeçalho privado X-Empresas-Token. Escrita operacional e concorrência permanecem pendentes da autorização explícita solicitada após bloqueio da revisão automática. Evidências detalhadas em docs/integracao-empresas-validacao.md.
Atualização de 15/10/2026: autorização operacional recebida; CRUD pelo PHP e quatro inclusões simultâneas reais aprovados. Todos os registros de teste foram excluídos; empresas preexistentes preservadas. A pendência de autorização registrada acima foi resolvida.
