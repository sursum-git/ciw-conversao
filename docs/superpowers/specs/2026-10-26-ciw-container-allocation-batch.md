# Seleção em lote de itens para containers

Solicitação aprovada: usuário pediu “faça” após a proposta de converter control_selec_proc_compra e grid_itens_proc_compra_selecao, reutilizando alocação e logs. Plataforma e regras gerais já determinadas; execução inline. Controles fica na pendência final.

## Experiência e contrato

Consolidar os dois legados em um ProcessEngine contextual `container_id`, com seleção múltipla pesquisável de itens elegíveis. Labels incluem pedido, código/descrição, empresa/fornecedor e saldo; pesquisar pedido identifica seus itens sem exigir outra tela. Até25itens distintos por execução. Alocar todo saldo disponível ATUAL como no legado; quantidade parcial segue na manutenção existente. Mostrar resultado e itens ignorados por já existirem no container. Abrir/pesquisar não escreve; confirmaçãoKendo antes da operação, double opt-in/permission própria.

Preservar seleção global, sem nova igualdade de empresa/fornecedor. Itens semERP ou semsaldo não são elegíveis; IDs inválidos/fracionários/duplicados/payloadsalvo/quantidade/atorforjado são recusados. Concorrência: mestre e itens de compra bloqueados em ordem determinística; validar lote completo antes de consumir IDs. Par já existente é ignorado e informado como no original; saldo zerado para um novo par falha TODOlote. Sem sucesso parcial.

## Reutilização

`ContainersItensBatchService.p` compõe `ContainersItensCrudService.p` com allow_nested privado na mesma transação raiz. Não chamar APIHTTP em loop nem duplicar imposto/custo/financeiro. Extrair cálculo de saldo para rotina única compartilhada pelo single/batch; fold de efeitos guarda before inicial/after final por recurso/ID e prova continuidade das imagens. Container fica custo desatualizado pelo serviço existente. Rollback desfaz todos os efeitos; sequência pode ter gaps, nunca reset/reseed.

`ContainersItensCrud.p` mantém autenticação/providerfixos e acrescenta somente recurso/operação registradas e optionslookup fechado. Núcleo fiscal/financeiro/runtime permanecem reutilizados. Auditroot container-alocacoes/allocate com before/after mestre, efeitos consolidados e atorautenticado; pending nunca vira confirmado. PHP valida committed/actor/contexto/IDs selecionados/efeitos restritos antes de registrar, consulta Logs de container e itens mantém isolamento tenant/IDs.

## Extensão nativa mínima

ProcessEngine só aceita escalares hoje. Reutilizar coleção JSON de inteiros já existente noBuilder/CRUD, optionsSource de operações cadastradas/read/mesmo contexto e KendoMultiSelect local. Estender validação/normalização/parâmetros/opções sem URL livre/JSJSON/templates/callbacks. Opções carregam sem executar processo, botão bloqueado em erro/carregamento, readonlycontext protegido; requests antigos escalares preservados. Semfrontendparalelo/Kendoalterado.

## Entrega e limites

Candidatos isolados e baselines em .runtime/container-allocation-batch-20261026 e integration-src/container-allocation-batch; preservar dirtycanonicals. TDD PHP/JS/ABL12.2, regressões single/fiscal/financeiro,4codepage/culturas e uma revisão final fresca. Compilar .42/publicar137via111/validar SOMENTEsursum-api/med9911, túnel19910→9910mesmainstância. Publicação padrão autorizada; novo cenário operacional e grants requerem autorização concreta após implementação/revisão. NenhumaDDL/alteração de registros existentes por teste. Autorizações fiscais anteriores encerradas.
