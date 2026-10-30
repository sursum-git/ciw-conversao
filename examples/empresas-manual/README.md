# Exemplo manual de consulta de empresas

Arquivos didáticos preparados em 15/10/2026. Não compilados/publicados por esta entrega; nenhuma rota, fonte ou entidade ativa foi alterada.

`ConsultarEmpresasManual.p` recebe INPUT JsonObject e devolve OUTPUT JsonObject, conforme o roteador atual. Contém validação do cabeçalho X-Empresas-Token usando o mesmo hash privado de configuração da API atual. A consulta é um FOR EACH estático sobre espec.empresas, sem SQL ou WHERE recebido do cliente. O JSON devolve success=true e data como array dos quatro campos atuais. Erros incluem success=false e error com code/message/status.

## Publicar o programa manual

1. Copiar o fonte para sursum-api/programs/ConsultarEmpresasManual.p no projeto motor-progress v2.
2. Compilar com OpenEdge12.2, conectado ao banco lógico espec; a referência estática à tabela exige seu schema na compilação. Exigir COMPILER:ERROR=no.
3. Publicar fonte e .r em /mnt/datasul/ERP/sursum/sursum-api/programs, pelo procedimento do projeto.
4. Acrescentar o objeto de rota-adicionar.json ao array routes do catálogo efetivo /mnt/datasul/ERP/sursum/conf-web-handler/program-routes.json. Preservar as outras rotas.
5. Consultar a nova rota antes de trocar a entidade. A URL local será http://127.0.0.1:19910/med/web/SursumPrograms/empresas-consulta-manual. POST com corpo {} e a credencial atual no header privado. Não colocar a credencial em arquivo de exemplo ou URL.

## Cadastrar e selecionar no construtor

1. Abrir production/program-builder.html como administrador e selecionar a entidade Empresas Progress (empresas_progress).
2. Na seção Fonte API, abrir o cadastro de APIs e selecionar Motor Progress — Empresas (motor_progress_empresas).
3. Em Operacoes(JSON), acrescentar o objeto operacao-adicionar.json ao array existente, com vírgula entre os objetos. Preservar as operações atuais e os headers mascarados. Clicar Salvar API. A fonte existente mantém responseContract=sursum-programs, necessário para tratar erros do roteador e propagar identidade autenticada.
4. No editor da entidade, selecionar Consulta manual de empresas como Operacao de lista. Manter detalhe/inclusão/alteração/exclusão nas operações existentes. Salvar a entidade usando a liberação/lock que o fluxo de governança exigir para o programa padrão.
5. Atualizar a tela ciw.empresas. O runtime usa um snapshot da fonte salvo na entidade; somente Salvar API não atualiza esse snapshot.

Não é preciso mudar campos ou gerar outra tela: os nomes empresa_id, nome, cod_emp_ems2 e cod_emp_ems5 são preservados. Não configurar totalPath: esta API retorna a lista completa, e o PHP calcula o total depois de filtrar e então aplica a paginação.

O JsonProgramWebHandler mantém o registro de duração, PID, usuário, agente e instância. O PHP continua enviando a identidade do usuário autenticado no contrato Sursum.

Para voltar à consulta original, selecionar Consultar empresas (read) em Operacao de lista e salvar novamente a entidade.
