# CIW — Parâmetros IMA e Despesas × Impostos

Continuação autorizada em20/10/2026. Permissões CIW permanecem para a última etapa;
autenticação e controles atuais preservados. Conta corrente fornecedor excluído.

## Estado efetivo

**Parâmetros IMA:** publicado pelo Builder, **cd0098**, `ciw.parametros-ima`1.0.0.
Formulário no frontend existente; código textual informado na inclusão e imutável
depois. Campos legados: código, valor e tipo (1caracter,2inteiro,3decimal,4data,
5lógico;0legado). Grupo físico existente preservado, sem edição ou novo schema.
Campo técnico oculto row_stamp verifica concorrência sobre o estado físico completo.

**Despesas × Impostos:** manutenção absorvida em **cd0093**,
`ciw.empresas-despesa`1.0.1. Caminho: **Despesas → Empresas → Impostos que usam
esta despesa na base**. A coleção inclui/remove os vínculos na transação de
`DespesasCrudService.p`, preservando despesa_id/imposto_id/empresa_id. Imposto é
uma despesa com log_imposto=1; não existe motivo para inventar tabela impostos,
chave artificial ou um segundo writer. O formulário legado já bloqueia edição
das chaves após inclusão. Nenhuma alteração no writer fiscal existente.

Consulta somente leitura do banco real: **12vínculos**, nenhum sem pai, sem empresa,
sem despesa base ou com referência de imposto inválida. Todos os vínculos atuais
são alcançáveis pelo fluxo aproveitado. A consulta global legada e sua apresentação
continuam como absorção parcial no inventário; manutenção não implica reproduzir
cada filtro/ordenação dessa consulta. Conferência visual das telas ainda pendente.

## Publicação e segurança de dados

Novo `CiwParametrosService.p` e delta do wrapper `CiwCadastrosCrud.p`, na rota já
existente `POST /SursumPrograms/ciw-cadastros`, recurso enumerado im_param.
Quatro artefatos p/r compilados12.2 publicados via111 no compartilhamento137,
**sursum-api/med**, com hashes/baseline/backup. Nenhuma rota/configuração técnica
ou permissão de negócio criada. Refresh oficial somente das sessões med ociosas.

Fonte API existente mesclada com cinco operações novas pelo cadastro oficial;
headers mascarados preservados pelo backend, sem exportar seus valores. Entidade
e programa publicados com a governança de autoria existente. Sem frontend
paralelo, mudança em Kendo, commit/push, reseed ou schema.

Auditoria de parâmetros usa contrato fechado e chave textual, com estados antes
e depois, grupo e hash. **Valores de parâmetros são omitidos do journal e do
contexto de requisição**, inclusive nas consultas de detalhe; podem conter
credenciais. A edição autorizada continua retornando o valor ao formulário.
Não guardar valores reais, senhas ou tokens em fontes, documentação ou evidência
pública. Consumo dos parâmetros pelas APIs continua na include parametros_ima.i,
direto NO-LOCK e sem cache; o editor não altera esse contrato.

## Provas executadas

- OpenEdge12.2/.42: quatro fontes sem erro; **71checks de parâmetros** em cada
  cultura AMERICAN/EUROPEAN e codepage UTF-8/ISO8859-1; **229checks de despesas e
  relações** em cada cultura, usando somente TTs. Diagnóstico12.8 local não foi
  publicado. Rede inicialmente indisponível, restabelecida pelo usuário antes
  da compilação/publicação oficiais.
- PHP canônico: **542testes/3237asserções**. Inclui configuração do Builder,
  transporte do estado oculto, vínculo da auditoria e ausência de valores no log.
- PASOE via backend do construtor: parâmetro novo com acento/apóstrofo no código,
  inclusão, alteração, get, exclusão, conflito de estado, chave divergente e limite
  de500caracteres. Criados apenas registros CODEx e removidos no finally.
- Despesas/Impostos no mesmo ensaio real: nova despesa base, novo imposto e dois
  vínculos novos em empresas existentes usadas somente como referência. Remover
  imposto da primeira empresa preservou o da segunda; referência inválida
  posterior causou rollback. Pais/filhos de teste removidos antes das despesas.
- Auditoria real: **3eventos** CRUD do parâmetro e **5eventos** dos vínculos,
  confirmados por chave/ator da sessão. Valores ausentes de snapshots, diffs e
  contexto. Header de ator forjado não substituiu identidade autenticada.
- As quatro telas de cadastros publicadas no lote anterior continuam lendo pelo
  wrapper atualizado. Catálogo atual: **24telas CIW**, definições runtime HTTP200.
- Revisão independente do delta sem defeito concreto. Nenhum dado anterior foi
  usado como alvo de escrita; empresas existentes foram somente referências.

Evidências privadas e backups: `.runtime/ciw-keyed-20261020/`, incluindo
compiled122/, active-manifest.json, real-validation.json, test-ownership.json,
impostos-coverage.json e canonical-manifest.json. Seus conteúdos privados não
devem ser copiados para documentação pública.

Inventário atualizado, distinguindo formulários mantidos de consultas parcialmente
absorvidas. Permanecem fora desta entrega os dois cadastros com origem/schema
pendentes, a conferência visual e a integração final das permissões CIW.
