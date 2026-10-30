# Empresa API: responsabilidades vigentes

Correção expressa do usuário em 21/10/2026, prevalente sobre a classificação anterior por tabela/operação.

O construtor seleciona uma empresa autorizada, resolve seu identificador no servidor e envia esse identificador no parâmetro esperado pela API. A seleção é independente do assinante autenticado. O construtor não define quais tabelas tratam empresa, não filtra resultados por regras ERP e não escolhe conexões de banco.

A própria API interpreta a empresa recebida e aplica suas regras de consulta, gravação e conexão. Isso inclui tabelas compartilhadas do CIW e tabelas ERP que pertencem a bancos específicos. Essas diferenças não exigem uma classificação de tabelas no construtor.

O contrato de transporte simplificado é `apiCompanyContext: {version: 1, moduleId: "ciw", adapter: "empresa"}`. O adaptador cadastrado na fonte define somente o nome/local do parâmetro e o identificador enviado. Ele vale para todas as chamadas registradas da entidade API, inclusive consultas auxiliares, opções, imagens de auditoria e processos já autorizados. Não cria novas permissões de execução. Entidades locais e integrações sem esse contrato conservam seu comportamento.

A auditoria registra a empresa efetivamente enviada. Isso prova o contexto de transporte; não prova, sozinho, o isolamento de dados implementado pelo serviço externo. Revisões da seleção, assinaturas, autorização e tratamento de respostas antigas continuam na infraestrutura do construtor.

Configurações anteriores com `operations` são aceitas para compatibilidade e não são migradas silenciosamente. O editor passa a oferecer um único mapeamento de envio. Não foi ativada configuração empresarial no catálogo real nesta correção.

## Evidência e limite atual

O núcleo de seleção/transporte já está no projeto original do construtor. O inventário de 29 telas/27 entidades continua válido; a coluna histórica de modos em `ciw-empresa-api-matriz.md` deixa de ser requisito de configuração. O protótipo `integration-src/api-company/ApiCompanyBoundary.i` e seus testes não foram publicados e não constituem requisito para o construtor enviar a empresa.

As fontes atuais de algumas APIs convertidas ainda não demonstram o contrato empresarial: `CiwCadastrosCrud.p` abre explicitamente `ems2med.item`; `DespesasCrudService.p` tem lista fechada de campos de consulta que não inclui um parâmetro empresarial adicional. Portanto não se deve afirmar que essas rotas já trocam de empresa apenas porque o transporte está pronto. A próxima validação é do parâmetro/entrada efetivamente usado pela API, sem uma matriz de tabelas no construtor e sem alterar regras de negócio por inferência.

Empresas A/B/Principal não foram associadas automaticamente a IMA/MED. A correspondência entre a referência do construtor e o identificador externo continua explícita, sem dedução pelo nome.
