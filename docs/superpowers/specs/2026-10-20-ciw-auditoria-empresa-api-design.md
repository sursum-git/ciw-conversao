# Auditoria CIW e empresa operacional para entidades API

Data: 20/10/2026. Estado: desenho aprovado pelo usuário em 21/10/2026; planos preparados para revisão; implementação pendente.

## Objetivo e aprovação recebida

O usuário solicitou liberar as operações dos cadastros CIW convertidos, tornar acessíveis suas transações/logs e vincular as empresas cadastradas no construtor à empresa efetivamente usada nas APIs. A liberação das operações publicadas já foi aplicada a tadeu.parreiras/default: 65 permissões, assinatura nativa válida e três sessões LDAP coerentes. Este desenho cobre os dois pontos restantes.

Em 20/10, o usuário aprovou a abordagem centralizada e determinou: a mudança de empresa se aplica somente quando o módulo tiver entidades do tipo API. Essa condição limita a nova integração de empresa; a auditoria continua usando o mecanismo nativo das aplicações convertidas.

Resultado esperado: o usuário vê o histórico permitido do CIW e, nos módulos integrados, identifica e seleciona a empresa operacional que será aplicada às requisições API. A seleção deve produzir efeito real na consulta ou operação externa, com rastreabilidade da empresa utilizada.

## Escopo e compatibilidade

- Reutilizar frontend, formulários, menu, seletor e renderizadores do construtor por metadados. Não criar frontend paralelo nem alterar Kendo.
- Detectar entidades API por `entityType=api` nas entidades vinculadas aos programas publicados do módulo. Não usar nome de tela ou prefixo como prova do tipo.
- Módulo sem entidade API mantém seu comportamento atual de empresa/assinante, operações locais e auditoria.
- Módulo misto disponibiliza o contexto de empresa API, mas apenas suas chamadas de entidades API recebem o novo contexto. A troca não reconfigura entidades locais ou seu isolamento de assinante.
- Uma entidade API sem vínculo de contexto configurado mantém o contrato anterior. O módulo apresenta a escolha operacional somente quando houver integração configurada; não apresenta uma troca que pareça eficaz sem sê-lo.
- Operações dependentes de empresa configuradas exigem contexto válido e recusam execução quando ele faltar. Não substituir por primeira empresa ou empresa padrão silenciosa.
- Conta corrente fornecedor permanece fora. Nenhuma nova permissão de execução de processos é concedida por este desenho.

## Evidência do estado atual

`ScreenDefinitionService::withTransactionLogs` consulta o acesso às telas `admin.transacoes` e `admin.logs-transacoes`; ambas exigem grupo administrador. Isso oculta os controles para tadeu.parreiras, apesar da infraestrutura de transações existir.

`RuntimeEntityActionService` possui filtros de auditoria para eventos por tela/operação/registro. Esses filtros são opcionais, portanto não bastam para autorizar acesso geral aos históricos. A autorização precisa limitar também a consulta direta por ID e o total retornado.

`RuntimeApiEntityActionService::requestEndpoint` monta URLs, headers, query e corpo da fonte API, mas não resolve empresa operacional da sessão. `ApiRequestContext` trata contexto fechado de registro; não representa a empresa selecionada no cabeçalho.

`AuthSubscriber` representa o assinante e possui metadados. O cadastro API `ciw.empresas` expõe `empresa_id`, `nome`, `cod_emp_ems2` e `cod_emp_ems5`. O vínculo entre esses conceitos ainda não existe. `subscriber.enabled=false` no ambiente atual; o rótulo legado Empresa Demonstracao não comprova uma seleção autenticada.

## Abordagem escolhida

Centralizar a resolução e validação de empresa no backend do construtor e usar um adaptador explícito na fonte API. Isso permite reutilizar a mesma regra em leitura, detalhe, gravação, lote e operações específicas.

A alternativa de acrescentar a empresa individualmente em cada tela/endpoint repete validações e permite divergência entre leitura e gravação. A alternativa de trocar globalmente o assinante altera também os módulos locais e contraria o limite solicitado. Ambas ficam descartadas.

## Auditoria das aplicações CIW

Criar a permissão específica `ciw.audit.read`, concedida explicitamente ao vínculo de tadeu.parreiras/default pelo mecanismo assinado existente. Ela não concede grupo administrador nem acesso a configurações administrativas.

Reutilizar as telas nativas de transações e eventos. A autorização aceita administrador ou a permissão de auditoria CIW. Para esta última, o backend aplica obrigatoriamente a interseção entre assinante autenticado, telas publicadas do módulo CIW e telas que o usuário pode ler. Essa restrição vale mesmo sem filtros enviados pelo navegador.

Listagem, total, detalhe por ID e exportação devem aplicar a mesma política. Eventos são autorizados pela transação pai; fornecer `transaction_id` ou um ID de evento não contorna o escopo. Filtros de tela, registro, operação e paginação podem apenas restringir o conjunto permitido. Um usuário não administrador não consegue consultar outros módulos, assinantes ou telas não autorizadas.

Os controles Logs e Logs Exclusão usam a autorização da tela de origem, preservando os modos nativos de formulário e lote. Quando não houver eventos, exibir histórico vazio. Não criar eventos antigos nem sugerir que o histórico Scriptcase foi migrado. Consultas e processos apresentam somente os registros efetivamente produzidos pelos mecanismos existentes.

Administradores conservam sua política atual. O novo contexto de empresa da API não é pré-requisito para restaurar a visualização do histórico já existente do CIW.

## Vínculo entre empresa e API

### Empresa operacional e assinante

O assinante autenticado continua sendo a fronteira de isolamento. A empresa operacional é um contexto adicional da integração API, dentro desse assinante. Selecioná-la não altera `tenant_id`, usuário, grupos ou permissões de entidades locais.

Reutilizar o cadastro de empresas/assinantes do construtor como referência empresarial, com vínculo explícito por módulo e fonte API nos seus metadados de integração. O vínculo identifica a empresa cadastrada, `empresa_id` externo, códigos EMS2/EMS5 e fonte API cadastrada. Uma empresa pode ter vínculos diferentes por integração. Identificadores e tipos são validados; nomes não determinam o vínculo.

Os metadados pertencem ao servidor, seguem governança e integridade do cadastro e não carregam senhas ou tokens. O contexto operacional fica associado ao assinante da sessão: uma referência empresarial por si só não concede acesso a outro assinante. Não ativar globalmente `subscriber.enabled` para implementar este recurso.

A lista de empresas operacionais permitidas exige vínculo ativo e autorização explícita na sessão do usuário. Usar permissões específicas por módulo/empresa no vínculo assinado, além da permissão da operação. Não inferir autorização apenas porque o cadastro de empresas pode ser consultado. A UI recebe somente identificador opaco e rótulo das opções autorizadas, sem configurações de conexão.

### Seleção na interface existente

Estender o cabeçalho existente para mostrar o contexto operacional da API nos módulos elegíveis, identificado como Empresa API. O seletor de assinante conserva sua função. O componente visual pode ser compartilhado; os contextos e suas ações continuam distintos.

A troca solicita ao backend a seleção de uma empresa permitida para o módulo atual. O backend revalida o vínculo e salva na sessão a chave do contexto e sua revisão. Cada módulo conserva sua própria seleção. A escolha em um módulo não seleciona empresa em outro.

Antes da troca, tratar edições e lotes pendentes pelo diálogo nativo do construtor. Recarregar somente os dados/API e formulários dependentes desse contexto, descartando caches de resultados da empresa anterior. Respostas iniciadas antes da troca não podem preencher a tela da nova empresa. Um formulário aberto não pode salvar usando contexto diferente do que foi utilizado para abri-lo; conflito exige recarga explícita.

Módulos sem API não exibem esse seletor adicional. Em módulos mistos, a UI deixa claro que a seleção é operacional da API e preserva os dados locais.

### Propagação e contrato fechado

Um resolvedor central recebe sessão autenticada, módulo, entidade e operação. Ele verifica o tipo real da entidade e devolve um contexto imutável validado somente para chamadas API configuradas. A revisão do vínculo é revalidada, inclusive após revogação ou desativação.

O cadastro da integração define um mapeamento fechado dos valores confiáveis para os campos de contexto aceitos pela API. A escolha de campos em corpo, query ou cabeçalho é definida no adaptador cadastrado, não por parâmetros livres do navegador. O cadastro é validado no Builder antes da publicação; contratos existentes mantêm compatibilidade quando a opção está ausente.

Valores de empresa recebidos do cliente nunca prevalecem sobre o contexto resolvido. Campo reservado divergente causa erro explícito, inclusive em lote. Não substituir silenciosamente valores divergentes. URLs, credenciais, banco e instância continuam controlados pelo cadastro da fonte; a seleção não aceita endereço ou nome de banco livre.

Classificar cada operação integrada em um dos modos:

| Modo | Comportamento |
| --- | --- |
| Compartilhada | Usa a fonte cadastrada e não recebe filtro de empresa que a operação não suporta. O cadastro de empresas pode alimentar o vínculo sem depender previamente de uma seleção. |
| Por empresa | Exige contexto e aplica a empresa em todas as etapas, inclusive leitura, detalhe, gravação, exclusão e lote. A API valida o contexto e o alcance dos IDs. |
| Vinculada ao registro | A API resolve a empresa pelo registro existente e verifica compatibilidade com a seleção quando esta for exigida. Trocar a seleção não muda a empresa do registro. |

Essa classificação é declarada na integração e revisada contra a regra real de negócio. Não aplicar filtro universal a tabelas compartilhadas. Container existente preserva sua empresa; não executar atualização automática da empresa do container para acompanhar o cabeçalho.

## CIW e Progress

Preparar matriz por entidade/endpoint publicado com o modo acima, campo efetivo da empresa, empresa do registro quando houver e testes previstos. A matriz é um requisito de ativação: cada operação deve ter classificação explícita e evidência do contrato suportado antes de receber contexto.

Mapear as empresas reais pelos identificadores ERP comprovados. Preservar empresas criadas pelo usuário, inclusive registros de teste preexistentes. Não associar automaticamente pelo nome ou deduzir códigos por truncamento.

O PASOE continua em `sursum-api/med`. Código de empresa não equivale a troca de conexão/banco. A operação deve comprovar que a mesma instância tem acesso ao domínio necessário e aplica o código selecionado. Falta de suporte produz indisponibilidade explícita da opção; não encaminhar silenciosamente à empresa MED nem trocar de instância.

Alterações ABL necessárias serão compiladas no OpenEdge 12.2 do .42, publicadas e verificadas no PASOE real conforme a skill motor-progress-publicar-pasoe. Este documento não comprova conectividade IMA nem implementação de uma troca efetiva.

## Transações e empresa efetiva

Para as novas operações API integradas, registrar o identificador empresarial do construtor, módulo, fonte, empresa externa/códigos utilizados e revisão do vínculo no contexto da transação existente. Nunca registrar credenciais ou corpo de autenticação.

Registrar a empresa efetivamente enviada/validada na operação, e não o rótulo atual do cabeçalho. Operações compartilhadas são identificadas como compartilhadas. Eventos antigos sem empresa permanecem identificados como sem contexto registrado; não completar retroativamente por inferência.

A autorização de auditoria verifica assinante/tela e, para eventos novos com empresa operacional, também a autorização da empresa. Não revelar histórico de outra empresa apenas porque o usuário pode abrir a mesma aplicação. Eventos legados seguem a autorização de auditoria CIW descrita acima, sem atribuição empresarial inventada.

## Erros e proteção dos dados

Empresa ausente, desativada ou não autorizada impede operação dependente de empresa. Revisão obsoleta e mudança de contexto durante edição exigem recarga. ID pertencente a outra empresa é recusado sem retornar seus dados. A API valida a empresa antes de ler ou alterar registros; filtrar somente depois do retorno no PHP é insuficiente.

Lotes não misturam empresas. A confirmação de troca na interface não salva edições automaticamente. Resposta externa de erro dentro de HTTP 200 continua sendo erro de negócio, conforme o contrato existente.

## Validação e critérios de aceite

1. Testes de auditoria cobrem listagem, total, detalhe, evento por transação e exportação; negam outros assinantes/módulos/telas e filtros adulterados. Administrador mantém seu comportamento atual.
2. Despesas, Empresas por Despesa e um cadastro em lote exibem os controles nativos de histórico para tadeu.parreiras, sem grupo administrador. Historicamente vazio é distinguido de acesso negado.
3. Módulo sem API preserva interface e requisições. Módulo misto transmite contexto apenas às suas entidades API. Metadado ausente conserva o contrato antigo.
4. Empresas A/B autorizadas resultam nos respectivos códigos externos; vínculo ausente, revogado ou adulterado é recusado. A troca não altera o assinante nem permissões locais.
5. Leitura, detalhe, inclusão, alteração, exclusão, lote e operações específicas usam o mesmo resolvedor; IDs de outra empresa e payloads conflitantes são negados antes de efeitos de negócio.
6. Respostas antigas, formulários e lotes pendentes não atravessam a troca. Logs registram a empresa efetiva sem credenciais.
7. Testes de negócio autorizados usam somente registros novos marcados para teste e removidos ao terminar. Não testar exclusão com registros operacionais.
8. Alterações Progress só são consideradas concluídas após compilação e validação PASOE real. Testes de unidade não substituem essa prova.

## Entrega e estado

Ordem proposta: restaurar auditoria CIW com escopo obrigatório; implementar o contexto API no construtor original; configurar e comprovar os vínculos/contratos CIW; publicar e validar a troca por empresa nas operações suportadas. Cada etapa registra fontes preparadas, cadastros publicados e validação efetiva separadamente.

Este desenho não altera código, schema, permissões adicionais, APIs ou dados de negócio. O usuário aprovou este documento em 21/10/2026. Planos preparados: `../plans/2026-10-21-ciw-auditoria.md` e `../plans/2026-10-21-ciw-empresa-api.md`; aguardam revisão antes da implementação, que será executada aqui conforme preferência anterior. Não realizar commit/push nesta workspace, que não é um repositório Git.

## Correção prevalente de responsabilidade —21/10/2026
Usuário determinou que o construtor passe a empresa para a API, e a própria API trate tabelas/bancos. Não classificar tabelas nem operações como requisito do construtor. Contrato simplificado por entidade API: version/moduleId/adapter, um único adaptador para todas chamadas registradas. Configuração antiga operations somente compatibilidade. Ver docs/ciw-empresa-api-responsabilidades.md. A matriz histórica mantém o inventário, mas os modos planejados não devem ser ativados como exigência do construtor. Protótipo ABL ApiCompanyBoundary preparado/TT-compilado não publicado; suspender sua integração generalizada como dependência. Algumas rotas convertidas ainda têm parâmetros fechados/buffer fixo MED: confirmar contrato real antes de ativar e não alegar troca de empresa provada.
