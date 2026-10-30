# Candidato isolado: processos API pelo Builder

Estado em 16/10/2026: **extensão restrita integrada ao canônico após autorização explícita do usuário; nenhum processo publicado ou executado contra API de negócio**. O Painel e suas consultas somente leitura foram preservados. A query 1.0.2 foi publicada pelo responsável pela integração.

O usuário respondeu **“Autorizar a extensão restrita descrita (recomendado)”** à pergunta que identificava os dez arquivos e quatro testes deste documento. A aplicação foi limitada a esses arquivos, com SHA-256 de todos os originais/candidatos validado antes da primeira escrita, backup privado em `.runtime/api-process-review/before-approved-apply/` e evidência em `approved-apply-result.json`. A escalação com essa autorização específica foi aprovada. O smoke integrado usa `from 'playwright'` e somente scripts canônicos, sem seletor de candidatos por variável de ambiente.

Validação após aplicar: PHP canônico **413 testes / 2161 asserções sem avisos**, lint PHP dos dois serviços e `lint:container` verdes; sete JavaScripts passaram syntax check e dois schemas JSON foram parseados. Smoke ProcessEngine com Kendo real e oito smokes RO passaram (contextual leitura/escrita, retorno, posição rowLink, formato pt-BR, query-options, context-collections e batch), além de linkedPage legado. Geração adicional comprovou CRUD padrão sem ação run/process, endpoint legado sem allowProcess/processOptions e fonte sem opt-in preservada. Publicação e execução fiscal continuam fora desta autorização.

O material exato está em `D:/opencode/conversao-sc/.runtime/api-process-review/`. `manifest.json` registra SHA-256 do arquivo canônico original e do candidato, destino e patch individual. A pasta `patches/` contém dez diffs somente da extensão de processos, calculados sobre a árvore atual com as alterações RO preservadas. Mudança de hash original exige revisar novamente o patch.

## Histórico da revisão e isolamento anterior à autorização

A revisão automática de aprovação rejeitou a gravação do runtime API e depois a gravação compartilhada do ProcessEngine. A razão informada foi o alcance da execução genérica de operações potencialmente mutáveis no runtime compartilhado e a necessidade de revisar melhor o escopo. As gravações rejeitadas não ocorreram. A parte Builder inicialmente aplicada foi retirada para restaurar o baseline. Não foi feita nova tentativa ampla nem transferência da aplicação para outro agente.

O pedido do usuário de implementar o Painel está registrado na proposta; o bloqueio acima foi da revisão automática da ação de gravação. O material isolado permitiu delimitar a autorização específica posterior e a aplicação descrita no início deste documento. A aprovação para aplicar o código não implica publicar nem executar processos fiscais.

## Contrato fechado proposto

O programa referencia uma entidade API já cadastrada e uma operação da fonte. Não recebe URL, SQL, código JavaScript, tabela nem credencial no JSON de programa.

```json
{
  "pageType": "process",
  "builderEntityCode": "<entidade API cadastrada>",
  "processOptions": {
    "operationCode": "<operacao cadastrada>",
    "parameterFields": [],
    "confirmation": {
      "message": "<efeito de negocio a confirmar>",
      "confirmText": "Processar"
    }
  },
  "contextFields": [
    {"field": "container_id", "required": true, "readonly": true}
  ]
}
```

Os demais campos obrigatórios usuais do rascunho Builder continuam obrigatórios. `parameterFields` tem até 30 nomes distintos de campos existentes e tipos escalares suportados. O contexto é declarado separadamente, fixo e validado como inteiro positivo int32. O conjunto de nomes contextuais deve coincidir com `requestContextFields` da operação cadastrada. A confirmação é obrigatória no programa Builder.

Há dois opt-ins explícitos. A operação cadastrada precisa de `allowProcess: true`, `type: "custom"`, `method: "POST"`, caminho configurado e fonte com `responseContract: "sursum-programs"`. O Builder gera o endpoint assinado `run`, com `handler: "entity.api.crud"`, `operation: "process"`, `allowProcess: true`, entidade e opções fixas, e permissão `<prefixo>.process`. Um endpoint legado ou payload que apenas diga `operation: "process"` não habilita a operação.

A permissão é resolvida antes de HTTP. O backend só encaminha parâmetros declarados e contexto validado pelo helper existente; rejeita campos adicionais e conflito de parâmetro com contexto. `operation` e `resource` permanecem no `bodyTemplate` estático, que não pode colidir com dados de entrada. O cliente HTTP, autenticação, correlação e registros de transação existentes são reutilizados.

Abrir a página ou a aba `linkedPage.engine: "process"` somente monta os parâmetros. A execução depende do clique e da confirmação Kendo. A resposta aceita mensagem ou grade fechada com até 40 colunas e 5.000 linhas de valores escalares. Resposta inválida, erro ou `success: false` não produz confirmação de sucesso. Relatório externo, navegação por URL de resposta e fila nova estão fora deste candidato.

## Arquivos e alcance exato

| Destino no canônico | Delta | Comportamento proposto |
|---|---:|---|
| `backend/src/Builder/ProgramBuilderService.php` | +80/-7 | Normalizar/importar/exportar `pageType: process`; validar opt-ins; gerar definição e endpoint assinado; reconhecer apenas o próprio `run` no cleanup. |
| `backend/src/Runtime/RuntimeApiEntityActionService.php` | +92/-0 | Novo ramo `process` protegido; parâmetros tipados, contexto, permissão, chamada registrada e resultado fechado. |
| `src/process-engine/ProcessEngine.js` | +38/-3 | Contexto fixo, confirmação declarativa, guardas de permissão/duplicação/destruição e falha explícita. |
| `src/process-engine/ProcessDefinitionValidator.js` | +15/-0 | Validar contexto e confirmação opcionais no motor existente. |
| `src/bootstrap/production-crud.js` | +1/-0 | Repassar contexto de navegação ao ProcessEngine. |
| `src/crud-engine/CrudKendoFormRenderer.js` | +6/-5 | Instanciar ProcessEngine apenas quando a linkedPage declarar esse engine. |
| `src/crud-engine/CrudDefinitionValidator.js` | +2/-2 | Aceitar somente `crud` ou `process` na linkedPage. |
| `src/program-builder/program-builder.js` | +8/-6 | Opção de tipo process e preservação das opções fechadas no JSON existente. |
| `public/metadata/schemas/crud-definition-v1.schema.json` | +1/-1 | Enum fechado de linkedPage. |
| `public/metadata/schemas/process-definition-v1.schema.json` | +4/-2 | Contexto/confirmacão e permissão resolvida. |

O manifesto é a autoridade para hashes e contagens atualizadas. Os quatro testes novos estão no mesmo diretório privado, espelhando `backend/tests/Builder/ProgramBuilderProcessOptionsTest.php`, `backend/tests/Builder/ProgramBuilderApiProcessOptInTest.php`, `backend/tests/Runtime/RuntimeApiProcessTest.php` e `tests/frontend/api-process-context-smoke.mjs`.

## Evidência e comandos

Baseline canônico, executado novamente nesta revisão: **381 testes / 2.113 asserções, sem avisos**. Candidato isolado mais a suíte canônica: **413 testes / 2.161 asserções, sem avisos**. Nenhuma API real de escrita foi chamada; os testes unitários verificam as requisições com doubles e falham caso entradas rejeitadas alcancem HTTP.

O teste de tipo mostrou primeiro falhas reais para data inexistente e hora 24:00 antes de HTTP. O candidato foi endurecido com validação explícita de calendário, hora e fuso; os mesmos casos agora passam.

Comandos de leitura/validação, a partir de `D:/opencode/construtor-pg/backend`:

```powershell
php vendor/bin/phpunit --do-not-cache-result
php vendor/bin/phpunit --do-not-cache-result --bootstrap D:/opencode/conversao-sc/.runtime/api-process-review/bootstrap.php tests D:/opencode/conversao-sc/.runtime/api-process-review/backend/tests/Builder/ProgramBuilderProcessOptionsTest.php D:/opencode/conversao-sc/.runtime/api-process-review/backend/tests/Builder/ProgramBuilderApiProcessOptInTest.php D:/opencode/conversao-sc/.runtime/api-process-review/backend/tests/Runtime/RuntimeApiProcessTest.php
```

Smoke de frontend candidato, a partir de `D:/opencode/construtor-pg`:

```powershell
$env:PROCESS_REVIEW_ROOT='D:/opencode/conversao-sc/.runtime/api-process-review'
node D:/opencode/conversao-sc/.runtime/api-process-review/tests/frontend/api-process-context-smoke.mjs
```

Resultado: PASS com Kendo real; abertura da página/aba faz zero execuções, contexto continua fixo após adulterar widget, cancelar faz zero chamadas, permissão negada impede chamada, falha não confirma sucesso, segundo clique e destruição durante confirmação não executam. O teste usa arquivos candidatos somente quando presentes; o restante é carregado do canônico. Seu import de Playwright tem caminho absoluto apenas para esta execução isolada e deverá voltar a `from 'playwright'` antes da integração do teste.

## Limites da integração autorizada

Os dez patches e quatro testes foram integrados com os guards acima. Nenhuma tela publicada foi alterada para ganhar `allowProcess` ou endpoint `run`. Metadados de negócio, importação, publicação, compilação ABL e execução fiscal permanecem responsabilidade da etapa seguinte; esta integração não os altera. Os comandos do candidato isolado permanecem registrados para reproduzir a revisão anterior; a validação pós-integração usou os arquivos canônicos diretamente.
