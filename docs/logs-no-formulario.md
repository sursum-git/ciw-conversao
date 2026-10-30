# Consulta de logs pelo formulário

O botão **Logs** usa a janela Kendo e as consultas administrativas existentes do construtor. Recarregar a página após atualizar o frontend.

1. Abrir um registro em Empresas, Despesas ou Empresas por despesa.
2. Clicar **Logs** na barra do formulário. A consulta `admin.transacoes` recebe o contexto fixo da tela e da chave do registro. Em Tipos de anexo, usar **Logs** na linha persistida da grade; esse acesso abre diretamente os eventos daquele registro, inclusive os eventos individuais de lotes.
3. Na transação desejada, escolher **Visualizar** nas ações da linha. O detalhe abre diretamente a aba **Alterações e eventos**, com o usuário e a comparação **Campo | Anterior | Atual** acima dos eventos. O link **Eventos** da linha também abre a consulta filtrada com o mesmo resumo.

Na consulta, o botão **Logs Exclusão** lista somente os eventos de exclusões confirmadas daquela tela, inclusive linhas excluídas em lotes mistos. Abrir **Visualizar** no evento mostra o usuário e os valores anteriores do registro. Inclusões, alterações, consultas, falhas e outros eventos do lote ficam fora desse acesso.

Os demais logs são acessados pelo botão **Logs** do formulário de um registro existente. Inclusão sem chave não permite abrir um histórico amplo. Em Tipos de anexo, que usa edição em lote, o botão **Logs** fica na linha persistida; linhas novas ou marcadas para exclusão não oferecem esse acesso. A consulta por linha mantém apenas os eventos associados àquele ID, incluindo auditoria individual de lotes, sem mostrar os outros registros do mesmo lote.

As telas administrativas de transações e eventos não repetem o botão Logs. As permissões existentes de leitura das consultas administrativas são exigidas; a navegação não concede permissões. Destinos de logs já customizados nas telas de negócio são preservados. Os escopos de tela, operação e registro são mantidos ao limpar filtros da lista.

## Mensagens do Progress

O programa continua usando `ApiExecutionRepository:logMessage(nivel,mensagem)` conforme [o guia ABL](abl-log-transacao.md). Não é necessário registrar mensagens automaticamente em todas as regras.

O handler retorna `X-Sursum-Execution-Id` e `X-Sursum-Log-Count`. Em chamadas com contrato `sursum-programs`, o PHP associa a execução à transação local e importa os eventos manuais `log.debug/info/warning/error` como `progress.log.*`. Preserva identificação da execução, usuário autenticado, agente, instância e PID disponíveis. Os eventos continuam também no monitor PASOE.

Quando não há mensagens manuais, não existe chamada adicional de consulta de eventos. Uma falha nessa consulta gera aviso seguro na auditoria sem alterar o resultado de negócio. Mensagens passam por redução de credenciais e limite de tamanho. Nunca registrar senhas ou tokens deliberadamente.

O log do Progress usa fila NO-UNDO e grava fora da transação de negócio; por isso mensagens registradas antes de um rollback continuam disponíveis. A auditoria PHP não representa transação distribuída entre PostgreSQL e Progress.

O transporte JSON de `DynamicQueryWebHandler` escreve bytes UTF-8 por MEMPTR. Isso evita respostas declaradas UTF-8 contendo bytes do stream do agente, que impediam o PHP de importar mensagens com acentos.

## Fontes

- Frontend e enriquecimento runtime: `D:/opencode/construtor-pg/docs/crud-logs-transacoes.md`.
- Ponte PHP: `D:/opencode/construtor-pg/backend/docs/logs-progress-transacoes.md`.
- Fontes mínimos dos handlers publicados: `integration-src/program-log-ui`.
- Teste histórico da ponte Progress: `tools/construtor-local/verify-logs-form-ui.cjs`; requer a fixture protegida temporária e navegação antiga. Não executar sem adaptar ao fluxo atual. Regressão do resumo automático: `D:/opencode/construtor-pg/tests/frontend/crud-audit-summary-smoke.mjs`.

Os JSONs assinados das telas não são modificados: o backend acrescenta a configuração depois da verificação de integridade. Não é necessário republicar cada cadastro para receber o botão padrão.

## Usuário e valores anterior/atual

As grades de transações e eventos apresentam **Usuário** e **Código do usuário**. A identidade é capturada da sessão autenticada no início da transação e preservada no histórico; o navegador não escolhe o autor. Registros antigos sem captura de origem verificada continuam sem identificação comprovada.

A comparação aparece automaticamente na primeira aba do detalhe da transação, sem precisar selecionar o evento de gravação. O detalhe individual do evento continua disponível e sua primeira aba **Alterações** também apresenta **Campo | Anterior | Atual**; os JSONs completos continuam na aba Dados. Transações apenas de consulta informam que não registraram alteração de dados. Eventos como `runtime.request` ou mensagens manuais sem snapshot não representam uma comparação de dados gravados; históricos sem captura confirmada exibem a limitação.

A API de Despesas, incluindo Empresas por despesa, devolve um envelope opcional:

```json
{"audit":{"version":1,"source":"progress-transaction","resource":"despesas","operation":"update","recordId":123,"before":{"despesa_id":123,"descricao":"Anterior"},"after":{"despesa_id":123,"descricao":"Atual"}}}
```

O contrato completo contém todos os campos publicados do registro e suas coleções. `before` é obtido do buffer sob o mesmo bloqueio da gravação, antes das atribuições; `after` vem do resultado após sincronizar os filhos. O envelope é anexado somente depois que o bloco transacional termina com sucesso. Na inclusão, `before` é vazio; na exclusão, `after` é vazio. Uma operação recusada não publica snapshot de alteração confirmada.

O PHP valida origem, versão, recurso cadastrado, operação e chave e copia somente campos conhecidos. Nunca usa o payload enviado como registro anterior. APIs que ainda não devolvem esse contrato ficam com a comparação indisponível; nenhuma leitura extra é apresentada como snapshot atômico. Eventos externos antigos/batch sem snapshot confirmado exibem aviso, preservando os dados brutos históricos.

Desde16/10/2026, Empresas e Tipos de anexo também registram esse contrato. Empresas publica os quatro campos empresa_id/nome/cod_emp_ems2/cod_emp_ems5; Tipos publica tipo_anexo_id/descricao. Recursos fechados empresas e tipos_anexo. A ponte reconhece os vínculos legados pela entidade, PK, fonte e rota cadastradas; não confia no recurso declarado somente pela resposta. As quatro telas convertidas dispõem de autoria e comparação em novas gravações confirmadas; históricos anteriores à captura continuam sem valores reconstruídos.

No formulário múltiplo de Tipos de anexo, uma transação contém um lote. A API retorna audit.operation=batch e changes com clientId, operation, recordId, before e after por linha, somente após sucesso integral. O PHP valida todas as linhas contra requisição e results antes de registrar qualquer evento confirmado. A transação não recebe o ID arbitrário de uma das linhas. O botão da linha consulta seus eventos por ID e tela; o botão Logs Exclusão do cabeçalho consulta apenas as exclusões. Cada comparação identifica Registro ID e Inclusão/Alteração/Exclusão. O resumo de lote não usa o input como anterior. Falha em qualquer linha desfaz o lote e não publica snapshots confirmados.

Zero, false, null e ausência são diferentes. A tabela escreve valores como texto e protege campos sensíveis. A identidade possui marcador reservado `source=authenticated-session/version=1`; históricos sem esse marcador não são atribuídos ao usuário atual. Atualizações/exclusões vinculam o ID validado antes da chamada, permitindo consultar também as falhas pelo formulário.

Validação em15/10/2026: OpenEdge12.2,215 verificações em cada cultura AMERICAN/EUROPEAN; PHP295testes/1447asserções; CRUD real de registro novo marcado com usuário, snapshots de inclusão/alteração/exclusão e rollback. Registro de teste removido, originais preservados. Consulta nativa verificada na transação384/evento1177, com usuário Administrador/admin e quatro campos na comparação. Evidências privadas `despesas-snapshots-evidence.json` e `despesas-snapshots-ui-evidence.json` em `.runtime/construtor-pg`. Não reconstruir valores anteriores de registros históricos sem captura.

Validação em16/10/2026 de Empresas/Tipos:82+170 verificações ABL em cada cultura, compiladas no12.2/.42 e publicadas somente os dois serviços no sursum-api/med. PHP306testes/1917asserções; seis smokes frontend, integridade1095/0. Teste real `tools/construtor-local/verify-empresas-tipos-audit.cjs` confirmou CRUD Empresas, lote misto por linha Tipos, rollback sem confirmação, autoria e limpeza; originais comparados integralmente. CUA confirmou transação538/evento1638 de Empresas e549/evento1677 de Tipos; a549 ficou aberta no navegador. Evidência privada `empresas-tipos-snapshots-evidence.json`; manifesto ativo `.runtime/empresas-tipos-audit-publish-20261016/active-manifest.json`. Sem republicar metadados das telas nem alterar schema/rotas.

## Demora no PHP local

O servidor de desenvolvimento `php -S` atende uma requisição por vez no Windows. Um canal SSE longo bloqueava a abertura de outros painéis de Logs. Em16/10/2026, os streams de `RuntimeController` foram ajustados para uma rodada autenticada por conexão quando o SAPI é `cli-server`; o navegador reconecta pelo protocolo existente. O streaming em FPM permanece igual.

A correção inicial abriu os3eventos da transação446 em cerca de3s. O fluxo atual substitui o segundo botão Logs pela aba automática **Alterações e eventos**, reutilizando a página vinculada no mesmo documento. A446 consulta opções (`options.md_relacs_desp`); o evento de alteração, com anterior/atual, está na443. Para diagnóstico somente leitura, `verify-runtime-stream.cjs` testa3streams e consultas concorrentes; não imprime credenciais nem modifica dados de negócio.
