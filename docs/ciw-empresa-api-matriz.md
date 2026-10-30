# Aviso de revisão de escopo

A classificação de modos abaixo é histórica e foi substituída pela determinação do usuário de21/10/2026: o construtor envia empresa; a API decide o tratamento. O inventário continua útil. Não usar modos por tabela como requisito de publicação. Contrato vigente em [ciw-empresa-api-responsabilidades.md](ciw-empresa-api-responsabilidades.md).

# Empresa API CIW: matriz de contratos

Inventário somente leitura em21/10/2026:29 telas API,27 entidades. A contagem é do catálogo publicado atual, incluindo filhos e cotações; não é o total de aplicações Scriptcase. Nenhum contexto de empresa foi ativado ainda.

A empresa selecionada não troca o tenant nem cria conexão com outro banco. `shared` mantém o domínio atual; `company` restringe a consulta à empresa; `record` valida o proprietário persistido antes de detalhe/gravação/processo. Nenhuma opção IMA será habilitada por inferência de nome.

| Tela | Operações API publicadas | Modo previsto | Origem e regra necessária | Estado |
|---|---|---|---|---|
| `ciw.coloracoes` | batch, read, get | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |
| `ciw.container-anexos` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-comparativos` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-custos-itens` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-despesas` | read, create, update, delete, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-fechar-custos` | process | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-gerar-versao` | process | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-itens` | read, get, create, update, delete, options | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-nfs` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-pagamentos` | read, create, delete, options, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-painel` | read, get, update, delete | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-rastro-dolar` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-resumo` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-sincronizar-impostos` | process | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.container-versoes-custo` | read, get | record | Validar container_id persistido por pp-container.cod-estabel e empresa cadastrada antes de consultar filhos ou executar mutação; manter validações dos IDs filhos. | Classificação preparada; ativação pendente |
| `ciw.containers` | read, get | company / record | espec.pp-container.cod-estabel; vínculo explícito empresas.cod_emp_ems2 conforme regra legada; restringir query e detalhe. | Classificação preparada; ativação pendente |
| `ciw.cotacoes-bc` | create, delete, get, read, update | shared | espec.hist_cotacoes_bc compartilhada; manter efeitos da série9999 via ContainerCostInvalidation reutilizável e auditoria filha. | Classificação preparada; ativação pendente |
| `ciw.despesas` | read, get, create, update, delete, options | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |
| `ciw.empresas` | read, get, create, update, delete | shared | Catálogo espec.empresas compartilhado: empresa_id/cod_emp_ems2/cod_emp_ems5 identificam vínculo, não são filtro da própria gestão. | Classificação preparada; ativação pendente |
| `ciw.empresas-despesa` | read, get, create, update, delete, options | company / record | espec.empresas_despesa.empresa_id; filtrar leitura e validar ID/empresa persistida sob lock; opções de empresa limitadas à seleção. | Classificação preparada; ativação pendente |
| `ciw.fornecedores` | read, get | shared | CiwFornecedoresService em ems2cad.emitente; atual contrato não filtra empresa. Fonte cadastral comum. | Classificação preparada; ativação pendente |
| `ciw.fornecedores-estrangeiros` | read, get | shared | CiwFornecedoresService em ems2cad.emitente; atual contrato não filtra empresa. Fonte cadastral comum. | Classificação preparada; ativação pendente |
| `ciw.itens-erp` | read, get | company | CiwCadastrosCrud/CiwReferenciasService: buffer fixo ems2med.item; MED comprovado historicamente, IMA exige caminho de banco explícito. | Classificação preparada; ativação pendente |
| `ciw.motivos-desconto` | batch, read, get | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |
| `ciw.parametros-ima` | read, get, create, update, delete | shared | espec.im-param compartilhada; consumo pelas APIs continua include parametros_ima.i, NO-LOCK direto e sem cache. | Classificação preparada; ativação pendente |
| `ciw.representantes-ativos` | read, get | shared | CiwReferenciasService em ems5.representante; contrato atual consulta cadastro comum; não inventar campo empresarial. | Classificação preparada; ativação pendente |
| `ciw.situacoes-container` | read, get, batch | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |
| `ciw.tipos-anexo` | read, get, batch | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |
| `ciw.tipos-versao-custo` | read, get, batch | shared | Cadastro compartilhado espec; preservar contrato. | Classificação preparada; ativação pendente |

As definições API podem conservar endpoints inline históricos que não estão habilitados no runtime (ex.: create de Colorações em entidades somente consulta). A matriz considera exclusivamente RuntimeEndpoint habilitado e assinado. Esses restos de definição não autorizam escrita nem serão usados como contrato novo.

Os processos continuam sem concessão de execução adicional. A camada PHP central já está preparada para propagar contexto a CRUD, lote, opções e processo; a ativação depende de validação no ABL real, compilação12.2 e provas por operação.

Evidência privada sem credenciais: `.runtime/ciw-api-company-20261021/inventory.json`; extrator oficial somente leitura `tools/construtor-local/prepare-ciw-company-bindings.php`.
