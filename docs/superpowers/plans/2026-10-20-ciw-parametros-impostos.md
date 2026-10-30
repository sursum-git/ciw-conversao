# Continuação CIW — Despesas × Impostos e Parâmetros IMA

Execução aqui autorizada pelo usuário em20/10, desenho fase1 já aprovado.
Permissões CIW ficam para o final; controles atuais e exclusão de Conta corrente
fornecedor preservados. Sem frontend paralelo, Kendo, schema ou novas concessões.

## Decisões da continuação

Despesas × Impostos não ganha outro writer: `DespesasCrudService.p::SyncChildren`
já mantém a tabela pela chave despesa_id/imposto_id/empresa_id na coleção impostos
de `ciw.empresas-despesa`. Conferir cobertura de inclusão/exclusão, escopo, imposto
como despesa classificada e rollback; registrar absorção e eventual órfão pendente.
Imposto não é uma tabela nova: referência é despesas.log_imposto=1. Não inventar
tabela impostos nem chave substituta. As chaves do formulário legado já ficam
somente leitura após inclusão.

Parâmetros IMA usa CRUD de formulário já existente. PK cod_param (cod-param físico)
permanece textual e imutável; alias de apresentação codigo usa readonlyOnEdit,
capacidade já presente no Builder. Campo técnico oculto row_stamp transporta hash
do estado físico completo para concorrência, sem coluna física ou cache. Campos
editáveis legados: val-param, tp-param (CARACTER1/INTEIRO2/DECIMAL3/DATA4/LÓGICO5;
zero existente preservável). agrup_im_param_id não é editável e deve ser preservado.
Auditoria fechada admite identidade textual e mascara valor de chaves sensíveis.
Consumo pelas APIs continua na include parametros_ima.i, direto NO-LOCK, sem cache.

Ruling: continuação do desenho aprovado, com reutilização de capacidades presentes;
não iniciar nova implementação de identidade composta ou frontend. O writer de
relacionamentos já existente resolve o contrato sem duplicar transação/regras.

## Passos

- [x] Teste isolado de DespesasCrudService: chave tripla e isolamento entre empresas,
  referência somente imposto, associação idempotente, rollback em relação inválida.
- [x] RED/GREEN do serviço de parâmetros por TT: string/apóstrofo, tipos/limites,
  chave imutável, duplicata, original hash obrigatório, conflito e grupo preservado.
- [x] Hook de auditoria fechado e testes: origem/rota/recurso/tipo de ID, snapshots,
  hash antes/depois e mascaramento por código sensível. Não mudar auditoria dos4atuais.
- [x] Metadados Builder do formulário, anexar operação à fonte existente de forma
  mesclada, validar sem publicar até possuir prova12.2/PASOE. Inventário e guia.
- [x] Compilar no .42/OpenEdge12.2, publicar p/r por manifesto/backup/hash e validar
  no sursum-api/med com registros novos CODEx e limpeza. Nunca publicar .r12.8.
- [x] Revisão independente única do delta; atualizar contextos com o estado real.

Ambiente20/10 nesta retomada: SSH42 expirou por timeout; probesTCP42/111/137
indisponíveis. Preparar/testar isoladamente; publicação real fica condicionada ao
retorno da rede. Evidências e ledger privados .runtime/ciw-keyed-20261020/.

Atualização prevalente: usuário informou rede restabelecida; compilação12.2 e
publicação PASOE concluídas.71checks/cultura/codepage e229relações/cultura;
PHP542/3237; teste real limpo nos dois fluxos e8eventos CRUD auditados.
Banco real12relações,0órfãos/0referências inválidas. Parâmetros IMA cd0098 publicado;
Despesas×Impostos absorvido em cd0093. Documento público
docs/ciw-parametros-impostos-validacao-2026-10-20.md. Conferência visual permanece
pendente; nenhum novo grant de negócio ou alteração de contas humanas.
