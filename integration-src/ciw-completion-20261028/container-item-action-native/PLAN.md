# Itens/container: delta nativo em descoberta

Escopo autorizado: op1008/custos dos itens, op1002/manutenção e destino existente ciw.proc-compra-itens. Nenhum novo programa, escritor, fórmula, coletor ou frontend paralelo. Os freezes e o exercício1042 permanecem intocados.

## Export fresco antes de autoria

O root executa `node tools/construtor-local/export-ciw-container-item-action-current.cjs --export-readonly`. A ferramenta aceita somente esse argumento, consulta metadados por GET e exige pasta nova `.runtime/ciw-completion-20261028/container-item-action-native/current`. Resolve o programa do destino por screenId único, exige exatamente uma versão publicada por programa, deriva entityCode dessa versão e sourceCode da entidade. Não fixa nomes de fontes com base em candidatos históricos. Os documentos removem headers recursivamente, redigem propriedades sensíveis e credenciais/query de URLs absolutas; as credenciais da sessão só ficam em memória no helper existente. O proof contém UTC, bindings, quantidades e hashes. DTO sanitizado nunca substitui autenticação. Nenhuma execução desta ferramenta pelo executor.

## Capacidade atual comprovada

* `CrudKendoGridRenderer.buildRowLinkHtml` leva IDs da linha a `context__*`. Builder, schema e validador aceitam apenas `field/sourceField`; constantes `value` são recusadas. Toolbar CRUD entrega handlers fixos, sem handler de navegação parametrizada ou troca de parâmetro de consulta. Não há suporte comprovado para os botões USD/BRL por constantes inteiras.
* `CrudEngine.initializeNavigationContext` usa somente campos declarados no destino. Portanto passar item_proc_compra_id sem declarar/filtrar esse contexto abre todos os itens do pedido. Não prometer seleção direta apenas adicionando o link.
* `ApiRequestContext::resolve` e `ProgramBuilderService.normalizeContextFields` exigem integer. O fato de o frontend aceitar string não cria um contrato de moeda funcional. O read comum encaminha só o contexto validado ao endpoint e aplica filtros de usuário depois de ler a API. Filtro local moeda=dolar não converte a requisição BRL.
* Custos já aceitam `real/dolar` em ContainersCustoReadService, mas a fonte histórica fixa real. A escolha default USD é requisito legado ainda não implementado nem declarado como atual.
* `visibleWhen` atua em inputs do formulário. A grade usa apenas `column.visible === false`; não consome a condição por flag do container. Não criar JSON que pareça ocultar as quatro colunas sem efeito real.

## Esboço revisável, sem aplicar

1. Após export: comparar programas completos, entidades e fontes atuais; identificar contextos/PK e política de edição dos destinos. Propor rowLinks com container_id/item_container_id e proc_compra_id/item_proc_compra_id apenas se o destino declarar e aplicar os dois IDs. Se ele não filtrar o item, preparar extensão explícita de seleção/abertura por PK, preservando a consulta por pai das entradas antigas; não tornar obrigatório um ID que quebre callers existentes.
2. Moeda requer extensão pequena do CRUD nativo opt-in: seletor fechado de parâmetro de leitura, separado dos filtros locais, com default dolar e valores dolar/real. Reutilizar dropdown nativo e transporte existente, cancelar/desprezar resposta antiga ao trocar, enviar a mesma escolha em read/get/export e validar novamente em backend. CID continua imutável/obrigatório. Configuração ausente mantém os requests antigos. Alternativa por código técnico1/2 não cabe no rowLink/toolbar atual; não inventar ID de banco, coluna falsa, abas duplicadas ou tela paralela.
3. Visibilidade requer capacidade nativa opt-in por escalar confirmado do contexto de resposta, projetado uma única vez pelo serviço atual a partir de pp-container.log_liberar_custo_realizado. Condicionar somente vl_total_real/vl_unit_real/vl_merc_real/vl_desp_real, que correspondem aos quatro campos legados. Definir explicitamente NULL/ausência e export/coluna móvel/layout; impedir que layout salvo reexiba uma coluna bloqueada. Não zerar valores ou afirmar autorização nova. O mecanismo exato e limites do contrato serão propostos ao root após baseline fresca; não reutilizar visibleWhen de formulário como se fosse de grade.
4. Manter descrições ERP MED/IMA e resumo financeiro como diferenças abertas; sem escolher origem arbitrária nem recalcular no cliente. Nenhum delta de produto ou catálogo aplicado nesta entrega.

## Provas e próximos gates

Oito testes offline do exportador cobrem vínculos, ambiguidades, derivação, sanitização, imutabilidade e bloqueio antes da autenticação sem flag. Cinco testes chamam protótipos reais do frontend e comprovam rowLink com dois IDs, rejeição/ausência de constante, limite de visibilidade e descarte do contexto não declarado. Três verificações chamam ApiRequestContext canônico real. São provas locais de contrato, sem DOM publicado, Kendo alterado, API/ERP/DB ou negócio. Os candidatos compartilhados futuros precisam patches por SHA das baselines frescas e revisão root antes de integrar/publicar.
