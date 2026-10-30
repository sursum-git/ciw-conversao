# CIW — primeira fase de conversão

Data:16/10/2026. Estado: **desenho aprovado pelo usuário** pela resposta “Aprovar o desenho da primeira fase”. Novos programas desta fase ainda não implementados/publicados.

## Pedido e limite vigente

Executar a conversão na ordem do inventário de262aplicações, preservando as16telasCIW publicadas. O usuário retirou provisoriamente **“Conta corrente fornecedor”, do menu Tarefas**. A exclusão é por item funcional: não suspende por inferência todos os serviços de pagamento, associação e cálculo que outros fluxos utilizam.

Política em `integration-src/ciw-inventory/conversion-scope.json`. O menu lê links de `ticontrole.itens_menu`, com menu_id1; os fontes não contêm o vínculo definitivo do rótulo. A tentativa de consultar esses metadados por MySQL local não encontrou acesso disponível. Não identificar o destino por adivinhação nem publicar o item antes de resolver esse vínculo. A fase1 não depende desse programa financeiro.

## Decomposição e sequência

A migração completa abrange autenticação, cadastros, fiscal, importação, financeiro, custos e arquivos. Cada fase terá entrega e validação próprias, mantendo a ordem aprovada. Esta especificação cobre os fundamentos e cadastros da fase1; não autoriza chamar a existência de um cadastro de conversão integral de um processo descendente.

| Subetapa | Conteúdo | Resultado esperado |
|---|---|---|
|1A|Identidade, permissões e auditoria já existentes|Contrato de sessão/ator e escopo IMA confirmado, sem outro frontend de login|
|1B|Colorações|Consulta e manutenção usando o cadastro API existente onde compatível|
|1C|Situações do container|CRUD com flags e ordem preservados|
|1D|Tipos de valor|CRUD preservando chave de entrada e indicador ativo|
|1E|Tipos de versão de custo|CRUD com dependências das versões protegidas|
|1F|Motivos de desconto|Edição em lote transacional pelo modo existente|
|1G|Empresas×Imposto e Despesas×Impostos|Relacionamentos fiscais com referências validadas no servidor|
|1H|Parâmetros IMA|Consulta/manutenção administrativa, consumo direto sem cache|
|1I|Consulta separada de tipos de anexo|Conferir equivalência e absorver na tela existente quando os contratos coincidirem|
|1J|Logs e navegação transversal|Usar auditoria e shell existentes; especificar consulta histórica sem reescrever histórico|

As etapas de identidade e dados são separáveis no código, mas permissões e ator confiável são pré-requisitos para habilitar qualquer nova escrita. Não avançar silenciosamente para outra fase quando uma condição desta fase falhar.

## Evidência já levantada

Fontes de42aplicações copiados somente para análise em `sources/scriptcase/phase1/`;131arquivos. `phase1-source-manifest.json` registra hashes remotos e das cópias. Literais sensíveis foram omitidos; essas cópias não são programas PHP executáveis nem arquivos para republicação.

| Formulário legado | Campos comprovados na persistência ativa |
|---|---|
|form_pub_coloracoes|coloracao_id,descricao,log_inativo|
|form_situacoes_container|situacao_container_id,descricao,log_gerar_saldo_a_pagar,log_gerar_distr_custo,num_ordem|
|form_tipos_valor|tipo_valor_id,descricao,ativo|
|form_tipos_versao_custo|tipo_versao_custo_id,descricao|
|form_motivos_desconto|motivo_desconto_id,descricao,log_considerar_custo|
|form_im_param|cod-param,val-param,tp-param|
|form_despesas_impostos|despesa_id,imposto_id,empresa_id|
|form_empresas_imposto|empresa_imposto_id,imposto_id,empresa_id,cod_nat_operacao|

Esses campos foram identificados nos INSERTs dos formulários, sem executar PHP ou escrever dados. Tamanho, null, defaults, índices, sequências e dependências exigem dicionário físico antes de codificar os respectivos writers. Não copiar MAX+1 sem controle de concorrência; não converter chave informada pelo usuário em chave automática sem evidência. `form_tipos_valor` aceita chave na inclusão; outros formulários consultam MAX no legado. Uma API de consulta de Colorações já está publicada; não há CRUD/tela entregue dessa entidade.

## Arquitetura escolhida

Reutilizar `production/app.html`, CrudEngine, modo batch, autenticação, transporte API, auditoria e Builder do construtor-pg. JSON descreve campos, filtros, permissões, lookups e operações. PHP valida sessão/permissão e chama wrappers ABL autenticados. Serviços ABL fazem a leitura e a transação; frontend não decide empresa, banco, tabela, identidade ou regras fiscais.

Alternativas avaliadas: copiar o PHP gerado conservaria dependência de sessão e múltiplas cópias de regras; escrever uma tela por cadastro criaria o frontend paralelo vedado pelo projeto. O padrão existente de entidade API e serviço ABL por domínio permite consolidar consulta/formulário sem reproduzir bibliotecas Scriptcase ou alterar Kendo.

A reutilização se aplica à infraestrutura e aos helpers tipados. Não criar um CRUD universal que aceite nomes de tabela/campo do navegador. Cada wrapper registra buffers fixos e operações fechadas. Fórmulas fiscais, custos, coleta e persistência de versões permanecem nos serviços centrais existentes.

## Identidade e permissões — primeira entrega

Há caminhos de login diferentes no acervo. `app_login` consulta s_users e chama LDAP; o fluxo de `bl_tela_login` usa helpers de usuário IMA e aplicação de permissões Scriptcase. A presença de uma função replicada não comprova que seja o evento ativo do ponto de entrada em uso. Antes da integração, rastrear a entrada e os vínculos que serão preservados; não concluir que todo CIW deve ser autenticado por LDAP apenas porque app_login o utiliza.

O construtor já implementa AuthService, LdapAuthProvider, sessão por tenant e ator autenticado. O PHP8.4.3 local contém `php_ldap.dll`, mas a extensão está desabilitada (`extension_loaded('ldap')=false`). LDAP não está configurado no runtime local. A conversão deve aproveitar esse mecanismo quando a origem confirmada exigir LDAP, com configuração privada e validação do usuário real; não tratar login admin local como identidade IMA geral.

Contrato obrigatório: usuário da sessão é resolvido no servidor para identidade IMA ativa e permissões; payload e querystring não podem substituir login, perfil, grupo ou empresa. Falta de vínculo bloqueia o domínio protegido. O acesso administrativo local continua sendo administrativo local, com sua autoria registrada. Não criar concessão gerencial ou privilégios IMA por correspondência implícita de números internos.

Login, expiração, logout e permissões por operação ficam no shell e backend atuais. A coleta de regras de usuário não expõe credenciais ou registros completos de usuários. O detalhe do vínculo autenticador→identidade IMA deve ser fechado após confirmar o ponto de entrada ativo e antes de habilitar o provedor de produção; essa é uma condição de implementação verificável, não autorização para inventar um mapeamento.

## Contratos comuns dos cadastros

- ABI ABL existente: INPUT JsonObject/OUTPUT JsonObject, envelope Sursum; operações read,get,create,update,delete e batch somente onde previsto.
- Metadados usam a fonte API registrada e snapshots salvos pelo Builder. Alocar códigos pelo catálogo, conferir colisões e não reimportar programas existentes.
- Campos desconhecidos, tipos inválidos, IDs inconsistentes e chaves imutáveis alteradas são recusados. Precisão, Unicode, null e limites seguem dicionário/eventos confirmados.
- Leiautes e filtros no frontend existente, inteiros sem decimais, booleanos Sim/Não e rótulos pt-BR.
- Chaves de leitura contextual e de manutenção são as físicas comprovadas. Relações com chave composta não viram chave artificial por conveniência de tela.
- Escritas com locks NOWAIT e controle de concorrência compatível com as APIs existentes; nenhuma gravação ao abrir tela.
- Exclusão bloqueia dependências conhecidas do domínio. Não apagar em cascata dados de negócio por conveniência.
- Auditoria anterior/atual capturada sob lock; eventos confirmados após commit. Lotes têm eventos por registro e rollback integral.
- Parâmetros IMA consumidos pela include central, NO-LOCK e sem cache. O editor de parâmetros não deve despejar valores secretos em documentação ou evidência pública.

## Arquivos e responsabilidades

Conversão: documentos, metadados e serviços preparados por domínio sob `integration-src/ciw-cadastros/`; evidências e estado privado em `.runtime/`. Cópias originais/analisadas nunca são tratadas como arquivos de produto.

Construtor canônico: registrar entidades/fontes/telas pelo fluxo oficial; alteração no core apenas se surgir lacuna demonstrável, com teste e exemplo pertinentes. Nenhuma alteração em kendo/vendor, definições assinadas, schema, reseed ou reassinatura. Preservar todos os diffs atuais.

Motor canônico v2: serviços/wrappers/includes e testes pertinentes; sincronização com guard de hashes. Não alterar v1. Publicar somente artefatos compilados12.2, nunca fixtures ou staging inteiro. Credenciais por entrada protegida, sem argumentos de processo, fontes ou memória de projeto.

## Validação e critérios de aceite

1. Demonstrar origem de identidade, recusa de falsificação, usuário sem vínculo/inativo e isolamento entre usuários/tenants; login/expiração/logout permanecem coerentes.
2. Antes de cada writer, confirmar dicionário, dependências, geração de chave e eventos; registrar a evidência junto do domínio.
3. Testar serviço ABL com TT: validações, dependências, Unicode/null, concorrência e rollback. Batch mistura operações e falha em linha posterior sem persistir anteriores.
4. Compilar no OpenEdge12.2 do192.168.0.42, exigindo COMPILER:ERROR=no e PASS por cultura AMERICAN/EUROPEAN.
5. Publicar com baseline/hash/backup e validar no PASOE real **sursum-api/med**. Não trocar instância como fallback.
6. Publicar telas pelo Builder/governança; verificar leitura, detalhe, formulário, permissões, erros e logs. Testes de negócio somente em registros novos marcados e removidos ao final; preservar registros do usuário.
7. Atualizar o inventário por aplicação com estados separados: fonte preparado, compilado, publicado e validado. Só marcar o sublote concluído após a prova real pertinente.

## Estado desta revisão

Levantamento e desenho aprovados; nenhuma funcionalidade nova desta fase foi habilitada. Próxima etapa: revisar o plano executável da primeira entrega conforme writing-plans. Não criar commit/push. Não converter “Conta corrente fornecedor” enquanto vigorar a exclusão do usuário.
